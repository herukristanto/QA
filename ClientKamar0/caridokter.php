<?php
include "koneksi.php";
if(isset($_GET['idruang']))
	{
		$idruang = $_GET['idruang'];
	}

echo "<select name='iddokter'>
<option></option>";

date_default_timezone_set('Asia/Jakarta');
$date = DATE('Y-m-d');

$que = "SELECT * FROM V_CariDokter WHERE Id_Ruang like '".$idruang."' AND selesai_praktek='00:00:00' AND create_date='".$date."'";
$sql = sqlsrv_query($conn,$que);

while($hasil = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC)){
	echo "<option value='".$hasil['Doctor_Id']."'>".$hasil['Name']."</option>";
}

echo "</select>";
?>
