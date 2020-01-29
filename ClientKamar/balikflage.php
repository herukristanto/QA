<?php
include "koneksi.php";

$id = $_GET['id'];

$sql2 = "UPDATE QP7ANTRIANA SET flage='x' WHERE id='".$id."'";
$sql_execute1 = sqlsrv_query($conn,$sql2);

$sql2 = "UPDATE QP7ANTRIANAA SET flage='x' WHERE id='".$id."'";
$sql_execute2 = sqlsrv_query($conn,$sql2);

if ($sql_execute1 && $sql_execute2) {
	echo "<script>
	window.location.href='tablelistantrian.php';
	</script>";
}
?>