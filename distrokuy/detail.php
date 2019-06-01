<?php
session_start();
// koneksi database
$koneksi=new mysqli("localhost","root","","distrokuy");
$id_produk = $_GET['id'];
$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
$detail = $ambil->fetch_assoc();

require('session.php');
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
<section class="kontent">
    <div class="container">
    <br><br>
    <h3>Detail Produk</h3>
    <hr><br>
        <div class="row">
            <div class="col-md-6">
                <img src="foto_produk/<?php echo $detail['foto_produk']; ?>" alt="" class="img-responsive">
                </div>
            <div class="col-md-6">
                <h2><?php echo $detail["nama_produk"]; ?></h2>
                <h4>Rp. <?php echo number_format($detail["harga_produk"]); ?></h4>
                 <h5>Stok : <?php echo $detail['stok_produk'] ?> </h5>  

                <form method="post">
                <div class="form-group">
                    <div class="input-group">
                        <input type="number" min="1" class="form-control" name="jumlah" max="<?php echo $detail['stok_produk'] ?>">
                        <div class="input-group-btn">
                            <button class="btn btn-primary" name="beli">Kuy</button>
                        </div>    
                    </div>
                </div>  
                </form>

                <?php
                if(isset($_POST["beli"]))
                {
                    $jumlah = $_POST["jumlah"];
                    $_SESSION["keranjang"][$id_produk] = $jumlah;

                    echo "<script>alert('produk telah masuk ke keranjang belanja</script>";
                    echo "<script>location='keranjang.php';</script>";
                }
                ?>
                <p><?php echo $detail["deskripsi_produk"]; ?></p>
            </div>
        </div>
    </div>
</section>

</body>
</html>