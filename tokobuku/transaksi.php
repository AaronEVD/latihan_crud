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
          document.getElementById("stok").value ="Stok = " + item.stok;
          document.getElementById("jumlah").value = "1";
          document.getElementById("jumlah").max = item.stok;
          document.getElementById("image").src = "image/" + item.image;
        }
    </script>
 </head>
 <body>
   <div class="card">
     <div class="card-header">
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
       </nav>
     </div>
   </div>
   <br><br><br>
   <div class="container">
     <div class="card-header bg-dark">
       <h4 class="text-white" align="center">Riwayat Transaksi</h4>
     </div>
     <div class="card-body">
       <?php
       $sql = "select * from transaksi t inner join customer c
       on t.id_customer = c.id_customer where t.id_customer = '".$_SESSION["id_customer"]."' order by t.tgl desc";
       // echo $sql;
       $query = mysqli_query($connect, $sql);
        ?>
      <ul class="list-group">
        <?php foreach ($query as $transaksi): ?>
          <li class="list-group-item-mb-2">
          <h6>ID Transaksi: <?php echo $transaksi["id_transaksi"]; ?></h6>
          <h6>Nama Pembeli: <?php echo $transaksi["nama"]; ?></h6>
          <h6>Tgl. Transaksi: <?php echo $transaksi["tgl"]; ?></h6>
          <h6>List Barang: </h6>
          <?php
          $sql2 = "select * from detail_transaksi d inner join buku b on d.kode_buku = b.kode_buku
          where d.id_transaksi = '".$transaksi["id_transaksi"]."'";
          $query2 = mysqli_query($connect, $sql2);
           ?>
           <table class="table table-borderless">
             <thead>
              <tr>
                <th>Judul</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Total</th>
              </thead>
              </tr>
             <tbody>
               <?php $total = 0; foreach ($query2 as $detail): ?>
                 <tr>
                   <td><?php echo $detail["judul"]; ?></td>
                   <td><?php echo $detail["jumlah"]; ?></td>
                   <td><?php echo number_format($detail["harga"]); ?></td>
                   <td>Rp <?php echo number_format($detail["harga"]*$detail["jumlah"]); ?></td>
                 </tr>
               <?php $total += ($detail["harga"]*$detail["jumlah"]); endforeach; ?>
             </tbody>
           </table>
           <h6 class="text-danger">Rp <?php echo number_format($total);?></h6>
         </li>
        <?php endforeach; ?>
      </ul>
     </div>
   </div>
 </body>
 </html>
