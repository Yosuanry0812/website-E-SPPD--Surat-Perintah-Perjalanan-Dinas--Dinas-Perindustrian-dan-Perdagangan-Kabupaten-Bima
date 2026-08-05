<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rincian_biaya_harian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('perjalanan_dinas_id')->constrained('perjalanan_dinas')->onDelete('cascade');
            $table->enum('jenis_biaya', ['Harian', 'Representatif', 'Lain-lain', 'Taksi']);
            $table->decimal('biaya_per_hari', 15, 2);
            $table->integer('jumlah_hari');
            $table->decimal('total', 15, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rincian_biaya_harian');
    }
};
