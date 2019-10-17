<?php
$kd_sub				= $_GET['Kd_sub'];
$kd_tipe			= $_GET['Kd_tipe'];
$kd_insiden 		= $_GET['Kd_insiden'];
$sub_tipe_insiden	= $_GET['Sub_tipe_insiden'];
$status_sub		 	= $_GET['Status_sub'];
$simpan 			= $_GET['simpan'];

$tipe 				= substr($kd_tipe,0,10);
$insiden 			= substr($kd_insiden,0,10)

include "koneksi.php";
date_default_timezone_set("Asia/Bangkok");

if ($simpan == "ubah"){
	$sql = "update M_Sub_Tipe_Insiden set Kode_tipe = '".$tipe."', Kode = '".$insiden."', Sub_tipe = '".$sub_tipe_insiden."' , Mark = '".$status_sub."' where Kode_sub = '".$kd_sub."'";
	$sql_execute = sqlsrv_query($conn,$sql);

	$sql = "select * from M_Sub_Tipe_Insiden where Kode_sub = '".$kd_sub."'";
	$sql_execute = sqlsrv_query($conn,$sql);
	$hasil = sqlsrv_fetch_array($sql_execute, SQLSRV_FETCH_ASSOC);

	echo
	"<script>
	alert('Sub Tipe Insiden Berhasil Diubah');
	window.location.href='M_insiden_Change.php';
	</script>";
	
} elseif ($simpan == "baru") {
	$sql = "select * from M_Sub_Tipe_Insiden where Kode = '".$kd_sub."'";
	$sql_execute = sqlsrv_query($conn, $sql, array(), array( "Scrollable" => 'static' ));
	$hitungbaris = sqlsrv_num_rows($sql_execute);

	if ($hitungbaris == 0) {
		$sql = "insert into M_Sub_Tipe_Insiden values('".$kd_sub."','".$tipe."','".$insiden."','".$sub_tipe_insiden."','".$status_sub."')";
		$sql_execute = sqlsrv_query($conn,$sql);

		$sql = "select * from M_Sub_Tipe_Insiden where Kode_sub = '".$kd_sub."'";
		$sql_execute = sqlsrv_query($conn,$sql);
		$hasil = sqlsrv_fetch_array($sql_execute, SQLSRV_FETCH_ASSOC);

		echo
		"<script>
		alert('Sub Tipe Insiden ".$hasil['Kode_sub']." - ".$hasil['Sub_tipe']." Berhasil Ditambah');
		window.location.href='M_Sub_Tipe_Insiden_Create.php';
		</script>";
	} else {
		echo
		"<script>
		alert('Data sudah tercatat pada sistem sebelumnya.');
		window.location.href='M_Sub_Tipe_Insiden_Create.php';
		</script>";
		
	}
}
?>
