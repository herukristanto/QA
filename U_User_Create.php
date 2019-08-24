<?php
include "koneksi.php";
	
#ambil data
$query = "SELECT * FROM M_Departemen WHERE Status='X'";
$sql = sqlsrv_query($conn, $query);
$arrdept = array();
while ($row = sqlsrv_fetch_array($sql)) {
	$arrdept [ $row['Deskripsi'] ] = $row['Kode'];
	
}		

#action get unit_kerja
if(isset($_GET['action']) && $_GET['action'] == "getUnker") {
	$kode_dept = $_GET['kode_dept'];
	
#ambil data unit_kerja
	$query = "Select * from V_UnitKerja where kode_dept= '$kode_dept'";
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
<title>User - Create</title>
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
					$.getJSON('U_User_Create.php',{action:'getUnker', kode_dept:$(this).val()}, function(json)
					{	
						$('#unit_kerja').html('');
						$.each(json, function(index, row) 
						{
							$('#unit_kerja').append('<option value="'+row.Unit_Kerja+'">'+row.Unit_Kerja+'</option>');
						});
					});
				});
			});
		</script>
		
		<script type="text/javascript" src="libs/jquery.min.js"></script>

</head>
<body>
<div id="header_user"></div>
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span12 mainPage">
          
          <br>
          <span class="style1">Create User </span><br>
          <table>
            <tr>
              <td>ID</td>
              <td> : </td>
              <td><input name="ID" type="text" id="id_user" size="8" maxlength="8"></td>
            </tr>
            <tr>
              <td>Name</td>
              <td>:</td>
              <td><input name="name" type="text" id="name" size="15" maxlength="15"></td>
            </tr>
            <tr>
              <td>Departemen</td>
              <td> : </td>
              <td><select id="departemen" name="departemen">
                <option value="">--Pilih--</option>
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
              <td colspan="2"><select id="unit_kerja" name="unit_kerja" onChange="();">
                <option value="">--Pilih--</option>
              </select></td>
            </tr>
            <tr>
              <td>Status</td>
              <td>:</td>
              <td colspan="2"><input type="radio" name="statuser" id="aktif" checked>
              Aktif</td>
            </tr>
            <tr>
              <td height="43">&nbsp;</td>
              <td>&nbsp;</td>
              <td colspan="2"><input type="radio" name="statuser" id="nonaktif">
              Non-Aktif</td>
            </tr>
            <tr>
              <td height="43">&nbsp;</td>
              <td>&nbsp;</td>
              <td colspan="2"><button onClick="saveuser();">Save</button>  
            <button onClick="clearuser();">Cancel</button></td>
            </tr>
          </table>

          <p> 
            <?php include "U_User_Search.php"; ?>
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
  function saveuser(){
    var id_user;
	var name;
    var departemen;
	var unit_kerja;
    id_user = document.getElementById('id_user').value;
	name = document.getElementById('name').value;
	departemen = document.getElementById('departemen').value;
    unit_kerja = document.getElementById('unit_kerja').value;

    var cekradiobutton = document.getElementById('aktif');
    if (cekradiobutton.checked){
      statuser = "X";
    }else{
      statuser = " ";
    }

    var simpan;
    simpan = "baru";

    if (id_user) {
      window.location.href='U_User_Save.php?id_user=' + id_user + '&name=' + name + '&departemen=' + departemen + '&unit_kerja=' + unit_kerja + '&statuser=' + statuser + '&simpan=' + simpan;
    } else {
      alert("Kolom 'ID' harus diisi..");
    }
  }

  function clearuser(){
    document.getElementById('id_user').value = '';
	document.getElementById('name').value = '';
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
