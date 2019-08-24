<?php
$kd_insiden = $_GET['kd_insiden'];
$desk_insiden = $_GET['desk_insiden'];
$statinsiden = $_GET['statinsiden'];
$simpan = $_GET['simpan'];

include "koneksi.php";
date_default_timezone_set("Asia/Bangkok");

if ($simpan == "ubah"){
	$sql = "update M_Insiden set Insiden = '".$desk_insiden."' , Mark = '".$statinsiden."' where Kode = '".$kd_insiden."'";
	$sql_execute = sqlsrv_query($conn,$sql);

	$sql = "select * from M_Insiden where Kode = '".$kd_insiden."'";
	$sql_execute = sqlsrv_query($conn,$sql);
	$hasil = sqlsrv_fetch_array($sql_execute, SQLSRV_FETCH_ASSOC);

	echo
	"<script>
	alert('Insiden ".$hasil['Kode']." - ".$hasil['Insiden']." Berhasil Diubah');
	window.location.href='M_insiden_Change.php';
	</script>";
	
} elseif ($simpan == "baru") {
	$sql = "select * from M_Insiden where Kode = '".$kd_insiden."'";
	$sql_execute = sqlsrv_query($conn, $sql, array(), array( "Scrollable" => 'static' ));
	$hitungbaris = sqlsrv_num_rows($sql_execute);

	if ($hitungbaris == 0) {
		$sql = "insert into M_Insiden values('".$kd_insiden."','".$desk_insiden."','".$statinsiden."')";
		$sql_execute = sqlsrv_query($conn,$sql);

		$sql = "select * from M_Insiden where Kode = '".$kd_insiden."'";
		$sql_execute = sqlsrv_query($conn,$sql);
		$hasil = sqlsrv_fetch_array($sql_execute, SQLSRV_FETCH_ASSOC);

		echo
		"<script>
		alert('Insiden ".$hasil['Kode']." - ".$hasil['Insiden']." Berhasil Ditambah');
		window.location.href='M_Insiden_Create.php';
		</script>";
	} else {
		echo
		"<script>
		alert('Data sudah tercatat pada sistem sebelumnya.');
		window.location.href='M_insiden_Create.php';
		</script>";
		
	}
}
?>
