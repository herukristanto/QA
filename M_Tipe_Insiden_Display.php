<?php
include "koneksi.php";
{
  #ambil data semua
    $query  = "SELECT * FROM M_Insiden WHERE Mark = 'X'";
    $sql    = sqlsrv_query($conn, $query);
    $arrind = array();
    while ($row = sqlsrv_fetch_array($sql)) {
      $arrind [ $row['Kode'] ] = $row['Insiden'];
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Tipe Insiden - Display</title>
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
					<span class="style1">Display Tipe Insiden</span><br>
					<table>
						 <tr>
			              <td>Kode Tipe</td>
			              <td> : </td>
			              <td><input name="kd_tipe" type="text" id="kd_tipe" maxlength="3" disabled="disabled" size="8" maxlength="6" readonly="readonly"
			        style="text-align:center;font-weight:bold;font-size:16px" /></td>
			            </tr>
			            <tr>
			              <td>Kode Insiden</td>
			              <td>:</td>
			              <td colspan="2"><span class="inputan">
			            <select id="kd_insiden" name="kd_insiden" style="text-align:center;font-weight:bold;width: auto;" disabled="disabled" />
			              <option value=""></option>
			              <?php
			      foreach ($arrind as $Kode=>$Insiden) {
			        echo "<option value='$Kode'>$Kode - $Insiden</option>";
			      }
			      ?>
			            </select>
			          </span></td>
			            </tr>
			            <tr>
			            <tr>
			              <td>Tipe Insiden</td>
			              <td> : </td>
			              <td><input type="text" id="tipe_insiden" name="tipe_insiden" maxlength="255" disabled="disabled"></td>
			            </tr>
			            <tr>
			              <td>Status</td>
			              <td>:</td>
			              <td colspan="2"><input type="radio" name="status_tipe" id="aktif" checked disabled>
			              Aktif</td>
			            </tr>
			            <tr>
			              <td height="43">&nbsp;</td>
			              <td>&nbsp;</td>
			              <td colspan="2"><input type="radio" name="status_tipe" id="nonaktif" disabled>
			              Non-Aktif</td>
			            </tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td colspan="2"><button id="myBtn">Search</button> &nbsp;
					<button onclick="document.location.href='main.php';">Exit</button></td>
						</tr>
					</table>
					<p>
					<?php include "M_Tipe_Insiden_Search.php"; ?>
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
	// function saveinsiden(){
	// 	var kd_insiden;
	// 	var desk_insiden;
	// 	var statinsiden;

	// 	kd_insiden = document.getElementById('kd_insiden').value;
	// 	desk_insiden = document.getElementById('desk_insiden').value;

	// 	var cekradiobutton = document.getElementById('aktif');
	// 	if (cekradiobutton.checked){
	// 		statinsiden = "X";
	// 	}else{
	// 		statinsiden = " ";
	// 	}

	// 	if (desk_insiden) {
	// 		window.location.href='M_Insiden_Save.php?kd_insiden=' + kd_insiden + '&desk_insiden=' + desk_insiden + '&statinsiden=' + statinsiden;
	// 	} else {
	// 		alert("Kolom 'Deskripsi' harus diisi..");
	// 	}
	// }

	function clearinsiden(){
		document.getElementById('desk_insiden').value = '';
		document.getElementById('kd_insiden').value = '';
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
