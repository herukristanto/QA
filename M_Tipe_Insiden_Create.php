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

<?php

//Create Autonumber
$sql = "SELECT MAX(Kode_tipe) AS id FROM M_Tipe_Insiden";
$sql_execute = sqlsrv_query($conn,$sql);
$sql_hasil = sqlsrv_fetch_array($sql_execute);
$cek = $sql_hasil['id'];

$kode = substr($cek,2,8);

// echo $kode;
// echo "<br>";
$tambah = $kode + 1;

// echo $tambah;
  
  if($tambah<10){
    $id = "T-0000000".$tambah;
    }else{
    $id = "T-000000".$tambah;
    }

// echo "<br>";
// echo $id;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Tipe Insiden - Create</title>
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
</head>
<body>
<div id="header_mstr"></div>
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span12 mainPage">
          
          <br>
          <span class="style1">Create Tipe Insiden </span><br>
          <table>
            <tr>
              <td>Kode Tipe</td>
              <td> : </td>
              <td><input name="kd_tipe" type="text" id="kd_tipe" maxlength="3" disabled="disabled" value="<?php echo $id;?>" size="8" maxlength="6" readonly="readonly"
        style="text-align:center;font-weight:bold;font-size:16px" /></td>
            </tr>
            <tr>
              <td>Kode Insiden</td>
              <td>:</td>
              <td colspan="2"><span class="inputan">
            <select id="kd_insiden" name="kd_insiden" style="text-align:center;font-weight:bold;font-size:15px" />
              <option value="" >-------------- P I L I H --------------</option>
              <?php
      foreach ($arrind as $Kode=>$Kode) {
        echo "<option value='$Kode'>$Kode</option>";
      }
      ?>
            </select>
          </span></td>
            </tr>
            <tr>
            <tr>
              <td>Tipe Insiden</td>
              <td> : </td>
              <td><input type="text" id="tipe_insiden" name="tipe_insiden" maxlength="255"></td>
            </tr>
            <tr>
              <td>Status</td>
              <td>:</td>
              <td colspan="2"><input type="radio" name="status_tipe" id="aktif" checked>
              Aktif</td>
            </tr>
            <tr>
              <td height="43">&nbsp;</td>
              <td>&nbsp;</td>
              <td colspan="2"><input type="radio" name="status_tipe" id="nonaktif">
              Non-Aktif</td>
            </tr>
            <tr>
              <td height="43">&nbsp;</td>
              <td>&nbsp;</td>
              <td colspan="2"><button onClick="savetipeinsiden();">Save</button>  
            <button onClick="cleartipeinsiden();">Reset</button></td>
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
  function savetipeinsiden(){
    var kd_tipe;
    var kd_insiden;
    var tipe_insiden;

    kd_tipe       = document.getElementById('kd_tipe').value;
    kd_insiden    = document.getElementById('kd_insiden').value;
    tipe_insiden  = document.getElementById('tipe_insiden').value;

    var cekradiobutton = document.getElementById('aktif');
    if (cekradiobutton.checked){
      status_tipe = "X";
    }else{
      status_tipe = " ";
    }

    var simpan;
    simpan = "baru";

    if (kd_insiden) {
      window.location.href='M_Tipe_Insiden_Save.php?kd_tipe=' + kd_tipe + '&kd_insiden=' + kd_insiden + '&tipe_insiden=' + tipe_insiden + '&status_tipe=' + status_tipe + '&simpan=' + simpan;
    } else {
      alert("Kolom 'deskripsi' harus diisi..");
    }
  }

  function cleartipeinsiden(){
    document.getElementById('kd_insiden').value = '';
    document.getElementById('tipe_insiden').value = '';
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
