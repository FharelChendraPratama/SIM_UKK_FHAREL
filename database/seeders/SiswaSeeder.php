<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        \App\Models\Siswa::create([
            'nama' => 'Tonggos',
            'nisn' => '0099887766',
            'kelas' => 'XII',
            'jurusan' => 'RPL',
            'password' => bcrypt('0099887766'),
        ]);
    }
}
