@extends('layout.erp.app')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Create Role</h4>
        <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary">Back</a>
    </div>
    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif
    <form action="{{ route('roles.store') }}" method="POST" class="card card-body">
        @csrf
        <div class="mb-3">
            <label class="form-label">Role Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>
        <button type="submit" class="btn" style="color:#000;background-color:#FF7F50;border-color:#FF7F50;">Save</button>
    </form>
</div>
@endsection
