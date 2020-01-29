<!DOCTYPE html>
<html>
<head>
	<script src="script/jquery-1.12.4.js"></script>
	<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
	<meta content="utf-8" http-equiv="encoding">
</head>
<body onload='emergency()'>
	<?php
	include "koneksi.php";

	if (isset($_GET['nomor'])) {
		$nomor = $_GET['nomor'];
	} else {
		$nomor = '';
	}
	

	session_start();
	$idruang = $_SESSION['idruang'];
	$iddokter = $_SESSION['iddokter'];

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
			</tr>";
			while($rs = sqlsrv_fetch_array($sql)){
				if ($rs['Urutan'] == 1) {
					echo "
					<tr>
					<td width='50px' align='center'>".$rs['Urutan']."</td>
					<td width='200px' align='center'>".$rs['Id']."</td>
					<td width='200px' align='center'>".$rs['nomor_antrian']."</td>  
					</tr>
					";
				} else {
					echo "
					<tr>
					<td width='50px' align='center' align='center'>".$rs['Urutan']."</td>
					<td width='200px' align='center'>".$rs['Id']."</td>
					<td width='200px' align='center'>".$rs['nomor_antrian']."</td>
					";
				}
			}
		}
		echo"</table>";
	}

	$query = "SELECT nomor_antrian, flage FROM QP7ANTRIANAA WHERE Id_Ruang like '".$idruang."' AND nomor_antrian like '".$kode."%' AND flage='y' ORDER BY Urutan ASC";
	$params = array();
	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$sql = sqlsrv_query( $conn, $query , $params, $options );
	$row_count = sqlsrv_num_rows( $sql );
	if ($row_count == 0) {
		echo "
		<table width=\"450\" id=\"antrianList4\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\" style=\"table-layout:fixed\" hidden>
		<tr>
		<td align='center'>Nomor Antrian</td>
		<td align='center'>Flage</td>
		</tr>
		</table>";
	} else {
		if ($sql){
			echo "
			<table width=\"450\" id=\"antrianList4\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\" style=\"table-layout:fixed\" hidden>
			<tr>
			<td align='center'>Nomor Antrian</td>
			<td align='center'>Flage</td>
			</tr>";
			while($rs = sqlsrv_fetch_array($sql)){
				echo "
				<tr>
				<td width='200px' align='center'>".$rs['nomor_antrian']."</td>
				<td width='200px' align='center'>".$rs['flage']."</td>
				";
			}
		}
		echo"</table>";
	}
	?>

	Input Emergency (Nomor Antrian): <br>
	<input type="text" id="txtinput" style="border: 1px solid black; border-radius: 1px; padding: 12px 15px; margin: 8px 0;"></input>
	<button onclick="refresh()" style="border: 1px solid black; border-radius: 1px; padding: 12px 20px; margin: 8px 0;"> FOR EMERGENCY</button>

	<script>

		function emergency() {
			
			var nomor = '<?php echo $nomor ?>';
			if (nomor != '') {
				var urutkirim;
				var idkirim;
				var nomorkirim;

				var antrian = document.getElementById('antrianList');
				var rowCount = antrian.rows.length;

				for (i = 1 ; i < rowCount ; i++) {
					r = i;
					var nomorbanding = antrian.rows[r].cells[2].innerHTML;
					if (nomorbanding == nomor) {
						urutkirim = antrian.rows[r].cells[0].innerHTML;
						idkirim = antrian.rows[r].cells[1].innerHTML;
						nomorkirim = antrian.rows[r].cells[2].innerHTML;

						$.post("emergencydel.php", {'id': idkirim}, function(data, status){
							var rowCount2 = antrian.rows.length;
							var j;
							var arr1 = [];
							var arr2 = [];

							for (j = 2; j < rowCount2; j++) {

								k = j - 1;
								arr2 = [];

								urutan = antrian.rows[j].cells[0].innerHTML;
								id = antrian.rows[j].cells[1].innerHTML;

								if (urutan > urutkirim && urutan != '' && id != '') {
									arr2[0] =  urutan;
									arr2[1] =  id;
									arr1[k] = arr2;
								}
							}

							$.post("ubahurutan3.php", {'myData': arr1}, function(data, status){$(location).attr('href','reverse.php');});

							document.getElementById('txtinput').value = '';

						});
						break;
					} else {
						s = rowCount - 1;
						if (r == s) {
							alert('Tidak ada nomor yang dimaksud..');
							document.getElementById('txtinput').value = '';
						}
					}
				}
			}
		}

		function refresh() {
			var emg = document.getElementById('antrianList4');
			var rowCount4 = emg.rows.length;
			if (rowCount4>1) {
				document.getElementById('txtinput').value = '';
				alert('Mohon tunggu.. Sedang ada pasien emergency');
			} else {
				var nomor = document.getElementById('txtinput').value;
				if (nomor != '') {
					window.location.href = "emergency.php?nomor="+nomor;
				}
			}
		}
	</script>
</body>
</html>