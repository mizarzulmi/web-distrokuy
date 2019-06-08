<?php
	
	$server		= "localhost"; // sesuaikan alamat server anda
	$user		= "root"; // sesuaikan user web server anda
	$password	= ""; // sesuaikan password web server anda
	$database	= "distrokuy"; // sesuaikan database web server anda
	
	$connect = mysql_connect($server, $user, $password) or die ("Koneksi gagal!");
	mysql_select_db($database) or die ("Database belum siap!");
	
	//error_log("insert into alamat ('".$_POST['nama']."','".$_POST['alamat']."')");
	mysql_query("insert into chat (username,isi_chat) values ('".$_POST['username']."','".$_POST['chat']."')");

?>