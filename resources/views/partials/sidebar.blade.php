<aside class="sidebar">
    <div class="brand d-flex align-items-center gap-2">
        <i class="bi bi-briefcase-fill fs-4"></i>
        <div>
            <div>E-SPPD</div>
            <small style="font-weight:400;font-size:.7rem;">Disperindag Kab. Bima</small>
        </div>
    </div>

    <nav class="nav flex-column mt-3">
        @if (auth()->user()->isAdmin())
            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                <i class="bi bi-speedometer2 me-2"></i>Dashboard
            </a>
            <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                <i class="bi bi-people-fill me-2"></i>Kelola Akun Staf
            </a>
            <a class="nav-link {{ request()->routeIs('admin.sppd.*') ? 'active' : '' }}" href="{{ route('admin.sppd.index') }}">
                <i class="bi bi-journal-text me-2"></i>Data SPPD
            </a>
            <a class="nav-link {{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}" href="{{ route('admin.laporan.index') }}">
                <i class="bi bi-file-earmark-bar-graph-fill me-2"></i>Laporan SPPD
            </a>
        @else
            <a class="nav-link {{ request()->routeIs('staf.dashboard') ? 'active' : '' }}" href="{{ route('staf.dashboard') }}">
                <i class="bi bi-speedometer2 me-2"></i>Dashboard
            </a>
            <a class="nav-link {{ request()->routeIs('staf.sppd.create') ? 'active' : '' }}" href="{{ route('staf.sppd.create') }}">
                <i class="bi bi-plus-circle-fill me-2"></i>Buat SPPD Baru
            </a>
        @endif
    </nav>

    <div class="user-box">
        <div class="d-flex align-items-center gap-2 mb-2">
            <i class="bi bi-person-circle fs-4"></i>
            <div class="text-truncate">
                <div class="fw-semibold text-truncate">{{ auth()->user()->nama_lengkap }}</div>
                <small>{{ auth()->user()->role }} • {{ auth()->user()->nip }}</small>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-sm btn-outline-light w-100">
                <i class="bi bi-box-arrow-right me-1"></i>Logout
            </button>
        </form>
    </div>
</aside>
