<?php
include "koneksi.php";
if(isset($_GET['nama']))
	{
		$nama = $_GET['nama'];
	}

echo "<select name='idruang' id='idruang' onchange='change2()'>
<option></option>";

$que = "SELECT id_ruang, nama_ruang FROM QP7Ruang WHERE Nama_Poli like '%".$nama."%'";
$sql = sqlsrv_query($conn,$que);

while($hasil = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC)){
	echo "<option value='".$hasil['id_ruang']."'>".$hasil['nama_ruang']."</option>";
}

echo "</select>";
?>
