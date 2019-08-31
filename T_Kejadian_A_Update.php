
<?php
include "koneksi.php";
date_default_timezone_set("Asia/Bangkok");

	 // Check If form submitted, insert form data into users table.
	 if(isset($_GET['Submit'])) {
		 $no_lap				= $_GET['nolap'];
		 $TglTjd				= $_GET['tgl_kejadian'];
		 $jam_kejadian	= $_GET['jam_kejadian'];
		 $lokasi				= $_GET['lokasi'];
		 $no_rm					= $_GET['no_rm'];
		 $unit 					= $_GET['kode_u'];
		 $nolap_unit		= $_GET['no_lap_1'];
		 $radiolayanan	= $_GET['tipe_layanan'];
		 $rawat_lain		= $_GET['rawat_lain'];
		 $radiocedera		= $_GET['tingkat_cidera'];
		 $cedera_lain		= $_GET['cedera_lain'];
		 $indikator			= $_GET['kode_indikator'];
		 $jenis_insiden	= $_GET['kode_insiden'];
		 $tipe_insiden	= $_GET['tipe_insiden'];
		 $sub_tipe			= $_GET['kode_sub'];
		 $kronologi			= $_GET['kronologis'];
		 $radioKlinis		= $_GET['skor_dampak'];
		 $radioProb			= $_GET['skor_prob'];


		 $DateTjd				= substr($TglTjd,6,4)."-".substr($TglTjd,3,2)."-".substr($TglTjd,0,2);

		 if ($radioKlinis == 5 && $radioProb == 5) {
			 $hasil_grading = "Ekstrim";
		 }else if($radioKlinis == 5 && $radioProb == 4){
			 $hasil_grading = "Ekstrim";
		 }else if($radioKlinis == 5 && $radioProb == 3){
			 $hasil_grading = "Ekstrim";
		 }else if($radioKlinis == 5 && $radioProb == 2){
			 $hasil_grading = "Ekstrim";
		 }else if($radioKlinis == 5 && $radioProb == 1){
			 $hasil_grading = "Ekstrim";
		 }else if($radioKlinis == 4 && $radioProb == 5){
			 $hasil_grading = "Ekstrim";
		 }else if($radioKlinis == 4 && $radioProb == 4){
			 $hasil_grading = "Ekstrim";
		 }else if($radioKlinis == 4 && $radioProb == 3){
			 $hasil_grading = "Ekstrim";
		 }else if($radioKlinis == 4 && $radioProb == 2){
			 $hasil_grading = "Tinggi";
		 }else if($radioKlinis == 4 && $radioProb == 1){
			 $hasil_grading = "Tinggi";
		 }else if($radioKlinis == 3 && $radioProb == 5){
			 $hasil_grading = "Tinggi";
		 }else if($radioKlinis == 3 && $radioProb == 4){
			 $hasil_grading = "Tinggi";
		 }else if($radioKlinis == 3 && $radioProb == 3){
			 $hasil_grading = "Tinggi";
		 }else if($radioKlinis == 3 && $radioProb == 2){
			 $hasil_grading = "Moderat";
		 }else if($radioKlinis == 3 && $radioProb == 1){
			 $hasil_grading = "Moderat";
		 }else if($radioKlinis == 2 && $radioProb == 5){
			 $hasil_grading = "Moderat";
		 }else if($radioKlinis == 2 && $radioProb == 4){
			 $hasil_grading = "Moderat";
		 }else if($radioKlinis == 2 && $radioProb == 3){
			 $hasil_grading = "Moderat";
		 }else if($radioKlinis == 2 && $radioProb == 2){
			 $hasil_grading = "Rendah";
		 }else if($radioKlinis == 2 && $radioProb == 1){
			 $hasil_grading = "Rendah";
		 }else if($radioKlinis == 1 && $radioProb == 5){
			 $hasil_grading = "Moderat";
		 }else if($radioKlinis == 1 && $radioProb == 4){
			 $hasil_grading = "Moderat";
		 }else if($radioKlinis == 1 && $radioProb == 3){
			 $hasil_grading = "Rendah";
		 }else if($radioKlinis == 1 && $radioProb == 2){
			 $hasil_grading = "Rendah";
		 }else if($radioKlinis == 1 && $radioProb == 1){
			 $hasil_grading = "Rendah";
		 }

			$hasil_grading;
			$kej_terjadi			= $_GET['kejadian_terjadi'];
			$pas_cedera				= $_GET['cedera'];
			$pas_mengetahui		= $_GET['pasien_mengetahui'];
			$hasil						= $_GET['hasil'];

			$tanggal 					= date("Y-m-d");
			$jam 							= date("H:i:s");

			$sql = "UPDATE T_Kejadian_a SET lokasi = '".$lokasi."',

			tgl_kejadian = '".$DateTjd."',
			jam_kejadian = '".$jam_kejadian."',
			no_rm = '".$no_rm."',
			kode_u = '".$unit."' ,
			no_lap_1 = '".$nolap_unit."' ,
			tipe_layanan = '".$radiolayanan."' ,
			tingkat_cidera = '".$radiocedera."',
			kode_indikator = '".$indikator."',
			kode_insiden = '".$jenis_insiden."',
			tipe_insiden = '".$tipe_insiden."',
			kode_sub = '".$sub_tipe."',
			kronologis = '".$kronologi."',
			skor_dampak = '".$radioKlinis."',
			skor_prob = '".$radioProb."',
			hasil_skor = '".$hasil_grading."',
			kejadian_terjadi = '".$kej_terjadi."',
			pasien_mengetahui = '".$pas_mengetahui."',
			cedera = '".$pas_cedera."',
			rawat_lain = '".$rawat_lain."',
			cedera_lain = '".$cedera_lain."',
			hasil = '".$hasil."' WHERE no_lap = '".$no_lap."'";

			$result = sqlsrv_query( $conn, $sql);

			if ( $result ){
					$something = "Submission successful.";
							echo"
					 		<script>
					 		alert('Data No. Laporan : ".$no_lap."  Berhasil Update');
					 		window.location.href='T_Kejadian_A_Change.php';
					 		</script>";
					}else{
					     $something = "Submission unsuccessful.";
					     die( print_r( sqlsrv_errors(), true));
					}
					$output=$something;
					/* Free statement and connection resources. */
					sqlsrv_free_stmt( $result);
					sqlsrv_close( $conn);
			}
			?>
