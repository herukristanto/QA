<!DOCTYPE html>
<html>
<head>
	<script src="script/jquery-1.12.4.js"></script>
	<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
	<meta content="utf-8" http-equiv="encoding">
</head>
<body onload='emergency()'>
	<?php
	session_start();
	include "koneksi.php";
	$idruang = $_SESSION['idruang'];
	$iddokter = $_SESSION['iddokter'];
	$idkirim = $_SESSION['idkirim'];

	date_default_timezone_set('Asia/Jakarta');
    $tgl = DATE('Y M d');

	$query = "SELECT kode FROM QP7LISTDOCTOR WHERE Doctor_Id like '".$iddokter."' AND selesai_praktek='00:00:00.0000000' AND create_date='".$tgl."';";
	$params = array();
	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$sql = sqlsrv_query( $conn, $query , $params, $options );
	while($rs = sqlsrv_fetch_array($sql)){
		$kode = $rs['kode'];
	}

	$query = "SELECT Urutan, Id, nomor_antrian, status FROM QP7ANTRIANAA WHERE Id_Ruang like '".$idruang."' AND nomor_antrian like '".$kode."%' ORDER BY Urutan ASC";
	$params = array();
	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$sql = sqlsrv_query( $conn, $query , $params, $options );
	$row_count = sqlsrv_num_rows( $sql );
	if ($row_count == 0) {
		echo "
		<table width=\"450\" id=\"antrianList\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\" style=\"table-layout:fixed\" hidden>
		<tr>
		<td align='center'>Urutan</td>
		<td align='center'>ID</td>
		<td align='center'>Nomor Antrian</td>
		<td align='center'>Status</td>
		</tr>
		</table>";
	} else {
		if ($sql){
			echo "
			<table width=\"450\" id=\"antrianList\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\" style=\"table-layout:fixed\" hidden>
			<tr>
			<td align='center'>Urutan</td>
			<td align='center'>ID</td>
			<td align='center'>Nomor Antrian</td>
			<td align='center'>Status</td>
			</tr>";
			while($rs = sqlsrv_fetch_array($sql)){
				if ($rs['Urutan'] == 1) {
					echo "
					<tr>
					<td width='50px' align='center'>".$rs['Urutan']."</td>
					<td width='200px' align='center'>".$rs['Id']."</td>
					<td width='200px' align='center'>".$rs['nomor_antrian']."</td>  
					<td width='200px' align='center'>".$rs['status']."</td>
					</tr>
					";
				} else {
					echo "
					<tr>
					<td width='50px' align='center' align='center'>".$rs['Urutan']."</td>
					<td width='200px' align='center'>".$rs['Id']."</td>
					<td width='200px' align='center'>".$rs['nomor_antrian']."</td>
					<td width='200px' align='center'>".$rs['status']."</td>
					";
				}
			}
		}
		echo"</table>";
	}
	?>
	<script>

		function emergency() {
			var antrian = document.getElementById('antrianList');
			var rowCount = antrian.rows.length;
			var arr1 = [];
			var arr2 = [];
			var idkirim = "<?php echo $idkirim; ?>";
			var isinya = antrian.rows[1].cells[3].innerHTML;

			if (isinya=='y') {
				for (i = 2 ; i < rowCount ; i++) {
					var urut = antrian.rows[i].cells[0].innerHTML;
					var id = antrian.rows[i].cells[1].innerHTML;

					if (id != idkirim) {
						arr2 = [];

						j = i - 1;

						if (urut != '' && id != '') {
							arr2[0] = urut;
							arr2[1] = id;
							arr1[j] = arr2;
						}
					}				
				}
			} else {
				for (i = 1 ; i < rowCount ; i++) {
					var urut = antrian.rows[i].cells[0].innerHTML;
					var id = antrian.rows[i].cells[1].innerHTML;

					if (id != idkirim) {
						arr2 = [];

						j = i - 1;

						if (urut != '' && id != '') {
							arr2[0] = urut;
							arr2[1] = id;
							arr1[j] = arr2;
						}
					}				
				}
			}

			if (arr1 != '') {
				$.post("ubahurutan2.php", {'myData':arr1}, function(data, status){});
				alert('Antrian Emergency berhasil');
				// alert('Antrian Emergency berhasil');
				window.location.href = "recallemergency.php?id=" + idkirim + "&isinya=" + isinya;
			} else {
				alert('ga ada');
			}
		}
	</script>
</body>
</html>