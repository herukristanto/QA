<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Sub Tipe Insiden - Create</title>
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



<?php

//Create Autonumber
$sql = "SELECT MAX(Kode) AS id FROM M_Sub_Tipe_Insiden";
$sql_execute = sqlsrv_query($conn,$sql);
$sql_hasil = sqlsrv_fetch_array($sql_execute);
$cek = $sql_hasil['id'];

$kode = substr($cek,2,8);


$tambah = $kode + 1;
  
  if($tambah<10){
    $id = "S-0000000".$tambah;
    }else{
    $id = "S-000000".$tambah;
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
          <span class="style1">Create Sub Tipe Insiden </span><br>
          <table>
            <tr>
              <td>Kode Sub Tipe</td>
              <td> : </td>
              <td><input name="Kd_sub" type="text" id="Kd_sub" maxlength="15" disabled="disabled" value="<?php echo $id;?>" size="8" readonly="readonly"
        style="text-align:center;font-weight:bold;font-size:16px" /></td>
            </tr>
                        <tr>
              <td>Kode Tipe Insiden</td>
              <td>:</td>
              <td colspan="2"><span class="inputan">
            <select id="Kd_tipe" name="Kd_tipe" style="text-align:center;font-weight:bold;width: auto" />
              <option value="" >-------------- P I L I H --------------</option>
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
            <select id="Kd_insiden" name="Kd_insiden" style="text-align:center;font-weight:bold;width: auto;" />
              <option value="" >-------------- P I L I H --------------</option>
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
              <td><input type="text" id="Sub_tipe_insiden" name="Sub_tipe_insiden" maxlength="255" style="width: auto"></td>
            </tr>
            <tr>
              <td>Status</td>
              <td>:</td>
              <td colspan="2"><input type="radio" name="Status_sub" id="aktif" checked>
              Aktif</td>
            </tr>
            <tr>
              <td height="43">&nbsp;</td>
              <td>&nbsp;</td>
              <td colspan="2"><input type="radio" name="Status_sub" id="nonaktif">
              Non-Aktif</td>
            </tr>
            <tr>
              <td height="43">&nbsp;</td>
              <td>&nbsp;</td>
              <td colspan="2"><button onClick="savesubtipeinsiden();">Save</button>  
            <button onClick="clearsubtipeinsiden();">Reset</button></td>
            </tr>
          </table>

          <p> 
            <?php include "M_Sub_Tipe_Insiden_Search.php"; ?>
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
  function change1() {
      var kd_tipe = document.getElementById('kd_tipe').value;
      $("#ini").empty();
      $("#ini").load('carikodetipeinsiden.php?kd_tipe=' + kd_tipe);
    }

    function change2() {
      var unit = document.getElementById('unit').value;
      // alert(unit);
      document.getElementById('unitkerja').value = unit;
      document.getElementById('unit').value="";
    }

  function savesubtipeinsiden(){
    var Kd_sub;
    var Kd_tipe;
    var Kd_insiden;
    var Sub_tipe_insiden;

    Kd_sub            = document.getElementById('Kd_sub').value;
    Kd_tipe           = document.getElementById('Kd_tipe').value;
    Kd_insiden        = document.getElementById('Kd_insiden').value;
    Sub_tipe_insiden  = document.getElementById('Sub_tipe_insiden').value;

    var cekradiobutton = document.getElementById('aktif');
    if (cekradiobutton.checked){
      Status_sub = "X";
    }else{
      Status_sub = " ";
    }

    var simpan;
    simpan = "baru";

    if (Sub_tipe_insiden) {
      window.location.href='M_Sub_Tipe_Insiden_Save.php?Kd_sub=' + Kd_sub + '&Kd_tipe=' + Kd_tipe + '&Kd_insiden=' + Kd_insiden + '&Sub_tipe_insiden=' + Sub_tipe_insiden + '&Status_sub=' + Status_sub + '&simpan=' + simpan;
    } else {
      alert("Kolom 'Sub Tipe Insiden' harus diisi..");
    }
  }

  function clearsubtipeinsiden(){
    document.getElementById('Kd_tipe').value = '-------------- P I L I H --------------';
    document.getElementById('Kd_insiden').value = '-------------- P I L I H --------------';
    document.getElementById('Sub_tipe_insiden').value ='';
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
