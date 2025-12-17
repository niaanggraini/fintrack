<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksis';
    protected $fillable = [
    'user_id',
    'kategori_id',
    'keterangan',
    'nominal',
    'tanggal',
];
}
