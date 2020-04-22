<?php
    session_start();
    if (!isset($_SESSION["username"])) {
      header("location:login_customer.php");
    }
    // memanggil file config.php agar tidak perlu membuat koneksi baru
    include("configg.php");
 ?>
 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Bookstore</title>
     <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script type="text/javascript">
        Detail = (item) =>{
          document.getElementById("kode_buku").value = item.kode_buku;
          document.getElementById("judul").innerHTML ="Judul = " + item.judul;
          document.getElementById("penulis").innerHTML ="Penulis = " + item.penulis;
          document.getElementById("harga").innerHTML ="Harga = " + item.harga;
          document.getElementById("stok").innerHTML ="Stok = " + item.stok;
          document.getElementById("jumlah").value = "1";
          document.getElementById("jumlah").max = item.stok;

          document.getElementById("image").src = "image/" + item.image;
        }
    </script>
 </head>
 <body>
   <nav class="navbar navbar-expand-md bg-dark navbar-dark fixed-top">
     <!-- navbar-expand-md -> menu akan dihidden ketika tampilan device berukuran medium
     bg-danger -> navbar akan mempunyai background warna merah
     navbar-dark -> tulisan manu pada navbar akan lebih gelap
     fixed-top -> navbar akan berposisi selalu diatas-->
     <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#menu">
     <span class="navbar navbar-toggler-icon"></span></button>
     <!-- daftar menu pada navbar -->
     <div class="collapse navbar-collapse" id="menu">
       <ul class="navbar-nav">
         <li class="navbar-item"><a href="bookstore_and_user.php" class="navbar-link" style="color:white">Home</a> </li><li>-</li>
         <li class="navbar-item"><a href="cart.php" class="navbar-link" style="color:white">Cart(<?php echo count($_SESSION["cart"]); ?>)</a></li><li>-</li>
         <li class="navbar-item"><a href="prologcus.php?logout=true" style="color:white">Logout
           <?php echo $_SESSION["username"]; ?>
         </a>
       </li>
       </ul>
     </div>
   </nav><br><br><br>
   <div class="container">
    <div class="card">
      <div class="card-header bg-dark">
        <h4 class="text-white">Keranjang Belanja Anda</h4>
      </div>
      <div class="card-body">
        <table class="table table-hovered table-hover">
          <thead>
            <tr>
              <th>No</th>
              <th>Judul</th>
              <th>Harga</th>
              <th>Jumlah</th>
              <th>Total Harga</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1; ?>
            <?php foreach ($_SESSION["cart"] as $cart): ?>
              <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $cart["judul"]; ?></td>
                <td><?php echo $cart["harga"]; ?></td>
                <td><?php echo $cart["jumlah"]; ?></td>
                <td>Rp <?php echo $total = $cart["jumlah"] * $cart["harga"]; ?></td>
                <td>
                  <a href="procart.php?hapus=trueand$kode_buku=<?php echo $cart["kode_buku"] ?>">
                    <button type="button" class="btn btn-sm btn-danger">Hapus</button>
                  </a>
                </td>
              </tr>
            <?php $no++; endforeach ?>
          </tbody>
          <tfoot>
            <a href="procart.php?checkout=true">
              <button type="button" class="btn btn-success">Checkout</button>
            </a>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
 </body>
 </html>
