<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Menu;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ManagerDashboardController extends Controller
{
    public function index()
    {
        $statuses = ['pending','preparing','ready','delivered','cancelled'];
        $orderCounts = [];
        foreach ($statuses as $s) {
            $orderCounts[$s] = Order::where('status', $s)->count();
        }
        $totalOrders = Order::count();
        $totalRevenue = Order::where('status','delivered')->sum('total');

        $latestOrders = Order::with(['customer'])
            ->orderByDesc('ordered_at')
            ->take(5)
            ->get(['id','order_no','customer_id','status','total','ordered_at']);

        $kitchenCount = User::role('Kitchen Staff')->count();
        $cashierCount = User::role('Cashier')->count();
        $staffList = User::whereHas('roles', function($q){
                $q->whereIn('name', ['Kitchen Staff','Cashier']);
            })
            ->orderBy('name')
            ->get(['id','name','email'])
            ->map(function($u){
                return [
                    'name' => $u->name,
                    'email' => $u->email,
                    'role' => $u->roles->pluck('name')->implode(', '),
                    'status' => 'Active'
                ];
            });

        $todaySales = Order::where('status','delivered')
            ->whereDate('ordered_at', Carbon::today())
            ->sum('total');
        $weekSales = Order::where('status','delivered')
            ->whereBetween('ordered_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->sum('total');
        $monthSales = Order::where('status','delivered')
            ->whereBetween('ordered_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
            ->sum('total');

        $topItems = OrderItem::select('menu_id', DB::raw('SUM(quantity) as qty'), DB::raw('SUM(total_price) as revenue'))
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->where('orders.status', 'delivered')
            ->groupBy('menu_id')
            ->orderByDesc('qty')
            ->take(5)
            ->get()
            ->map(function($row){
                $menu = Menu::find($row->menu_id);
                return [
                    'item' => $menu?->name ?? 'Unknown',
                    'qty' => (int)$row->qty,
                    'revenue' => (float)$row->revenue
                ];
            });

        $cancelledCount = Order::where('status','cancelled')->count();
        $returnedCount = Order::where('payment_status','refunded')->count();

        $totalStockItems = Menu::whereHas('stock')->count();
        $lowStockItems = Menu::with('stock')
            ->whereHas('stock', function($q){ $q->where('current_quantity','<=',5); })
            ->get();
        $lowStockCount = $lowStockItems->count();
        $stockOutCount = Menu::whereHas('stock', function($q){ $q->where('current_quantity','<=',0); })->count();

        return view('pages.erp.manager.index', compact(
            'orderCounts',
            'totalOrders',
            'totalRevenue',
            'latestOrders',
            'kitchenCount',
            'cashierCount',
            'staffList',
            'todaySales',
            'weekSales',
            'monthSales',
            'topItems',
            'cancelledCount',
            'returnedCount',
            'totalStockItems',
            'lowStockItems',
            'lowStockCount',
            'stockOutCount'
        ));
    }
}
