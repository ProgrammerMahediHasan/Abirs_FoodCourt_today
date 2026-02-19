@extends('layout.erp.app')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Roles</h4>
        <a href="{{ route('roles.create') }}" class="btn mb-3" style="color:#000;background-color:#FF7F50;border-color:#FF7F50;">
            <i class="fa fa-plus"></i> Add Role
        </a>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif
    <form method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="Search by role name">
            <button class="btn btn-outline-secondary" type="submit">Search</button>
        </div>
    </form>
    <div class="table-responsive">
        <table class="table table-hover align-middle table-bordered">
            <thead class="table-dark text-center">
                <tr>
                    <th style="background-color:#FF7F50;color:#000;">SL</th>
                    <th style="background-color:#FF7F50;color:#000;">Name</th>
                    <th style="background-color:#FF7F50;color:#000;">Actions</th>
                </tr>
            </thead>
            <tbody>
            @forelse($roles as $index => $role)
                <tr>
                    <td>{{ $roles->firstItem() + $index }}</td>
                    <td>{{ $role->name }}</td>
                    <td class="text-center">
                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-outline-secondary" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this role?')" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">No roles found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center mt-3">
        {{ $roles->links() }}
    </div>
</div>
@endsection
