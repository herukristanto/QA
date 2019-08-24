<?php
	//$connection = new mysqli('localhost', 'root', '', 'blood_bank');
	
$serverName = "182.168.0.116";//RSPIKSQ1

$connectionInfo = array( "Database"=>"QA","UID"=>"sa","PWD"=>"w@tch9u@rd");

/* koneksi ke database. */
$conn = sqlsrv_connect( $serverName, $connectionInfo);
if( $conn === false )
{
     echo "Koneksi Gagal</br>";
     die( print_r( sqlsrv_errors(), true));
}
?>