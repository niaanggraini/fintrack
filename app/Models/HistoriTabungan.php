<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoriTabungan extends Model
{
    use HasFactory;

    protected $fillable = [
        'tabungan_id',
        'tanggal',
        'nominal',
        'catatan'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'nominal' => 'decimal:2'
    ];

    public function tabungan()
    {
        return $this->belongsTo(Tabungan::class);
    }
}