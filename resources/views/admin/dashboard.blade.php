@extends('layouts.app')

@section('title', 'Dashboard Administrator')

@section('content')
{{-- Header Section --}}
<div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4">
    <div>
        <h2 class="font-display-lg text-[32px] font-bold text-on-surface tracking-tight">Halo, Administrator</h2>
        <p class="font-body-lg text-body-lg text-on-surface-variant mt-1">Ringkasan aktivitas dan pengajuan SPPD bulan ini.</p>
    </div>
    <div class="flex gap-3">
        <span class="px-4 py-2.5 border border-outline-variant/40 text-on-surface rounded-xl font-label-md text-label-md flex items-center gap-2 hover:bg-[#F8FAFC] transition-colors bg-surface-container-lowest shadow-sm cursor-default">
            <span class="material-symbols-outlined text-[18px]">calendar_month</span>
            Bulan Ini
        </span>
        <a href="{{ route('admin.laporan.index') }}" class="px-4 py-2.5 bg-primary text-on-primary rounded-xl font-label-md text-label-md flex items-center gap-2 hover:opacity-90 transition-opacity shadow-sm">
            <span class="material-symbols-outlined text-[18px]">download</span>
            Unduh Laporan
        </a>
    </div>
</div>

{{-- Bento Grid Stat Cards --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <div class="bg-white rounded-2xl p-6 table-shadow border border-outline-variant/20 relative overflow-hidden group hover:border-primary/40 transition-colors">
        <div class="flex justify-between items-start mb-6">
            <p class="font-label-md text-sm text-on-surface-variant font-medium">Total Staf Terdaftar</p>
            <div class="p-2.5 bg-primary/10 rounded-xl text-primary">
                <span class="material-symbols-outlined text-[22px]">group</span>
            </div>
        </div>
        <h3 class="font-headline-md text-[32px] font-bold text-on-surface">{{ $total_staf }}</h3>
        <div class="mt-3 flex items-center gap-1.5 text-sm text-secondary font-medium bg-secondary/10 w-fit px-2.5 py-1 rounded-full">
            <span class="material-symbols-outlined text-[16px]">trending_up</span>
            <span>Akun aktif</span>
        </div>
    </div>
    <div class="bg-white rounded-2xl p-6 table-shadow border border-outline-variant/20 relative overflow-hidden group hover:border-primary/40 transition-colors">
        <div class="flex justify-between items-start mb-6">
            <p class="font-label-md text-sm text-on-surface-variant font-medium">SPPD Dalam Daerah</p>
            <div class="p-2.5 bg-primary/10 rounded-xl text-primary">
                <span class="material-symbols-outlined text-[22px]">map</span>
            </div>
        </div>
        <h3 class="font-headline-md text-[32px] font-bold text-on-surface">{{ $dalam_daerah }}</h3>
        <div class="mt-3 flex items-center gap-1 text-sm text-on-surface-variant bg-[#F8FAFC] w-fit px-2.5 py-1 rounded-full">
            <span>Total pengajuan</span>
        </div>
    </div>
    <div class="bg-white rounded-2xl p-6 table-shadow border border-outline-variant/20 relative overflow-hidden group hover:border-tertiary/40 transition-colors">
        <div class="flex justify-between items-start mb-6">
            <p class="font-label-md text-sm text-on-surface-variant font-medium">SPPD Luar Daerah</p>
            <div class="p-2.5 bg-tertiary/10 rounded-xl text-tertiary">
                <span class="material-symbols-outlined text-[22px]">flight</span>
            </div>
        </div>
        <h3 class="font-headline-md text-[32px] font-bold text-on-surface">{{ $luar_daerah }}</h3>
        <div class="mt-3 flex items-center gap-1 text-sm text-on-surface-variant bg-[#F8FAFC] w-fit px-2.5 py-1 rounded-full">
            <span>Total pengajuan</span>
        </div>
    </div>
    <div class="bg-white rounded-2xl p-6 table-shadow border border-outline-variant/20 relative overflow-hidden group hover:border-secondary/40 transition-colors">
        <div class="flex justify-between items-start mb-6">
            <p class="font-label-md text-sm text-on-surface-variant font-medium">Total Realisasi Anggaran</p>
            <div class="p-2.5 bg-secondary/10 rounded-xl text-secondary">
                <span class="material-symbols-outlined text-[22px]">payments</span>
            </div>
        </div>
        <h3 class="font-headline-md text-[28px] font-bold text-secondary leading-tight">Rp {{ number_format($total_biaya, 0, ',', '.') }}</h3>
        <div class="mt-3 flex items-center gap-1 text-sm text-secondary font-medium">
            <span>{{ $total_sppd }} SPPD tercatat</span>
        </div>
        <div class="w-full bg-[#F8FAFC] h-2 rounded-full mt-2.5 overflow-hidden ring-1 ring-outline-variant/10">
            <div class="bg-secondary h-full rounded-full w-[65%]"></div>
        </div>
    </div>
</div>

{{-- Recent SPPD Table Section --}}
<div class="bg-surface-container-lowest rounded-2xl table-shadow border border-outline-variant/20 flex flex-col overflow-hidden">
    <div class="p-6 border-b border-outline-variant/20 flex justify-between items-center bg-surface-container-lowest">
        <div>
            <h3 class="font-headline-sm text-xl font-bold text-on-surface">SPPD Terbaru</h3>
            <p class="font-body-md text-sm text-on-surface-variant mt-1">Daftar pengajuan perjalanan dinas terbaru yang perlu ditinjau.</p>
        </div>
        <a href="{{ route('admin.sppd.index') }}" class="text-primary font-label-md text-sm font-semibold hover:bg-primary/5 px-4 py-2 rounded-lg transition-colors flex items-center gap-1.5">
            Lihat Semua <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
        </a>
    </div>
    <div class="overflow-x-auto w-full">
        <table class="w-full text-left border-collapse min-w-[900px]">
            <thead>
                <tr class="bg-[#F8FAFC] border-b border-outline-variant/20 font-label-md text-[11px] text-on-surface-variant uppercase tracking-wider">
                    <th class="px-6 py-4 font-semibold w-32">No. SPPD</th>
                    <th class="px-6 py-4 font-semibold">Nama Pegawai</th>
                    <th class="px-6 py-4 font-semibold">Tujuan</th>
                    <th class="px-6 py-4 font-semibold">Tanggal</th>
                    <th class="px-6 py-4 font-semibold">Jenis</th>
                    <th class="px-6 py-4 font-semibold text-right">Total Biaya (Rp)</th>
                    <th class="px-6 py-4 font-semibold text-center w-24">Aksi</th>
                </tr>
            </thead>
            <tbody class="font-body-md text-sm text-on-surface bg-surface-container-lowest">
                @forelse ($sppd_terbaru as $s)
                    <tr class="border-b border-outline-variant/10 hover-tint transition-colors">
                        <td class="px-6 py-4 font-semibold text-primary">{{ $s->nomor_sppd }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-[#F8FAFC] border border-outline-variant/20 flex items-center justify-center text-on-surface-variant font-bold text-xs flex-shrink-0">{{ strtoupper(substr($s->user->nama_lengkap, 0, 1)) }}</div>
                                <div>
                                    <div class="font-semibold text-on-surface">{{ $s->user->nama_lengkap }}</div>
                                    <div class="text-[13px] text-on-surface-variant mt-0.5">NIP. {{ $s->user->nip }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">{{ $s->tempat_tujuan }}</td>
                        <td class="px-6 py-4 text-on-surface-variant">{{ $s->tanggal_berangkat->translatedFormat('d M Y') }}</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-[12px] font-semibold {{ $s->jenis_perjalanan === 'Dalam Daerah' ? 'bg-primary/10 text-primary' : 'bg-tertiary/10 text-tertiary' }}">
                                {{ $s->jenis_perjalanan }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right font-semibold">Rp {{ number_format($s->total_biaya, 0, ',', '.') }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-1.5">
                                <a href="{{ route('admin.sppd.show', $s) }}" class="text-on-surface-variant hover:text-primary transition-colors p-1.5 rounded-lg hover:bg-primary/10" title="Detail">
                                    <span class="material-symbols-outlined text-[18px]">visibility</span>
                                </a>
                                <a href="{{ route('admin.sppd.edit', $s) }}" class="text-on-surface-variant hover:text-[#F59E0B] transition-colors p-1.5 rounded-lg hover:bg-[#F59E0B]/10" title="Edit">
                                    <span class="material-symbols-outlined text-[18px]">edit</span>
                                </a>
                                <form method="POST" action="{{ route('admin.sppd.destroy', $s) }}" class="inline"
                                      data-confirm data-confirm-title="Hapus SPPD?"
                                      data-confirm-text="SPPD {{ $s->nomor_sppd }} beserta rincian dan lampirannya akan dihapus.">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-on-surface-variant hover:text-error transition-colors p-1.5 rounded-lg hover:bg-error/10" title="Hapus">
                                        <span class="material-symbols-outlined text-[18px]">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-16 text-center text-on-surface-variant">
                            <span class="material-symbols-outlined text-[40px] opacity-40 block mb-2">inbox</span>
                            Belum ada data SPPD.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-4 sm:px-6 py-4 border-t border-outline-variant/20 flex flex-wrap items-center justify-between gap-3 bg-surface-container-lowest">
        <span class="text-sm text-on-surface-variant font-medium">Menampilkan {{ $sppd_terbaru->count() }} SPPD terbaru</span>
        <div class="flex items-center gap-2">
            <button class="p-1.5 rounded-lg border border-outline-variant/30 text-on-surface-variant hover:bg-[#F8FAFC] disabled:opacity-50 transition-colors" disabled>
                <span class="material-symbols-outlined text-[18px]">chevron_left</span>
            </button>
            <button class="w-8 h-8 rounded-lg bg-primary text-on-primary font-semibold text-sm flex items-center justify-center shadow-sm">1</button>
            <button class="p-1.5 rounded-lg border border-outline-variant/30 text-on-surface-variant hover:bg-[#F8FAFC] transition-colors" disabled>
                <span class="material-symbols-outlined text-[18px]">chevron_right</span>
            </button>
        </div>
    </div>
</div>
@endsection
