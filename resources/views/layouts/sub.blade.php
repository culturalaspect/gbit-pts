<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $page_title }}</title>
  <link rel="shortcut icon" href="{{ url('/img/gbdoelogo.png') }}">
  <meta name="description" content="The Directorate of Education (Colleges) Gilgit Balistan is attached Department, facilitating and supervising the College/Higher level Education in Gilgit-Baltistan. Besides this, Directorate of Education (Colleges) is dealing with disbursement of stipend to the students of GB and merit scholarships to the students of GB studying in professional institutions of the country. The DoE (colleges) also deals with the nomination of about 800 reserved seats for Gilgit-Baltistan in different institution of the country.">
  <meta name="author" content="Directorate of Education (Colleges) Gilgit Balistan">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{ url('/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ url('/css/icheck-bootstrap.min.css') }}">

  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('css/adminlte.min.css') }}">
  <!-- Custom Styling -->
  <link rel="stylesheet" href="{{ url('css/customstyle.css') }}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="{{ url('/') }}">
      <img width="80px" class="img img-responsive" src="{{ url('img/gbdoelogo.png') }}">
      <h4 class="theme_color family-century">IT Department GB</h4>
      <h4 class="theme_color family-century">Performance Tracking and Management System</h4>
    </a>
  </div>
  <!-- /.login-logo -->
  <div class="content">
    @yield('content')
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ url('/js/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ url('/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ url('/js/jquery.validate.min.js') }}"></script>
<script src="{{ url('/js/additional-methods.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ url('/js/adminlte.min.js') }}"></script>

@stack('scripts')
</body>
</html>
