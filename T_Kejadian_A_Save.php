
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
		 $tipe_lain			= $_POST['tipe_lain'];
		 $cedera_lain		= $_POST['cedera_lain'];
		 $created_by		= $_POST['user'];

		 echo $created_by;

		 $kd_indikator			= substr($indikator,0,7);

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
			$pas_cedera			= $_POST['cedera'];
			$pas_mengetahui			= $_POST['pasien_mengetahui'];
			$hasil			= $_POST['hasil'];

			$tanggal 	= date("Y-m-d");
			$jam 			= date("H:i:s");

			$tsql = "insert into T_Kejadian_a values('".$nolap."',
														'".$DateTjd."',
														'".$jam_kejadian."',
														'".$lokasi."',
														'".$no_rm."',
														'".$unit."',
														'".$nolap_unit."',
														'".$radiolayanan."',
														'".$radiocedera."',
														'".$kd_indikator."',
														'".$jenis_insiden."',
														'".$tipe_insiden."',
														'".$sub_tipe."',
														'".$kronologi."',
														'".$radioKlinis."',
														'".$radioProb."',
														'".$hasil_grading."',
														'".$kej_terjadi."',
														'".$pas_cedera."',
														'".$pas_mengetahui."',
														'".$hasil."',
														'".$tanggal."',
														'".$jam."',
														'".$tipe_lain."',
														'".$cedera_lain."',
														'',
														'".$created_by."'
														)";

					$result = sqlsrv_query( $conn, $tsql);

					if ( $result )
					{
					    $something = "Submission successful.";
							echo
							"
					 		<script>
					 		alert('Data Dengan No. Laporan : ".$nolap."  Berhasil Ditambah');
					 		window.location.href='T_Kejadian_A_Create.php';
					 		</script>";
					}
					else
					{
					     $something = "Submission unsuccessful.";
					     die( print_r( sqlsrv_errors(), true));
					}
					$output=$something;
					/* Free statement and connection resources. */
					sqlsrv_free_stmt( $result);
					sqlsrv_close( $conn);
				}
				?>
