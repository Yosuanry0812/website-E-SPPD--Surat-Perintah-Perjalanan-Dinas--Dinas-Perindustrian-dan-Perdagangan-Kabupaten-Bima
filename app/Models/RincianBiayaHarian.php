<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RincianBiayaHarian extends Model
{
    protected $table = 'rincian_biaya_harian';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'biaya_per_hari' => 'decimal:2',
            'total' => 'decimal:2',
        ];
    }

    public function perjalananDinas(): BelongsTo
    {
        return $this->belongsTo(PerjalananDinas::class);
    }
}
