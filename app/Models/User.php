<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'favorite_category',  // punya temen lo (pengeluaran)
        'phone',              // punya lo (profile)
        'negara',             // punya lo (profile)
        'kota',               // punya lo (profile)
        'alamat',             // punya lo (profile)
        'profile_photo',      // punya lo (profile)
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    
    /**
     * Relationships
     */
    
    // Relationship untuk Pengeluaran (punya temen lo)
    public function pengeluarans()
    {
        return $this->hasMany(Pengeluaran::class);
    }
    
    // Relationship untuk Tabungan (punya lo)
    public function tabungans()
    {
        return $this->hasMany(Tabungan::class);
    }
}