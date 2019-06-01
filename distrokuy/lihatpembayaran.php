<?php
session_start();
// koneksi database
$koneksi=new mysqli("localhost","root","","distrokuy");
require('session.php');

$id_pembelian = $_GET["id"];
$ambil = $koneksi->query("SELECT * FROM pembayaran
    LEFT JOIN pembelian ON pembayaran.id_pembelian=pembelian.id_pembelian
    WHERE pembelian.id_pembelian='$id_pembelian'");
    $detbay = $ambil->fetch_assoc();

if (empty($detbay))
{
    echo "<script>alert('belum ada data pembayaran');</script>";
    echo "<script>location='riwayat.php';</script>";
    exit();
}   

if ($_SESSION["pelanggan"]["id_pelanggan"]!==$detbay["id_pelanggan"])
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
    <h3>Lihat Pembayaran</h3>
    <hr>
    <?php require ('back.php') ?>
    <div class="row">
        <div class="col-md-6">
            <table class="table">
                <tr>
                    <th>Nama</th>
                    <td><?php echo $detbay["nama"] ?></td>
                </tr>
                <tr>
                    <th>Bank</th>
                    <td><?php echo $detbay["bank"] ?></td>
                </tr>
                <tr>
                    <th>Tanggal</th>
                    <td><?php echo $detbay["tanggal"] ?></td>
                </tr>
                <tr>
                    <th>Jumlah</th>
                    <td>Rp. <?php echo number_format ($detbay["jumlah"]) ?></td>
                </tr>
            </table>
        </div>
        <div class="col-md-8">
        <h3>Bukti Pembayaran</h3>
            <img src="bukti_pembayaran/<?php echo $detbay["bukti"] ?>" alt="" widht="300px" height="300px">
        </div>
    </div>
</div>

</body>
</html>