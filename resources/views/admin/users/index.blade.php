@extends('layouts.app')

@section('title', 'Kelola Akun Staf')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><i class="bi bi-people me-2"></i>Kelola Akun Staf</h4>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>Tambah Staf</a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIP</th>
                    <th>Nama Lengkap</th>
                    <th>Jabatan</th>
                    <th>Pangkat/Golongan</th>
                    <th>Jml SPPD</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $i => $u)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $u->nip }}</td>
                        <td class="fw-semibold">{{ $u->nama_lengkap }}</td>
                        <td>{{ $u->jabatan }}</td>
                        <td>{{ $u->pangkat_golongan }}</td>
                        <td>{{ $u->perjalananDinas()->count() }}</td>
                        <td class="text-center text-nowrap">
                            <a href="{{ route('admin.users.edit', $u) }}" class="btn btn-sm btn-outline-warning" title="Edit"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="{{ route('admin.users.destroy', $u) }}" class="d-inline"
                                  data-confirm data-confirm-title="Hapus akun staf?"
                                  data-confirm-text="Akun {{ $u->nama_lengkap }} beserta seluruh SPPD-nya akan dihapus.">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center text-muted py-4">Belum ada akun staf.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
