<?php
include "koneksi.php";
date_default_timezone_set("Asia/Bangkok");

$aspek        = $_GET['aspek'];
$analisa      = $_GET['analisa'];
$tindaklanjut = $_GET['tindaklanjut'];
$user         = $_GET['user'];
$status		  = $_GET['status'];

echo $aspek;
echo "<br>";
echo $analisa;

if ($simpan == "ubah"){
	$sql = "update Trans_Data set analisa = '".$analisa."' , tindaklanjut = '".$tindaklanjut."' , user = '".$user."' , status = '".$status."' where id = '".$id."'";
	$sql_execute = sqlsrv_query($conn,$sql);

	$sql = "select * from Trans_Data where id = '".$id."'";
	$sql_execute = sqlsrv_query($conn,$sql);
	$hasil = sqlsrv_fetch_array($sql_execute, SQLSRV_FETCH_ASSOC);

	echo
	"<script>
	alert('Transaksi Berhasil Diubah');
	window.location.href='T_Transaction_Change.php';
	</script>";
	
} elseif ($simpan == "baru") {
	
	$sql = "INSERT INTO Trans_Data VALUES ('".$aspek."','".$analisa."','".$tindaklanjut."','".$user."','".$status."')";

    $bridge = sqlsrv_query($conn,$sql);

echo '<script>
	alert("Data Berhasil Diinput");
	window.location="T_Transaction.php";
	</script>';

}
?>
