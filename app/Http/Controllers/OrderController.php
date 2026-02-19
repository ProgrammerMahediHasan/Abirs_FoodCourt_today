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

<<<<<<< HEAD
        return view('pages.erp.orders.create', compact('customers', 'restaurants', 'menus', 'tables'));
=======
        return view('pages.erp.orders.create', compact('customers', 'restaurants', 'menus'));
>>>>>>> 61767df240e155b1a57b3b2a6192c15c2442ed87
    }

    // STORE ORDER (PENDING)
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'nullable|exists:customers,id',
            'restaurant_id' => 'required|exists:restaurants,id',
            'order_type' => 'required|in:dine_in,takeaway,delivery',
<<<<<<< HEAD
            'table_id' => 'nullable|exists:restaurant_tables,id',
=======
>>>>>>> 61767df240e155b1a57b3b2a6192c15c2442ed87
            'menu_ids' => 'required|array|min:1',
            'menu_ids.*' => 'exists:menus,id',
            'quantities' => 'required|array|min:1',
            'quantities.*' => 'integer|min:1',
            'note' => 'nullable|string',
            'discount' => 'nullable|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
<<<<<<< HEAD
            // If dine-in with a selected table, ensure table is available
            if ($request->order_type === 'dine_in' && $request->filled('table_id') && Schema::hasTable('restaurant_tables')) {
                $table = RestaurantTable::lockForUpdate()->findOrFail($request->table_id);
                if ($table->status !== 'available') throw new \Exception("Selected table is not available.");
            }

=======
>>>>>>> 61767df240e155b1a57b3b2a6192c15c2442ed87
            $order = Order::create([
                'order_no' => 'ORD-' . time(),
                'customer_id' => $request->customer_id,
                'restaurant_id' => $request->restaurant_id,
<<<<<<< HEAD
                'table_id' => $request->order_type === 'dine_in' ? $request->input('table_id') : null,
=======
>>>>>>> 61767df240e155b1a57b3b2a6192c15c2442ed87
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
<<<<<<< HEAD
=======
                if ($menu->stock->current_quantity < $quantity) throw new \Exception("Not enough stock for {$menu->name}");
>>>>>>> 61767df240e155b1a57b3b2a6192c15c2442ed87
                $lineTotal = $menu->price * $quantity;

                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_id' => $menu->id,
                    'quantity' => $quantity,
                    'unit_price' => $menu->price,
                    'total_price' => $lineTotal,
                ]);

<<<<<<< HEAD
                // Stock will be decremented only after successful payment
=======
                $menu->stock->decrement('current_quantity', $quantity);
>>>>>>> 61767df240e155b1a57b3b2a6192c15c2442ed87
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
<<<<<<< HEAD
            // Mark table occupied immediately for dine-in with a table selected
            if ($order->order_type === 'dine_in' && $order->table_id && Schema::hasTable('restaurant_tables')) {
                RestaurantTable::where('id', $order->table_id)->update(['status' => 'occupied']);
            }
=======
>>>>>>> 61767df240e155b1a57b3b2a6192c15c2442ed87
            DB::commit();
            return redirect()->route('orders.index')->with('success', 'Order placed successfully');
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
        if ($order->status != 'confirmed') return back()->withErrors('Order must be confirmed before payment.');
        return view('pages.erp.orders.payment', compact('order'));
    }

    // PROCESS PAYMENT
    public function processPayment(Request $request, Order $order)
    {
        $request->validate([
            'payment_method' => 'required|in:cash,bank,cod,online',
        ]);

<<<<<<< HEAD
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
=======
        $order->update([
            'payment_status' => 'paid',
            'payment_method' => $request->payment_method,
        ]);
>>>>>>> 61767df240e155b1a57b3b2a6192c15c2442ed87

        return redirect()->route('orders.edit', $order->id)
            ->with('success', 'Payment completed. Please mark as delivered.');
    }

    public function changeStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,preparing,ready,delivered,cancelled'
        ]);
        $updated = $order->changeStatus($request->status);
        if (!$updated) {
            return back()->withErrors('Invalid status update.');
        }
        if ($request->status === 'delivered') {
            $invoiceToken = 'INV-' . now()->format('Ymd') . '-' . Str::upper(Str::random(5));
            $order->update(['invoice_token' => $invoiceToken]);
            // On checkout/finish free the table if dine-in
            if ($order->order_type === 'dine_in' && $order->table_id && Schema::hasTable('restaurant_tables')) {
                RestaurantTable::where('id', $order->table_id)->update(['status' => 'available']);
            }
            return redirect()->route('orders.invoice', $order->id)
                ->with('success', 'Order delivered. Invoice generated.');
        }
        return back()->with('success', 'Order status updated to ' . $request->status . '.');
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
        if (!in_array($order->status, ['pending', 'confirmed', 'preparing'])) {
            return back()->withErrors('This order cannot be cancelled.');
        }
        $order->update(['status' => 'cancelled']);
        return back()->with('success', 'Order cancelled successfully.');
    }

    public function destroy(Order $order)
    {
        if ($order->status !== 'cancelled') {
            return back()->withErrors('Cancel the order before deleting.');
        }
        DB::transaction(function () use ($order) {
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
        $orders = Order::with('customer')
            ->where('status', 'delivered')
            ->orderByDesc('updated_at')
            ->paginate(20);

        return view('pages.erp.reports.delivered_invoices', compact('orders'));
    }
}
