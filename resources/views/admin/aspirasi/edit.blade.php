@extends('layouts.app')

@section('title', 'Kelola Aspirasi')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Kelola Aspirasi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.aspirasi.index') }}">Aspirasi</a></li>
                        <li class="breadcrumb-item active">Kelola</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card shadow-sm">
                        <div class="card-body p-4">

                            <!-- Header -->
                            <div class="text-center mb-4 pb-4 border-bottom">
                                <h4 class="font-weight-bold mb-1">Formulir Pengelolaan Aspirasi</h4>
                                <p class="text-muted mb-0">No.
                                    ASP/{{ date('Y') }}/{{ str_pad($aspirasi->id, 5, '0', STR_PAD_LEFT) }}</p>
                            </div>

                            <!-- Data Siswa -->
                            <div class="mb-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="bg-primary rounded px-3 py-1 text-white font-weight-bold mr-2">A</div>
                                    <h5 class="mb-0 font-weight-bold">Data Siswa</h5>
                                </div>

                                <div class="pl-4">
                                    <div class="row mb-2">
                                        <div class="col-md-3 text-muted">Nama Lengkap</div>
                                        <div class="col-md-9 font-weight-bold">{{ $aspirasi->siswa->nama ?? '-' }}</div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-3 text-muted">NISN</div>
                                        <div class="col-md-9">{{ $aspirasi->siswa->nisn ?? '-' }}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 text-muted">Kelas</div>
                                        <div class="col-md-9">{{ $aspirasi->siswa->kelas ?? '-' }}</div>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4">

                            <!-- Detail Aspirasi -->
                            <div class="mb-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="bg-info rounded px-3 py-1 text-white font-weight-bold mr-2">B</div>
                                    <h5 class="mb-0 font-weight-bold">Detail Aspirasi</h5>
                                </div>

                                <div class="pl-4">
                                    <div class="row mb-2">
                                        <div class="col-md-3 text-muted">Kategori</div>
                                        <div class="col-md-9">
                                            <span class="badge badge-info px-3 py-1">
                                                {{ $aspirasi->kategori->ket_kategori ?? '-' }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-3 text-muted">Lokasi Kejadian</div>
                                        <div class="col-md-9">{{ $aspirasi->inputAspirasi->lokasi ?? '-' }}</div>
                                    </div>
                                    <div class="col-md-9">
                                        {{ $aspirasi->inputAspirasi->tanggal
                                            ? \Carbon\Carbon::parse($aspirasi->inputAspirasi->tanggal)->format('d F Y')
                                            : '-' }}
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-3 text-muted">Status Saat Ini</div>
                                        <div class="col-md-9">
                                            <span class="badge {{ $aspirasi->status_badge }} px-3 py-1">
                                                {{ strtoupper($aspirasi->status_label) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 text-muted">Keterangan</div>
                                        <div class="col-md-9">
                                            <div class="bg-light p-3 rounded border-left border-primary"
                                                style="border-left-width: 3px !important;">
                                                {{ $aspirasi->inputAspirasi->keterangan ?? '-' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4">

                            <!-- Form Tindak Lanjut -->
                            <form action="{{ route('admin.aspirasi.update', $aspirasi->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-4">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="bg-success rounded px-3 py-1 text-white font-weight-bold mr-2">C</div>
                                        <h5 class="mb-0 font-weight-bold">Tindak Lanjut</h5>
                                    </div>

                                    <div class="pl-4">
                                        <!-- Status -->
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label text-muted">
                                                Ubah Status <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-9">
                                                <select class="form-control @error('status') is-invalid @enderror"
                                                    name="status" required>
                                                    <option value="">-- Pilih Status Baru --</option>
                                                    @foreach ($availableStatuses as $value => $label)
                                                        <option value="{{ $value }}"
                                                            {{ old('status') == $value ? 'selected' : '' }}>
                                                            {{ $label }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('status')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Feedback -->
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label text-muted">
                                                Catatan Feedback <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-9">
                                                <textarea class="form-control @error('feedback') is-invalid @enderror" name="feedback" rows="6"
                                                    placeholder="Tuliskan tindak lanjut atau penjelasan..." required>{{ old('feedback', $aspirasi->feedback) }}</textarea>
                                                @error('feedback')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                                <small class="form-text text-muted">
                                                    <i class="fas fa-info-circle"></i> Berikan penjelasan yang jelas
                                                    mengenai tindakan yang diambil
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr class="my-4">

                                <!-- Informasi Sistem -->
                                <div class="mb-4">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="bg-secondary rounded px-3 py-1 text-white font-weight-bold mr-2">D</div>
                                        <h5 class="mb-0 font-weight-bold">Informasi Sistem</h5>
                                    </div>

                                    <div class="pl-4">
                                        <div class="row text-muted small">
                                            <div class="col-md-6">
                                                <i class="far fa-calendar-plus"></i> Dibuat pada:
                                                <strong class="text-dark">{{ $aspirasi->created_at->format('d/m/Y H:i') }}
                                                    WIB</strong>
                                            </div>
                                            <div class="col-md-6">
                                                <i class="far fa-calendar-check"></i> Update terakhir:
                                                <strong class="text-dark">{{ $aspirasi->updated_at->format('d/m/Y H:i') }}
                                                    WIB</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="text-center pt-3 border-top">
                                    <button type="submit" class="btn btn-primary btn-lg px-5">
                                        <i class="fas fa-save"></i> Simpan Perubahan
                                    </button>
                                    <a href="{{ route('admin.aspirasi.index') }}"
                                        class="btn btn-secondary btn-lg px-5 ml-2">
                                        <i class="fas fa-arrow-left"></i> Kembali
                                    </a>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('styles')
        <style>
            .card {
                border: none;
                border-radius: 10px;
            }

            .form-control:focus {
                border-color: #007bff;
                box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
            }

            .border-left {
                border-left: 3px solid #007bff !important;
            }
        </style>
    @endpush
@endsection
