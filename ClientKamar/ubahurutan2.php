<?php
include "koneksi.php";

$TData = $_POST['myData'];
foreach($TData as $row) {
	$urutanbaru = $row[0] + 1;
	$sql = "UPDATE QP7ANTRIANA SET Urutan=".$urutanbaru." WHERE id='".$row[1]."'";
	$sql_execute = sqlsrv_query($conn,$sql);
	$sql = "UPDATE QP7ANTRIANAA SET Urutan=".$urutanbaru." WHERE id='".$row[1]."'";
	$sql_execute = sqlsrv_query($conn,$sql);
}
?>