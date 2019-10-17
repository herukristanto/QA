<?php
session_set_cookie_params(0);
error_reporting(0);
session_start();
if (empty($_SESSION[username]) AND empty($_SESSION[password])){
  echo "<br>";
  echo "<br>";
  echo "<br>";
  echo "<center><H3>Mohon Login Terlebih Dahulu</H3><br>";
  echo "<a href=index.html><b>LOGIN</b></a></center>";
  exit;
}

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
	// $query = "SELECT * FROM V_GroupIndi WHERE Unit_Kerja = '$unitKrj' AND Status = 'X'";
  $query = "SELECT * FROM V_IndGrUn WHERE Unit_Kerja = '$unitKrj' AND Status = 'X'";
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
<title>Indikator - Create</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
<link href="css/font-awesome.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/pages/dashboard.css" rel="stylesheet">
<script src="js/jquery-1.7.2.min.js"></script>


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
.style1 {
	font-size: 17px;
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
          <span class="style1">Create Indikator </span><br>
          <table>
            <tr>
              <td height="31">Kode Indikator</td>
              <td> : </td>
              <td><input name="kode" type="text" id="kode" value="<?php echo $id;?>" size="8" maxlength="6" readonly="readonly"
			  style="text-align:center;font-weight:bold;font-size:16px" /></td>
            </tr>
            <tr>
              <td>Aspek yang dinilai </td>
              <td> : </td>
              <td colspan="2" rowspan="2"><textarea name="aspek" rows="5" id="aspek"></textarea></td>
            </tr>
            <tr>
              <td height="42">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>Tolak Ukur </td>
              <td> : </td>
              <td colspan="2" rowspan="2"><textarea name="tolakukur" rows="5" id="tolakukur"></textarea></td>
            </tr>
            <tr>
              <td height="42">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td height="24">Standar</td>
              <td>:</td>
              <td colspan="2" rowspan="2"><textarea name="standar" rows="5" id="standar"></textarea></td>
            </tr>
            <tr>
              <td height="24">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>Laporan Kejadian</td>
              <td>:</td>
              <td colspan="2"><input type="radio" name="statlap" id="Ya" checked>
              Ya</td>
            </tr>
            <tr>
              <td height="24">&nbsp;</td>
              <td>&nbsp;</td>
              <td colspan="2"><input type="radio" name="statlap" id="Tidak">
              Tidak</td>
            </tr>
            <tr>
              <td>Indikator</td>
              <td>:</td>
              <td colspan="2"><input type="radio" name="stat_group" id="IAK" value="IAK" checked>
              IAK</td>
            </tr>
            <tr>
              <td height="24">&nbsp;</td>
              <td>&nbsp;</td>
              <td colspan="2"><input type="radio" name="stat_group" id="IAM" value="IAM">
              IAM</td>
            </tr>
            <tr>
              <td height="24">&nbsp;</td>
              <td>&nbsp;</td>
              <td colspan="2"><input type="radio" name="stat_group" id="ISKP" value="ISKP">
              ISKP</td>
            </tr>
            <tr>
              <td>Numerator</td>
              <td> : </td>
              <td colspan="2"><input type="radio" name="statnum" id="Ya" checked>Ya</td>
            </tr>
            <tr>
              <td height="24">&nbsp;</td>
              <td>&nbsp;</td>
              <td colspan="2"><input type="radio" name="statnum" id="Tidak">
              Tidak</td>
            </tr>
            <tr>
              <td>Denominator</td>
              <td>:</td>
              <td colspan="2"><input type="radio" name="statden" id="Ya" checked>Ya</td>
            </tr>
            <tr>
              <td height="24">&nbsp;</td>
              <td>&nbsp;</td>
              <td colspan="2"><input type="radio" name="statden" id="Tidak">
              Tidak</td>
            </tr>
            <tr>
              <td>Departemen</td>
              <td>:</td>
              <td colspan="2"><span class="inputan">
            <select id="departemen" name="departemen">
           
			  <option value="">---------------- P I L I H ----------------</option>
              <?php
			foreach ($arrdept as $dept=>$kode) {
				echo "<option value='$kode'>$kode</option>";
			}
			?>
            </select>
          </span></td>
            </tr>
            <tr>
              <td>Unit</td>
              <td>:</td>
              <td colspan="2"> <select id="unit_kerja" name="unit_kerja" onChange="();">
					<option value="">---------------- P I L I H ----------------</option>
					</select></td>
            </tr>
            <tr>
              <td>Status</td>
              <td>:</td>
              <td colspan="2"><input type="radio" name="statindikator" id="aktif" checked>
              Aktif</td>
            </tr>
            <tr>
              <td height="43">&nbsp;</td>
              <td>&nbsp;</td>
              <td colspan="2"><input type="radio" name="statindikator" id="nonaktif">
              Non-Aktif</td>
            </tr>
            <tr>
              <td height="43">&nbsp;</td>
              <td>&nbsp;</td>
              <td colspan="2"><button onClick="saveindikator();">Save</button>  
            <button onClick="clearindikator();">Reset</button></td>
            </tr>
          </table>
          <p>       
          </p> 		
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
  function saveindikator(){
    var kode;
    var aspek;
	  var standar;
    var tolakukur;
    var departemen;
	  var unit_kerja;
    // var numerator;
    // var denominator;

	
    kode		= document.getElementById('kode').value;

    aspek		= document.getElementById('aspek').value;

	  standar		= document.getElementById('standar').value;

    tolakukur = document.getElementById('tolakukur').value;

    departemen	= document.getElementById('departemen').value;

	  unit_kerja	= document.getElementById('unit_kerja').value;

    // numerator = document.getElementById('numerator').value;

    // denominator = document.getElementById('denominator').value;
	

    var cekradiobuttonlap = document.getElementById('Ya');
    if (cekradiobuttonlap.checked){
      statlap = "X";
    }else{
      statlap = "";
    }

    var cekradiobuttonnum = document.getElementById('Ya');
    if (cekradiobuttonnum.checked){
      statnum = "X";
    }else{
      statnum = "";
    }

    var cekradiobuttonden = document.getElementById('Ya');
    if (cekradiobuttonden.checked){
      statden = "X";
    }else{
      statden = "";
    }

    var cekradiobuttontipe = document.getElementById('IAK');
    var cekradiobuttontipe = document.getElementById('IAM');
    var cekradiobuttontipe = document.getElementById('ISKP');

    if(document.getElementById('IAK').checked) {
      stat_group = "IAK";
    }else if(document.getElementById('IAM').checked) {
      stat_group = "IAM";
    }else if(document.getElementById('ISKP').checked) {
      stat_group = "ISKP";
    }
	
    var cekradiobutton = document.getElementById('aktif');
    if (cekradiobutton.checked){
      statindikator = "X";
    }else{
      statindikator = "";
    }

    var simpan;
    simpan = "baru";

	 
	
    if (aspek) {
      window.location.href='M_Indikator_Save.php?kode=' + kode + '&aspek=' + aspek + '&standar=' + standar + '&tolakukur=' + tolakukur + '&departemen=' + departemen + '&unit=' + unit_kerja + '&statindikator=' + statindikator + '&statlap=' + statlap + '&stat_group=' + stat_group + '&statnum=' + statnum + '&statden=' + statden + '&simpan=' + simpan;
    } else {
      alert("Kolom 'Aspek' harus diisi..");
    }
  }

  function clearindikator(){
    //document.getElementById('kode').value = '';
    document.getElementById('aspek').value = '';
	  document.getElementById('standar').value = '';
    document.getElementById('tolakukur').value = '';
    document.getElementById('departemen').value = '';
	  document.getElementById('unit_kerja').value = '';
    radiobtn = document.getElementById("aktif");
    radiobtn.checked = true;
    radiobtn = document.getElementById("nonaktif");
    radiobtn.checked = false;
  }
</script>
		
<script src="js/excanvas.min.js"></script>
<script src="js/chart.min.js" type="text/javascript"></script>
<script src="js/bootstrap.js"></script>
<script src="js/Script.js"></script>
<script language="javascript" type="text/javascript" src="js/full-calendar/fullcalendar.min.js"></script>

<script src="js/base.js"></script>

</body>
</html>
