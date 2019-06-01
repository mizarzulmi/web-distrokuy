<?php
// koneksi database
$koneksi=new mysqli("localhost","root","","distrokuy");
$keyword=$_GET["cari"];
?>

<html>
    <head>
        <title>Pencarian</title>
        <link rel="stylesheet" href="admin/assets/css/style.css">
        <link rel="stylesheet" href="admin/assets/css/font-awesome.css">
</head>
<body>
    <?php require('menu.php') ?><br><br>
    <div class="container">
        <br><br>
        <h3>Hasil Pencarian :"<?php echo $keyword ?> "<h3><hr>
        
        <div class="row">
             <?php
                $semuadata=array();
                $ambil = $koneksi->query("SELECT * FROM produk WHERE nama_produk 
                        LIKE '%$keyword%' OR deskripsi_produk LIKE '%$keyword$' ");
                    while ($tampung = $ambil->fetch_assoc())
                        {
                            $semuadata[]=$tampung;
                        }
            ?>
            <?php if(empty($semuadata)): ?>
                <br>
                    <div class="alert alert-danger col-md-9 col-md-offset-2">Produk <strong><?php $keyword ?></strong>Tidak Ditemukan</div>
            <?php endif ?>
            <?php foreach ($semuadata as $key => $value): ?>
                <div class="col-md-3">
                    <div class="thumbnail">
                        <img src="foto_produk/<?php echo $value['foto_produk'];?>" alt="" class="img-responsive">
                        <div class="caption">
                            <h3><?php echo $value['nama_produk'];?></h3>
                            <h5>Rp. <?php echo number_format($value['harga_produk']); ?></h5>
                            <a href="beli.php?id=<?php echo $value['id_produk'];?>" class="btn btn-primary">Kuy</a>
                            <a href="detail.php?id=<?php echo $value['id_produk'];?>" class="btn btn-default">Detail</a>
                            
                        </div>
                    </div>
            </div>
            <?php endforeach ?>
        </div>
    </div>
</body>
</html>