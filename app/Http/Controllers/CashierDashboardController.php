<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CashierDashboardController extends Controller
{
    public function index(Request $request)
    {
        $today = Carbon::today();
        $approvedToday = Order::whereDate('updated_at', $today)->where('status', 'approved')->count();
        $pendingPayments = Order::where('status', 'approved')->where(function($q){
            $q->whereNull('payment_status')->orWhere('payment_status', '!=', 'paid');
        })->count();
        $paidToday = Order::whereDate('updated_at', $today)->where('payment_status', 'paid')->count();

        $readyOrders = Order::with(['customer','restaurant'])
            ->where('status', 'ready')
            ->orderBy('updated_at', 'desc')
            ->take(10)
            ->get();

        $pendingPaymentOrders = Order::with(['customer','restaurant'])
            ->where('status', 'approved')
            ->where(function($q){
                $q->whereNull('payment_status')->orWhere('payment_status', '!=', 'paid');
            })
            ->orderBy('updated_at', 'desc')
            ->take(10)
            ->get();

        $todaysOrders = Order::with(['customer','restaurant'])
            ->whereDate('created_at', $today)
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return view('pages.erp.cashier.index', compact(
            'approvedToday',
            'pendingPayments',
            'paidToday',
            'readyOrders',
            'pendingPaymentOrders',
            'todaysOrders'
        ));
    }
}
