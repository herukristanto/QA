<?php
include "koneksi.php";
if(isset($_GET['namaunit']))
	{
		$namaunit = $_GET['namaunit'];
		$namaunit = str_replace("|"," ",$namaunit);
	}

$que = "SELECT Kode, Deskripsi, Departemen, Unit_Kerja, Status FROM M_Group WHERE Unit_Kerja like '%".$namaunit."%' AND Status='X'";
$sql = sqlsrv_query($conn,$que);

echo "<select id='namagroup' name='namagroup'>
<option></option>";

while($hasil = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC)){
	echo "<option value='".$hasil['Deskripsi']."'>".$hasil['Deskripsi']."</option>";
}

echo "</select>";
echo "<script>change4();</script>"
?>