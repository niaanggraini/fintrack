<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Transaksi;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategoris'; 

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
