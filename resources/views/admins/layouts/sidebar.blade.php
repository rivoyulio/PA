@inject('authService', 'App\Http\Services\AuthService')

<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">

        @if($authService->currentUserIsAdmin())
            <li class="nav-heading">MENU ADMIN</li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="{{ url('dashboard') }}">
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
                        <a class="nav-link {{ Request::is('mahasiswa') ? 'active' : '' }}" href="{{ url('mahasiswa') }}">
                            <i class="bi bi-circle"></i><span>Data Mahasiswa</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('dosen') ? 'active' : '' }}" href="{{ url('dosen') }}">
                            <i class="bi bi-circle"></i><span>Data Dosen</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('kelas') ? 'active' : '' }}" href="{{ url('kelas') }}">
                            <i class="bi bi-circle"></i><span>Data Kelas</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('prodi') ? 'active' : '' }}" href="{{ url('prodi') }}">
                            <i class="bi bi-circle"></i><span>Data Prodi</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('agama') ? 'active' : '' }}" href="{{ url('agama') }}">
                            <i class="bi bi-circle"></i><span>Data Agama</span>
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
                <a class="nav-link {{ Request::is('dosen') ? 'active' : '' }}" href="{{ url('biodatadosen') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('mahasiswa') ? 'active' : '' }}" href="{{ url('datamahasiswa') }}">
                    <i class="bi bi-journal-text"></i>
                    <span>Data Mahasiswa</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dosen') ? 'active' : '' }}" href="{{ url('biodata') }}">
                    <i class="bi bi-person"></i>
                    <span>Biodata Mahasiswa</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('bimbingan') ? 'active' : '' }}" href="{{ url('dosenbimbingan') }}">
                    <i class="bi bi-clipboard-plus"></i>
                    <span>Bimbingan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('bimbingan') ? 'active' : '' }}" href="{{ url('history') }}">
                    <i class="bi bi-file-earmark"></i>
                    <span>History Mahasiswa</span>
                </a>
            </li>
        @endif

        @if($authService->currentUserIsMahasiswa())
            <li class="nav-heading">Menu Mahasiswa</li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('profilemahasiswa') ? 'active' : '' }}" href="{{ url('index') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('mahasiswabimbingan') ? 'active' : '' }}" href="{{ url('mahasiswabimbingan') }}">
                    <i class="bi bi-plus-circle"></i>
                    <span>Tambah Bimbingan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('bimbingan') ? 'active' : '' }}" href="{{ url('detail') }}">
                    <i class="bi bi-journal-text"></i>
                    <span>Detail Bimbingan</span>
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
