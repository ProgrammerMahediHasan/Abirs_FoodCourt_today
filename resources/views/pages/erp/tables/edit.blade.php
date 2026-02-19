@extends('layout.erp.app')

@section('dashboard')
Welcome to Abir's FoodCourt
@endsection

@section('content')
<style>
    :root{
        --coral: #FF7F50;
        --coral-dark: #ff6b3d;
        --coral-light: #fff1ec;
    }
    .table-wrapper{
        max-width: 1200px;
        margin: auto;
    }
    .table-card{
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 12px 35px rgba(0,0,0,.08);
        overflow: hidden;
    }
    .table-card-header{
        background: linear-gradient(135deg, var(--coral), var(--coral-dark));
        color: #fff;
        padding: 20px 30px;
        display: flex;
        align-items: center;
    }
    .table-card-header h4{
        margin: 0;
        font-weight: 600;
        letter-spacing: .3px;
    }
    .table-card-body{
        padding: 32px;
    }
    .form-label{
        font-weight: 600;
        color: #444;
        margin-bottom: 6px;
    }
    .form-control, .form-select{
        border-radius: 10px;
        padding: 12px 14px;
    }
    .form-control:focus, .form-select:focus{
        border-color: var(--coral);
        box-shadow: 0 0 0 .2rem rgba(255,127,80,.2);
    }
    .btn-coral{
        background: var(--coral);
        color: #fff;
        border-radius: 10px;
        padding: 12px 26px;
        font-weight: 600;
    }
    .btn-coral:hover{
        background: var(--coral-dark);
        color: #fff;
    }
    .btn-outline-coral{
        border: 1px solid var(--coral);
        color: var(--coral);
        border-radius: 10px;
        padding: 12px 26px;
        font-weight: 600;
    }
    .btn-outline-coral:hover{
        background: var(--coral);
        color: #fff;
    }
</style>

<div class="container-fluid px-4">
    <div class="table-wrapper">
        @if ($errors->any())
            <div class="alert alert-danger mb-4">
                <strong>Oops!</strong> Please fix the following errors:
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="table-card">
            <div class="table-card-header">
                <i class="fas fa-chair me-2 fs-5"></i>
                <h4>Edit Table</h4>
            </div>
            <div class="table-card-body">
                <form action="{{ route('tables.update', $table->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <label class="form-label">Restaurant <span class="text-danger">*</span></label>
                            <select name="restaurant_id" class="form-select" required>
                                <option value="">Select Restaurant</option>
                                @foreach($restaurants as $restaurant)
                                    <option value="{{ $restaurant->id }}" {{ $table->restaurant_id == $restaurant->id ? 'selected' : '' }}>
                                        {{ $restaurant->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">Table Name/No. <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $table->name) }}" required>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">Capacity <span class="text-danger">*</span></label>
                            <input type="number" name="capacity" class="form-control" min="1" value="{{ old('capacity', $table->capacity) }}" required>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-select" required>
                                <option value="available" {{ $table->status === 'available' ? 'selected' : '' }}>Available</option>
                                <option value="booked" {{ $table->status === 'booked' ? 'selected' : '' }}>Booked</option>
                                <option value="occupied" {{ $table->status === 'occupied' ? 'selected' : '' }}>Occupied</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end gap-3 mt-5">
                        <a href="{{ route('tables.index') }}" class="btn btn-outline-coral">
                            <i class="fas fa-arrow-left me-1"></i> Back
                        </a>
                        <button type="submit" class="btn btn-coral">
                            <i class="fas fa-save me-1"></i> Update Table
                        </button>
                    </div>
                </form>
            </div>
    </div>
></div>
@endsection
