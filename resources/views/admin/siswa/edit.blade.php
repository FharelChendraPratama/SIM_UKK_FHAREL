@extends('layouts.app')
@section('content')
@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Data Siswa</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ route('admin.siswa.update', $siswa) }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nama">Nama Siswa</label>
                                <input type="text" name="nama"
                                    class="form-control @error('nama') is-invalid @enderror" id="nama"
                                    placeholder="Enter Nama" value="{{ old('nama',$siswa) }}" required>
                                @error('nama')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nisn">NISN</label>
                                <input type="text" name="nisn"
                                    class="form-control @error('nisn') is-invalid @enderror" id="nisn"
                                    placeholder="Enter NISN" value="{{ old('nisn',$siswa) }}" required>
                                @error('nisn')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="kelas">Kelas</label>
                                <select name="kelas" class="form-control @error('kelas') is-invalid @enderror" required>
                                    <option value="">-- Pilih Kelas --</option>
                                    <option value="X" {{ old('kelas', $siswa) == 'X' ? 'selected' : '' }}>X</option>
                                    <option value="XI" {{ old('kelas', $siswa) == 'XI' ? 'selected' : '' }}>XI</option>
                                    <option value="XII" {{ old('kelas',$siswa) == 'XII' ? 'selected' : '' }}>XII</option>
                                </select>

                                @error('kelas')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="jurusan">Jurusan</label>
                                <input type="text" name="jurusan"
                                    class="form-control @error('jurusan') is-invalid @enderror" id="jurusan"
                                    placeholder="Enter Jurusan" value="{{ old('jurusan',$siswa) }}" required>
                                @error('jurusan')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror" id="password"
                                    placeholder="Enter Password" required>
                                @error('password')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('admin.siswa.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@endsection