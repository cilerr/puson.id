<?php
session_start();
include('koneksi.php');
if ($_SESSION['status'] != "login") {
  header("location:login.php?pesan=belum_login");
}
if (isset($_GET['id_peminjaman']) && isset($_GET['id_buku'])) {
  $id_peminjaman = $_GET['id_peminjaman'];
  $id_buku = $_GET['id_buku'];
  $id_user = $_SESSION['id_user'];
  $sql = "INSERT INTO tb_pengembalian values(null, $id_user, $id_buku, 'dikembalikan')";
  $sql2 = "UPDATE tb_peminjaman set status = 'dikembalikan', tanggal_kembali_telat = CURDATE() WHERE id_peminjaman = $id_peminjaman";
  $sql3 = "UPDATE tb_buku set status = 'tersedia' where id_buku = '$id_buku'";
  $hasil1 = mysqli_query($koneksi, $sql);
  $hasil2 = mysqli_query($koneksi, $sql2);
  $hasil3 = mysqli_query($koneksi, $sql3);
  if ($hasil1 && $hasil2 && $hasil3) {
    echo "<script>alert('Buku berhasil dikembalikan.');window.location='buku.php';</script>";
  } else {
    echo "Error updating record: " . mysqli_error($koneksi);
  }
}
