@extends('layout.erp.app')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Edit User</h4>
        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">Back</a>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif
    <form action="{{ route('users.update', $user->id) }}" method="POST" class="card card-body">
        @csrf @method('PUT')
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Password (optional)</label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Role</label>
            <select name="role" class="form-select" required>
                @foreach($roles as $r)
                    <option value="{{ $r }}" @if(($user->role ?? $user->getRoleNames()->first()) === $r) selected @endif>{{ $r }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn" style="color:#000;background-color:#FF7F50;border-color:#FF7F50;">Update</button>
    </form>
</div>
@endsection
