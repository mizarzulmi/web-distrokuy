<h2>Tambah Produk</h2>

<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>Nama</label>
        <input type="text" class="form-control" name="nama">
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
                    <input type="number" class="form-control" name="kat" min="1" max="6" placeholder="Pilih nomor kategori diatas">    
    </div>
   <div class="form-group">
        <label>Harga (Rp)</label>
        <input type="number" class="form-control" name="harga">
    </div>
    <div class="form-group">
        <label>Stok</label>
        <input type="number" class="form-control" min="1"name="stok">
    </div>
    <div class="form-group">
        <label>Deskripsi</label>
        <textarea class="form-control" name="deskripsi" rows="10"></textarea>        
    </div>
    <div class="from-goup">
        <label>Foto</label>
        <input type="file" class="form-control" name="foto">
        </div><br>

    <button class="btn btn-primary" name="save">Simpan</button>

</form>
<?php if (isset($_POST['save'])) 
{ 
 $nama = $_FILES['foto']['name'];
 $lokasi = $_FILES['foto']['tmp_name']; 
 move_uploaded_file($lokasi,"../foto_produk/".$nama); 
 $kirim = $koneksi->query("INSERT INTO produk(nama_produk,harga_produk,stok_produk,foto_produk,deskripsi_produk,kategori_id) 
  VALUES('".$_POST['nama']."','".$_POST['harga']."','".$_POST['stok']."','".$nama."','".$_POST['deskripsi']."','".$_POST['kat']."')");
   echo "<div class='alert alert-info'>Data Tersimpan</div>"; 
   echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=produk'>"; 

  } 
  ?>

