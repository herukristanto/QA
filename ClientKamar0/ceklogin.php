<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<?php
session_start();
include "koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];
$idruang = $_POST['idruang'];
$iddokter = $_POST['iddokter'];
$terminal = $_SERVER['REMOTE_ADDR'];

date_default_timezone_set('Asia/Jakarta');
$tgl = DATE('Y M d');

$password = strtoupper($password);
$pwd = 0;
for($i=0;$i<strlen($password);$i++){
	$pwd=$pwd+(ord($password{$i})*(strlen($password)-$i));
}

$query = "SELECT kode FROM QP7LISTDOCTOR WHERE Doctor_Id='".$iddokter."' AND create_date='".$tgl."' AND flagstop is null";
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$sql = sqlsrv_query( $conn, $query , $params, $options );
while($rs = sqlsrv_fetch_array($sql)){
	$kode = $rs['kode'];
}

if (empty($username) || empty($password) || empty($idruang) || empty($iddokter)){
	echo $username;
	echo $password;
	header('Location: login.php');
	exit();
}else{
	$que = "SELECT count (*) as hasil FROM QP7USER WHERE User_Id = '".$username."' AND Password = '".$pwd."'";
	$sql = sqlsrv_query($conn,$que);
	$count = sqlsrv_fetch_array($sql);
	$hasil = $count["hasil"];
	$user = strip_tags($_POST['username']);
	if($hasil > 0) {
		$_SESSION["username"]= $username;
		$_SESSION["idruang"]= $idruang;
		$_SESSION["iddokter"]= $iddokter;
		$query = "SELECT * FROM QP7STATUSRUANG WHERE Id_Ruang='".$idruang."' AND kode='".$kode."' AND tgl_antrian='".$tgl."' AND terminal=''";
		$params = array();
		$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$sql = sqlsrv_query( $conn, $query , $params, $options );
		$row_count = sqlsrv_num_rows( $sql );
		if ($row_count == 0) {
			$sql = "INSERT INTO QP7STATUSRUANG(Id_Ruang, Status, terminal, tgl_antrian, kode) VALUES('".$idruang."','0','".$terminal."','".$tgl."','".$kode."')";
			$sql_execute = sqlsrv_query($conn,$sql);
			// echo $sql;
			// echo "<script>alert('Created');</script>";
			header('location:clientkamar.php');
		} else {
			$sql = "UPDATE QP7STATUSRUANG SET terminal = '".$terminal."' WHERE Id_Ruang='".$idruang."' AND tgl_antrian='".$tgl."' AND kode='".$kode."'";
			$sql_execute = sqlsrv_query($conn,$sql);
			// echo $sql;
			// echo "<script>alert('Updated');</script>";
			header('location:clientkamar.php');
		}
	}
	else{
		header('Location: login.php');
		exit();	
	}
}
?>