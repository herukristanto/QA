<html>
<body onload='playsign(), movepage()'>
	<audio id="audio" src="audio/KamarDokter.wav" ></audio>
	<h1>Sedang Memanggil</h1>
	<?php
	include "koneksi.php";

	$id = $_GET['id'];
	$idruang = $_GET['idruang'];
	$kode = $_GET['kode'];
	$nomor = $_GET['nomor'];
	$gantinomor = $_GET['gantinomor'];

	date_default_timezone_set('Asia/Jakarta');
	$date = date('Y-m-d H:i:s');
	$waktu = substr($date,11,8);
	$tgl = DATE('Y M d');

	$terminal = $_SERVER['REMOTE_ADDR'];

	$sql = "UPDATE QP7ANTRIANA SET status='y' WHERE id='".$id."'";
	$sql_execute = sqlsrv_query($conn,$sql);
	$sql = "UPDATE QP7ANTRIANAA SET status='y' WHERE id='".$id."'";
	$sql_execute = sqlsrv_query($conn,$sql);


	$query = "SELECT Id_Ruang, kode, nomor_antrian FROM QP7LASTANTRIAN WHERE Id_Ruang like '".$idruang."' AND nomor_antrian like '".$kode."%'";
	$params = array();
	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$sql = sqlsrv_query( $conn, $query , $params, $options );
	$row_countlast = sqlsrv_num_rows( $sql );
	if ($gantinomor == 1) {
		if ($row_countlast > 0) {
			$sql = "UPDATE QP7LASTANTRIAN SET nomor_antrian='".$nomor."' WHERE Id_Ruang='".$idruang."' AND kode='".$kode."'";
			$sql_execute = sqlsrv_query($conn,$sql);
		} else {
			$sql = "INSERT INTO QP7LASTANTRIAN VALUES('".$idruang."','".$nomor."','".$kode."')";
			$sql_execute = sqlsrv_query($conn,$sql);
		}
	}


	$query = "SELECT jam_pasien_panggil from QP7ANTRIAN where id = '".$id."'";
	$params = array();
	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$sql = sqlsrv_query( $conn, $query , $params, $options );
	$row_count = sqlsrv_num_rows( $sql );
	if ($sql){
		while($rs = sqlsrv_fetch_array($sql)){
			$hasil = $rs['jam_pasien_panggil'];
		}
	}

	if ($hasil === NULL) {
		$sql = "UPDATE QP7ANTRIAN SET jam_pasien_panggil='".$date."', jam_pasien_panggil_berikut='".$date."' WHERE id='".$id."'";
		$sql_execute = sqlsrv_query($conn,$sql);
		if ($sql_execute) {
			$sql1 = "UPDATE QP7STATUSRUANG SET Status=2 WHERE Id_Ruang='".$idruang."' AND terminal='".$terminal."' AND kode='".$kode."';";
			$sql_execute1 = sqlsrv_query($conn,$sql1);
			// echo "<script>
			// window.location.href='tablelistantrian.php';
			// </script>";
		}
	} else {
		$sql = "UPDATE QP7ANTRIAN SET jam_pasien_panggil_berikut='".$date."' WHERE id='".$id."'";
		$sql_execute = sqlsrv_query($conn,$sql);
		if ($sql_execute) {
			$sql1 = "UPDATE QP7STATUSRUANG SET Status=2 WHERE Id_Ruang='".$idruang."' AND terminal='".$terminal."' AND kode='".$kode."';";
			$sql_execute1 = sqlsrv_query($conn,$sql1);
			// echo "<script>
			// window.location.href='tablelistantrian.php';
			// </script>";
		}
	}

	?>

	<Script>
		function playsign(){
			var audio = document.getElementById("audio");
			audio.play();
		}

		function movepage() {
			setTimeout(
				function() {
					window.location.href='tablelistantrian.php';
				}, 15000);
		}
	</script>

</body>
</html>