<meta http-equiv="Content-type" content="text/html;charset=UTF-8">
<?php
$idruang = $_GET['idruang'];
$status = $_GET['status'];
$kode = $_GET['kode'];

include "koneksi.php";
date_default_timezone_set('Asia/Jakarta');
$date = date('Y-m-d H:i:s');
$tgl = DATE('Y M d');

if ($status=="buka") {
	$sql = "UPDATE QP7STATUSRUANG SET Status=1, Jam_Buka_Ruang='".$date."', kode='".$kode."' WHERE Id_Ruang='".$idruang."' AND kode='".$kode."' AND tgl_antrian='".$tgl."';";
	$sql_execute = sqlsrv_query($conn,$sql);
} else {
	$sql = "UPDATE QP7STATUSRUANG SET Status=0, Jam_Tutup_Ruang='".$date."', terminal='' WHERE Id_Ruang='".$idruang."' AND kode='".$kode."' AND tgl_antrian='".$tgl."';";
	$sql_execute = sqlsrv_query($conn,$sql);
	echo "<script>
	parent.window.location.href='clientkamar.php';
	</script>";
}
?>