<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BayarTiket extends Model
{
    use HasFactory;
    protected $guarded = [''];

    public function orderTiket(): BelongsTo
    {
        return $this->belongsTo(OrderTiket::class);
    }
}
