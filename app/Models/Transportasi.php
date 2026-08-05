<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transportasi extends Model
{
    protected $table = 'transportasi';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'harga_tiket' => 'decimal:2',
            'biaya_total' => 'decimal:2',
            'tanggal_berangkat' => 'date',
        ];
    }

    public function perjalananDinas(): BelongsTo
    {
        return $this->belongsTo(PerjalananDinas::class);
    }
}
