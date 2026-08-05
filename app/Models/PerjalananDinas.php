<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PerjalananDinas extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'tanggal_berangkat' => 'date',
            'tanggal_kembali' => 'date',
            'total_biaya' => 'decimal:2',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function rincianBiayaHarian(): HasMany
    {
        return $this->hasMany(RincianBiayaHarian::class);
    }

    public function penginapan(): HasMany
    {
        return $this->hasMany(Penginapan::class);
    }

    public function transportasi(): HasMany
    {
        return $this->hasMany(Transportasi::class);
    }

    public function lampiran(): HasMany
    {
        return $this->hasMany(Lampiran::class);
    }
}
