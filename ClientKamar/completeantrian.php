<?php
include "koneksi.php";

session_start();
$idruang = $_SESSION['idruang'];

$id = $_GET['id'];

date_default_timezone_set('Asia/Jakarta');
$date = date('Y-m-d H:i:s');
$waktu = substr($date,11,8);
$tgl = date('Y M d');
$terminal = $_SERVER['REMOTE_ADDR'];

$sql = "UPDATE QP7ANTRIAN SET Status='6', jam_pasien_panggil_selesai='".$date."' WHERE id='".$id."'";
$sql_execute = sqlsrv_query($conn,$sql);

$sql2 = "DELETE FROM QP7ANTRIANA WHERE Id='".$id."'";
$sql_execute2 = sqlsrv_query($conn,$sql2);

$sql2 = "DELETE FROM QP7ANTRIANAA WHERE Id='".$id."'";
$sql_execute2 = sqlsrv_query($conn,$sql2);

$sql = "UPDATE QP7STATUSRUANG SET Status=1 WHERE Id_Ruang='".$idruang."' AND terminal='".$terminal."' AND tgl_antrian='".$tgl."';";
$sql_execute = sqlsrv_query($conn,$sql);

if ($sql_execute && $sql_execute2) {
	echo "<script>
	window.location.href='tablelistantrian.php';
	</script>";
}

?>