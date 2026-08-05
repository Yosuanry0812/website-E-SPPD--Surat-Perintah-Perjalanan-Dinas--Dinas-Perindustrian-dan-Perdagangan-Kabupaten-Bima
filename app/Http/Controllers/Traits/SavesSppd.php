<?php

namespace App\Http\Controllers\Traits;

use App\Models\PerjalananDinas;
use Illuminate\Support\Carbon;

trait SavesSppd
{
    /**
     * Simpan SPPD beserta rincian, hitung ulang seluruh total biaya.
     *
     * @param  array<string, mixed>  $data
     * @param  array<int, \Illuminate\Http\UploadedFile>  $files
     */
    protected function simpanSppd(PerjalananDinas $sppd, array $data, array $files = []): PerjalananDinas
    {
        $mulai = Carbon::parse($data['tanggal_berangkat']);
        $selesai = Carbon::parse($data['tanggal_kembali']);
        $jumlahHari = max(1, (int) $mulai->diffInDays($selesai) + 1);

        $sppd->fill([
            'jenis_perjalanan' => $data['jenis_perjalanan'],
            'nomor_sppd' => $data['nomor_sppd'],
            'nomor_surat_tugas' => $data['nomor_surat_tugas'],
            'keperluan' => $data['keperluan'],
            'tempat_tujuan' => $data['tempat_tujuan'],
            'jumlah_hari' => $jumlahHari,
            'tanggal_berangkat' => $mulai->toDateString(),
            'tanggal_kembali' => $selesai->toDateString(),
        ]);
        $sppd->save();

        $sppd->rincianBiayaHarian()->delete();
        foreach ($data['rincian'] ?? [] as $r) {
            if ((float) ($r['biaya_per_hari'] ?? 0) <= 0) {
                continue;
            }
            $sppd->rincianBiayaHarian()->create([
                'jenis_biaya' => $r['jenis_biaya'],
                'biaya_per_hari' => (float) $r['biaya_per_hari'],
                'jumlah_hari' => (int) ($r['jumlah_hari'] ?? $jumlahHari),
                'total' => (float) $r['biaya_per_hari'] * (int) ($r['jumlah_hari'] ?? $jumlahHari),
            ]);
        }

        $sppd->penginapan()->delete();
        foreach ($data['penginapan'] ?? [] as $p) {
            if (empty($p['nama_hotel']) || (float) ($p['biaya_per_malam'] ?? 0) <= 0) {
                continue;
            }
            $in = Carbon::parse($p['tanggal_check_in']);
            $out = Carbon::parse($p['tanggal_check_out']);
            $malam = max(1, (int) $in->diffInDays($out));
            $sppd->penginapan()->create([
                'nama_hotel' => $p['nama_hotel'],
                'biaya_per_malam' => (float) $p['biaya_per_malam'],
                'tanggal_check_in' => $in->toDateString(),
                'tanggal_check_out' => $out->toDateString(),
                'nomor_kamar' => $p['nomor_kamar'] ?? '',
                'no_telp_hotel' => $p['no_telp_hotel'] ?? '',
                'total_biaya' => (float) $p['biaya_per_malam'] * $malam,
            ]);
        }

        $sppd->transportasi()->delete();
        foreach ($data['transportasi'] ?? [] as $t) {
            if (empty($t['jenis_transportasi']) || (float) ($t['harga_tiket'] ?? 0) <= 0) {
                continue;
            }
            $sppd->transportasi()->create([
                'jenis_transportasi' => $t['jenis_transportasi'],
                'deskripsi' => $t['deskripsi'] ?? '',
                'rute_dari' => $t['rute_dari'] ?? '',
                'rute_tujuan' => $t['rute_tujuan'] ?? '',
                'tanggal_berangkat' => $t['tanggal_berangkat'] ?? $mulai->toDateString(),
                'harga_tiket' => (float) $t['harga_tiket'],
                'nomor_tiket' => $t['nomor_tiket'] ?? null,
                'kode_booking' => $t['kode_booking'] ?? null,
                'nomor_penerbangan' => $t['nomor_penerbangan'] ?? null,
                'biaya_total' => (float) $t['harga_tiket'],
            ]);
        }

        $total = (float) $sppd->rincianBiayaHarian()->sum('total')
            + (float) $sppd->penginapan()->sum('total_biaya')
            + (float) $sppd->transportasi()->sum('biaya_total');
        $sppd->update(['total_biaya' => $total]);

        foreach ($files as $file) {
            if (! $file || ! $file->isValid()) {
                continue;
            }
            $path = $file->store('lampiran', 'public');
            $sppd->lampiran()->create([
                'nama_file' => $file->getClientOriginalName(),
                'path_file' => $path,
            ]);
        }

        return $sppd;
    }
}
