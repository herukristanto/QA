<?php
include "koneksi.php";
date_default_timezone_set("Asia/Bangkok");

		$no_lap              = $_GET['a1'];

    $no_invest           = $_GET['rm1'];
    $penyebab_langsung   = $_GET['rm2'];
    $akar_masalah        = $_GET['rm3'];
    $tindakan            = $_GET['rm4'];
    $penanggung_jawab_1  = $_GET['rm5'];
    $perkiraan_waktu_1   = $_GET['rm6'];
    $rekomendasi         = $_GET['rm7'];
    $penanggung_jawab_2  = $_GET['rm8'];
    $perkiraan_waktu_2   = $_GET['rm9'];
		

	#get date time current

	$wkt1		= substr($perkiraan_waktu_1,6,4)."-".substr($perkiraan_waktu_1,3,2)."-".substr($perkiraan_waktu_1,0,2);
	$wkt2		= substr($perkiraan_waktu_2,6,4)."-".substr($perkiraan_waktu_2,3,2)."-".substr($perkiraan_waktu_2,0,2);



	$tgl 			= date("Y-m-d");
	$jam			= date("H:i:s");

	$tsql1 = "insert into T_Invest values('".$no_invest."',
																								'".$no_lap."',
																								'".$penyebab_langsung."',
																								'".$akar_masalah."',
																								'".$tindakan."',
																								'".$penanggung_jawab_1."',
																								'".$wkt1."',
																								'".$rekomendasi."',
																								'".$penanggung_jawab_2."',
																								'".$wkt2."',
																								'".$tgl."',
																								'".$jam."'
																							)";


				$result1 = sqlsrv_query($conn,$tsql1);

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
