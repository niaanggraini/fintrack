<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tracker extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama',
        'target',
        'terkumpul',
        'tanggal_target',
    ];
}
