<?php
include "koneksi.php";
if(isset($_GET['kd_tipe']))
	{
		$kd_tipe = $_GET['kd_tipe'];
	}



//$que = "SELECT Kode, Deskripsi FROM M_Unit WHERE Departemen like '%".$depart."%' AND Status ='X'";
$que = "SELECT Kode, Tipe_insiden, Mark FROM M_Unit WHERE Kode_tipe like '%".$kd_tipe."%'";
$sql = sqlsrv_query($conn,$que);

echo "<select name='tipeinsiden' id='tipeinsiden'>
<option></option>";

while($hasil = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC)){
	echo "<option value='".$hasil['Tipe_insiden']."'>".$hasil['Tipe_insiden']."</option>";
}

echo "</select>";
echo "<script>change2();</script>"
?>
