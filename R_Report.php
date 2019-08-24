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
	$query = "Select * from V_UnitKerja where kode_dept= '$kode_dept'";
	$sql = sqlsrv_query($conn, $query);
	$arrker = array();
	while ($row = sqlsrv_fetch_array($sql)) {
		array_push($arrker, $row);
	}
	echo json_encode($arrker);
	exit;
}
	
#ambil data
//$query = "SELECT * FROM M_Departemen WHERE Status ='X' ";
//$sql = sqlsrv_query($conn, $query);
//$arrdept = array();
//while ($row = sqlsrv_fetch_array($sql)) {
//	/*$arrdept [ $row['Deskripsi'] ] = $row['Kode'];*/
//	$arrdept [ $row['Kode'] ] = $row['Deskripsi'];
//	
//}		

/*#action get unitkerja
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
}*/
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"> 
<title>Report</title>
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
div.mainPage{
  min-height: 600px;
}

td{
  padding-left: 3px;
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
							<!--$('#unitkerja').append('<option value="'+row.kode_unit+' - '+row.Unit_Kerja+'">'+row.kode_unit+' - '+row.Unit_Kerja+'</option>');-->
							$('#unitkerja').append('<option value="'+row.Unit_Kerja+'">'+row.Unit_Kerja+'</option>');
						});
					});
				});
			});
		</script>
		
		<script type="text/javascript" src="libs/jquery.min.js"></script>
		
</head>
<body>
<div id="header_rpt"></div>
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span12 mainPage">
         
          <table id="myTable_2">
		  <form action="R_Report_Preview.php" target="my-iframe_2" method="post">
            
            <tr>
              <td width="110">Tahun</td>
              <td width="19"> : </td>
              <td width="733"><input type="text" id="tahun" name="tahun" maxlength="4"></td>
              <td width="278">&nbsp;</td>
              </tr>
            <tr>
              <td>Departemen</td>
              <td> : </td>
              <td><select id="departemen" name="departemen">
           
			  <option value="">---------------- P I L I H ----------------</option>
              <?php
			foreach ($arrdept as $dept=>$kode) {
				echo "<option value='$kode'>$kode</option>";
			}
			?>
            </select></td>
              <td>&nbsp;</td>
              </tr>
            
            <tr>
              <td>Unit</td>
              <td>:</td>
              <td colspan="2">
			  <select id="unitkerja" name="unitkerja" onChange="();">
					<option value="">---------------- P I L I H ----------------</option>
					</select></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="3">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="3"><input type="submit" value="Show" onClick="show();"></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="4"></td>
            </tr>
            <tr>
              <td colspan="4"></td>
            </tr>
			<tr>
			<td colspan="4" hidden><iframe name="my-iframe_2" src="R_Report_Preview.php" width=1200 height=350></iframe></td>
			</tr>
			</form>
          </table>

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

		function show() {
			var table = document.getElementById("myTable_2");
			table.rows[4].cells[0].removeAttribute('hidden');
			table.rows[5].cells[0].removeAttribute('hidden');
			table.rows[6].cells[0].removeAttribute('hidden');
			table.rows[7].cells[0].removeAttribute('hidden');
			table.rows[8].cells[0].removeAttribute('hidden');
			document.getElementById("btnshow").setAttribute('disabled','true');
			
			var tahun;
			var departemen;
			var unitkerja;
			
			tahun = document.getElementById('tahun').value;
			departemen = document.getElementById('departemen').value;
			unitkerja = document.getElementById('unitkerja').value;


		}
		
	
</script>



<script>
  function button(x)
  {
    window.location.href = x;
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
