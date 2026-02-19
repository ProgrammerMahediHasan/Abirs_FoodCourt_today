<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class PaymentController extends Controller
{
    public function index()
    {
        $orders = Order::where('status', 'approved')->orderBy('ordered_at', 'desc')->get();

        return view('pages.erp.payments.index', compact('orders'));
    }
}
