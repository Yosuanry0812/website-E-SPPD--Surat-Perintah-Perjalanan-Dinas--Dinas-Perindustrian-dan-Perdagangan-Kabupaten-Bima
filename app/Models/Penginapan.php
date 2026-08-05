<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Penginapan extends Model
{
    protected $table = 'penginapan';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'biaya_per_malam' => 'decimal:2',
            'total_biaya' => 'decimal:2',
            'tanggal_check_in' => 'date',
            'tanggal_check_out' => 'date',
        ];
    }

    public function perjalananDinas(): BelongsTo
    {
        return $this->belongsTo(PerjalananDinas::class);
    }
}
