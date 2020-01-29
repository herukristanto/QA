<?php
include "koneksi.php";

$id = $_GET['id'];

$sql1 = "UPDATE QP7ANTRIANA SET selip='x' WHERE id='".$id."'";
$sql_execute1 = sqlsrv_query($conn1,$sql1);

$sql2 = "UPDATE QP7ANTRIANAA SET selip='x' WHERE id='".$id."'";
$sql_execute2 = sqlsrv_query($conn2,$sql2);

echo "<script>
window.location.href='tablelistantrian.php';
</script>";
?>