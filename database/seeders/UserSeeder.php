<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['nip' => '197001012000031001'],
            [
                'nama_lengkap' => 'Admin Disperindag',
                'jabatan' => 'Kepala Dinas',
                'pangkat_golongan' => 'IV/b',
                'password' => Hash::make('password'),
                'role' => 'Admin',
            ]
        );

        $staf = [
            ['nip' => '198505152010012002', 'nama_lengkap' => 'Siti Rahmawati', 'jabatan' => 'Staf Bidang Perdagangan', 'pangkat_golongan' => 'III/c'],
            ['nip' => '199003102015031003', 'nama_lengkap' => 'Budi Santoso', 'jabatan' => 'Staf Bidang Perindustrian', 'pangkat_golongan' => 'III/a'],
            ['nip' => '199212252018042004', 'nama_lengkap' => 'Dewi Lestari', 'jabatan' => 'Staf Bidang Sarana Distribusi', 'pangkat_golongan' => 'III/b'],
        ];

        foreach ($staf as $s) {
            User::updateOrCreate(
                ['nip' => $s['nip']],
                [
                    'nama_lengkap' => $s['nama_lengkap'],
                    'jabatan' => $s['jabatan'],
                    'pangkat_golongan' => $s['pangkat_golongan'],
                    'password' => Hash::make('password'),
                    'role' => 'Staf',
                ]
            );
        }
    }
}
