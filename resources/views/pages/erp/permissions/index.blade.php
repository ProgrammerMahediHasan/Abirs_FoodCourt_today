@extends('layout.erp.app')
@section('dashboard')
Permission Control System
@endsection
@section('content')
<div class="container py-4">
    <div id="toast" class="alert alert-success d-none">Saved</div>
    <div class="card">
        <div class="card-header" style="background:#FF7F50;color:#000;font-weight:600">
            Admin Permission Control
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Module</th>
                            @foreach($roles as $role)
                                <th class="text-center">{{ $role }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($modules as $m)
                        <tr>
                            <td class="fw-semibold">
                                {{ $m['label'] }}
                                <div class="mt-2 d-flex gap-2">
                                    <button class="btn btn-xs btn-dark mark-row" data-perm="{{ $m['key'] }}">Mark All</button>
                                    <button class="btn btn-xs unmark-row" style="background:#FF7F50; border-color:#FF7F50; color:#000;" data-perm="{{ $m['key'] }}">Unmark All</button>
                                </div>
                            </td>
                            @foreach($roles as $role)
                            <td class="text-center">
                                <div class="d-flex flex-column align-items-center gap-2">
                                    <span class="badge {{ ($matrix[$role][$m['key']] ?? false) ? 'bg-success' : 'bg-danger' }} status-badge">
                                        {{ ($matrix[$role][$m['key']] ?? false) ? 'Enabled' : 'Disabled' }}
                                    </span>
                                    <div class="form-check">
                                        <input type="checkbox"
                                               class="form-check-input perm-mark"
                                               {{ ($matrix[$role][$m['key']] ?? false) ? 'checked' : '' }}
                                               data-role="{{ $role }}"
                                               data-perm="{{ $m['key'] }}">
                                        <label class="form-check-label">Mark</label>
                                    </div>
                                </div>
                            </td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    const toast = document.getElementById('toast');
    const token = '{{ csrf_token() }}';
    document.querySelectorAll('.perm-mark').forEach(cb => {
        cb.addEventListener('change', async function() {
            const role = this.getAttribute('data-role');
            const permission = this.getAttribute('data-perm');
            const enable = this.checked ? 1 : 0;
            try {
                const res = await fetch('{{ route('admin.permissions.toggle') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ role, permission, enable })
                });
                if (!res.ok) throw new Error('Request failed');
                const cell = this.closest('td');
                const badge = cell.querySelector('.status-badge');
                if (badge) {
                    if (enable) {
                        badge.classList.remove('bg-danger');
                        badge.classList.add('bg-success');
                        badge.textContent = 'Enabled';
                    } else {
                        badge.classList.remove('bg-success');
                        badge.classList.add('bg-danger');
                        badge.textContent = 'Disabled';
                    }
                }
                if (toast) {
                    toast.textContent = 'Saved';
                    toast.classList.remove('d-none');
                    setTimeout(() => toast.classList.add('d-none'), 1200);
                }
            } catch (err) {
                alert('Failed to save. Please try again.');
            }
        });
    });

    document.querySelectorAll('.mark-row').forEach(btn => {
        btn.addEventListener('click', async function() {
            const perm = this.getAttribute('data-perm');
            const cells = document.querySelectorAll(`input.perm-mark[data-perm="${perm}"]`);
            const payloads = Array.from(cells).map(cb => ({
                role: cb.getAttribute('data-role'),
                permission: perm,
                enable: 1
            }));
            try {
                await Promise.all(payloads.map(p =>
                    fetch('{{ route('admin.permissions.toggle') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token,
                            'Accept': 'application/json',
                        },
                        body: JSON.stringify(p)
                    })
                ));
                cells.forEach(cb => {
                    cb.checked = true;
                    const cell = cb.closest('td');
                    const badge = cell.querySelector('.status-badge');
                    if (badge) {
                        badge.classList.remove('bg-danger');
                        badge.classList.add('bg-success');
                        badge.textContent = 'Enabled';
                    }
                });
                if (toast) {
                    toast.textContent = 'Saved';
                    toast.classList.remove('d-none');
                    setTimeout(() => toast.classList.add('d-none'), 1200);
                }
            } catch (e) {
                alert('Failed to save. Please try again.');
            }
        });
    });
    document.querySelectorAll('.unmark-row').forEach(btn => {
        btn.addEventListener('click', async function() {
            const perm = this.getAttribute('data-perm');
            const cells = document.querySelectorAll(`input.perm-mark[data-perm="${perm}"]`);
            const payloads = Array.from(cells).map(cb => ({
                role: cb.getAttribute('data-role'),
                permission: perm,
                enable: 0
            }));
            try {
                await Promise.all(payloads.map(p =>
                    fetch('{{ route('admin.permissions.toggle') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token,
                            'Accept': 'application/json',
                        },
                        body: JSON.stringify(p)
                    })
                ));
                cells.forEach(cb => {
                    cb.checked = false;
                    const cell = cb.closest('td');
                    const badge = cell.querySelector('.status-badge');
                    if (badge) {
                        badge.classList.remove('bg-success');
                        badge.classList.add('bg-danger');
                        badge.textContent = 'Disabled';
                    }
                });
                if (toast) {
                    toast.textContent = 'Saved';
                    toast.classList.remove('d-none');
                    setTimeout(() => toast.classList.add('d-none'), 1200);
                }
            } catch (e) {
                alert('Failed to save. Please try again.');
            }
        });
    });
</script>
@endsection
