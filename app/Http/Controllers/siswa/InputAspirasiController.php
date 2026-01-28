<?php

namespace App\Http\Controllers\siswa;

use App\Http\Controllers\Controller;
use App\Models\InputAspirasi;
use App\Models\Aspirasi;
use App\Models\Kategori;
use Illuminate\Http\Request;

class InputAspirasiController extends Controller
{
    private function siswaId()
    {
        return session('siswa_id');
    }

    public function index()
    {
        $aspirasis = InputAspirasi::with(['kategori', 'aspirasi'])
            ->where('siswa_id', $this->siswaId())
            ->latest()
            ->get();

        return view('siswa.input_aspirasi.index', compact('aspirasis'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('siswa.input_aspirasi.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'lokasi'      => 'required|string|max:255',
            'tanggal'     => 'required|date',
            'keterangan'  => 'required|string',
        ]);

        // simpan input siswa
        $input = InputAspirasi::create([
            'siswa_id'    => $this->siswaId(),
            'kategori_id' => $validated['kategori_id'],
            'lokasi'      => $validated['lokasi'],
            'tanggal'     => $validated['tanggal'],
            'keterangan'  => $validated['keterangan'],
        ]);

        // otomatis masuk ke tabel aspirasis (admin)
        Aspirasi::create([
            'input_aspirasi_id' => $input->id,
            'siswa_id'          => $input->siswa_id,
            'kategori_id'       => $input->kategori_id,
            'status'            => 'menunggu',
            'feedback'          => '-',
        ]);

        return redirect()
            ->route('siswa.input_aspirasi.index')
            ->with('success', 'Aspirasi berhasil ditambahkan');
    }

    public function show(InputAspirasi $inputAspirasi)
    {
        if ($inputAspirasi->siswa_id !== $this->siswaId()) {
            abort(403);
        }

        return view('siswa.input_aspirasi.show', compact('inputAspirasi'));
    }

    public function edit(InputAspirasi $inputAspirasi)
{
    if ($inputAspirasi->siswa_id !== $this->siswaId()) {
        abort(403);
    }

    if ($inputAspirasi->aspirasi->status !== 'menunggu') {
        return redirect()
            ->route('siswa.input_aspirasi.index')
            ->with('error', 'Aspirasi sudah diproses dan tidak dapat diubah');
    }

    $kategoris = Kategori::all();
    return view('siswa.input_aspirasi.edit', compact('inputAspirasi', 'kategoris'));
}


    public function update(Request $request, InputAspirasi $inputAspirasi)
    {
        if ($inputAspirasi->siswa_id !== $this->siswaId()) {
            abort(403);
        }

        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'lokasi'      => 'required|string|max:255',
            'tanggal'     => 'required|date',
            'keterangan'  => 'required|string',
        ]);

        $inputAspirasi->update($validated);

        // update juga di tabel aspirasis
        $inputAspirasi->aspirasi()->update([
            'kategori_id' => $validated['kategori_id'],
        ]);

        return redirect()
            ->route('siswa.input_aspirasi.index')
            ->with('success', 'Aspirasi berhasil diperbarui');
    }

    public function destroy(InputAspirasi $inputAspirasi)
{
    if ($inputAspirasi->siswa_id !== $this->siswaId()) {
        abort(403);
    }

    if ($inputAspirasi->aspirasi->status !== 'menunggu') {
        return redirect()
            ->route('siswa.input_aspirasi.index')
            ->with('error', 'Aspirasi tidak dapat dihapus karena sedang diproses');
    }

    $inputAspirasi->aspirasi()->delete();
    $inputAspirasi->delete();

    return redirect()
        ->route('siswa.input_aspirasi.index')
        ->with('success', 'Aspirasi berhasil dihapus');
}

}
