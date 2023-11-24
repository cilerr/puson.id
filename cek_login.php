<?php
session_start();

include 'koneksi.php';

$username = $_POST['username'];
$password = md5($_POST['password']);

$data = mysqli_query($koneksi, "select * from tb_user where username='$username' and password='$password'");
$data_user = mysqli_fetch_array($data);
$cek = mysqli_num_rows($data);

if ($cek > 0) {
  $_SESSION['username'] = $username;
  $_SESSION['level'] = $data_user['level'];
  $_SESSION['id_user'] = $data_user['id_user'];
  $_SESSION['status'] = "login";
  header("location:dashboard.php");
} else {
  header("location:login.php?pesan=gagal");
}
