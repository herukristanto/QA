<?php

$kdtranschange = $_GET['kdtranschange'];

#get date time current
date_default_timezone_set("Asia/Jakarta"); 
$date = date('Y-m-d H:i:s');
$tgl = date('Ymd');
$waktu = substr($date,11,8);

$direktori = "./hasilupload";
foreach ($_FILES["fileku"]["error"] as $key => $error) {
    if ($error == UPLOAD_ERR_OK) {
        $tmp_name = $_FILES["fileku"]["tmp_name"][$key];
		
        $name = $_FILES["fileku"]["name"][$key]; 
		
		$NewFileName = $kdtranschange."-".$tgl."-".$name; 
		
        move_uploaded_file($tmp_name, $direktori."/".$NewFileName);
        
		echo
		"<script>
		alert('File Transaksi ".$kdtranschange." Berhasil di upload');
		window.location.href='uploadpage_change.php?kdtranschange=".$kdtranschange."';
		</script>";
		
    }
}
?>
