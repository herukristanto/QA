<?php
$id = $_GET['id'];

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
		
		$NewFileName = $id."-".$tgl."-".$name; 
		
        move_uploaded_file($tmp_name, $direktori."/".$NewFileName);
        
		echo
		"<script>
		alert('File Transaksi ".$id." Berhasil di upload');
		window.location.href='uploadpage.php';
		</script>";
    }
}
?>
