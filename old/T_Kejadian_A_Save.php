<?php
include "koneksi.php";
date_default_timezone_set("Asia/Bangkok");

$nolap			= $_GET['nolap'];
$TglTjd			= $_GET['TglTjd'];
$jam_kejadian	= $_GET['jam_kejadian'];
$lokasi			= $_GET['lokasi'];
$no_rm			= $_GET['no_rm'];
$unit 			= $_GET['unit'];
$nolap_unit		= $_GET['nolap_unit'];
$tipe			= $_GET['tipe'];
$indikator		= $_GET['indikator'];
$jenis_insiden	= $_GET['jenis_insiden'];
$tipe_insiden	= $_GET['tipe_insiden'];
$sub_insiden	= $_GET['sub_insiden'];
$kronologi		= $_GET['kronologi'];
$hasil_grading	= $_GET['hasil_grading'];
$simpan			= $_GET['simpan'];


if ($simpan == "ubah"){
	$sql = "Update T_Kejadian_A set Kategori = '".$aspek."', Target = '".$standar."' , Tolak_ukur = '".$tolakukur."'  , Departemen = '".$dept."', Unit = '".$unit_kerja."' , Group_indikator = '".$stat_group."' , Status = '".$statindikator."' , Lap_Kej = '".$statlap."', Numerator = '".$numerator."', Denominator = '".$denominator."' where Kode = '".$kode."'";
	
	$sql_execute = sqlsrv_query($conn,$sql);

	$sql = "select * from M_Indikator where Kode = '".$kode."'";
	$sql_execute = sqlsrv_query($conn,$sql);
	$hasil = sqlsrv_fetch_array($sql_execute, SQLSRV_FETCH_ASSOC);
	
	echo
	"<script>
	alert('Indikator ".$hasil['Kode']." - ".$hasil['Unit']." Berhasil Diubah');
	window.location.href='T_Kejadian_A_Change.php';
	</script>";



} elseif ($simpan == "baru") {

		$query3 = "INSERT INTO T_Kejadian_A VALUES('".$nolap."','".$TglTjd."','".$jam_kejadian."','".$lokasi."','".$no_rm."',
		'".$unit."','".$nolap_unit."','".$tipe."','".$indikator."','".$jenis_insiden."','".$tipe_insiden."','".$sub_insiden."','".$kronologi."','".$hasil_grading."')";

		echo $query3;

		$Sql3 = sqlsrv_query($conn,$query3);
		
				echo
				"<script>
				alert('Kejadian No. ".$nolap." Unit ".$unit." Berhasil Ditambah');
				window.location.href='T_Kejadian_A_Create.php';
				</script>";	

}
				
?>
