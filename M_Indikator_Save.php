<?php
include "koneksi.php";
date_default_timezone_set("Asia/Bangkok");

$kode			= $_GET['kode'];
$aspek			= $_GET['aspek'];
$standar		= $_GET['standar'];
$tolakukur		= $_GET['tolakukur'];
$dept			= $_GET['departemen'];
$unit_kerja		= $_GET['unit'];

$statlap		= $_GET['statlap'];
$stat_group		= $_GET['stat_group'];
$statnum		= $_GET['statnum'];
$statden		= $_GET['statden'];
// $numerator		= $_GET['numerator'];
// $denominator	= $_GET['denominator'];
$statindikator	= $_GET['statindikator'];
$simpan			= $_GET['simpan'];


if ($simpan == "ubah"){
	$sql = "Update M_Indikator set Kategori = '".$aspek."', Target = '".$standar."' , Tolak_ukur = '".$tolakukur."'  , Departemen = '".$dept."', Unit = '".$unit_kerja."' , Group_indikator = '".$stat_group."' , Status = '".$statindikator."' , Lap_Kej = '".$statlap."', Numerator = '".$statnum."', Denominator = '".$statden."' where Kode = '".$kode."'";
	
	$sql_execute = sqlsrv_query($conn,$sql);

	$sql = "select * from M_Indikator where Kode = '".$kode."'";
	$sql_execute = sqlsrv_query($conn,$sql);
	$hasil = sqlsrv_fetch_array($sql_execute, SQLSRV_FETCH_ASSOC);
	
	echo
	"<script>
	alert('Indikator ".$hasil['Kode']." - ".$hasil['Unit']." Berhasil Diubah');
	window.location.href='M_Indikator_Change.php';
	</script>";



} elseif ($simpan == "baru") {

		$query3 = "INSERT INTO M_Indikator VALUES('".$kode."','".$standar."','".$dept."','".$unit_kerja."','".$stat_group."','".$statindikator."','".$statlap."','".$tolakukur."','".$statnum."','".$statden."','".$aspek."')";

		echo $query3;

		$Sql3 = sqlsrv_query($conn,$query3);
		
				echo
				"<script>
				alert('Indikator ".$kode." Unit ".$unit_kerja." Berhasil Ditambah');
				window.location.href='M_Indikator_Create.php';
				</script>";	

}
				
?>
