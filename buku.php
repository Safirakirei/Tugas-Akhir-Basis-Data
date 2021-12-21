<?php
include("config.php");
//jika tombol simpan diklik
if(isset($_POST['dsimpan'])){
    //pengujian apakah data akan diedit atau disimpan baru
    if($_GET['hal']=="edit"){
        //data akan diedit
        $edit = mysqli_query($koneksi,"UPDATE buku set
                                      isbn = '$_POST[tisbn]',
                                      judul = '$_POST[tjudul]',
                                      pengarang = '$_POST[tpengarang]',
                                      penerbit = '$_POST[tpenerbit]',
                                      stok = '$_POST[tstok]',
                                      kode_rak = '$_POST[tkoderak]'
                                      WHERE isbn = '$_GET[id]'
                                      ");
        if($edit){
            //jika edit sukses
        echo "<script>
        alert('edit data SUKSES!');
        document.location = 'buku.php'
        </script>";
        }
        else{
        echo "<script>
        alert('edit data GAGAL!');
        document.location = 'buku.php'
        </script>";
        }  

    }
    else{
        //data akan disimpn baru
        $simpan = mysqli_query($koneksi,"INSERT INTO buku (isbn, judul, pengarang, penerbit, stok, kode_rak)
        VALUES ('$_POST[tisbn]',
               '$_POST[tjudul]',
               '$_POST[tpengarang]',
               '$_POST[tpenerbit]',
               '$_POST[tstok]',
               '$_POST[tkoderak]')
            ");
        if($simpan){
        echo "<script>
        alert('simpan data SUKSES!');
        document.location = 'buku.php'
        </script>";
        }
        else{
        echo "<script>
        alert('simpan data GAGAL. Pastikan semua form terisi!');
        document.location = 'buku.php'
        </script>";
        }  
    }                 
}
//pengujian jika tombol edit atau hapus diklik
if(isset($_GET['hal'])){
    //pengujian jika mengedit data
    if($_GET['hal']=="edit"){
        //tampilkan data yang akan diedit
        $tampil = mysqli_query($koneksi,"SELECT * FROM buku WHERE isbn='$_GET[id]'");
        $data = mysqli_fetch_array($tampil);
        if($data){
            //jika data ditemukan maka data ditampung ke variabel
            $visbn = $data['isbn'];
            $vjudul =  $data['judul'];
            $vpengarang = $data['pengarang'];
            $vpenerbit = $data['penerbit'];
            $vstok =  $data['stok'];
            $vkoderak = $data['kode_rak'];
        }
    }
    else if($_GET['hal']=="hapus"){
        //persiapan hapus data
        $hapus = mysqli_query($koneksi,"DELETE FROM buku WHERE isbn='$_GET[id]' ");
        if($hapus){
            echo "<script>
        alert('Hapus data SUKSES!');
        document.location = 'buku.php'
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
        <title> BUKU</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
        <center><img src="http://disarpus.sanggau.go.id/wp-content/uploads/2017/06/budaya-baca.jpg" alt="centered image" height="240" width="360"> </center>
        <link rel="stylesheet" href="desain.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>

    </head>
    <body>
        <div class="container">
        <h1 class="text-center mt-4">FORM BUKU</h1>
    <!-- awal card form -->
    <div class="card mt-3">
    <div class="card-header bg-primary text-white">
        isi data buku
    </div>
    <div class="card-body">
    <form action="" method="post">
        <!-- form id peminjam-->
        <div class="form-group">
            <label>ISBN</label>
            <input type="text" name="tisbn" value="<?=@$visbn?>" class="form-control" placeholder="input isbn disini!" required>
        </div>
        <!-- form id anggota -->
        <div class="form-group">
            <label>Judul Buku</label>
            <input type="text" name="tjudul" value="<?=@$vjudul?>" class="form-control" placeholder="input judul buku disini!" required>
        </div>
        <!-- form id petugas -->
        <div class="form-group">
            <label>Pengarang</label>
            <input type="text" name="tpengarang" value="<?=@$vpengarang?>" class="form-control" placeholder="input pengarang disini!" required>
        </div>
        <!-- form tanggal peminjaman -->
        <div class="form-group">
            <label>Penerbit</label>
			<input type="text" name="tpenerbit"  value="<?=@$vpenerbit?>" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Stok</label>
			<input type="number" name="tstok" value="<?=@$vstok?>" placeholder="input stok buku" class="form-control" required>
        </div>
        <div>
            <label>kode rak</label>
			<input type="text" name="tkoderak" placeholder="input kode rak" value="<?=@$vkoderak?>" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success mt-3" name="dsimpan">SIMPAN</button>
        <button type="reset" class="btn btn-danger mt-3" name="dreset">RESET</button>
    </form>
    </div>
    </div>
    <!-- akhir card form-->

     <!-- awal card table -->
    <div class="card mt-3">
    <div class="card-header bg-success text-white">
        Tabel Buku
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tr>
                <th>ISBN</th>
                <th>Judul Buku</th>
                <th>Pengarang</th>
                <th>Penerbit</th>
                <th>Stok</th>
                <th>Kode rak</th>
                <th>Aksi</th>
            </tr>
            <?php
            $no = 1;
            $tampil = mysqli_query($koneksi, 'SELECT * from buku order by isbn desc');
            while($data = mysqli_fetch_array($tampil)):
                ?>
                <tr>
                    <td><?=$data['isbn']?></td>
                    <td><?=$data['judul']?></td>
                    <td><?=$data['pengarang']?></td>
                    <td><?=$data['penerbit']?></td>
                    <td><?=$data['stok']?></td>
                    <td><?=$data['kode_rak']?></td>
                    <td>
                        <a href="buku.php?hal=edit&id=<?=$data['isbn']?>" class="btn btn-warning">EDIT</a>
                        <a href="buku.php?hal=hapus&id=<?=$data['isbn']?>" onclick="return confirm('apakah yakin ingin menghapus data ini?')" class="btn btn-danger">HAPUS</a>
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