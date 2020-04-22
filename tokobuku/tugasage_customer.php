  <?php
// load file config.php
include("configg.php");
// isset digunakan untuk mengecek apakah ketika file ini, dikirimkan data dengan nama "save_siswa" dengan method POST
if (isset($_POST["save_customer"])) {
  $action = $_POST['action'];
  $id_customer = $_POST['id_customer'];
  $nama = $_POST['nama'];
  $alamat = $_POST['alamat'];
  $kontak = $_POST['kontak'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  // cek action
  if ($action == "insert") {
    $sql = "insert into customer values('$id_customer','$nama','$alamat','$kontak','$username','$password')";
    // eksekusi perintah sql
    mysqli_query($connect, $sql);
  }elseif ($action == "update") {
    $sql = "update customer set nama='$nama',alamat='$alamat',kontak='$kontak',username='$username',password='$password' where id_customer='$id_customer'";
    }
    // eksekusi perintah sql
    mysqli_query($connect, $sql);
  }
  // redirect ke halaman siswa
  header("location:customer.php");

if (isset($_GET["hapus"])) {
  // load file config.php
  include("configg.php");
  $id_customer = $_GET['id_customer'];
  $sql = " select * from customer where id_customer='$id_customer'";
  $query = mysqli_query($connect, $sql);

  $sql = "delete from customer where id_customer='$id_customer'";
  $query = mysqli_query($connect, $sql);
  //direct halaman siswa
  header("location:customer.php");
}


 ?>
