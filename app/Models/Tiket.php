<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tiket extends Model
{
    use HasFactory;
    protected $guarded = [''];

    public function konser(): BelongsTo
    {
        return $this->belongsTo(Konser::class);
    }
}
