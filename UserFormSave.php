<?php
include "koneksi.php";

$frm = explode(";", $_POST['str']);
$id = $_POST['id'];

$sql = "DELETE FROM M_Authorization WHERE User_Id ='".$id."'";
$sql_execute = sqlsrv_query($conn,$sql);

foreach($frm as $val)
{
	if($val != "")
	{
		$sql1 = "INSERT INTO M_Authorization VALUES('".$id."','".$val."','admin',CONVERT(datetime, '".date('Y/m/d H:i:s')."', 120))";	
		$sql_execute1 = sqlsrv_query($conn,$sql1);

		$sql2 = "INSERT INTO M_Authorization VALUES('".$id."','index_main.html','admin','".date('Y/m/d H:i:s')."')";
		$sql_execute2 = sqlsrv_query($conn2,$sql2); 

		$sql2 = "INSERT INTO M_Authorization VALUES('".$id."','ChangePassword.php','admin','".date('Y/m/d H:i:s')."')";
		$sql_execute2 = sqlsrv_query($conn2,$sql2); 
	}
}

echo "Data Berhasil disimpan";
?>