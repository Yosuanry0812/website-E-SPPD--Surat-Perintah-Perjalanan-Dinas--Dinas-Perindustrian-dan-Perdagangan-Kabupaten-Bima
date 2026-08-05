<?php

namespace App\Http\Controllers\Staf;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\SavesSppd;
use App\Models\PerjalananDinas;
use Illuminate\Http\Request;

class StafSppdController extends Controller
{
    use SavesSppd;

    public function create()
    {
        return view('staf.sppd.create');
    }

    public function store(Request $request)
    {
        $data = $this->validasiData($request);

        $sppd = new PerjalananDinas(['user_id' => auth()->id()]);
        $this->simpanSppd($sppd, $data, $request->file('lampiran', []));

        return redirect()->route('staf.dashboard')
            ->with('success', 'Pengajuan SPPD berhasil disimpan. Total biaya: Rp '.number_format($sppd->total_biaya, 0, ',', '.'));
    }

    public function show(PerjalananDinas $sppd)
    {
        abort_unless($sppd->user_id === auth()->id(), 403, 'Anda hanya dapat melihat SPPD milik sendiri.');

        $sppd->load(['rincianBiayaHarian', 'penginapan', 'transportasi', 'lampiran']);

        return view('staf.sppd.show', compact('sppd'));
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
            'lampiran.*' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
        ]);
    }
}
