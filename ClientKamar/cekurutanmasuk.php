<?php
include "koneksi.php";

session_start();
$idruang = $_SESSION['idruang'];
$iddokter = $_SESSION['iddokter'];

$id = $_GET['id'];
$selip = $_GET['selip'];
$urutan = $selip + 1;
$nomor = $_GET['nomor'];
$rowCount = $_GET['rowCount'];

$sql = "DELETE FROM QP7ANTRIANA WHERE id='".$id."'";
$sql_execute = sqlsrv_query($conn,$sql);
$sql = "DELETE FROM QP7ANTRIANAA WHERE id='".$id."'";
$sql_execute = sqlsrv_query($conn,$sql);

if ($rowCount>$selip) {
	$sql = "INSERT INTO QP7ANTRIANA VALUES(".$urutan.",'".$id."','".$idruang."','".$nomor."','x','x','x','x');";
	$sql_execute = sqlsrv_query($conn,$sql);
	$sql = "INSERT INTO QP7ANTRIANAA VALUES(".$urutan.",'".$id."','".$idruang."','".$nomor."','x','x','x','');";
	$sql_execute = sqlsrv_query($conn,$sql);
} else {
	$sql = "INSERT INTO QP7ANTRIANA VALUES(".$rowCount.",'".$id."','".$idruang."','".$nomor."','x','x','x','x');";
	$sql_execute = sqlsrv_query($conn,$sql);
	$sql = "INSERT INTO QP7ANTRIANAA VALUES(".$rowCount.",'".$id."','".$idruang."','".$nomor."','x','x','x','');";
	$sql_execute = sqlsrv_query($conn,$sql);
}

echo "<script>
window.location.href='tablelistantrian.php';
</script>";

?>