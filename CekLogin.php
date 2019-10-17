<?php
include "koneksi.php";

//Form Login
$username = $_POST['username'];
$password = $_POST['password'];

//Encrypt_password
$password = strtoupper($password);
$pwd = 0;
for($i=0;$i<strlen($password);$i++){
	$pwd=$pwd+(ord($password{$i})*(strlen($password)-$i));
}

//Cek variabel user dan pass
if (empty($username) || empty($password)){
	echo "
	<script>
		alert('Masukan Username dan Password');
		window.location.href = 'index.html';
	</script>
	";
} else {
	// koneksi data base
	$que = "SELECT count (*) as hasil FROM M_User WHERE User_id = '".$username."' AND Password = '".$pwd."'";
	$sql = sqlsrv_query($conn,$que);
	$count = sqlsrv_fetch_array($sql);
	$hasil = $count["hasil"];
	$user = strip_tags($_POST['username']);
	
	if($hasil > 0) {	// Apabila username dan password di temukan
		session_start();
		$_SESSION["username"] = $user;
		header('location:main.php');
	}
	else {
		echo "
		<script>
			alert('Login Gagal');
			window.location.href = 'index.html';
		</script>
		";
	}
}
?>
