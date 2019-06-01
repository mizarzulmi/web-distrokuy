<?php
session_start();
// koneksi database
$koneksi=new mysqli("localhost","root","","distrokuy");

if (!isset($_SESSION['admin']))
{
    echo "<script>alert('Anda Harus Login');</script>";
    echo "<script>location='login.php';</script>";
    headr('location:login.php');
    exit();
}

?>

<!DOCTYPE html>
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin</title>
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/custom.css" rel="stylesheet" />
     
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <a class="navbar-brand" href="#"><i class="fa fa-user fa-1x"></i> Admin</a> 
            </div>
        </nav>   
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
				<li class="text-center">
                    </li>
                    
                <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                <li><a href="index.php?halaman=produk"><i class="fa fa-shopping-cart"></i> Produk</a></li>
                <li><a href="index.php?halaman=pembelian"><i class="fa fa-tags"></i> Pembelian</a></li>
                <li><a href="index.php?halaman=laporanpembelian"><i class="fa fa-file"></i> Laporan</a></li>
                <li><a href="index.php?halaman=pelanggan"><i class="fa fa-users"></i> Pelanggan</a></li>
                <li><a href="index.php?halaman=logout"><i class="fa fa-sign-out"></i> Keluar</a></li>
</ul>
               
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <?php
                if (isset($_GET['halaman']))
                {
                    if ($_GET['halaman']=="produk")
                    {
                        include 'produk.php';
                    }
                    elseif ($_GET['halaman']=="pembelian")
                    {
                        include 'pembelian.php';
                    }
                    elseif ($_GET['halaman']=="pelanggan")
                    {
                        include 'pelanggan.php';
                    }
                    elseif ($_GET['halaman']=="detail")
                    {
                        include 'detail.php';
                    }
                    elseif ($_GET['halaman']=="tambahproduk")
                    {
                        include 'tambahproduk.php';
                    }
                    elseif ($_GET['halaman']=="hapusproduk")
                    {
                        include 'hapusproduk.php';
                    }
                    elseif ($_GET['halaman']=="ubahproduk")
                    {
                        include 'ubahproduk.php';
                    }
                    elseif ($_GET['halaman']=="hapuspelanggan")
                    {
                        include 'hapuspelanggan.php';
                    }   
                    elseif ($_GET['halaman']=="logout")
                    {
                        include 'logout.php';
                    }   
                    elseif ($_GET['halaman']=="pembayaran")
                    {
                        include 'pembayaran.php';
                    }
                    elseif ($_GET['halaman']=="laporanpembelian")
                    {
                        include 'laporanpembelian.php';
                    }  
                }
                else
                {
                    include 'home.php';
                }
                ?>
</body>
</html>
