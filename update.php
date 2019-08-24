<?php 

include "koneksi.php";

$field = $_POST['field'];
$value = $_POST['value'];
$editid = $_POST['id'];

 	#get date time current
	date_default_timezone_set("Asia/Jakarta"); 
	$date = date('Y-m-d H:i:s');
	
	$tgl = date('Y-m-d');
	
	$waktu = substr($date,11,8);

				$bridge = sqlsrv_query($conn,"UPDATE Trans_Data SET ".$field."='".$value."' WHERE id=".$editid);
				
				//$bridge_date = sqlsrv_query($conn,"UPDATE Trans_Data_X SET Tgl='".$tgl."' WHERE id=".$editid);
				
				//$query5 = "INSERT INTO Trans_Data_X VALUE ".$field."='".$value."' WHERE id=".$editid);
				
				//$Sql5 = sqlsrv_query($conn,$query5);
				
				//$query5 = "INSERT INTO Trans_Data_X (".$field.")
				//SELECT ".$field."
				//FROM Trans_Data
				//WHERE id=".$editid;
				
				//$Sql5 = sqlsrv_query($conn,$query5);
				
				//DELETE FROM Table1
				//WHERE <condition>;
				
				//COMMIT;
				
				//$query5 = "INSERT INTO Trans_Data_X SELECT * FROM Trans_Data WHERE id=".$editid);
				
				//$Sql5 = sqlsrv_query($conn,$query5);
				
				//$bridge_X = sqlsrv_query($conn,"UPDATE Trans_Data_X SET ".$field."='".$value."' WHERE id=".$editid);
				
				//$querytdata = "INSERT INTO Trans_Data_X VALUES(".$field."='".$value."')";
				
				//$sqltdata = sqlsrv_query($conn,$querytdata);

echo 1;
