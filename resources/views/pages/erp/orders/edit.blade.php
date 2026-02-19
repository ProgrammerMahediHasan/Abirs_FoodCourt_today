@extends('layout.erp.app')
@section('dashboard')
Welcome to Abir's FoodCourt
@endsection
@section('content')
<div class="container py-4">
    <h3>Confirm Order #{{ $order->order_no }}</h3>
    <p>Customer: {{ $order->customer->name ?? 'Walk-in Customer' }}</p>
    <p>Order Date: {{ $order->ordered_at->format('M d, Y h:i A') }}</p>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Item</th>
                <th>Qty</th>
                <th>Unit Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
            <tr>
                <td>{{ $item->menu->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>৳{{ number_format($item->unit_price,2) }}</td>
                <td>৳{{ number_format($item->total_price,2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <p><strong>Subtotal:</strong> ৳{{ number_format($order->subtotal,2) }}</p>
    <p><strong>Total:</strong> ৳{{ number_format($order->total,2) }}</p>

    @unlessrole('Cashier')
    <form method="POST" action="{{ route('orders.confirm', $order->id) }}" onsubmit="return confirm('Approve and confirm this order?');">
        @csrf
        @method('PATCH')
        <button type="submit" class="btn btn-success">Confirm Order</button>
    </form>
    @endunlessrole

    @if($order->status == 'approved' && $order->payment_status !== 'paid')
        @can('manage.payment')
        <a href="{{ route('orders.payment.form', $order->id) }}" class="btn btn-warning mt-3">Make Payment</a>
        @endcan
    @endif

    {{-- After payment, delivered handled automatically --}}
</div>
@endsection
