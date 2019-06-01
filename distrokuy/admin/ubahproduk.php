<h2>Ubah Produk</h2>

<?php
$ambil=$koneksi->query("SELECT *from produk WHERE id_produk='$_GET[id]'");
$pecah=$ambil->fetch_assoc();
?>

<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>Nama Produk</label>
        <input type="text" name="nama" class="form-control" value="<?php echo $pecah['nama_produk']; ?>">
    </div>
    <div class="form-group">
        <label>Kategori :</label><br><br>
            <?php  
                $ambil = $koneksi->query("SELECT*FROM kategori"); 
                while ($tampung = $ambil->fetch_assoc())
                                        {
                                            $semuadata[]=$tampung;
                                        }
            ?>
                <?php $nomor=1; ?>
                <?php foreach ($semuadata as $key => $data): ?>
                    &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $nomor; ?> . <?php echo $data['kategori_produk']; ?><br><br>
                <?php $nomor++; ?>
                <?php endforeach ?>
                    <input type="number" class="form-control" name="kat" min="1" max="6">    
    </div>
    <div class="form-group">
        <label>Harga Rp</label>
        <input type="number" class="form-control" name="harga" value="<?php echo $pecah['harga_produk']; ?>">
    </div>
    <div class="form-group">
        <label>Stok Produk</label>
        <input type="number" class="form-control" name="stok"  min="1" value="<?php echo $pecah['stok_produk']; ?>">
    </div>
    <div class="form-group">
        <img src="../foto_produk/<?php echo $pecah['foto_produk'] ?>" width="200">
    </div>
    <div class="form-group">
        <label>Ganti Foto</label>
        <input type="file" name=foto class="form-control">      
    </div>
    <div class="form-group">
        <label>Deskripsi</label>
        <textarea name="deskripsi" class="form-control" rows="10">
<?php echo $pecah['deskripsi_produk'] ?>
        </textarea>
    </div>
    <button class="btn btn-primary" name="ubah">Ubah</button>
</form>

<?php  
 if (isset($_POST['ubah'])){
 	$namafoto=$_FILES['foto']['name'];
 	$lokasifoto=$_FILES['foto']['tmp_name'];
 	// $lokasifoto = $foto['tmp_name'];
 	if(!empty($lokasifoto)){
		move_uploaded_file($lokasifoto,"../foto produk/$namafoto");
 		$koneksi->query("UPDATE produk SET nama_produk='$_POST[nama]',harga_produk='$_POST[harga]',
         stok_produk='$_POST[stok]',foto_produk='$namafoto', deskripsi_produk='$_POST[deskripsi]' WHERE id_produk='$_GET[id]'");
 		
 	
 	}
 	else{
 			$koneksi->query("UPDATE produk SET nama_produk='$_POST[nama]',
             harga_produk='$_POST[harga]', stok_produk='$_POST[stok]',deskripsi_produk='$_POST[deskripsi]', kategori_id='$_POST[kat]'  WHERE id_produk='$_GET[id]'");
 	}
	echo "<script>alert('data produk telah diubah');</script>";
	echo "<script>location='index.php?halaman=produk';</script>";
 }
 	?>
