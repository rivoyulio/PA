<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>BPA Online</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../img/pnp.png" rel="icon">
  {{-- <link href="/NiceAdmin/assets/img/favicon.png" rel="icon"> --}}
  <link href="/NiceAdmin/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="/NiceAdmin/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/NiceAdmin/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="/NiceAdmin/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="/NiceAdmin/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="/NiceAdmin/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="/NiceAdmin/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="/NiceAdmin/assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <link href="{{ 'css/imgModal.css' }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="/NiceAdmin/assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.5.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center" style="background-color:#f28705">

    <div class="d-flex align-items-center justify-content-between">
      <a href="{{ url('dashboard') }}" class="logo d-flex align-items-center">
        <span class="d-none d-lg-block p-2">BPA Online</span>
        {{-- <img src="../img/pnp.png"  width="35px" height="60px"> --}}

      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->


    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown">

        <li class="nav-item dropdown pe-3">

          {{-- @if (Auth::check()) --}}
          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            @if (Auth::guard('mahasiswa')->check()) 
              <img src="{{ asset('images/'. session('fotomhs')) }}" alt="Profile" class="rounded-circle">
              <span class="d-none d-md-block dropdown-toggle ps-2">{{ session('nama_mhs') }}</span>
            @else
              <img src="{{ asset('images/'. session('foto_user')) }}" alt="Profile" class="rounded-circle">
              <span class="d-none d-md-block dropdown-toggle ps-2">{{ session('nama_user') }}</span>
            @endif
          </a>
          <!-- End Profile Image Icon -->
      {{-- @endif --}}
    
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
            @if (Auth::guard('mahasiswa')->check())
              <h6>{{ Auth::guard('mahasiswa')->user()->nama_mhs }}</h6>
            @else
              <h6>{{ Auth::user()->nama_user }}</h6>
            @endif
              {{-- <span>{{ Auth::user()->level }}</span> --}}
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" {{ Request::is('user') ? 'active' : '' }}" href="{{ url('profile') }}">
                
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="/logout">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->
