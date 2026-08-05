<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transportasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('perjalanan_dinas_id')->constrained('perjalanan_dinas')->onDelete('cascade');
            $table->enum('jenis_transportasi', ['Taksi', 'Pesawat', 'Travel']);
            $table->string('deskripsi');
            $table->string('rute_dari');
            $table->string('rute_tujuan');
            $table->date('tanggal_berangkat');
            $table->decimal('harga_tiket', 15, 2);
            $table->string('nomor_tiket')->nullable();
            $table->string('kode_booking')->nullable();
            $table->string('nomor_penerbangan')->nullable();
            $table->decimal('biaya_total', 15, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transportasi');
    }
};
