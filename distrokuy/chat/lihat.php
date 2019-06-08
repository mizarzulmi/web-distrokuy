<?php
	
	$server		= "localhost"; // sesuaikan alamat server anda
	$user		= "root"; // sesuaikan user web server anda
	$password	= ""; // sesuaikan password web server anda
	$database	= "distrokuy"; // sesuaikan database web server anda
	
	$connect = mysql_connect($server, $user, $password) or die ("Koneksi gagal!");
	mysql_select_db($database) or die ("Database belum siap!");
		
	$qData = mysql_query("select * from chat"); // query sql untuk menampilkan data
	$data = array(); // initialisasi array

	$n=1; // inisialisasi n atau index array
	
	$data[0]=mysql_num_rows($qData); // untuk menyimpan total data yang ada kedalam array index 0

	while($o =mysql_fetch_object($qData)){ // loopiing data dengan parsing object
		$username = "username"+$n; // buat index username
		$isi_chat = "isi_chat"+$n; // buat index isi_chat
		$data["username"][$n]=$o->username; // menyimpan data username kedalam array $data
		$data["isi_chat"][$n]=$o->isi_chat; // menyimpan data isi_chat kedalam array $data
		$n++;
	}

	echo json_encode($data); // kemudian di parsing ke json agar bisa diterima oleh ajax

?>