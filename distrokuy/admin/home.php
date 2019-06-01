<?php
$koneksi=new mysqli("localhost","root","","distrokuy");
?>

<!DOCTYPE html>
<html>
<head></head>
<body>
    <h2><marquee>Selamat Datang Admin</marquee></h2>
        <div class="col-md-7">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Nama Lengkap</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $ambil=$koneksi->query("SELECT *FROM admin"); ?>
                    <?php while ($pecah=$ambil->fetch_assoc()){ ?>
                    <tr>
                        <td><?php echo $pecah['username']; ?></td>
                        <td><?php echo $pecah['password']; ?></td>
                        <td><?php echo $pecah['nama_lengkap']; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>