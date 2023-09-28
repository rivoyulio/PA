@inject('authService', 'App\Http\Services\AuthService')

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <title>BPA Online</title>
        <meta content="" name="description">
        <meta content="" name="keywords">

        <link href="/img/pnp.png" rel="icon">
        <link href="/NiceAdmin/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

        <link href="https://fonts.gstatic.com" rel="preconnect">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

        <link href="/NiceAdmin/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="/NiceAdmin/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="/NiceAdmin/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
        <link href="/NiceAdmin/assets/vendor/quill/quill.snow.css" rel="stylesheet">
        <link href="/NiceAdmin/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
        <link href="/NiceAdmin/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
        <link href="/NiceAdmin/assets/vendor/simple-datatables/style.css" rel="stylesheet">
        <link href="{{ 'css/imgModal.css' }}" rel="stylesheet">

        <link href="/NiceAdmin/assets/css/style.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    </head>

    <body>
        <header id="header" class="header fixed-top d-flex align-items-center" style="background-color:#f28705">
            <div class="d-flex align-items-center justify-content-between">
                <a href="{{ $authService->dashboardUrl() }}" class="logo d-flex align-items-center">
                    <span class="d-none d-lg-block p-2">BPA Online</span>
                </a>
                <i class="bi bi-list toggle-sidebar-btn"></i>
            </div>

            <nav class="header-nav ms-auto">
                <ul class="d-flex align-items-center">

                    <li class="nav-item d-block d-lg-none">
                        <a class="nav-link nav-icon search-bar-toggle " href="#">
                            <i class="bi bi-search"></i>
                        </a>
                    </li>

                    <li class="nav-item dropdown pe-3">
                        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                            @if ($authService->currentUserGuard() == 'mahasiswa')
                                <img
                                    src="{{ asset('images/'. $authService->currentUserGuardInstance()->user()->fotomhs) }}"
                                    alt="Profile"
                                    class="rounded-circle"
                                />
                                <span class="d-none d-md-block dropdown-toggle ps-2">{{ $authService->currentUserGuardInstance()->user()->nama_mhs }}</span>
                            @else
                                <span class="d-none d-md-block dropdown-toggle ps-2">{{ $authService->currentUserGuardInstance()->user()->nama_user }}</span>
                            @endif
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                            <li class="dropdown-header">
                                @if ($authService->currentUserGuard() == 'mahasiswa')
                                    <h6>{{ $authService->currentUserGuardInstance()->user()->nama_mhs }}</h6>
                                @else
                                    <h6>{{ $authService->currentUserGuardInstance()->user()->nama_user }}</h6>
                                @endif
                            </li>

                            <li><hr class="dropdown-divider"></li>

                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="{{ $authService->dashboardUrl() }}">
                                    <i class="bi bi-person"></i> <span>My Profile</span>
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="/logout">
                                    <i class="bi bi-box-arrow-right"></i> <span>Sign Out</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </header>
