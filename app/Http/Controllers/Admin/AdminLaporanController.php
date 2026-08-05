<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PerjalananDinas;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class AdminLaporanController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->query('bulan', date('Y-m')); // format: YYYY-MM
        $user_id = $request->query('user_id');

        $query = PerjalananDinas::with('user')
            ->whereYear('tanggal_berangkat', substr($bulan, 0, 4))
            ->whereMonth('tanggal_berangkat', substr($bulan, 5, 2));

        if ($user_id) {
            $query->where('user_id', $user_id);
        }

        $sppds = $query->get();
        $staf = User::where('role', 'Staf')->orderBy('nama_lengkap')->get();

        return view('admin.laporan.index', compact('sppds', 'staf', 'bulan', 'user_id'));
    }

    public function export(Request $request)
    {
        $bulan = $request->query('bulan', date('Y-m'));
        $user_id = $request->query('user_id');

        $query = PerjalananDinas::with(['user', 'rincianBiayaHarian', 'penginapan', 'transportasi'])
            ->whereYear('tanggal_berangkat', substr($bulan, 0, 4))
            ->whereMonth('tanggal_berangkat', substr($bulan, 5, 2));

        if ($user_id) {
            $query->where('user_id', $user_id);
        }

        $sppds = $query->get();
        $namaBulan = \Carbon\Carbon::createFromFormat('Y-m', $bulan)->translatedFormat('F Y');
        $totalKeseluruhan = $sppds->sum('total_biaya');
        $stafDipilih = $user_id ? User::find($user_id) : null;

        $pdf = Pdf::loadView('admin.laporan.pdf', compact('sppds', 'bulan', 'namaBulan', 'totalKeseluruhan', 'stafDipilih'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('Laporan-SPPD-'.$bulan.'.pdf');
    }
}
