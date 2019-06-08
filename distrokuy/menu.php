<?php
session_start();
// koneksi database
$koneksi=new mysqli("localhost","root","","distrokuy");
$ambil=$koneksi->query("SELECT * FROM kategori");
$semuadata = array();
while ($tampung = $ambil->fetch_assoc())
{
    $semuadata[]=$tampung;
}
?>
<html>
<head>
    <link href="admin/assets/css/bootstrap.css" rel="stylesheet" />
    <link href="admin/assets/css/font-awesome.css" rel="stylesheet" />
    <link href="admin/assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">

  <ul class="nav navbar-nav navbar-left">
  <li><a href="index.php"><img src="admin/assets/images/distrokuy.png" width="130" height="30">&nbsp;&nbsp;</a></li>
      
            <li><a href="index.php"><img src="admin/assets/images/home.ico" width="18 " height="16"> Beranda</a></li>
              <?php foreach ($semuadata as $key => $kat): ?>
                <li><a href="kategori.php?id=<?php echo $kat['id']; ?> ">
                <img src="admin/assets/images/<?php echo $kat['gambar'];?>" height="20" width="20">
                <?php echo $kat['kategori_produk']; ?></a></li>
              <?php endforeach ?>
    <form class="navbar-form navbar-right" action="pencarian.php" method="get">
      <div class="form-group">
              <input type="text" class="form-control" placeholder="Cari Produk" name="cari">
              <button class="btn btn-primary">Cari</button>
      </div>
    </form>        
  </ul>

        <?php if (isset($_SESSION["pelanggan"])): ?>
        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <img src="admin/assets/images/user.ico" width="25" height="25"> </i>  Hi, <?php echo $_SESSION["pelanggan"]["nama_pelanggan"] ?> <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="keranjang.php">Keranjang</a></li>
                  <li><a href="riwayat.php">Riwayat Belanja</a></li>
                  <li><a href="logout.php">Keluar</a></li>
          <li>
              </ul>
        </ul>
                  <?php else: ?>
                  <div class="container-fluid">
                    <ul class="nav navbar-nav navbar-right">
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        Masuk</a>
                    <ul class="dropdown-menu" style="text-indent: 12em;">
              <form method="post"> 
                  <div class="form-group col-md-12">
                      <label><p style="text-indent: -12em;">Email</p></label>
                        <input type="email" class="form-control" name="email">
                  </div>
                  <div class="form-group col-md-12">
                      <label><p style="text-indent: -12em;">Password</p></label>
                        <input type="password" class="form-control" name="password">
                  </div><br>
                      <button type="simpan" class="btn btn-primary col-md-offset-1" name="simpan">Masuk</button>
              </form>
                  <div class="dropdown-divider col-md-offset-1"></div>
                      <a class="dropdown-item" href="register.php">&nbsp;&nbsp;&nbsp;Belum punya akun? Daftar</a><br>
                      <a class="dropdown-item" href="#">&nbsp;&nbsp;&nbsp;Lupa password?</a>
                  </div>
          </li>
                </ul>          
                    <?php endif ?>
              </ul>
     
</nav>

</div>
    <script src="admin/assets/js/jquery-1.10.2.js"></script>
    <script src="admin/assets/js/bootstrap.min.js"></script>
    <script src="admin/js/jquery.metisMenu.js"></script>
     <script src="admin/assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="admin/js/morris/morris.js"></script>
    <script src="admin/js/custom.js"></script>
    
</div>
</body>
</html>

<?php
// koneksi database
$koneksi=new mysqli("localhost","root","","distrokuy");
?>
  
  
<?php
// verivikasi login
	if(isset($_POST["simpan"]))
	{
		$email = $_POST["email"];
		$password = $_POST["password"];
		$ambil=$koneksi->query("SELECT * FROM pelanggan
			WHERE email_pelanggan='$email' AND password_pelanggan='$password'");
		$akunyangcocok=$ambil->num_rows;
		
		if ($akunyangcocok==1)
		{
			$akun = $ambil->fetch_assoc();
			$_SESSION["pelanggan"]=$akun;
			echo "<script>alert('Anda Sukses login')</script>";

			if(isset($_SESSION["keranjang"]) OR !empty($_SESSION["keranjang"]))
			{
				echo "<script>location='checkout.php';</script>";
			}
			else
			{
				echo "<script>location='index.php';</script>";
			}
		}	
		else
		{
			echo "<script>alert('Anda Gagal Login, Periksa akun Anda')</script>";
			echo "<script>location='index.php';</script>";
		}		
	}
?>
