<aside id="sidebar" class="fixed left-0 top-0 h-full w-sidebar-width max-w-[85vw] bg-surface border-r border-outline-variant/30 z-50 flex flex-col py-stack-md shadow-sm hidden md:flex">
    <div class="px-gutter pb-stack-lg border-b border-outline-variant/20 flex items-center gap-3">
        <div class="w-10 h-10 rounded-xl bg-primary text-on-primary flex items-center justify-center flex-shrink-0 shadow-sm">
            <span class="material-symbols-outlined text-[24px]">account_balance</span>
        </div>
        <div>
            <h1 class="font-headline-sm text-headline-sm font-bold text-primary">E-SPPD Bima</h1>
            <p class="font-label-md text-label-md text-on-surface-variant font-normal">Disperindag Kab. Bima</p>
        </div>
    </div>

    @if (auth()->user()->isAdmin())
        <nav class="flex-1 overflow-y-auto py-stack-md px-4 flex flex-col gap-2">
            <a class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.dashboard') ? 'bg-primary text-on-primary shadow-sm' : 'text-on-surface-variant hover:bg-surface-container-high' }} rounded-xl transition-colors duration-200 active:scale-95" href="{{ route('admin.dashboard') }}">
                <span class="material-symbols-outlined" @if(request()->routeIs('admin.dashboard')) style="font-variation-settings: 'FILL' 1;" @endif>dashboard</span>
                <span class="font-label-md text-label-md">Dashboard</span>
            </a>
            <a class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.users.*') ? 'bg-primary text-on-primary shadow-sm' : 'text-on-surface-variant hover:bg-surface-container-high' }} rounded-xl transition-colors duration-200 active:scale-95" href="{{ route('admin.users.index') }}">
                <span class="material-symbols-outlined" @if(request()->routeIs('admin.users.*')) style="font-variation-settings: 'FILL' 1;" @endif>group</span>
                <span class="font-label-md text-label-md">Manajemen Staf</span>
            </a>
            <a class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.sppd.*') ? 'bg-primary text-on-primary shadow-sm' : 'text-on-surface-variant hover:bg-surface-container-high' }} rounded-xl transition-colors duration-200 active:scale-95" href="{{ route('admin.sppd.index') }}">
                <span class="material-symbols-outlined" @if(request()->routeIs('admin.sppd.*')) style="font-variation-settings: 'FILL' 1;" @endif>description</span>
                <span class="font-label-md text-label-md">Kelola SPPD</span>
            </a>
            <a class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.laporan.*') ? 'bg-primary text-on-primary shadow-sm' : 'text-on-surface-variant hover:bg-surface-container-high' }} rounded-xl transition-colors duration-200 active:scale-95" href="{{ route('admin.laporan.index') }}">
                <span class="material-symbols-outlined" @if(request()->routeIs('admin.laporan.*')) style="font-variation-settings: 'FILL' 1;" @endif>analytics</span>
                <span class="font-label-md text-label-md">Rekapitulasi</span>
            </a>
        </nav>
    @else
        <nav class="flex-1 overflow-y-auto py-stack-md px-4 flex flex-col gap-2">
            <a class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('staf.dashboard') ? 'bg-primary text-on-primary shadow-sm' : 'text-on-surface-variant hover:bg-surface-container-high' }} rounded-xl transition-colors duration-200 active:scale-95" href="{{ route('staf.dashboard') }}">
                <span class="material-symbols-outlined" @if(request()->routeIs('staf.dashboard')) style="font-variation-settings: 'FILL' 1;" @endif>dashboard</span>
                <span class="font-label-md text-label-md">Dashboard</span>
            </a>
            <a class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('staf.sppd.*') ? 'bg-primary text-on-primary shadow-sm' : 'text-on-surface-variant hover:bg-surface-container-high' }} rounded-xl transition-colors duration-200 active:scale-95" href="{{ route('staf.sppd.create') }}">
                <span class="material-symbols-outlined" @if(request()->routeIs('staf.sppd.*')) style="font-variation-settings: 'FILL' 1;" @endif>add_circle</span>
                <span class="font-label-md text-label-md">Buat SPPD Baru</span>
            </a>
        </nav>
    @endif

    <div class="px-4 pt-stack-md border-t border-outline-variant/20 mt-auto flex flex-col gap-2">
        <a href="{{ auth()->user()->isAdmin() ? route('admin.sppd.index') : route('staf.sppd.create') }}" class="w-full bg-primary text-on-primary py-3 rounded-xl font-label-md text-label-md hover:opacity-90 transition-opacity active:scale-95 flex items-center justify-center gap-2 shadow-sm">
            <span class="material-symbols-outlined text-[18px]">add</span>
            Buat Laporan Baru
        </a>
        <div class="flex flex-col gap-1 mt-2">
            <a class="flex items-center gap-3 px-4 py-2 text-on-surface-variant hover:bg-surface-container-high rounded-xl transition-colors duration-200" href="#">
                <span class="material-symbols-outlined text-[20px]">settings</span>
                <span class="font-label-md text-label-md font-normal">Settings</span>
            </a>
            <a class="flex items-center gap-3 px-4 py-2 text-on-surface-variant hover:bg-surface-container-high rounded-xl transition-colors duration-200" href="#">
                <span class="material-symbols-outlined text-[20px]">help</span>
                <span class="font-label-md text-label-md font-normal">Bantuan</span>
            </a>
        </div>
    </div>
</aside>
