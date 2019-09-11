<?php
include "koneksi.php";
date_default_timezone_set("Asia/Bangkok");

		$kodeindi   = $_GET['r1'];
    $jmlh       = $_GET['r2'];
    $numtor     = $_GET['r3'];
    $dentor     = $_GET['r4'];
    $analis     = $_GET['r5'];
    $tndklanjt  = $_GET['r6'];

  	$tgl 			= date("Y-m-d H:i:s");
  	$jam			= date("H:i:s");

	$tsql1 = "insert into T_Kejadian values('".$analis."',
                                          '".$tndklanjt."',
                                          '".$tgl."',
                                          '".$kodeindi."',
                                          '".$numtor."',
                                          '".$dentor."',
                                          '".$jmlh."'
																							)";



				$result1 = sqlsrv_query($conn,$tsql1);

				if ( $result1 ) {
						$something = "Submission successful.";
						echo
						"
						<script>
						alert('Data Dengan No. Laporan : ".$kodeindi."  Berhasil Ditambah');
						window.location.href='R_Report_indikator.php';
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
