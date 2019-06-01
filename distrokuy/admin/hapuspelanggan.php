<?php

if(isset($_GET['halaman']) AND $_GET['halaman']=='hapuspelanggan' )
{
    $koneksi->query("DELETE FROM pelanggan WHERE id_pelanggan='$_GET[id]'");
    echo "<script>alert('pelanggan dihapus');</script>";
    echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=pelanggan'>"; 

}

?>