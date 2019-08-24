<?php

include "koneksi.php";

$filename = $_GET['filename'];
// set this to the path where your zipped files are located
$filepath = "./hasilupload" . $filename;
// a little security
if(strpos($filename, '..') !== false || realpath($filepath) != $filepath) die();
if (file_exists($filepath)){
    // make sure the browser knows what it's getting, and what to do with it
    header('Cache-Control: public');
    header('Content-Type: application/pdf');
	header('Content-Transfer-Encoding: binary');
    header('Content-Disposition: inline; filename=' . $filename);
    header('Accept-Ranges: bytes'); 
	readfile($filepath);
	//ob_clean();
    //flush();
    die(); 
} else {
    die('Error: File not found.');
}

?>