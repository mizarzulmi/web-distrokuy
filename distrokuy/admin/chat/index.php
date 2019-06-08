<?php
session_start();
// koneksi database
$koneksi=new mysqli("localhost","root","","distrokuy");

	if (!isset($_SESSION['admin']))
	{
		echo "<script>alert('Anda Harus Login');</script>";
		header('location:../login.php');
		exit();
	}

?>

<!doctype html>
<html>
<head>
	<link rel="stylesheet" href="../../admin/assets/css/style.css">
	<link rel="stylesheet" href="../../admin/assets/css/font-awesome.css">	
	<link href="assets/css/custom.css" rel="stylesheet" />

	<meta charset='UTF-8' />
	<style>
		input, textarea {border:1px solid #CCC;margin:0px;padding:0px}

		#body {max-width:800px;margin:auto}
		#log {width:100%;height:400px}
		#message {width:100%;line-height:20px}
	</style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script src="fancywebsocket.js"></script>
	<script>
		var Server;

		function log( text ) {
			$log = $('#log');
			//Add text to log
			$log.append(($log.val()?"\n":'')+text);
			//Autoscroll
			$log[0].scrollTop = $log[0].scrollHeight - $log[0].clientHeight;
		}

		function send( text ) {
			Server.send( 'chat', text );
		}

		$(document).ready(function() {
			log('Connecting...');
			Server = new FancyWebSocket('ws://192.168.1.6:9300');


			//ajax untuk menampilkan saat reload
			$.ajax({ 
				url: "lihat.php",
				dataType: "json",
				type: "POST",
				success: function(data){
					//var obj = JSON.parse(data);	    					
					var count = data[0]; // get jumlah data yang dikirim
					var i=1;
					
					//$("#log").val("");
					while (i<=count) { // while data sampai kurang <= jumlah data	    				
						log( data["username"][i]+': ' + data["isi_chat"][i]); // menampilkan ke dalam chat
						//console.log(data["username"][i]+" : "+data["isi_chat"][i]); // membuat log pada javascript
						//send( data["username"][i]+': ' + data["isi_chat"][i]); // mengirim chat tsb ke semua client yang sedang terkoneksi atau sedang mengkases aplikasi_chat
						

					    i++; // proses penambahan index
					}
					
				}
			});

			$('#chat').keypress(function(e) {
				if ( e.keyCode == 13 && this.value ) {
					
					var dataString = 'username='+$("#username").val()+"&chat="+this.value;

					//alert(dataString);
					
					$.ajax({ 
	    				url: "kirim.php", //nama file yang baru dibuat
	    				data: dataString, // variable yang akan dikirim
	    				dataType: "json", // type data yang dikirim
	    				type: "POST", // method yang digunakan untuk mengirim data
	    				success: function(data){

	    				}
	    			});

					//menampilkan chat seperti biasa dengan aappend log
					
					log( $("#username").val()+': ' + $("#chat").val()); // menampilkan ke dalam chat
					console.log($("#username").val()+': ' + $("#chat").val()); // membuat log pada javascript
					send( $("#username").val()+': ' + $("#chat").val()); // mengirim chat tsb 
		
				}
			});

			//Let the user know we're connected
			Server.bind('open', function() {
				log( "Connected." );
			});

			//OH NOES! Disconnection occurred.
			Server.bind('close', function( data ) {
				log( "Disconnected." );
			});

			//Log any messages sent from server
			Server.bind('chat', function( payload ) {
				log( payload );
			});

			Server.connect();
		});
	</script>
</head>
<br>
<body>
	<div class="container" id='body'>
        <h2>Chat Room DistroKuy</h2>
		<hr>
		<a href="hapuschat.php" class="btn btn-danger col-md-offset-10"><i class="fa fa-undo"></i> Bersihkan Chat</a><br><br>
		<textarea class="form-control" id='log' name='log' readonly='readonly'></textarea><br/>
	<div class="form-gorup">
		<input type='text'  readonly value="<?php echo $_SESSION["admin"]["username"] ?>" class="form-control" id='username' name='username'>
		</div><br>
		<input type="text" class="form-control" placeholder="Tanyakan ??" id='chat' name='chat'>
	</div>
	<br><br>
</body>
</html>
