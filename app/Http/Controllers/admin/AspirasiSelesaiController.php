<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aspirasi;
use App\Models\Kategori;
use Illuminate\Http\Request;

class AspirasiSelesaiController extends Controller
{
    public function index(Request $request)
    {
        $query = Aspirasi::with(['InputAspirasi', 'siswa', 'kategori'])
                         ->where('status', 'selesai');

        // Filter berdasarkan kategori
        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('siswa', function($subQ) use ($search) {
                    $subQ->where('nama', 'like', "%{$search}%");
                })->orWhereHas('InputAspirasi', function($subQ) use ($search) {
                    $subQ->where('lokasi', 'like', "%{$search}%")
                         ->orWhere('keterangan', 'like', "%{$search}%");
                });
            });
        }

        $aspirasis = $query->latest('updated_at')->paginate(10);
        $kategoris = Kategori::all();

        return view('admin.aspirasi-selesai.index', compact('aspirasis', 'kategoris'));
    }

    public function show(Aspirasi $aspirasi)
    {
        // Pastikan hanya yang status selesai
        if ($aspirasi->status != 'selesai') {
            abort(404);
        }

        $aspirasi->load(['InputAspirasi', 'siswa', 'kategori']);
        return view('admin.aspirasi-selesai.show', compact('aspirasi'));
    }
}
