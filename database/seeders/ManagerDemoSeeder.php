<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Stock;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use Spatie\Permission\Models\Role;

class ManagerDemoSeeder extends Seeder
{
    public function run(): void
    {
        $managerRole = Role::firstOrCreate(['name' => 'Manager', 'guard_name' => 'web']);
        $cashierRole = Role::firstOrCreate(['name' => 'Cashier', 'guard_name' => 'web']);
        $kitchenRole = Role::firstOrCreate(['name' => 'Kitchen Staff', 'guard_name' => 'web']);

        $manager = User::firstOrCreate(
            ['email' => 'manager@foodcourt.local'],
            ['name' => 'Demo Manager', 'password' => Hash::make('password'), 'role' => 'Manager']
        );
        $manager->assignRole($managerRole);

        $cashier = User::firstOrCreate(
            ['email' => 'cashier@foodcourt.local'],
            ['name' => 'Demo Cashier', 'password' => Hash::make('password'), 'role' => 'Cashier']
        );
        $cashier->assignRole($cashierRole);

        $kitchen = User::firstOrCreate(
            ['email' => 'kitchen2@foodcourt.local'],
            ['name' => 'Demo Kitchen', 'password' => Hash::make('password'), 'role' => 'Kitchen Staff']
        );
        $kitchen->assignRole($kitchenRole);

        $cat = Category::firstOrCreate(['name' => 'Burgers'], ['description' => 'Tasty burgers', 'is_active' => true]);
        $menu1 = Menu::firstOrCreate(['name' => 'Classic Burger'], ['category_id' => $cat->id, 'price' => 250, 'status' => true]);
        $menu2 = Menu::firstOrCreate(['name' => 'Cheese Burger'], ['category_id' => $cat->id, 'price' => 280, 'status' => true]);
        $menu3 = Menu::firstOrCreate(['name' => 'Veg Burger'], ['category_id' => $cat->id, 'price' => 200, 'status' => true]);

        Stock::firstOrCreate(['menu_id' => $menu1->id], ['current_quantity' => 10, 'unit' => 'pcs']);
        Stock::firstOrCreate(['menu_id' => $menu2->id], ['current_quantity' => 3, 'unit' => 'pcs']);
        Stock::firstOrCreate(['menu_id' => $menu3->id], ['current_quantity' => 1, 'unit' => 'pcs']);

        $cust = Customer::firstOrCreate(['phone' => '01700000000'], ['name' => 'Demo Customer', 'email' => 'demo@local', 'status' => 'active']);

        // Create sample orders across statuses
        $statuses = ['pending','preparing','ready','delivered','cancelled'];
        foreach ($statuses as $i => $st) {
            $order = Order::create([
                'order_no' => 'ORD-DEMO-' . now()->timestamp . $i,
                'customer_id' => $cust->id,
                'restaurant_id' => 1,
                'order_type' => 'takeaway',
                'status' => $st,
                'subtotal' => 0,
                'tax' => 0,
                'discount' => 0,
                'total' => 0,
                'ordered_at' => now()->subDays(1),
                'payment_status' => $st === 'delivered' ? 'paid' : null
            ]);
            $qty = 1 + $i;
            foreach ([$menu1, $menu2] as $m) {
                $line = $m->price * $qty;
                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_id' => $m->id,
                    'quantity' => $qty,
                    'unit_price' => $m->price,
                    'total_price' => $line
                ]);
                $order->subtotal += $line;
                $qty++;
            }
            $order->tax = round($order->subtotal * 0.05, 2);
            $order->total = $order->subtotal + $order->tax;
            $order->save();
        }
    }
}
