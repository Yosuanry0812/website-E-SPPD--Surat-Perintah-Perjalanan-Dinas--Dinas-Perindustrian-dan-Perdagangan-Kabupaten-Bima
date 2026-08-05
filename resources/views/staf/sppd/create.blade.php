@extends('layouts.app')

@section('title', 'Buat SPPD Baru')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><i class="bi bi-plus-circle me-2"></i>Buat Pengajuan SPPD Baru</h4>
    <a href="{{ route('staf.dashboard') }}" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i>Kembali</a>
</div>

<div class="card">
    <div class="card-body p-4">
        <form method="POST" action="{{ route('staf.sppd.store') }}" enctype="multipart/form-data">
            @csrf
            @include('partials.sppd-form', [
                'sppd' => null,
                'showUpload' => true,
                'buttonText' => 'Simpan Pengajuan SPPD',
            ])
        </form>
    </div>
</div>
@endsection
