<?php
// load file config.php
include("config.php");
// isset digunakan untuk mengecek apakah ketika file ini, dikirimkan data dengan nama "save_siswa" dengan method POST
if (isset($_POST["save_admin"])) {
  $action = $_POST["action"];
  $id_admin = $_POST["id_admin"];
  $nama = $_POST["nama"];
  $kontak = $_POST["kontak"];
  $username = $_POST["username"];
  $password = $_POST["password"];
// cek action
if ($action == "insert") {
  $sql = "insert into admin values ('$id_admin','$nama','$kontak','$username','$password')";
  // eksekusi perintah sql
  mysqli_query($connect, $sql);
}elseif ($action == "update") {
  $sql = "update admin set nama='$nama',id_admin='$id_admin',kontak='$kontak',username='$username',password='$password' where id_admin='$id_admin'";

  // eksekusi perintah sql
  mysqli_query($connect, $sql);
}
// redirect ke halaman siswa
header("location:admin.php");
}
if (isset($_GET["hapus"])) {
  include("config.php");
  $id_admin = $_GET['id_admin'];
  $sql = " select * from admin where id_admin='$id_admin'";
  $query = mysqli_query($connect, $sql);

  $sql = "delete from admin where id_admin='$id_admin'";
  $query = mysqli_query($connect, $sql);
  //direct halaman siswa
 header("location:admin.php");
}
?>
