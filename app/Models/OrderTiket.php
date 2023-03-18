<?php

namespace App\Models;

use App\Models\User;
use App\Models\Tiket;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderTiket extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_pemesan',
        'email_pemesan',
        'nohp_pemesan',
        'alamat_pemesan',
        'tiket_id',
        'user_id'
    ];

    public $timestamps = false;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tiket(): BelongsTo
    {
        return $this->belongsTo(Tiket::class);
    }
}
