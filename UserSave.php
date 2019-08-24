<?php
include "koneksi.php";

$id		= $_GET['id'];
$name	= $_GET['name'];
$dept	= $_GET['dept'];
$unit	= $_GET['unit'];
$status	= $_GET['status'];
$message;

$sql1 = "select count(*) as hasil from M_User where User_Id = '".$id."'";
$sql_execute1 = sqlsrv_query($conn1,$sql1); 
$hasil = sqlsrv_fetch_array($sql_execute1);

if($hasil['hasil'] == 0)
{
	$sql = "insert into M_User(User_Id, Name, Password, Create_By, Create_Time) values('".$id."','".$name."','".$dept."','".$unit."','".$status."','1203','admin',CONVERT(datetime, '".date('Y/m/d H:i:s')."', 120))";
	$message = "User '".$id."' berhasil disimpan";
	$sql_execute = sqlsrv_query($conn,$sql);

	$sql2 = "INSERT INTO M_Authorization VALUES('".$id."','index_main.html','admin','".date('Y/m/d H:i:s')."')";
	$sql_execute2 = sqlsrv_query($conn2,$sql2); 

	$sql2 = "INSERT INTO M_Authorization VALUES('".$id."','changepassword.php','admin','".date('Y/m/d H:i:s')."')";
	$sql_execute2 = sqlsrv_query($conn2,$sql2); 
}
else
{
	$sql = "update M_User set Name = '".$name."' where User_Id = '".$id."'";
	$message = "User berhasil diganti";	
	$sql_execute = sqlsrv_query($conn,$sql);
}

echo '<script>
alert("'.$message.'");
window.location = "UserForm.php"
</script>';
?>