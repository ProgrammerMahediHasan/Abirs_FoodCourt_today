<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Customer;
use App\Models\Restaurant;
use App\Models\RestaurantTable;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Carbon\Carbon;

class OrderController extends Controller
{
    // LIST ORDERS
    public function index(Request $request)
    {
        $query = Order::with('customer', 'items.menu')->withCount('items')->latest();

        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('order_no', 'like', '%' . $search . '%')
                    ->orWhereHas('customer', function ($cq) use ($search) {
                        $cq->where('name', 'like', '%' . $search . '%')
                            ->orWhere('phone', 'like', '%' . $search . '%');
                    });
            });
        }

        if ($request->status) $query->where('status', $request->status);
        if ($request->date) $query->whereDate('ordered_at', $request->date);

        $orders = $query->paginate(10);
        return view('pages.erp.orders.index', compact('orders'));
    }

    // CREATE ORDER
    public function create()
    {
        $customers = Customer::all();
        $restaurants = Restaurant::all();
        $menus = Menu::with('stock')->orderBy('name')->get();
        $tables = [];
        if (Schema::hasTable('restaurant_tables')) {
            $tables = RestaurantTable::where('status', 'available')->orderBy('name')->get();
        }
        return view('pages.erp.orders.create', compact('customers', 'restaurants', 'menus', 'tables'));
    }

    // STORE ORDER (PENDING)
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'nullable|exists:customers,id',
            'restaurant_id' => 'required|exists:restaurants,id',
            'order_type' => 'required|in:dine_in,takeaway,delivery',
            'table_id' => 'nullable|exists:restaurant_tables,id',
            'menu_ids' => 'required|array|min:1',
            'menu_ids.*' => 'exists:menus,id',
            'quantities' => 'required|array|min:1',
            'quantities.*' => 'integer|min:1',
            'note' => 'nullable|string',
            'discount' => 'nullable|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            // If dine-in with a selected table, ensure table is available
            if ($request->order_type === 'dine_in' && $request->filled('table_id') && Schema::hasTable('restaurant_tables')) {
                $table = RestaurantTable::lockForUpdate()->findOrFail($request->table_id);
                if ($table->status !== 'available') throw new \Exception("Selected table is not available.");
            }
            $order = Order::create([
                'order_no' => 'ORD-' . time(),
                'customer_id' => $request->customer_id,
                'restaurant_id' => $request->restaurant_id,
                'table_id' => $request->order_type === 'dine_in' ? $request->input('table_id') : null,
                'order_type' => $request->order_type,
                'status' => 'pending',
                'subtotal' => 0,
                'total' => 0,
                'note' => $request->note,
                'ordered_at' => now(),
            ]);

            $subtotal = 0;
            foreach ($request->menu_ids as $i => $menuId) {
                $menu = Menu::with('stock')->findOrFail($menuId);
                $quantity = $request->quantities[$i];
                $lineTotal = $menu->price * $quantity;

                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_id' => $menu->id,
                    'quantity' => $quantity,
                    'unit_price' => $menu->price,
                    'total_price' => $lineTotal,
                ]);

                // Stock will be decremented only after successful payment
                $subtotal += $lineTotal;
            }

            $taxRate = 0.05;
            $taxAmount = round($subtotal * $taxRate, 2);

            $discount = $request->input('discount', 0);
            if ($discount > ($subtotal + $taxAmount)) {
                $discount = $subtotal + $taxAmount;
            }

            $total = ($subtotal + $taxAmount) - $discount;

            $order->update([
                'subtotal' => $subtotal,
                'tax' => $taxAmount,
                'discount' => $discount,
                'total' => $total,
            ]);
            // Mark table occupied immediately for dine-in with a table selected
            if ($order->order_type === 'dine_in' && $order->table_id && Schema::hasTable('restaurant_tables')) {
                RestaurantTable::where('id', $order->table_id)->update(['status' => 'occupied']);
            }
            DB::commit();
            return redirect()->route('orders.index')->with('success', 'Order placed successfully; now the manager will approve it.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors($e->getMessage());
        }
    }

    // SHOW ORDER
    public function show(Order $order)
    {
        $order->load('customer', 'restaurant', 'items.menu');
        return view('pages.erp.orders.show', compact('order'));
    }

    // EDIT / CONFIRM PAGE
    public function edit(Order $order)
    {
        $order->load('customer', 'restaurant', 'items.menu');
        return view('pages.erp.orders.edit', compact('order'));
    }

    // CONFIRM ORDER
    public function confirm(Order $order)
    {
        if ($order->status != 'pending') return back()->withErrors('Only pending orders can be confirmed.');

        $order->update(['status' => 'confirmed']);

        // Redirect to edit page where Make Payment button will show
        return redirect()->route('orders.edit', $order->id)
            ->with('success', 'Order confirmed successfully');
    }

    // PAYMENT FORM (after order confirmed)
    public function makePaymentForm(Order $order)
    {
        if ($order->status != 'ready') return back()->withErrors('Order must be ready before payment.');
        return view('pages.erp.orders.payment', compact('order'));
    }

    // PROCESS PAYMENT
    public function processPayment(Request $request, Order $order)
    {
        $request->validate([
            'payment_method' => 'required|in:cash,bank,cod,online',
        ]);

        if ($request->payment_method === 'online') {
            $request->validate([
                'online_gateway' => 'required|in:card,bkash,nagad,rocket',
            ]);
        }
        $finalMethod = $request->payment_method === 'online'
            ? $request->input('online_gateway')
            : $request->payment_method;

        DB::transaction(function () use ($order, $finalMethod) {
            $wasPaid = ($order->payment_status === 'paid');

            $order->update([
                'payment_status' => 'paid',
                'payment_method' => $finalMethod,
            ]);

            if (!$wasPaid) {
                $order->load('items.menu.stock');
                foreach ($order->items as $item) {
                    $menu = $item->menu;
                    if ($menu && $menu->stock) {
                        $menu->stock->decrement('current_quantity', $item->quantity);
                    }
                }
            }
        });

        $order->refresh();
        if ($order->payment_status === 'paid' && $order->status !== 'delivered') {
            $invoiceToken = 'INV-' . now()->format('Ymd') . '-' . Str::upper(Str::random(5));
            $order->update(['status' => 'delivered', 'invoice_token' => $invoiceToken]);
            if ($order->order_type === 'dine_in' && $order->table_id && Schema::hasTable('restaurant_tables')) {
                RestaurantTable::where('id', $order->table_id)->update(['status' => 'available']);
            }
            return redirect()->route('orders.invoice', $order->id)
                ->with('success', 'Payment done. Order delivered and invoice generated.');
        }
        return redirect()->route('orders.edit', $order->id)
            ->with('success', 'Payment completed.');
    }

    public function changeStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,preparing,ready,approved,delivered,cancelled'
        ]);
        $next = $request->status;

        // Enforce workflow: approved → preparing → ready → payment → delivered
        if ($next === 'approved') {
            return back()->withErrors('Use the Approve action for this step.');
        }
        if ($next === 'preparing' && $order->status !== 'approved') {
            return back()->withErrors('Order must be approved before preparing.');
        }
        if ($next === 'ready' && $order->status !== 'preparing') {
            return back()->withErrors('Order must be preparing before marking ready.');
        }

        $updated = $order->changeStatus($next);
        if (!$updated) return back()->withErrors('Invalid status update.');
        if ($request->status === 'delivered') {
            return back()->withErrors('Delivery is completed by Cashier after payment.');
        }
        if ($request->status === 'ready') {
            return back()->with('success', 'Now order is ready for payment to Cashier');
        }
        return back()->with('success', 'Order status updated to ' . $request->status . '.');
    }

    public function approve(Order $order)
    {
        if (!in_array($order->status, ['pending', 'confirmed'])) {
            return back()->withErrors('Only pending/confirmed orders can be approved by Admin/Manager.');
        }
        $order->update(['status' => 'approved']);
        return back()->with('success', 'Order approved. Send to Kitchen for preparation.');
    }

    // SHOW INVOICE
    public function invoice(Order $order)
    {
        if (!$order->invoice_token) return back()->withErrors('Invoice not generated yet.');
        return view('pages.erp.orders.invoice', compact('order'));
    }

    public function cancel(Order $order)
    {
        if (in_array($order->status, ['cancelled'])) {
            return back()->with('success', 'Order already cancelled.');
        }
        // Authorization handled by route permission middleware (orders.cancel)
        if ($order->status === 'delivered') {
            return back()->withErrors('Delivered orders cannot be cancelled.');
        }
        DB::transaction(function () use ($order) {
            if ($order->payment_status === 'paid') {
                $order->load('items.menu.stock');
                foreach ($order->items as $item) {
                    $menu = $item->menu;
                    if ($menu && $menu->stock) {
                        $menu->stock->increment('current_quantity', $item->quantity);
                    }
                }
                $order->update(['payment_status' => 'refunded']);
            }
            $order->update(['status' => 'cancelled']);
        });
        if ($order->order_type === 'dine_in' && $order->table_id && \Illuminate\Support\Facades\Schema::hasTable('restaurant_tables')) {
            \App\Models\RestaurantTable::where('id', $order->table_id)->update(['status' => 'available']);
        }
        return back()->with('success', 'Order cancelled successfully.');
    }

    public function destroy(Order $order)
    {
        if ($order->status !== 'cancelled') {
            return back()->withErrors('Cancel the order before deleting.');
        }
        DB::transaction(function () use ($order) {
            $order->load('items.menu.stock');
            if ($order->payment_status === 'paid') {
                foreach ($order->items as $item) {
                    $menu = $item->menu;
                    if ($menu && $menu->stock) {
                        $menu->stock->increment('current_quantity', $item->quantity);
                    }
                }
            }
            $order->items()->delete();
            $order->delete();
        });
        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }

    // CUSTOMER ITEM REPORT
    public function customerItemReport()
    {
        $orderItems = OrderItem::with(['order.customer', 'menu'])
            ->latest()
            ->paginate(20);

        return view('pages.erp.reports.customer_items', compact('orderItems'));
    }

    public function deliveredReport(Request $request)
    {
        $query = Order::with('customer')->where('status', 'delivered');

        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('order_no', 'like', '%' . $search . '%')
                    ->orWhere('invoice_token', 'like', '%' . $search . '%')
                    ->orWhereHas('customer', function ($cq) use ($search) {
                        $cq->where('name', 'like', '%' . $search . '%')
                            ->orWhere('phone', 'like', '%' . $search . '%');
                    });
            });
        }
        if ($request->filled('payment')) {
            $query->where('payment_method', $request->payment);
        }
        if ($request->filled('date_from')) {
            $query->whereDate('updated_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('updated_at', '<=', $request->date_to);
        }

        $summaryCount = (clone $query)->count();
        $summaryAmount = (clone $query)->sum('total');

        $orders = $query->orderByDesc('updated_at')->paginate(20)->withQueryString();

        return view('pages.erp.reports.delivered_invoices', compact('orders', 'summaryCount', 'summaryAmount'));
    }
}
