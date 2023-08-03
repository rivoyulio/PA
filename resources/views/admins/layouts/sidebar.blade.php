@inject('authService', 'App\Http\Services\AuthService')

<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">

        @if($authService->currentUserIsAdmin())
            <li class="nav-heading">MENU ADMIN</li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('/admin') ? 'active' : '' }}" href="{{ url('/admin') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-journal-text"></i><span>Master Data</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a class="nav-link {{ Request::is('/admin/data/mahasiswa') ? 'active' : '' }}" href="{{ url('/admin/data/mahasiswa') }}">
                            <i class="bi bi-circle"></i><span>Data Mahasiswa</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('/admin/data/dosen') ? 'active' : '' }}" href="{{ url('/admin/data/dosen') }}">
                            <i class="bi bi-circle"></i><span>Data Dosen</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('/admin/data/kelas') ? 'active' : '' }}" href="{{ url('/admin/data/kelas') }}">
                            <i class="bi bi-circle"></i><span>Data Kelas</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('/admin/data/prodi') ? 'active' : '' }}" href="{{ url('/admin/data/prodi') }}">
                            <i class="bi bi-circle"></i><span>Data Prodi</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('/admin/data/agama') ? 'active' : '' }}" href="{{ url('/admin/data/agama') }}">
                            <i class="bi bi-circle"></i><span>Data Agama</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('/sp') ? 'active' : '' }}" href="{{ url('/sp') }}">
                            <i class="bi bi-circle"></i><span>Data SP</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('/pelanggaran') ? 'active' : '' }}" href="{{ url('/pelanggaran') }}">
                            <i class="bi bi-circle"></i><span>Data Pelanggaran</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('user') ? 'active' : '' }}" href="{{ url('user') }}">
                    <i class="bi bi-person"></i>
                    <span>User</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-file-earmark"></i></i><span>Laporan</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="forms-layouts.html">
                            <i class="bi bi-circle"></i><span>Laporan Per Kelas</span>
                        </a>
                    </li>
                    <li>
                        <a href="forms-editors.html">
                            <i class="bi bi-circle"></i><span>Laporan Bimbingan Mahasiswa</span>
                        </a>
                    </li>
                    <li>
                        <a href="forms-validation.html">
                            <i class="bi bi-circle"></i><span>Laporan Yang Tidak Bimingan</span>
                        </a>
                    </li>
                </ul>
            </li>
        @endif

        @if($authService->currentUserIsDosen())
            <li class="nav-heading">Menu Dosen</li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('/dosen') ? 'active' : '' }}" href="{{ url('/dosen') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('/dosen/mahasiswa') ? 'active' : '' }}" href="{{ url('/dosen/mahasiswa') }}">
                    <i class="bi bi-journal-text"></i>
                    <span>Data Mahasiswa</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('/dosen/mahasiswa/biodata') ? 'active' : '' }}" href="{{ url('/dosen/mahasiswa/biodata') }}">
                    <i class="bi bi-person"></i>
                    <span>Biodata Mahasiswa</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('/dosen/bimbingan') ? 'active' : '' }}" href="{{ url('/dosen/bimbingan') }}">
                    <i class="bi bi-clipboard-plus"></i>
                    <span>Bimbingan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('/dosen/bimbingan/history') ? 'active' : '' }}" href="{{ url('/dosen/bimbingan/history') }}">
                    <i class="bi bi-file-earmark"></i>
                    <span>History Mahasiswa</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('/sp') ? 'active' : '' }}" href="{{ url('/sp') }}">
                    <i class="bi bi-file-earmark"></i>
                    <span>SP</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('/pelanggaran') ? 'active' : '' }}" href="{{ url('/pelanggaran') }}">
                    <i class="bi bi-file-earmark"></i>
                    <span>Pelanggaran</span>
                </a>
            </li>
        @endif

        @if($authService->currentUserIsMahasiswa())
            <li class="nav-heading">Menu Mahasiswa</li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('/mahasiswa') ? 'active' : '' }}" href="{{ url('/mahasiswa') }}">
                    <i class="bi bi-grid"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('/mahasiswa/bimbingan') ? 'active' : '' }}" href="{{ url('/mahasiswa/bimbingan') }}">
                    <i class="bi bi-plus-circle"></i> <span>Tambah Bimbingan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('/mahasiswa/bimbingan/detail') ? 'active' : '' }}" href="{{ url('/mahasiswa/bimbingan/detail') }}">
                    <i class="bi bi-journal-text"></i> <span>Detail Bimbingan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('/sp') ? 'active' : '' }}" href="{{ url('/sp') }}">
                    <i class="bi bi-journal-text"></i> <span>SP</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('/pelanggaran') ? 'active' : '' }}" href="{{ url('/pelanggaran') }}">
                    <i class="bi bi-journal-text"></i> <span>Pelanggaran</span>
                </a>
            </li>
        @endif

        @if($authService->currentUserIsKaprodi())
            <li class="nav-heading">Menu Kaprodi</li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="pages-contact.html">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="pages-contact.html">
                    <i class="bi bi-file-earmark"></i>
                    <span>Laporan Per Kelas</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="pages-register.html">
                    <i class="bi bi-file-earmark"></i>
                    <span>Laporan Bimbingan Mahasiswa</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="pages-login.html">
                    <i class="bi bi-file-earmark"></i>
                    <span>Laporan Yang Tidak Bimbingan</span>
                </a>
            </li>
            <li>
                <a class="dropdown-item d-flex align-items-center" href="/logout">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Sign Out</span>
                </a>
            </li>
        @endif

    </ul>
</aside>
