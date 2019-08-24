<?php
include "koneksi.php";
date_default_timezone_set("Asia/Bangkok");
if ($no_lap = $_GET['a1']) {

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

	$sql = "UPDATE T_RCA SET No_lap='".$no_lap."',
															Kronologis='".$kronologis."',
															Obs_tanggal		=	'".$tgl_obs."',
															Obs_jam				=	'".$jam_obs."',
															Obs_hasil			=	'".$hasil_obs."',
															Obs_lap				=	'".$laporan_kejadian."',
															Doc_berkas		=	'".$berkas_RM."',
															Doc_kebijakan	=	'".$kebijakan_prosedur."',
															Doc_staf			=	'".$daftarstaf."',
															Doc_fisik			=	'".$buktifisik."',
															Doc_infor			=	'".$informasi_lain."',
															Wwcr_tgl			=	'".$tgl_waw."',
															Wwcr_jam			=	'".$jam_waw."',
															Wwcr_hasil		=	'".$hasil_waw."',
															keterangan		=	'".$peta_informasi."',
															Iden_mslh			=	'".$masalah."',
															Analisis			=	'".$analisis."',
															Tgl_start			=	'".$tgl_ana1."',
															Tgl_end				=	'".$tgl_ana2."',
															Masalah				=	'".$masalah_utama."',
															Saran					=	'".$saran_rekomendasi."',
															Tanggal_input	=	'".$tgl."',
															Jam_input			=	'".$jam."'
															WHERE No_RCA = '".$no_rca."'";


															$result = sqlsrv_query($conn,$sql) or die(sqlsrv_errors());

															if ( $result ){
																	$something = "Submission successful.";
																			echo
																			"
																	 		<script>
																	 		alert('Data Dengan No. Laporan : ".$no_rca."  Berhasil Update');
																	 		window.location.href='T_RCA_Change.php';
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
