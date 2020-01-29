<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<p align="center"><img src="Images/header.png" width="1000" height="140"></p>
	<script src="script/jquery-1.12.4.js"></script>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Client Kamar</title>
	<style type="text/css">
	.center{
		position: absolute;
		margin-left: -250px;
		left: 50%;
		top: 200px;
		width: 400px;
		height: 220px;
	}
	.button{
		height: 50px;
		width: 100px;
	}

	#tabelAntri {
		font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
		border-collapse: collapse;
		width: 100%;
		max-width: 50;
		table-layout: fixed;
		word-wrap: break-word;
		white-space: nowrap;
	}

	#tabelAntri td, #tabelAntri th {
		border: 1px solid #ddd;
		padding: 8px;
	}

	#tabelAntri br {
		display: inline;
	}

	#tabelAntri tr:nth-child(even){background-color: #f2f2f2;}

	#tabelAntri tr:hover {background-color: #ddd;}

	#tabelAntri th {
		padding-top: 12px;
		padding-bottom: 12px;
		text-align: left;
		background-color: #4CAF50;
		color: white;
	}
</style>
</head>

<body onload="cekstatus();">
	<?php
	include "koneksi.php";

	date_default_timezone_set('Asia/Jakarta');
	$tgl = DATE('Y M d');

	$terminal = $_SERVER['REMOTE_ADDR'];



	session_start();
	if (isset($_SESSION['idruang'])){
		$idruang = $_SESSION['idruang'];
		$iddokter = $_SESSION['iddokter'];
	}

	if (empty($_SESSION['username']) AND empty($_SESSION['password'])){
		echo "<br>";
		echo "<br>";
		echo "<br>";
		echo "<center><H3>Mohon Login Terlebih Dahulu</h3><br>";
		echo "<a href=login.php><b>LOGIN</b></a></center>";
		exit;
	} else {
		$query = "SELECT Status FROM QP7STATUSRUANG WHERE Id_Ruang='".$idruang."' AND terminal='".$terminal."' AND tgl_antrian='".$tgl."';";
		$params = array();
		$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$sql = sqlsrv_query( $conn, $query , $params, $options );
		while($rs = sqlsrv_fetch_array($sql)){
			$status = $rs['Status'];
		}

		$query = "SELECT * FROM QP7RUANG WHERE Id_Ruang='".$idruang."';";
		$params = array();
		$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$sql = sqlsrv_query( $conn, $query , $params, $options );
		while($rs = sqlsrv_fetch_array($sql)){
			$namaruang = $rs['Nama_Ruang'];
			$namapoli = $rs['Nama_Poli'];
		}

		$query = "SELECT * FROM QP7ANTRIANA WHERE Id_Ruang like '".$idruang."' ORDER BY Urutan ASC";
		$params = array();
		$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$sql = sqlsrv_query( $conn, $query , $params, $options );
		$row_count = sqlsrv_num_rows( $sql );

		$query = "SELECT kode FROM QP7LISTDOCTOR WHERE Doctor_Id like '".$iddokter."' AND selesai_praktek='00:00:00.0000000' AND create_date='".$tgl."';";
		$params = array();
		$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$sql = sqlsrv_query( $conn, $query , $params, $options );
		while($rs = sqlsrv_fetch_array($sql)){
			$kode = $rs['kode'];
		}

		$query = "SELECT * FROM QP7ANTRIAN WHERE tgl_antrian = '".$tgl."' AND kode = '".$kode."' AND (Status > 0 AND Status < 6) AND Id_Ruang='".$idruang."'";
		$params = array();
		$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$sql = sqlsrv_query( $conn, $query , $params, $options );
		$row_count_tutup = sqlsrv_num_rows( $sql );
	}
	?>

	<div class="center">
		<table id="myTable">
			<tr>
				<td width=150>Poliklinik</td>
				<td width=20 align="center">:</td>
				<td>
					<?php
					echo $namapoli;
					?>
				</td>
			</tr>
			<tr>
				<td>Ruang</td>
				<td align="center">:</td>
				<td>
					<?php
					echo $namaruang;
					?>
				</td>
			</tr>
			<tr>
				<td>Status Ruangan</td>
				<td align="center">:</td>
				<td><button id="btnbuka" onclick="buka();">Buka</button> &nbsp; <button id="btntutup" onclick="tutup();" disabled>Tutup</button> &nbsp; <button id="btnpindah" onclick="pindah();" disabled>Pindah Ruang</button></td></td>
			</tr>
			<tr height=25>
				<td colspan=3></td>
			</tr>
			<tr>
				<td colspan=3 hidden>List Antrian</td>
			</tr>
			<tr>
				<td colspan=3 width=800 hidden><iframe id="antrian" src="tablelistantrian.php" width=550 height=250></iframe><iframe id="emergency" src="emergency.php" width=550 height=100></iframe></td>
			</tr>
			<tr height=25>
				<td colspan=3></td>
			</tr>
			<tr>
				<td colspan=3 hidden>List Antrian Skip</td>
			</tr>
			<tr>
				<td colspan=3 hidden><iframe id="antrianskip" src="tablelistantrianskip.php" width=330 height=250></iframe></td>
			</tr>
		</table>
	</div>

	<iframe id="updatestatus" src="" hidden></iframe>
	<script>

		var row_countantri = '';
		var row_countskip = '';

		$('p').each(function(){
			$(this).html($(this).html().replace(/&nbsp;/gi,''));
		});

		function buka() {
			var table = document.getElementById("myTable");
			table.rows[4].cells[0].removeAttribute('hidden');
			table.rows[5].cells[0].removeAttribute('hidden');
			table.rows[7].cells[0].removeAttribute('hidden');
			table.rows[8].cells[0].removeAttribute('hidden');
			document.getElementById("btnbuka").setAttribute('disabled','true');
			document.getElementById("btntutup").removeAttribute('disabled');
			document.getElementById("btnpindah").removeAttribute('disabled');
			var idruang = '<?php echo $idruang ?>';
			var kode = '<?php echo $kode ?>';
			var kirim="updatestatusruang.php?idruang="+idruang+"&status=buka&kode="+kode;
			updatestatus.src = kirim;
		}

		function tutup() {
			location.reload();
		}

		function tutupafterreload(){
			var idruang = '<?php echo $idruang ?>';
			var kode = '<?php echo $kode ?>';
			var tutupga = '<?php echo $row_count_tutup ?>';
			if (tutupga > 0) {
				alert('Masih ada antrian');
			} else {
				if (confirm('Apa anda yakin menutup pelayanan diruang ini?')) {
					alert('Logout..');
					window.location.href="updatestatusruang.php?idruang="+idruang+"&status=tutup&kode="+kode;
					alert('Logout..');
					window.location.href="updatelastantrian.php?idruang="+idruang+"&kode="+kode;
				} else {
                //do nothing
            }
        }

    }

    function pindah() {
    	var idruang = '<?php echo $idruang ?>';
    	var kode = '<?php echo $kode ?>';
    	if (confirm('Apa anda yakin memindahkan pelayanan diruang ini?')) {
    		window.location.href="pindahruang.php?idruang="+idruang+"&status=tutup&kode="+kode;
    	} else {
                //do nothing
            }
        }

        function cekstatus() {
        	var status='<?php echo $status; ?>';
        	var kode='<?php echo $kode; ?>';
        	if (status=='1') {
        		var table = document.getElementById("myTable");
        		table.rows[4].cells[0].removeAttribute('hidden');
        		table.rows[5].cells[0].removeAttribute('hidden');
        		table.rows[7].cells[0].removeAttribute('hidden');
        		table.rows[8].cells[0].removeAttribute('hidden');
        		document.getElementById("btnbuka").setAttribute('disabled','true');
        		document.getElementById("btntutup").removeAttribute('disabled');
        		document.getElementById("btnpindah").removeAttribute('disabled');
        		var idruang = '<?php echo $idruang ?>';
        		var kirim = "updatestatusruang.php?idruang="+idruang+"&status=buka&kode="+kode;
        		updatestatus.src = kirim;

        		tutupafterreload();
        	} else {
        		if (status=='3') {
        			var table = document.getElementById("myTable");
        			table.rows[4].cells[0].removeAttribute('hidden');
        			table.rows[5].cells[0].removeAttribute('hidden');
        			table.rows[7].cells[0].removeAttribute('hidden');
        			table.rows[8].cells[0].removeAttribute('hidden');
        			document.getElementById("btnbuka").setAttribute('disabled','true');
        			document.getElementById("btntutup").removeAttribute('disabled');
        			document.getElementById("btnpindah").removeAttribute('disabled');
        			var idruang = '<?php echo $idruang ?>';
        			var kirim = "updatestatusruang.php?idruang="+idruang+"&status=buka&kode="+kode;
        			updatestatus.src = kirim;

        			tutupafterreload();
        		}
        	}
        }


    </script>
</body>
</html>
