@extends('layouts.app')

@section('title', 'Laporan SPPD')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><i class="bi bi-file-earmark-bar-graph me-2"></i>Laporan SPPD (Audit BPK)</h4>
</div>

<div class="card mb-3">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.laporan.index') }}" class="row g-2 align-items-end">
            <div class="col-md-4">
                <label class="form-label small mb-1">Bulan / Tahun</label>
                <input type="month" name="bulan" value="{{ $bulan }}" class="form-control">
            </div>
            <div class="col-md-4">
                <label class="form-label small mb-1">Staf</label>
                <select name="user_id" class="form-select">
                    <option value="">-- Semua Staf --</option>
                    @foreach ($staf as $s)
                        <option value="{{ $s->id }}" @selected($user_id == $s->id)>{{ $s->nama_lengkap }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 d-grid gap-2">
                <button type="submit" class="btn btn-primary"><i class="bi bi-funnel me-1"></i>Tampilkan</button>
                <a href="{{ route('admin.laporan.export', ['bulan' => $bulan, 'user_id' => $user_id ?? '']) }}" class="btn btn-success">
                    <i class="bi bi-file-earmark-pdf me-1"></i>Export PDF
                </a>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header bg-white fw-bold">
        <i class="bi bi-calendar-month me-1"></i>Rekap SPPD — {{ \Carbon\Carbon::createFromFormat('Y-m', $bulan)->translatedFormat('F Y') }}
    </div>
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
                </tr>
            </thead>
            <tbody>
                @forelse ($sppds as $i => $s)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $s->nomor_sppd }}</td>
                        <td>{{ $s->user->nama_lengkap }}</td>
                        <td>{{ $s->jenis_perjalanan }}</td>
                        <td>{{ $s->tempat_tujuan }}</td>
                        <td>{{ $s->tanggal_berangkat->format('d/m/Y') }}</td>
                        <td>{{ $s->jumlah_hari }}</td>
                        <td class="text-end fw-semibold">Rp {{ number_format($s->total_biaya, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="8" class="text-center text-muted py-4">Tidak ada data SPPD pada periode ini.</td></tr>
                @endforelse
                @if ($sppds->isNotEmpty())
                    <tr class="table-primary">
                        <td colspan="7" class="text-end fw-bold">TOTAL</td>
                        <td class="text-end fw-bold">Rp {{ number_format($sppds->sum('total_biaya'), 0, ',', '.') }}</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
