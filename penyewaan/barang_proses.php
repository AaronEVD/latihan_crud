<?php
    // load file config.php
    include("config.php");
    if (isset($_POST["save_buku"])) {
        //isset digunakan untuk mengecek apakah ketika mengakses
        //file ini, dikirimkan data dengan nama "save_siswa" dg method POST
     // menampung data yang dikirmkan
    $action = $_POST["action"];
    $kode_barang = $_POST["kode_barang"];
    $nama = $_POST["nama"];
    $harga = $_POST["harga"];
    $stok = $_POST["stok"];

    // menampung file image
    if (!empty($_FILES["image"])) {
        // empty digunakan untuk mengecek apakah sebuah variabel itu menyimpan
        // sebuah nilai atau tidak
        /*
            contoh :
            $angka
            echo empty($angka); --> hasilnya true, karena $angka tidak punya nilai atau
            variabel tersebut kosong
            $angka = 10;
            echo empty(angka) --> hasilnya fals, karena $angka punya nilai atau variabel tsb
            tidak kosong dan ada isinya

            perbedaan empty dengan isset :
            - isset untuk mengecek keberadaan sebuah variabel
            - empty untuk mengecek keberadaan nilai dari sebuah variabel
        */
        // mendapatkan deskripsi info gambar
        $path = pathinfo($_FILES["image"]["name"]);
        // mengambil ekstensi dari gambar
        $extension = $path["extension"];
        file_get_contents();
        // rangkai file name
        $filename = $kode_barang."-".rand(1,1000).".".$extension;
        // generate nama file
    }

    // cek aksi-nya
    if ($action == "insert") {
        // sintax untuk insert

        $sql = "insert into barang values ('$kode_barang','$nama','$harga','$stok','$filename')";

        // proses upload file
        move_uploaded_file($_FILES["image"]["tmp_name"],"image/$filename");

        //eksekusi perintah sql
        mysqli_query($connect, $sql);
    }elseif ($action == "update") {
        if (!empty($_FILES["image"]["name"])) {
            // mendapatkan deskripsi info gambar
            $path = pathinfo($_FILES["image"]["name"]);
            // mengambil ekstensi dari gambar
            $extension = $path["extension"];

            // rangkai file name
            $filename = $nama."-".rand(1,1000).".".$extension;
            // generate nama file

            // ambil data yang akan di edit
            $sql = "select * from barang where kode_barang='$kode_barang'";
            $query = mysqli_query($connect, $sql);
            $hasil = mysqli_fetch_array($query);

            if (file_exists("image/".$hasil["image"])) {
                // menghapus gambar yang terdahulu
                unlink("image/".$hasil["image"]);
            }

            // upload gambar
            move_uploaded_file($_FILES["image"]["tmp_name"],"image/$filename");

            // sintax untuk update
            $sql = "update barang set kode_barang='$kode_barang',nama='$nama',harga='$harga',stok='$stok', image='$filename' where kode_barang='$kode_barang'";
        }else {
            // sintax untuk update
            $sql = "update barang set kode_barang='$kode_barang',nama='$nama',harga='$harga',stok='$stok' where kode_barang='$kode_barang'";
        }

        // eksekusi perintah sql
        mysqli_query($connect, $sql);
    }

    // redirect ke halaman siswa.php
    header("location:barang.php");
    }
    if (isset($_GET["hapus"])) {
        $kode_barang = $_GET["kode_barang"];
        // $sql = "delete from siswa where nisn='$nisn'";
        $sql = "select * from barang where kode_barang='$kode_barang'";
        $query = mysqli_query($connect, $sql);
        $hasil = mysqli_fetch_array($query);
        $sql = "delete from barang where kode_barang='$kode_barang'";
        if (file_exists("image/".$hasil["image"])) {
            unlink("image/".$hasil["image"]);
        }
        mysqli_query($connect, $sql);

        //direct ke halaman data siswa
        header("location:barang.php");
    }
 ?>
