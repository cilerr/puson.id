<?php
session_start();
include('koneksi.php');
if ($_SESSION['status'] != "login") {
  header("location:login.php?pesan=belum_login");
}
if (isset($_GET['id_buku'])) {
  $id_buku = $_GET['id_buku'];
  $id_user = $_SESSION['id_user'];
  $tanggal_pinjam = date("Y-m-d");
  $tanggal_kembali_timestamp = strtotime($tanggal_pinjam . ' +7 days');
  $tanggal_kembali = date('Y-m-d', $tanggal_kembali_timestamp);
  $sql = "INSERT INTO tb_peminjaman VALUES (null,$id_user,$id_buku,'$tanggal_pinjam','$tanggal_kembali', '', '')";
  $sql2 = "UPDATE tb_buku set status = 'dipinjam' WHERE id_buku = $id_buku";
  $hasil1 = mysqli_query($koneksi, $sql);
  $hasil2 = mysqli_query($koneksi, $sql2);
  if ($hasil1 && $hasil2) {
    echo "<script>alert('Buku berhasil dipinjam.');window.location='buku.php';</script>";
  } else {
    echo "Error updating record: " . mysqli_error($koneksi);
  }
}
