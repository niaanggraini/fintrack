<?php

namespace Database\Seeders;
use App\Models\Kategori;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoris = [
            ['nama' => 'Makanan', 'warna' => 'green'],
            ['nama' => 'Transport', 'warna' => 'blue'],
            ['nama' => 'Hiburan', 'warna' => 'orange'],
            ['nama' => 'Belanja', 'warna' => 'purple'],
            ['nama' => 'Lainnya', 'warna' => 'gray'],
        ];

        foreach ($kategoris as $kategori) {
        Kategori::create($kategori);
        }

    }
}
