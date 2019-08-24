<?php
include "koneksi.php";
	
#ambil data
$query = "SELECT * FROM M_Departemen WHERE Status ='X' ";
$sql = sqlsrv_query($conn, $query);
$arrdept = array();
while ($row = sqlsrv_fetch_array($sql)) {
	$arrdept [ $row['Deskripsi'] ] = $row['Kode'];
	
}		

#action get unitkerja
if(isset($_GET['action']) && $_GET['action'] == "getUnker") {
	$kode_dept = $_GET['kode_dept'];
	
#ambil data unitkerja
	$query = "Select * from V_UnitKerja where kode_dept= '$kode_dept' AND status_unit='X'";
	$sql = sqlsrv_query($conn, $query);
	$arrker = array();
	while ($row = sqlsrv_fetch_array($sql)) {
		array_push($arrker, $row);
	}
	echo json_encode($arrker);
	exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">  
<title>Group - Create</title>
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
					$.getJSON('M_Group_Create.php',{action:'getUnker', kode_dept:$(this).val()}, function(json)
					{	
						$('#unitkerja').html('');
						$.each(json, function(index, row) 
						{
							//$('#unitkerja').append('<option value="'+row.kode_unit+' - '+row.Unit_Kerja+'">'+row.kode_unit+' - '+row.Unit_Kerja+'</option>');
							$('#unitkerja').append('<option value="'+row.Unit_Kerja+'">'+row.Unit_Kerja+'</option>');
							
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
          <span class="style1">Create Group </span><br>
          <table>
            <tr>
              <td>Kode Group </td>
              <td> : </td>
              <td><input name="kd_group" type="text" id="kd_group" maxlength="6" disabled=""></td>
            </tr>
            <tr>
              <td>Deskripsi</td>
              <td> : </td>
              <td><input type="text" id="desk_group" name="deskripsi" maxlength="50"></td>
            </tr>
            <tr>
              <td>Departemen</td>
              <td>:</td>
              <td colspan="2">
			  <select id="departemen" name="departemen">
           
			  <option value="">---------------- P I L I H ----------------</option>
              <?php
			foreach ($arrdept as $dept=>$kode) {
				echo "<option value='$kode'>$kode</option>";
			}
			?>
            </select></td>
            </tr>
            <tr>
              <td>Unit</td>
              <td>:</td>
              <td colspan="2">
			  <select id="unitkerja" name="unitkerja" onChange="();">
					<option value="">---------------- P I L I H ----------------</option>
					</select></td>
            </tr>
            <tr>
              <td>Status</td>
              <td>:</td>
              <td colspan="2"><input type="radio" name="statgroup" id="aktif" checked>
              Aktif</td>
            </tr>
            <tr>
              <td height="43">&nbsp;</td>
              <td>&nbsp;</td>
              <td colspan="2"><input type="radio" name="statgroup" id="nonaktif">
              Non-Aktif</td>
            </tr>
            <tr>
              <td height="43">&nbsp;</td>
              <td>&nbsp;</td>
              <td colspan="2"><button onClick="savegroup();">Save</button>  
            <button onClick="cleargroup();">Reset</button></td>
            </tr>
          </table>

          <p> 
            <?php include "M_Group_Search.php"; ?>
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
  function savegroup(){
    var kd_group;
    var desk_group;
    var departemen;
	var unitkerja;
	var statgroup;
	
    kd_group = document.getElementById('kd_group').value;
    desk_group = document.getElementById('desk_group').value;
    departemen = document.getElementById('departemen').value;
	unitkerja = document.getElementById('unitkerja').value;

    var cekradiobutton = document.getElementById('aktif');
    if (cekradiobutton.checked){
      statgroup = "X";
    }else{
      statgroup = "";
    }

    var simpan;
    simpan = "baru";

    if (desk_group) {
      window.location.href='M_Group_Save.php?kd_group=' + kd_group + '&desk_group=' + desk_group + '&departemen=' + departemen + '&unitkerja=' + unitkerja + '&statgroup=' + statgroup + '&simpan=' + simpan;
    } else {
      alert("Kolom 'deskripsi' harus diisi..");
    }
  }

  function cleargroup(){
    document.getElementById('desk_group').value = '';
    document.getElementById('kd_group').value = '';
    document.getElementById('departemen').value = '';
	document.getElementById('unitkerja').value = '';
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
