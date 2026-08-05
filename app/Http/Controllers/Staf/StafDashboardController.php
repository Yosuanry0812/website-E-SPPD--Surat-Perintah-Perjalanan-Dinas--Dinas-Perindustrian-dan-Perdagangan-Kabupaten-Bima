<?php

namespace App\Http\Controllers\Staf;

use App\Http\Controllers\Controller;
use App\Models\PerjalananDinas;

class StafDashboardController extends Controller
{
    public function index()
    {
        $riwayat = PerjalananDinas::where('user_id', auth()->id())
            ->withCount('rincianBiayaHarian', 'penginapan', 'transportasi', 'lampiran')
            ->latest()
            ->get();

        return view('staf.dashboard', compact('riwayat'));
    }
}
