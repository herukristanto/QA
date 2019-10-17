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
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>User Form</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
<!-- <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet"> -->
<link href="css/fontGoogle.css" rel="stylesheet">
<link href="css/css/font-awesome.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/pages/dashboard.css" rel="stylesheet">
<script src="js/jquery-1.7.2.min.js"></script>

<style>
  td{
    padding-left: 3px;
    vertical-align: middle;
  }
  td.mid{
    padding-left: 0px;
    text-align: center;
  }
</style>

<script type="text/javascript" src="libs/jquery.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function()
			{
			
				$('#departemen').change(function()
				{	
					$.getJSON('UserForm.php',{action:'getUnker', kode_dept:$(this).val()}, function(json)
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
<div id="header_user"></div>
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span12 mainPage">
          <p>
            <button type="button" class='btn' id="OK" onClick="saveUser();">Save</button>
            <button type="button" class='btn' id="New" onClick="clearAll();">Reset</button>
          </p>
          <table>
            <tr>
              <td>User ID</td>
              <td> : </td>
              <td><input type="text" id="userid" name="userid"></td>
            </tr>
            <tr>
              <td>Username</td>
              <td> : </td>
              <td><input type="text" id="username" name="username"></td>
            </tr>
			     <tr>
              <td>Departemen</td>
              <td>:</td>
              <td colspan="2">
			  <select id="departemen" name="departemen">
           
			  <option value=""></option>
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
					<option value=""></option>
					</select></td>
            </tr>
            <tr>
              <td>Status</td>
              <td>:</td>
              <td colspan="2"><input type="radio" name="status" id="aktif" checked>
              Aktif</td>
            </tr>
            <tr>
              <td height="43">&nbsp;</td>
              <td>&nbsp;</td>
              <td colspan="2"><input type="radio" name="status" id="nonaktif">
              Non-Aktif</td>
            </tr>
          </table>
          --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
          <br>
          <h3>User List</h3>
          <table style="margin-top:10px;">
            <tr>
              <td>Search User ID</td>
              <td> : </td>
              <td><input type="text" id="katakunci" name="katakunci"></td>
              <td><button type="button" class="btn" id="saringtabel">Search</button></td>
            </tr>
          </table>
          <div id="tampiltabel"></div>
        </div>
      </div>
    </div>
  </div>
</div>

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

<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script>
    function clearAll()
    {
        document.getElementById("userid").value = "";
        document.getElementById("username").value = "";
        document.getElementById("OK").innerHTML = "Create";
        document.getElementById("userid").value = "";
		document.getElementById("departemen").value = "";
		document.getElementById("unit").value = "";
    }

    function saveUser()
    {
        var id;
		var name;
		var dept;
		var unit;
		var status;
		
		var cekradiobutton = document.getElementById('aktif');
			if (cekradiobutton.checked){
				status = "X";
			}else{
				status = "";
		}
		
        id		= document.getElementById("userid").value;
        name	= document.getElementById("username").value;
		dept	= document.getElementById("departemen").value;
		unit	= document.getElementById("unitkerja").value;
		status	= document.getElementById("status").value;
		
		
		
        if(id != "" && name != "" && dept !="" && unit !="")
        {
            window.location = "UserSave.php?id=" + id + "&name=" + name + "&dept=" + dept + "&unit=" + unit
			+ "&status=" + status;
        }
        else
        {
            alert("Lengkapi semua data terlebih dahulu");
        }
        document.getElementById("OK").innerHTML = "Create";
        document.getElementById("userid").readOnly = false;
		document.getElementById("departemen").readonly = false;
		document.getElementById("unit").readonly = false;

    }
    $(document).ready(function(){
        $("#saringtabel").click(function()
        {
            $("#tampiltabel").empty();
            $("#tampiltabel").html("<h2>Please Wait. . . .</h2>");
            $("#tampiltabel").load('TabelUser.php?katakunci='+$("#katakunci").val());
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
