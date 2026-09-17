@extends('layouts.app')

@section('title', 'Buat SPPD Baru')

@section('content')
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

<form method="POST" action="{{ route('staf.sppd.store') }}" enctype="multipart/form-data">
    @csrf
    @include('partials.sppd-form', [
        'sppd' => null,
        'showUpload' => true,
        'buttonText' => 'Simpan Data SPPD',
        'title' => 'Buat Pengajuan SPPD Baru',
        'subtitle' => 'Lengkapi formulir di bawah ini untuk mengajukan Surat Perintah Perjalanan Dinas baru.',
        'backUrl' => route('staf.dashboard'),
    ])
    <div style="height:120px;" aria-hidden="true"></div>
</form>
@endsection
