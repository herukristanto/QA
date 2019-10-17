<?php
include "koneksi.php";
{
  #ambil insiden
    $query  = "SELECT * FROM M_Insiden WHERE Mark = 'X' ORDER BY Kode ASC ";
    $sql    = sqlsrv_query($conn, $query);
    $arrind = array();
    while ($row = sqlsrv_fetch_array($sql)) {
      $arrind [ $row['Kode'] ] = $row['Insiden'];
    }
  } 


{
  #ambil tipe insiden
    $query  = "SELECT * FROM M_Tipe_Insiden WHERE Mark = 'X' ORDER BY Kode_tipe ASC ";
    $sql    = sqlsrv_query($conn, $query);
    $arrtipe = array();
    while ($row = sqlsrv_fetch_array($sql)) {
      $arrtipe [ $row['Kode_tipe'] ] = $row['Tipe_insiden'];
    }
  } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Sub Tipe Insiden - Display</title>
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
					<span class="style1">Display Sub Tipe Insiden</span><br>
					<table>
			            <tr>
			              <td>Kode Sub Tipe</td>
			              <td> : </td>
			              <td><input name="Kd_sub" type="text" id="Kd_sub" maxlength="15" disabled="disabled" size="8" readonly="readonly"
			        style="text-align:center;font-weight:bold;font-size:16px" /></td>
			            </tr>
			                        <tr>
			              <td>Kode Tipe Insiden</td>
			              <td>:</td>
			              <td colspan="2"><span class="inputan">
			            <select id="Kd_tipe" name="Kd_tipe" style="text-align:center;font-weight:bold;width: auto;" disabled="disabled" />
			              <option value="" ></option>
			              <?php
			      foreach ($arrtipe as $Kode_tipe=>$Tipe_insiden) {
			        echo "<option value='$Kode_tipe'>$Kode_tipe - $Tipe_insiden</option>";
			      }
			      ?>
			            </select>
			          </span></td>
			            <td colspan="2">
			                  <span id="ini"></span>
			                </td>
			            </tr>
			            <tr>
			              <td>Kode Insiden</td>
			              <td>:</td>
			              <td colspan="2"><span class="inputan">
			            <select id="Kd_insiden" name="Kd_insiden" style="text-align:center;font-weight:bold;font-size:15px" disabled="disabled" />
			              <option value="" ></option>
			              <?php
			      foreach ($arrind as $Kode=>$Insiden) {
			        echo "<option value='$Kode'>$Kode - $Insiden</option>";
			      }
			      ?>
			            </select>
			          </span></td>
			            </tr>
			            <tr>
			              <td>Sub Tipe Insiden</td>
			              <td> : </td>
			              <td><input type="text" id="Sub_tipe_insiden" name="Sub_tipe_insiden" style="text-align:left;font-weight:bold;width: auto;" disabled="disabled"></td>
			            </tr>
			            <tr>
			              <td>Status</td>
			              <td>:</td>
			              <td colspan="2"><input type="radio" name="Status_sub" id="aktif" checked disabled>
			              Aktif</td>
			            </tr>
			            <tr>
			              <td height="43">&nbsp;</td>
			              <td>&nbsp;</td>
			              <td colspan="2"><input type="radio" name="Status_sub" id="nonaktif" disabled>
			              Non-Aktif</td>
			            </tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td colspan="2"><button id="myBtn">Search</button> &nbsp;
					<button>Exit</button></td>
						</tr>
					</table>

					<?php include "M_Sub_Tipe_Insiden_Search.php"; ?>

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
	function savesubtipeinsiden(){
    var kd_sub;
    var kd_tipe;
    var kd_insiden;
    var sub_tipe_insiden;

    kd_sub            = document.getElementById('kd_sub').value;
    kd_tipe           = document.getElementById('kd_tipe').value;
    kd_insiden        = document.getElementById('kd_insiden').value;
    sub_tipe_insiden  = document.getElementById('sub_tipe_insiden').value;

    var cekradiobutton = document.getElementById('aktif');
    if (cekradiobutton.checked){
      status_sub = "X";
    }else{
      status_sub = " ";
    }

    var simpan;
    simpan = "baru";

    if (sub_tipe_insiden) {
      window.location.href='M_Sub_Tipe_Insiden_Save.php?kd_sub=' + kd_sub + '&kd_tipe=' + kd_tipe + '&kd_insiden=' + kd_insiden + '&sub_tipe_insiden=' + sub_tipe_insiden + '&status_sub=' + status_sub + '&simpan=' + simpan;
    } else {
      alert("Kolom 'Sub Tipe Insiden' harus diisi..");
    }
  }

  function clearsubtipeinsiden(){
    document.getElementById('kd_tipe').value = '-------------- P I L I H --------------';
    document.getElementById('kd_insiden').value = '-------------- P I L I H --------------';
    document.getElementById('sub_tipe_insiden').value ='';
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
