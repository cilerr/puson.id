<?php
session_start();
include('koneksi.php');
if ($_SESSION['status'] != "login") {
  header("location:login.php?pesan=belum_login");
}
if (isset($_GET['id_buku'])) {
  $id = $_GET['id_buku'];
  $sql = "DELETE FROM tb_buku WHERE id_buku = '$id'";
  if (mysqli_query($koneksi, $sql)) {
    echo "<script>alert('Data berhasil dihapus.');window.location='buku.php';</script>";
  } else {
    echo "Error updating record: " . mysqli_error($koneksi);
  }
}
