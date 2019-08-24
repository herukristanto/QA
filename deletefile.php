<?php

include "koneksi.php";


  	$file = $_GET['file'];
	$kdtrans = $_GET['kode'];
	$data = "items";
	$target = "hasilupload/".$file;
			unlink($target);

	echo "<script>window.location.href='displayupload_delete.php?kdtrans=".$kdtrans."';</script>";

?>
	