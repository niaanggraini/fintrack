<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Kategori;

class Transaksi extends Model
{
    protected $fillable = [
        'user_id',
        'kategori_id',
        'keterangan',
        'nominal',
        'tanggal'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
