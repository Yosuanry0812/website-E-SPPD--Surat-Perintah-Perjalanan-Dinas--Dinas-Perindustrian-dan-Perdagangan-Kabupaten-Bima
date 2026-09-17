<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'E-SPPD Bima') — Disperindag Kab. Bima</title>
    <link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'%3E%3Crect width='32' height='32' rx='8' fill='%2300288e'/%3E%3Ctext x='16' y='21.5' font-size='13' font-weight='700' text-anchor='middle' fill='%23fff' font-family='sans-serif'%3ES%3C/text%3E%3C/svg%3E">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <style>
        @keyframes esppd-fade-up {
            from { opacity: 0; transform: translateY(18px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .anim-results {
            animation: esppd-fade-up .55s cubic-bezier(.22,.61,.36,1) both;
        }
        .anim-results-delay-1 { animation-delay: .08s; }
        .anim-results-delay-2 { animation-delay: .16s; }
        .anim-results-delay-3 { animation-delay: .24s; }
        .anim-results-delay-4 { animation-delay: .32s; }
        @media (prefers-reduced-motion: reduce) {
            .anim-results { animation: none; }
        }
    </style>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "secondary": "#006c49",
                        "surface-container-highest": "#e3e1eb",
                        "surface-container-lowest": "#ffffff",
                        "on-secondary-fixed": "#002113",
                        "on-background": "#1a1b22",
                        "secondary-fixed": "#6ffbbe",
                        "on-tertiary-container": "#c9aeff",
                        "tertiary": "#440098",
                        "on-surface-variant": "#444653",
                        "tertiary-container": "#5f00d1",
                        "inverse-primary": "#b8c4ff",
                        "error-container": "#ffdad6",
                        "surface-container-high": "#e8e7f1",
                        "surface-variant": "#e3e1eb",
                        "error": "#ba1a1a",
                        "on-error": "#ffffff",
                        "primary-fixed": "#dde1ff",
                        "background": "#fbf8ff",
                        "on-tertiary-fixed-variant": "#5a00c6",
                        "inverse-on-surface": "#f1f0fa",
                        "on-primary": "#ffffff",
                        "surface-container-low": "#f4f2fc",
                        "on-surface": "#1a1b22",
                        "surface-bright": "#fbf8ff",
                        "on-secondary": "#ffffff",
                        "secondary-fixed-dim": "#4edea3",
                        "outline-variant": "#c4c5d5",
                        "on-primary-container": "#a8b8ff",
                        "primary": "#00288e",
                        "tertiary-fixed-dim": "#d2bbff",
                        "on-tertiary-fixed": "#25005a",
                        "on-error-container": "#93000a",
                        "primary-container": "#1e40af",
                        "on-tertiary": "#ffffff",
                        "secondary-container": "#6cf8bb",
                        "surface": "#fbf8ff",
                        "on-secondary-fixed-variant": "#005236",
                        "outline": "#757684",
                        "surface-container": "#eeedf7",
                        "on-primary-fixed": "#001453",
                        "on-primary-fixed-variant": "#173bab",
                        "tertiary-fixed": "#eaddff",
                        "inverse-surface": "#2f3037",
                        "surface-tint": "#3755c3",
                        "surface-dim": "#dad9e3",
                        "on-secondary-container": "#00714d",
                        "primary-fixed-dim": "#b8c4ff"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "gutter": "24px",
                        "stack-lg": "32px",
                        "stack-md": "16px",
                        "stack-sm": "8px",
                        "margin-mobile": "16px",
                        "container-max": "1440px",
                        "sidebar-width": "280px"
                    },
                    "fontFamily": {
                        "body-md": ["Inter"],
                        "headline-md-mobile": ["Plus Jakarta Sans"],
                        "body-lg": ["Inter"],
                        "headline-sm": ["Plus Jakarta Sans"],
                        "headline-md": ["Plus Jakarta Sans"],
                        "label-md": ["Inter"],
                        "display-lg": ["Plus Jakarta Sans"],
                        "data-table": ["Inter"]
                    },
                    "fontSize": {
                        "body-md": ["14px", { "lineHeight": "20px", "fontWeight": "400" }],
                        "headline-md-mobile": ["20px", { "lineHeight": "28px", "fontWeight": "600" }],
                        "body-lg": ["16px", { "lineHeight": "24px", "fontWeight": "400" }],
                        "headline-sm": ["20px", { "lineHeight": "28px", "fontWeight": "600" }],
                        "headline-md": ["24px", { "lineHeight": "32px", "letterSpacing": "-0.01em", "fontWeight": "600" }],
                        "label-md": ["13px", { "lineHeight": "18px", "letterSpacing": "0.05em", "fontWeight": "600" }],
                        "display-lg": ["36px", { "lineHeight": "44px", "letterSpacing": "-0.02em", "fontWeight": "700" }],
                        "data-table": ["14px", { "lineHeight": "20px", "fontWeight": "500" }]
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('styles')
</head>
<body class="bg-[#F8FAFC] text-on-surface font-body-md h-screen h-dvh overflow-hidden flex">
@auth
    @include('partials.sidebar')
    <div id="sidebar-scrim" class="fixed inset-0 bg-black/40 z-40 hidden md:hidden" aria-hidden="true"></div>

    <div class="flex-1 md:ml-sidebar-width flex flex-col h-screen h-dvh overflow-hidden">
        @php
            $__page = 'Dashboard';
            if (request()->routeIs('admin.users.*'))       $__page = 'Manajemen Staf';
            elseif (request()->routeIs('admin.sppd.*'))     $__page = 'Kelola SPPD';
            elseif (request()->routeIs('admin.laporan.*'))  $__page = 'Rekapitulasi';
            elseif (request()->routeIs('staf.sppd.*'))      $__page = 'Pengajuan SPPD';
        @endphp
        <header class="h-16 bg-surface-container-lowest border-b border-outline-variant/30 flex justify-between items-center px-4 md:px-gutter flex-shrink-0 z-[30] md:w-[calc(100%-280px)] md:fixed md:top-0 md:right-0 w-full fixed top-0">
            <div class="flex items-center gap-3 md:gap-4 min-w-0">
                <button id="sidebar-toggle" class="md:hidden text-on-surface-variant p-2 hover:bg-surface-container-high rounded-full transition-colors shrink-0 z-[60]" aria-label="Buka menu">
                    <span class="material-symbols-outlined">menu</span>
                </button>
                <div class="hidden md:flex items-center gap-6 h-full">
                    <a class="{{ request()->routeIs('admin.dashboard') || request()->routeIs('staf.dashboard') ? 'text-primary font-bold border-b-2 border-primary' : 'text-on-surface-variant hover:text-primary' }} font-label-md text-label-md h-full flex items-center pt-1" href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('staf.dashboard') }}">Dashboard</a>
                    @if (auth()->user()->isAdmin())
                        <a class="{{ request()->routeIs('admin.sppd.*') ? 'text-primary font-bold border-b-2 border-primary' : 'text-on-surface-variant hover:text-primary' }} font-label-md text-label-md h-full flex items-center pt-1" href="{{ route('admin.sppd.index') }}">Arsip</a>
                    @endif
                </div>
                <span class="md:hidden font-headline-sm text-headline-sm font-bold text-primary truncate max-w-[40vw]">{{ $__page }}</span>
            </div>
            <div class="flex items-center gap-2 sm:gap-4 shrink-0">
                @if (auth()->user()->isAdmin())
                <div class="hidden md:flex relative mr-2">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-[20px]">search</span>
                    <input class="pl-10 pr-4 py-2 rounded-xl border border-outline-variant/40 bg-[#F8FAFC] text-body-md focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all w-72 outline-none shadow-sm" placeholder="Cari SPPD..." type="text">
                </div>
                @endif
                <button class="text-on-surface-variant p-2 hover:bg-surface-container-high rounded-full transition-colors cursor-pointer active:opacity-80 relative shrink-0" aria-label="Notifikasi">
                    <span class="material-symbols-outlined">notifications</span>
                    <span class="absolute top-1 right-1 w-2 h-2 bg-error rounded-full"></span>
                </button>
                <div class="flex items-center gap-2 sm:gap-3 pl-1 sm:pl-2">
                    <div class="w-9 h-9 rounded-full bg-primary text-on-primary flex items-center justify-center ring-2 ring-outline-variant/30 font-bold text-sm flex-shrink-0">{{ strtoupper(substr(auth()->user()->nama_lengkap, 0, 1)) }}</div>
                    <span class="font-label-md text-label-md hidden md:block text-on-surface font-semibold max-w-[160px] truncate">{{ auth()->user()->nama_lengkap }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-on-surface-variant hover:text-error transition-colors font-label-md text-label-md flex items-center gap-1" title="Logout">
                            <span class="hidden md:inline">Logout</span>
                            <span class="material-symbols-outlined text-[18px] align-middle">logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto mt-16 p-4 md:p-6 lg:p-8 scroll-smooth">
            <div class="max-w-container-max mx-auto space-y-8 pb-10">
                @include('partials.flash')
                @yield('content')
            </div>
        </main>
    </div>
@else
    <div class="flex-1 overflow-y-auto">
        <div class="max-w-container-max mx-auto">
            @yield('content')
        </div>
    </div>
@endauth

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Toggle sidebar (mobile)
    document.addEventListener('DOMContentLoaded', function () {
        const toggle = document.getElementById('sidebar-toggle');
        const sidebar = document.getElementById('sidebar');
        const scrim = document.getElementById('sidebar-scrim');
        const close = function () {
            sidebar.classList.add('hidden');
            if (scrim) scrim.classList.add('hidden');
        };
        if (toggle && sidebar) {
            toggle.addEventListener('click', function () {
                sidebar.classList.toggle('hidden');
                if (scrim) scrim.classList.toggle('hidden');
            });
            if (scrim) scrim.addEventListener('click', close);
            sidebar.querySelectorAll('a').forEach(function (a) {
                a.addEventListener('click', close);
            });
        }
    });

    // Konfirmasi SweetAlert2 sebelum submit form hapus (fallback submit langsung bila offline)
    document.addEventListener('submit', function (e) {
        const form = e.target;
        if (!form.matches('form[data-confirm]')) return;
        if (typeof Swal === 'undefined') { form.submit(); return; }
        e.preventDefault();
        Swal.fire({
            title: form.dataset.confirmTitle || 'Apakah Anda yakin?',
            text: form.dataset.confirmText || 'Data yang dihapus tidak dapat dikembalikan.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ba1a1a',
            cancelButtonColor: '#444653',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) form.submit();
        });
    });
    // Tutup alert inline
    document.addEventListener('click', function (e) {
        if (e.target.closest('.alert .x')) e.target.closest('.alert').remove();
    });
</script>
@stack('scripts')
</body>
</html>
