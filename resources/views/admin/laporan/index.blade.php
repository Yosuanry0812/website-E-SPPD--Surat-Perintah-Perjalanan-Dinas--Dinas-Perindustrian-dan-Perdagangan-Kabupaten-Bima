@extends('layouts.app')

@section('title', 'Rekapitulasi SPPD')

@section('content')
{{-- Page Header --}}
<div class="mb-8 flex flex-col md:flex-row justify-between items-start md:items-end gap-4">
    <div>
        <h2 class="font-headline-md text-headline-md text-on-surface mb-2">Rekapitulasi Laporan SPPD</h2>
        <p class="font-body-md text-body-md text-on-surface-variant max-w-2xl">
            Filter, tinjau, dan ekspor data perjalanan dinas staf untuk keperluan pelaporan dan audit keuangan daerah.
        </p>
    </div>
</div>

{{-- Filter Toolbar --}}
<form method="GET" action="{{ route('admin.laporan.index') }}" class="anim-results bg-surface-container-low rounded-xl p-5 mb-8 border border-outline-variant/60 shadow-sm flex flex-col md:flex-row gap-6 items-end">
    <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-5">
        <div class="flex flex-col gap-1.5">
            <label class="font-label-md text-label-md text-on-surface-variant" for="filter-bulan">Bulan / Tahun</label>
            <div class="relative">
                <input type="month" id="filter-bulan" name="bulan" value="{{ $bulan }}"
                       class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg py-2.5 pl-4 pr-10 font-body-md text-body-md text-on-surface custom-input-focus transition-all duration-200">
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-on-surface-variant">
                    <span class="material-symbols-outlined" style="font-size: 20px;">calendar_month</span>
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-1.5">
            <label class="font-label-md text-label-md text-on-surface-variant" for="filter-pegawai">Nama Pegawai</label>
            <div class="relative">
                <select class="w-full appearance-none bg-surface-container-lowest border border-outline-variant rounded-lg py-2.5 pl-4 pr-10 font-body-md text-body-md text-on-surface custom-input-focus transition-all duration-200" id="filter-pegawai" name="user_id">
                    <option value="">Semua Pegawai</option>
                    @foreach ($staf as $s)
                        <option value="{{ $s->id }}" @selected($user_id == $s->id)>{{ $s->nama_lengkap }}</option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-on-surface-variant">
                    <span class="material-symbols-outlined" style="font-size: 20px;">expand_more</span>
                </div>
            </div>
        </div>
    </div>
    <div class="flex gap-4 w-full md:w-auto">
        <button type="submit" class="flex-1 md:flex-none py-2.5 px-6 bg-surface-container-lowest border border-outline-variant text-on-surface rounded-lg font-label-md text-label-md hover:bg-surface-container-high transition-colors flex items-center justify-center gap-2 shadow-sm">
            <span class="material-symbols-outlined" style="font-size: 18px;">filter_list</span>
            Terapkan
        </button>
        <a href="{{ route('admin.laporan.export', ['bulan' => $bulan, 'user_id' => $user_id ?? '']) }}" class="flex-1 md:flex-none py-2.5 px-4 sm:px-8 bg-primary text-on-primary rounded-lg font-label-md text-label-md hover:bg-primary/90 transition-colors flex items-center justify-center gap-2 shadow-md">
            <span class="material-symbols-outlined" style="font-size: 20px;">picture_as_pdf</span>
            Export PDF
        </a>
    </div>
</form>

{{-- Report Summary --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="anim-results p-6 border border-outline-variant bg-surface-container-lowest rounded-xl shadow-sm">
        <p class="text-sm font-label-md text-on-surface-variant mb-1 uppercase tracking-wider">Total Laporan (Periode Ini)</p>
        <p class="text-3xl font-bold font-display-lg text-on-surface mt-2">{{ $sppds->count() }} <span class="text-sm font-normal text-on-surface-variant">Laporan</span></p>
    </div>
    <div class="anim-results anim-results-delay-1 p-6 border border-outline-variant bg-surface-container-lowest rounded-xl shadow-sm">
        <p class="text-sm font-label-md text-on-surface-variant mb-1 uppercase tracking-wider">Total Anggaran Terserap</p>
        <p class="text-3xl font-bold font-display-lg text-primary mt-2">Rp {{ number_format($sppds->sum('total_biaya'), 0, ',', '.') }}</p>
    </div>
    <div class="anim-results anim-results-delay-2 p-6 border border-outline-variant bg-surface-container-lowest rounded-xl shadow-sm">
        <p class="text-sm font-label-md text-on-surface-variant mb-1 uppercase tracking-wider">Pegawai Bertugas</p>
        <p class="text-3xl font-bold font-display-lg text-on-surface mt-2">{{ $sppds->pluck('user_id')->unique()->count() }} <span class="text-sm font-normal text-on-surface-variant">Orang</span></p>
    </div>
</div>

{{-- Data Table --}}
<div class="anim-results anim-results-delay-3 bg-surface-container-lowest border border-outline shadow-md rounded-xl overflow-hidden">
    <div class="px-4 sm:px-8 py-6 border-b-2 border-on-surface flex justify-between items-center bg-surface-container-lowest">
        <div>
            <h3 class="font-headline-sm text-2xl text-on-surface mb-1">Pratinjau Dokumen Resmi</h3>
            <p class="font-body-md text-on-surface-variant">Periode Pelaporan: {{ \Carbon\Carbon::createFromFormat('Y-m', $bulan)->translatedFormat('F Y') }}</p>
        </div>
        <span class="font-label-md text-sm text-on-surface-variant bg-surface-container py-1 px-3 rounded-full border border-outline-variant">Rekapitulasi SPPD</span>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-surface sticky top-0 z-10 sticky-header-shadow">
                <tr>
                    <th class="py-4 px-4 sm:px-8 font-label-md text-label-md text-on-surface uppercase tracking-wider whitespace-nowrap">Nama Staf &amp; NIP</th>
                    <th class="py-4 px-4 sm:px-8 font-label-md text-label-md text-on-surface uppercase tracking-wider whitespace-nowrap">Nomor SPPD</th>
                    <th class="py-4 px-4 sm:px-8 font-label-md text-label-md text-on-surface uppercase tracking-wider whitespace-nowrap">Tujuan &amp; Kategori</th>
                    <th class="py-4 px-4 sm:px-8 font-label-md text-label-md text-on-surface uppercase tracking-wider whitespace-nowrap">Durasi</th>
                    <th class="py-4 px-4 sm:px-8 font-label-md text-label-md text-on-surface text-right uppercase tracking-wider whitespace-nowrap">Total Anggaran (Rp)</th>
                </tr>
            </thead>
            <tbody class="font-data-table text-data-table text-on-surface divide-y divide-outline-variant">
                @forelse ($sppds as $s)
                    <tr class="hover:bg-surface-container-low transition-colors duration-150">
                        <td class="py-5 px-4 sm:px-8 whitespace-nowrap">
                            <div class="font-bold text-on-surface">{{ $s->user->nama_lengkap }}</div>
                            <div class="text-xs text-on-surface-variant font-normal mt-1">NIP: {{ $s->user->nip }}</div>
                        </td>
                        <td class="py-5 px-4 sm:px-8 whitespace-nowrap font-medium text-on-surface-variant">{{ $s->nomor_sppd }}</td>
                        <td class="py-5 px-4 sm:px-8 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                {{ $s->tempat_tujuan }}
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-sm border text-xs font-semibold {{ $s->jenis_perjalanan === 'Dalam Daerah' ? 'border-primary/30 bg-primary/5 text-primary' : 'border-tertiary/30 bg-tertiary/5 text-tertiary' }}">
                                    {{ $s->jenis_perjalanan }}
                                </span>
                            </div>
                        </td>
                        <td class="py-5 px-4 sm:px-8 whitespace-nowrap">{{ $s->jumlah_hari }} Hari</td>
                        <td class="py-5 px-4 sm:px-8 text-right whitespace-nowrap font-medium">{{ number_format($s->total_biaya, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-16 text-center text-on-surface-variant">
                            <span class="material-symbols-outlined text-[40px] opacity-40 block mb-2">inbox</span>
                            Tidak ada data SPPD pada periode ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>
            @if ($sppds->isNotEmpty())
                <tfoot class="bg-surface-container-lowest border-t-2 border-on-surface font-data-table font-bold text-on-surface">
                    <tr>
                        <td class="py-5 px-4 sm:px-8 text-right uppercase tracking-wider" colspan="4">Total Keseluruhan ({{ \Carbon\Carbon::createFromFormat('Y-m', $bulan)->translatedFormat('F Y') }})</td>
                        <td class="py-5 px-4 sm:px-8 text-right text-primary text-xl">Rp {{ number_format($sppds->sum('total_biaya'), 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            @endif
        </table>
    </div>
</div>
@endsection
