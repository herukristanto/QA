<?php 

include "koneksi.php";

$field = $_POST['field'];
$value = $_POST['value'];
$editid = $_POST['id'];
				
				$query5 = "INSERT INTO Trans_Data_X WHERE id=".$editid);
				
				$Sql5 = sqlsrv_query($conn,$query5);
				
				//$bridge_X = sqlsrv_query($conn,"UPDATE Trans_Data_X SET ".$field."='".$value."' WHERE id=".$editid);
				
				//$querytdata = "INSERT INTO Trans_Data_X VALUES(".$field."='".$value."')";
				
				//$sqltdata = sqlsrv_query($conn,$querytdata);

echo 1;

?>
