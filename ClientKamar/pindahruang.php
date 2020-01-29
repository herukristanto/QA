<meta http-equiv="Content-type" content="text/html;charset=UTF-8">
<?php

include "koneksi.php";

$idruang = $_GET['idruang'];
$status = $_GET['status'];
$kode = $_GET['kode'];

date_default_timezone_set('Asia/Jakarta');
$tgl = DATE('Y M d');

$sql = "UPDATE QP7STATUSRUANG SET Status=0, terminal='' WHERE Id_Ruang='".$idruang."' AND tgl_antrian='".$tgl."' AND kode='".$kode."';";
$sql_execute = sqlsrv_query($conn,$sql);
echo "<script>
parent.window.location.href='login.php';
</script>";
?>