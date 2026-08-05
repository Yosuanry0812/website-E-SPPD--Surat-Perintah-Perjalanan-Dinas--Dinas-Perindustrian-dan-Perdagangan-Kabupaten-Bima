@extends('layouts.app')

@section('title', 'Data SPPD')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><i class="bi bi-journal-text me-2"></i>Data SPPD Seluruh Staf</h4>
</div>

<div class="card mb-3">
    <div class="card-body">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-md-4">
                <label class="form-label small mb-1">Filter Staf</label>
                <select name="user_id" class="form-select">
                    <option value="">-- Semua Staf --</option>
                    @foreach ($staf as $s)
                        <option value="{{ $s->id }}" @selected(request('user_id') == $s->id)>{{ $s->nama_lengkap }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label small mb-1">Jenis Perjalanan</label>
                <select name="jenis" class="form-select">
                    <option value="">-- Semua Jenis --</option>
                    <option value="Dalam Daerah" @selected(request('jenis') === 'Dalam Daerah')>Dalam Daerah</option>
                    <option value="Luar Daerah" @selected(request('jenis') === 'Luar Daerah')>Luar Daerah</option>
                </select>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary w-100"><i class="bi bi-funnel me-1"></i>Filter</button>
            </div>
        </form>
    </div>
</div>

<div class="card">
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
                    <th>Hari</th>
                    <th class="text-end">Total Biaya</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($sppds as $i => $s)
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
                        <td>{{ $s->jumlah_hari }}</td>
                        <td class="text-end fw-semibold">Rp {{ number_format($s->total_biaya, 0, ',', '.') }}</td>
                        <td class="text-center text-nowrap">
                            <a href="{{ route('admin.sppd.show', $s) }}" class="btn btn-sm btn-outline-primary" title="Detail"><i class="bi bi-eye"></i></a>
                            <a href="{{ route('admin.sppd.edit', $s) }}" class="btn btn-sm btn-outline-warning" title="Edit"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="{{ route('admin.sppd.destroy', $s) }}" class="d-inline"
                                  data-confirm data-confirm-title="Hapus SPPD?"
                                  data-confirm-text="SPPD {{ $s->nomor_sppd }} beserta rincian dan lampirannya akan dihapus.">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="9" class="text-center text-muted py-4">Tidak ada data SPPD.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
