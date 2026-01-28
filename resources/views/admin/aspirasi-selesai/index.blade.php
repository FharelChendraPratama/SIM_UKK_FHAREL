@extends('layouts.app')

@section('title', 'Aspirasi Terselesaikan')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">
                    <i class="fas fa-check-circle text-success"></i> Aspirasi Terselesaikan
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Aspirasi Selesai</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-success">
                        <h3 class="card-title text-white">
                            <i class="fas fa-list-check"></i> Daftar Aspirasi yang Telah Diselesaikan
                        </h3>
                        <div class="card-tools">
                            <!-- Tombol Print dengan Parameter Filter -->
                            <a href="{{ route('admin.aspirasi-selesai.print', request()->all()) }}"
                               class="btn btn-light btn-sm"
                               target="_blank">
                                <i class="fas fa-print"></i> Print
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle"></i> {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert">
                                    <span>&times;</span>
                                </button>
                            </div>
                        @endif

                        <!-- Filter Form -->
                        <form action="{{ route('admin.aspirasi-selesai.index') }}" method="GET" class="mb-3">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Kategori</label>
                                        <select name="kategori_id" class="form-control form-control-sm">
                                            <option value="">Semua Kategori</option>
                                            @foreach($kategoris as $kategori)
                                                <option value="{{ $kategori->id }}" {{ request('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                                    {{ $kategori->ket_kategori }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Pencarian</label>
                                        <input type="text" name="search" class="form-control form-control-sm"
                                               placeholder="Cari nama siswa, lokasi, atau keterangan..."
                                               value="{{ request('search') }}">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                        <button type="submit" class="btn btn-primary btn-sm btn-block">
                                            <i class="fas fa-search"></i> Filter
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <!-- Info Alert -->
                        @if(request('kategori_id') || request('search'))
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                <i class="fas fa-info-circle"></i>
                                Filter aktif. Hasil print akan mengikuti filter yang diterapkan.
                                <button type="button" class="close" data-dismiss="alert">
                                    <span>&times;</span>
                                </button>
                            </div>
                        @endif

                        <!-- Table -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th width="5%" class="text-center">No</th>
                                        <th width="15%">Siswa</th>
                                        <th width="12%">Kategori</th>
                                        <th width="13%">Lokasi</th>
                                        <th width="12%" class="text-center">Tgl Kejadian</th>
                                        <th>Keterangan</th>
                                        <th width="15%">Feedback</th>
                                        <th width="12%" class="text-center">Diselesaikan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($aspirasis as $index => $aspirasi)
                                    <tr>
                                        <td class="text-center">{{ $aspirasis->firstItem() + $index }}</td>
                                        <td>
                                            <div class="font-weight-bold">{{ $aspirasi->siswa->nama ?? '-' }}</div>
                                            <small class="text-muted">{{ $aspirasi->siswa->nisn ?? '' }}</small>
                                            @if($aspirasi->siswa->kelas)
                                                <br><small class="text-info">{{ $aspirasi->siswa->kelas }}</small>
                                            @endif
                                            <small class="text-muted">{{ $aspirasi->siswa->jurusan ?? '' }}</small>
                                        </td>
                                        <td>
                                            <span class="badge badge-info">
                                                {{ $aspirasi->kategori->ket_kategori ?? '-' }}
                                            </span>
                                        </td>
                                        <td>{{ $aspirasi->inputAspirasi->lokasi ?? '-' }}</td>
                                        <td class="text-center">
                                            {{ $aspirasi->inputAspirasi->tanggal ? $aspirasi->inputAspirasi->tanggal->format('d/m/Y') : '-' }}
                                        </td>
                                        <td>
                                            <small>{{ $aspirasi->inputAspirasi->keterangan ? Str::limit($aspirasi->inputAspirasi->keterangan, 60) : '-' }}</small>
                                        </td>
                                        <td>
                                            <small>{{ $aspirasi->feedback ? Str::limit($aspirasi->feedback, 60) : '-' }}</small>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge badge-success">
                                                {{ $aspirasi->updated_at->format('d/m/Y') }}
                                            </span>
                                            <br>
                                            <small class="text-muted">{{ $aspirasi->updated_at->format('H:i') }}</small>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-4">
                                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                            <p class="text-muted mb-0">Belum ada aspirasi yang terselesaikan</p>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="mt-3">
                            {{ $aspirasis->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
