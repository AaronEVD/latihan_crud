<?php
    session_start();
      if (!isset($_SESSION["id_admin"])) {
        header("location:login_admin.php");
      }
    // memanggil file config.php agar tidak perlu membuat koneksi baru
    include("config.php");
 ?><!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Data Admin</title>
     <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script type="text/javascript">
      Add = () => {
        document.getElementById('action').value = "insert";
        document.getElementById('id_admin').value = " ";
        document.getElementById('nama').value = " ";
        document.getElementById('kontak').value = " ";
        document.getElementById('username').value = " ";
        document.getElementById('password').value = " ";
      }
      Edit = (item) => {
        document.getElementById('action').value = "update";
        document.getElementById('id_admin').value = item.id_admin;
        document.getElementById('nama').value = item.nama;
        document.getElementById('kontak').value = item.kontak;
        document.getElementById('username').value = item.username;
        document.getElementById('password').value = item.password;
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
       <form class="form-inline-dark my-2 my-lg-0" method="post" action="admin.php" width:"500px" margin:"12px" style="margin-left:400px">
           <input type="text" class="from-control mr-sm-2" name="cari" placeholder="Search">
           <button type="submit" class="btn btn-outline-light" position:"relative" left:"-8px" border:"2px solid white" color:#353a40>Submit</button>
       </form>
       </ul>
     </div>
   </nav><br><br><br>
   <?php
      // membuat perintah sql untuk menampilkan data siswa
      if (isset($_POST["cari"])) {
        $cari =$_POST["cari"];
        $sql = "select * from admin where id_admin like '%$cari%' or nama like '%$cari%' or username like '%$cari%'";
      }else {
        $sql = "select * from admin";
      }

       // eksekusi perintah SQL
       $query = mysqli_query($connect, $sql);
    ?>

      <div class="container">
          <!-- start card -->
          <div class="card">
              <div class="card-header bg-dark text-white">
                  <h2 align="center">Data Admin </h2>
                  </div>
        <div class="card-body">
        <table class="table" border="1">
        <thead>
            <tr>
                <th>ID Admin</th>
                <th>Nama</th>
                <th>Kontak</th>
                <th>Username</th>
                <th>Password</th>
                <th>Option</th>
            </tr>
        </thead>
          <tbody>
            <?php foreach ($query as $admin): ?>
                <tr>
                    <td><?php echo $admin['id_admin'];?></td>
                    <td><?php echo $admin['nama'];?></td>
                    <td><?php echo $admin['kontak'];?></td>
                    <td><?php echo $admin['username'];?></td>
                    <td><?php echo $admin['password'];?></td>
                    <td>
                        <button type="button" data-toggle="modal" data-target="#modal_admin" class="btn btn-sm btn-warning text-white" onclick='Edit(<?php echo json_encode($admin); ?>)'>
                            Edit
                        </button>
                        <a href="admin_proses.php?hapus=true&id_admin=<?php echo $admin["id_admin"];?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                          <button type="button" class="btn btn-sm btn-danger">Hapus</button>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
      </table>
      <button type="button" action data-toggle="modal" data-target="#modal_admin" class="btn btn-sm btn-success" style="margin-left: 10px;" onclick='Add()'>Tambah Data</button>
              </div>
          </div>
          <!-- end card -->

          <!-- form modal -->
            <div class="modal fade" id="modal_admin">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="admin_proses.php" method="post" enctype="multipart/form-data">
                            <div class="modal-header bg-dark text-white">
                                <h4>Form Customer</h4>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="action" id="action">
                                ID Admin
                                <input type="number" name="id_admin" id="id_admin" class="form-control" required />
                                Nama
                                <input type="text" name="nama" id="nama" class="form-control" required />
                                Kontak
                                <input type="number" name="kontak" id="kontak" class="form-control" required />
                                Username
                                <input type="text" name="username" id="username" class="form-control" required />
                                Password
                                <input type="text" name="password" id="password" class="form-control" required />
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-dark" name="save_admin">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
          <!-- end form modal -->
      </div>
 </body>
 </html>
