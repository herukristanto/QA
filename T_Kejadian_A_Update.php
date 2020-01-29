
<?php
include "koneksi.php";
date_default_timezone_set("Asia/Bangkok");

	 // Check If form submitted, insert form data into users table.
	 if(isset($_POST['Submit'])) {
		 $nolap					= $_POST['nolap'];
		 $TglTjd				= $_POST['TglTjd'];
		 $jam_kejadian	= $_POST['jam_kejadian'];
		 $lokasi				= $_POST['lokasi'];
		 $no_rm					= $_POST['no_rm'];
		 $unit 					= $_POST['unit_kerja'];
		 $nolap_unit		= $_POST['nolap_unit'];
		 $radiolayanan	= $_POST['radiolayanan'];
		 $radiocedera		= $_POST['radiocedera'];
		 $indikator			= $_POST['indikator'];
		 $jenis_insiden	= $_POST['jenis_insiden'];
		 $tipe_insiden	= $_POST['tipe_insiden'];
		 $sub_tipe			= $_POST['sub_tipe'];
		 $kronologi			= $_POST['kronologi'];
		 $radioKlinis		= $_POST['radioKlinis'];
		 $radioProb			= $_POST['radioProbabilitas'];
		 // $created_by		= "admin";
		 // $tipe_lain			= "kosong";
		 // $cedera_lain		= "kosong";
		 // $flag		= "kosong";
		 // $created_by		= $_POST['user'];
		 // $created_by		= "admin";

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

			$kej_terjadi			= $_POST['kejadian_terjadi'];
			$pas_cedera				= $_POST['cedera'];
			$pas_mengetahui		= $_POST['pasien_mengetahui'];
			$hasil						= $_POST['hasil'];

			$tanggal 					= date("d-m-Y");
			$jam 							= date("H:i:s");
//28
			$sql = "UPDATE T_Kejadian_a SET
			tgl_kejadian = '".$DateTjd."',
			jam_kejadian = '".$jam_kejadian."',
			lokasi = '".$lokasi."',
			no_rm = '".$no_rm."',
			kode_u = '".$unit."',
			no_lap_1 = '".$nolap_unit."',
			tipe_layanan = '".$radiolayanan."',
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
			cedera = '".$pas_cedera."',
			pasien_mengetahui = '".$pas_mengetahui."',
			hasil = '".$hasil."'


			WHERE no_lap = '".$nolap."'";

			// echo "$sql";
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
