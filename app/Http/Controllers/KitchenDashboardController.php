<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;

class KitchenDashboardController extends Controller
{
    public function index(Request $request)
    {
        $today = Carbon::today();
        $preparing = Order::whereDate('created_at', $today)->where('status', 'preparing')->count();
        $ready = Order::whereDate('created_at', $today)->where('status', 'ready')->count();

        $orders = Order::with(['customer', 'items.menu', 'restaurant'])
            ->whereIn('status', ['pending','confirmed','preparing','ready'])
            ->orderBy('updated_at', 'desc')
            ->paginate(12);

        return view('pages.erp.kitchen.index', compact('orders', 'preparing', 'ready'));
    }
}
