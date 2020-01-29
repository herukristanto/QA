<?php
session_start();
include "koneksi.php";

$idruang = $_GET['idruang'];
$id = $_GET['id'];

$sql = "UPDATE QP7ANTRIANA SET flage='' WHERE Id='".$id."';";
$sql_execute = sqlsrv_query($conn,$sql);

$sql = "UPDATE QP7ANTRIANAA SET flage='' WHERE Id='".$id."';";
$sql_execute = sqlsrv_query($conn,$sql);

echo "<script>
window.location.href='antrian1bc.php?idruang=".$idruang."';
</script>";

?>