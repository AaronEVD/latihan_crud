<?php
    //koneksi ke database
    $host = "localhost";  // local server
    $username = "root";
    $password = "";
    $db = "rental";
    $connect = mysqli_connect($host, $username, $password, $db);

    if (mysqli_connect_errno()) {
        echo mysqli_connect_error();
    }else {
        echo " ";
    }
 ?>
