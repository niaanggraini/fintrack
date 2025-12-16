<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tabungan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_tabungan',
        'target_tabungan',
        'target_tanggal',
        'saldo_awal',
        'saldo_terkini'
    ];

    protected $casts = [
        'target_tanggal' => 'date',
        'target_tabungan' => 'decimal:2',
        'saldo_awal' => 'decimal:2',
        'saldo_terkini' => 'decimal:2'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function historiTabungans()
    {
        return $this->hasMany(HistoriTabungan::class);
    }

    public function getProgressPercentageAttribute()
    {
        if ($this->target_tabungan == 0) return 0;
        return min(100, round(($this->saldo_terkini / $this->target_tabungan) * 100));
    }

    public function updateSaldoTerkini()
    {
        $total = $this->saldo_awal + $this->historiTabungans()->sum('nominal');
        $this->update(['saldo_terkini' => $total]);
    }
}