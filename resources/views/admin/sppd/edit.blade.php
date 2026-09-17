@extends('layouts.app')

@section('title', 'Edit SPPD')

@section('content')
<div class="bg-error-container border border-error/30 text-on-error-container rounded-xl px-5 py-4 flex items-start gap-3 mb-6">
    <span class="material-symbols-outlined text-[20px] mt-0.5">warning</span>
    <div class="text-sm">
        Total biaya akan dihitung ulang otomatis oleh sistem berdasarkan rincian yang diubah.
    </div>
</div>

@if ($errors->any())
    <div class="bg-error-container border border-error/30 text-on-error-container rounded-xl px-5 py-4 flex items-start gap-3 mb-6">
        <span class="material-symbols-outlined text-[20px] mt-0.5">error</span>
        <div class="text-sm">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mt-1" style="list-style:disc;padding-left:1.1rem;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

<form method="POST" action="{{ route('admin.sppd.update', $sppd) }}">
    @csrf
    @method('PUT')
    @include('partials.sppd-form', [
        'sppd' => $sppd,
        'showUpload' => false,
        'buttonText' => 'Perbarui & Hitung Ulang',
        'title' => 'Edit SPPD — ' . $sppd->nomor_sppd,
        'subtitle' => 'Ubah rincian perjalanan dinas di bawah ini.',
        'backUrl' => route('admin.sppd.index'),
    ])
    <div style="height:120px;" aria-hidden="true"></div>
</form>
@endsection
