@extends('layout.erp.app')
@section('content')
<div class="container-fluid py-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="mb-1" style="color:#FF7F50; font-weight:700;">Delivered Invoices Report</h3>
            <div class="text-muted">Finalized and paid orders with generated invoices</div>
        </div>
        <div>
            {{-- <a href="{{ request()->fullUrlWithQuery(['print'=>1]) }}" class="btn btn-outline-dark btn-sm"> --}}
                {{-- Print
            </a> --}}
        </div>
    </div>

    <div class="row g-3 mb-3">
        <div class="col-md-3">
            <div class="card h-100">
                <div class="card-body">
                    <div class="text-muted">Total Invoices</div>
                    <div class="h4 mb-0">{{ $summaryCount ?? $orders->total() }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card h-100">
                <div class="card-body">
                    <div class="text-muted">Total Amount</div>
                    <div class="h4 mb-0">৳{{ number_format(($summaryAmount ?? $orders->sum('total')),2) }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Invoice</th>
                            <th>Order No</th>
                            <th>Customer</th>
                            <th class="text-end">Amount</th>
                            <th>Payment</th>
                            <th>Delivered At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                        <tr>
                            <td class="fw-semibold">{{ $order->invoice_token }}</td>
                            <td>#{{ $order->order_no }}</td>
                            <td>{{ $order->customer->name ?? 'Walk-in' }}</td>
                            <td class="text-end">৳{{ number_format($order->total,2) }}</td>
                            <td><span class="badge bg-dark">{{ strtoupper($order->payment_method) }}</span></td>
                            <td>{{ optional($order->updated_at)->format('M d, Y h:i A') }}</td>
                            <td>
                                <a href="{{ route('orders.invoice', $order->id) }}?from=delivered_report"
                                   class="btn btn-sm btn-light border"
                                   title="View Invoice" aria-label="View Invoice">
                                    <i class="fas fa-receipt text-warning" style="font-size:1.1rem;"></i>
                                </a>
                                <a href="{{ route('orders.show', $order->id) }}?from=delivered_report"
                                   class="btn btn-sm btn-light border"
                                   title="Details" aria-label="Details">
                                    <i class="fas fa-eye text-info" style="font-size:1.1rem;"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">No delivered invoices found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
