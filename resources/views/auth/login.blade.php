@extends('layouts.app')

@section('title', 'Login — E-SPPD')

@section('content')
<div class="row justify-content-center align-items-center" style="min-height:90vh;">
    <div class="col-md-5 col-lg-4">
        <div class="text-center mb-4">
            <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width:70px;height:70px;">
                <i class="bi bi-briefcase-fill fs-2"></i>
            </div>
            <h4 class="fw-bold mb-0">Aplikasi E-SPPD</h4>
            <small class="text-muted">Dinas Perindustrian dan Perdagangan Kabupaten Bima</small>
        </div>

        <div class="card">
            <div class="card-body p-4">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">NIP</label>
                        <input type="text" name="nip" class="form-control @error('nip') is-invalid @enderror"
                               value="{{ old('nip') }}" placeholder="Masukkan NIP" required autofocus>
                        @error('nip')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                               placeholder="Masukkan password" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary w-100 py-2">
                        <i class="bi bi-box-arrow-in-right me-1"></i>Login
                    </button>
                </form>
                <hr>
                <small class="text-muted d-block text-center">Akun demo: NIP admin 197001012000031001 • password: password</small>
            </div>
        </div>
    </div>
</div>
@endsection
