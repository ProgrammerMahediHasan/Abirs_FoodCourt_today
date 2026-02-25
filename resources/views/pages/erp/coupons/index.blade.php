@extends('layout.erp.app')

@section('dashboard')
Coupons
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h3 class="text-dark">Coupons</h3>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="mb-3">Create new coupon</h5>
            <form method="POST" action="{{ route('coupons.store') }}" class="row g-3">
                @csrf
                <div class="col-md-3">
                    <label class="form-label">Code</label>
                    <input type="text" name="code" class="form-control" placeholder="SAVE10" required>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Type</label>
                    <select name="type" class="form-select">
                        <option value="amount">Fixed amount</option>
                        <option value="percent">Percent</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Value</label>
                    <input type="number" name="value" step="0.01" min="0" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Starts at</label>
                    <input type="datetime-local" name="starts_at" class="form-control">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Expires at</label>
                    <input type="datetime-local" name="expires_at" class="form-control">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Max uses</label>
                    <input type="number" name="max_uses" min="1" class="form-control">
                </div>
                <div class="col-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Create coupon</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="mb-3">Existing coupons</h5>
            @if($coupons->isEmpty())
                <p class="text-muted mb-0">No coupons created yet.</p>
            @else
            <div class="row g-3">
                @foreach($coupons as $coupon)
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-2">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="badge bg-dark px-3 py-2">{{ $coupon->code }}</span>
                                    <span class="badge {{ $coupon->type === 'percent' ? 'bg-primary' : 'bg-secondary' }} px-3 py-2">
                                        {{ ucfirst($coupon->type) }} {{ number_format($coupon->value, 2) }}{{ $coupon->type === 'percent' ? '%' : '' }}
                                    </span>
                                </div>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="small text-muted">
                                        Usage:
                                        <span class="fw-semibold">
                                            {{ $coupon->used ?? 0 }}
                                            @if($coupon->max_uses)
                                                / {{ $coupon->max_uses }}
                                            @else
                                                / Unlimited
                                            @endif
                                        </span>
                                    </div>
                                    <form id="coupon-active-{{ $coupon->id }}" method="POST" action="{{ route('coupons.update', $coupon->id) }}">
                                        @csrf
                                        <input type="hidden" name="code" value="{{ $coupon->code }}">
                                        <input type="hidden" name="type" value="{{ $coupon->type }}">
                                        <input type="hidden" name="value" value="{{ $coupon->value }}">
                                        <input type="hidden" name="starts_at" value="{{ $coupon->starts_at }}">
                                        <input type="hidden" name="expires_at" value="{{ $coupon->expires_at }}">
                                        <input type="hidden" name="max_uses" value="{{ $coupon->max_uses }}">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="active" value="1" {{ $coupon->active ? 'checked' : '' }} onchange="document.getElementById('coupon-active-{{ $coupon->id }}').submit()">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <div class="text-muted small">Valid from</div>
                                    <div class="fw-semibold">
                                        {{ $coupon->starts_at ? \Illuminate\Support\Carbon::parse($coupon->starts_at)->format('d M Y, h:i A') : '—' }}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="text-muted small">Valid to</div>
                                    <div class="fw-semibold">
                                        {{ $coupon->expires_at ? \Illuminate\Support\Carbon::parse($coupon->expires_at)->format('d M Y, h:i A') : '—' }}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="text-muted small">Max uses</div>
                                    <div class="fw-semibold">
                                        {{ $coupon->max_uses ?? 'Unlimited' }}
                                    </div>
                                </div>
                                <div class="col-md-3 text-md-end">
                                    <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#edit-{{ $coupon->id }}">
                                        Edit
                                    </button>
                                    <form method="POST" action="{{ route('coupons.destroy', $coupon->id) }}" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this coupon?')">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div id="edit-{{ $coupon->id }}" class="collapse mt-3">
                                <form id="coupon-form-{{ $coupon->id }}" method="POST" action="{{ route('coupons.update', $coupon->id) }}" class="row g-3">
                                    @csrf
                                    <div class="col-md-3">
                                        <label class="form-label">Code</label>
                                        <input type="text" name="code" class="form-control form-control-sm" value="{{ $coupon->code }}" maxlength="50" required>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Type</label>
                                        <select name="type" class="form-select form-select-sm">
                                            <option value="amount" {{ $coupon->type === 'amount' ? 'selected' : '' }}>Amount</option>
                                            <option value="percent" {{ $coupon->type === 'percent' ? 'selected' : '' }}>Percent</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Value</label>
                                        <input type="number" name="value" step="0.01" min="0" class="form-control form-control-sm" value="{{ number_format($coupon->value, 2, '.', '') }}" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Starts at</label>
                                        <input type="datetime-local" name="starts_at" class="form-control form-control-sm" value="{{ $coupon->starts_at ? \Illuminate\Support\Carbon::parse($coupon->starts_at)->format('Y-m-d\\TH:i') : '' }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Expires at</label>
                                        <input type="datetime-local" name="expires_at" class="form-control form-control-sm" value="{{ $coupon->expires_at ? \Illuminate\Support\Carbon::parse($coupon->expires_at)->format('Y-m-d\\TH:i') : '' }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Max uses</label>
                                        <input type="number" name="max_uses" min="1" class="form-control form-control-sm" value="{{ $coupon->max_uses }}">
                                    </div>
                                    <div class="col-md-2 d-flex align-items-end">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="active" value="1" {{ $coupon->active ? 'checked' : '' }}>
                                            <label class="form-check-label">Active</label>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-sm btn-dark">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="mt-3">
                {{ $coupons->links('pagination::bootstrap-5') }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
