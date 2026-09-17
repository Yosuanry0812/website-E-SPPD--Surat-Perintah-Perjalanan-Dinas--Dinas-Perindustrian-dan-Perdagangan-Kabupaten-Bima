@extends('layouts.app')

@section('title', 'Dashboard Staf')

@section('content')
{{-- Welcome Section --}}
<div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
    <div>
        <p class="text-sm font-medium text-primary mb-1">{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</p>
        <h2 class="font-headline-md text-headline-md text-on-surface">Selamat datang, {{ auth()->user()->nama_lengkap }}</h2>
        <p class="text-on-surface-variant mt-1 text-base">{{ auth()->user()->jabatan }} &middot; {{ auth()->user()->pangkat_golongan }}</p>
    </div>
    <div class="flex items-center gap-2 bg-surface px-4 py-2 rounded-lg border border-outline-variant/50 card-shadow">
        <span class="material-symbols-outlined text-tertiary">sunny</span>
        <span class="text-sm font-medium text-on-surface">Ringkasan aktivitas dinas Anda</span>
    </div>
</div>

{{-- Top Action Cards --}}
<section class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <a href="{{ route('staf.sppd.create') }}" class="group relative overflow-hidden bg-gradient-to-br from-[#f8faff] to-[#eef2ff] rounded-2xl border border-primary/10 card-shadow card-shadow-hover transition-all duration-300 text-left p-6 flex items-start gap-5">
        <div class="w-14 h-14 shrink-0 rounded-xl bg-white shadow-sm flex items-center justify-center text-primary group-hover:scale-110 transition-transform">
            <span class="material-symbols-outlined text-3xl" style="font-variation-settings: 'FILL' 1;">directions_car</span>
        </div>
        <div class="flex-1 relative z-10">
            <div class="flex items-center justify-between mb-1">
                <h3 class="font-headline-sm text-lg font-bold text-on-surface group-hover:text-primary transition-colors">Buat SPPD Dalam Daerah</h3>
                <span class="material-symbols-outlined text-primary/50 group-hover:text-primary transition-colors opacity-0 group-hover:opacity-100 transform translate-x-2 group-hover:translate-x-0 duration-300">arrow_forward</span>
            </div>
            <p class="font-body-md text-sm text-on-surface-variant/80">Pengajuan perjalanan dinas di area Kabupaten Bima.</p>
        </div>
    </a>
    <a href="{{ route('staf.sppd.create') }}" class="group relative overflow-hidden bg-gradient-to-br from-[#faf8ff] to-[#f3eeff] rounded-2xl border border-tertiary/10 card-shadow card-shadow-hover transition-all duration-300 text-left p-6 flex items-start gap-5">
        <div class="w-14 h-14 shrink-0 rounded-xl bg-white shadow-sm flex items-center justify-center text-tertiary group-hover:scale-110 transition-transform">
            <span class="material-symbols-outlined text-3xl" style="font-variation-settings: 'FILL' 1;">flight_takeoff</span>
        </div>
        <div class="flex-1 relative z-10">
            <div class="flex items-center justify-between mb-1">
                <h3 class="font-headline-sm text-lg font-bold text-on-surface group-hover:text-tertiary transition-colors">Buat SPPD Luar Daerah</h3>
                <span class="material-symbols-outlined text-tertiary/50 group-hover:text-tertiary transition-colors opacity-0 group-hover:opacity-100 transform translate-x-2 group-hover:translate-x-0 duration-300">arrow_forward</span>
            </div>
            <p class="font-body-md text-sm text-on-surface-variant/80">Pengajuan perjalanan lintas kabupaten atau provinsi.</p>
        </div>
    </a>
</section>

{{-- Stat Summary --}}
<section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
    <div class="bg-surface p-5 rounded-2xl border border-outline-variant/40 card-shadow flex flex-col justify-between group hover:border-primary/30 transition-colors">
        <div class="flex justify-between items-start mb-6">
            <div class="w-10 h-10 rounded-full bg-surface-container-low flex items-center justify-center text-on-surface-variant group-hover:bg-primary/5 group-hover:text-primary transition-colors">
                <span class="material-symbols-outlined text-[20px]">map</span>
            </div>
            <span class="px-2.5 py-1 bg-surface-container-low rounded text-xs font-medium text-on-surface-variant">Semua waktu</span>
        </div>
        <div>
            <p class="text-sm text-on-surface-variant font-medium mb-1">Total Perjalanan</p>
            <span class="font-display-lg text-3xl font-bold text-on-surface">{{ $riwayat->count() }}</span>
        </div>
    </div>
    <div class="bg-surface p-5 rounded-2xl border border-outline-variant/40 card-shadow flex flex-col justify-between group hover:border-primary/30 transition-colors">
        <div class="flex justify-between items-start mb-6">
            <div class="w-10 h-10 rounded-full bg-primary/5 flex items-center justify-center text-primary">
                <span class="material-symbols-outlined text-[20px]">directions_car</span>
            </div>
        </div>
        <div>
            <p class="text-sm text-on-surface-variant font-medium mb-1">Dalam Daerah</p>
            <div class="flex items-baseline gap-2">
                <span class="font-display-lg text-3xl font-bold text-on-surface">{{ $riwayat->where('jenis_perjalanan', 'Dalam Daerah')->count() }}</span>
                <span class="text-sm text-on-surface-variant">Kegiatan</span>
            </div>
        </div>
    </div>
    <div class="bg-surface p-5 rounded-2xl border border-outline-variant/40 card-shadow flex flex-col justify-between group hover:border-tertiary/30 transition-colors">
        <div class="flex justify-between items-start mb-6">
            <div class="w-10 h-10 rounded-full bg-tertiary/5 flex items-center justify-center text-tertiary">
                <span class="material-symbols-outlined text-[20px]">flight</span>
            </div>
        </div>
        <div>
            <p class="text-sm text-on-surface-variant font-medium mb-1">Luar Daerah</p>
            <div class="flex items-baseline gap-2">
                <span class="font-display-lg text-3xl font-bold text-on-surface">{{ $riwayat->where('jenis_perjalanan', 'Luar Daerah')->count() }}</span>
                <span class="text-sm text-on-surface-variant">Kegiatan</span>
            </div>
        </div>
    </div>
    <div class="bg-surface p-5 rounded-2xl border border-outline-variant/40 card-shadow flex flex-col justify-between group hover:border-secondary/30 transition-colors relative overflow-hidden">
        <div class="absolute top-0 right-0 w-16 h-16 bg-secondary/5 rounded-bl-full"></div>
        <div class="flex justify-between items-start mb-6 relative z-10">
            <div class="w-10 h-10 rounded-full bg-secondary/10 flex items-center justify-center text-secondary">
                <span class="material-symbols-outlined text-[20px]">payments</span>
            </div>
        </div>
        <div class="relative z-10">
            <p class="text-sm text-on-surface-variant font-medium mb-1">Total Biaya Pengajuan</p>
            <div class="flex items-baseline gap-2">
                <span class="font-display-lg text-2xl font-bold text-secondary leading-tight">Rp {{ number_format($riwayat->sum('total_biaya'), 0, ',', '.') }}</span>
            </div>
        </div>
    </div>
</section>

{{-- Riwayat Pribadi --}}
<section class="bg-surface rounded-2xl border border-outline-variant/40 card-shadow overflow-hidden">
    <div class="px-4 sm:px-6 py-5 border-b border-outline-variant/40 flex flex-wrap justify-between items-center gap-3">
        <h3 class="font-headline-sm text-lg font-bold text-on-surface">Riwayat Perjalanan Terbaru</h3>
        <a href="{{ route('staf.sppd.create') }}" class="text-on-surface-variant border border-outline-variant/50 hover:bg-surface-container-low px-4 py-2 rounded-lg font-label-md text-sm font-medium transition-colors flex items-center gap-2">
            <span class="material-symbols-outlined text-[18px]">add</span>
            Buat SPPD
        </a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse min-w-[640px]">
            <thead>
                <tr class="border-b border-outline-variant/40 text-xs font-semibold text-on-surface-variant uppercase tracking-wider bg-surface-container-low/30 sticky top-0">
                    <th class="px-6 py-4">Informasi SPPD</th>
                    <th class="px-6 py-4">Tujuan &amp; Tanggal</th>
                    <th class="px-6 py-4 text-right">Total Biaya</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm text-on-surface divide-y divide-outline-variant/20">
                @forelse ($riwayat as $s)
                    <tr class="table-row-hover transition-colors group">
                        <td class="px-6 py-4">
                            <p class="font-semibold text-primary mb-1">{{ $s->nomor_sppd }}</p>
                            <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded text-[11px] font-medium {{ $s->jenis_perjalanan === 'Dalam Daerah' ? 'bg-primary/10 text-primary' : 'bg-tertiary/10 text-tertiary' }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $s->jenis_perjalanan === 'Dalam Daerah' ? 'bg-primary' : 'bg-tertiary' }}"></span>
                                {{ $s->jenis_perjalanan }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-medium text-on-surface mb-1">{{ $s->tempat_tujuan }}</p>
                            <p class="text-xs text-on-surface-variant flex items-center gap-1">
                                <span class="material-symbols-outlined text-[14px]">calendar_today</span>
                                {{ $s->tanggal_berangkat->translatedFormat('d M Y') }} &ndash; {{ $s->tanggal_kembali->translatedFormat('d M Y') }}
                            </p>
                        </td>
                        <td class="px-6 py-4 text-right font-semibold">Rp {{ number_format($s->total_biaya, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-1 opacity-100 sm:opacity-0 sm:group-hover:opacity-100 transition-opacity">
                                <a href="{{ route('staf.sppd.show', $s) }}" class="p-2 rounded-lg hover:bg-primary/5 text-on-surface-variant hover:text-primary transition-colors" title="Detail">
                                    <span class="material-symbols-outlined text-[20px]">visibility</span>
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-16 text-center text-on-surface-variant">
                            <span class="material-symbols-outlined text-[40px] opacity-40 block mb-2">inbox</span>
                            Belum ada pengajuan SPPD.
                            <a href="{{ route('staf.sppd.create') }}" class="text-primary font-semibold">Buat sekarang</a>.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-4 sm:px-6 py-4 border-t border-outline-variant/40 bg-surface flex flex-wrap items-center justify-between gap-3">
        <span class="text-sm text-on-surface-variant">Menampilkan {{ $riwayat->count() }} dari {{ $riwayat->count() }} entri</span>
        <div class="flex items-center gap-1">
            <button class="w-8 h-8 rounded-lg flex items-center justify-center text-on-surface-variant disabled:opacity-50 border border-transparent" disabled>
                <span class="material-symbols-outlined text-[20px]">chevron_left</span>
            </button>
            <button class="w-8 h-8 rounded-lg bg-primary text-white text-sm font-medium flex items-center justify-center shadow-sm">1</button>
            <button class="w-8 h-8 rounded-lg flex items-center justify-center text-on-surface-variant disabled:opacity-50 border border-transparent" disabled>
                <span class="material-symbols-outlined text-[20px]">chevron_right</span>
            </button>
        </div>
    </div>
</section>
@endsection
