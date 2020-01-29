<?php
include "koneksi.php";
date_default_timezone_set("Asia/Bangkok");

$kd_unit	= $_GET['kd_unit'];
$desk_unit		= $_GET['desk_unit'];
$statunit		= $_GET['statunit'];
$dept 			= $_GET['departemen'];
$simpan 		= $_GET['simpan'];

$run_kd_unit = trim($dept, " ");

$satusatu= '1';
$pnjgsatu = strlen($satusatu);

if ($pnjgsatu == 1){
	$hasilakhir= '0'.$satusatu;
}
elseif ($pnjgsatu == 2){
	$hasilakhir= $satusatu;
}
else{
			$hasilakhir = $satusatu;
		}



if ($simpan == "ubah"){

	$sql = "update M_Unit set Deskripsi = '".$desk_unit."', Departemen = '".$dept."', Status = '".$statunit."' where Kode = '".$kd_unit."'";
	$sql_execute = sqlsrv_query($conn,$sql);

	$sql = "select * from M_Unit where Kode = '".$kd_unit."'";
	$sql_execute = sqlsrv_query($conn,$sql);
	$hasil = sqlsrv_fetch_array($sql_execute, SQLSRV_FETCH_ASSOC);

	echo
	"<script>
	alert('Unit Kerja ".$hasil['Kode']." - ".$hasil['Deskripsi']." Berhasil Diubah');
	window.location.href='M_Unit_Change.php';
	</script>";
} elseif ($simpan == "baru") {

		$query1= " select Run_no from Run_no_unit where dept = '".$run_kd_unit."'  ";
		$sql1 = sqlsrv_query($conn,$query1);
		$getarr2 =  sqlsrv_fetch_array ($sql1);
		$getRun_no_unit = $getarr2['Run_no'];

		$query4= " select Deskripsi from M_unit where Deskripsi = '".$desk_unit."'  ";
		$sql4 = sqlsrv_query($conn,$query4);
		$getarr4 =  sqlsrv_fetch_array($sql4);
		$cek = $getarr4['Deskripsi'];

		if($cek == null){
			if($getRun_no_unit == ""){
				$value = $hasilakhir;

				$query2 = "INSERT INTO Run_no_unit VALUES('".$run_kd_unit."','".$desk_unit."','".$value."')";

				$sql2 = sqlsrv_query($conn,$query2);
				$kodehasil=$dept."-".$value;

				$deptunit = $kodehasil."-".$desk_unit;

				$query3 = "INSERT INTO M_unit VALUES('".$kodehasil."','".$desk_unit."','".$dept."' , '".$deptunit."' ,'".$statunit."')";

				$Sql3 = sqlsrv_query($conn,$query3);

				echo
				"<script>
				alert('Unit Kerja ".$kodehasil." - ".$desk_unit." Berhasil Ditambah');
				window.location.href='M_Unit_Create.php';
				</script>";

			}else{

				$satusatu1 = $getRun_no_unit + 1;

				$pnjgsatu1 = strlen($satusatu1);

				if ($pnjgsatu1 == 1)
				{
					$hasilakhir1= '0'.$satusatu1;
				}

				elseif ($pnjgsatu1 == 2)
				{
					$hasilakhir1= $satusatu1;
				}
				else{
					$hasilakhir1 = $satusatu1;
				}

				$sql4 = sqlsrv_query($conn,"update Run_no_unit set Unit = '".$desk_unit."',  Run_no = '".$hasilakhir1."' where Dept = '".$run_kd_unit."' ");

				$kodehasil2 = $run_kd_unit."-".$hasilakhir1 ;

				$deptunit2 = $kodehasil2."-".$desk_unit;

				$query5 = "INSERT INTO M_unit VALUES ('".$kodehasil2."','".$desk_unit."','".$dept."' , '".$deptunit2."' ,'".$statunit."')";
				$Sql5 = sqlsrv_query($conn,$query5);


				echo
				"<script>
				alert('Unit Kerja ".$kodehasil2." - ".$desk_unit." Berhasil Ditambah');
				window.location.href='M_Unit_Create.php';
				</script>";

				}
		}

	} else {
		echo
		"<script>
		alert('Data sudah tercatat pada sistem sebelumnya.');
		window.location.href='M_Unit_Create.php';
		</script>";
	}
?>
