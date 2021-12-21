<?php
require('config.php');
?>

<!DOCTYPE html>
<html>
    <head>
	    <link rel="stylesheet" href="style.css" type="text/css" media="all">
    </head>

    <body>
        <div class="split-screen">
            <div class="left">
                <section class="copy">
                    <h1> Database Perpustakaan </h1>
                </section>
            </div>
            <div class="right">
                <form action="index.php" method="POST">
                    <section class="copy">
                        <h2>Sign In</h2>
                    </section>
                    <div class="input-container name">
                        <label for="ID"> ID </label>
                        <input type="text" name = "ID" placeholder="Masukkan ID Disini" required="">
                    </div>
                    <div class="input-container password">
                        <label for="password"> Password </label>
                        <input type="password" name = "password" placeholder="Masukkan Password Disini">
                    </div>
                    <input class="signin-btn" name="signin" type="submit"; value="Sign in">
                </form>
            </div>
        </div>
<?php
if(isset($_POST['signin'])){
	$i=$_POST['ID'];
	$d=$_POST['password'];

    $sql= "Select * from petugas where id_petugas='$i'";
	$result = mysqli_query($koneksi, $sql);
    $row = mysqli_fetch_assoc($result);
	$a=$row['password'];
    if(strcmp($a,$d)==0 && !empty($i) && !empty($d))
    {
        $_SESSION['ID']=$i;
        header('location:menu.php');
    }
    else 
    { echo "<script type='text/javascript'>alert('Login gagal! ID atau Password salah')</script>";
    }
}
?>
    </body>
</html>