<?php
session_start();
$_SESSION['username'] = '';
unset($_SESSION['username']);
unset($_SESSION['id_user']);
unset($_SESSION['level']);
session_unset();
session_destroy();
header("Location: login.php");
