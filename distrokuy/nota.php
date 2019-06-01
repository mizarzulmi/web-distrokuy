<?php
session_start();
// koneksi database
$koneksi=new mysqli("localhost","root","","distrokuy");
require('session.php');
?>

<html>
    <head>
        <title>Toko DistroKuy</title>
        <link rel="stylesheet" href="admin/assets/css/style.css">
        <link rel="stylesheet" href="admin/assets/css/font-awesome.css">
    </head>
<body>

<!-- navbar -->
<?php require("menu.php") ?>

<section class="konten">
    <div class="container">
    <br><br>
    <h2>Detail Pembelian</h2><br>
    <hr>
    <?php require ('back.php') ?>
<?php
$ambil=$koneksi->query("SELECT * FROM pembelian JOIN pelanggan
    ON pembelian.id_pelanggan=pelanggan.id_pelanggan
    WHERE pembelian.id_pembelian='$_GET[id]'");
$detail = $ambil->fetch_assoc();
$ambil = $koneksi->query("SELECT *FROM ongkir");
$perongkir = $ambil->fetch_assoc();
?>

<?php
    $idbeli = $detail["id_pelanggan"];
    $idlogin = $_SESSION["pelanggan"]["id_pelanggan"];
    if($idbeli!==$idlogin)
    {
        echo "<script>alert('jangan otakatik');</script>";
        echo "<script>location='riwayat.php';</script>";
        exit();
    }
?>

<table class="table table-hover">
    <thead>
        <tr>
            <th>no</th>
            <th>nama produk</th>
            <th>harga</th>
            <th>jumlah</th>
            <th>subtotal</th>
        </tr>
    </thead>
    <tbody>
    <?php $nomor=1; ?>
        <?php $ambil=$koneksi->query("SELECT*FROM pembelian_produk JOIN produk ON
                pembelian_produk.id_produk=produk.id_produk
                WHERE pembelian_produk.id_pembelian='$_GET[id]'"); ?>
        <?php while($pecah=$ambil->fetch_assoc()) { ?>        
        <tr>
            <td><?php echo $nomor; ?></td>
            <td><?php echo $pecah['nama_produk']; ?></td>
            <td><?php echo $pecah['harga_produk']; ?></td>
            <td><?php echo $pecah['jumlah']; ?></td>
            <td>
                <?php echo $pecah['harga_produk']*$pecah['jumlah']; ?>
            </td>    
        </tr>
        <?php $nomor++; ?>
        <?php } ?>
    </tbody>
</table>

<div class="row">
    <div class="col-md-2">
        <h3>Pelanggan</h3>
        <p>
            Nama : <strong><?php echo $detail['nama_pelanggan']; ?></strong><br>
            Telepon : <?php echo $detail['telepon_pelanggan']; ?> <br>
            <?php echo $detail['email_pelanggan']; ?>
        </p>
    </div>  
    <div class="col-md-2">
        <h3>Pembelian</h3>
        <p>
            Tanggal : <?php echo $detail['tanggal_pembelian']; ?><br>
            Ongkos Kirim : Rp. <?php echo number_format($perongkir['tarif']) ?><br>
            Total : Rp. <?php echo number_format ($detail['total_pembelian']); ?>
        </p>
    </div>
    <div class="col-md-2">
        <h3>Pengiriman</h3>
        <p>
        Kota : <?php echo $perongkir['nama_kota']; ?><br>
        Tarif : Rp. <?php echo number_format ($perongkir['tarif']); ?><br>
        Alamat : <?php echo $detail['alamat_pelanggan']; ?>
        </p>
    </div> 
<br>
        <div class="row">
        <br>
            <div class="col-md-6">
                <div class="alert alert-info">
                <p>
                    Silahkan melakukan pembayaran Rp. <?php echo number_format($detail['total_pembelian']); ?> ke <br>
                    <strong>BANK MANDIRI 137-0011088-3276 AN. Mizar Zulmi Ramadhan</strong>
                </p>
                </div>
            </div>
        </div>
    </div>
</section> 
</body>
</html>