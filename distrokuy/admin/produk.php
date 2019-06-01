<h2>Data Produk</h2>

<table class='table table-bordered'>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Foto</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php $nomor=1; ?>
    <?php $ambil=$koneksi->query("SELECT * FROM PRODUK"); ?>
    <?php while($pecah = $ambil->fetch_assoc()){ ?>
        <tr>
            <td><?php echo $nomor; ?></td>
            <td><?php echo $pecah['nama_produk'];?></td>
            <td><?php echo $pecah['harga_produk'];?></td>
            <td>
                <img src="../foto_produk/<?php echo $pecah['foto_produk']; ?>" width="100">
            </td>
            <td><?php echo $pecah['stok_produk'] ?></td>
            <td>
                <a href="index.php?halaman=hapusproduk&id=<?php echo $pecah['id_produk']; ?>" 
                class="btn-danger btn">hapus</a>
                <a href="index.php?halaman=ubahproduk&id=<?php echo $pecah['id_produk']; ?>"
                 class="btn btn-warning">ubah</a>
            </td>
           
        </tr>
    <?php $nomor++; ?>
    <?php } ?>
    </tbody>
</table>
<a href="index.php?halaman=tambahproduk" class="btn btn-primary">Tambah Data</a>