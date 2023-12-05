<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Login</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../img/pnp.png" rel="icon">
    <link href="NiceAdmin/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="NiceAdmin/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="NiceAdmin/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="NiceAdmin/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="NiceAdmin/assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="NiceAdmin/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="NiceAdmin/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="NiceAdmin/assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="NiceAdmin/assets/css/style.css" rel="stylesheet">
</head>


 <body style="background-image: url(/img/bgpnp.jpeg);
 background-repeat: no-repeat;
 background-size: 100%;
 background-position: center;">
    <main>
        <div class="container">

            @include('sweetalert::alert')

            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                            @if (session()->has('notLogin'))
                            <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert"">
                                Anda Harus Login Terlebih Dahulu
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif

                            <div class="card mb-3">

                                <div class="card-body" style="">
                                    <div class="d-flex justify-content-center py-4">
                                        <a  class="logo d-flex align-items-center w-auto">
                                            <span class="d-none d-lg-block text-center">Sistem Informasi Penasehat Akademik</span>
                                            
                                        </a>
                                    </div>

                                    <img src="../img/pnp.png" class="rounded mx-auto d-block" style="center" alt="" width="120px" height="120px">
                                    
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-2 fs-5">Silahkan Pilih Role :</h5>
                                    </div>

                                    <form class="row g-3 needs-validation" action="login/proses" method="post" novalidate>
                                        @csrf
                                        <div class="d-grid gap-2 col-6 mx-auto">
                                            <a href="login" class="btn btn-warning">Dosen</a>
                                            <a href="loginmahasiswa" class="btn btn-primary">Mahasiswa</a>
                                        </div>                                    
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="NiceAdmin/assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="NiceAdmin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="NiceAdmin/assets/vendor/chart.js/chart.umd.js"></script>
    <script src="NiceAdmin/assets/vendor/echarts/echarts.min.js"></script>
    <script src="NiceAdmin/assets/vendor/quill/quill.min.js"></script>
    <script src="NiceAdmin/assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="NiceAdmin/assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="NiceAdmin/assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="NiceAdmin/assets/js/main.js"></script>

</body>

</html>
