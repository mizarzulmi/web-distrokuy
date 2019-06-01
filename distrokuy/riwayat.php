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

<body>
    <section>
        <div class="riwayat">
            <div class="container">
            <br><br>
                <h3>Riwayat Belanja <?php echo $_SESSION["pelanggan"]["nama_pelanggan"] ?></h3>
                <hr>
            <?php require ('back.php') ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $nomor=1;
                        $id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
                        $ambil = $koneksi->query("SELECT*FROM pembelian WHERE id_pelanggan='$id_pelanggan'");
                        while($pecah = $ambil->fetch_assoc()){
                        ?>
                            <tr>
                                <td><?php echo $nomor; ?></td>
                                <td><?php echo $pecah["tanggal_pembelian"] ?></td>
                                <td>
                                <?php echo $pecah["status_pembelian"] ?>
                                <br>
                                    <?php if (!empty($pecah['resi_pengiriman'])): ?>
                                    <strong>resi : <?php echo $pecah['resi_pengiriman']; ?></strong>
                                    <?php endif ?>
                                </td>

                                <td>Rp. <?php echo number_format($pecah["total_pembelian"]) ?></td>
                                <td>
                                    <a href="nota.php?id=<?php echo $pecah["id_pembelian"] ?>" class="btn btn-info">Nota</a>
                                    <?php if($pecah['status_pembelian']=="pending"): ?>
                                        <a href="pembayaran.php?id=<?php echo $pecah['id_pembelian'] ?>" class="btn btn-success">Input Pembayaran</a>
                        <?php else: ?>
                                    <a href="lihatpembayaran.php?id=<?php echo $pecah["id_pembelian"] ?>" class="btn btn-warning">Lihat Pembayaran</a>
                                    <?php endif ?>
                                </td>
                            </tr>
                        <?php $nomor++ ?>
                        <?php } ?>
                    </tbody>
                </table>
<br><br>

            </div>
        </div>
    </section>

</body>
</html>