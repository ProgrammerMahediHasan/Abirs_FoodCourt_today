@extends('layout.erp.app')

@section('dashboard')
Welcome to Abir's FoodCourt
@endsection

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Restaurant Tables</h4>
        <a href="{{ route('tables.create')}}" class="btn mb-3"
           style="color: #000000be; background-color: #FF7F50; border-color: #FF7F50; font-weight: 500; transition: all 0.3s ease;">
            <i class="fa fa-plus"></i> Add Tables
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover align-middle table-bordered">
            <thead class="table-dark text-center">
                <tr>
                    <th style="background-color:#FF7F50;color:#000;">SL</th>
                    <th style="background-color:#FF7F50;color:#000;">Restaurant</th>
                    <th style="background-color:#FF7F50;color:#000;">Table</th>
                    <th style="background-color:#FF7F50;color:#000;">Capacity</th>
                    <th style="background-color:#FF7F50;color:#000;">Status</th>
                    <th style="background-color:#FF7F50;color:#000;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tables as $index => $table)
                    <tr>
                        <td>{{ $tables->firstItem() + $index }}</td>
                        <td>{{ $table->restaurant->name ?? 'N/A' }}</td>
                        <td>{{ $table->name }}</td>
                        <td>{{ $table->capacity }}</td>
                        <td>
                            @php
                                $badgeClass = match($table->status) {
                                    'available' => 'bg-success',
                                    'booked' => 'bg-info',
                                    'occupied' => 'bg-warning',
                                    default => 'bg-secondary'
                                };
                            @endphp
                            <span class="badge {{ $badgeClass }}">{{ ucfirst($table->status) }}</span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('tables.edit', $table->id) }}" class="btn btn-sm btn-outline-secondary" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('tables.destroy', $table->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this table?')" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No tables found. Add your first table.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $tables->links() }}
    </div>
</div>
@endsection
