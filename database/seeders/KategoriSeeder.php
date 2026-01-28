<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        \App\Models\Kategori::create([
            'ket_kategori' => 'Ruang Kelas',
        ]);
        \App\Models\Kategori::create([
            'ket_kategori' => 'Lab/Bengkel',
        ]);
        \App\Models\Kategori::create([
            'ket_kategori' => 'Toilet',
        ]);
        \App\Models\Kategori::create([
            'ket_kategori' => 'Listrik',
        ]);
        \App\Models\Kategori::create([
            'ket_kategori' => 'Pustaka Kelas',
        ]);
        \App\Models\Kategori::create([
            'ket_kategori' => 'Jurusan',
        ]);
    }
}
