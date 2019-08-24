<?php
include "koneksi.php";

$id				= $_GET['id'];
$aspek 			= $_GET['aspek'];
$analisa 		= $_GET['analisa'];
$tindaklanjut	= $_GET['tindaklanjut'];
$user 			= $_GET['user'];
$status			= $_GET['statinput'];
$TglTjd			= $_GET['TglTjd'];
$simpan 		= $_GET['simpan'];

$DateTjd		= substr($TglTjd,6,4)."-".substr($TglTjd,3,2)."-".substr($TglTjd,0,2);

$TglTjd_Ubah	= substr($TglTjd,6,4)."-".substr($TglTjd,3,2)."-".substr($TglTjd,0,2);


#get date time current
date_default_timezone_set("Asia/Jakarta"); 
$date 	= date('Y-m-d H:i:s');
$tgl 	= date('Y-m-d');
$waktu	= substr($date,11,8);

if ($simpan == "ubah"){
	$sql = "UPDATE T_Trans set Aspek = '".$aspek."', Analisa = '".$analisa."', TindakLanjut = '".$tindaklanjut."', UserClient = '".$user."',
	Status = '".$status."', Tgl_kejadian = '".$TglTjd_Ubah."' where Kode = '".$id."'";
	
	//echo $sql; 
	
	$sql_execute 	= sqlsrv_query($conn,$sql);
	
	$sql_2 			= "select * From T_Trans where Kode = '".$id."'";
	$sql_execute_2	= sqlsrv_query($conn,$sql_2);
	$hasil			= sqlsrv_fetch_array($sql_execute_2, SQLSRV_FETCH_ASSOC);

	echo
	"<script>
	alert('Transaksi dengan Kode ".$hasil['Kode']." Berhasil Diubah');
	window.location.href='T_Transaction_Change.php';
	</script>";
	
} elseif ($simpan == "baru") {

				$query3 = "INSERT INTO T_Trans VALUES('".$id."','".$aspek."','".$analisa."','".$tindaklanjut."' , '".$user."' ,'".$status."','".$tgl."',
				'".$DateTjd."')";

				$Sql3 = sqlsrv_query($conn,$query3);	

				echo
				"<script>
				alert('Transaksi ".$id." Berhasil Ditambah');
				window.location.href='T_Transaction_Create.php';
				</script>"; 	
		
	}
?>
