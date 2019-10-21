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

	$indikator =   LEFT( $kodeindi , 7);

	$sql = "INSERT INTO T_Kejadian VALUES('".$analisa."',
																								'".$tdklanjut."',
                                                '".$date_time."',
                                                '".$kodeindi."',
																								'".$numerator."',
																								'".$denominator."',
																								'".$jumlah."'

																							)";


				$result1 = sqlsrv_query($conn,$sql);

				if($result1){

					$something = "Submission successful.";
					header("location:R_Report_indikator.php?success");
				}else{
					header("location:R_Report_indikator.php?failed");
				}

    }

?>
