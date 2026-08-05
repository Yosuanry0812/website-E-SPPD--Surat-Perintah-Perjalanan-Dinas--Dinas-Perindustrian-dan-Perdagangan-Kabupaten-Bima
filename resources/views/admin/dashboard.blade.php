@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<h4 class="fw-bold mb-4"><i class="bi bi-speedometer2 me-2"></i>Dashboard Administrator</h4>

<div class="row g-3 mb-4">
    <div class="col-md-6 col-xl-3">
        <div class="card text-white bg-primary">
            <div class="card-body d-flex align-items-center gap-3">
                <i class="bi bi-people-fill stat-icon"></i>
                <div>
                    <div class="fs-4 fw-bold">{{ $total_staf }}</div>
                    <div class="small opacity-75">Total Akun Staf</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card text-white bg-success">
            <div class="card-body d-flex align-items-center gap-3">
                <i class="bi bi-geo-alt-fill stat-icon"></i>
                <div>
                    <div class="fs-4 fw-bold">{{ $dalam_daerah }}</div>
                    <div class="small opacity-75">SPPD Dalam Daerah</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card text-white bg-info">
            <div class="card-body d-flex align-items-center gap-3">
                <i class="bi bi-airplane-fill stat-icon"></i>
                <div>
                    <div class="fs-4 fw-bold">{{ $luar_daerah }}</div>
                    <div class="small opacity-75">SPPD Luar Daerah</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card text-white bg-warning">
            <div class="card-body d-flex align-items-center gap-3">
                <i class="bi bi-cash-coin stat-icon"></i>
                <div>
                    <div class="fs-4 fw-bold">Rp {{ number_format($total_biaya, 0, ',', '.') }}</div>
                    <div class="small opacity-75">Total Realisasi ({{ $total_sppd }} SPPD)</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header bg-white fw-bold"><i class="bi bi-clock-history me-1"></i>5 SPPD Terbaru</div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nomor SPPD</th>
                    <th>Staf</th>
                    <th>Jenis</th>
                    <th>Tujuan</th>
                    <th>Tanggal</th>
                    <th class="text-end">Total Biaya</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($sppd_terbaru as $i => $s)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $s->nomor_sppd }}</td>
                        <td>{{ $s->user->nama_lengkap }}</td>
                        <td>
                            <span class="badge {{ $s->jenis_perjalanan === 'Dalam Daerah' ? 'bg-success' : 'bg-primary' }}">
                                {{ $s->jenis_perjalanan }}
                            </span>
                        </td>
                        <td>{{ $s->tempat_tujuan }}</td>
                        <td>{{ $s->tanggal_berangkat->format('d/m/Y') }}</td>
                        <td class="text-end fw-semibold">Rp {{ number_format($s->total_biaya, 0, ',', '.') }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.sppd.show', $s) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8" class="text-center text-muted py-4">Belum ada data SPPD.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
