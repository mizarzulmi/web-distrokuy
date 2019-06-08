<?php
    $koneksi=new mysqli("localhost","root","","distrokuy");
    $koneksi->query("DELETE FROM chat");
    echo "<script>alert('riwayat pesan dihapus');</script>";
    echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=pelanggan'>"; 
?>