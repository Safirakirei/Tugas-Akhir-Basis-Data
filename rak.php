<?php
include("config.php");

//UNTUK TABEL RAK
//jika tombol simpan diklik
if(isset($_POST['csimpan'])){
    //pengujian apakah data akan diedit atau disimpan baru
    if($_GET['hal']=="edit"){
        //data akan diedit
        $edit = mysqli_query($koneksi,"UPDATE rak set
                                      kode_rak = '$_POST[tkoderak]',
                                      lokasi = '$_POST[tlokasirak]'
                                      WHERE kode_rak = '$_GET[id]'
                                      ");
        if($edit){
            //jika edit sukses
        echo "<script>
        alert('edit data SUKSES!');
        document.location = 'rak.php'
        </script>";
        }
        else{
        echo "<script>
        alert('edit data GAGAL!');
        document.location = 'rak.php'
        </script>";
        }  

    }
    else{
        //data akan disimpn baru
        $simpan = mysqli_query($koneksi,"INSERT INTO rak (kode_rak, lokasi)
        VALUES ('$_POST[tkoderak]',
               '$_POST[tlokasirak]')
            ");
        if($simpan){
        echo "<script>
        alert('simpan data SUKSES!');
        document.location = 'rak.php'
        </script>";
        }
        else{
        echo "<script>
        alert('simpan data GAGAL. Pastikan semua form terisi!');
        document.location = 'rak.php'
        </script>";
        }  
    }                 
}
//pengujian jika tombol edit atau hapus diklik
if(isset($_GET['hal'])){
    //pengujian jika mengedit data
    if($_GET['hal']=="edit"){
        //tampilkan data yang akan diedit
        $tampil = mysqli_query($koneksi,"SELECT * FROM rak WHERE kode_rak='$_GET[id]'");
        $data = mysqli_fetch_array($tampil);
        if($data){
            //jika data ditemukan maka data ditampung ke variabel
            $vkoderak = $data['kode_rak'];
            $vlokasirak =  $data['lokasi'];
        }
    }
    else if($_GET['hal']=="hapus"){
        //persiapan hapus data
        $hapus = mysqli_query($koneksi,"DELETE FROM rak WHERE kode_rak='$_GET[id]' ");
        if($hapus){
            echo "<script>
        alert('Hapus data SUKSES!');
        document.location = 'rak.php'
        </script>";
        }
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <!-- sidebar -->
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
      <!-- akhir sidebar -->
        <title> RAK</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
        <center><img src="http://disarpus.sanggau.go.id/wp-content/uploads/2017/06/budaya-baca.jpg" alt="centered image" height="240" width="360"> </center>
        <link rel="stylesheet" href="desain.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
        

    </head>
    <body>
    <!-- rak -->
    <div class="container">
        <h1 class="text-center mt-4">Tabel Rak</h1>
    <!-- awal card form -->
    <div class="card mt-3">
    <div class="card-header bg-primary text-white">
        DATA RAK
    </div>
    <div class="card-body">
    <form action="" method="post">
        <!-- form kode rak-->
        <div class="form-group">
            <label>Kode Rak</label>
            <input type="text" name="tkoderak" value="<?=@$vkoderak?>" class="form-control" placeholder="input kode rak disini!" required>
        </div>
        <!-- form lokasi rak -->
        <div class="form-group">
            <label>Lokasi rak</label>
            <input type="text" name="tlokasirak" value="<?=@$vlokasirak?>" class="form-control" placeholder="input lokasi rak disini!" required>
        </div>
        
        <button type="submit" class="btn btn-success mt-3" name="csimpan">SIMPAN</button>
        <button type="reset" class="btn btn-danger mt-3" name="creset">RESET</button>
    </form>
    </div>
    </div>
    <!-- akhir card form-->

     <!-- awal card table -->
    <div class="card mt-3">
    <div class="card-header bg-success text-white">
        Data Peminjaman
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tr>
                <th>kode rak</th>
                <th>lokasi rak</th>
                <th>Aksi</th>
            </tr>
            <?php
            $no = 1;
            $tampil = mysqli_query($koneksi,'SELECT * from rak order by kode_rak desc');
            while($data = mysqli_fetch_array($tampil)):
                ?>
                <tr>
                    <td><?=$data['kode_rak']?></td>
                    <td><?=$data['lokasi']?></td>
                    <td>
                        <a href="rak.php?hal=edit&id=<?=$data['kode_rak']?>" class="btn btn-warning">EDIT</a>
                        <a href="rak.php?hal=hapus&id=<?=$data['kode_rak']?>" onclick="return confirm('apakah yakin ingin menghapus data ini?')" class="btn btn-danger">HAPUS</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
    </div>
    <!-- akhir card table-->

    </div>   

    <script type="text/javsript" src="js/bootstrap.min.js"></script>
    </body>
</html>