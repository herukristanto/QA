<?php
/* server sql pake IP */
$serverName = "182.168.0.116";//RSPIKSQ1
//$serverName = "182.168.0.6";//RSPIKMW
//$serverName = "182.168.192.14";//IS-5
//$serverName = "127.0.0.1";//Rumah
$connectionInfo = array( "Database"=>"QA","UID"=>"sa","PWD"=>"w@tch9u@rd");

/* koneksi ke database. */
$conn = sqlsrv_connect( $serverName, $connectionInfo);
if( $conn === false )
{
     echo "Koneksi Gagal</br>";
     die( print_r( sqlsrv_errors(), true));
}

/* server sql pake IP */
//$serverName = "182.168.0.11";//RSPIKSQL
//$serverName = "182.168.0.6";//RSPIKMW
//$serverName = "182.168.192.14";//IS-5
//$serverName = "127.0.0.1";//Rumah
$connectionInfo = array( "Database"=>"QA","UID"=>"sa","PWD"=>"w@tch9u@rd");

/* koneksi ke database. */
$conn1 = sqlsrv_connect( $serverName, $connectionInfo);
if( $conn1 === false )
{
     echo "Koneksi Gagal</br>";
     die( print_r( sqlsrv_errors(), true));
}

/* server sql pake IP */
//$serverName = "182.168.0.11";//RSPIKSQL
//$serverName = "182.168.0.6";//RSPIKMW
//$serverName = "182.168.192.14";//IS-5
//$serverName = "127.0.0.1";//Rumah
$connectionInfo = array( "Database"=>"QA","UID"=>"sa","PWD"=>"w@tch9u@rd");

/* koneksi ke database. */
$conn2 = sqlsrv_connect( $serverName, $connectionInfo);
if( $conn2 === false )
{
     echo "Koneksi Gagal</br>";
     die( print_r( sqlsrv_errors(), true));
}

/* server sql pake IP */
//$serverName = "182.168.0.11";//RSPIKSQL
//$serverName = "182.168.0.6";//RSPIKMW
//$serverName = "182.168.192.14";//IS-5
//$serverName = "127.0.0.1";//Rumah
$connectionInfo = array( "Database"=>"QA","UID"=>"sa","PWD"=>"w@tch9u@rd");

/* koneksi ke database. */
$conn3 = sqlsrv_connect( $serverName, $connectionInfo);
if( $conn3 === false )
{
     echo "Koneksi Gagal</br>";
     die( print_r( sqlsrv_errors(), true));
}

/* server sql pake IP */
//$serverName = "182.168.0.11";//RSPIKSQL
//$serverName = "182.168.0.6";//RSPIKMW
//$serverName = "182.168.192.14";//IS-5
//$serverName = "127.0.0.1";//Rumah
$connectionInfo = array( "Database"=>"QA","UID"=>"sa","PWD"=>"w@tch9u@rd");

/* koneksi ke database. */
$conn4 = sqlsrv_connect( $serverName, $connectionInfo);
if( $conn4 === false )
{
     echo "Koneksi Gagal</br>";
     die( print_r( sqlsrv_errors(), true));
}
?>
