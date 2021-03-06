<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Departemen - Change</title>
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
include "koneksi.php";
{
	#ambil data semua
		$query = "SELECT * FROM M_Departemen WHERE Status = 'X'";
		$sql = sqlsrv_query($conn, $query);
		$arrind = array();
		while ($row = sqlsrv_fetch_array($sql)) {
			$arrind [ $row['Kode'] ] = $row['Kode'];
		}
	}
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
</head>
<body>
<div id="header_mstr"></div>
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span12 mainPage">

					<br>
					<span class="style1">Change Unit </span><br>
					<table>
						<tr>
							<td>Kode Unit </td>
							<td> : </td>
							<td><input type="text" id="kd_unit" name="kodeunit" disabled></td>
						</tr>
						<tr>
							<td>Deskripsi</td>
							<td> : </td>
							<td><input type="text" id="desk_unit" name="deskripsi" maxlength="50"></td>
						</tr>
						<tr>
						  <td>Departemen</td>
						  <td>:</td>
						  <td colspan="2"><span class="inputan">
						    <select id="departemen" name="departemen">
                              <option value="">---------------- P I L I H ----------------</option>
                              <?php
								foreach ($arrind as $Kode=>$Kode) {
									echo "<option value='$Kode'>$Kode</option>";
								}
								?>
                            </select>
						  </span></td>
					  </tr>
						<tr>
						  <td>Aktif</td>
						  <td>:</td>
						  <td colspan="2"><input type="radio" name="statunit" id="aktif" checked>
					      Aktif</td>
					  </tr>
						<tr>
						  <td height="52">&nbsp;</td>
						  <td>&nbsp;</td>
						  <td colspan="2"><input type="radio" name="statunit" id="nonaktif">
					      Non-Aktif</td>
					  </tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td colspan="2"><button id="myBtn">Search</button>  
											<button onClick="saveunit();">Save</button>  
											<button onClick="clearunit();">Reset</button>  </td>
						</tr>
					</table>

					<?php include "M_Unit_Search.php"; ?>
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
	function saveunit(){
		var kd_unit;
		var desk_unit;
		var statunit;
		var departemen;
		kd_unit = document.getElementById('kd_unit').value;
		desk_unit = document.getElementById('desk_unit').value;
		departemen = document.getElementById('departemen').value;

		var cekradiobutton = document.getElementById('aktif');
		if (cekradiobutton.checked){
			statunit = "X";
		}else{
			statunit = " ";
		}
		var simpan;
		simpan = "ubah";

		if (desk_unit) {
			window.location.href='M_Unit_Save.php?kd_unit=' + kd_unit + '&desk_unit=' + desk_unit + '&departemen=' + departemen + '&statunit=' + statunit + '&simpan=' + simpan;
		} else {
			alert("Kolom 'Deskripsi' harus diisi..");
		}
	}

	function cleardokter(){
		document.getElementById('desk_unit').value = '';
		document.getElementById('kd_unit').value = '';
		document.getElementById('departemen').value = '';
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


<script type="text/javascript" src="libs/jquery.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function()
			{
				$('#departemen').change(function()
				{
					$.getJSON('M_Unit_Change.php',{action:'getdepartemen', departemen:$(this).val()}, function(json)
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

<script src="js/base.js"></script>

</body>
</html>
