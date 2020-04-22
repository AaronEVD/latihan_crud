<?php
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

          document.getElementById("image").src = "image/" + item.image;
        }
    </script>
 </head>
 <body>
     <?php
        // membuat perintah sql untuk menampilkan data siswa
        if (isset($_POST["cari"])) {
          $cari =$_POST["cari"];
          $sql = "select * from buku where judul like '%$cari%' or penulis like '%$cari%'";
        }else {
          $sql = "select * from buku";
        }
         // eksekusi perintah SQL
         $query = mysqli_query($connect, $sql);
      ?>
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
          <li class="nav-item"><a href="bookstore.php" class="nav-link">Home</a></li>
          <li class="nav-item"><a href="login_customer.php" class="nav-link">Login</a></li>
          </li>
          </ul>
        </div><br><br><br>
      </nav>
      <div class="container">
        <form action="bookstore.php" method="post">
          <input type="text" name="cari" class="form-control" placeholder="Pencarian">
        </form><br><br>
      <div class="row">
        <?php foreach ($query as $buku):  ?>
          <div class="card col-md-2 mb-2" align="center" style="margin-left:15px;">
            <img src="<?php echo 'image/'.$buku['image']?>" class="card-img-top" height="200"/>
            <div class="card-header bg-dark text-white">
              <?php echo $buku['judul']?>
            </div>
            <div class="card-body" align="center">
              <?php echo 'Rp '.$buku['harga'].' rupiah';?><br>
              <?php echo 'Penulis: '.$buku['penulis']; ?>
            </div>
            <div class="card-footer">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_detail" onclick='Detail(<?php echo json_encode($buku); ?>)'><Details open></Details> </button>
            </div>
          </div>
        <?php endforeach; ?>
        <!-- form modal -->
          <div class="modal" id="modal_detail">
              <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header bg-info text-white">
                      <h4>Detail Buku</h4>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-6">
                          <img src="" width="200" height=""="auto" id="image">
                        </div>
                        <div class="col-6">
                          <h5 id="judul"></h5>
                          <h5 id="penulis"></h5>
                          <h5 id="harga"></h5>
                          <h5 id="stok"></h5>
                          <form class="" action="proses_cart.php" method="post">
                            <input type="hidden" name="kode_buku" id="kode_buku"><br>
                            Anda harus login terlebih dahulu <br>
                            <button type="button" class="btn btn-dark"><a href="login_customer.php">Login</a> </button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
          </div>
        <!-- end form modal -->
      </div>
    </div>
 </body>
 </html>
