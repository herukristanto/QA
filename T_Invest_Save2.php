<?php
include "koneksi.php";
date_default_timezone_set("Asia/Bangkok");

		$no_lap              = $_GET['a1'];

    $no_rca              = $_GET['te1'];
    $kronologis			 		 = $_GET['te2'];
    $TglObs              = $_GET['te3'];
    $jam_obs             = $_GET['te4'];
    $hasil_obs           = $_GET['te5'];
    $laporan_kejadian    = $_GET['te6'];
    $berkas_RM           = $_GET['te7'];
    $kebijakan_prosedur  = $_GET['te8'];
    $daftarstaf          = $_GET['te9'];
    $buktifisik          = $_GET['te10'];
    $informasi_lain      = $_GET['te11'];
    $TglWaw              = $_GET['te12'];
    $jam_waw             = $_GET['te13'];
    $hasil_waw           = $_GET['te14'];
    $peta_informasi      = $_GET['te15'];
    $masalah             = $_GET['te16'];
    $analisis            = $_GET['te17'];
    $TglAna1             = $_GET['te18'];
    $TglAna2             = $_GET['te19'];
    $masalah_utama       = $_GET['te20'];
    $saran_rekomendasi   = $_GET['te21'];


	#get date time current

	$tgl 			= date("Y-m-d");
	$jam			= date("H:i:s");

	$tgl_obs		= substr($TglObs,6,4)."-".substr($TglObs,3,2)."-".substr($TglObs,0,2);
	$tgl_waw		= substr($TglWaw,6,4)."-".substr($TglWaw,3,2)."-".substr($TglWaw,0,2);

	$tgl_ana1		= substr($TglAna1,6,4)."-".substr($TglAna1,3,2)."-".substr($TglAna1,0,2);
	$tgl_ana2		= substr($TglAna2,6,4)."-".substr($TglAna2,3,2)."-".substr($TglAna2,0,2);


	$tsql2 = "insert into T_RCA values('".$no_rca."',
																								'".$no_lap."',
																								'".$kronologis."',
																								'".$tgl_obs."',
																								'".$jam_obs."',
																								'".$hasil_obs."',
																								'".$laporan_kejadian."',
																								'".$berkas_RM."',
																								'".$kebijakan_prosedur."',
																								'".$daftarstaf."',
																								'".$buktifisik."',
																								'".$informasi_lain."',
																								'".$tgl_waw."',
																								'".$jam_waw."',
																								'".$hasil_waw."',
																								'".$peta_informasi."',
																								'".$masalah."',
																								'".$analisis."',
																								'".$tgl_ana1."',
																								'".$tgl_ana2."',
																								'".$masalah_utama."',
																								'".$saran_rekomendasi."',
																								'".$tgl."',
																								'".$jam."'
																							)";



				$result1 = sqlsrv_query($conn,$tsql2);



				if ( $result1 ) {
						$something = "Submission successful.";
						echo
						"
						<script>
						alert('Data Dengan No. Laporan : ".$no_invest."  Berhasil Ditambah');
						window.location.href='T_Invest_Create.php';
						</script>";
				}else {
						 $something = "Submission unsuccessful.";
						 die( print_r( sqlsrv_errors(), true));
				}
				$output=$something;
				/* Free statement and connection resources. */
				sqlsrv_free_stmt( $result1);
				sqlsrv_close( $conn);

?>
