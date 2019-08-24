<?php

error_reporting(0);
ini_set('display_errors',0);
include "koneksi.php";

$tahun 		 = $_POST['tahun'];
$tahunsblm   = $tahun - 1; 
$dept 		 = $_POST['departemen'];
$unitkerja 	 = $_POST['unitkerja'];

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!--<title>Untitled Document</title>-->
</style>
<script type="text/javascript">
function ExportToExcel(testTable){
       var htmltable= document.getElementById('TableDetail');
       var html = htmltable.outerHTML;
       window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));
    }

</script>
</head>

<body bgcolor="#FFFF99">



<!-- data tahun sebelumnya = tahun berjalan - 1 -->
<?php

//$querysblm = "SELECT * FROM V_Transaksi WHERE Departemen = '".$dept."' AND DeskUnit = '".$unitkerja."' AND Status = 'X' ORDER BY Kode ASC";

$querysblm = "SELECT * FROM V_Report WHERE Departemen = '".$dept."' AND Unit = '".$unitkerja."' AND YEAR(Tgl_Kejadian) = '".$tahunsblm."' AND Status = 'X'
ORDER BY Kode ASC";

//$querysblm_2 = "SELECT DISTINCT Kode, Aspek, Standar FROM V_Report WHERE Departemen = '".$dept."' AND Unit = '".$unitkerja."' AND YEAR(Tgl_Kejadian) = '".$tahunsblm."' AND Status = 'X'";
//
//$sqlsblm_2 = sqlsrv_query($conn,$querysblm_2);
//

$sqlsblm = sqlsrv_query($conn,$querysblm);
	
if  ($sqlsblm){

echo "
		<table id=\"TableDetail\" border=\"1\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\">
		<h3 hidden align=\"left\">Laporan Hasil Pemantauan Departemen ".$dept." Bagian ".$unitkerja." </h3>
		<h3 hidden align=\"left\">Periode ".$tahunsblm."</h3>
		<tr>
		<td align=\"center\" width=\"55\"><b>No.</b></td>
		<td align=\"center\" width=\"300\"><b>Aspek yang dinilai</b></td>
		<td align=\"center\" width=\"350\"><b>Standar</b></td>
		<td align=\"center\" width=\"55\"><b>JAN</b></td>
		<td align=\"center\" width=\"55\"><b>FEB</b></td>
		<td align=\"center\" width=\"55\"><b>MAR</b></td>
		<td align=\"center\" width=\"55\"><b>APR</b></td>
		<td align=\"center\" width=\"55\"><b>MAY</b></td>
		<td align=\"center\" width=\"55\"><b>JUN</b></td>
		<td align=\"center\" width=\"55\"><b>JUL</b></td>
		<td align=\"center\" width=\"55\"><b>AUG</b></td>
		<td align=\"center\" width=\"55\"><b>SEP</b></td>
		<td align=\"center\" width=\"55\"><b>OCT</b></td>
		<td align=\"center\" width=\"55\"><b>NOV</b></td>
		<td align=\"center\" width=\"55\"><b>DEC</b></td>
		<td align=\"center\" width=\"110\"><b>∑ Last Year (".$tahunsblm.")</b></td>
		
</tr>";

		$arrKodesblm = array();
		$arrAspeksblm = array();
		$hslsblm = array();
		$arrsblmttl = array();
		$totalsblm = array("0","0","0","0","0","0","0","0","0","0","0","0","0","0");	
		
		$no = 1;
		while($rs = sqlsrv_fetch_array($sqlsblm)){
			$arrKodesblm[$no] = $rs['Kode'];
			$arrAspeksblm[$no] = $rs['Aspek'];
			$arrStandarsblm[$no] = $rs['Standar'];
			
			$no++;
		}
		
			$arrlengthsblm = count( $arrAspeksblm);
			
			for($x=1;$x<=$arrlengthsblm;$x++)
 			 {	$sttlsblm = 0;
			 	for($blnsblm=1;$blnsblm<=12;$blnsblm++)
			 	{
				
				$aspeksblm 		= $arrAspeksblm[$x]; 
				$standarsblm 	= $arrStandarsblm[$x];
			 	$quesblm 		= "SELECT count (*) as jml FROM V_Report WHERE Departemen = '".$dept."' AND Unit = '".$unitkerja."'
				AND Aspek like '".$aspeksblm."' AND MONTH(Tgl_Kejadian) = '".$blnsblm."' AND YEAR(Tgl_Kejadian) = '".$tahunsblm."' AND Status = 'X'";
				
				
				$sql1sblm = sqlsrv_query($conn,$quesblm);
				
				
			 	while($rs1sblm = sqlsrv_fetch_array($sql1sblm)){
					$hslsblm[$blnsblm]		= $rs1sblm["jml"];
					$sttlsblm 				= $sttlsblm + $hslsblm[$blnsblm];
					$totalsblm[$blnsblm] 	= $totalsblm[$blnsblm] + $hslsblm[$blnsblm];
					
				}
				
				}
				
				if ($sttlsblm==' ')
				
				{ 
				$sttlsblm = '0';
				}
				

		
				$arrsblmttl[$x] = $sttlsblm;
				
				$totalsblm[14] 	= $totalsblm[14] + $sttlsblm ;
				//$indikatorsblm 	= $arrKodesblm[$x]. ' '.$arrAspeksblm[$x];
				//$Aspeksblm_2 = $arrAspeksblm_2[$x];
				$indikatorsblm 	= $arrAspeksblm[$x];
				$standarXsblm  	= $arrStandarsblm[$x];
				
				
			 echo "
				<tr>
				<td align=\"center\">$x</td>
				<td align=\"left\">$indikatorsblm</td>
				<td align=\"left\">$standarXsblm</td>
				<td align=\"center\">$hslsblm[1]</td>
				<td align=\"center\">$hslsblm[2]</td>
				<td align=\"center\">$hslsblm[3]</td>
				<td align=\"center\">$hslsblm[4]</td>
				<td align=\"center\">$hslsblm[5]</td>
				<td align=\"center\">$hslsblm[6]</td>
				<td align=\"center\">$hslsblm[7]</td>
				<td align=\"center\">$hslsblm[8]</td>
				<td align=\"center\">$hslsblm[9]</td>
				<td align=\"center\">$hslsblm[10]</td>
				<td align=\"center\">$hslsblm[11]</td>
				<td align=\"center\">$hslsblm[12]</td>
				<td align=\"center\"><b>$sttlsblm</b></td>
				</tr>";
				
			 
			 }
		 
			 echo "
		<tr>
			<th colspan=\"2\" scope=\"row\"></th>
			<td align=\"center\"><b>Total</b></td>
			<td align=\"center\"><b>$totalsblm[1]</b></td>
			<td align=\"center\"><b>$totalsblm[2]</b></td>
			<td align=\"center\"><b>$totalsblm[3]</b></td>
			<td align=\"center\"><b>$totalsblm[4]</b></td>
			<td align=\"center\"><b>$totalsblm[5]</b></td>
			<td align=\"center\"><b>$totalsblm[6]</b></td>
			<td align=\"center\"><b>$totalsblm[7]</b></td>
			<td align=\"center\"><b>$totalsblm[8]</b></td>
			<td align=\"center\"><b>$totalsblm[9]</b></td>
			<td align=\"center\"><b>$totalsblm[10]</b></td>
			<td align=\"center\"><b>$totalsblm[11]</b></td>
			<td align=\"center\"><b>$totalsblm[12]</b></td>
			<td align=\"center\"><b>$totalsblm[14]</b></td>
			
		</tr>";
			echo"</table>";
						
	}
	
	echo "
	<table>
		<tr>
			
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
			
			
			
		</tr>
	</table>
";
	
//var_dump($arrsblmttl);
?>



<?php

//$query = "SELECT * FROM V_Transaksi WHERE Departemen = '".$dept."' AND DeskUnit = '".$unitkerja."' AND Status = 'X' ORDER BY Kode ASC";

$query = "SELECT * FROM V_Report WHERE Departemen = '".$dept."' AND Unit = '".$unitkerja."' AND YEAR(Tgl_Kejadian) = '".$tahun."' AND Status = 'X' ORDER BY Kode ASC";

$sql = sqlsrv_query($conn,$query);
	
if  ($sql){

echo "
		<table id=\"TableDetail\" border=\"1\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\">
		<h3 align=\"left\">Laporan Hasil Pemantauan Departemen ".$dept." Bagian ".$unitkerja." </h3>
		<h3 align=\"left\">Periode ".$tahun." </h3>
		<tr>
		<td align=\"center\" width=\"55\"><b>No.</b></td>
		<td align=\"center\" width=\"300\"><b>Aspek yang dinilai</b></td>
		<td align=\"center\" width=\"350\"><b>Standar</b></td>
		<td align=\"center\" width=\"55\"><b>JAN</b></td>
		<td align=\"center\" width=\"55\"><b>FEB</b></td>
		<td align=\"center\" width=\"55\"><b>MAR</b></td>
		<td align=\"center\" width=\"55\"><b>APR</b></td>
		<td align=\"center\" width=\"55\"><b>MAY</b></td>
		<td align=\"center\" width=\"55\"><b>JUN</b></td>
		<td align=\"center\" width=\"55\"><b>JUL</b></td>
		<td align=\"center\" width=\"55\"><b>AUG</b></td>
		<td align=\"center\" width=\"55\"><b>SEP</b></td>
		<td align=\"center\" width=\"55\"><b>OCT</b></td>
		<td align=\"center\" width=\"55\"><b>NOV</b></td>
		<td align=\"center\" width=\"55\"><b>DEC</b></td>
		<td align=\"center\" width=\"110\"><b>∑ Curr Year (".$tahun.")</b></td>
		<td align=\"center\" width=\"110\"><b>∑ Last Year (".$tahunsblm.")</b></td>
		
</tr>";

		$arrKode = array();
		$arrAspek = array();
		$hsl = array();
		$total = array("0","0","0","0","0","0","0","0","0","0","0","0","0","0");
		$no = 1;
		while($rs = sqlsrv_fetch_array($sql)){
			$arrKode[$no] = $rs['Kode'];
			$arrAspek[$no] = $rs['Aspek'];
			$arrStandar[$no] = $rs['Standar'];
			
			$no++;
		}
		
			$arrlength = count(	$arrAspek );
			
			for($x=1;$x<=$arrlength;$x++)
 			 {	$sttl = 0;
			 	for($bln=1;$bln<=12;$bln++)
			 	{
				
				$aspek = $arrAspek[$x]; 
				$standar = $arrStandar[$x];
			 	$que = "SELECT Count (*) as jml FROM V_Report WHERE Departemen = '".$dept."' AND Unit = '".$unitkerja."' AND Aspek like '".$aspek."'
				AND MONTH(Tgl_Kejadian) = '".$bln."' AND YEAR(Tgl_Kejadian) = '".$tahun."' AND Status = 'X' ";
				
				//$que = "SELECT count (*) as jml FROM V_Report WHERE Departemen = '".$dept."' AND Unit = '".$unitkerja."' AND Aspek = '".$aspek."'
//				AND (Tgl_Kejadian,5,2) = '".$bln."' AND (Tgl_Kejadian,0,4) = '".$tahun."' AND Status = 'X' ";
				
				$sql1 = sqlsrv_query($conn,$que);
				
				
			 	while($rs1 = sqlsrv_fetch_array($sql1)){
					$hsl[$bln] = $rs1["jml"];
					$sttl = $sttl + $hsl[$bln];
					$total[$bln] = $total[$bln] + $hsl[$bln];
					                          
				}
				
				}
				
				$total[13] = $total[13] + $sttl;
				//$indikator = $arrKode[$x]. ' '.$arrAspek[$x];
				$indikator = $arrAspek[$x];
				$standarX  = $arrStandar[$x];
				
				if ($arrsblmttl[$x] == '')
				{
				 $arrsblmttl[$x] = '0';
				}
				
				if ($totalsblm[14] == '')
				{
				$totalsblm[14] = '0';
				}
				
				
			 echo "
				<tr>
				<td align=\"center\">$x</td>
				<td align=\"left\">$indikator</td>
				<td align=\"left\">$standarX</td>
				<td align=\"center\">$hsl[1]</td>
				<td align=\"center\">$hsl[2]</td>
				<td align=\"center\">$hsl[3]</td>
				<td align=\"center\">$hsl[4]</td>
				<td align=\"center\">$hsl[5]</td>
				<td align=\"center\">$hsl[6]</td>
				<td align=\"center\">$hsl[7]</td>
				<td align=\"center\">$hsl[8]</td>
				<td align=\"center\">$hsl[9]</td>
				<td align=\"center\">$hsl[10]</td>
				<td align=\"center\">$hsl[11]</td>
				<td align=\"center\">$hsl[12]</td>
				<td align=\"center\"><b>$sttl</b></td>
				<td align=\"center\"><b>$arrsblmttl[$x]</b></td>
				</tr>";
				
			 
			 }
		 
			 echo "
		<tr>
			
			<td colspan=\"3\" align=\"center\"><b>Total</b></td>
			<td align=\"center\"><b>$total[1]</b></td>
			<td align=\"center\"><b>$total[2]</b></td>
			<td align=\"center\"><b>$total[3]</b></td>
			<td align=\"center\"><b>$total[4]</b></td>
			<td align=\"center\"><b>$total[5]</b></td>
			<td align=\"center\"><b>$total[6]</b></td>
			<td align=\"center\"><b>$total[7]</b></td>
			<td align=\"center\"><b>$total[8]</b></td>
			<td align=\"center\"><b>$total[9]</b></td>
			<td align=\"center\"><b>$total[10]</b></td>
			<td align=\"center\"><b>$total[11]</b></td>
			<td align=\"center\"><b>$total[12]</b></td>
			<td align=\"center\"><b>$total[13]</b></td>
			<td align=\"center\"><b>$totalsblm[14]</b></td>
			
		</tr>";
			echo"</table>";
						
	}
	
	echo "
	<table>
		<tr>
			
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
			<td><button id=\"btnExport\" onclick=\"ExportToExcel();\">Export to excel</button></td>
			
			<td><button id=\"btnPrint\" onClick=\"window.print();\">Print this page</td>
		</tr>
	</table>
	<br>
	<br>";
	
	//var_dump($arrsblmttl);
?>


</body>
<div id="elementujuan" style="width: 1000px; height: 500px; margin: 0 auto">
<script type="text/javascript" src="js/jquery.min.js"></script>
<script src="js/highcharts.js"></script>
<script type="text/javascript">
</script>
</div>
<div id="elementujuan2" style="width: 1000px; height: 250px; margin: 0 auto">
<script type="text/javascript" src="js/jquery.min.js"></script>
<script src="js/highcharts.js"></script>
<script type="text/javascript">
  </script>
</div>