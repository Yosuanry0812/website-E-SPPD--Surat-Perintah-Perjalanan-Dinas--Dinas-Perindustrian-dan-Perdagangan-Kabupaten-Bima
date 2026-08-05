<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan SPPD {{ $namaBulan }}</title>
    <style>
        * { font-family: DejaVu Sans, sans-serif; }
        body { font-size: 10px; }
        h2, h4 { margin: 0; }
        .header { text-align: center; margin-bottom: 12px; }
        .header .instansi { font-size: 13px; font-weight: bold; text-transform: uppercase; }
        .header .judul { font-size: 16px; font-weight: bold; text-decoration: underline; margin: 4px 0; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 4px 6px; text-align: left; }
        th { background: #e2e2e2; }
        .right { text-align: right; }
        .center { text-align: center; }
        .total-row td { font-weight: bold; background: #f2f2f2; }
        .ttd { margin-top: 40px; width: 100%; }
        .ttd td { border: none; }
        .pagenum:after { content: counter(page); }
    </style>
</head>
<body>
    <div class="header">
        <div class="instansi">PEMERINTAH KABUPATEN BIMA</div>
        <div class="instansi">DINAS PERINDUSTRIAN DAN PERDAGANGAN</div>
        <div>Jalan Soekarno Hatta No. 12, Woha, Kabupaten Bima, NTB</div>
        <div class="judul">LAPORAN PERJALANAN DINAS</div>
        <div>Periode: {{ $namaBulan }}{{ $stafDipilih ? ' — Staf: '.$stafDipilih->nama_lengkap : '' }}</div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width:4%">No</th>
                <th>Nomor SPPD</th>
                <th>Nama Staf</th>
                <th>Jenis</th>
                <th>Tujuan</th>
                <th>Tanggal Berangkat</th>
                <th>Tanggal Kembali</th>
                <th class="center">Hari</th>
                <th class="right">Total Biaya (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($sppds as $i => $s)
                <tr>
                    <td class="center">{{ $i + 1 }}</td>
                    <td>{{ $s->nomor_sppd }}</td>
                    <td>{{ $s->user->nama_lengkap }}</td>
                    <td>{{ $s->jenis_perjalanan }}</td>
                    <td>{{ $s->tempat_tujuan }}</td>
                    <td>{{ $s->tanggal_berangkat->format('d/m/Y') }}</td>
                    <td>{{ $s->tanggal_kembali->format('d/m/Y') }}</td>
                    <td class="center">{{ $s->jumlah_hari }}</td>
                    <td class="right">{{ number_format($s->total_biaya, 2, ',', '.') }}</td>
                </tr>
            @empty
                <tr><td colspan="9" class="center">Tidak ada data SPPD pada periode ini.</td></tr>
            @endforelse
            @if ($sppds->isNotEmpty())
                <tr class="total-row">
                    <td colspan="8" class="right">TOTAL</td>
                    <td class="right">{{ number_format($totalKeseluruhan, 2, ',', '.') }}</td>
                </tr>
            @endif
        </tbody>
    </table>

    <p style="margin-top:8px;">Keterangan: Dokumen ini dibuat otomatis oleh Aplikasi E-SPPD dan digunakan sebagai bahan audit BPK.</p>

    <table class="ttd">
        <tr>
            <td class="center" style="width:50%">
                Mengetahui,<br>
                Kepala Dinas Perindustrian dan Perdagangan<br>
                Kabupaten Bima
                <div style="height:60px;"></div>
                <u>H. MUHAMMAD SALEH, S.Sos., M.Si.</u><br>
                NIP. 197001012000031001
            </td>
            <td class="center">
                Woha, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}<br>
                {{ $stafDipilih ? 'Yang membuat, Staf' : 'Kasubag Umum & Keuangan' }}
                <div style="height:60px;"></div>
                <u>Dra. Hj. NURHAYATI, M.M.</u><br>
                NIP. 197405051997032002
            </td>
        </tr>
    </table>
</body>
</html>
