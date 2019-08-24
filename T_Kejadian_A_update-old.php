<?php
include "koneksi.php";
date_default_timezone_set("Asia/Bangkok");

$no_lap		= $_GET['no_lap'];
$tgl_kejadian		= $_GET['tgl_kejadian'];
$jam_kejadian	= $_GET['jam_kejadian'];
$lokasi	= $_GET['lokasi'];
$no_rm		= $_GET['no_rm'];
$kode_u		= $_GET['kode_u'];
$no_lap_1		= $_GET['no_lap_1'];
$tipe_layanan	= $_GET['tipe_layanan'];
$tingkat_cidera	= $_GET['tingkat_cidera'];
$kode_indikator		= $_GET['kode_indikator'];
$kode_insiden		= $_GET['kode_insiden'];
$tipe_insiden		= $_GET['tipe_insiden'];
$kode_sub	= $_GET['kode_sub'];
$kronologis	= $_GET['kronologis'];
$skor_dampak		= $_GET['skor_dampak'];
$skor_prob		= $_GET['skor_prob'];
$hasil_grading		= $_GET['hasil_grading'];

$kjd_terjadi	= $_GET['kjd_terjadi'];
$pasien_tahu	= $_GET['pasien_tahu'];
$cedera		= $_GET['cedera'];
$hasil		= $_GET['hasil'];

$simpan			= $_GET['simpan'];


if ($simpan == "ubah"){
	$sql = "UPDATE T_Kejadian_a SET lokasi = '".$lokasi."', tgl_kejadian = '".$tgl_kejadian."' , jam_kejadian = '".$jam_kejadian."' , no_rm = '".$no_rm."' , kode_u = '".$kode_u."' , no_lap_1 = '".$no_lap_1."',
	tipe_layanan = '".$tipe_layanan."', tingkat_cidera = '".$tingkat_cidera."', kode_indikator = '".$kode_indikator."'  , kode_insiden = '".$kode_insiden."'  , tipe_insiden = '".$tipe_insiden."',
	kode_sub = '".$kode_sub."', kronologis = '".$kronologis."' , skor_dampak = '".$skor_dampak."' , skor_prob = '".$skor_prob."' , hasil_grading = '".$hasil_grading."'  , kjd_terjadi = '".$kjd_terjadi."',
	pasien_tahu = '".$pasien_tahu."' , cedera = '".$cedera."', hasil = '".$hasil."' WHERE no_lap = '".$no_lap."'";

	$result = sqlsrv_query($conn,$sql) or die(sqlsrv_errors());

	echo $result;

}
?>
