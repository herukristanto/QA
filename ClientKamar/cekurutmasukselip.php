<?php
include "koneksi.php";

$id = $_GET['id'];

$sql1 = "DELETE FROM QP7ANTRIANA WHERE id=".$id;
$sql_execute1 = sqlsrv_query($conn1,$sql1);

$sql2 = "DELETE FROM QP7ANTRIANAA WHERE id=".$id;
$sql_execute2 = sqlsrv_query($conn2,$sql2);

$sql3 = "UPDATE QP7ANTRIAN SET status='5' WHERE id=".$id;
$sql_execute3 = sqlsrv_query($conn3,$sql3);

echo "<script>
window.location.href='tablelistantrian.php';
</script>";
?>