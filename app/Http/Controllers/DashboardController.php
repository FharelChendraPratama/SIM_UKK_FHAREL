<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kategori;
use App\Models\Aspirasi;
class DashboardController extends Controller
{
    //
    public  function siswa(){
        return view('siswa.dashboard');
    }

    public function admin()
{
    $totalSiswa = Siswa::count();
    $totalKategori = Kategori::count();

    $totalAspirasiSelesai = Aspirasi::where('status', 'selesai')->count();
    $totalAspirasiBelumSelesai = Aspirasi::whereIn('status', ['menunggu', 'proses'])->count();

    return view('admin.dashboard', compact(
        'totalSiswa',
        'totalKategori',
        'totalAspirasiSelesai',
        'totalAspirasiBelumSelesai'
    ));
}
}
