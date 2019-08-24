<?php
error_reporting(0);
ini_set('display_errors',0);
include "koneksi.php";

$bulan = $_POST['bulan'];
$tahun = $_POST['tahun'];
$dept = $_POST['departemen'];
$unker = $_POST['unitkerja']; 

	$query  = "select Unit from V_Transaksi where DeskUnit = '".$unker."'";
	$sql    =  sqlsrv_query($conn,$query);
	$getarr =  sqlsrv_fetch_array ($sql);
	$Unit   =  $getarr['Unit'];

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Untitled Document</title>
<script type="text/javascript">
function ExportToExcel(testTable){
       var htmltable= document.getElementById('TableDetail');
       var html = htmltable.outerHTML;
       window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));
    }

</script>

<script type="text/javascript">
	$(document).ready(function() {
    $('#members').DataTable();
} );
</script>

</head>

<body bgcolor="#FFFF99">


<?php


$query = "SELECT * FROM Trans_Data WHERE Unit = '".$Unit."'";
	$sql = sqlsrv_query($conn,$query);
if  ($sql){
echo "
		<table id=\"TableDetail\" border=\"1\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\">
		<h3></h3>
		<tr>
		<td style=\"font-weight:bold\" align=\"center\" width=\"70\">No</td>
		<td style=\"font-weight:bold\" align=\"center\" width=\"650\">Aspek</td>
		<td style=\"font-weight:bold\" align=\"center\" width=\"1550\">Standar</td>
		<td style=\"font-weight:bold\" align=\"center\" width=\"80\">Jumlah</td>
		<td style=\"font-weight:bold\" align=\"center\" width=\"1550\">Analisa</td>
		<td style=\"font-weight:bold\" align=\"center\" width=\"1550\">Tindak Lanjut</td>
		<td style=\"font-weight:bold\" align=\"center\" width=\"300\">Update</td>
		<td style=\"font-weight:bold\" align=\"center\" width=\"300\">Record</td>
</tr>";
$no=0;
		while($rs = sqlsrv_fetch_array($sql)){
			$no++;
			
			echo "
			<tr>
				<td align=\"center\">$no</td>
				<td align=\"left\">".$rs['Aspek']."</td>
				<td align=\"left\">".$rs['Standar']."</td>
				<td><div contenteditable>".$rs['Jml']."</div></td>
				<td><div contenteditable>".$rs['Analisa']."</div></td>
				<td><div contenteditable>".$rs['TindakLanjut']."</div></td>
				<td align=\"center\"><button type=\"button\">Edit</button></td>
				<td align=\"center\"><button type=\"button\">Delete</button></td>
				</tr>";
				
				}
				echo"</table>";
	}
else {
		echo '<script type="text/javascript">alert("Data belum tersedia");</script>';
		exit;
	}  

echo "
	<table>
		<tr>
			<td><button id=\"btnSave\" onclick=\"\">Save</button></td>
			<td><button id=\"btnExport\" onclick=\"ExportToExcel();\">Export to excel</button></td>
			<td><button id=\"btnPrint\" onclick=\"window.print();\">Print</button></td>
		</tr>
	</table>
	";

echo "<br>";

echo "<iframe name='my-iframe' src='uploadpage.php?Unit=".$Unit."' width=1110 height=200></iframe>";
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