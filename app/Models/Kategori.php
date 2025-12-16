<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Transaksi;

class Kategori extends Model
{
    protected $fillable = ['nama', 'warna'];

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }

    public function pengeluarans()
    {
        return $this->hasMany(Pengeluaran::class);
    }
}
