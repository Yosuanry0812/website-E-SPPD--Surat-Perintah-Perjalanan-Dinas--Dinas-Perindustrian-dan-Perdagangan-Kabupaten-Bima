<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><i class="bi bi-file-earmark-text me-2"></i>Detail SPPD</h4>
    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i>Kembali</a>
</div>

<div class="row g-3">
    {{-- Informasi dasar --}}
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-header bg-white fw-bold"><i class="bi bi-info-circle me-1"></i>Informasi Dasar</div>
            <div class="card-body">
                <table class="table table-sm mb-0">
                    <tr><th style="width:40%">Nomor SPPD</th><td>: {{ $sppd->nomor_sppd }}</td></tr>
                    <tr><th>Nomor Surat Tugas</th><td>: {{ $sppd->nomor_surat_tugas }}</td></tr>
                    <tr><th>Jenis Perjalanan</th><td>: {{ $sppd->jenis_perjalanan }}</td></tr>
                    <tr><th>Keperluan</th><td>: {{ $sppd->keperluan }}</td></tr>
                    <tr><th>Tempat Tujuan</th><td>: {{ $sppd->tempat_tujuan }}</td></tr>
                    <tr><th>Tanggal</th><td>: {{ $sppd->tanggal_berangkat->format('d/m/Y') }} s/d {{ $sppd->tanggal_kembali->format('d/m/Y') }}</td></tr>
                    <tr><th>Jumlah Hari</th><td>: {{ $sppd->jumlah_hari }} hari</td></tr>
                </table>
            </div>
        </div>
    </div>

    {{-- Pelaksana --}}
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-header bg-white fw-bold"><i class="bi bi-person-badge me-1"></i>Pelaksana</div>
            <div class="card-body">
                <table class="table table-sm mb-0">
                    <tr><th style="width:40%">NIP</th><td>: {{ $sppd->user->nip }}</td></tr>
                    <tr><th>Nama</th><td>: {{ $sppd->user->nama_lengkap }}</td></tr>
                    <tr><th>Jabatan</th><td>: {{ $sppd->user->jabatan }}</td></tr>
                    <tr><th>Pangkat/Golongan</th><td>: {{ $sppd->user->pangkat_golongan }}</td></tr>
                </table>
            </div>
        </div>
    </div>

    {{-- Rincian biaya harian --}}
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-white fw-bold"><i class="bi bi-cash-stack me-1"></i>Rincian Biaya Harian</div>
            <div class="table-responsive">
                <table class="table table-sm align-middle mb-0">
                    <thead><tr><th>Jenis Biaya</th><th class="text-end">Biaya/Hari</th><th class="text-center">Jml Hari</th><th class="text-end">Total</th></tr></thead>
                    <tbody>
                        @forelse ($sppd->rincianBiayaHarian as $r)
                            <tr>
                                <td>{{ $r->jenis_biaya }}</td>
                                <td class="text-end">Rp {{ number_format($r->biaya_per_hari, 0, ',', '.') }}</td>
                                <td class="text-center">{{ $r->jumlah_hari }}</td>
                                <td class="text-end">Rp {{ number_format($r->total, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="text-center text-muted">Tidak ada rincian biaya harian.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Penginapan --}}
    @if ($sppd->penginapan->isNotEmpty())
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white fw-bold"><i class="bi bi-building me-1"></i>Penginapan</div>
                <div class="table-responsive">
                    <table class="table table-sm align-middle mb-0">
                        <thead><tr><th>Hotel</th><th>Kamar</th><th>Telp</th><th>Check In</th><th>Check Out</th><th class="text-end">Biaya/Malam</th><th class="text-end">Total</th></tr></thead>
                        <tbody>
                            @foreach ($sppd->penginapan as $p)
                                <tr>
                                    <td>{{ $p->nama_hotel }}</td>
                                    <td>{{ $p->nomor_kamar }}</td>
                                    <td>{{ $p->no_telp_hotel }}</td>
                                    <td>{{ $p->tanggal_check_in->format('d/m/Y') }}</td>
                                    <td>{{ $p->tanggal_check_out->format('d/m/Y') }}</td>
                                    <td class="text-end">Rp {{ number_format($p->biaya_per_malam, 0, ',', '.') }}</td>
                                    <td class="text-end">Rp {{ number_format($p->total_biaya, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif

    {{-- Transportasi --}}
    @if ($sppd->transportasi->isNotEmpty())
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white fw-bold"><i class="bi bi-airplane me-1"></i>Transportasi</div>
                <div class="table-responsive">
                    <table class="table table-sm align-middle mb-0">
                        <thead><tr><th>Jenis</th><th>Deskripsi</th><th>Rute</th><th>Tanggal</th><th>No. Tiket</th><th class="text-end">Harga</th></tr></thead>
                        <tbody>
                            @foreach ($sppd->transportasi as $t)
                                <tr>
                                    <td>{{ $t->jenis_transportasi }}</td>
                                    <td>{{ $t->deskripsi }}</td>
                                    <td>{{ $t->rute_dari }} → {{ $t->rute_tujuan }}</td>
                                    <td>{{ $t->tanggal_berangkat->format('d/m/Y') }}</td>
                                    <td>{{ $t->nomor_tiket ?: '-' }}</td>
                                    <td class="text-end">Rp {{ number_format($t->biaya_total, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif

    {{-- Lampiran --}}
    @if ($sppd->lampiran->isNotEmpty())
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white fw-bold"><i class="bi bi-paperclip me-1"></i>Lampiran Kwitansi</div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @foreach ($sppd->lampiran as $l)
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <span><i class="bi bi-file-earmark me-2"></i>{{ $l->nama_file }}</span>
                                <a href="{{ asset('storage/' . $l->path_file) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-download me-1"></i>Lihat
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    {{-- Total --}}
    <div class="col-12">
        <div class="card bg-primary text-white">
            <div class="card-body d-flex justify-content-between align-items-center py-3">
                <span class="fs-6"><i class="bi bi-calculator me-1"></i><strong>TOTAL BIAYA SPPD</strong></span>
                <span class="fs-4 fw-bold">Rp {{ number_format($sppd->total_biaya, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>
</div>
