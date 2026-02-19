@extends('layout.erp.app')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Users</h4>
        <a href="{{ route('users.create') }}" class="btn mb-3" style="color:#000000be;background-color:#FF7F50;border-color:#FF7F50;font-weight:500;">
            <i class="fa fa-plus"></i> Add User
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
            <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="Search by name or email">
            <button class="btn btn-outline-secondary" type="submit">Search</button>
        </div>
    </form>
    <div class="table-responsive">
        <table class="table table-hover align-middle table-bordered">
            <thead class="table-dark text-center">
                <tr>
                    <th style="background-color:#FF7F50;color:#000;">SL</th>
                    <th style="background-color:#FF7F50;color:#000;">Name</th>
                    <th style="background-color:#FF7F50;color:#000;">Email</th>
                    <th style="background-color:#FF7F50;color:#000;">Role</th>
                    <th style="background-color:#FF7F50;color:#000;">Actions</th>
                </tr>
            </thead>
            <tbody>
            @forelse($users as $index => $user)
                <tr>
                    <td>{{ $users->firstItem() + $index }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role ?? ($user->getRoleNames()->first() ?? 'N/A') }}</td>
                    <td class="text-center">
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-outline-secondary" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this user?')" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No users found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center mt-3">
        {{ $users->links() }}
    </div>
@endsection
