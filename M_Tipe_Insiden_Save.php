<?php

$kd_tipe		= $_GET['kd_tipe'];
$kd_insiden 	= $_GET['kd_insiden'];
$tipe_insiden 	= $_GET['tipe_insiden'];
$status_tipe 	= $_GET['status_tipe'];
$simpan 		= $_GET['simpan'];

$insiden 		= substr($kd_insiden,0,10);

include "koneksi.php";
date_default_timezone_set("Asia/Bangkok");

if ($simpan == "ubah"){
	$sql = "update M_Tipe_Insiden set Kode = '".$insiden."' , Tipe_insiden = '".$tipe_insiden."' , Mark = '".$status_tipe."' where Kode_tipe = '".$kd_tipe."'";
	$sql_execute = sqlsrv_query($conn,$sql);

	$sql = "select * from M_Tipe_Insiden where Kode_tipe = '".$kd_tipe."'";
	$sql_execute = sqlsrv_query($conn,$sql);
	$hasil = sqlsrv_fetch_array($sql_execute, SQLSRV_FETCH_ASSOC);

	echo
	"<script>
	alert('Tipe Insiden ".$hasil['Kode_tipe']." - ".$hasil['Tipe_insiden']." Berhasil Diubah');
	window.location.href='M_Tipe_Insiden_Change.php';
	</script>";
	
} elseif ($simpan == "baru") {
	$sql = "select * from M_Tipe_Insiden where Kode_tipe = '".$kd_tipe."'";
	$sql_execute = sqlsrv_query($conn, $sql, array(), array( "Scrollable" => 'static' ));
	$hitungbaris = sqlsrv_num_rows($sql_execute);

	if ($hitungbaris == 0) {
		$sql = "insert into M_Tipe_Insiden values('".$kd_tipe."','".$insiden."','".$tipe_insiden."','".$status_tipe."')";
		$sql_execute = sqlsrv_query($conn,$sql);

		$sql = "select * from M_Tipe_Insiden where Kode_tipe = '".$kd_tipe."'";
		$sql_execute = sqlsrv_query($conn,$sql);
		$hasil = sqlsrv_fetch_array($sql_execute, SQLSRV_FETCH_ASSOC);

		echo
		"<script>
		alert('Tipe Insiden ".$hasil['Kode_tipe']." - ".$hasil['Tipe_insiden']." Berhasil Ditambah');
		window.location.href='M_Tipe_Insiden_Create.php';
		</script>";
	} else {
		echo
		"<script>
		alert('Data sudah tercatat pada sistem sebelumnya.');
		window.location.href='M_Tipe_Insiden_Create.php';
		</script>";
		
	}
}
?>
