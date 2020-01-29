<?php
include "koneksi.php";

$idruang = $_GET['idruang'];
$kode = $_GET['kode'];

$sql = "DELETE FROM QP7LASTANTRIAN WHERE Id_Ruang = '".$idruang."' AND kode = '".$kode."'";
$sql_execute = sqlsrv_query($conn,$sql);

echo "<script>
window.location.href='login.php';
</script>";

?>