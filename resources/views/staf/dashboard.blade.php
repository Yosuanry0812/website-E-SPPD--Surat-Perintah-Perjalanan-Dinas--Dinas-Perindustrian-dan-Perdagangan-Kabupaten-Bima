@extends('layouts.app')

@section('title', 'Dashboard Staf')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0">Selamat Datang, {{ auth()->user()->nama_lengkap }}</h4>
        <small class="text-muted">{{ auth()->user()->jabatan }} • {{ auth()->user()->pangkat_golongan }}</small>
    </div>
    <a href="{{ route('staf.sppd.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i>Buat SPPD Baru
    </a>
</div>

<div class="card">
    <div class="card-header bg-white fw-bold"><i class="bi bi-clock-history me-1"></i>Riwayat Pengajuan SPPD Saya</div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nomor SPPD</th>
                    <th>Jenis</th>
                    <th>Tujuan</th>
                    <th>Tanggal</th>
                    <th>Hari</th>
                    <th class="text-end">Total Biaya</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($riwayat as $i => $s)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $s->nomor_sppd }}</td>
                        <td>
                            <span class="badge {{ $s->jenis_perjalanan === 'Dalam Daerah' ? 'bg-success' : 'bg-primary' }}">
                                {{ $s->jenis_perjalanan }}
                            </span>
                        </td>
                        <td>{{ $s->tempat_tujuan }}</td>
                        <td>{{ $s->tanggal_berangkat->format('d/m/Y') }} s/d {{ $s->tanggal_kembali->format('d/m/Y') }}</td>
                        <td>{{ $s->jumlah_hari }}</td>
                        <td class="text-end fw-semibold">Rp {{ number_format($s->total_biaya, 0, ',', '.') }}</td>
                        <td class="text-center">
                            <a href="{{ route('staf.sppd.show', $s) }}" class="btn btn-sm btn-outline-primary" title="Detail">
                                <i class="bi bi-eye"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">
                            Belum ada pengajuan SPPD. <a href="{{ route('staf.sppd.create') }}">Buat sekarang</a>.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
