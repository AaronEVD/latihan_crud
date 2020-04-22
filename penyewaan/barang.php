<?php
    session_start();
    if (!isset($_SESSION["id_admin"])) {
      header("location:login_admin.php");
    }
    // memanggil file config.php agar tidak perlu membuat koneksi baru
    include("config.php");
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Data Barang</title>
     <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script type="text/javascript">
      Add = () => {
        document.getElementById('action').value = "insert";
        document.getElementById('kode_barang').value = " ";
        document.getElementById('nama').value = " ";
        document.getElementById('harga').value = " ";
        document.getElementById('stok').value = " ";

      }
      Edit = (item) => {
        document.getElementById('action').value = "update";
        document.getElementById('kode_barang').value = item.kode_barang;
        document.getElementById('nama').value = item.nama;
        document.getElementById('harga').value = item.harga;
        document.getElementById('stok').value = item.stok;
      }
    </script>
 </head>
 <body>
   <nav class="navbar navbar-expand-lg bg-dark navbar-dark fixed-top" height="10px">
     <!-- navbar-expand-md -> menu akan dihidden ketika tampilan device berukuran medium
     bg-danger -> navbar akan mempunyai background warna merah
     navbar-dark -> tulisan manu pada navbar akan lebih gelap
     fixed-top -> navbar akan berposisi selalu diatas-->
     <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#menu">
     <span class="navbar navbar-toggler-icon"></span></button>
     <!-- daftar menu pada navbar -->
     <div class="collapse navbar-collapse" id="menu">
       <ul class="navbar-nav">
       <li class="nav-item"><a href="admin.php" class="nav-link">TabelAdmin</a></li>
       <li class="nav-item"><a href="customer.php" class="nav-link">TabelCustomer</a></li>
       <li class="nav-item"><a href="barang.php" class="nav-link">TabelBarang</a></li>
       <li class="nav-item"><a href="prolo_ad.php?logout=true" class="nav-link">Logout[<?php echo $_SESSION["username"]; ?>]
       </a></li>
       <form class="form-inline-dark my-2 my-lg-0" method="post" action="barang.php" width:"500px" margin:"12px" style="margin-left:370px">
           <input type="search" class="from-control mr-sm-2" name="cari" placeholder="Search">
           <button type="submit" class="btn btn-outline-light" position:"relative" left:"-8px" border:"2px solid white" color:#353a40>Submit</button>
       </form>
       </ul>
     </div>
   </nav><br><br><br>
     <?php
        // membuat perintah sql untuk menampilkan data siswa
        if (isset($_POST["cari"])) {
          $cari =$_POST["cari"];
          $sql = "select * from barang where kode_barang like '%$cari%' or nama like '%$cari%' or stok like '%$cari%' or harga like '%$cari%'";
        }else {
          $sql = "select * from barang";
        }

         // eksekusi perintah SQL
         $query = mysqli_query($connect, $sql);
      ?>

      <div class="container">
          <!-- start card -->
          <div class="card">
              <div class="card-header bg-dark text-white">
                  <h2 align="center">Data Barang </h2>
              </div>
        <div class="card-body">
        <table class="table" border="1">
        <thead>
            <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Harga Sewa</th>
                <th>Stok</th>
                <th>Foto</th>
                <th>Option</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($query as $barang): ?>
                <tr>
                    <td><?php echo $barang['kode_barang'];?></td>
                    <td><?php echo $barang['nama'];?></td>
                    <td><?php echo $barang['harga'];?></td>
                    <td><?php echo $barang['stok'];?></td>
                    <td><img src="<?php echo 'image/'.$barang["image"]; ?>" alt="Foto Barang" width="150"/> </td>
                    <td>
                        <button type="button" data-toggle="modal" data-target="#modal_buku" class="btn btn-sm btn-warning text-white" onclick='Edit(<?php echo json_encode($barang); ?>)'>
                            Edit
                        </button>
                        <a href="barang_proses.php?hapus=true&kode_barang=<?php echo $barang["kode_barang"];?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                          <button type="button" class="btn btn-sm btn-danger">Hapus</button>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
      </table>
      <button type="button" action data-toggle="modal" data-target="#modal_buku" class="btn btn-sm btn-success" style="margin-left: 10px;" onclick="Add()">Tambah Data</button>
              </div>
          </div>
          <!-- end card -->

          <!-- form modal -->
            <div class="modal fade" id="modal_buku">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="barang_proses.php" method="post" enctype="multipart/form-data">
                            <div class="modal-header bg-dark text-white">
                                <h4>Form Barang</h4>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="action" id="action">
                                Kode Barang
                                <input type="number" name="kode_barang" id="kode_barang" class="form-control">
                                Nama Barang
                                <input type="text" name="nama" id="nama" class="form-control" required />
                                Harga
                                <input type="number" name="harga" id="harga" class="form-control" required />
                                Stok
                                <input type="number" name="stok" id="stok" class="form-control" required />
                                Foto
                                <input type="file" name="image" id="image" class="form-control" >
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-dark" name="save_buku">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
          <!-- end form modal -->
      </div>
 </body>
 </html>
