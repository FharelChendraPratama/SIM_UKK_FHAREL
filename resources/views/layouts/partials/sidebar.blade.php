@if (session('role') === 'admin')


    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
            <img src="{{ asset('dist/img/king.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                style="opacity: .8">
            <span class="brand-text font-weight-light">Sistem Pengaduan</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                        alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">
                        @if (Auth::check() && session('role') === 'admin')
                            {{ Auth::user()->username }}
                        @elseif(session('role') === 'siswa')
                            {{ session('siswa_name') }}
                        @endif
                    </a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link active">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.kategori.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Kategori
                                <span class="right badge badge-success">show</span>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.siswa.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Management Siswa
                            </p>
                        </a>
                    </li>
                    <li class="nav-header">Penyelesaian</li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>
                                Aspirasi
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.aspirasi.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Aspirasi Masuk</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.aspirasi-selesai.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Aspirasi Selesai</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
@elseif(session('role') === 'siswa')
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
            <img src="{{ asset('dist/img/king.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                style="opacity: .8">
            <span class="brand-text font-weight-light">Sistem Pengaduan</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                        alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">
                        @if (Auth::check() && session('role') === 'admin')
                            {{ Auth::User()->Username }}
                        @elseif(session('role') === 'siswa')
                            {{ session('siswa_name') }}
                        @endif
                    </a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="{{ route('siswa.dashboard') }}" class="nav-link active">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('siswa.input_aspirasi.create') }}" class="nav-link">
                            <i class="nav-icon fas fa-plus-circle"></i>
                            <p>
                                Input Aspirasi
                                <span class="right badge badge-success">create</span>
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('siswa.input_aspirasi.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-list"></i>
                            <p>
                                Data Penginputan
                                <span class="right badge badge-info">list</span>
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('siswa.aspirasi.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-history"></i>
                            <p>
                                History Aspirasi
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
@endif
