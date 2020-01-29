<?php
/* server sql pake IP */
// $serverName = "182.168.0.118";//PRD
$serverName = "182.168.0.116";//RSPIKSQL
//$serverName = "182.168.0.6";//RSPIKMW
//$serverName = "182.168.192.14";//IS-5
//$serverName = "127.0.0.1";//Rumah
$connectionInfo = array("Database"=>"queue_poli","UID"=>"sa","PWD"=>"w@tch9u@rd");
// $connectionInfo = array("Database"=>"queue_poli","UID"=>"pikdb","PWD"=>"0riginPIK");

/* koneksi ke database. */
$conn = sqlsrv_connect( $serverName, $connectionInfo);
if( $conn === false )
{
     echo "Koneksi Gagal</br>";
     die( print_r( sqlsrv_errors(), true));
}


/* koneksi ke database. */
$conn1 = sqlsrv_connect( $serverName, $connectionInfo);
if( $conn1 === false )
{
     echo "Koneksi Gagal</br>";
     die( print_r( sqlsrv_errors(), true));
}


/* koneksi ke database. */
$conn2 = sqlsrv_connect( $serverName, $connectionInfo);
if( $conn2 === false )
{
     echo "Koneksi Gagal</br>";
     die( print_r( sqlsrv_errors(), true));
}



/* koneksi ke database. */
$conn3 = sqlsrv_connect( $serverName, $connectionInfo);
if( $conn3 === false )
{
     echo "Koneksi Gagal</br>";
     die( print_r( sqlsrv_errors(), true));
}



/* koneksi ke database. */
$conn4 = sqlsrv_connect( $serverName, $connectionInfo);
if( $conn4 === false )
{
     echo "Koneksi Gagal</br>";
     die( print_r( sqlsrv_errors(), true));
}

/* koneksi ke database. */
$conn5 = sqlsrv_connect( $serverName, $connectionInfo);
if( $conn5 === false )
{
     echo "Koneksi Gagal</br>";
     die( print_r( sqlsrv_errors(), true));
}
?>
