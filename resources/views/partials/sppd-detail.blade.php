{{-- Header --}}
<div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4">
    <div>
        <h2 class="font-display-lg text-[32px] font-bold text-on-surface tracking-tight">Detail SPPD</h2>
        <p class="font-body-lg text-body-lg text-on-surface-variant mt-1">{{ $sppd->nomor_sppd }}</p>
    </div>
    <a href="{{ url()->previous() }}" class="px-4 py-2.5 border border-outline-variant/40 text-on-surface rounded-xl font-label-md text-label-md flex items-center gap-2 hover:bg-[#F8FAFC] transition-colors bg-surface-container-lowest shadow-sm">
        <span class="material-symbols-outlined text-[18px]">arrow_back</span>
        Kembali
    </a>
</div>

{{-- Info Cards --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="bg-surface-container-lowest rounded-2xl table-shadow border border-outline-variant/20 overflow-hidden">
        <div class="px-6 py-4 border-b border-outline-variant/20 flex items-center gap-2">
            <span class="material-symbols-outlined text-primary text-[20px]">info</span>
            <h3 class="font-headline-sm text-lg font-bold text-on-surface">Informasi Dasar</h3>
        </div>
        <div class="p-6 space-y-4">
            @php
                $rows = [
                    'Nomor SPPD' => $sppd->nomor_sppd,
                    'Nomor Surat Tugas' => $sppd->nomor_surat_tugas,
                    'Keperluan' => $sppd->keperluan,
                    'Tempat Tujuan' => $sppd->tempat_tujuan,
                    'Tanggal' => $sppd->tanggal_berangkat->translatedFormat('d F Y') . ' — ' . $sppd->tanggal_kembali->translatedFormat('d F Y'),
                    'Jumlah Hari' => $sppd->jumlah_hari . ' hari',
                ];
            @endphp
            @foreach ($rows as $label => $value)
                <div class="flex flex-col gap-0.5">
                    <span class="text-[11px] uppercase tracking-wider text-on-surface-variant font-semibold">{{ $label }}</span>
                    <span class="text-sm text-on-surface font-medium">{{ $value }}</span>
                </div>
            @endforeach
            <div class="flex flex-col gap-0.5">
                <span class="text-[11px] uppercase tracking-wider text-on-surface-variant font-semibold">Jenis Perjalanan</span>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-[12px] font-semibold w-fit {{ $sppd->jenis_perjalanan === 'Dalam Daerah' ? 'bg-primary/10 text-primary' : 'bg-tertiary/10 text-tertiary' }}">
                    {{ $sppd->jenis_perjalanan }}
                </span>
            </div>
        </div>
    </div>
    <div class="bg-surface-container-lowest rounded-2xl table-shadow border border-outline-variant/20 overflow-hidden">
        <div class="px-6 py-4 border-b border-outline-variant/20 flex items-center gap-2">
            <span class="material-symbols-outlined text-primary text-[20px]">badge</span>
            <h3 class="font-headline-sm text-lg font-bold text-on-surface">Pelaksana</h3>
        </div>
        <div class="p-6 space-y-4">
            @php
                $rows = [
                    'NIP' => $sppd->user->nip,
                    'Nama' => $sppd->user->nama_lengkap,
                    'Jabatan' => $sppd->user->jabatan,
                    'Pangkat / Golongan' => $sppd->user->pangkat_golongan,
                ];
            @endphp
            @foreach ($rows as $label => $value)
                <div class="flex flex-col gap-0.5">
                    <span class="text-[11px] uppercase tracking-wider text-on-surface-variant font-semibold">{{ $label }}</span>
                    <span class="text-sm text-on-surface font-semibold">{{ $value }}</span>
                </div>
            @endforeach
        </div>
    </div>
</div>

{{-- Rincian Biaya Harian --}}
<div class="bg-surface-container-lowest rounded-2xl table-shadow border border-outline-variant/20 overflow-hidden">
    <div class="px-6 py-4 border-b border-outline-variant/20 flex items-center gap-2">
        <span class="material-symbols-outlined text-primary text-[20px]">payments</span>
        <h3 class="font-headline-sm text-lg font-bold text-on-surface">Rincian Biaya Harian</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse min-w-[640px]">
            <thead>
                <tr class="bg-[#F8FAFC] border-b border-outline-variant/20 font-label-md text-[11px] text-on-surface-variant uppercase tracking-wider">
                    <th class="px-6 py-4 font-semibold">Jenis Biaya</th>
                    <th class="px-6 py-4 font-semibold text-right">Biaya / Hari</th>
                    <th class="px-6 py-4 font-semibold text-center">Jml Hari</th>
                    <th class="px-6 py-4 font-semibold text-right">Total</th>
                </tr>
            </thead>
            <tbody class="font-body-md text-sm text-on-surface">
                @forelse ($sppd->rincianBiayaHarian as $r)
                    <tr class="border-b border-outline-variant/10 hover-tint transition-colors">
                        <td class="px-6 py-4">{{ $r->jenis_biaya }}</td>
                        <td class="px-6 py-4 text-right">Rp {{ number_format($r->biaya_per_hari, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 text-center">{{ $r->jumlah_hari }}</td>
                        <td class="px-6 py-4 text-right font-semibold">Rp {{ number_format($r->total, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-on-surface-variant">Tidak ada rincian biaya harian.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Penginapan --}}
@if ($sppd->penginapan->isNotEmpty())
    <div class="bg-surface-container-lowest rounded-2xl table-shadow border border-outline-variant/20 overflow-hidden">
        <div class="px-6 py-4 border-b border-outline-variant/20 flex items-center gap-2">
            <span class="material-symbols-outlined text-primary text-[20px]">hotel</span>
            <h3 class="font-headline-sm text-lg font-bold text-on-surface">Penginapan</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[860px]">
                <thead>
                    <tr class="bg-[#F8FAFC] border-b border-outline-variant/20 font-label-md text-[11px] text-on-surface-variant uppercase tracking-wider">
                        <th class="px-6 py-4 font-semibold">Hotel</th>
                        <th class="px-6 py-4 font-semibold">Kamar</th>
                        <th class="px-6 py-4 font-semibold">Telp</th>
                        <th class="px-6 py-4 font-semibold">Check In</th>
                        <th class="px-6 py-4 font-semibold">Check Out</th>
                        <th class="px-6 py-4 font-semibold text-right">Biaya / Malam</th>
                        <th class="px-6 py-4 font-semibold text-right">Total</th>
                    </tr>
                </thead>
                <tbody class="font-body-md text-sm text-on-surface">
                    @foreach ($sppd->penginapan as $p)
                        <tr class="border-b border-outline-variant/10 hover-tint transition-colors">
                            <td class="px-6 py-4 font-medium">{{ $p->nama_hotel }}</td>
                            <td class="px-6 py-4">{{ $p->nomor_kamar }}</td>
                            <td class="px-6 py-4">{{ $p->no_telp_hotel }}</td>
                            <td class="px-6 py-4 text-on-surface-variant">{{ $p->tanggal_check_in->translatedFormat('d M Y') }}</td>
                            <td class="px-6 py-4 text-on-surface-variant">{{ $p->tanggal_check_out->translatedFormat('d M Y') }}</td>
                            <td class="px-6 py-4 text-right">Rp {{ number_format($p->biaya_per_malam, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-right font-semibold">Rp {{ number_format($p->total_biaya, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif

{{-- Transportasi --}}
@if ($sppd->transportasi->isNotEmpty())
    <div class="bg-surface-container-lowest rounded-2xl table-shadow border border-outline-variant/20 overflow-hidden">
        <div class="px-6 py-4 border-b border-outline-variant/20 flex items-center gap-2">
            <span class="material-symbols-outlined text-primary text-[20px]">flight_takeoff</span>
            <h3 class="font-headline-sm text-lg font-bold text-on-surface">Transportasi</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[860px]">
                <thead>
                    <tr class="bg-[#F8FAFC] border-b border-outline-variant/20 font-label-md text-[11px] text-on-surface-variant uppercase tracking-wider">
                        <th class="px-6 py-4 font-semibold">Jenis</th>
                        <th class="px-6 py-4 font-semibold">Deskripsi</th>
                        <th class="px-6 py-4 font-semibold">Rute</th>
                        <th class="px-6 py-4 font-semibold">Tanggal</th>
                        <th class="px-6 py-4 font-semibold">No. Tiket</th>
                        <th class="px-6 py-4 font-semibold text-right">Harga</th>
                    </tr>
                </thead>
                <tbody class="font-body-md text-sm text-on-surface">
                    @foreach ($sppd->transportasi as $t)
                        <tr class="border-b border-outline-variant/10 hover-tint transition-colors">
                            <td class="px-6 py-4 font-medium">{{ $t->jenis_transportasi }}</td>
                            <td class="px-6 py-4">{{ $t->deskripsi }}</td>
                            <td class="px-6 py-4">{{ $t->rute_dari }} &rarr; {{ $t->rute_tujuan }}</td>
                            <td class="px-6 py-4 text-on-surface-variant">{{ $t->tanggal_berangkat->translatedFormat('d M Y') }}</td>
                            <td class="px-6 py-4">{{ $t->nomor_tiket ?: '-' }}</td>
                            <td class="px-6 py-4 text-right font-semibold">Rp {{ number_format($t->biaya_total, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif

{{-- Lampiran --}}
@if ($sppd->lampiran->isNotEmpty())
    <div class="bg-surface-container-lowest rounded-2xl table-shadow border border-outline-variant/20 overflow-hidden">
        <div class="px-6 py-4 border-b border-outline-variant/20 flex items-center gap-2">
            <span class="material-symbols-outlined text-primary text-[20px]">attach_file</span>
            <h3 class="font-headline-sm text-lg font-bold text-on-surface">Lampiran Kwitansi</h3>
        </div>
        <div class="p-6 flex flex-wrap gap-3">
            @foreach ($sppd->lampiran as $l)
                <a href="{{ asset('storage/' . $l->path_file) }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2.5 border border-outline-variant/40 text-on-surface rounded-lg font-label-md text-sm hover:border-primary hover:text-primary transition-colors">
                    <span class="material-symbols-outlined text-[18px]">file_open</span>
                    {{ $l->nama_file }}
                    <span class="material-symbols-outlined text-[16px] opacity-60">open_in_new</span>
                </a>
            @endforeach
        </div>
    </div>
@endif

{{-- Total --}}
<div class="flex flex-wrap items-center justify-between gap-3 bg-secondary/10 border border-secondary/30 rounded-2xl px-5 md:px-8 py-5 md:py-6">
    <span class="font-label-md text-label-md text-secondary uppercase tracking-wider flex items-center gap-2">
        <span class="material-symbols-outlined text-[20px]">calculators</span>
        Total Biaya SPPD
    </span>
    <span class="font-headline-md text-3xl font-bold text-secondary">Rp {{ number_format($sppd->total_biaya, 0, ',', '.') }}</span>
</div>
