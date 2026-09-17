@extends('layouts.app')

@section('title', 'Manajemen Staf')

@section('content')
{{-- Header --}}
<div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4">
    <div>
        <h2 class="font-display-lg text-[32px] font-bold text-on-surface tracking-tight">Kelola Akun Staf</h2>
        <p class="font-body-lg text-body-lg text-on-surface-variant mt-1">Akun pegawai yang mengajukan SPPD.</p>
    </div>
    <a href="{{ route('admin.users.create') }}" class="px-4 py-2.5 bg-primary text-on-primary rounded-xl font-label-md text-label-md flex items-center gap-2 hover:opacity-90 transition-opacity shadow-sm">
        <span class="material-symbols-outlined text-[18px]">person_add</span>
        Tambah Staf
    </a>
</div>

{{-- Table --}}
<div class="bg-surface-container-lowest rounded-2xl table-shadow border border-outline-variant/20 overflow-hidden">
    <div class="overflow-x-auto w-full">
        <table class="w-full text-left border-collapse min-w-[860px]">
            <thead>
                <tr class="bg-[#F8FAFC] border-b border-outline-variant/20 font-label-md text-[11px] text-on-surface-variant uppercase tracking-wider">
                    <th class="px-6 py-4 font-semibold">NIP</th>
                    <th class="px-6 py-4 font-semibold">Nama Lengkap</th>
                    <th class="px-6 py-4 font-semibold">Jabatan</th>
                    <th class="px-6 py-4 font-semibold">Pangkat / Golongan</th>
                    <th class="px-6 py-4 font-semibold text-center">Jml SPPD</th>
                    <th class="px-6 py-4 font-semibold text-center w-28">Aksi</th>
                </tr>
            </thead>
            <tbody class="font-body-md text-sm text-on-surface bg-surface-container-lowest">
                @forelse ($users as $u)
                    <tr class="border-b border-outline-variant/10 hover-tint transition-colors">
                        <td class="px-6 py-4 text-on-surface-variant">{{ $u->nip }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-primary/10 text-primary flex items-center justify-center font-bold text-xs flex-shrink-0">{{ strtoupper(substr($u->nama_lengkap, 0, 1)) }}</div>
                                <span class="font-semibold">{{ $u->nama_lengkap }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">{{ $u->jabatan }}</td>
                        <td class="px-6 py-4">{{ $u->pangkat_golongan }}</td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[12px] font-semibold bg-primary/10 text-primary">{{ $u->perjalananDinas()->count() }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-1.5">
                                <a href="{{ route('admin.users.edit', $u) }}" class="text-on-surface-variant hover:text-[#F59E0B] transition-colors p-1.5 rounded-lg hover:bg-[#F59E0B]/10" title="Edit">
                                    <span class="material-symbols-outlined text-[18px]">edit</span>
                                </a>
                                <form method="POST" action="{{ route('admin.users.destroy', $u) }}" class="inline"
                                      data-confirm data-confirm-title="Hapus akun staf?"
                                      data-confirm-text="Akun {{ $u->nama_lengkap }} beserta seluruh SPPD-nya akan dihapus.">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-on-surface-variant hover:text-error transition-colors p-1.5 rounded-lg hover:bg-error/10" title="Hapus">
                                        <span class="material-symbols-outlined text-[18px]">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center text-on-surface-variant">
                            <span class="material-symbols-outlined text-[40px] opacity-40 block mb-2">inbox</span>
                            Belum ada akun staf.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
