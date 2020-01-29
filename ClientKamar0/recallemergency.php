<?php
include "koneksi.php";

session_start();
$idruang = $_SESSION['idruang'];
$iddokter = $_SESSION['iddokter'];

$id = $_GET['id'];
$isinya = $_GET['isinya'];

if ($isinya=='y') {
	$selip = 1;
} else {
	$selip = 0;
}

$urutan = $selip + 1;

$query = "SELECT nomor_antrian FROM QP7ANTRIAN WHERE id like '".$id."'";
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$sql = sqlsrv_query( $conn, $query , $params, $options );
while($rs = sqlsrv_fetch_array($sql)){
	$nomor = $rs['nomor_antrian'];
}

$sql = "UPDATE QP7ANTRIAN SET Status='3' WHERE id='".$id."'";
$sql_execute = sqlsrv_query($conn,$sql);

$sql = "INSERT INTO QP7ANTRIANA VALUES(".$urutan.",'".$id."','".$idruang."','".$nomor."','x','y','y','x');";
$sql_execute = sqlsrv_query($conn,$sql);

$sql = "INSERT INTO QP7ANTRIANAA VALUES(".$urutan.",'".$id."','".$idruang."','".$nomor."','x','y','y','x');";
$sql_execute = sqlsrv_query($conn,$sql);

echo "<script>
window.location.href='emergency.php';
</script>";
?>