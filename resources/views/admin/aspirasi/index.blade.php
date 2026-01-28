@extends('layouts.app')

@section('title', 'Kelola Aspirasi')

@section('content')
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Kelola Aspirasi Siswa</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Aspirasi</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            {{-- Statistik --}}
            <div class="row">
                @php
                    $cards = [
                        [
                            'bg' => 'info',
                            'icon' => 'clipboard-list',
                            'label' => 'Total Aspirasi',
                            'value' => $stats['total'],
                        ],
                        ['bg' => 'warning', 'icon' => 'clock', 'label' => 'Menunggu', 'value' => $stats['menunggu']],
                        [
                            'bg' => 'primary',
                            'icon' => 'spinner',
                            'label' => 'Sedang Diproses',
                            'value' => $stats['proses'],
                        ],
                        [
                            'bg' => 'success',
                            'icon' => 'check-circle',
                            'label' => 'Selesai',
                            'value' => $stats['selesai'],
                        ],
                    ];
                @endphp

                @foreach ($cards as $card)
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-{{ $card['bg'] }}">
                            <div class="inner">
                                <h3>{{ $card['value'] }}</h3>
                                <p>{{ $card['label'] }}</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-{{ $card['icon'] }}"></i>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Table & Filter --}}
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <h3 class="card-title">Daftar Aspirasi</h3>
                        </div>

                        <div class="card-body">

                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show">
                                    {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                </div>
                            @endif

                            {{-- Filter --}}
                            <form action="{{ route('admin.aspirasi.index') }}" method="GET" class="mb-3">
                                <div class="row">

                                    {{-- BARIS 1 --}}
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="status" class="form-control form-control-sm">
                                                <option value="">Semua Status</option>
                                                <option value="menunggu"
                                                    {{ request('status') == 'menunggu' ? 'selected' : '' }}>
                                                    Menunggu</option>
                                                <option value="proses"
                                                    {{ request('status') == 'proses' ? 'selected' : '' }}>
                                                    Proses</option>
                                                <option value="selesai"
                                                    {{ request('status') == 'selesai' ? 'selected' : '' }}>
                                                    Selesai</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Kategori</label>
                                            <select name="kategori_id" class="form-control form-control-sm">
                                                <option value="">Semua Kategori</option>
                                                @foreach ($kategoris as $kategori)
                                                    <option value="{{ $kategori->id }}"
                                                        {{ request('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                                        {{ $kategori->ket_kategori }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Siswa</label>
                                            <select name="siswa_id" class="form-control form-control-sm">
                                                <option value="">Semua Siswa</option>
                                                @foreach ($siswas as $siswa)
                                                    <option value="{{ $siswa->id }}"
                                                        {{ request('siswa_id') == $siswa->id ? 'selected' : '' }}>
                                                        {{ $siswa->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Pencarian</label>
                                            <input type="text" name="search" class="form-control form-control-sm"
                                                placeholder="Nama / lokasi..." value="{{ request('search') }}">
                                        </div>
                                    </div>

                                    {{-- BARIS 2 --}}
                                    {{-- BARIS 2 --}}
                                    <div class="row">

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Tanggal</label>
                                                <input type="date" name="tanggal" class="form-control form-control-sm"
                                                    value="{{ request('tanggal') }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Bulan</label>
                                                <input type="month" name="bulan" class="form-control form-control-sm"
                                                    value="{{ request('bulan') }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>&nbsp;</label>
                                                <div class="input-group input-group-sm">
                                                    <button type="submit" class="btn btn-primary btn-block">
                                                        <i class="fas fa-search"></i> Filter
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>&nbsp;</label>
                                                <div class="input-group input-group-sm">
                                                    <a href="{{ route('admin.aspirasi.index') }}"
                                                        class="btn btn-secondary btn-block">
                                                        <i class="fas fa-sync"></i> Reset
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>


                                </div>
                            </form>


                            {{-- Table --}}
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th>Siswa</th>
                                            <th>Kategori</th>
                                            <th>Lokasi</th>
                                            <th>Tanggal</th>
                                            <th>Status</th>
                                            <th>Feedback</th>
                                            <th width="15%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($aspirasis as $i => $aspirasi)
                                            <tr>
                                                <td>{{ $aspirasis->firstItem() + $i }}</td>
                                                <td>{{ $aspirasi->siswa->nama ?? '-' }}</td>
                                                <td>
                                                    <span class="badge badge-secondary">
                                                        {{ $aspirasi->kategori->ket_kategori ?? '-' }}
                                                    </span>
                                                </td>
                                                <td>{{ $aspirasi->inputAspirasi->lokasi ?? '-' }}</td>
                                                <td>
                                                    {{ optional($aspirasi->inputAspirasi)->tanggal
                                                        ? \Carbon\Carbon::parse($aspirasi->inputAspirasi->tanggal)->format('d/m/Y')
                                                        : '-' }}
                                                </td>
                                                <td>
                                                    <span class="badge {{ $aspirasi->status_badge }}">
                                                        {{ $aspirasi->status_label }}
                                                    </span>
                                                </td>
                                                <td>{{ Str::limit($aspirasi->feedback, 30) }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="{{ route('admin.aspirasi.edit', $aspirasi->id) }}"
                                                            class="btn btn-warning btn-sm">
                                                            <i class="fas fa-edit"></i> Kelola
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center text-muted">
                                                    Tidak ada data aspirasi
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            {{-- Pagination --}}
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
