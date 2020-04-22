<?php
session_start();
include("configg.php");
if (isset($_POST["add_to_cart"])) {
  $kode_buku = $_POST["kode_buku"];
  $jumlah = $_POST["jumlah"];
  $sql = "select * from buku where kode_buku = '$kode_buku'";
  $query = mysqli_query($connect, $sql); // eksekusi query khusus select
  $buku = mysqli_fetch_array($query);
  $item = [
    "kode_buku" => $buku["kode_buku"],
    "judul" => $buku["judul"],
    "image" => $buku["image"],
    "harga" => $buku["harga"],
    "jumlah" => $jumlah
  ];
  array_push($_SESSION["cart"], $item);
  header("location:bookstore_and_user.php");
}
if (isset($_GET["hapus"])) {
  $kode_buku = $_GET["kode_buku"];
  //cari index buku
  $index = array_search(
    $kode_buku, array_column(
    $_SESSION["cart"],"kode_buku"
    )
  );
  //hapus item pada Cart
  array_splice($_SESSION["cart"], $index, 1);
  header("location:cart.php");
}
if (isset($_GET["checkout"])) {
  $id_transaki = "ID".rand(1,10000);
  $tgl = date("Y-m-d H:i:s");
  // year month day hours minute secon
  $id_customer = $_SESSION["id_customer"];
  $sql = "insert into transaksi values('$id_transaki','$tgl',$id_customer)";
  mysqli_query($connect, $sql); // eksekusi query selain update delete
  foreach ($_SESSION["cart"] as $cart) {
    // code...
    $kode_buku = $cart["kode_buku"];
    $jumlah = $cart["jumlah"];
    $harga = $cart["harga"];
    //buat query insert
    $sql = "insert into detail_transaksi values ('$id_transaki','$kode_buku','$jumlah','$harga')";
    mysqli_query($connect,$sql);
    $sql2 = "update buku set stok = '$stok' - $jumlah where kode_buku='$kode_buku'";
    mysqli_query($connect,$sql2);
  }
  //kosongkan cart
  $_SESSION["cart"]=array();
  header("location:transaksi.php");
}
 ?>
