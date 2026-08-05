<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'Staf')->latest()->get();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nip' => ['required', 'string', 'unique:users,nip'],
            'nama_lengkap' => ['required', 'string'],
            'jabatan' => ['required', 'string'],
            'pangkat_golongan' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $data['password'] = Hash::make($data['password']);
        $data['role'] = 'Staf';

        User::create($data);

        return redirect()->route('admin.users.index')
            ->with('success', 'Akun staf berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'nip' => ['required', 'string', 'unique:users,nip,'.$user->id],
            'nama_lengkap' => ['required', 'string'],
            'jabatan' => ['required', 'string'],
            'pangkat_golongan' => ['required', 'string'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        if (! empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')
            ->with('success', 'Akun staf berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        if ($user->role !== 'Staf') {
            return back()->with('error', 'Akun admin tidak dapat dihapus.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Akun staf berhasil dihapus.');
    }
}
