<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aspirasi;
use App\Models\Siswa;
use App\Models\InputAspirasi;
use App\Models\Kategori;
use Illuminate\Http\Request;

class AspirasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Hanya tampilkan yang menunggu dan proses
        $query = Aspirasi::with(['InputAspirasi', 'siswa', 'kategori'])
                         ->whereIn('status', ['menunggu', 'proses']);

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan kategori
        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }
        if ($request->filled('siswa_id')){
            $query->where('siswa_id', $request->siswa_id);
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

        $aspirasis = $query->latest()->paginate(10);
        $kategoris = Kategori::all();

        // Statistik
        $stats = [
            'total' => Aspirasi::count(),
            'menunggu' => Aspirasi::where('status', 'menunggu')->count(),
            'proses' => Aspirasi::where('status', 'proses')->count(),
            'selesai' => Aspirasi::where('status', 'selesai')->count(),
        ];

        return view('admin.aspirasi.index', compact('aspirasis', 'kategoris', 'stats'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Aspirasi $aspirasi)
    {
        $aspirasi->load(['InputAspirasi', 'siswa', 'kategori']);
        return view('admin.aspirasi.show', compact('aspirasi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Aspirasi $aspirasi)
    {
        $aspirasi->load(['InputAspirasi', 'siswa', 'kategori']);

        // Tentukan status yang tersedia berdasarkan status saat ini
        $availableStatuses = [];

        if ($aspirasi->status == 'menunggu') {
            // Dari menunggu hanya bisa ke proses
            $availableStatuses = [
                'proses' => 'Sedang Diproses',
            ];
        } elseif ($aspirasi->status == 'proses') {
            // Dari proses hanya bisa ke selesai
            $availableStatuses = [
                'selesai' => 'Selesai',
            ];
        }

        return view('admin.aspirasi.edit', compact('aspirasi', 'availableStatuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Aspirasi $aspirasi)
    {
        $validated = $request->validate([
            'status' => 'required|in:menunggu,proses,selesai',
            'feedback' => 'required|string',
        ], [
            'status.required' => 'Status harus dipilih',
            'status.in' => 'Status tidak valid',
            'feedback.required' => 'Feedback harus diisi',
        ]);

        $aspirasi->update($validated);

        // Jika status selesai, redirect ke halaman aspirasi selesai
        if ($validated['status'] == 'selesai') {
            return redirect()
                ->route('admin.aspirasi.index')
                ->with('success', 'Aspirasi berhasil diselesaikan dan dipindahkan ke daftar terselesaikan');
        }

        return redirect()
            ->route('admin.aspirasi.index')
            ->with('success', 'Status aspirasi berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Aspirasi $aspirasi)
    {
        $aspirasi->delete();

        return redirect()
            ->route('admin.aspirasi.index')
            ->with('success', 'Data aspirasi berhasil dihapus');
    }

}
