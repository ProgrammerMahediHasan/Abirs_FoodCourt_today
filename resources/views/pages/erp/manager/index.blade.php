@extends('layout.erp.app')
@section('content')
<div class="container py-4">
    <style>
        :root { --coral:#FF7F50; --coral-dark:#e66b42; }
        .metric-card { border: none; border-radius: 12px; box-shadow: 0 8px 20px rgba(0,0,0,0.08); }
        .metric-icon { width:44px; height:44px; display:flex; align-items:center; justify-content:center; border-radius:50%; background: var(--coral); color:#fff; }
        .metric-value { font-size: 28px; font-weight: 700; }
        .section-title { font-weight: 700; }
        .coral-header { background: var(--coral); color:#000; }
        .table-dashboard { table-layout: auto; width:100%; }
        .table-dashboard th, .table-dashboard td { white-space: normal; word-break: break-word; }
        .w-ord { width: 20%; }
        .w-cust { width: 25%; }
        .w-status { width: 15%; }
        .w-total { width: 15%; }
        .w-date { width: 25%; }
    </style>
    <div class="d-flex justify-content-between align-items-center mb-4">
        {{-- <h2 class="section-title mb-0">Manager Dashboard</h2> --}}
        <div class="btn-group">
            <a href="#orders" class="btn btn-outline-dark btn-sm">Orders</a>
            <a href="#staff" class="btn btn-outline-dark btn-sm">Staff</a>
            <a href="#reports" class="btn btn-outline-dark btn-sm">Reports</a>
            <a href="#inventory" class="btn btn-outline-dark btn-sm">Inventory</a>
        </div>
    </div>

    <div class="mb-3 p-3" style="background:#FF7F50;border-radius:10px;border:1px solid #FF7F50;color:#000;font-weight:700;">
        Welcome to Manager Dashboard
    </div>

    <div class="row g-3">
        <div class="col-lg-3 col-sm-6">
            <div class="card metric-card">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-muted">Total Orders</div>
                        <div class="metric-value">{{ $totalOrders ?? 0 }}</div>
                    </div>
                    <div class="metric-icon"><i class="fas fa-shopping-cart"></i></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card metric-card">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-muted">Total Revenue</div>
                        <div class="metric-value">৳{{ number_format($totalRevenue ?? 0,2) }}</div>
                    </div>
                    <div class="metric-icon"><i class="fas fa-coins"></i></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card metric-card">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-muted">Pending Orders</div>
                        <div class="metric-value">{{ $orderCounts['pending'] ?? 0 }}</div>
                    </div>
                    <div class="metric-icon"><i class="fas fa-hourglass-half"></i></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card metric-card">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-muted">Low Stock</div>
                        <div class="metric-value">{{ $lowStockCount ?? 0 }}</div>
                    </div>
                    <div class="metric-icon"><i class="fas fa-boxes"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 mt-3">
        <div class="col-md-2"><div class="card metric-card"><div class="card-body text-center"><div class="text-muted">Preparing</div><div class="metric-value">{{ $orderCounts['preparing'] ?? 0 }}</div></div></div></div>
        <div class="col-md-2"><div class="card metric-card"><div class="card-body text-center"><div class="text-muted">Ready</div><div class="metric-value">{{ $orderCounts['ready'] ?? 0 }}</div></div></div></div>
        <div class="col-md-2"><div class="card metric-card"><div class="card-body text-center"><div class="text-muted">Delivered</div><div class="metric-value">{{ $orderCounts['delivered'] ?? 0 }}</div></div></div></div>
        <div class="col-md-2"><div class="card metric-card"><div class="card-body text-center"><div class="text-muted">Cancelled</div><div class="metric-value">{{ $orderCounts['cancelled'] ?? 0 }}</div></div></div></div>
        <div class="col-md-2"><div class="card metric-card"><div class="card-body text-center"><div class="text-muted">Stock Out</div><div class="metric-value">{{ $stockOutCount ?? 0 }}</div></div></div></div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6" id="orders">
            <div class="card">
                <div class="card-header coral-header">Latest Orders</div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table class="table table-sm table-bordered table-striped table-dashboard">
                        <thead>
                            <tr>
                                <th class="w-ord">Order</th>
                                <th class="w-cust">Customer</th>
                                <th class="w-status">Status</th>
                                <th class="w-total text-end">Total</th>
                                <th class="w-date">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($latestOrders as $o)
                            <tr>
                                <td>{{ $o->order_no }}</td>
                                <td>{{ $o->customer->name ?? 'Walk-in' }}</td>
                                <td>{{ ucfirst($o->status) }}</td>
                                <td class="text-end">৳{{ number_format($o->total,2) }}</td>
                                <td>{{ $o->ordered_at->format('d M, h:i A') }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center">No recent orders</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6" id="staff">
            <div class="card">
                <div class="card-header coral-header">Staff Overview</div>
                <div class="card-body">
                    <div class="mb-2">Kitchen Staff: <strong>{{ $kitchenCount }}</strong>, Cashier: <strong>{{ $cashierCount }}</strong></div>
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($staffList as $s)
                            <tr>
                                <td>{{ $s['name'] }}</td>
                                <td>{{ $s['role'] }}</td>
                                <td>{{ $s['status'] }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="text-center">No staff</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6" id="reports">
            <div class="card">
                <div class="card-header coral-header">Reports Summary</div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col"><div class="p-3 border rounded">Daily Sales<br><strong>৳{{ number_format($todaySales,2) }}</strong></div></div>
                        <div class="col"><div class="p-3 border rounded">Weekly Sales<br><strong>৳{{ number_format($weekSales,2) }}</strong></div></div>
                        <div class="col"><div class="p-3 border rounded">Monthly Sales<br><strong>৳{{ number_format($monthSales,2) }}</strong></div></div>
                    </div>
                    <div class="mt-3">Cancelled Orders: <strong>{{ $cancelledCount }}</strong>, Returned/Refunded: <strong>{{ $returnedCount }}</strong></div>
                    <table class="table table-sm table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>Top Item</th>
                                <th class="text-end">Qty</th>
                                <th class="text-end">Revenue</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($topItems as $t)
                            <tr>
                                <td>{{ $t['item'] }}</td>
                                <td class="text-end">{{ $t['qty'] }}</td>
                                <td class="text-end">৳{{ number_format($t['revenue'],2) }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="text-center">No data</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6" id="inventory">
            <div class="card">
                <div class="card-header coral-header">Inventory Summary</div>
                <div class="card-body">
                    <div class="mb-2">Total Stock Items: <strong>{{ $totalStockItems }}</strong></div>
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th class="text-end">Qty</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($lowStockItems as $m)
                            <tr>
                                <td>{{ $m->name }}</td>
                                <td class="text-end">{{ $m->stock?->current_quantity ?? 0 }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="2" class="text-center">No low stock items</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
