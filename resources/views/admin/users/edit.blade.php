@extends('layouts.app')

@section('title', 'Edit Akun Staf')

@section('content')
{{-- Header --}}
<div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4">
    <div>
        <h2 class="font-display-lg text-[32px] font-bold text-on-surface tracking-tight">Edit Akun Staf</h2>
        <p class="font-body-lg text-body-lg text-on-surface-variant mt-1">{{ $user->nama_lengkap }}</p>
    </div>
    <a href="{{ route('admin.users.index') }}" class="px-4 py-2.5 border border-outline-variant/40 text-on-surface rounded-xl font-label-md text-label-md flex items-center gap-2 hover:bg-[#F8FAFC] transition-colors bg-surface-container-lowest shadow-sm">
        <span class="material-symbols-outlined text-[18px]">arrow_back</span>
        Kembali
    </a>
</div>

{{-- Form --}}
<div class="bg-surface-container-lowest rounded-2xl table-shadow border border-outline-variant/20 overflow-hidden max-w-4xl">
    <div class="px-5 py-5 md:px-8 md:py-6 border-b border-outline-variant/20 bg-surface-container-lowest">
        <h3 class="font-headline-sm text-xl font-bold text-on-surface">Data Pegawai</h3>
    </div>
    <form method="POST" action="{{ route('admin.users.update', $user) }}" class="p-5 md:p-8">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="form-label">NIP <span class="text-error">*</span></label>
                <input type="text" name="nip" class="form-input @error('nip') !border-error @enderror" value="{{ old('nip', $user->nip) }}" required>
                @error('nip')<span class="text-xs text-error mt-1 block">{{ $message }}</span>@enderror
            </div>
            <div>
                <label class="form-label">Nama Lengkap <span class="text-error">*</span></label>
                <input type="text" name="nama_lengkap" class="form-input @error('nama_lengkap') !border-error @enderror" value="{{ old('nama_lengkap', $user->nama_lengkap) }}" required>
                @error('nama_lengkap')<span class="text-xs text-error mt-1 block">{{ $message }}</span>@enderror
            </div>
            <div>
                <label class="form-label">Jabatan <span class="text-error">*</span></label>
                <input type="text" name="jabatan" class="form-input @error('jabatan') !border-error @enderror" value="{{ old('jabatan', $user->jabatan) }}" required>
                @error('jabatan')<span class="text-xs text-error mt-1 block">{{ $message }}</span>@enderror
            </div>
            <div>
                <label class="form-label">Pangkat / Golongan <span class="text-error">*</span></label>
                <input type="text" name="pangkat_golongan" class="form-input @error('pangkat_golongan') !border-error @enderror" value="{{ old('pangkat_golongan', $user->pangkat_golongan) }}" required>
                @error('pangkat_golongan')<span class="text-xs text-error mt-1 block">{{ $message }}</span>@enderror
            </div>
            <div>
                <label class="form-label">Password <span class="text-on-surface-variant font-normal text-xs">(kosongkan jika tidak diubah)</span></label>
                <input type="password" name="password" class="form-input @error('password') !border-error @enderror" minlength="8">
                @error('password')<span class="text-xs text-error mt-1 block">{{ $message }}</span>@enderror
            </div>
            <div>
                <label class="form-label">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-input">
            </div>
        </div>
        <div class="mt-8 flex items-center gap-4">
            <button type="submit" class="px-8 py-3 bg-primary text-white hover:bg-primary-container hover:text-on-primary-container font-label-md text-label-md rounded-lg shadow-md transition-colors flex items-center gap-2">
                <span class="material-symbols-outlined text-[20px]">check_circle</span>
                Perbarui
            </button>
            <a href="{{ route('admin.users.index') }}" class="px-6 py-3 border border-outline text-on-surface font-label-md text-label-md rounded-lg hover:bg-surface-container-low transition-colors">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
