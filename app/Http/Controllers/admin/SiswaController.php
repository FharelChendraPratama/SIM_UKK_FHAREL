<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $siswa = Siswa::all();
        return view('admin.siswa.index', compact('siswa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        return view('admin.siswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'nisn' => 'required|string|max:255|unique:siswas,nisn',
        'kelas' => 'required|in:X,XI,XII',
        'jurusan' => 'required|string|max:255',
        'password' => 'required|string|min:6',
    ]);

    Siswa::create([
        'nama' => $request->nama,
        'nisn' => $request->nisn,
        'kelas' => $request->kelas,
        'jurusan' => $request->jurusan,
        'password' => Hash::make($request->password),
    ]);

    return redirect()
        ->route('admin.siswa.index')
        ->with('success', 'Siswa berhasil ditambahkan');
}
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Siswa $siswa)
    {
        //
        return view('admin.siswa.edit', compact('siswa'));
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, Siswa $siswa)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'nisn' => 'required|string|max:255|unique:siswas,nisn,' . $siswa->id,
        'kelas' => 'required|in:X,XI,XII',
        'jurusan' => 'required|string|max:255',
        'password' => 'nullable|string|min:6',
    ]);

    $data = $request->only('nama', 'nisn', 'kelas', 'jurusan');

    if ($request->filled('password')) {
        $data['password'] = Hash::make($request->password);
    }

    $siswa->update($data);

    return redirect()
        ->route('admin.siswa.index')
        ->with('success', 'Siswa berhasil diubah');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Siswa $siswa)
    {
        //
        $siswa->delete();

        return redirect()->route('admin.siswa.index')->with('success', 'Siswa berhasil dihapus.');
    }
}
