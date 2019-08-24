
<?php
include "koneksi.php";
date_default_timezone_set("Asia/Bangkok");

	 // Check If form submitted, insert form data into users table.

		 $no_invest						= $_GET['rm1'];
		 $no_lap							= $_GET['a1'];
		 $penyebab_langsung		= $_GET['rm2'];
		 $akar_masalah				= $_GET['rm3'];
		 $tindakan						= $_GET['rm4'];
		 $penanggung_jawab_1	= $_GET['rm5'];
		 $perkiraan_waktu_1		= $_GET['rm6'];
		 $rekomendasi					= $_GET['rm7'];
		 $penanggung_jawab_2	= $_GET['rm8'];
		 $perkiraan_waktu_2		= $_GET['rm9'];

		 // echo $no_invest;
		 // echo "<br>";
		 // echo $no_lap;

		 $Date_kira_1	= substr($perkiraan_waktu_1,6,4)."-".substr($perkiraan_waktu_1,3,2)."-".substr($perkiraan_waktu_1,0,2);
		 $Date_kira_2	= substr($perkiraan_waktu_2,6,4)."-".substr($perkiraan_waktu_2,3,2)."-".substr($perkiraan_waktu_2,0,2);

			$tanggal 	= date("Y-m-d");
			$jam 			= date("H:i:s");

			$sql = "UPDATE T_Invest SET Penyebab = '".$penyebab_langsung."', Akar_mslh = '".$akar_masalah."', Pendek = '".$tindakan."', Pj_1 = '".$penanggung_jawab_1."', Waktu_1 = '".$Date_kira_1."' , Panjang = '".$penanggung_jawab_2."', Waktu_2 = '".$Date_kira_2."' WHERE No_invest = '".$no_invest."'";

			$result = sqlsrv_query( $conn, $sql);

			if ( $result ){
					$something = "Submission successful.";
							echo
							"
					 		<script>
					 		alert('Data Invest ".$no_invest." No. Laporan : ".$no_lap."  Berhasil Update');
					 		window.location.href='T_Invest_Change.php';
					 		</script>";
					}else{
					     $something = "Submission unsuccessful.";
					     die( print_r( sqlsrv_errors(), true));
					}
					$output=$something;
					/* Free statement and connection resources. */
					sqlsrv_free_stmt( $result);
					sqlsrv_close( $conn);

			?>
