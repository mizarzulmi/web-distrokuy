<?php
session_start();
// koneksi database
$koneksi=new mysqli("localhost","root","","distrokuy");
?>

<html>
    <head>
        <title>Toko DistroKuy</title>
        <link rel="stylesheet" href="admin/assets/css/style.css">
        <link rel="stylesheet" href="admin/assets/css/font-awesome.css">
</head>
<body>

<!--nav-->
<?php require("menu.php") ?>

<!--konten-->
<section class="konten">
    <div class="container">
        <br><br>
        <h3>Produk Terbaru</h3>
        <br>
        <div class="row">
            <?php $ambil= $koneksi->query("SELECT * FROM produk"); ?>
            <?php while($perproduk = $ambil->fetch_assoc()){ ?>
            <div class="col-md-3">
                <div class="thumbnail">
                    <img src="foto_produk/<?php echo $perproduk['foto_produk'];?>" alt="" class="img-responsive">
                    <div class="caption">
                        <h3><?php echo $perproduk['nama_produk'];?></h3>
                        <h5>Rp. <?php echo number_format($perproduk['harga_produk']); ?></h5>
                        <a href="beli.php?id=<?php echo $perproduk['id_produk'];?>" class="btn btn-primary">Kuy</a>
                        <a href="detail.php?id=<?php echo $perproduk['id_produk'];?>" class="btn btn-default">Detail</a>
                        
                 </div>
            </div>
        </div>
            <?php } ?>
    </div>       
</div>
</section>
<br>
<?php require ('footer.php') ?>
</body>
</html>
                    