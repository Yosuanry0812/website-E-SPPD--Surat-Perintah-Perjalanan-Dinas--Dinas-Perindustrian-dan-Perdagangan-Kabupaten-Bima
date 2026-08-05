@props([
    'sppd' => null,
    'showUpload' => true,
    'buttonText' => 'Simpan SPPD',
])

@php
    $rincianRows = old('rincian', $sppd && $sppd->rincianBiayaHarian->isNotEmpty()
        ? $sppd->rincianBiayaHarian->map(fn ($r) => [
            'jenis_biaya' => $r->jenis_biaya,
            'biaya_per_hari' => $r->biaya_per_hari,
            'jumlah_hari' => $r->jumlah_hari,
        ])->all()
        : [['jenis_biaya' => 'Harian', 'biaya_per_hari' => '', 'jumlah_hari' => '']]);

    $penginapanRows = old('penginapan', $sppd && $sppd->penginapan->isNotEmpty()
        ? $sppd->penginapan->map(fn ($p) => $p->only([
            'nama_hotel', 'biaya_per_malam', 'tanggal_check_in', 'tanggal_check_out', 'nomor_kamar', 'no_telp_hotel',
        ]))->all()
        : [[]]);

    $transportasiRows = old('transportasi', $sppd && $sppd->transportasi->isNotEmpty()
        ? $sppd->transportasi->map(fn ($t) => $t->only([
            'jenis_transportasi', 'deskripsi', 'rute_dari', 'rute_tujuan', 'tanggal_berangkat',
            'harga_tiket', 'nomor_tiket', 'kode_booking', 'nomor_penerbangan',
        ]))->all()
        : [[]]);

    $jenis = old('jenis_perjalanan', $sppd->jenis_perjalanan ?? 'Dalam Daerah');
@endphp

<div class="row g-3">
    {{-- Info dasar --}}
    <div class="col-12">
        <h6 class="fw-bold text-primary"><i class="bi bi-info-circle me-1"></i>Informasi Dasar</h6>
        <hr class="mt-1">
    </div>
    <div class="col-md-6">
        <label class="form-label">Jenis Perjalanan <span class="text-danger">*</span></label>
        <select name="jenis_perjalanan" id="jenis_perjalanan" class="form-select" required>
            <option value="Dalam Daerah" @selected($jenis === 'Dalam Daerah')>Dalam Daerah</option>
            <option value="Luar Daerah" @selected($jenis === 'Luar Daerah')>Luar Daerah</option>
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">Nomor SPPD <span class="text-danger">*</span></label>
        <input type="text" name="nomor_sppd" class="form-control" value="{{ old('nomor_sppd', $sppd->nomor_sppd ?? '') }}" placeholder="cth: 800/123/Disperindag" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Nomor Surat Tugas <span class="text-danger">*</span></label>
        <input type="text" name="nomor_surat_tugas" class="form-control" value="{{ old('nomor_surat_tugas', $sppd->nomor_surat_tugas ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Tempat Tujuan <span class="text-danger">*</span></label>
        <input type="text" name="tempat_tujuan" class="form-control" value="{{ old('tempat_tujuan', $sppd->tempat_tujuan ?? '') }}" required>
    </div>
    <div class="col-12">
        <label class="form-label">Keperluan <span class="text-danger">*</span></label>
        <textarea name="keperluan" rows="2" class="form-control" required>{{ old('keperluan', $sppd->keperluan ?? '') }}</textarea>
    </div>
    <div class="col-md-4">
        <label class="form-label">Tanggal Berangkat <span class="text-danger">*</span></label>
        <input type="date" name="tanggal_berangkat" id="tanggal_berangkat" class="form-control"
               value="{{ old('tanggal_berangkat', $sppd->tanggal_berangkat ?? '') }}" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">Tanggal Kembali <span class="text-danger">*</span></label>
        <input type="date" name="tanggal_kembali" id="tanggal_kembali" class="form-control"
               value="{{ old('tanggal_kembali', $sppd->tanggal_kembali ?? '') }}" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">Jumlah Hari <span class="text-danger">*</span></label>
        <input type="number" name="jumlah_hari" id="jumlah_hari" class="form-control"
               value="{{ old('jumlah_hari', $sppd->jumlah_hari ?? 1) }}" min="1" required>
    </div>

    {{-- Uang harian --}}
    <div class="col-12 mt-4">
        <h6 class="fw-bold text-primary"><i class="bi bi-cash-stack me-1"></i>Rincian Biaya Harian</h6>
        <hr class="mt-1">
    </div>
    <div class="col-12">
        <div id="rincian-wrap">
            @foreach ($rincianRows as $i => $r)
                <div class="row g-2 mb-2 rincian-row">
                    <div class="col-md-4">
                        <select name="rincian[{{ $i }}][jenis_biaya]" class="form-select">
                            @foreach (['Harian', 'Representatif', 'Lain-lain', 'Taksi'] as $jb)
                                <option value="{{ $jb }}" @selected(($r['jenis_biaya'] ?? '') === $jb)>{{ $jb }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" step="0.01" min="0" name="rincian[{{ $i }}][biaya_per_hari]"
                                   class="form-control biaya-per-hari" placeholder="Biaya/hari" value="{{ $r['biaya_per_hari'] ?? '' }}" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <input type="number" min="1" name="rincian[{{ $i }}][jumlah_hari]"
                               class="form-control jml-hari" placeholder="Jml hari" value="{{ $r['jumlah_hari'] ?? 1 }}" required>
                    </div>
                    <div class="col-md-2 d-flex align-items-center">
                        <button type="button" class="btn btn-sm btn-outline-danger hapus-rincian"><i class="bi bi-trash"></i></button>
                    </div>
                </div>
            @endforeach
        </div>
        <button type="button" id="tambah-rincian" class="btn btn-sm btn-outline-primary"><i class="bi bi-plus-lg me-1"></i>Tambah Rincian</button>
    </div>

    {{-- Penginapan (Luar Daerah) --}}
    <div class="col-12 mt-4" id="bagian-penginapan" @if ($jenis !== 'Luar Daerah') style="display:none;" @endif>
        <h6 class="fw-bold text-primary"><i class="bi bi-building me-1"></i>Penginapan</h6>
        <hr class="mt-1">
        <div id="penginapan-wrap">
            @foreach ($penginapanRows as $i => $p)
                <div class="border rounded p-3 mb-3 bg-light penginapan-row">
                    <div class="row g-2">
                        <div class="col-md-6">
                            <label class="form-label small mb-0">Nama Hotel</label>
                            <input type="text" name="penginapan[{{ $i }}][nama_hotel]" class="form-control" value="{{ $p['nama_hotel'] ?? '' }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small mb-0">Biaya Per Malam (Rp)</label>
                            <input type="number" step="0.01" min="0" name="penginapan[{{ $i }}][biaya_per_malam]" class="form-control biaya-malam" value="{{ $p['biaya_per_malam'] ?? '' }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small mb-0">Check In</label>
                            <input type="date" name="penginapan[{{ $i }}][tanggal_check_in]" class="form-control tgl-in" value="{{ $p['tanggal_check_in'] ?? '' }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small mb-0">Check Out</label>
                            <input type="date" name="penginapan[{{ $i }}][tanggal_check_out]" class="form-control tgl-out" value="{{ $p['tanggal_check_out'] ?? '' }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small mb-0">Nomor Kamar</label>
                            <input type="text" name="penginapan[{{ $i }}][nomor_kamar]" class="form-control" value="{{ $p['nomor_kamar'] ?? '' }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small mb-0">No. Telp Hotel</label>
                            <input type="text" name="penginapan[{{ $i }}][no_telp_hotel]" class="form-control" value="{{ $p['no_telp_hotel'] ?? '' }}">
                        </div>
                    </div>
                    <div class="text-end mt-2">
                        <button type="button" class="btn btn-sm btn-outline-danger hapus-penginapan"><i class="bi bi-trash me-1"></i>Hapus</button>
                    </div>
                </div>
            @endforeach
        </div>
        <button type="button" id="tambah-penginapan" class="btn btn-sm btn-outline-primary"><i class="bi bi-plus-lg me-1"></i>Tambah Penginapan</button>
    </div>

    {{-- Transportasi (Luar Daerah) --}}
    <div class="col-12 mt-4" id="bagian-transportasi" @if ($jenis !== 'Luar Daerah') style="display:none;" @endif>
        <h6 class="fw-bold text-primary"><i class="bi bi-airplane me-1"></i>Transportasi</h6>
        <hr class="mt-1">
        <div id="transportasi-wrap">
            @foreach ($transportasiRows as $i => $t)
                <div class="border rounded p-3 mb-3 bg-light transportasi-row">
                    <div class="row g-2">
                        <div class="col-md-3">
                            <label class="form-label small mb-0">Jenis Transportasi</label>
                            <select name="transportasi[{{ $i }}][jenis_transportasi]" class="form-select">
                                <option value="">-- Pilih --</option>
                                @foreach (['Taksi', 'Pesawat', 'Travel'] as $jt)
                                    <option value="{{ $jt }}" @selected(($t['jenis_transportasi'] ?? '') === $jt)>{{ $jt }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small mb-0">Deskripsi</label>
                            <input type="text" name="transportasi[{{ $i }}][deskripsi]" class="form-control" value="{{ $t['deskripsi'] ?? '' }}" placeholder="cth: Tiket PP">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label small mb-0">Rute Dari</label>
                            <input type="text" name="transportasi[{{ $i }}][rute_dari]" class="form-control" value="{{ $t['rute_dari'] ?? '' }}">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label small mb-0">Rute Tujuan</label>
                            <input type="text" name="transportasi[{{ $i }}][rute_tujuan]" class="form-control" value="{{ $t['rute_tujuan'] ?? '' }}">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label small mb-0">Tanggal Berangkat</label>
                            <input type="date" name="transportasi[{{ $i }}][tanggal_berangkat]" class="form-control" value="{{ $t['tanggal_berangkat'] ?? '' }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small mb-0">Harga Tiket (Rp)</label>
                            <input type="number" step="0.01" min="0" name="transportasi[{{ $i }}][harga_tiket]" class="form-control harga-tiket" value="{{ $t['harga_tiket'] ?? '' }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small mb-0">Nomor Tiket</label>
                            <input type="text" name="transportasi[{{ $i }}][nomor_tiket]" class="form-control" value="{{ $t['nomor_tiket'] ?? '' }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small mb-0">Kode Booking</label>
                            <input type="text" name="transportasi[{{ $i }}][kode_booking]" class="form-control" value="{{ $t['kode_booking'] ?? '' }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small mb-0">Nomor Penerbangan</label>
                            <input type="text" name="transportasi[{{ $i }}][nomor_penerbangan]" class="form-control" value="{{ $t['nomor_penerbangan'] ?? '' }}">
                        </div>
                    </div>
                    <div class="text-end mt-2">
                        <button type="button" class="btn btn-sm btn-outline-danger hapus-transportasi"><i class="bi bi-trash me-1"></i>Hapus</button>
                    </div>
                </div>
            @endforeach
        </div>
        <button type="button" id="tambah-transportasi" class="btn btn-sm btn-outline-primary"><i class="bi bi-plus-lg me-1"></i>Tambah Transportasi</button>
    </div>

    {{-- Upload kwitansi --}}
    @if ($showUpload)
        <div class="col-12 mt-4">
            <h6 class="fw-bold text-primary"><i class="bi bi-paperclip me-1"></i>Upload Kwitansi / Lampiran</h6>
            <hr class="mt-1">
            <input type="file" name="lampiran[]" class="form-control" multiple accept=".jpg,.jpeg,.png,.pdf">
            <small class="text-muted">Format: JPG, PNG, PDF. Maks 2MB per file.</small>
        </div>
    @endif

    <div class="col-12 mt-4">
        <div class="alert alert-info d-flex justify-content-between align-items-center mb-0">
            <span><i class="bi bi-calculator me-1"></i><strong>Total Biaya (prakiraan):</strong></span>
            <strong id="total-preview" class="fs-5">Rp 0</strong>
        </div>
    </div>

    <div class="col-12 mt-4">
        <button type="submit" class="btn btn-primary px-4"><i class="bi bi-check-lg me-1"></i>{{ $buttonText }}</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary px-4">Batal</a>
    </div>
</div>

@push('scripts')
<script>
    const formatRp = (n) => 'Rp ' + Math.round(n).toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');

    // Auto jumlah hari
    function hitungJumlahHari() {
        const a = document.getElementById('tanggal_berangkat').value;
        const b = document.getElementById('tanggal_kembali').value;
        if (a && b) {
            const hari = Math.max(1, Math.floor((new Date(b) - new Date(a)) / 86400000) + 1);
            document.getElementById('jumlah_hari').value = hari;
            document.querySelectorAll('.jml-hari').forEach(el => {
                if (!el.dataset.set) el.value = hari;
            });
        }
    }
    ['tanggal_berangkat', 'tanggal_kembali'].forEach(id =>
        document.getElementById(id).addEventListener('change', hitungJumlahHari));
    document.getElementById('jumlah_hari').addEventListener('change', function () {
        document.querySelectorAll('.jml-hari').forEach(el => el.value = this.value);
    });

    // Tampilkan/sembunyikan bagian penginapan & transportasi
    document.getElementById('jenis_perjalanan').addEventListener('change', function () {
        const luar = this.value === 'Luar Daerah';
        document.getElementById('bagian-penginapan').style.display = luar ? '' : 'none';
        document.getElementById('bagian-transportasi').style.display = luar ? '' : 'none';
    });

    // Hitung total preview
    function hitungTotal() {
        let total = 0;
        document.querySelectorAll('.rincian-row').forEach(row => {
            const bp = parseFloat(row.querySelector('.biaya-per-hari').value) || 0;
            const jh = parseInt(row.querySelector('.jml-hari').value) || 0;
            total += bp * jh;
        });
        document.querySelectorAll('.penginapan-row').forEach(row => {
            const bm = parseFloat(row.querySelector('.biaya-malam').value) || 0;
            const a = row.querySelector('.tgl-in').value;
            const b = row.querySelector('.tgl-out').value;
            if (bm && a && b) {
                const malam = Math.max(1, Math.floor((new Date(b) - new Date(a)) / 86400000));
                total += bm * malam;
            }
        });
        document.querySelectorAll('.transportasi-row').forEach(row => {
            total += parseFloat(row.querySelector('.harga-tiket').value) || 0;
        });
        document.getElementById('total-preview').textContent = formatRp(total);
    }
    document.querySelector('.main-content').addEventListener('input', hitungTotal);
    hitungTotal();

    // Baris dinamis: rincian
    let idxRincian = {{ count($rincianRows) }};
    document.getElementById('tambah-rincian').addEventListener('click', function () {
        const wrap = document.getElementById('rincian-wrap');
        const tpl = `
        <div class="row g-2 mb-2 rincian-row">
            <div class="col-md-4">
                <select name="rincian[${idxRincian}][jenis_biaya]" class="form-select">
                    <option>Harian</option><option>Representatif</option><option>Lain-lain</option><option>Taksi</option>
                </select>
            </div>
            <div class="col-md-3">
                <div class="input-group"><span class="input-group-text">Rp</span>
                    <input type="number" step="0.01" min="0" name="rincian[${idxRincian}][biaya_per_hari]" class="form-control biaya-per-hari" placeholder="Biaya/hari">
                </div>
            </div>
            <div class="col-md-3">
                <input type="number" min="1" name="rincian[${idxRincian}][jumlah_hari]" class="form-control jml-hari" value="${document.getElementById('jumlah_hari').value || 1}">
            </div>
            <div class="col-md-2 d-flex align-items-center">
                <button type="button" class="btn btn-sm btn-outline-danger hapus-rincian"><i class="bi bi-trash"></i></button>
            </div>
        </div>`;
        wrap.insertAdjacentHTML('beforeend', tpl);
        idxRincian++;
    });
    document.getElementById('rincian-wrap').addEventListener('click', e => {
        if (e.target.closest('.hapus-rincian')) e.target.closest('.rincian-row').remove();
    });

    // Baris dinamis: penginapan
    let idxPenginapan = {{ count($penginapanRows) }};
    document.getElementById('tambah-penginapan').addEventListener('click', function () {
        const wrap = document.getElementById('penginapan-wrap');
        const tpl = `
        <div class="border rounded p-3 mb-3 bg-light penginapan-row">
            <div class="row g-2">
                <div class="col-md-6"><label class="form-label small mb-0">Nama Hotel</label>
                    <input type="text" name="penginapan[${idxPenginapan}][nama_hotel]" class="form-control"></div>
                <div class="col-md-6"><label class="form-label small mb-0">Biaya Per Malam (Rp)</label>
                    <input type="number" step="0.01" min="0" name="penginapan[${idxPenginapan}][biaya_per_malam]" class="form-control biaya-malam"></div>
                <div class="col-md-3"><label class="form-label small mb-0">Check In</label>
                    <input type="date" name="penginapan[${idxPenginapan}][tanggal_check_in]" class="form-control tgl-in"></div>
                <div class="col-md-3"><label class="form-label small mb-0">Check Out</label>
                    <input type="date" name="penginapan[${idxPenginapan}][tanggal_check_out]" class="form-control tgl-out"></div>
                <div class="col-md-3"><label class="form-label small mb-0">Nomor Kamar</label>
                    <input type="text" name="penginapan[${idxPenginapan}][nomor_kamar]" class="form-control"></div>
                <div class="col-md-3"><label class="form-label small mb-0">No. Telp Hotel</label>
                    <input type="text" name="penginapan[${idxPenginapan}][no_telp_hotel]" class="form-control"></div>
            </div>
            <div class="text-end mt-2">
                <button type="button" class="btn btn-sm btn-outline-danger hapus-penginapan"><i class="bi bi-trash me-1"></i>Hapus</button>
            </div>
        </div>`;
        wrap.insertAdjacentHTML('beforeend', tpl);
        idxPenginapan++;
    });
    document.getElementById('penginapan-wrap').addEventListener('click', e => {
        if (e.target.closest('.hapus-penginapan')) e.target.closest('.penginapan-row').remove();
    });

    // Baris dinamis: transportasi
    let idxTransportasi = {{ count($transportasiRows) }};
    document.getElementById('tambah-transportasi').addEventListener('click', function () {
        const wrap = document.getElementById('transportasi-wrap');
        const tpl = `
        <div class="border rounded p-3 mb-3 bg-light transportasi-row">
            <div class="row g-2">
                <div class="col-md-3"><label class="form-label small mb-0">Jenis Transportasi</label>
                    <select name="transportasi[${idxTransportasi}][jenis_transportasi]" class="form-select">
                        <option value="">-- Pilih --</option><option>Taksi</option><option>Pesawat</option><option>Travel</option>
                    </select></div>
                <div class="col-md-3"><label class="form-label small mb-0">Deskripsi</label>
                    <input type="text" name="transportasi[${idxTransportasi}][deskripsi]" class="form-control"></div>
                <div class="col-md-2"><label class="form-label small mb-0">Rute Dari</label>
                    <input type="text" name="transportasi[${idxTransportasi}][rute_dari]" class="form-control"></div>
                <div class="col-md-2"><label class="form-label small mb-0">Rute Tujuan</label>
                    <input type="text" name="transportasi[${idxTransportasi}][rute_tujuan]" class="form-control"></div>
                <div class="col-md-2"><label class="form-label small mb-0">Tanggal</label>
                    <input type="date" name="transportasi[${idxTransportasi}][tanggal_berangkat]" class="form-control"></div>
                <div class="col-md-3"><label class="form-label small mb-0">Harga Tiket (Rp)</label>
                    <input type="number" step="0.01" min="0" name="transportasi[${idxTransportasi}][harga_tiket]" class="form-control harga-tiket"></div>
                <div class="col-md-3"><label class="form-label small mb-0">Nomor Tiket</label>
                    <input type="text" name="transportasi[${idxTransportasi}][nomor_tiket]" class="form-control"></div>
                <div class="col-md-3"><label class="form-label small mb-0">Kode Booking</label>
                    <input type="text" name="transportasi[${idxTransportasi}][kode_booking]" class="form-control"></div>
                <div class="col-md-3"><label class="form-label small mb-0">No. Penerbangan</label>
                    <input type="text" name="transportasi[${idxTransportasi}][nomor_penerbangan]" class="form-control"></div>
            </div>
            <div class="text-end mt-2">
                <button type="button" class="btn btn-sm btn-outline-danger hapus-transportasi"><i class="bi bi-trash me-1"></i>Hapus</button>
            </div>
        </div>`;
        wrap.insertAdjacentHTML('beforeend', tpl);
        idxTransportasi++;
    });
    document.getElementById('transportasi-wrap').addEventListener('click', e => {
        if (e.target.closest('.hapus-transportasi')) e.target.closest('.transportasi-row').remove();
    });
</script>
@endpush
