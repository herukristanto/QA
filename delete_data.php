<?php
	include "koneksi.php";

	$id = $_GET['id'];
	
	$bridge = sqlsrv_query($conn,"DELETE FROM Trans_Data WHERE id='$id'");
	
	header('location:PreviewData.php');
?>