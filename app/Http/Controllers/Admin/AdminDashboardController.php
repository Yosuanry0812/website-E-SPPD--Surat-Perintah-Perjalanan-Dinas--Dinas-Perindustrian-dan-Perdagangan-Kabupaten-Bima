<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PerjalananDinas;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $data = [
            'total_staf' => User::where('role', 'Staf')->count(),
            'total_sppd' => PerjalananDinas::count(),
            'dalam_daerah' => PerjalananDinas::where('jenis_perjalanan', 'Dalam Daerah')->count(),
            'luar_daerah' => PerjalananDinas::where('jenis_perjalanan', 'Luar Daerah')->count(),
            'total_biaya' => PerjalananDinas::sum('total_biaya'),
            'sppd_terbaru' => PerjalananDinas::with('user')->latest()->take(5)->get(),
        ];

        return view('admin.dashboard', $data);
    }
}
