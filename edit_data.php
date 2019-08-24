<?php
	include "koneksi.php";

	$id = $_POST['id'];
	$jml = $_POST['jml'];
	$analisa = $_POST['analisa'];
	$tindaklanjut = $_POST['tindaklanjut'];
	
//	echo $id;
//	echo "<br>";
//	echo $jml;
//	echo "<br>";
//	echo $analisa;
//	echo "<br>";
//	echo $tindaklanjut;
//	echo "<br>";
	
	//$update = sqlsrv_query($conn,"UPDATE M_Departemen SET Kode = '".$kode."', Dept = '".$Dept."', mark = '".$rb."' WHERE id = '".$id."'");

	//header('location:PreviewData.php');

$field = $_POST['field'];
$value = $_POST['value'];
$editid = $_POST['id'];

$update = sqlsrv_query($conn,"UPDATE Trans_Data SET WHERE id = '".$editid."'");
//$query = "UPDATE users SET ".$field."='".$value."' WHERE id=".$editid;
//mysqli_query($con,$query);

?>