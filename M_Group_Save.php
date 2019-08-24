<?php
include "koneksi.php";
date_default_timezone_set("Asia/Bangkok");

$kd_group	= $_GET['kd_group'];
$desk_group = $_GET['desk_group'];
$dept		= $_GET['departemen'];
//$unitkerja	= substr($_GET['unitkerja'], 0, 6);
//$deskunit	= substr($_GET['unitkerja'], 9, 20);
$unitkerja	= $_GET['unitkerja'];
$statgroup	= $_GET['statgroup'];
$simpan		= $_GET['simpan'];


//GET kode
$queryunit	= " select Kode from M_Unit where Deskripsi = '".$unitkerja."'  ";
$sqlunit	= sqlsrv_query($conn,$queryunit);
$getarrunit = sqlsrv_fetch_array ($sqlunit);
$KdUnit		= $getarrunit['Kode'];

$run_kd_group = substr($KdUnit, 0, 6);

/*echo $kd_group;
echo "<br>";
echo $desk_group;
echo "<br>";
echo $dept;
echo "<br>";
echo $unitkerja;
echo "<br>";
echo $deskunit;
echo "<br>";
echo $statgroup;
echo "<br>";
echo $simpan;
echo "<br>";
*/




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
	$sql = "Update M_Group set Deskripsi = '".$desk_group."', Departemen = '".$dept."', Unit_Kerja = '".$unitkerja."' , Status = '".$statgroup."'
	where Kode = '".$kd_group."'";
	$sql_execute = sqlsrv_query($conn,$sql);

	$sql = "select * from M_Group where Kode = '".$kd_group."'";
	$sql_execute = sqlsrv_query($conn,$sql);
	$hasil = sqlsrv_fetch_array($sql_execute, SQLSRV_FETCH_ASSOC);

	echo
	"<script>
	alert('Group ".$hasil['Kode']."  Berhasil Diubah');
	window.location.href='M_Group_Change.php';
	</script>";

} elseif ($simpan == "baru") {
		
		$query1= " select Run_no from Run_no_group where Unit_Kerja = '".$run_kd_group."'  ";
		$sql1 = sqlsrv_query($conn,$query1);
		$getarr2 =  sqlsrv_fetch_array ($sql1);
		$getRun_no_group = $getarr2['Run_no'];

		$query4= " select Deskripsi from M_Group where Deskripsi = '".$desk_group."'  ";
		$sql4 = sqlsrv_query($conn,$query4);
		$getarr4 =  sqlsrv_fetch_array($sql4);
		$cek = $getarr4['Deskripsi'];

		if($cek == null){
			if($getRun_no_group == ""){
				$value = $hasilakhir;

				$query2 = "INSERT INTO Run_no_group VALUES('".$run_kd_group."','".$dept."','".$value."')";

				$sql2 = sqlsrv_query($conn,$query2);
				$kodehasil=$run_kd_group."-".$value;

				$unitgroup = $kodehasil."-".$desk_group;
				
/*				$query3 = "INSERT INTO M_Group VALUES('".$kodehasil."','".$desk_group."','".$dept."', '".$run_kd_group."' , '".$deskunit."' , '".$unitgroup."' , '".$statgroup."')";*/
				
				$query3 = "INSERT INTO M_Group VALUES('".$kodehasil."','".$desk_group."','".$dept."', '".$unitkerja."' , '".$statgroup."')";
				
				//echo $query3;

				$Sql3 = sqlsrv_query($conn,$query3);		
				
				echo
				"<script>
				alert('Group ".$kodehasil." - ".$desk_group." Berhasil Ditambah');
				window.location.href='M_Group_Create.php';
				</script>";
		
			}else{

				$satusatu1 = $getRun_no_group + 1;
			
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

				$sql4 = sqlsrv_query($conn,"update Run_no_group set  Run_no = '".$hasilakhir1."' where Unit_Kerja = '".$run_kd_group."' ");

				$kodehasil2 =$run_kd_group."-".$hasilakhir1 ;

				$unitgroup2 = $kodehasil2."-".$desk_group;
			
				/*$query5 = "INSERT INTO M_Group VALUES ('".$kodehasil2."','".$desk_group."', '".$dept."', '".$run_kd_group."' , '".$deskunit."' , '".$unitgroup2."' , '".$statgroup."')";*/
				
				$query5 = "INSERT INTO M_Group VALUES('".$kodehasil2."','".$desk_group."','".$dept."', '".$unitkerja."' , '".$statgroup."')";
				
				echo "<br>";
				echo $query5;
				
				$Sql5 = sqlsrv_query($conn,$query5);			
				
				echo
				"<script>
				alert('Group ".$kodehasil2." - ".$desk_group." Berhasil Ditambah');
				window.location.href='M_Group_Create.php';
				</script>";
				
			
				}
		}			

	} 
	/*else {
		echo
		"<script>
		alert('Data sudah tercatat pada sistem sebelumnya.');
		window.location.href='M_Group_Create.php';
		</script>";
		
	}*/
?>
