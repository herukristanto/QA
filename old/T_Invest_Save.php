<?php
include "koneksi.php";

	$no_lap              = $_GET['no_lap'];
	$hasil_skor			 = $_GET['hasil_skor'];
    $no_invest           = $_GET['no_invest'];
    $penyebab_langsung   = $_GET['penyebab_langsung'];
    $akar_masalah        = $_GET['akar_masalah'];
    $tindakan            = $_GET['tindakan'];
    $penanggung_jawab_1  = $_GET['penanggung_jawab_1'];
    $perkiraan_waktu_1   = $_GET['perkiraan_waktu_1'];
    $rekomendasi         = $_GET['rekomendasi'];
    $penanggung_jawab_2  = $_GET['penanggung_jawab_2'];
    $perkiraan_waktu_2   = $_GET['perkiraan_waktu_2'];
    $no_rca              = $_GET['no_rca'];
    $kronologis			 = $_GET['kronologis'];
    $TglObs              = $_GET['TglObs'];
    $jam_obs             = $_GET['jam_obs'];
    $hasil_obs           = $_GET['hasil_obs'];
    $laporan_kejadian    = $_GET['laporan_kejadian'];
    $berkas_RM           = $_GET['berkas_RM'];
    $kebijakan_prosedur  = $_GET['kebijakan_prosedur'];
    $daftarstaf          = $_GET['daftarstaf'];
    $buktifisik          = $_GET['buktifisik'];
    $informasi_lain      = $_GET['informasi_lain'];
    $TglWaw              = $_GET['TglWaw'];
    $jam_waw             = $_GET['jam_waw'];
    $hasil_waw           = $_GET['hasil_waw'];
    $peta_informasi      = $_GET['peta_informasi'];
    $masalah             = $_GET['masalah'];
    $analisis            = $_GET['analisis'];
    $TglAna1             = $_GET['TglAna1'];
    $TglAna2             = $_GET['TglAna2'];
    $masalah_utama       = $_GET['masalah_utama'];
    $saran_rekomendasi   = $_GET['saran_rekomendasi'];
	$simpan				 = $_GET['simpan'];

	#get date time current
	date_default_timezone_set("Asia/Jakarta"); 
	$date 	= date('Y-m-d H:i:s');
	$tgl 	= date('Y-m-d');
	$waktu	= substr($date,11,8);

	$DateObs	= substr($TglObs,6,4)."-".substr($TglObs,3,2)."-".substr($TglObs,0,2);


	if ($simpan == "baru" && $hasil_skor == "Rendah" ) {

				$queryR = "INSERT INTO T_Invest VALUES('".$no_invest."','".$penyebab_langsung."','".$akar_masalah."','".$tindakan."' , '".$penanggung_jawab_1."' ,'".$perkiraan_waktu_1."','".$rekomendasi."','".$penanggung_jawab_2."','".$perkiraan_waktu_2."')";

				$Sql = sqlsrv_query($conn,$queryR);	

				echo
				"<script>
				alert('Data Investigasi No. Laporan ".$no_invest." Berhasil Ditambah');
				window.location.href='T_Invest_Create.php';
				</script>"; 	

	} elseif ($simpan == "baru" && $hasil_skor == "Moderat") {

				$queryM = "INSERT INTO T_Invest VALUES('".$no_invest."','".$penyebab_langsung."','".$akar_masalah."','".$tindakan."' , '".$penanggung_jawab_1."' ,'".$perkiraan_waktu_1."','".$rekomendasi."','".$penanggung_jawab_2."','".$perkiraan_waktu_2."')";

				$Sql = sqlsrv_query($conn,$queryM);	

				echo
				"<script>
				alert('Data Investigasi No. No. Laporan ".$no_invest." Berhasil Ditambah');
				window.location.href='T_Invest_Create.php';
				</script>"; 	

		
	} elseif ($simpan == "baru" && $hasil_skor == "Tinggi") {

				$queryT = "INSERT INTO T_RCA VALUES('".$no_rca."','".$no_lap."','".$kronologis."','".$TglObs."' , '".$jam_obs."' ,'".$hasil_obs."','".$laporan_kejadian."','".$berkas_RM."','".$kebijakan_prosedur."','".$daftarstaf."','".$buktifisik."','".$informasi_lain."','".$TglWaw."','".$jam_waw."','".$hasil_waw."','".$peta_informasi."','".$masalah."','".$analisis."','".$TglAna1."','".$TglAna2."','".$masalah_utama."','".$saran_rekomendasi."')";

				$Sql = sqlsrv_query($conn,$queryT);	

				echo
				"<script>
				alert('Data RCA No. No. Laporan ".$no_invest." Berhasil Ditambah');
				window.location.href='T_Invest_Create.php';
				</script>"; 	

		
	} elseif ($simpan == "baru" && $hasil_skor == "Ekstrim") {

				$queryM = "INSERT INTO T_RCA VALUES('".$no_rca."','".$no_lap."','".$kronologis."','".$TglObs."' , '".$jam_obs."' ,'".$hasil_obs."','".$laporan_kejadian."','".$berkas_RM."','".$kebijakan_prosedur."','".$daftarstaf."','".$buktifisik."','".$informasi_lain."','".$TglWaw."','".$jam_waw."','".$hasil_waw."','".$peta_informasi."','".$masalah."','".$analisis."','".$TglAna1."','".$TglAna2."','".$masalah_utama."','".$saran_rekomendasi."')";

				$SqlM = sqlsrv_query($conn,$queryM);	

				echo
				"<script>
				alert('Data RCA No. No. Laporan ".$no_invest." Berhasil Ditambah');
				window.location.href='T_Invest_Create.php';
				</script>"; 	

	}






// if ($simpan == "ubah"){
// 	$sql = "UPDATE T_Trans set Aspek = '".$aspek."', Analisa = '".$analisa."', TindakLanjut = '".$tindaklanjut."', UserClient = '".$user."',
// 	Status = '".$status."', Tgl_kejadian = '".$TglTjd_Ubah."' where Kode = '".$id."'";
	
// 	//echo $sql; 
	
// 	$sql_execute 	= sqlsrv_query($conn,$sql);
	
// 	$sql_2 			= "select * From T_Trans where Kode = '".$id."'";
// 	$sql_execute_2	= sqlsrv_query($conn,$sql_2);
// 	$hasil			= sqlsrv_fetch_array($sql_execute_2, SQLSRV_FETCH_ASSOC);

// 	echo
// 	"<script>
// 	alert('Transaksi dengan Kode ".$hasil['Kode']." Berhasil Diubah');
// 	window.location.href='T_Transaction_Change.php';
// 	</script>";
	
// } elseif ($simpan == "baru") {

// 				$query3 = "INSERT INTO T_Trans VALUES('".$id."','".$aspek."','".$analisa."','".$tindaklanjut."' , '".$user."' ,'".$status."','".$tgl."',
// 				'".$DateTjd."')";

// 				$Sql3 = sqlsrv_query($conn,$query3);	

// 				echo
// 				"<script>
// 				alert('Transaksi ".$id." Berhasil Ditambah');
// 				window.location.href='T_Transaction_Create.php';
// 				</script>"; 	
		
// 	}
?>
