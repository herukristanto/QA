<?php
include "koneksi.php";
date_default_timezone_set("Asia/Bangkok");
if ($kodeindi = $_GET['r1']) {

		$kodeindi           = $_GET['r1'];
    $jumlah             = $_GET['r2'];
    $numerator			 		= $_GET['r3'];
    $denominator        = $_GET['r4'];
    $analisa            = $_GET['r5'];
    $tdklanjut          = $_GET['r6'];

	#get date time current

$date_time 	= date("Y-m-d H:i:s");

	$sql = "INSERT INTO T_Kejadian VALUES('".$analisa."',
																								'".$tdklanjut."',
                                                '".$date_time."',
                                                '".$kodeindi."',
																								'".$numerator."',
																								'".$denominator."',
																								'".$jumlah."'

																							)";


				$result1 = sqlsrv_query($conn,$sql);

				if ( $result1 ) {
						$something = "Submission successful.";
						echo
						"
						<script>
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
    }

?>
