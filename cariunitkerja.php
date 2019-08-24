<?php
include "koneksi.php";
if(isset($_GET['depart']))
	{
		$depart = $_GET['depart'];
	}



//$que = "SELECT Kode, Deskripsi FROM M_Unit WHERE Departemen like '%".$depart."%' AND Status ='X'";
$que = "SELECT Kode, Deskripsi, Status FROM M_Unit WHERE Departemen like '%".$depart."%'";
$sql = sqlsrv_query($conn,$que);

echo "<select name='unitkerja' id='unitkerja'>
<option></option>";

while($hasil = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC)){
	echo "<option value='".$hasil['Deskripsi']."'>".$hasil['Deskripsi']."</option>";
}

echo "</select>";
echo "<script>change2();</script>"
?>
