@include('admins.layouts.header')
@include('admins.layouts.sidebar')
    <main id="main" class="main">
      <div class="container">
          @yield('container')
      </div>
    </main>

    @include('admins.layouts.footer')

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
      <i class="bi bi-arrow-up-short"></i>
  </a>

    @stack('reply')
    @stack('reset_waktu')
    @stack('select-picker')
    <!-- Vendor JS Files -->
    <script src="/NiceAdmin/assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="/NiceAdmin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/NiceAdmin/assets/vendor/chart.js/chart.umd.js"></script>
    <script src="/NiceAdmin/assets/vendor/echarts/echarts.min.js"></script>
    <script src="/NiceAdmin/assets/vendor/quill/quill.min.js"></script>
    <script src="/NiceAdmin/assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="/NiceAdmin/assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="/NiceAdmin/assets/vendor/php-email-form/validate.js"></script>
    <script src="/NiceAdmin/assets/js/main.js"></script>
    {{-- <script src="/js/script.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

  </body>
</html>
