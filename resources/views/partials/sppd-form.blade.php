@props([
    'sppd' => null,
    'showUpload' => true,
    'buttonText' => 'Simpan SPPD',
    'title' => 'Input SPPD',
    'subtitle' => 'Lengkapi formulir di bawah ini untuk menerbitkan Surat Perintah Perjalanan Dinas baru.',
    'backUrl' => null,
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

<div class="max-w-[900px] mx-auto w-full relative">
    {{-- Page Header --}}
    <div class="mb-10 text-center">
        <a href="{{ $backUrl ?: url()->previous() }}" class="inline-flex items-center justify-center gap-2 mb-4 text-on-surface-variant hover:text-primary transition-colors cursor-pointer bg-surface-container-low px-4 py-2 rounded-full text-sm font-medium">
            <span class="material-symbols-outlined text-[18px]">arrow_back</span>
            <span>Kembali ke Daftar SPPD</span>
        </a>
        <h2 class="font-headline-md text-headline-md text-on-surface mb-2">{{ $title }}</h2>
        <p class="text-on-surface-variant">{{ $subtitle }}</p>
    </div>

    {{-- Kartu 1: Informasi Surat Tugas --}}
    <div class="form-card z-10">
        <div class="section-divider hidden md:block"></div>
        <h3 class="form-card-title">
            <span class="step-number">1</span>
            <span>Informasi Surat Tugas</span>
        </h3>
        <div class="md:pl-12 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="form-label">Jenis Perjalanan <span class="text-error">*</span></label>
                <select name="jenis_perjalanan" id="jenis_perjalanan" class="form-input cursor-pointer" required>
                    <option value="Dalam Daerah" @selected($jenis === 'Dalam Daerah')>Dalam Daerah</option>
                    <option value="Luar Daerah" @selected($jenis === 'Luar Daerah')>Luar Daerah</option>
                </select>
            </div>
            <div>
                <label class="form-label">Nomor SPPD <span class="text-error">*</span></label>
                <input type="text" name="nomor_sppd" class="form-input" value="{{ old('nomor_sppd', $sppd->nomor_sppd ?? '') }}" placeholder="cth: 800/123/Disperindag" required>
            </div>
            <div>
                <label class="form-label">Nomor Surat Tugas <span class="text-error">*</span></label>
                <input type="text" name="nomor_surat_tugas" class="form-input" value="{{ old('nomor_surat_tugas', $sppd->nomor_surat_tugas ?? '') }}" placeholder="Masukkan Nomor Surat Tugas" required>
            </div>
            <div>
                <label class="form-label">Tempat Tujuan <span class="text-error">*</span></label>
                <input type="text" name="tempat_tujuan" class="form-input" value="{{ old('tempat_tujuan', $sppd->tempat_tujuan ?? '') }}" placeholder="Contoh: Jakarta Selatan" required>
            </div>
            <div class="md:col-span-2">
                <label class="form-label">Maksud dan Keperluan <span class="text-error">*</span></label>
                <textarea name="keperluan" rows="3" class="form-input h-32 resize-none" placeholder="Jelaskan tujuan perjalanan dinas secara rinci..." required>{{ old('keperluan', $sppd->keperluan ?? '') }}</textarea>
            </div>
            <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-3 gap-6 items-end">
                <div>
                    <label class="form-label">Tanggal Berangkat <span class="text-error">*</span></label>
                    <div class="date-input-wrapper">
                        <input type="date" name="tanggal_berangkat" id="tanggal_berangkat" class="form-input pr-10" value="{{ old('tanggal_berangkat', $sppd->tanggal_berangkat ?? '') }}" required>
                        <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-outline pointer-events-none">calendar_month</span>
                    </div>
                </div>
                <div>
                    <label class="form-label">Tanggal Kembali <span class="text-error">*</span></label>
                    <div class="date-input-wrapper">
                        <input type="date" name="tanggal_kembali" id="tanggal_kembali" class="form-input pr-10" value="{{ old('tanggal_kembali', $sppd->tanggal_kembali ?? '') }}" required>
                        <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-outline pointer-events-none">calendar_month</span>
                    </div>
                </div>
                <div>
                    <label class="form-label">Durasi Perjalanan</label>
                    <div class="flex items-center">
                        <input type="number" name="jumlah_hari" id="jumlah_hari" class="form-input w-24 text-center bg-surface-container-low opacity-80" value="{{ old('jumlah_hari', $sppd->jumlah_hari ?? 1) }}" min="1" readonly>
                        <span class="ml-4 text-on-surface-variant font-medium">Hari</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Kartu 2: Rincian Biaya Harian --}}
    <div class="form-card z-10">
        <div class="section-divider hidden md:block"></div>
        <h3 class="form-card-title">
            <span class="step-number">2</span>
            <span>Rincian Biaya Harian</span>
        </h3>
        <div class="md:pl-12">
            <div id="rincian-wrap" class="space-y-4">
                @foreach ($rincianRows as $i => $r)
                    <div class="rincian-row grid grid-cols-1 md:grid-cols-12 gap-4 items-center p-4 bg-surface-container-lowest rounded-xl border border-surface-container-highest">
                        <div class="md:col-span-4">
                            <label class="form-label mb-1">Jenis Biaya</label>
                            <select name="rincian[{{ $i }}][jenis_biaya]" class="form-input">
                                @foreach (['Harian', 'Representatif', 'Lain-lain', 'Taksi'] as $jb)
                                    <option value="{{ $jb }}" @selected(($r['jenis_biaya'] ?? '') === $jb)>{{ $jb }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="md:col-span-3">
                            <label class="form-label mb-1">Biaya per Hari (Rp)</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant font-medium text-sm">Rp</span>
                                <input type="number" step="0.01" min="0" name="rincian[{{ $i }}][biaya_per_hari]" class="form-input biaya-per-hari pl-12 text-right" placeholder="0" value="{{ $r['biaya_per_hari'] ?? '' }}" required>
                            </div>
                        </div>
                        <div class="md:col-span-3">
                            <label class="form-label mb-1">Jumlah Hari</label>
                            <input type="number" min="1" name="rincian[{{ $i }}][jumlah_hari]" class="form-input jml-hari" placeholder="Hari" value="{{ $r['jumlah_hari'] ?? 1 }}" required>
                        </div>
                        <div class="md:col-span-2 flex md:justify-end pt-5">
                            <button type="button" class="text-on-surface-variant hover:text-error transition-colors p-2 rounded-lg hover:bg-error/10 hapus-rincian" title="Hapus baris">
                                <span class="material-symbols-outlined text-[20px]">delete</span>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
            <button type="button" id="tambah-rincian" class="mt-4 px-4 py-2.5 border border-outline-variant/40 text-primary rounded-lg font-label-md text-label-md flex items-center gap-2 hover:bg-primary/5 transition-colors">
                <span class="material-symbols-outlined text-[18px]">add</span>
                Tambah Rincian
            </button>
        </div>
    </div>

    {{-- Kartu 3: Akomodasi & Transportasi (Luar Daerah) --}}
    <div id="bagian-penginapan" class="form-card z-10" @if ($jenis !== 'Luar Daerah') style="display:none;" @endif>
        <div class="section-divider hidden md:block"></div>
        <h3 class="form-card-title">
            <span class="step-number">3</span>
            <span>Akomodasi &amp; Transportasi</span>
        </h3>
        <div class="md:pl-12 space-y-8">
            <div>
                <div class="flex items-center gap-2 mb-4 text-primary font-semibold">
                    <span class="material-symbols-outlined text-[20px]">hotel</span>
                    <h4 class="text-base">Detail Akomodasi</h4>
                </div>
                <div id="penginapan-wrap" class="space-y-4">
                    @foreach ($penginapanRows as $i => $p)
                        <div class="penginapan-row grid grid-cols-1 md:grid-cols-2 gap-4 p-5 bg-surface-container-lowest rounded-xl border border-surface-container-highest">
                            <div class="md:col-span-2 flex items-center justify-between">
                                <span class="text-sm font-semibold text-on-surface-variant uppercase tracking-wider">Penginapan #{{ $i + 1 }}</span>
                                <button type="button" class="text-on-surface-variant hover:text-error transition-colors p-1.5 rounded-lg hover:bg-error/10 hapus-penginapan" title="Hapus">
                                    <span class="material-symbols-outlined text-[20px]">delete</span>
                                </button>
                            </div>
                            <div class="md:col-span-2">
                                <label class="form-label">Nama Hotel/Penginapan</label>
                                <input type="text" name="penginapan[{{ $i }}][nama_hotel]" class="form-input" placeholder="Masukkan nama hotel" value="{{ $p['nama_hotel'] ?? '' }}">
                            </div>
                            <div>
                                <label class="form-label">Harga per Malam (Rp)</label>
                                <div class="relative">
                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant font-medium text-sm">Rp</span>
                                    <input type="number" step="0.01" min="0" name="penginapan[{{ $i }}][biaya_per_malam]" class="form-input biaya-malam pl-12 text-right" placeholder="0" value="{{ $p['biaya_per_malam'] ?? '' }}">
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="form-label">Check-in</label>
                                    <div class="date-input-wrapper">
                                        <input type="date" name="penginapan[{{ $i }}][tanggal_check_in]" class="form-input tgl-in pr-8" value="{{ $p['tanggal_check_in'] ?? '' }}">
                                    </div>
                                </div>
                                <div>
                                    <label class="form-label">Check-out</label>
                                    <div class="date-input-wrapper">
                                        <input type="date" name="penginapan[{{ $i }}][tanggal_check_out]" class="form-input tgl-out pr-8" value="{{ $p['tanggal_check_out'] ?? '' }}">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label class="form-label">Nomor Kamar</label>
                                <input type="text" name="penginapan[{{ $i }}][nomor_kamar]" class="form-input" value="{{ $p['nomor_kamar'] ?? '' }}">
                            </div>
                            <div>
                                <label class="form-label">No. Telp Hotel</label>
                                <input type="text" name="penginapan[{{ $i }}][no_telp_hotel]" class="form-input" value="{{ $p['no_telp_hotel'] ?? '' }}">
                            </div>
                        </div>
                    @endforeach
                </div>
                <button type="button" id="tambah-penginapan" class="mt-4 px-4 py-2.5 border border-outline-variant/40 text-primary rounded-lg font-label-md text-label-md flex items-center gap-2 hover:bg-primary/5 transition-colors">
                    <span class="material-symbols-outlined text-[18px]">add</span>
                    Tambah Penginapan
                </button>
            </div>

            <div id="bagian-transportasi" @if ($jenis !== 'Luar Daerah') style="display:none;" @endif>
                <div class="flex items-center gap-2 mb-4 text-primary font-semibold">
                    <span class="material-symbols-outlined text-[20px]">flight_takeoff</span>
                    <h4 class="text-base">Transportasi Udara/Darat</h4>
                </div>
                <div id="transportasi-wrap" class="space-y-4">
                    @foreach ($transportasiRows as $i => $t)
                        <div class="transportasi-row grid grid-cols-1 md:grid-cols-3 gap-4 p-5 bg-surface-container-lowest rounded-xl border border-surface-container-highest">
                            <div class="md:col-span-3 flex items-center justify-between">
                                <span class="text-sm font-semibold text-on-surface-variant uppercase tracking-wider">Transportasi #{{ $i + 1 }}</span>
                                <button type="button" class="text-on-surface-variant hover:text-error transition-colors p-1.5 rounded-lg hover:bg-error/10 hapus-transportasi" title="Hapus">
                                    <span class="material-symbols-outlined text-[20px]">delete</span>
                                </button>
                            </div>
                            <div>
                                <label class="form-label">Jenis Transportasi</label>
                                <select name="transportasi[{{ $i }}][jenis_transportasi]" class="form-input">
                                    <option value="">-- Pilih --</option>
                                    @foreach (['Taksi', 'Pesawat', 'Travel'] as $jt)
                                        <option value="{{ $jt }}" @selected(($t['jenis_transportasi'] ?? '') === $jt)>{{ $jt }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="form-label">Deskripsi</label>
                                <input type="text" name="transportasi[{{ $i }}][deskripsi]" class="form-input" value="{{ $t['deskripsi'] ?? '' }}" placeholder="cth: Tiket PP">
                            </div>
                            <div>
                                <label class="form-label">Tanggal Berangkat</label>
                                <input type="date" name="transportasi[{{ $i }}][tanggal_berangkat]" class="form-input" value="{{ $t['tanggal_berangkat'] ?? '' }}">
                            </div>
                            <div class="md:col-span-3 flex flex-col sm:flex-row items-center gap-3">
                                <input class="form-input flex-1" placeholder="Asal" name="transportasi[{{ $i }}][rute_dari]" value="{{ $t['rute_dari'] ?? '' }}">
                                <span class="material-symbols-outlined text-outline hidden sm:block">arrow_right_alt</span>
                                <span class="material-symbols-outlined text-outline sm:hidden rotate-90">arrow_right_alt</span>
                                <input class="form-input flex-1" placeholder="Tujuan" name="transportasi[{{ $i }}][rute_tujuan]" value="{{ $t['rute_tujuan'] ?? '' }}">
                            </div>
                            <div>
                                <label class="form-label">Harga Tiket (Rp)</label>
                                <div class="relative">
                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant font-medium text-sm">Rp</span>
                                    <input type="number" step="0.01" min="0" name="transportasi[{{ $i }}][harga_tiket]" class="form-input harga-tiket pl-12 text-right" placeholder="0" value="{{ $t['harga_tiket'] ?? '' }}">
                                </div>
                            </div>
                            <div>
                                <label class="form-label">Nomor Tiket</label>
                                <input type="text" name="transportasi[{{ $i }}][nomor_tiket]" class="form-input" value="{{ $t['nomor_tiket'] ?? '' }}">
                            </div>
                            <div>
                                <label class="form-label">Kode Booking</label>
                                <input type="text" name="transportasi[{{ $i }}][kode_booking]" class="form-input" value="{{ $t['kode_booking'] ?? '' }}">
                            </div>
                            <div>
                                <label class="form-label">Nomor Penerbangan</label>
                                <input type="text" name="transportasi[{{ $i }}][nomor_penerbangan]" class="form-input" value="{{ $t['nomor_penerbangan'] ?? '' }}">
                            </div>
                        </div>
                    @endforeach
                </div>
                <button type="button" id="tambah-transportasi" class="mt-4 px-4 py-2.5 border border-outline-variant/40 text-primary rounded-lg font-label-md text-label-md flex items-center gap-2 hover:bg-primary/5 transition-colors">
                    <span class="material-symbols-outlined text-[18px]">add</span>
                    Tambah Transportasi
                </button>
            </div>
        </div>
    </div>

    {{-- Kartu 4: Unggah Bukti --}}
    @if ($showUpload)
        <div class="form-card z-10 mb-0">
            <h3 class="form-card-title">
                <span class="step-number">4</span>
                <span>Unggah Dokumen Pendukung</span>
            </h3>
            <div class="md:pl-12">
                <p class="text-on-surface-variant text-sm mb-4">Silakan unggah Nota dinas, undangan, atau disposisi atasan (Format JPG/PDF, Maksimal 2MB per file)</p>
                <div class="flex items-center justify-center w-full">
                    <label class="flex flex-col items-center justify-center w-full h-48 border-2 border-outline-variant border-dashed rounded-xl cursor-pointer bg-surface hover:bg-surface-container-low transition-colors" for="dropzone-file">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <div class="w-16 h-16 rounded-full bg-primary-container flex items-center justify-center mb-4">
                                <span class="material-symbols-outlined text-3xl text-primary">upload_file</span>
                            </div>
                            <p class="mb-1 text-base text-on-surface-variant"><span class="font-semibold text-primary">Klik untuk unggah</span> atau seret file ke sini</p>
                            <p class="text-xs text-outline">Mendukung format PDF, JPG, PNG</p>
                        </div>
                        <input class="hidden" id="dropzone-file" type="file" name="lampiran[]" multiple accept=".jpg,.jpeg,.png,.pdf">
                    </label>
                </div>
            </div>
        </div>
    @endif
</div>

{{-- Floating Footer: Total & Aksi --}}
<div class="fixed bottom-0 right-0 w-full md:w-[calc(100%-280px)] bg-surface-container-lowest border-t border-outline-variant shadow-[0_-8px_20px_-10px_rgba(0,0,0,0.1)] px-4 sm:px-8 py-3.5 sm:py-5 flex flex-col sm:flex-row justify-between items-center gap-3 z-30 transition-all duration-300">
    <div class="w-full sm:w-auto flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-3">
        <span class="text-on-surface-variant text-sm font-medium uppercase tracking-wide">Total Estimasi Biaya</span>
        <span class="font-headline-md text-2xl sm:text-3xl text-secondary font-bold" id="total-preview">Rp 0</span>
    </div>
    <div class="flex items-center gap-2 sm:gap-4 w-full sm:w-auto">
        <a href="{{ $backUrl ?: url()->previous() }}" class="flex-1 sm:flex-none px-4 sm:px-6 py-3 border border-outline text-on-surface font-label-md text-label-md rounded-lg hover:bg-surface-container-low transition-colors text-center whitespace-nowrap">
            Batal
        </a>
        <button type="submit" class="flex-1 sm:flex-none px-4 sm:px-8 py-3 bg-primary text-white hover:bg-primary-container hover:text-on-primary-container font-label-md text-label-md rounded-lg shadow-md transition-colors flex items-center justify-center gap-2 whitespace-nowrap">
            <span class="material-symbols-outlined text-[20px]">check_circle</span>
            {{ $buttonText }}
        </button>
    </div>
</div>

@push('scripts')
<script>
    const formatRp = (n) => 'Rp ' + Math.round(n).toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    const totalEl = document.getElementById('total-preview');

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

    // Tampilkan/sembunyikan bagian penginapan & transportasi
    document.getElementById('jenis_perjalanan').addEventListener('change', function () {
        const luar = this.value === 'Luar Daerah';
        document.getElementById('bagian-penginapan').style.display = luar ? '' : 'none';
        document.getElementById('bagian-transportasi').style.display = luar ? '' : 'none';
    });

    // Hitung total preview
    function hitungTotal() {
        if (!totalEl) return;
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
        totalEl.textContent = formatRp(total);
    }
    document.addEventListener('input', hitungTotal);
    hitungTotal();

    // Baris dinamis: rincian
    let idxRincian = {{ count($rincianRows) }};
    const rincianRow = (i) => `
        <div class="rincian-row grid grid-cols-1 md:grid-cols-12 gap-4 items-center p-4 bg-surface-container-lowest rounded-xl border border-surface-container-highest">
            <div class="md:col-span-4">
                <label class="form-label mb-1">Jenis Biaya</label>
                <select name="rincian[${i}][jenis_biaya]" class="form-input">
                    <option>Harian</option><option>Representatif</option><option>Lain-lain</option><option>Taksi</option>
                </select>
            </div>
            <div class="md:col-span-3">
                <label class="form-label mb-1">Biaya per Hari (Rp)</label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant font-medium text-sm">Rp</span>
                    <input type="number" step="0.01" min="0" name="rincian[${i}][biaya_per_hari]" class="form-input biaya-per-hari pl-12 text-right" placeholder="0">
                </div>
            </div>
            <div class="md:col-span-3">
                <label class="form-label mb-1">Jumlah Hari</label>
                <input type="number" min="1" name="rincian[${i}][jumlah_hari]" class="form-input jml-hari" value="${document.getElementById('jumlah_hari').value || 1}">
            </div>
            <div class="md:col-span-2 flex md:justify-end pt-5">
                <button type="button" class="text-on-surface-variant hover:text-error transition-colors p-2 rounded-lg hover:bg-error/10 hapus-rincian" title="Hapus baris">
                    <span class="material-symbols-outlined text-[20px]">delete</span>
                </button>
            </div>
        </div>`;
    document.getElementById('tambah-rincian').addEventListener('click', () => {
        document.getElementById('rincian-wrap').insertAdjacentHTML('beforeend', rincianRow(idxRincian++));
    });
    document.getElementById('rincian-wrap').addEventListener('click', e => {
        if (e.target.closest('.hapus-rincian')) e.target.closest('.rincian-row').remove();
    });

    // Baris dinamis: penginapan
    let idxPenginapan = {{ count($penginapanRows) }};
    const penginapanRow = (i) => `
        <div class="penginapan-row grid grid-cols-1 md:grid-cols-2 gap-4 p-5 bg-surface-container-lowest rounded-xl border border-surface-container-highest">
            <div class="md:col-span-2 flex items-center justify-between">
                <span class="text-sm font-semibold text-on-surface-variant uppercase tracking-wider">Penginapan #${i + 1}</span>
                <button type="button" class="text-on-surface-variant hover:text-error transition-colors p-1.5 rounded-lg hover:bg-error/10 hapus-penginapan" title="Hapus">
                    <span class="material-symbols-outlined text-[20px]">delete</span>
                </button>
            </div>
            <div class="md:col-span-2"><label class="form-label">Nama Hotel/Penginapan</label>
                <input type="text" name="penginapan[${i}][nama_hotel]" class="form-input"></div>
            <div><label class="form-label">Harga per Malam (Rp)</label>
                <div class="relative"><span class="absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant font-medium text-sm">Rp</span>
                    <input type="number" step="0.01" min="0" name="penginapan[${i}][biaya_per_malam]" class="form-input biaya-malam pl-12 text-right" placeholder="0"></div></div>
            <div class="grid grid-cols-2 gap-4">
                <div><label class="form-label">Check-in</label>
                    <div class="date-input-wrapper"><input type="date" name="penginapan[${i}][tanggal_check_in]" class="form-input tgl-in pr-8"></div></div>
                <div><label class="form-label">Check-out</label>
                    <div class="date-input-wrapper"><input type="date" name="penginapan[${i}][tanggal_check_out]" class="form-input tgl-out pr-8"></div></div>
            </div>
            <div><label class="form-label">Nomor Kamar</label>
                <input type="text" name="penginapan[${i}][nomor_kamar]" class="form-input"></div>
            <div><label class="form-label">No. Telp Hotel</label>
                <input type="text" name="penginapan[${i}][no_telp_hotel]" class="form-input"></div>
        </div>`;
    document.getElementById('tambah-penginapan').addEventListener('click', () => {
        document.getElementById('penginapan-wrap').insertAdjacentHTML('beforeend', penginapanRow(idxPenginapan++));
    });
    document.getElementById('penginapan-wrap').addEventListener('click', e => {
        if (e.target.closest('.hapus-penginapan')) e.target.closest('.penginapan-row').remove();
    });

    // Baris dinamis: transportasi
    let idxTransportasi = {{ count($transportasiRows) }};
    const transportasiRow = (i) => `
        <div class="transportasi-row grid grid-cols-1 md:grid-cols-3 gap-4 p-5 bg-surface-container-lowest rounded-xl border border-surface-container-highest">
            <div class="md:col-span-3 flex items-center justify-between">
                <span class="text-sm font-semibold text-on-surface-variant uppercase tracking-wider">Transportasi #${i + 1}</span>
                <button type="button" class="text-on-surface-variant hover:text-error transition-colors p-1.5 rounded-lg hover:bg-error/10 hapus-transportasi" title="Hapus">
                    <span class="material-symbols-outlined text-[20px]">delete</span>
                </button>
            </div>
            <div><label class="form-label">Jenis Transportasi</label>
                <select name="transportasi[${i}][jenis_transportasi]" class="form-input">
                    <option value="">-- Pilih --</option><option>Taksi</option><option>Pesawat</option><option>Travel</option>
                </select></div>
            <div><label class="form-label">Deskripsi</label>
                <input type="text" name="transportasi[${i}][deskripsi]" class="form-input"></div>
            <div><label class="form-label">Tanggal Berangkat</label>
                <input type="date" name="transportasi[${i}][tanggal_berangkat]" class="form-input"></div>
            <div class="md:col-span-3 flex flex-col sm:flex-row items-center gap-3">
                <input class="form-input flex-1" placeholder="Asal" name="transportasi[${i}][rute_dari]">
                <span class="material-symbols-outlined text-outline hidden sm:block">arrow_right_alt</span>
                <span class="material-symbols-outlined text-outline sm:hidden rotate-90">arrow_right_alt</span>
                <input class="form-input flex-1" placeholder="Tujuan" name="transportasi[${i}][rute_tujuan]">
            </div>
            <div><label class="form-label">Harga Tiket (Rp)</label>
                <div class="relative"><span class="absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant font-medium text-sm">Rp</span>
                    <input type="number" step="0.01" min="0" name="transportasi[${i}][harga_tiket]" class="form-input harga-tiket pl-12 text-right" placeholder="0"></div></div>
            <div><label class="form-label">Nomor Tiket</label>
                <input type="text" name="transportasi[${i}][nomor_tiket]" class="form-input"></div>
            <div><label class="form-label">Kode Booking</label>
                <input type="text" name="transportasi[${i}][kode_booking]" class="form-input"></div>
            <div><label class="form-label">Nomor Penerbangan</label>
                <input type="text" name="transportasi[${i}][nomor_penerbangan]" class="form-input"></div>
        </div>`;
    document.getElementById('tambah-transportasi').addEventListener('click', () => {
        document.getElementById('transportasi-wrap').insertAdjacentHTML('beforeend', transportasiRow(idxTransportasi++));
    });
    document.getElementById('transportasi-wrap').addEventListener('click', e => {
        if (e.target.closest('.hapus-transportasi')) e.target.closest('.transportasi-row').remove();
    });
</script>
@endpush
