<?php
include("config.php");
//jika tombol simpan diklik
if(isset($_POST['bsimpan'])){
    //pengujian apakah data akan diedit atau disimpan baru
    if($_GET['hal']=="edit"){
        //data akan diedit
        $edit = mysqli_query($koneksi,"UPDATE peminjaman set
                                      id_anggota = '$_POST[tidanggota]',
                                      id_petugas = '$_POST[tpetugas]',
                                      tanggal_peminjaman = '$_POST[ttanggal_peminjaman]',
                                      tanggal_pengembalian = '$_POST[ttanggal_pengembalian]',
                                      isbn = '$_POST[tisbn]',
                                      status = '$_POST[tstatus]'
                                      WHERE kode_peminjaman = '$_GET[id]'
                                      ");
        if($edit){
            //jika edit sukses
        echo "<script>
        alert('edit data SUKSES!');
        document.location = 'peminjaman.php'
        </script>";
        }
        else{
        echo "<script>
        alert('edit data GAGAL!');
        document.location = 'peminjaman.php'
        </script>";
        }  

    }
    else{
        //data akan disimpn baru
        $simpan = mysqli_query($koneksi,"INSERT INTO peminjaman (id_anggota, id_petugas,tanggal_peminjaman,tanggal_pengembalian,isbn,status)
        VALUES ('$_POST[tidanggota]',
               '$_POST[tpetugas]',
               '$_POST[ttanggal_peminjaman]',
               '$_POST[ttanggal_pengembalian]',
               '$_POST[tisbn]',
               '$_POST[tstatus]')
            ");
        if($simpan){
        echo "<script>
        alert('simpan data SUKSES!');
        document.location = 'peminjaman.php'
        </script>";
        }
        else{
        echo "<script>
        alert('simpan data GAGAL. Pastikan semua form terisi!');
        document.location = 'peminjaman.php'
        </script>";
        }  
    }                 
}
//pengujian jika tombol edit atau hapus diklik
if(isset($_GET['hal'])){
    //pengujian jika mengedit data
    if($_GET['hal']=="edit"){
        //tampilkan data yang akan diedit
        $tampil = mysqli_query($koneksi,"SELECT * FROM peminjaman WHERE kode_peminjaman='$_GET[id]'");
        $data = mysqli_fetch_array($tampil);
        if($data){
            //jika data ditemukan maka data ditampung ke variabel
            $vidanggota =  $data['id_anggota'];
            $vpetugas = $data['id_petugas'];
            $vtglpeminjaman = $data['tanggal_peminjaman'];
            $vtglpengembalian =  $data['tanggal_pengembalian'];
            $visbn = $data['isbn'];
            $vstatus = $data['status'];
        }
    }
    else if($_GET['hal']=="hapus"){
        //persiapan hapus data
        $hapus = mysqli_query($koneksi,"DELETE FROM peminjaman WHERE kode_peminjaman='$_GET[id]' ");
        if($hapus){
            echo "<script>
        alert('Hapus data SUKSES!');
        document.location = 'peminjaman.php'
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
        <title> Perpustakaan</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
        <center><img src="http://disarpus.sanggau.go.id/wp-content/uploads/2017/06/budaya-baca.jpg" alt="centered image" height="240" width="360"> </center>
        <link rel="stylesheet" href="desain.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>

    </head>
    <body>
        <div class="container">
        <h1 class="text-center mt-4">Formulir Peminjaman Buku</h1>
    <!-- awal card form -->
    <div class="card mt-3">
    <div class="card-header bg-primary text-white">
        Form Data Peminjaman
    </div>
    <div class="card-body">
    <form action="" method="post">
        <!-- form id peminjam-->
        <div class="form-group">
            <input type="hidden" name="tpeminjaman" value="<?=@$vpeminjaman?>" class="form-control">
        </div>
        <!-- form id anggota -->
        <div class="form-group">
            <label>ID Anggota</label>
            <input type="text" name="tidanggota" value="<?=@$vidanggota?>" class="form-control" placeholder="input ID anggota disini!" required>
        </div>
        <!-- form id petugas -->
        <div class="form-group">
            <label>ID Petugas</label>
            <input type="text" name="tpetugas" value="<?=@$vpetugas?>" class="form-control" placeholder="input ID petugas disini!" required>
        </div>
        <!-- form tanggal peminjaman -->
        <div class="form-group">
            <label>Tanggal Peminjaman</label>
			<input type="date" name="ttanggal_peminjaman"  value="<?=@$vtglpeminjaman?>" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Tanggal Pengembalian</label>
			<input type="date" name="ttanggal_pengembalian" value="<?=@$vtglpengembalian?>" class="form-control" required>
        </div>
        <div>
            <label>ISBN</label>
			<input type="text" name="tisbn" placeholder="ISBN Buku" value="<?=@$visbn?>" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Status Pengembalian</label>
            <select name="tstatus" class="form-control">
            <option value="<?=@$vstatus?>"><?=@$vstatus?></option>
            <option value="sudah">sudah</option>
            <option value="belum">belum</option>
            </select>
        </div>


        <button type="submit" class="btn btn-success mt-3" name="bsimpan">SIMPAN</button>
        <button type="reset" class="btn btn-danger mt-3" name="breset">RESET</button>
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
                <th>kode_peminjaman</th>
                <th>id_anggota</th>
                <th>id_petugas</th>
                <th>tanggal peminjaman</th>
                <th>tanggal pengembalian</th>
                <th>isbn</th>
                <th>status</th>
                <th>Aksi</th>
            </tr>
            <?php
            $no = 1;
            $tampil = mysqli_query($koneksi, 'SELECT * from peminjaman order by kode_peminjaman desc');
            while($data = mysqli_fetch_array($tampil)):
                ?>
                <tr>
                    <td><?=$data['kode_peminjaman']?></td>
                    <td><?=$data['id_anggota']?></td>
                    <td><?=$data['id_petugas']?></td>
                    <td><?=$data['tanggal_peminjaman']?></td>
                    <td><?=$data['tanggal_pengembalian']?></td>
                    <td><?=$data['isbn']?></td>
                    <td><?=$data['status']?></td>
                    <td>
                        <a href="peminjaman.php?hal=edit&id=<?=$data['kode_peminjaman']?>" class="btn btn-warning">EDIT</a>
                        <a href="peminjaman.php?hal=hapus&id=<?=$data['kode_peminjaman']?>" onclick="return confirm('apakah yakin ingin menghapus data ini?')" class="btn btn-danger">HAPUS</a>
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