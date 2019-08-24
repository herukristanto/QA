<?php
	error_reporting(0);
	ini_set('display_errors',0);
	include "connection.php";

	$bulan = $_POST['bulan'];
	$tahun = $_POST['tahun'];
	$dept = $_POST['departemen'];
	$unker = $_POST['unitkerja']; 
	
	//echo $bulan;
//	echo "<br>";
//	echo $tahun;

	$query  = "select Unit from V_Transaksi where DeskUnit = '".$unker."'";
	$sql    =  sqlsrv_query($conn,$query);
	$getarr =  sqlsrv_fetch_array ($sql);
	$Unit   =  $getarr['Unit'];
	
	
	#get date time current
	date_default_timezone_set("Asia/Jakarta"); 
	$date = date('Y-m-d H:i:s');
	
	$tgl = date('Y-m-d');
	
	$waktu = substr($date,11,8);
	
	
	/*$query2  	= "select DeskDept from V_Transaksi where Departemen = '".$dept."'";
	$sql2   	=  sqlsrv_query($conn,$query2);
	$getarr2 	=  sqlsrv_fetch_array ($sql2);
	$DeskDept   =  $getarr['DeskDept'];
	
	echo $DeskDept;*/
	
	//<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"><script>
?>

<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">

<style type="text/css">
<!--
.style4 {color: #FF9933}
-->
</style>
<head>
 <link href='style.css' rel='stylesheet' type='text/css'>
</head>

<script language="javascript">    
function getkey(e)    
{    
if (window.event)    
   return window.event.keyCode;    
else if (e)    
   return e.which;    
else    
   return null;    
}    
function angkadanhuruf(e, goods, field)    
{    
var angka, karakterangka;    
angka = getkey(e);    
if (angka == null) return true;    
     
karakterangka = String.fromCharCode(angka);    
karakterangka = karakterangka.toLowerCase();    
goods = goods.toLowerCase();    
     
// check goodkeys    
if (goods.indexOf(karakterangka) != -1)    
    return true;    
// control angka    
if ( angka==null || angka==0 || angka==8 || angka==9 || angka==27 )    
   return true;    
        
if (angka == 13) {    
    var i;    
    for (i = 0; i < field.form.elements.length; i++)    
        if (field == field.form.elements[i])    
            break;    
    i = (i + 1) % field.form.elements.length;    
    field.form.elements[i].focus();    
    return false;    
    };    
// else return false    
return false;    
}    
</script>    

<div class='container'>
<form action="savepreviewdata.php" method="post">
 <table width='100%' border='1' id='TableDetail'>

  <!--<tr>
    <th colspan="6"><h3 align="center">Laporan Hasil Pemantauan Departemen <?php echo $dept;?> Bagian <?php echo $unker;?> Periode <?php echo $bulan;?> - <?php echo $tahun; ?> </h3></th>
  </tr>-->
          
  <tr>
   		<th width="35"><span class="style4">No.</span></th>
        <th width="180"><span class="style4">Aspek yang dinilai</span></th>
        <th width="250"><span class="style4">Standar</span></th>
        <th width="40"><span class="style4">Jumlah</span></th>
        <th width="350"><span class="style4">Analisa</span></th>
        <th width="350"><span class="style4">Tindak Lanjut</span></th>
		<th width="100"><span class="style4">Tanggal</span></th>
        <th hidden><span class="style4">id</span></th>
  </tr>
  
  <?php 
  
    $count = 1;
	
	$query = "SELECT * FROM Trans_Data WHERE Departemen = '".$dept."' AND Status = 'X'";
	
	$sql = sqlsrv_query($conn,$query);
	  
	while($row = sqlsrv_fetch_array($sql)){
		$no++;
		
		$id = $row['id'];
		$aspek = $row['Aspek'];
		$standar = $row['Standar'];
		$jml = $row['Jml'];
		$standar = $row['Standar'];
		$analisa = $row['Analisa'];
		$tindaklanjut = $row['TindakLanjut'];
		//$bulan = $row['Bulan'];
		//$tahun = $row['Tahun'];

	
  ?>
  <tr>
   <td><div><?php echo $count; ?></div></td>
   <td> 
     <div class='edit' id='aspek_<?php echo $id; ?>'> 
       <?php echo $aspek; ?>     </div>   </td>
   <td> 
     <div class='edit' id='standar_<?php echo $id; ?>'>
       <?php echo $standar; ?>     </div>   </td>
   <td> 
     <div align="center" contentEditable='true' class='edit' id='jml_<?php echo $id; ?>' onKeyPress="return angkadanhuruf(event,'0123456789',this)">
       <?php echo $jml; ?>     </div>   </td>
   <td> 
     <div contentEditable='true' class='edit' id='analisa_<?php echo $id; ?>'>
       <?php echo $analisa; ?>     </div>   </td> 
   <td> 
     <div contentEditable='true' class='edit' id='tindaklanjut_<?php echo $id; ?>'>
       <?php echo $tindaklanjut; ?>     </div>   </td>
   <td> <div><?php echo $tgl; ?></div></td>
     
   <td hidden>
   	<div>
	 <?php echo $id; ?>	</div>   </td> 
   </tr>	 
	 
  <?php
   $count ++;
  }
  ?> 
 </table>

<td><input id="printpagebutton" type="button" value="Print" onclick="printpage();" /></td>
<td><input id="exportpage" type="button" value="Export" onclick="ExportToExcel();" /></td>
<td><input type="submit" name="BtSave" id="BtSave" value="Save" /></td>

</form>
</div>

<script type="text/javascript">
    function printpage() {
        //Get the print button and put it into a variable
        var printButton = document.getElementById("printpagebutton");
		var exportButton = document.getElementById("exportpage");
		var saveButton = document.getElementById("savepage");
        //Set the print button visibility to 'hidden' 
        printButton.style.visibility = 'hidden';
		exportButton.style.visibility = 'hidden';
		saveButton.style.visibility = 'hidden';
        //Print the page content
        window.print()
        //Set the print button to 'visible' again 
        //[Delete this line if you want it to stay hidden after printing]
        printButton.style.visibility = 'visible';  
		exportButton.style.visibility = 'visible';
		saveButton.style.visibility = 'visible';
    }
</script>


 <script type="text/javascript" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
 <script src='jquery-3.0.0.js' type='text/javascript'></script>
 <script src='script.js' type='text/javascript'></script>
 <script src='script_II.js' type='text/javascript'></script>

<script type="text/javascript">
function ExportToExcel(testTable){
       var htmltable= document.getElementById('TableDetail');
       var html = htmltable.outerHTML;
       window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));
    }

</script>

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

  