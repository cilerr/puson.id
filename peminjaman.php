<?php
session_start();
include('koneksi.php');
if ($_SESSION['status'] != "login") {
  header("location:login.php?pesan=belum_login");
}
$level = $_SESSION['level'];
$id_user = $_SESSION['id_user'];
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

  <!-- Page Wrapper -->
  <div id="wrapper">

    <?php include('sidebar.php'); ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <form class="form-inline">
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
              <i class="fa fa-bars"></i>
            </button>
          </form>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            </li>
            <!-- Nav Item - User Information -->
            <li class="">
              <a href="logout.php" onclick="return confirm ('Apakah Anda Yakin?')" class="btn btn-primary side" style="border-rounded: 30px;">Logout</a>
            </li>
          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->

          <!-- DataTales Example -->
          <?php if ($level == 1) { ?>
            <h1 class="h3 mb-2 text-gray-800">Data Peminjaman</h1><br>
            <a href="tambah_peminjaman.php" class="btn side" style="color: white;">Tambah data</a><br><br>
            <div class="card shadow mb-4">
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Anggota</th>
                        <th>Nama Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      include "koneksi.php";
                      $query = "SELECT a.*, b.*, c.* FROM tb_peminjaman a 
                                        join tb_user b on a.id_user = b.id_user
                                        join tb_buku c on a.id_buku = c.id_buku";
                      $hasil = mysqli_query($koneksi, $query);
                      $no = 1;
                      while ($data = mysqli_fetch_array($hasil)) {

                      ?>

                        <tr>
                          <td><?php echo $no++; ?></td>
                          <td><?php echo $data['nama']; ?></td>
                          <td><?php echo $data['nama_buku']; ?></td>
                          <td><?php echo $data['tanggal_pinjam']; ?></td>
                          <td><?php echo $data['tanggal_kembali']; ?></td>
                          <td>
                            <a href="edit_peminjaman.php?id_peminjaman=<?php echo $data['id_peminjaman']; ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="delete_peminjaman.php?id_peminjaman=<?php echo $data['id_peminjaman']; ?>" name="delete" class="btn btn-sm btn-danger" onclick="return confirm ('Apakah Anda Yakin?')">Delete</a>
                          </td>
                        </tr>

                      <?php

                      }

                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          <?php } else if ($level == 2) { ?>
            <h1 class="h3 mb-2 text-gray-800">Buku Yang Dipinjam</h1><br>
            <div class="card shadow mb-4">
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Anggota</th>
                        <th>Nama Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      include "koneksi.php";
                      $query = "SELECT a.*, b.*, c.* FROM tb_peminjaman a 
                                        join tb_user b on a.id_user = b.id_user
                                        join tb_buku c on a.id_buku = c.id_buku where a.id_user = $id_user && a.status != 'dikembalikan'";
                      $hasil = mysqli_query($koneksi, $query);
                      $no = 1;
                      while ($data = mysqli_fetch_array($hasil)) {

                      ?>

                        <tr>
                          <td><?php echo $no++; ?></td>
                          <td><?php echo $data['nama']; ?></td>
                          <td><?php echo $data['nama_buku']; ?></td>
                          <td><?php echo $data['tanggal_pinjam']; ?></td>
                          <td><?php echo $data['tanggal_kembali']; ?></td>
                          <?php if ($data['tanggal_kembali'] > date('Y-m-d')) { ?>
                            <td>
                              <a href="<?= $data['link_buku'] ?>" target="_blank" class="btn btn-sm btn-primary">Baca Buku</a>
                            </td>
                          <?php } else { ?>
                            <td>
                              <a href="kembalikan_buku.php?id_peminjaman=<?= $data['id_peminjaman'] ?>&id_buku=<?= $data['id_buku'] ?>" class="btn btn-sm btn-danger">Kembalikan Buku</a>

                            </td>
                          <?php } ?>
                        </tr>

                      <?php

                      }

                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Apakah Anda Yakin?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" href="login.html">Ya</button>
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Tidak</button>
        </div>
      </div>
    </div>
  </div>

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
  <script>
    function bukaLink(link) {
      // Ganti URL dengan link yang ingin Anda buka

      // Buka link di jendela/tab baru
      window.open(link, '_blank');
    }
  </script>

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