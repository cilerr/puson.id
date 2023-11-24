<?php
session_start();
include('koneksi.php');
if ($_SESSION['status'] != "login") {
  header("location:login.php?pesan=belum_login");
}
if (isset($_GET['id_peminjaman'])) {
  $id = $_GET['id_peminjaman'];
  $sql = "DELETE FROM tb_peminjaman WHERE id_peminjaman = '$id'";
  if (mysqli_query($koneksi, $sql)) {
    echo "<script>alert('Data berhasil dihapus.');window.location='peminjaman.php';</script>";
  } else {
    echo "Error updating record: " . mysqli_error($koneksi);
  }
}
