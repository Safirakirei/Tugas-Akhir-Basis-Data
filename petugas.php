<?php
include("config.php");
//jika tombol simpan diklik
if(isset($_POST['fsimpan'])){
    //pengujian apakah data akan diedit atau disimpan baru
    if($_GET['hal']=="edit"){
        //data akan diedit
        $edit = mysqli_query($koneksi,"UPDATE petugas set
                                      id_petugas = '$_POST[tidpetugas]',
                                      nama = '$_POST[tnamapetugas]',
                                      no_telp = '$_POST[tnotelppetugas]',
                                      status = '$_POST[tstatuspetugas]',
                                      password = '$_POST[tpasswordpetugas]'
                                      WHERE id_petugas = '$_GET[id]'
                                      ");
        if($edit){
            //jika edit sukses
        echo "<script>
        alert('edit data SUKSES!');
        document.location = 'petugas.php'
        </script>";
        }
        else{
        echo "<script>
        alert('edit data GAGAL!');
        document.location = 'petugas.php'
        </script>";
        }  

    }
    else{
        //data akan disimpn baru
        $simpan = mysqli_query($koneksi,"INSERT INTO petugas (id_petugas, nama, no_telp, status, password)
        VALUES ('$_POST[tidpetugas]',
               '$_POST[tnamapetugas]',
               '$_POST[tnotelppetugas]',
               '$_POST[tstatuspetugas]',
               '$_POST[tpasswordpetugas]')
            ");
        if($simpan){
        echo "<script>
        alert('simpan data SUKSES!');
        document.location = 'petugas.php'
        </script>";
        }
        else{
        echo "<script>
        alert('simpan data GAGAL. Pastikan semua form terisi!');
        document.location = 'petugas.php'
        </script>";
        }  
    }                 
}
//pengujian jika tombol edit atau hapus diklik
if(isset($_GET['hal'])){
    //pengujian jika mengedit data
    if($_GET['hal']=="edit"){
        //tampilkan data yang akan diedit
        $tampil = mysqli_query($koneksi,"SELECT * FROM petugas WHERE id_petugas='$_GET[id]'");
        $data = mysqli_fetch_array($tampil);
        if($data){
            //jika data ditemukan maka data ditampung ke variabel
            $vidpetugas = $data['id_petugas'];
            $vnamapetugas =  $data['nama'];
            $vnotelppetugas = $data['no_telp'];
            $vstatuspetugas = $data['status'];
            $vpasswordpetugas = $data['password'];
        }
    }
    else if($_GET['hal']=="hapus"){
        //persiapan hapus data
        $hapus = mysqli_query($koneksi,"DELETE FROM petugas WHERE id_petugas='$_GET[id]' ");
        if($hapus){
            echo "<script>
        alert('Hapus data SUKSES!');
        document.location = 'petugas.php'
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
        <title> PETUGAS</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
        <center><img src="http://disarpus.sanggau.go.id/wp-content/uploads/2017/06/budaya-baca.jpg" alt="centered image" height="240" width="360"> </center>
        <link rel="stylesheet" href="desain.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>

    </head>
    <body>
        <div class="container">
        <h1 class="text-center mt-4">FORM PETUGAS</h1>
    <!-- awal card form -->
    <div class="card mt-3">
    <div class="card-header bg-primary text-white">
        isi data petugas
    </div>
    <div class="card-body">
    <form action="" method="post">
        <!-- form id peminjam-->
        <div class="form-group">
            <label>ID Petugas</label>
            <input type="text" name="tidpetugas" value="<?=@$vidpetugas?>" class="form-control" placeholder="input id petugas disini!" required>
        </div>
        <!-- form id anggota -->
        <div class="form-group">
            <label>Nama Petugas</label>
            <input type="text" name="tnamapetugas" value="<?=@$vnamapetugas?>" class="form-control" placeholder="input nama petugas disini!" required>
        </div>
        <!-- form id petugas -->
        <div class="form-group">
            <label>No. Telp petugas</label>
            <input type="text" name="tnotelppetugas" value="<?=@$vnotelppetugas?>" class="form-control" placeholder="input nomor telpon petugas disini!" required>
        </div>
        <div class="form-group">
            <label>Password petugas</label>
            <input type="text" name="tpasswordpetugas" value="<?=@$vpasswordpetugas?>" class="form-control" placeholder="input password petugas disini!" required>
        </div>
        <div class="form-group">
            <label>Status Petugas</label>
            <select name="tstatuspetugas" class="form-control">
            <option value="<?=@$vstatuspetugas?>"><?=@$vstatuspetugas?></option>
            <option value="aktif">aktif</option>
            <option value="tidak aktif">tidak aktif</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success mt-3" name="fsimpan">SIMPAN</button>
        <button type="reset" class="btn btn-danger mt-3" name="freset">RESET</button>
    </form>
    </div>
    </div>
    <!-- akhir card form-->

     <!-- awal card table -->
    <div class="card mt-3">
    <div class="card-header bg-success text-white">
        Tabel Anggota
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tr>
                <th>ID Petugas</th>
                <th>Nama Petugas</th>
                <th>Nomor telpon</th>
                <th>Status Petugas</th>
                <th>Aksi</th>
            </tr>
            <?php
            $no = 1;
            $tampil = mysqli_query($koneksi, 'SELECT * from petugas order by id_petugas desc');
            while($data = mysqli_fetch_array($tampil)):
                ?>
                <tr>
                    <td><?=$data['id_petugas']?></td>
                    <td><?=$data['nama']?></td>
                    <td><?=$data['no_telp']?></td>
                    <td><?=$data['status']?></td>
                    <td>
                        <a href="petugas.php?hal=edit&id=<?=$data['id_petugas']?>" class="btn btn-warning">EDIT</a>
                        <a href="petugas.php?hal=hapus&id=<?=$data['id_petugas']?>" onclick="return confirm('apakah yakin ingin menghapus data ini?')" class="btn btn-danger">HAPUS</a>
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