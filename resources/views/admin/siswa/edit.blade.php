@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Edit Data Siswa</h3>
                </div>

                <form action="{{ route('admin.siswa.update', $siswa->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama Siswa</label>
                            <input type="text" name="nama"
                                class="form-control @error('nama') is-invalid @enderror"
                                value="{{ old('nama', $siswa->nama) }}">
                            @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group">
                            <label>NISN</label>
                            <input type="text" name="nisn"
                                class="form-control @error('nisn') is-invalid @enderror"
                                value="{{ old('nisn', $siswa->nisn) }}">
                            @error('nisn') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group">
                            <label>Kelas</label>
                            <select name="kelas" class="form-control">
                                <option value="X" {{ old('kelas',$siswa->kelas)=='X'?'selected':'' }}>X</option>
                                <option value="XI" {{ old('kelas',$siswa->kelas)=='XI'?'selected':'' }}>XI</option>
                                <option value="XII" {{ old('kelas',$siswa->kelas)=='XII'?'selected':'' }}>XII</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Jurusan</label>
                            <input type="text" name="jurusan"
                                class="form-control"
                                value="{{ old('jurusan', $siswa->jurusan) }}">
                        </div>

                        <div class="form-group">
                            <label>Password <small>(kosongkan jika tidak diubah)</small></label>
                            <input type="password" name="password" class="form-control">
                        </div>
                    </div>

                    <div class="card-footer">
                        <button class="btn btn-primary">Update</button>
                        <a href="{{ route('admin.siswa.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
