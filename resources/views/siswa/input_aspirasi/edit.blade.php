@extends('layouts.app')

@section('title', 'Edit Aspirasi')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Aspirasi</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('siswa.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('siswa.input_aspirasi.index') }}">Input Aspirasi</a>
                    </li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title">Form Edit Aspirasi</h3>
                    </div>

                    <form action="{{ route('siswa.input_aspirasi.update', $inputAspirasi->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="card-body">

                            {{-- Kategori --}}
                            <div class="form-group">
                                <label for="kategori_id">
                                    Kategori <span class="text-danger">*</span>
                                </label>
                                <select
                                    class="form-control @error('kategori_id') is-invalid @enderror"
                                    id="kategori_id"
                                    name="kategori_id"
                                    required
                                >
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach ($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}"
                                            {{ old('kategori_id', $inputAspirasi->kategori_id) == $kategori->id ? 'selected' : '' }}>
                                            {{ $kategori->ket_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('kategori_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Lokasi --}}
                            <div class="form-group">
                                <label for="lokasi">
                                    Lokasi <span class="text-danger">*</span>
                                </label>
                                <input
                                    type="text"
                                    class="form-control @error('lokasi') is-invalid @enderror"
                                    id="lokasi"
                                    name="lokasi"
                                    value="{{ old('lokasi', $inputAspirasi->lokasi) }}"
                                    placeholder="Masukkan lokasi"
                                    required
                                >
                                @error('lokasi')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                                <small class="form-text text-muted">
                                    Contoh: Ruang Kelas XII A, Perpustakaan, Lapangan
                                </small>
                            </div>

                            {{-- Tanggal --}}
                            <div class="form-group">
                                <label for="tanggal">
                                    Tanggal <span class="text-danger">*</span>
                                </label>
                                <input
                                    type="date"
                                    class="form-control @error('tanggal') is-invalid @enderror"
                                    id="tanggal"
                                    name="tanggal"
                                    value="{{ old('tanggal', $inputAspirasi->tanggal) }}"
                                    required
                                >
                                @error('tanggal')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Keterangan --}}
                            <div class="form-group">
                                <label for="keterangan">
                                    Keterangan <span class="text-danger">*</span>
                                </label>
                                <textarea
                                    class="form-control @error('keterangan') is-invalid @enderror"
                                    id="keterangan"
                                    name="keterangan"
                                    rows="5"
                                    placeholder="Masukkan keterangan detail aspirasi"
                                    required
                                >{{ old('keterangan', $inputAspirasi->keterangan) }}</textarea>
                                @error('keterangan')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                                <small class="form-text text-muted">
                                    Jelaskan aspirasi secara detail dan jelas.
                                </small>
                            </div>

                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-save"></i> Update
                            </button>
                            <a href="{{ route('siswa.input_aspirasi.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
