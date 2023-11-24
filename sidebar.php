<?php
include('koneksi.php');
if ($_SESSION['status'] != "login") {
  header("location:login.php?pesan=belum_login");
}
$level = $_SESSION['level'];
$id_user = $_SESSION['id_user'];
?>
<!-- Sidebar -->
<?php if ($level == 1) { ?>
  <ul class="navbar-nav sidebar sidebar-dark accordion side" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
      <div class="sidebar-brand-text mx-3">Puson<sup>.id</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?php if (basename($_SERVER['REQUEST_URI']) == 'dashboard.php') {
                          echo 'active';
                        } ?>">
      <a class="nav-link" href="dashboard.php">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span>
      </a>
    </li>
    <!-- Nav Item - Tables -->
    <li class="nav-item <?php if (basename($_SERVER['REQUEST_URI']) == 'user.php') {
                          echo 'active';
                        } ?>">
      <a class="nav-link" href="user.php">
        <i class="fas fa-fw fa-user-friends"></i>
        <span>Tables User</span>
      </a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item <?php if (basename($_SERVER['REQUEST_URI']) == 'buku.php') {
                          echo 'active';
                        } ?>">
      <a class="nav-link" href="buku.php">
        <i class="fas fa-fw fa-book"></i>
        <span>Tables Buku</span>
      </a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item <?php if (basename($_SERVER['REQUEST_URI']) == 'peminjaman.php') {
                          echo 'active';
                        } ?>">
      <a class="nav-link" href="peminjaman.php">
        <i class="fas fa-fw fa-table"></i>
        <span>Tables Peminjaman </span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item <?php if (basename($_SERVER['REQUEST_URI']) == 'pengembalian.php') {
                          echo 'active';
                        } ?>">
      <a class="nav-link" href="pengembalian.php">
        <i class="fas fa-fw fa-table"></i>
        <span>Tables Pengembalian</span></a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

  </ul>
<?php } else if ($level == 2) { ?>
  <ul class="navbar-nav sidebar sidebar-dark accordion side" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
      <div class="sidebar-brand-text mx-3">Puson<sup>.id</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?php if (basename($_SERVER['REQUEST_URI']) == 'dashboard.php') {
                          echo 'active';
                        } ?>">
      <a class="nav-link" href="dashboard.php">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span>
      </a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item <?php if (basename($_SERVER['REQUEST_URI']) == 'buku.php') {
                          echo 'active';
                        } ?>">
      <a class="nav-link" href="buku.php">
        <i class="fas fa-fw fa-book"></i>
        <span>Tables Buku</span>
      </a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item <?php if (basename($_SERVER['REQUEST_URI']) == 'peminjaman.php') {
                          echo 'active';
                        } ?>">
      <a class="nav-link" href="peminjaman.php">
        <i class="fas fa-fw fa-table"></i>
        <span>Tables Peminjaman </span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item <?php if (basename($_SERVER['REQUEST_URI']) == 'pengembalian.php') {
                          echo 'active';
                        } ?>">
      <a class="nav-link" href="pengembalian.php">
        <i class="fas fa-fw fa-table"></i>
        <span>Tables Pengembalian</span></a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

  </ul>
<?php } ?>
<!-- End of Sidebar -->