@extends('layout.erp.app')
@section('content')
<div class="container py-4">
    <style>
        :root { --coral:#FF7F50; --coral-dark:#e66b42; }
        .welcome-banner { background: var(--coral); border:1px solid var(--coral); color:#000; border-radius:12px; font-weight:700; }
        .metric-card { border: none; border-radius: 12px; box-shadow: 0 8px 20px rgba(0,0,0,0.08); }
        .metric-icon { width:44px; height:44px; display:flex; align-items:center; justify-content:center; border-radius:50%; background: var(--coral); color:#fff; }
        .metric-value { font-size: 28px; font-weight: 700; }
    </style>
    <div class="p-3 mb-3 welcome-banner">
        Welcome to Cashier Dashboard
    </div>
    <div class="row g-3">
        <div class="col-md-4">
            <div class="card metric-card">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-muted">Approved Today</div>
                        <div class="metric-value">{{ $approvedToday ?? 0 }}</div>
                    </div>
                    <div class="metric-icon"><i class="fas fa-thumbs-up"></i></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card metric-card">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-muted">Pending Payments</div>
                        <div class="metric-value">{{ $pendingPayments ?? 0 }}</div>
                    </div>
                    <div class="metric-icon"><i class="fas fa-money-bill-wave"></i></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card metric-card">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-muted">Paid Today</div>
                        <div class="metric-value">{{ $paidToday ?? 0 }}</div>
                    </div>
                    <div class="metric-icon"><i class="fas fa-receipt"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header" style="background: var(--coral); color:#000;">Ready Orders</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th>Order</th>
                                    <th>Customer</th>
                                    <th>Status</th>
                                    <th class="text-end">Total</th>
                                    <th>Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($readyOrders as $o)
                                <tr>
                                    <td>{{ $o->order_no }}</td>
                                    <td>{{ $o->customer->name ?? 'Walk-in' }}</td>
                                    <td>{{ ucfirst($o->status) }}</td>
                                    <td class="text-end">৳{{ number_format($o->total,2) }}</td>
                                    <td>{{ $o->updated_at->format('d M, h:i A') }}</td>
                                </tr>
                                @empty
                                <tr><td colspan="5" class="text-center">No ready orders</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header" style="background: var(--coral); color:#000;">Pending Payment Orders</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th>Order</th>
                                    <th>Customer</th>
                                    <th>Status</th>
                                    <th class="text-end">Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pendingPaymentOrders as $o)
                                <tr>
                                    <td>{{ $o->order_no }}</td>
                                    <td>{{ $o->customer->name ?? 'Walk-in' }}</td>
                                    <td>{{ ucfirst($o->status) }}</td>
                                    <td class="text-end">৳{{ number_format($o->total,2) }}</td>
                                    <td>
                                        @can('manage.payment')
                                        <a href="{{ route('orders.payment.form', $o->id) }}" class="btn btn-warning btn-sm">Make Payment</a>
                                        @endcan
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="5" class="text-center">No pending payments</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header" style="background: var(--coral); color:#000;">Today’s Orders</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th>Order</th>
                                    <th>Customer</th>
                                    <th>Status</th>
                                    <th class="text-end">Total</th>
                                    <th>Time</th>
                                    <th>Invoice</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($todaysOrders as $o)
                                <tr>
                                    <td>{{ $o->order_no }}</td>
                                    <td>{{ $o->customer->name ?? 'Walk-in' }}</td>
                                    <td>{{ ucfirst($o->status) }}</td>
                                    <td class="text-end">৳{{ number_format($o->total,2) }}</td>
                                    <td>{{ $o->ordered_at->format('d M, h:i A') }}</td>
                                    <td>
                                        @if($o->invoice_token)
                                            <a href="{{ route('orders.invoice', $o->id) }}" class="btn btn-info btn-sm">View</a>
                                        @else
                                            —
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="6" class="text-center">No orders today</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
