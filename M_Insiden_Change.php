<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Insiden - Change</title>
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
					<span class="style1">Change Insiden</span><br>
					<table>
						<tr>
							<td>Kode Insiden</td>
							<td> : </td>
							<td><input type="text" id="kd_insiden" name="kodeinsiden" disabled="disabled" size="8" maxlength="6" readonly="readonly"
        style="text-align:center;font-weight:bold;font-size:16px" /></td>
						</tr>
						<tr>
							<td>Deskripsi</td>
							<td> : </td>
							<td><textarea name="deskripsi" id="desk_insiden"></textarea></td>
						</tr>
						<tr>
						  <td>Aktif</td>
						  <td>:</td>
						  <td colspan="2"><input type="radio" name="statinsiden" id="aktif" checked>
					      Aktif</td>
					  </tr>
						<tr>
						  <td height="52">&nbsp;</td>
						  <td>&nbsp;</td>
						  <td colspan="2"><input type="radio" name="statinsiden" id="nonaktif">
					      Non-Aktif</td>
					  </tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td colspan="2"><button id="myBtn">Search</button> &nbsp;
											<button onClick="saveinsiden();">Save</button> &nbsp;
											<button onClick="clearinsiden();">Cancel</button> &nbsp;</td>
						</tr>
					</table>

					<?php include "M_Insiden_Search.php"; ?>
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
	function saveinsiden(){
		var kd_insiden;
		var desk_insiden;
		var statinsiden;
		
		kd_insiden = document.getElementById('kd_insiden').value;
		desk_insiden = document.getElementById('desk_insiden').value;

		var cekradiobutton = document.getElementById('aktif');
		if (cekradiobutton.checked){
			statinsiden = "X";
		}else{
			statinsiden = "";
		}
		var simpan;
		simpan = "ubah";

		if (desk_insiden) {
			window.location.href='M_Insiden_Save.php?kd_insiden=' + kd_insiden + '&desk_insiden=' + desk_insiden + '&statinsiden=' + statinsiden + '&simpan=' + simpan;
		} else {
			alert("Kolom 'Nama' harus diisi..");
		}
	}

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
