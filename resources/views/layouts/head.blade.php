  <head>
      <meta charset="utf-8" />
      <meta name="viewport"
          content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

      <title>SINGASAKTI</title>
      <link href="{{ url('') }}/logo/x.png" rel="icon">

      <meta name="description" content="" />

      <!-- Favicon -->
      {{--  <link rel="icon" type="image/x-icon" href="{{ asset('') }}sneat/assets/img/favicon/favicon.ico" />  --}}

      <!-- Fonts -->
      <link rel="preconnect" href="https://fonts.googleapis.com" />
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
      <link
          href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
          rel="stylesheet" />

      <!-- Icons. Uncomment required icon fonts -->
      <link rel="stylesheet" href="{{ asset('') }}sneat/assets/vendor/fonts/boxicons.css" />

      <!-- Core CSS -->
      <link rel="stylesheet" href="{{ asset('') }}sneat/assets/vendor/css/core.css"
          class="template-customizer-core-css" />
      <link rel="stylesheet" href="{{ asset('') }}sneat/assets/vendor/css/theme-default.css"
          class="template-customizer-theme-css" />
      <link rel="stylesheet" href="{{ asset('') }}sneat/assets/css/demo.css" />

      <!-- Vendors CSS -->
      <link rel="stylesheet"
          href="{{ asset('') }}sneat/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

      <link rel="stylesheet" href="{{ asset('') }}sneat/assets/vendor/libs/apex-charts/apex-charts.css" />

      <!-- Page CSS -->

      <!-- Helpers -->
      <script src="{{ asset('') }}sneat/assets/vendor/js/helpers.js"></script>

      <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
      <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
      <script src="{{ asset('') }}sneat/assets/js/config.js"></script>

      <link href="{{ asset('') }}argon/assets/css/argon-dashboard.css" rel="stylesheet" />
      <link rel="stylesheet" href="{{ asset('node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
      <link rel="stylesheet"
          href="{{ asset('node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
      <link rel="stylesheet"
          href="{{ asset('node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
      {{-- <link rel="stylesheet" href="{{ asset('node_modules/select2/dist/css/select2.min.css') }}"> --}}
      <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
      <link rel="stylesheet" href="{{ asset('node_modules/izitoast/dist/css/iziToast.min.css') }}">
      <meta name="csrf-token" content="{{ csrf_token() }}" />
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css">
      @yield('custom_css')
  </head>
