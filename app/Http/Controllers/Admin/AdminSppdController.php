<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\SavesSppd;
use App\Models\PerjalananDinas;
use App\Models\User;
use Illuminate\Http\Request;

class AdminSppdController extends Controller
{
    use SavesSppd;

    public function index(Request $request)
    {
        $query = PerjalananDinas::with('user')->latest();

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }
        if ($request->filled('jenis')) {
            $query->where('jenis_perjalanan', $request->jenis);
        }

        $sppds = $query->get();
        $staf = User::where('role', 'Staf')->orderBy('nama_lengkap')->get();

        return view('admin.sppd.index', compact('sppds', 'staf'));
    }

    public function show(PerjalananDinas $sppd)
    {
        $sppd->load(['user', 'rincianBiayaHarian', 'penginapan', 'transportasi', 'lampiran']);

        return view('admin.sppd.show', compact('sppd'));
    }

    public function edit(PerjalananDinas $sppd)
    {
        $sppd->load(['rincianBiayaHarian', 'penginapan', 'transportasi']);

        return view('admin.sppd.edit', compact('sppd'));
    }

    public function update(Request $request, PerjalananDinas $sppd)
    {
        $data = $this->validasiData($request);
        $this->simpanSppd($sppd, $data);

        return redirect()->route('admin.sppd.index')
            ->with('success', 'SPPD berhasil diperbarui, total biaya dihitung ulang.');
    }

    public function destroy(PerjalananDinas $sppd)
    {
        $sppd->delete();

        return redirect()->route('admin.sppd.index')
            ->with('success', 'SPPD berhasil dihapus.');
    }

    protected function validasiData(Request $request): array
    {
        return $request->validate([
            'jenis_perjalanan' => ['required', 'in:Dalam Daerah,Luar Daerah'],
            'nomor_sppd' => ['required', 'string'],
            'nomor_surat_tugas' => ['required', 'string'],
            'keperluan' => ['required', 'string'],
            'tempat_tujuan' => ['required', 'string'],
            'tanggal_berangkat' => ['required', 'date'],
            'tanggal_kembali' => ['required', 'date', 'after_or_equal:tanggal_berangkat'],
            'rincian.*.jenis_biaya' => ['required', 'in:Harian,Representatif,Lain-lain,Taksi'],
            'rincian.*.biaya_per_hari' => ['required', 'numeric', 'min:0'],
            'rincian.*.jumlah_hari' => ['required', 'integer', 'min:1'],
            'penginapan.*.nama_hotel' => ['nullable', 'string'],
            'penginapan.*.biaya_per_malam' => ['nullable', 'numeric', 'min:0'],
            'penginapan.*.tanggal_check_in' => ['nullable', 'date'],
            'penginapan.*.tanggal_check_out' => ['nullable', 'date'],
            'penginapan.*.nomor_kamar' => ['nullable', 'string'],
            'penginapan.*.no_telp_hotel' => ['nullable', 'string'],
            'transportasi.*.jenis_transportasi' => ['nullable', 'in:Taksi,Pesawat,Travel'],
            'transportasi.*.deskripsi' => ['nullable', 'string'],
            'transportasi.*.rute_dari' => ['nullable', 'string'],
            'transportasi.*.rute_tujuan' => ['nullable', 'string'],
            'transportasi.*.tanggal_berangkat' => ['nullable', 'date'],
            'transportasi.*.harga_tiket' => ['nullable', 'numeric', 'min:0'],
            'transportasi.*.nomor_tiket' => ['nullable', 'string'],
            'transportasi.*.kode_booking' => ['nullable', 'string'],
            'transportasi.*.nomor_penerbangan' => ['nullable', 'string'],
        ]);
    }
}
