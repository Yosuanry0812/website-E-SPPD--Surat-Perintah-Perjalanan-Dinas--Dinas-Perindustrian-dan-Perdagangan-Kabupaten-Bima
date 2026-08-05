<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('perjalanan_dinas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('jenis_perjalanan', ['Dalam Daerah', 'Luar Daerah']);
            $table->string('nomor_sppd');
            $table->string('nomor_surat_tugas');
            $table->text('keperluan');
            $table->string('tempat_tujuan');
            $table->integer('jumlah_hari');
            $table->date('tanggal_berangkat');
            $table->date('tanggal_kembali');
            $table->decimal('total_biaya', 15, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('perjalanan_dinas');
    }
};
