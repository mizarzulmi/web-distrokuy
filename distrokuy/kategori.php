<?php
// koneksi database
$koneksi = new mysqli("localhost","root","","distrokuy");
?>

    <html>
        <head>
            <title>Toko Distrokuy</title>
            <link rel="stylesheet" href="admin/assets/css/style.css">
            <link rel="stylesheet" href="admin/assets/css/font-awesome.css">
    </head>
    <body>
        <?php require('menu.php') ?><br><br>
        <div class="container">
        <div class="row">

        <?php
             $id_kategori = $_GET['id'];
            $semuadata=array();
            $ambil = $koneksi->query("SELECT*FROM kategori JOIN produk ON
                            kategori.id=produk.kategori_id
                            WHERE produk.kategori_id='$id_kategori'"); 
                            while ($tampung = $ambil->fetch_assoc())
                                    {
                                        $semuadata[]=$tampung;
                                    }
        ?>
        <br><br><br>
        <?php foreach ($semuadata as $key => $kat): ?>
                <div class="col-md-3">
                    <div class="thumbnail">
                        <img src="foto_produk/<?php echo $kat['foto_produk'];?>" alt="" class="img-responsive">
                        <div class="caption">
                            <h3><?php echo $kat['nama_produk'];?></h3>
                            <h5>Rp. <?php echo number_format($kat['harga_produk']); ?></h5>
                            <a href="beli.php?id=<?php echo $kat['id_produk'];?>" class="btn btn-primary">Kuy</a>
                            <a href="detail.php?id=<?php echo $kat['id_produk'];?>" class="btn btn-default">Detail</a>
                            
                        </div>
                    </div>
            </div>
            <?php endforeach ?>
        </div>
    </div>
    </body>
    </html>
  