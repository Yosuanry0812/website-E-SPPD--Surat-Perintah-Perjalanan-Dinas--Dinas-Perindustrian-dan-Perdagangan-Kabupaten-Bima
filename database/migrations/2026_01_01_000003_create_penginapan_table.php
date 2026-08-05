<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penginapan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('perjalanan_dinas_id')->constrained('perjalanan_dinas')->onDelete('cascade');
            $table->string('nama_hotel');
            $table->decimal('biaya_per_malam', 15, 2);
            $table->date('tanggal_check_in');
            $table->date('tanggal_check_out');
            $table->string('nomor_kamar');
            $table->string('no_telp_hotel');
            $table->decimal('total_biaya', 15, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penginapan');
    }
};
