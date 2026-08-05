<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'E-SPPD') — Disperindag Kab. Bima</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body { background: #f4f6f9; }
        .sidebar {
            width: 260px; min-height: 100vh; position: fixed; top: 0; left: 0;
            background: linear-gradient(180deg, #0d3b66 0%, #155e9e 100%);
            color: #fff; z-index: 1000;
        }
        .sidebar .brand {
            padding: 1.25rem 1.25rem; font-weight: 700; font-size: 1.05rem;
            border-bottom: 1px solid rgba(255,255,255,.15);
        }
        .sidebar a.nav-link { color: rgba(255,255,255,.85); border-radius: .5rem; margin: .15rem .75rem; }
        .sidebar a.nav-link:hover, .sidebar a.nav-link.active { background: rgba(255,255,255,.15); color: #fff; }
        .sidebar .user-box {
            position: absolute; bottom: 0; left: 0; right: 0; padding: 1rem 1.25rem;
            border-top: 1px solid rgba(255,255,255,.15); font-size: .85rem;
        }
        .main-content { margin-left: 260px; padding: 1.5rem; }
        @media (max-width: 991px) {
            .sidebar { position: static; width: 100%; min-height: auto; }
            .main-content { margin-left: 0; }
        }
        .card { border: none; box-shadow: 0 .125rem .5rem rgba(0,0,0,.06); }
        .stat-icon { font-size: 2rem; }
        .table thead th { background: #0d3b66; color: #fff; font-weight: 600; white-space: nowrap; }
    </style>
    @stack('styles')
</head>
<body>
    @auth
        @include('partials.sidebar')
    @endauth

    <div class="main-content">
        @include('partials.flash')
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Konfirmasi SweetAlert2 sebelum submit form hapus
        document.addEventListener('submit', function (e) {
            const form = e.target;
            if (!form.matches('form[data-confirm]')) return;
            e.preventDefault();
            Swal.fire({
                title: form.dataset.confirmTitle || 'Apakah Anda yakin?',
                text: form.dataset.confirmText || 'Data yang dihapus tidak dapat dikembalikan.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) form.submit();
            });
        });
        // Flash message otomatis
        @if (session('success'))
            Swal.fire({ icon: 'success', title: 'Berhasil!', text: "{{ session('success') }}", timer: 3000, showConfirmButton: false });
        @endif
        @if (session('error'))
            Swal.fire({ icon: 'error', title: 'Gagal!', text: "{{ session('error') }}", timer: 3000, showConfirmButton: false });
        @endif
    </script>
    @stack('scripts')
</body>
</html>
