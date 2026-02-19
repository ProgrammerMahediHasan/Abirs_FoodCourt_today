@extends('layout.erp.app')
@section('content')
<style>
    .hero { display:flex; align-items:center; justify-content:space-between; padding:22px 24px; border-radius:18px; background:linear-gradient(90deg,#ff7f50 0%, #ff6b45 28%, #f59e0b 65%, #10b981 100%); color:#fff; box-shadow:0 12px 28px rgba(0,0,0,0.12); margin-bottom:22px; }
    .hero-title { font-size:28px; font-weight:800; letter-spacing:-0.5px; }
    .hero-sub { font-size:14px; opacity:.95; }
    .hero-stats { display:flex; gap:16px; }
    .hero-pill { background:rgba(255,255,255,.2); padding:10px 14px; border-radius:12px; font-weight:700; }
    .panel { background:#fff; border-radius:16px; box-shadow:0 10px 24px rgba(0,0,0,0.08); padding:18px; }
    .panel-head { display:flex; justify-content:space-between; align-items:center; margin-bottom:10px; }
    .filter-tabs { display:flex; gap:8px; }
    .tab { padding:8px 12px; border-radius:10px; background:#f3f4f6; font-weight:600; color:#374151; }
    .orders-grid { display:grid; grid-template-columns: repeat(2, 1fr); gap:14px; }
    .order-card { background:#fff; border-radius:14px; box-shadow:0 8px 20px rgba(0,0,0,0.06); padding:16px; border:1px solid #f1f5f9; }
    .order-head { display:flex; justify-content:space-between; align-items:center; margin-bottom:12px; }
    .order-no { font-weight:700; color:#ff7f50; }
    .order-meta { font-size:12px; color:#6b7280; }
    .order-items { font-size:13px; color:#374151; }
    .order-actions { display:flex; gap:10px; margin-top:14px; }
    .btn { border:none; border-radius:10px; padding:9px 14px; cursor:pointer; font-weight:700; }
    .btn-prep { background:#f59e0b; color:#fff; }
    .btn-ready { background:#10b981; color:#fff; }
    .badge { padding:6px 10px; border-radius:999px; font-size:12px; font-weight:700; }
    .badge-confirmed { background:rgba(16,185,129,.14); color:#065f46; }
    .badge-preparing { background:rgba(245,158,11,.14); color:#7c2d12; }
    @media (max-width: 992px){ .orders-grid{ grid-template-columns: 1fr; } .hero-title{ font-size:24px; } }
</style>

<div class="hero">
    <div>
        <div class="hero-title">Welcome to Kitchen Dashboard</div>
        <div class="hero-sub">{{ \Carbon\Carbon::now('Asia/Dhaka')->format('l, d M Y') }}</div>
    </div>
    <div class="hero-stats">
        <div class="hero-pill">Preparing: {{ $preparing }}</div>
        <div class="hero-pill">Ready: {{ $ready }}</div>
    </div>
    </div>

<div class="panel">
    <div class="panel-head">
        <div class="fw-bold">Active Orders</div>
        <div class="filter-tabs">
            <div class="tab">All</div>
            <div class="tab">Preparing</div>
            <div class="tab">Ready</div>
        </div>
    </div>
    <div class="orders-grid">
        @foreach($orders as $order)
        <div class="order-card">
            <div class="order-head">
                <div>
                    <div class="order-no">#{{ $order->order_no ?? $order->id }}</div>
                    <div class="order-meta">{{ optional($order->customer)->name }} • {{ optional($order->restaurant)->name }}</div>
                </div>
                <div>
                    @if($order->status === 'preparing') <span class="badge badge-preparing">Preparing</span>
                    @elseif($order->status === 'ready') <span class="badge badge-confirmed">Ready</span>
                    @endif
                </div>
            </div>
            <div class="order-items">
                @foreach($order->items as $it)
                    <div>• {{ $it->menu->name ?? 'Item' }} × {{ $it->quantity }}</div>
                @endforeach
            </div>
            <div class="order-actions">
                @can('orders.status')
                    @if(in_array($order->status, ['pending','confirmed']))
                    <form method="POST" action="{{ route('orders.status', $order->id) }}">
                        @method('PATCH') @csrf
                        <input type="hidden" name="status" value="preparing">
                        <button class="btn btn-prep" type="submit">Mark Preparing</button>
                    </form>
                    @endif
                    @if($order->status === 'preparing')
                    <form method="POST" action="{{ route('orders.status', $order->id) }}">
                        @method('PATCH') @csrf
                        <input type="hidden" name="status" value="ready">
                        <button class="btn btn-ready" type="submit">Mark Ready</button>
                    </form>
                    @endif
                @endcan
            </div>
        </div>
        @endforeach
    </div>
    <div class="mt-3">
        {{ $orders->links() }}
    </div>
</div>
@endsection
