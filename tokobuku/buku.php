<?php
    session_start();
    if (!isset($_SESSION["username"])) {
      header("location:login_admin.php");
    }
    // memanggil file config.php agar tidak perlu membuat koneksi baru
    include("configg.php");
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Data Buku</title>
     <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script type="text/javascript">
      Add = () => {
        document.getElementById('action').value = "insert";
        document.getElementById('kode_buku').value = " ";
        document.getElementById('judul').value = " ";
        document.getElementById('penulis').value = " ";
        document.getElementById('tahun').value = " ";
        document.getElementById('stok').value = " ";
        document.getElementById('harga').value = " ";
      }
      Edit = (item) => {
        document.getElementById('action').value = "update";
        document.getElementById('kode_buku').value = item.kode_buku;
        document.getElementById('judul').value = item.judul;
        document.getElementById('penulis').value = item.penulis;
        document.getElementById('tahun').value = item.tahun;
        document.getElementById('stok').value = item.stok;
        document.getElementById('harga').value = item.harga;
      }
    </script>
 </head>
 <body>
   <p align="right">
     <button type="button" class="btn-info"><a href="proslogad.php?logout=true" style="color:white">Logout
       <?php echo $_SESSION["username"]; ?>
     </a></button>

     <?php
        // membuat perintah sql untuk menampilkan data siswa
        if (isset($_POST["cari"])) {
          $cari =$_POST["cari"];
          $sql = "select * from buku where kode_buku like '%$cari%' or judul like '%$cari%' or penulis like
          '%$cari%' or stok like '%$cari%' or harga like '%$cari%' or penulis like '%$cari%' or tahun like '%$cari%'";
        }else {
          $sql = "select * from buku";
        }

         // eksekusi perintah SQL
         $query = mysqli_query($connect, $sql);
      ?>

      <div class="container">
          <!-- start card -->
          <div class="card">
              <div class="card-header bg-dark text-white">
                  <h3>Data Buku</h3>
                  <h6 align="right"><a href="buku.php">tabel buku</a> <a href="customer.php">tabel customer</a> <a href="admin.php">tabel admin</a></h6>
              </div>
        <div class="card-body">
          <form action="buku.php" method="post">
            <input type="text" name="cari" class="form-control" placeholder="Pencarian">
          </form>
        <table class="table" border="1">
        <thead>
            <tr>
                <th>Kode Buku</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Tahun</th>
                <th>Stok</th>
                <th>Harga</th>
                <th>Foto</th>
                <th>Option</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($query as $buku): ?>
                <tr>
                    <td><?php echo $buku['kode_buku'];?></td>
                    <td><?php echo $buku['judul'];?></td>
                    <td><?php echo $buku['penulis'];?></td>
                    <td><?php echo $buku['tahun'];?></td>
                    <td><?php echo $buku['stok'];?></td>
                    <td><?php echo $buku['harga'];?></td>
                    <td><img src="<?php echo 'image/'.$buku["image"]; ?>" alt="Foto Buku" width="150"/> </td>
                    <td>
                        <button type="button" data-toggle="modal" data-target="#modal_buku" class="btn btn-sm btn-info" onclick='Edit(<?php echo json_encode($buku); ?>)'>
                            Edit
                        </button>
                        <a href="tugasage_buku.php?hapus=true&kode_buku=<?php echo $buku["kode_buku"];?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
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
                        <form action="tugasage_buku.php" method="post" enctype="multipart/form-data">
                            <div class="modal-header bg-info text-white">
                                <h4>Form Buku</h4>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="action" id="action">
                                Kode Buku
                                <input type="number" name="kode_buku" id="kode_buku" class="form-control">
                                Judul
                                <input type="text" name="judul" id="judul" class="form-control" required />
                                Penulis
                                <input type="text" name="penulis" id="penulis" class="form-control" required />
                                Tahun
                                <input type="number" name="tahun" id="tahun" class="form-control"> required /
                                Stok
                                <input type="number" name="stok" id="stok" class="form-control" required />
                                Harga
                                <input type="number" name="harga" id="harga" class="form-control" required />
                                Foto
                                <input type="file" name="image" id="image" class="form-control" >
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" name="save_buku">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
          <!-- end form modal -->
      </div>
 </body>
 </html>
