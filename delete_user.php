<?php
session_start();
include('koneksi.php');
if ($_SESSION['status'] != "login") {
  header("location:login.php?pesan=belum_login");
}
if (isset($_GET['id_user'])) {
  $id = $_GET['id_user'];
  $sql = "DELETE FROM tb_user WHERE id_user = '$id'";
  if (mysqli_query($koneksi, $sql)) {
    echo "<script>alert('Data berhasil dihapus.');window.location='user.php';</script>";
  } else {
    echo "Error updating record: " . mysqli_error($koneksi);
  }
}
