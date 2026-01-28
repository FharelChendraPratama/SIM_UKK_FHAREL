<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aspirasi;
use App\Models\Siswa;
use App\Models\Kategori;
use Illuminate\Http\Request;

class AspirasiSelesaiController extends Controller
{
public function index(Request $request)
{
    $query = Aspirasi::with(['inputAspirasi', 'siswa', 'kategori'])
        ->where('status', 'selesai');

    // Filter Kategori
    if ($request->filled('kategori_id')) {
        $query->where('kategori_id', $request->kategori_id);
    }

    // Filter Siswa
    if ($request->filled('siswa_id')) {
        $query->where('siswa_id', $request->siswa_id);
    }

    // Filter Tanggal (exact)
    if ($request->filled('tanggal')) {
        $query->whereHas('inputAspirasi', function ($q) use ($request) {
            $q->whereDate('tanggal', $request->tanggal);
        });
    }

    // Filter Bulan
    if ($request->filled('bulan')) {
        [$year, $month] = explode('-', $request->bulan);

        $query->whereHas('inputAspirasi', function ($q) use ($year, $month) {
            $q->whereYear('tanggal', $year)
              ->whereMonth('tanggal', $month);
        });
    }

    // Search
    if ($request->filled('search')) {
        $search = $request->search;

        $query->where(function ($q) use ($search) {
            $q->whereHas('siswa', function ($sub) use ($search) {
                $sub->where('nama', 'like', "%{$search}%");
            })->orWhereHas('inputAspirasi', function ($sub) use ($search) {
                $sub->where('lokasi', 'like', "%{$search}%")
                    ->orWhere('keterangan', 'like', "%{$search}%");
            });
        });
    }

    $aspirasis = $query->latest('updated_at')->paginate(10)->withQueryString();

    $kategoris = Kategori::all();
    $siswas    = Siswa::orderBy('nama')->get();

    return view('admin.aspirasi-selesai.index', compact(
        'aspirasis',
        'kategoris',
        'siswas'
    ));
}


    public function print(Request $request)
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

        // Ambil semua data tanpa pagination untuk print
        $aspirasis = $query->latest('updated_at')->get();
        $kategoris = Kategori::all();

        return view('admin.aspirasi-selesai.print', compact('aspirasis', 'kategoris'));
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
