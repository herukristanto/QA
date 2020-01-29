<?php
include "koneksi.php";

if(isset($_POST['myData'])){
	$TData = $_POST['myData'];
}else{
	$TData = '';
}

if ($TData != ''){
	foreach($TData as $row) {
		$sql = "UPDATE QP7ANTRIANA SET baru='x' WHERE Id='".$row[1]."';";
		$sql_execute = sqlsrv_query($conn,$sql);

		$sql = "INSERT INTO QP7ANTRIANAA VALUES(".$row[0].",'".$row[1]."','".$row[2]."','".$row[3]."','".$row[4]."','".$row[5]."','".$row[6]."','');";
		$sql_execute = sqlsrv_query($conn,$sql);
	}
}

?>