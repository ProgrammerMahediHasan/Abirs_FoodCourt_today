<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    protected function transformOrder(Order $order): array
    {
        return [
            'id' => $order->id,
            'order_no' => $order->order_no,
            'status' => $order->status,
            'user_id' => $order->user_id,
            'customer_id' => $order->customer_id,
            'subtotal' => $order->subtotal,
            'discount' => $order->discount,
            'tax' => $order->tax,
            'total' => $order->total,
            'ordered_at' => $order->ordered_at,
            'customer' => $order->customer ? [
                'id' => $order->customer->id,
                'name' => $order->customer->name,
                'phone' => $order->customer->phone,
                'address' => $order->customer->address,
            ] : null,
            'items' => $order->items->map(function (OrderItem $item) {
                $menu = $item->menu;

                return [
                    'id' => $item->id,
                    'menu_id' => $item->menu_id,
                    'name' => $menu ? $menu->name : null,
                    'image_url' => $menu && $menu->image ? asset('storage/'.$menu->image) : null,
                    'quantity' => $item->quantity,
                    'unit_price' => $item->unit_price,
                    'total_price' => $item->total_price,
                ];
            })->values()->all(),
        ];
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer.name' => ['required', 'string', 'max:255'],
            'customer.phone' => ['required', 'string', 'max:50'],
            'customer.address' => ['required', 'string'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.menu_id' => ['required', 'integer', 'exists:menus,id'],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
            'total' => ['required', 'numeric', 'min:0'],
            'coupon_code' => ['nullable', 'string', 'max:50'],
        ]);

        return DB::transaction(function () use ($validated) {
            $customerData = $validated['customer'];

            $customer = Customer::firstOrCreate(
                ['phone' => $customerData['phone']],
                [
                    'name' => $customerData['name'],
                    'address' => $customerData['address'],
                ]
            );

            $restaurant = Restaurant::first();
            $user = auth('sanctum')->user();

            $order = Order::create([
                'order_no' => 'ORD-'.now()->format('YmdHis').'-'.mt_rand(100, 999),
                'customer_id' => $customer->id,
                'user_id' => $user?->id,
                'restaurant_id' => $restaurant?->id,
                'order_type' => 'delivery',
                'status' => 'pending',
                'subtotal' => 0,
                'total' => 0,
                'note' => null,
                'ordered_at' => now(),
                'payment_status' => null,
                'payment_method' => null,
            ]);

            $subtotal = 0;

            foreach ($validated['items'] as $item) {
                $menu = Menu::findOrFail($item['menu_id']);
                $quantity = $item['quantity'];
                $lineTotal = $menu->price * $quantity;

                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_id' => $menu->id,
                    'quantity' => $quantity,
                    'unit_price' => $menu->price,
                    'total_price' => $lineTotal,
                ]);

                $subtotal += $lineTotal;
            }

            $tax = round($subtotal * 0.05, 2);
            $discount = 0.0;

            $code = strtoupper(trim($validated['coupon_code'] ?? ''));
            if ($code !== '') {
                $coupon = \Illuminate\Support\Facades\DB::table('coupons')->where('code', $code)->first();
                if ($coupon && $coupon->active) {
                    $now = \Illuminate\Support\Carbon::now();
                    $start = $coupon->starts_at ? \Illuminate\Support\Carbon::parse($coupon->starts_at) : null;
                    $end = $coupon->expires_at ? \Illuminate\Support\Carbon::parse($coupon->expires_at) : null;
                    $validTime = (! $start || $now->gte($start))
                        && (! $end || $now->lte($end));
                    $validUses = (! $coupon->max_uses || $coupon->used < $coupon->max_uses);
                    if ($validTime && $validUses) {
                        if ($coupon->type === 'percent') {
                            $discount = round(($subtotal * (float) $coupon->value) / 100, 2);
                        } else {
                            $discount = round((float) $coupon->value, 2);
                        }
                        if ($discount > $subtotal) {
                            $discount = $subtotal;
                        }
                        // increment usage count (optimistic)
                        \Illuminate\Support\Facades\DB::table('coupons')->where('id', $coupon->id)->update([
                            'used' => ($coupon->used ?? 0) + 1,
                        ]);
                    }
                }
            }

            $order->update([
                'subtotal' => round($subtotal, 2),
                'discount' => $discount,
                'tax' => $tax,
                'total' => round($subtotal - $discount + $tax, 2),
            ]);

            return response()->json([
                'id' => $order->id,
                'order_no' => $order->order_no,
                'discount' => $order->discount,
                'total' => $order->total,
            ], 201);
        });
    }

    public function my(Request $request)
    {
        $user = auth('sanctum')->user();

        if (! $user) {
            return response()->json([], 200);
        }

        $orders = Order::with(['customer', 'items.menu'])
            ->where('user_id', $user->id)
            ->orderByDesc('ordered_at')
            ->limit(50)
            ->get();

        $data = $orders->map(function (Order $order) {
            return $this->transformOrder($order);
        });

        return response()->json($data);
    }

    public function show(Order $order)
    {
        $user = auth('sanctum')->user();

        if (! $user || $order->user_id !== $user->id) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $order->load(['customer', 'items.menu']);

        return response()->json($this->transformOrder($order));
    }
}
