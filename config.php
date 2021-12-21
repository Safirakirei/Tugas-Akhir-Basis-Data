<?php
$koneksi=mysqli_connect('host=localhost dbname=perpus user=postgres password=210902');
if( !$koneksi ){
    die("Gagal terhubung dengan database: " . mysqli_connect_error());
}
?>