<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>T - Invest - Change</title>
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
<?php

#get date time current
date_default_timezone_set("Asia/Jakarta");
$date_time 	= date("Y-m-d H:i:s");
$tgl 	= date("Y-m-d");
$jam = date('G:i:s');

include "koneksi.php";

date_default_timezone_set("Asia/Jakarta");

$date = '2019-02-15 16:56:01';

$month  = date('m');
$year   = date('Y');

?>

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
</head>
<body>
<div id="header_trn"></div>
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span12 mainPage">
          <br>

          </br>
  <span class="style1">Change Tindah Lanjut  ( Rendah / Moderat )</span><br>
    <td>&nbsp;</td>

          <table>
            <tr>
              <td>Formulir investigasi sederhana</td>
              <td height="42">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>No. Invest</td>
              <td> : </td>
              <td><input type="text" name="no_invest" id="no_invest" style="text-align:center;font-weight:bold;font-size:14px" readonly="readonly"></td>
              <td><button id="myBtn">Search</button></td>
            </tr>
            <tr>
              <td>No. Laporan</td>
              <td> : </td>
              <td><input type="text" id="no_lap" name="no_lap" style="text-align:center;font-weight:bold;font-size:14px" readonly="readonly"></td>
            </tr>
            <tr>
              <td>Penyebab langsung insiden</td>
              <td> : </td>
              <td colspan="2" rowspan="2"><textarea rows="4" id="penyebab_langsung" name="penyebab_langsung" value="penyebab_langsung" maxlength="50"></textarea></td>
            </tr>
            <tr>
              <td height="42">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>Penyebab yang melatarbelakangi/ akar masalah insiden</td>
              <td> : </td>
              <td colspan="2" rowspan="2"><textarea rows="4" id="akar_masalah" name="akar_masalah" value="akar_masalah" maxlength="50"></textarea></td>
            </tr>
            <tr>
              <td height="42">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>Tindakan yang akan dilakukan (rencana jangka pendek)</td>
              <td> : </td>
              <td colspan="2" rowspan="2"><textarea rows="4" id="tindakan" name="tindakan" value="tindakan" maxlength="50"></textarea></td>
            </tr>
            <tr>
              <td height="42">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Penanggung jawab</td>
              <td> : </td>
              <td><input type="text" id="penanggung_jawab_1" name="penanggung_jawab_1" maxlength="20" ></td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Perkiraan waktu pelaksanaan</td>
              <td> : </td>
              <td><input name="perkiraan_waktu_1" type="text" id="perkiraan_waktu_1" value="<?php
             if(isset($app['App_Date']))
               {echo $app['App_Date']->format('d/m/Y');}
             else
               {echo date('d/m/Y');} ?>" style="text-align:center;font-weight:bold;font-size:14px"/></td>
            </tr>
            <tr>
              <td>Rekomendasi (rencana jangka panjang)</td>
              <td> : </td>
              <td colspan="2" rowspan="2"><textarea rows="4" id="rekomendasi" name="rekomendasi" maxlength="50" ></textarea></td>
            </tr>
            <tr>
              <td height="42">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Penanggung jawab</td>
              <td> : </td>
              <td><input type="text" id="penanggung_jawab_2" name="penanggung_jawab_2" maxlength="20"></td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Perkiraan waktu pelaksanaan</td>
              <td> : </td>
              <td><input name="perkiraan_waktu_2" type="text" id="perkiraan_waktu_2" value="<?php
             if(isset($app['App_Date']))
               {echo $app['App_Date']->format('d/m/Y');}
             else
               {echo date('d/m/Y');} ?>" style="text-align:center;font-weight:bold;font-size:14px"/></td>
            </tr>
            <tr>
              <td height="43">&nbsp;</td>
              <td>&nbsp;</td>
              <td colspan="2"><button onClick="update_invest();">Update</button>
                <button onClick="clearinvest();">Reset</button></td>
            </tr>
          </table>

     <table>
        <tr>
          <td colspan="2">&nbsp;</td>
          <td colspan="2">&nbsp;</td>

        </tr>
      </table>

          <p>
            <?php include "T_Invest_Search_No_Invest.php"; ?>
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
function update_invest(){
  // tinggi && extrim
  var no_lap;
  // rendah && moderat
  var no_invest;
  var penyebab_langsung;
  var akar_masalah;
  var tindakan;
  var penanggung_jawab_1;
  var perkiraan_waktu_1;
  var rekomendasi;
  var penanggung_jawab_2;
  var perkiraan_waktu_2;

  no_lap              = document.getElementById('no_lap').value;
  // rendah && moderat
  no_invest           = document.getElementById('no_invest').value;
  penyebab_langsung   = document.getElementById('penyebab_langsung').value;
  akar_masalah        = document.getElementById('akar_masalah').value;
  tindakan            = document.getElementById('tindakan').value;
  penanggung_jawab_1  = document.getElementById('penanggung_jawab_1').value;
  perkiraan_waktu_1   = document.getElementById('perkiraan_waktu_1').value;
  rekomendasi         = document.getElementById('rekomendasi').value;
  penanggung_jawab_2  = document.getElementById('penanggung_jawab_2').value;
  perkiraan_waktu_2   = document.getElementById('perkiraan_waktu_2').value;

  if (no_invest) {
    window.location.href = "T_Invest_Update.php?a1=" + no_lap +
    "&rm1=" + no_invest +
    "&rm2=" + penyebab_langsung +
    "&rm3=" + akar_masalah +
    "&rm4=" + tindakan +
    "&rm5=" + penanggung_jawab_1 +
    "&rm6=" + perkiraan_waktu_1 +
    "&rm7=" + rekomendasi +
    "&rm8=" + penanggung_jawab_2 +
    "&rm9=" + perkiraan_waktu_2;
    } else {
      alert("Kolom 'No. Laporan' tidak boleh kosong");
    }

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
