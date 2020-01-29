<?php
include "koneksi.php";

if(isset($_POST['myData'])){
	$TData = $_POST['myData'];
}else{
	$TData = '';
}

$selip = $_POST['selip'];

if ($TData != ''){
	foreach($TData as $row) {
		if ($row[0] > $selip) {
			$urutan = $row[0] + 1;
			$sql = "UPDATE QP7ANTRIANA SET Urutan=".$urutan." WHERE Id='".$row[1]."';";
			$sql_execute = sqlsrv_query($conn,$sql);
			$sql = "UPDATE QP7ANTRIANAA SET Urutan=".$urutan." WHERE Id='".$row[1]."';";
			$sql_execute = sqlsrv_query($conn,$sql);
		}
	}	
}

?>