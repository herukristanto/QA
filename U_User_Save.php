<?php
$id_user = $_GET['id_user'];
$kd_dept = $_GET['departemen'];
$unit_kerja = $_GET['unit_kerja'];
$statuser = $_GET['statuser'];
$simpan = $_GET['simpan'];

echo $unit_kerja;

include "koneksi.php";
date_default_timezone_set("Asia/Bangkok");

if ($simpan == "ubah"){
	$sql = "update M_User set Departemen = '".kd_dept."' , Unit = '".$unit_kerja."' , Status = '".$statuser."' where ID = '".$id_user."'";
	$sql_execute = sqlsrv_query($conn,$sql);

	$sql = "select * from M_User where ID = '".$id_user."'";
	$sql_execute = sqlsrv_query($conn,$sql);
	$hasil = sqlsrv_fetch_array($sql_execute, SQLSRV_FETCH_ASSOC);

	echo
	"<script>
	alert('User ID ".$hasil['ID']." - ".$hasil['Departemen']." - ".$hasil['Unit']." Berhasil Diubah');
	window.location.href='U_User_Change.php';
	</script>";
	
} elseif ($simpan == "baru") {
	$sql = "select * from M_User where ID = '".$id_user."'";
	$sql_execute = sqlsrv_query($conn, $sql, array(), array( "Scrollable" => 'static' ));
	$hitungbaris = sqlsrv_num_rows($sql_execute);

	if ($hitungbaris == 0) {
		$sql = "insert into M_User values('".$id_user."','".$unit_kerja."', '".$kd_dept."' ,'".$statuser."')";
		$sql_execute = sqlsrv_query($conn,$sql);

		$sql = "select * from M_User where ID = '".$id_user."'";
		$sql_execute = sqlsrv_query($conn,$sql);
		$hasil = sqlsrv_fetch_array($sql_execute, SQLSRV_FETCH_ASSOC);

		echo
		"<script>
		alert('User ID ".$hasil['ID']." - ".$hasil['Departemen']." - ".$hasil['Unit']." Berhasil Ditambah');
		window.location.href='U_User_Create.php';
		</script>";
	} else {
		echo
		"<script>
		alert('Data sudah tercatat pada sistem sebelumnya.');
		window.location.href='U_User_Create.php';
		</script>";
		
	}
}
?>
