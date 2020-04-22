<?php
session_start();
//session_start() digunakan sebagai tanda kalau kita kana menggunakan session pada halaman ini
//session_start() harus diletakkan pada awal
include("configg.php");
//tampung data
$username = $_POST["username"];
$password = $_POST["password"];
if (isset($_POST["login_admin"])) {
  $sql = "select * from admin where username = '$username' and password = '$password'";
  $query = mysqli_query($connect, $sql);
  $jumlah = mysqli_num_rows($query);//untuk menghitung jumlah data hasil query

  if ($jumlah > 0 ) {//jika true maka data sesuai,login berhasil
    $admin = mysqli_fetch_array($query);
    $_SESSION["id_admin"] = $admin["id_admin"];
    $_SESSION["username"] = $admin["username"];
    header("location:buku.php");
  }
  else {//data tidak sesuai, login gagal
    header("location:login_admin.php");
  }
}
if (isset($_GET["logout"])) {
  // proses logout
  session_destroy();//proses penghapusan
  header("location:login_admin.php");
}
 ?>
