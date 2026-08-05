@extends('layouts.app')

@section('title', 'Edit SPPD')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><i class="bi bi-pencil-square me-2"></i>Edit SPPD — {{ $sppd->nomor_sppd }}</h4>
    <a href="{{ route('admin.sppd.index') }}" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i>Kembali</a>
</div>

<div class="alert alert-warning">
    <i class="bi bi-exclamation-triangle me-1"></i>
    Total biaya akan dihitung ulang otomatis oleh sistem berdasarkan rincian yang diubah.
</div>

<div class="card">
    <div class="card-body p-4">
        <form method="POST" action="{{ route('admin.sppd.update', $sppd) }}">
            @csrf
            @method('PUT')
            @include('partials.sppd-form', [
                'sppd' => $sppd,
                'showUpload' => false,
                'buttonText' => 'Perbarui & Hitung Ulang',
            ])
        </form>
    </div>
</div>
@endsection
