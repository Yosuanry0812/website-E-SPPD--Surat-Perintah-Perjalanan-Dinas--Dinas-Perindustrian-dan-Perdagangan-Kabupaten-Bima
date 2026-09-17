@extends('layouts.app')

@section('title', 'Kelola SPPD')

@section('content')
{{-- Header --}}
<div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4">
    <div>
        <h2 class="font-display-lg text-[32px] font-bold text-on-surface tracking-tight">Data SPPD</h2>
        <p class="font-body-lg text-body-lg text-on-surface-variant mt-1">Seluruh pengajuan SPPD dari semua staf.</p>
    </div>
</div>

{{-- Filter Toolbar --}}
<div class="anim-results bg-surface-container-low rounded-xl p-5 border border-outline-variant/60 shadow-sm flex flex-col md:flex-row gap-6 items-end">
    <form method="GET" action="{{ route('admin.sppd.index') }}" class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-5 items-end">
        <div class="flex flex-col gap-1.5">
            <label class="font-label-md text-label-md text-on-surface-variant" for="filter-user">Staf</label>
            <div class="relative">
                <select class="w-full appearance-none bg-surface-container-lowest border border-outline-variant rounded-lg py-2.5 pl-4 pr-10 font-body-md text-body-md text-on-surface custom-input-focus transition-all duration-200" id="filter-user" name="user_id">
                    <option value="">-- Semua Staf --</option>
                    @foreach ($staf as $s)
                        <option value="{{ $s->id }}" @selected(request('user_id') == $s->id)>{{ $s->nama_lengkap }}</option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-on-surface-variant">
                    <span class="material-symbols-outlined" style="font-size: 20px;">expand_more</span>
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-1.5">
            <label class="font-label-md text-label-md text-on-surface-variant" for="filter-jenis">Jenis Perjalanan</label>
            <div class="relative">
                <select class="w-full appearance-none bg-surface-container-lowest border border-outline-variant rounded-lg py-2.5 pl-4 pr-10 font-body-md text-body-md text-on-surface custom-input-focus transition-all duration-200" id="filter-jenis" name="jenis">
                    <option value="">-- Semua Jenis --</option>
                    <option value="Dalam Daerah" @selected(request('jenis') === 'Dalam Daerah')>Dalam Daerah</option>
                    <option value="Luar Daerah" @selected(request('jenis') === 'Luar Daerah')>Luar Daerah</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-on-surface-variant">
                    <span class="material-symbols-outlined" style="font-size: 20px;">expand_more</span>
                </div>
            </div>
        </div>
        <div class="flex gap-4 md:col-span-2">
            <button type="submit" class="py-2.5 px-6 bg-primary text-on-primary rounded-lg font-label-md text-label-md hover:bg-primary/90 transition-colors flex items-center justify-center gap-2 shadow-md">
                <span class="material-symbols-outlined" style="font-size: 18px;">filter_list</span>
                Terapkan
            </button>
            @if (request('user_id') || request('jenis'))
                <a href="{{ route('admin.sppd.index') }}" class="py-2.5 px-6 bg-surface-container-lowest border border-outline-variant text-on-surface rounded-lg font-label-md text-label-md hover:bg-surface-container-high transition-colors flex items-center justify-center gap-2 shadow-sm">
                    <span class="material-symbols-outlined" style="font-size: 18px;">clear</span>
                    Reset
                </a>
            @endif
        </div>
    </form>
</div>

{{-- Table --}}
<div class="anim-results anim-results-delay-1 bg-surface-container-lowest rounded-2xl table-shadow border border-outline-variant/20 overflow-hidden">
    <div class="overflow-x-auto w-full">
        <table class="w-full text-left border-collapse min-w-[900px]">
            <thead>
                <tr class="bg-[#F8FAFC] border-b border-outline-variant/20 font-label-md text-[11px] text-on-surface-variant uppercase tracking-wider">
                    <th class="px-6 py-4 font-semibold">Nomor SPPD</th>
                    <th class="px-6 py-4 font-semibold">Staf</th>
                    <th class="px-6 py-4 font-semibold">Jenis</th>
                    <th class="px-6 py-4 font-semibold">Tujuan</th>
                    <th class="px-6 py-4 font-semibold">Tanggal</th>
                    <th class="px-6 py-4 font-semibold text-center">Hari</th>
                    <th class="px-6 py-4 font-semibold text-right">Total Biaya (Rp)</th>
                    <th class="px-6 py-4 font-semibold text-center w-28">Aksi</th>
                </tr>
            </thead>
            <tbody class="font-body-md text-sm text-on-surface bg-surface-container-lowest">
                @forelse ($sppds as $s)
                    <tr class="border-b border-outline-variant/10 hover-tint transition-colors">
                        <td class="px-6 py-4 font-semibold text-primary">{{ $s->nomor_sppd }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-[#F8FAFC] border border-outline-variant/20 flex items-center justify-center text-on-surface-variant font-bold text-xs flex-shrink-0">{{ strtoupper(substr($s->user->nama_lengkap, 0, 1)) }}</div>
                                <span class="font-medium">{{ $s->user->nama_lengkap }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-[12px] font-semibold {{ $s->jenis_perjalanan === 'Dalam Daerah' ? 'bg-primary/10 text-primary' : 'bg-tertiary/10 text-tertiary' }}">
                                {{ $s->jenis_perjalanan }}
                            </span>
                        </td>
                        <td class="px-6 py-4">{{ $s->tempat_tujuan }}</td>
                        <td class="px-6 py-4 text-on-surface-variant">{{ $s->tanggal_berangkat->translatedFormat('d M Y') }}</td>
                        <td class="px-6 py-4 text-center">{{ $s->jumlah_hari }}</td>
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
                        <td colspan="8" class="px-6 py-16 text-center text-on-surface-variant">
                            <span class="material-symbols-outlined text-[40px] opacity-40 block mb-2">inbox</span>
                            Tidak ada data SPPD.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-4 sm:px-6 py-4 border-t border-outline-variant/20 flex flex-wrap items-center justify-between gap-3 bg-surface-container-lowest">
        <span class="text-sm text-on-surface-variant font-medium">Menampilkan {{ $sppds->count() }} SPPD</span>
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
