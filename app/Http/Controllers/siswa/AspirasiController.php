<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Aspirasi;
use App\Models\Kategori;
use Illuminate\Http\Request;

class AspirasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil siswa_id dari session
        $siswaId = session('siswa_id');

        // Ambil data aspirasi milik siswa yang sedang login
        $query = Aspirasi::with(['inputAspirasi', 'siswa', 'kategori'])
                         ->where('siswa_id', $siswaId);

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan kategori
        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('inputAspirasi', function($q) use ($search) {
                $q->where('lokasi', 'like', "%{$search}%")
                  ->orWhere('keterangan', 'like', "%{$search}%");
            });
        }

        $aspirasis = $query->latest()->paginate(10);
        $kategoris = Kategori::all();

        // Statistik untuk siswa yang login
        $stats = [
            'total' => Aspirasi::where('siswa_id', $siswaId)->count(),
            'menunggu' => Aspirasi::where('siswa_id', $siswaId)->where('status', 'menunggu')->count(),
            'proses' => Aspirasi::where('siswa_id', $siswaId)->where('status', 'proses')->count(),
            'selesai' => Aspirasi::where('siswa_id', $siswaId)->where('status', 'selesai')->count(),
        ];

        return view('siswa.aspirasi.index', compact('aspirasis', 'kategoris', 'stats'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Aspirasi $aspirasi)
    {
        // Pastikan aspirasi milik siswa yang login
        if ($aspirasi->siswa_id !== session('siswa_id')) {
            abort(403, 'Unauthorized action.');
        }

        $aspirasi->load(['inputAspirasi', 'siswa', 'kategori']);
        return view('siswa.aspirasi.show', compact('aspirasi'));
    }
}