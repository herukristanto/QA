<?php
session_start();
include "koneksi.php";

// $id = $_GET['id'];
$id = $_POST['id'];

$_SESSION['idkirim'] = $id;

$sql = "UPDATE QP7ANTRIAN SET Status='5' WHERE id='".$id."'";
$sql_execute = sqlsrv_query($conn,$sql);

$sql2 = "DELETE FROM QP7ANTRIANA WHERE Id='".$id."'";
$sql_execute2 = sqlsrv_query($conn,$sql2);

$sql2 = "DELETE FROM QP7ANTRIANAA WHERE Id='".$id."'";
$sql_execute2 = sqlsrv_query($conn,$sql2);

if ($sql_execute && $sql_execute2) {
	echo "<script>
	window.location.href='emergency.php';
	</script>";
}
?>