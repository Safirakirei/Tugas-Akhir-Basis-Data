<?php
require('config.php');
?>

<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>E-Library</title>
      <link rel="stylesheet" href="desain.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
   </head>
   <body>
      <style>
         body {
         background: url("/perpustakaan2_baru/image/89-891545_wallpaper-books-shelf-library-reading-books-hd-wallpapers.jpg");
         background-size: cover;
         }
      </style>
      <div class="wrapper">
         <input type="checkbox" id="btn" hidden>
         <label for="btn" class="menu-btn">
         <i class="fas fa-bars"></i>
         <i class="fas fa-times"></i>
         </label>
         <nav id="sidebar">
            <div class="title">
               Database Perpustakaan
            </div>
            <ul class="list-items">
               <li><a href="menu.php"><i class="fas fa-home"></i>Beranda</a></li>
               <li><a href="peminjaman.php"><i class="fas fa-list"></i>Peminjaman</a></li>
               <li><a href="buku.php"><i class="fas fa-book"></i>Buku</a></li>
               <li><a href="rak.php"><i class="fas fa-bookmark"></i>Rak</a></li>
               <li><a href="anggota.php"><i class="fas fa-user"></i>Anggota</a></li>
               <li><a href="petugas.php"><i class="fas fa-user-edit"></i>Petugas</a></li>
               <li><a href="index.php"><i class="fas fa-door-open"></i>Sign Out</a></li>
            </ul>
         </nav>
      </div>
      <!--div
      peminjaman
      Buku
      rak
      anggota
      Petugas-->
      <div class="content">
         <div class="header">
            Halo, Selamat Datang di Database Kami
         </div>
         <p>
            ini adalah tampilan beranda kamu!
         </p>
      </div>
   </body>
</html>