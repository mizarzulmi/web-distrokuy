<?php
session_start();
// koneksi database
$koneksi=new mysqli("localhost","root","","distrokuy");
require('session.php');
?>

<?php
    $id_pembelian = $_GET["id"];
    $ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pembelian='$id_pembelian'");
    $detpem = $ambil->fetch_assoc();
    $id_pelanggan_beli = $detpem["id_pelanggan"];
    $id_pelanggan_login = $_SESSION["pelanggan"]["id_pelanggan"];

    if($id_pelanggan_login !== $id_pelanggan_beli)
    {
        echo "<script>alert('terjadi kesalahan');</script>";
        echo "<script>location='riwayat.php';</script>";
        exit();
    }   
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

<div class="container">
<br><br>
    <h2>Konfirmasi Pembayaran</h2><hr>
    <?php require ('back.php') ?>
    <p>Kirim bukti Pembayaran anda disini</p>
    <div class="alert alert-info">Total tagihan anda <strong>Rp. <?php echo number_format($detpem["total_pembelian"]) ?></strong></div>
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Nama penyetor</label>
            <input type="text" class="form-control" name="nama">
        </div>    
        <div class="form-group">
                <label>Bank</label>
                <input type="text" class="form-control" name="bank">
        </div> 
        <div class="form-group">
                <label>Jumlah</label>
                <input type="number" class="form-control" name="jumlah" min="1">
        </div>
        <div class="form-group">
                <label>Foto Bukti</label>
                <input type="file" class="form-control" name="bukti">
                <p class="text-danger">foto bukti harus JPG maksimal 2MB</p>
        </div>
        <button class="btn btn-primary" name="kirim">Kirim</button>  
    </form>
    </div>
    <?php
if (isset($_POST["kirim"])) 
{
   // upload dulu foto bukti
   $namabukti = $_FILES["bukti"]["name"];
   $lokasibukti = $_FILES["bukti"]["tmp_name"];
   $namafiks = date("YmdHis").$namabukti;
   move_uploaded_file($lokasibukti, "bukti_pembayaran/$namafiks");

   $nama = $_POST["nama"];
   $bank = $_POST["bank"];
   $jumlah = $_POST["jumlah"];
   $tanggal = date("Y-m-d");


   $koneksi->query("INSERT INTO pembayaran(id_pembelian,nama,bank,jumlah,tanggal,bukti)
    VALUES ('$id_pembelian','$nama','$bank','$jumlah','$tanggal','$namafiks')");

    $koneksi->query("UPDATE pembelian SET status_pembelian='sudah kirim pembayaran'
        WHERE id_pembelian='$id_pembelian' ");
    
          echo "<script>alert('terimakasih sudah mengirimkan bukti pembayaran');</script>";
          echo "<script>location='riwayat.php';</script>";
}
?>

</body>
</html>