<?php
session_start();
include('koneksi.php');
if ($_SESSION['status'] != "login") {
  header("location:login.php?pesan=belum_login");
}

if (isset($_GET['id_peminjaman'])) {
  $id = $_GET['id_peminjaman'];

  $result = mysqli_query($koneksi, "SELECT a.*, b.*, c.* FROM tb_peminjaman a 
    join tb_user b on a.id_user = b.id_user
    join tb_buku c on a.id_buku = c.id_buku
    WHERE id_peminjaman = $id");
  $row = mysqli_fetch_assoc($result);

  if ($result && mysqli_num_rows($result) > 0) {
    $id_user = $row['id_user'];
    $id_buku = $row['id_buku'];
    $tanggal_pinjam = $row['tanggal_pinjam'];
    $tanggal_kembali = $row['tanggal_kembali'];
  } else {
    echo "<script>alert('Data peminjaman tidak ada.');window.location='peminjaman.php';</script>";
    exit;
  }
} else {
  echo "<script>alert('Data peminjaman tidak ada.');window.location='peminjaman.php';</script>";
  exit;
}
$data_user = mysqli_query($koneksi, "SELECT * FROM tb_user");
$data_buku = mysqli_query($koneksi, "SELECT * FROM tb_buku");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin 2 - Tables</title>

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>


<style>
  .side {
    background-color: #009FE7;
  }
</style>

<body id="page-top">

  <div id="wrapper">
    <ul class="navbar-nav sidebar sidebar-dark accordion side" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-text mx-3">Puson<sup>.id</sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item ">
        <a class="nav-link" href="dashboard.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <!-- Nav Item - Tables -->
      <li class="nav-item ">
        <a class="nav-link" href="user.php">
          <i class="fas fa-fw fa-user-friends"></i>
          <span>Tables User</span>
        </a>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item active">
        <a class="nav-link" href="buku.php">
          <i class="fas fa-fw fa-book"></i>
          <span>Tables Buku</span>
        </a>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item ">
        <a class="nav-link" href="peminjaman.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Tables Peminjaman </span></a>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item ">
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
    <div id="content-wrapper" class="d-flex flex-column">

      <div id="content">

        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
          <!-- ... (your existing navbar code) ... -->
        </nav>

        <div class="container-fluid">

          <h1 class="h3 mb-4 text-gray-800">Edit Buku</h1>
          <form method="POST" action="">
            <div class="form-group">
              <label for="nama_buku">Nama Peminjam:</label>
              <select class="form-control" name="id_user" id="id_user">
                <?php foreach ($data_user as $user) { ?>
                  <option value="<?= $user['id_user'] ?>" <?php if ($user['id_user'] == $id_user) {
                                                            echo 'selected';
                                                          } ?>><?= $user['nama'] ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="nama_buku">Nama Buku:</label>
              <select class="form-control" name="id_buku" id="id_buku">
                <?php foreach ($data_buku as $buku) { ?>
                  <option value="<?= $buku['id_buku'] ?>" <?php if ($buku['id_buku'] == $id_buku) {
                                                            echo 'selected';
                                                          } ?>><?= $buku['nama_buku'] ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="nama_buku">Tanggal Pinjam:</label>
              <input type="date" class="form-control" id="tanggal_pinjam" value="<?= $tanggal_pinjam ?>" name="tanggal_pinjam" required>
            </div>
            <div class="form-group">
              <label for="nama_buku">Tanggal Kembali:</label>
              <input type="date" class="form-control" id="tanggal_kembali" value="<?= $tanggal_kembali ?>" name="tanggal_kembali" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Simpan Data</button>
          </form>

          <?php
          //jika klik tombol submit maka akan melakukan perubahan
          if (isset($_POST['submit'])) {
            $id_user = $_POST['id_user'];
            $id_buku = $_POST['id_buku'];
            $tanggal_pinjam = $_POST['tanggal_pinjam'];
            $tanggal_kembali = $_POST['tanggal_kembali'];

            $sql = "UPDATE `tb_peminjaman` SET `id_user`='$id_user',`id_buku`='$id_buku', tanggal_pinjam='$tanggal_pinjam', tanggal_kembali='$tanggal_kembali' WHERE id_peminjaman = $id";
            if (mysqli_query($koneksi, $sql)) {
              echo "<script>alert('Data berhasil diupdate.');window.location='peminjaman.php';</script>";
            } else {
              echo "Error updating record: " . mysqli_error($koneksi);
            }
          }
          ?>
        </div>

      </div>

      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2020</span>
          </div>
        </div>
      </footer>

    </div>

  </div>

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

</body>

</html>