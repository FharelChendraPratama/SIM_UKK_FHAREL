@extends('layouts.app')

@section('title', 'Data Aspirasi')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Data Aspirasi</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('siswa.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Input Aspirasi</li>
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
                    <div class="card-header">
                        <h3 class="card-title">Daftar Aspirasi Saya</h3>
                        <div class="card-tools">
                            <a href="{{ route('siswa.input_aspirasi.create') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i> Tambah Aspirasi
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example1" class="table table-bordered table-striped dataTable">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kategori</th>
                                                <th>Lokasi</th>
                                                <th>Tanggal</th>
                                                <th>Keterangan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($aspirasis as $index => $aspirasi)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $aspirasi->kategori->ket_kategori ?? '-' }}</td>
                                                <td>{{ $aspirasi->lokasi }}</td>
                                                <td>{{ \Carbon\Carbon::parse($aspirasi->tanggal)->format('d/m/Y') }}</td>
                                                <td>{{ Str::limit($aspirasi->keterangan, 50) }}</td>
                                                <td class="text-center">
    @php
        $status = $aspirasi->aspirasi->status ?? null;
    @endphp

    @if($status === 'menunggu')
        <div class="btn-group">
            <a href="{{ route('siswa.input_aspirasi.edit', $aspirasi->id) }}"
               class="btn btn-warning btn-sm">
                <i class="fas fa-edit"></i>
            </a>

            <form action="{{ route('siswa.input_aspirasi.destroy', $aspirasi->id) }}"
                  method="POST" style="display:inline"
                  onsubmit="return confirm('Yakin ingin menghapus aspirasi ini?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm">
                    <i class="fas fa-trash"></i>
                </button>
            </form>
        </div>

    @elseif($status === 'proses')
        <span class="badge badge-primary">
            <i class="fas fa-user-cog"></i> Diproses Admin
        </span>
        <br>
        <small class="text-muted">
            <i class="fas fa-lock"></i> Tidak dapat diubah
        </small>

    @elseif($status === 'selesai')
        <span class="badge badge-success">
            <i class="fas fa-check-circle"></i> Selesai
        </span>
        <br>
        <small class="text-muted">
            <i class="fas fa-lock"></i>Aspirasi telah ditindaklanjuti
        </small>
    @endif
</td>

                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="6" class="text-center">Tidak ada data aspirasi</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["excel", "pdf", "print"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>
@endpush
