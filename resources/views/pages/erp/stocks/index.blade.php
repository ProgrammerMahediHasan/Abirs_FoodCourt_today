@extends('layout.erp.app')

@section('dashboard')
Welcome to Abir's FoodCourt
@endsection

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="mb-0">Stock Inventory</h3>
            <small class="text-muted">Manage and review current stock levels</small>
        </div>
        <a href="{{ route('stocks.create') }}" class="btn btn-dark btn-sm">
            <i class="fas fa-plus me-1"></i> Add New Stock
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="row g-2 mb-3 align-items-center">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input id="stockSearch" type="text" class="form-control border-start-0" placeholder="Search by menu name..." oninput="filterStocks()">
                    </div>
                </div>
                <div class="col-md-8 text-end">
                    <span class="badge bg-secondary">Total: {{ $stocks->total() }}</span>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Item</th>
                            <th class="text-end">Quantity</th>
                            <th>Unit</th>
                            <th>Last Updated</th>
                            <th>Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="stocksTable">
                        @foreach($stocks as $stock)
                        @php
                            $qty = (float)($stock->current_quantity ?? 0);
                            $status = $qty <= 0 ? 'Out of Stock' : 'In Stock';
                            $badge = $qty <= 0 ? 'danger' : 'success';
                        @endphp
                        <tr data-name="{{ strtolower($stock->menu->name) }}">
                            <td>
                                <div class="d-flex align-items-center">
                                    <div>
                                        <div class="fw-semibold">{{ $stock->menu->name }}</div>
                                        <div class="text-muted small">Stock ID: {{ $stock->id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-end">
                                <span class="badge bg-{{ $badge }} px-3 py-2">{{ number_format($qty, 2) }}</span>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark">{{ $stock->unit ?? 'pcs' }}</span>
                            </td>
                            <td>
                                <span class="text-muted small">{{ optional($stock->updated_at)->format('d M Y, h:i A') }}</span>
                            </td>
                            <td>
                                <span class="badge bg-{{ $badge }}">{{ $status }}</span>
                            </td>
                            <td class="text-end">
                                <button
                                    type="button"
                                    class="btn btn-primary btn-sm me-2"
                                    data-bs-toggle="modal"
                                    data-bs-target="#restockModal-{{ $stock->id }}"
                                >
                                    Restock
                                </button>
                                <form action="{{ route('stocks.destroy', $stock->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Delete this stock entry?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <div class="modal fade" id="restockModal-{{ $stock->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Restock: {{ $stock->menu->name }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="POST" action="{{ route('stocks.restock', $stock->id) }}">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">Quantity</label>
                                                <input type="number" name="quantity" step="0.01" min="0.01" class="form-control" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Unit</label>
                                                <input type="text" name="unit" class="form-control" value="{{ $stock->unit ?? 'pcs' }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Reference</label>
                                                <input type="text" name="reference" class="form-control" placeholder="e.g., Purchase #123">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Add Stock</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="text-muted small">
                    Showing {{ $stocks->firstItem() }}–{{ $stocks->lastItem() }} of {{ $stocks->total() }}
                </div>
                {{ $stocks->links() }}
            </div>
        </div>
    </div>
</div>

<script>
function filterStocks() {
    const term = (document.getElementById('stockSearch').value || '').toLowerCase();
    document.querySelectorAll('#stocksTable tr').forEach((row) => {
        const name = row.getAttribute('data-name') || '';
        row.style.display = (!term || name.includes(term)) ? '' : 'none';
    });
}
</script>
@endsection
