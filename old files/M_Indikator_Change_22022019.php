<?php
include "koneksi.php";

#ambil data
$query = "SELECT * FROM M_Departemen where Status = 'X' ";
$sql = sqlsrv_query($conn, $query);
$arrdept = array();
while ($row = sqlsrv_fetch_array($sql)) {
	$arrdept [ $row['Deskripsi'] ] = $row['Kode'];
	
}	
#action get unitkerja
if(isset($_GET['action']) && $_GET['action'] == "getUnker") {
	$kode_dept = $_GET['kode_dept'];
	
#ambil data unitkerja
	$query = "Select * from V_UnitKerja where kode_dept= '$kode_dept'";
	$sql = sqlsrv_query($conn, $query);
	$arrker = array();
	while ($row = sqlsrv_fetch_array($sql)) {
		array_push($arrker, $row);
	}
	echo json_encode($arrker);
	exit;
}
	
#action get group
if(isset($_GET['action']) && $_GET['action'] == "getIndi") {
	$unitKrj = $_GET['unitKrj'];
	
#ambil data group
	//$query = "SELECT * FROM V_Group WHERE KdUnit = '$unitKrj' ORDER BY Deskripsi";
	$query = "SELECT * FROM V_GroupIndi WHERE Unit_Kerja = '$unitKrj' AND Status = 'X'";
	//$query = "SELECT * FROM V_GroupUnit WHERE Unit = '$unitKrj'";
	$sql = sqlsrv_query($conn, $query);
	$arrind = array();
	while ($row = sqlsrv_fetch_array($sql)) {
		array_push($arrind, $row);
	}
	echo json_encode($arrind);
	exit;
}
?>

<?php
//Create Autonumber
$sql = "SELECT MAX(Kode) AS id FROM M_Indikator";

$sql_execute = sqlsrv_query($conn,$sql);
$sql_hasil = sqlsrv_fetch_array($sql_execute);
$cek = $sql_hasil['id'];

$kode = substr($cek,1,6);

$tambah = $kode + 1;
	
	if($tambah<10){
		$id = "P00000".$tambah;
		}else{
		$id = "P0000".$tambah;
		}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Indikator - Change</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
<link href="css/font-awesome.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/pages/dashboard.css" rel="stylesheet">
<script src="js/jquery-1.7.2.min.js"></script>

<?php
//include "koneksi.php";
//{
//	#ambil data semua
//		$query = "SELECT * FROM M_Departemen";
//		$sql = sqlsrv_query($conn, $query);
//		$arrind = array();
//		while ($row = sqlsrv_fetch_array($sql)) {
//			$arrind [ $row['Kode'] ] = $row['Kode'];
//		}
//	}	
//
//{
//	#ambil data semua
//		$query = "SELECT * FROM M_Unit";
//		$sql = sqlsrv_query($conn, $query);
//		$arrunit = array();
//		while ($row = sqlsrv_fetch_array($sql)) {
//			$arrunit [ $row['Kode'] ] = $row['Kode'];
//		}
//	}				
//
//{
//	#ambil data semua
//		$query = "SELECT * FROM M_Group";
//		$sql = sqlsrv_query($conn, $query);
//		$arrgroup = array();
//		while ($row = sqlsrv_fetch_array($sql)) {
//			$arrgroup [ $row['Kode'] ] = $row['Kode'];
//		}
//	}						
?>
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
<style>
td{
  padding-left: 3px;
}
td.mid{
  padding-left: 0px;
  text-align: center;
}
.style1 {	font-size: 17px;
	font-weight: bold;
}
</style>

<script language="javascript">
function submit_form(){
document.form1.submit();
document.form2.image();
}
</script>

<script type="text/javascript" src="libs/jquery.min.js"></script>
    <script type="text/javascript">
     	$(document).ready(function()
			{
				$('#departemen').change(function()
				{ 
					$.getJSON('M_Indikator_Create.php',{action:'getUnker', kode_dept:$(this).val()}, function(json)
					{ 
						$('#unit_kerja').html('');
						$('#unit_kerja').append('<option value="">---------------- P I L I H ----------------</option>');
						$.each(json, function(index, row) 
						{	
							//$('#unit_kerja').append('<option value="'+row.kode_unit+'">'+row.kode_unit+'</option>');
							$('#unit_kerja').append('<option value="'+row.Unit_Kerja+'">'+row.Unit_Kerja+'</option>');
						});
						
					});
				});
				$('#unit_kerja').change(function()
				{ 
					$.getJSON('M_Indikator_Create.php',{action:'getIndi', unitKrj:$(this).val()}, function(json)
					{
						$('#group_unit').html('');
						
						$('#group_unit').append('<option value="">---------------- P I L I H ----------------</option>');
						$.each(json, function(index, row) 
						{
							// ini bisa $('#group_unit').append('<option value="'+row.UnitGroup+'">'+row.UnitGroup+'</option>');
							$('#group_unit').append('<option value="'+row.Deskripsi+'">'+row.Deskripsi+'</option>');	
						});
					});	
				});
			});
    </script>
	
    
    <script type="text/javascript" src="libs/jquery.min.js"></script>



</head>
<body>
<div id="header_mstr"></div>
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span12 mainPage">
					
					<br>
					<span class="style1">Change Indikator </span><br>
					<table>
						<tr>
							<td>Kode Indikator </td>
							<td> : </td>
							<td><input name="kodeindikator" type="text" id="kode" maxlength="6" disabled="disabled" style="text-align:center;font-weight:bold;font-size:16px"></td>
						</tr>
						<tr>
							<td>Aspek yang dinilai</td>
							<td> : </td>
							<td colspan="2" rowspan="2"><textarea name="aspek" rows="5" id="aspek"></textarea></td>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
					  </tr>
						
						<tr>
						  <td height="24">Standar</td>
						  <td>:</td>
						  <td colspan="2" rowspan="2"><textarea name="standar" rows="5" id="standar"></textarea></td>
					  </tr>
						<tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
					  </tr>
						
						<tr>
						  <td>Departemen</td>
						  <td>:</td>
						  <td colspan="2"><span class="inputan">
						   <select id="departemen" oninput="change1()" >
										<option>---------------- P I L I H ----------------</option>
										<?php
										include "koneksi.php";

										$que = "SELECT Kode FROM M_Departemen WHERE Status ='X'";
										$sql = sqlsrv_query($conn,$que);

										while($hasil = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC)){
											echo "<option value='".$hasil[Kode]."'>$hasil[Kode]</option>";
										}
										?>
									</select>
						  </span></td>
					  </tr>
						<tr>
						  <td>Unit</td>
						  <td>:</td>
						  <td colspan="2">
						  		<span id="ini"></span>
						  </td>
					  </tr>
						<tr>
						  <td>Group</td>
						  <td>:</td>
						  <td colspan="2">
						  		<span id="itu"></span>
						  </td>
					  </tr>
						<tr>
						  <td>Aktif</td>
						  <td>:</td>
						  <td colspan="2"><input type="radio" name="statindikator" id="aktif" checked>
					      Aktif</td>
					  </tr>
						<tr>
						  <td height="52">&nbsp;</td>
						  <td>&nbsp;</td>
						  <td colspan="2"><input type="radio" name="statindikator" id="nonaktif">
					      Non-Aktif</td>
					  </tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td colspan="2"><button id="myBtn">Search</button>  
											<button onClick="saveindikator();">Save</button>  
											<button onClick="clearindikator();">Cancel</button>  </td>
						</tr>
					</table>
					<input type="hidden" id="unit" disabled="disabled"></input>
					<input type="hidden" id="group" disabled="disabled"></input>
					<?php include "M_Indikator_Search.php"; ?>
        </div>
        <!-- /span12 -->
      </div>
      <!-- /row -->
    </div>
    <!-- /container -->
  </div>
  <!-- /main-inner -->
</div>
<!-- /main -->
<div class="extra">
  <div class="extra-inner">
    <div class="container">
      <div class="row">
        <p>
          Rumah Sakit Pantai Indah Kapuk
        </p>
      </div>
    </div>
    <!-- /container -->
  </div>
  <!-- /extra-inner -->
</div>
<!-- /extra -->
<div class="footer">
  <div class="footer-inner">
    <div class="container">
      <div class="row">
        <div class="span12"> &copy; 2013 <a href="#">Bootstrap Responsive Admin Template</a>. </div>
        <!-- /span12 -->
      </div>
      <!-- /row -->
    </div>
    <!-- /container -->
  </div>
  <!-- /footer-inner -->
</div>
<!-- /footer -->
<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script>

	function change1() {
			var depart = document.getElementById('departemen').value;
			$("#ini").empty();
			$("#ini").load('cariunitkerja_indi.php?depart=' + depart);
		}

	function change2() {
			var unit = document.getElementById('unit').value;
			// alert(unit);
			document.getElementById('unitkerja').value = unit;
			change3();
		}
		
	function change3() {
			var namaunit = document.getElementById('unit').value;
			//alert(namaunit);
			$("#itu").empty();
			$("#itu").load('cariunitkerja_indi_2.php?namaunit=' + namaunit);
		}
		
	function change4() {
			var group = document.getElementById('group').value;
			alert(group);
			document.getElementById('namagroup').value = group;
			document.getElementById('group').value="";
			document.getElementById('unit').value="";
		}
		
			
	function saveindikator(){
		var kode;
		var aspek;
		var standar;
		var departemen;
		var unit_kerja;
		var group;
	
    kode = document.getElementById('kode').value;
    aspek = document.getElementById('aspek').value;
	standar = document.getElementById('standar').value;
    departemen = document.getElementById('departemen').value;
	unit_kerja = document.getElementById('unit_kerja').value;
	group = document.getElementById('group').value;

    var cekradiobutton = document.getElementById('aktif');
    if (cekradiobutton.checked){
      statindikator = "X";
    }else{
      statindikator = " ";
    }

    var simpan;
    simpan = "ubah";

    if (aspek) {
      window.location.href='M_Indikator_Save.php?kode=' + kode + '&aspek=' + aspek + '&standar=' + standar + '&departemen=' + departemen + '&unit_kerja=' + unit_kerja + '&group=' + group + '&statindikator=' + statindikator + '&simpan=' + simpan;
    } else {
      alert("Kolom 'Aspek' harus diisi..");
    }
  }

  function clearindikator(){
    document.getElementById('kode').value = '';
    document.getElementById('aspek').value = '';
	document.getElementById('standar').value = '';
    document.getElementById('departemen').value = '';
	document.getElementById('unit_kerja').value = '';
	document.getElementById('group').value = '';
    radiobtn = document.getElementById("aktif");
    radiobtn.checked = true;
    radiobtn = document.getElementById("nonaktif");
    radiobtn.checked = false;
  }
</script>

<script type="text/javascript" src="libs/jquery.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function()
			{
				$('#departemen').change(function()
				{
					$.getJSON('M_Indikator_Create.php',{action:'getdepartemen', departemen:$(this).val()}, function(json)
					{
						$('#departemen').html('');
						$.each(json, function(index, row) 
						{
							$('#departemen').append('<option value="'+row.kode+'">'+row.nama+'</option>');
						});
					});
				});
			});
		</script>

<script type="text/javascript" src="libs/jquery.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function()
			{
				$('#unitkerja').change(function()
				{
					$.getJSON('M_Indikator_Create.php',{action:'getunitkerja', unitkerja:$(this).val()}, function(json)
					{
						$('#unitkerja').html('');
						$.each(json, function(index, row) 
						{
							$('#unitkerja').append('<option value="'+row.kode+'">'+row.nama+'</option>');
						});
					});
				});
			});
		</script>
		
<script type="text/javascript" src="libs/jquery.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function()
			{
				$('#group').change(function()
				{
					$.getJSON('M_Indikator_Create.php',{action:'getgroup', group:$(this).val()}, function(json)
					{
						$('#group').html('');
						$.each(json, function(index, row) 
						{
							$('#group').append('<option value="'+row.kode+'">'+row.nama+'</option>');
						});
					});
				});
			});
		</script>		
		
<script src="js/excanvas.min.js"></script>
<script src="js/chart.min.js" type="text/javascript"></script>
<script src="js/bootstrap.js"></script>
<script src="js/Script.js"></script>
<script language="javascript" type="text/javascript" src="js/full-calendar/fullcalendar.min.js"></script>

<script src="js/base.js"></script>
</body>
</html>
