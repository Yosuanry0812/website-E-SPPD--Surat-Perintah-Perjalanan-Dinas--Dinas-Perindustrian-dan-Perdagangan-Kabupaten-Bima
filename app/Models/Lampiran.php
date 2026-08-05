<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lampiran extends Model
{
    protected $table = 'lampiran';

    protected $guarded = [];

    public function perjalananDinas(): BelongsTo
    {
        return $this->belongsTo(PerjalananDinas::class);
    }
}
