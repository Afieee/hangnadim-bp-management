<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aerocity User Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user-manage.css') }}">
    <link rel="icon" href="{{ asset('/storage/images/logo_bp.png') }}" type="image/png">

</head>
<body>
<x-navbar/>
<x-sidebar />

@if(session('success'))
<div id="toast" class="toast">
    <div class="toast-icon"></div>
    <div class="toast-content">
        <div class="toast-title">Success!</div>
        <div class="toast-message">{{ session('success') }}</div>
    </div>
    <button class="toast-close">&times;</button>
    <div class="toast-progress"></div>
</div>
@endif

<div class="content-wrapper" id="content-wrapper">
    <div class="breadcrumb-container">
        <div class="breadcrumb">
            <ul>
                <li><a href="#"><i class="fas fa-home"></i> Dashboard</a></li>
                <li>Manage User</li>
            </ul>
        </div>
    </div>

    <div class="content-area">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Daftar User</h1>
                <a href="/halaman-registrasi" class="btn-add">
                    <i class="fas fa-plus"></i> Tambah Pengguna
                </a>
            </div>
            
            <div class="table-container">
                @if($users->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>NIP/NUP</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->nip_atau_nup }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($user->role)
                                <span class="role-badge role-{{ strtolower($user->role) }}">{{ $user->role }}</span>
                                @else
                                <span class="role-badge">-</span>
                                @endif
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('manage-user.edit', \Illuminate\Support\Facades\Crypt::encryptString($user->id)) }}" class="btn-edit">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('manage-user.delete', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="empty-state">
                    <i class="fas fa-users"></i>
                    <p>Tidak ada data user</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
</body>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toast = document.getElementById('toast');
        if(toast) {
            // Show toast with animation
            setTimeout(() => {
                toast.classList.add('show');
            }, 100);
            
            // Close toast when close button is clicked
            const closeBtn = toast.querySelector('.toast-close');
            closeBtn.addEventListener('click', () => {
                toast.classList.remove('show');
            });
            
            // Auto-hide after 3 seconds
            setTimeout(() => {
                toast.classList.remove('show');
            }, 3000);
        }
    });
</script>
</html>