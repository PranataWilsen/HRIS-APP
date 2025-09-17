<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>HRIS App</title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
  <!-- AdminLTE -->
  <link rel="stylesheet" href="/dist/css/adminlte.min.css">
  <!-- Bootstrap Icons (optional) -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/" class="nav-link">Dashboard</a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Sidebar -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="/" class="brand-link">
      <i class="fas fa-users-cog brand-image img-circle elevation-3"></i>
      <span class="brand-text font-weight-light">HRIS App</span>
    </a>
    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" role="menu">
          <li class="nav-item"><a href="/pegawai" class="nav-link"><i class="nav-icon fas fa-user"></i><p>Pegawai</p></a></li>
          <li class="nav-item"><a href="/departemen" class="nav-link"><i class="nav-icon fas fa-building"></i><p>Departemen</p></a></li>
          <li class="nav-item"><a href="/keahlian" class="nav-link"><i class="nav-icon fas fa-lightbulb"></i><p>Keahlian</p></a></li>
          <li class="nav-item"><a href="/quiz" class="nav-link"><i class="nav-icon fas fa-question-circle"></i><p>Kuis</p></a></li>
          <li class="nav-header">LAPORAN</li>
          <li class="nav-item"><a href="/report/perDepartemen" class="nav-link"><i class="nav-icon fas fa-chart-bar"></i><p>Pegawai / Departemen</p></a></li>
          <li class="nav-item"><a href="/report/perKeahlian" class="nav-link"><i class="nav-icon fas fa-project-diagram"></i><p>Pegawai / Keahlian</p></a></li>
          <li class="nav-item"><a href="/report/hasilKuis" class="nav-link"><i class="nav-icon fas fa-poll"></i><p>Hasil Kuis</p></a></li>
          <li class="nav-item"><a href="/chart" class="nav-link"><i class="nav-icon fas fa-chart-pie"></i><p>Statistik (Chart)</p></a></li>
        </ul>
      </nav>
    </div>
  </aside>
  <!-- /.sidebar -->

  <!-- Content -->
  <div class="content-wrapper p-3">
    <?= $this->renderSection('content') ?>
  </div>

  <!-- Footer -->
  <footer class="main-footer text-center">
    <strong>&copy; <?= date('Y') ?> HRIS App.</strong> All rights reserved.
  </footer>

</div>

<!-- jQuery -->
<script src="/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/dist/js/adminlte.min.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Custom scripts per page -->
<?= $this->renderSection('scripts') ?>
</body>
</html>
