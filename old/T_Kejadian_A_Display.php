<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>T - Laporan Kejadian A - Display</title>
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
include "koneksi.php";
{
  #ambil data semua unit
    $query = "SELECT * FROM M_Unit WHERE Status = 'X'";
    $sql   = sqlsrv_query($conn, $query);
    $arrunit = array();
    while ($row = sqlsrv_fetch_array($sql)) {
      $arrunit [ $row['Deskripsi'] ] = $row['Kode'];
    }
  } 

{
  #ambil data semua indikator
    $query = "SELECT * FROM M_Indikator WHERE Status = 'X'";
    $sql   = sqlsrv_query($conn, $query);
    $arrind = array();
    while ($row = sqlsrv_fetch_array($sql)) {
      $arrind [ $row['Kategori'] ] = $row['Kode'];
    }
  }   

{
  #ambil data semua insiden
    $query = "SELECT * FROM M_Insiden WHERE Mark = 'X'";
    $sql   = sqlsrv_query($conn, $query);
    $arrinsiden = array();
    while ($row = sqlsrv_fetch_array($sql)) {
      $arrinsiden [ $row['Insiden'] ] = $row['Kode'];
    }
  }   

{
  #ambil data semua tipe insiden
    $query = "SELECT * FROM M_Tipe_Insiden WHERE Mark = 'X'";
    $sql   = sqlsrv_query($conn, $query);
    $arrtipe = array();
    while ($row = sqlsrv_fetch_array($sql)) {
      $arrtipe [ $row['Tipe_insiden'] ] = $row['Kode_tipe'];
    }
  }   

{
  #ambil data semua sub tipe insiden
    $query = "SELECT * FROM M_Sub_Tipe_Insiden WHERE Mark = 'X'";
    $sql   = sqlsrv_query($conn, $query);
    $arrsub = array();
    while ($row = sqlsrv_fetch_array($sql)) {
      $arrsub [ $row['Sub_tipe'] ] = $row['Kode_sub'];
    }
  }   
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
          <span class="style1">Display Laporan Kejadian</span><br>
          <table>
            <tr>
              <td>No. Laporan</td>
              <td> : </td>
              <td><input name="kodedepartemen" type="text" id="kd_dept" maxlength="3"></td>
            </tr>
            <tr>
              <td>Tanggal Kejadian</td>
              <td> : </td>
              <td><input type="text" id="desk_dept" name="deskripsi" maxlength="50"></td>
            </tr>
            <tr>
              <td>Jam Kejadian</td>
              <td> : </td>
              <td><input type="text" id="desk_dept" name="deskripsi" maxlength="50"></td>
            </tr>
            <tr>
              <td>Lokasi Kejadian</td>
              <td> : </td>
              <td><input type="text" id="desk_dept" name="deskripsi" maxlength="50"></td>
            </tr>
            <tr>
              <td>No. Rekam Medis</td>
              <td> : </td>
              <td><input type="text" id="desk_dept" name="deskripsi" maxlength="50"></td>
            </tr>
             <tr>
              <td>Unit terkait</td>
              <td> : </td>
              <td colspan="2"><span class="inputan">
            <select id="unit" name="unit" style="width:auto">
              <option value="">---------------- P I L I H ----------------</option>
              <?php
      foreach ($arrunit as $Kode=>$Kode) {
        echo "<option value='$Kode'>$Kode</option>";
      }
      ?>
            </select>
          </span></td>
            </tr>
             <tr>
              <td>No. Laporan unit terkait</td>
              <td> : </td>
              <td><input name="kodedepartemen" type="text" id="kd_dept" maxlength="3"></td>
            </tr>
            <td>&nbsp;</td>
            <tr>
              <td>Tipe Layanan</td>
             <!--  <td>:</td> -->
              <td colspan="2"><input type="checkbox" name="chkranap" id="chkranap">
              Rawat Inap</td>
            </tr>
            <tr>
              <!-- <td height="43">&nbsp;</td> -->
              <td>&nbsp;</td>
              <td colspan="2"><input type="checkbox" name="chkrajal" id="chkrajal">
              Rawat Jalan</td>
            </tr>
            <tr>
              <!-- <td height="43">&nbsp;</td> -->
              <td>&nbsp;</td>
              <td colspan="2"><input type="checkbox" name="chklain" id="chklain">
              Lainnya</td>
            </tr>
            <td>&nbsp;</td>
            <tr>
              <td>Tingkat Cedera</td>
              <!-- <td>:</td> -->
              <td colspan="2"><input type="checkbox" name="chkkematian" id="chkkematian">
              Kematian</td>
            </tr>
            <tr>
              <!-- <td height="43">&nbsp;</td> -->
              <td>&nbsp;</td>
              <td colspan="2"><input type="checkbox" name="chkberat" id="chkberat">
              Cedera Berat</td>
            </tr>
            <tr>
              <!-- <td height="43">&nbsp;</td> -->
              <td>&nbsp;</td>
              <td colspan="2"><input type="checkbox" name="chksedang" id="chksedang">
              Cedera Sedang</td>
            </tr>
            <tr>
              <!-- <td height="43">&nbsp;</td> -->
              <td>&nbsp;</td>
              <td colspan="2"><input type="checkbox" name="chkringan" id="chkringan">
              Cedera Ringan</td>
            </tr>
            <tr>
              <!-- <td height="43">&nbsp;</td> -->
              <td>&nbsp;</td>
              <td colspan="2"><input type="checkbox" name="chktidakada" id="chktidakada">
              Tidak Ada Cedera</td>
            </tr>
             <tr>
              <!-- <td height="43">&nbsp;</td> -->
              <td>&nbsp;</td>
              <td colspan="2"><input type="checkbox" name="chkcederalain" id="chkcederalain">
              Lainnya</td>
            </tr>
            <td>&nbsp;</td>
            <tr>
              <td>Indikator terkait</td>
              <td> : </td>
              <td colspan="2"><span class="inputan">
            <select id="indikator" name="indikator" style="width:auto">
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
              <td>Jenis insiden</td>
              <td> : </td>
              <td colspan="2"><span class="inputan">
            <select id="insiden" name="insiden" style="width:auto">
              <option value="">---------------- P I L I H ----------------</option>
              <?php
      foreach ($arrinsiden as $Kode=>$Kode) {
        echo "<option value='$Kode'>$Kode</option>";
      }
      ?>
            </select>
          </span></td>
            </tr>
            <tr>
              <td>Tipe insiden</td>
              <td> : </td>
              <td colspan="2"><span class="inputan">
            <select id="tipe" name="tipe" style="width:auto">
              <option value="">---------------- P I L I H ----------------</option>
              <?php
      foreach ($arrtipe as $Kode=>$Kode) {
        echo "<option value='$Kode'>$Kode</option>";
      }
      ?>
            </select>
          </span></td>
            </tr>
            <tr>
              <td>Sub Tipe insiden</td>
              <td> : </td>
              <td colspan="2"><span class="inputan">
            <select id="sub" name="sub" style="width:auto">
              <option value="">---------------- P I L I H ----------------</option>
              <?php
      foreach ($arrsub as $Kode=>$Kode) {
        echo "<option value='$Kode'>$Kode</option>";
      }
      ?>
            </select>
          </span></td>
            </tr>
            <tr>
              <td>Kronologi Kejadian</td>
              <td> : </td>
              <td colspan="2" rowspan="2"><textarea name="kronologi" rows="3" id="kronologi"></textarea></td>
            </tr>
            <td height="43">&nbsp;</td>
            <td>&nbsp;</td>
            <tr>
              <td>Analisa Matriks grading resiko</td>
            </tr>
            <tr>
              <td height="43">&nbsp;</td>
              <td>&nbsp;</td>
              <td>i. Skor dampak klinis/ severity</td>
              <tr>
                <td>&nbsp;</td>
              <td colspan="2"><input type="checkbox" name="chkranap" id="chkranap">
              Katastropil (merah-5)</td></tr>
              <tr>
                <td>&nbsp;</td>
              <td colspan="2"><input type="checkbox" name="chkrajal" id="chkrajal">
              Mayor (orange-4)</td></tr>
              <tr>
                <td>&nbsp;</td>
              <td colspan="2"><input type="checkbox" name="chkranap" id="chkranap">
              Moderate (kuning-3)</td></tr>
              <tr>
                <td>&nbsp;</td>
              <td colspan="2"><input type="checkbox" name="chkrajal" id="chkrajal">
              Minor (hijau-2)</td></tr>
              <tr>
                <td>&nbsp;</td>
              <td colspan="2"><input type="checkbox" name="chkrajal" id="chkrajal">
              Tidak Signifikan (biru-11)</td></tr>
            </tr>
            <tr>
              <td height="43">&nbsp;</td>
              <td>&nbsp;</td>
              <td>ii. Skor probabilitas/ frekuensi</td>
              <tr>
                <td>&nbsp;</td>
              <td colspan="2"><input type="checkbox" name="chkranap" id="chkranap">
              Sangat sering terjadi (merah-5)</td></tr>
              <tr>
                <td>&nbsp;</td>
              <td colspan="2"><input type="checkbox" name="chkrajal" id="chkrajal">
              Sering terjadi (orange-4)</td></tr>
              <tr>
                <td>&nbsp;</td>
              <td colspan="2"><input type="checkbox" name="chkranap" id="chkranap">
              Mungkin terjadi (kuning-3)</td></tr>
              <tr>
                <td>&nbsp;</td>
              <td colspan="2"><input type="checkbox" name="chkrajal" id="chkrajal">
              Jarang terjadi (hijau-2)</td></tr>
              <tr>
                <td>&nbsp;</td>
              <td colspan="2"><input type="checkbox" name="chkrajal" id="chkrajal">
              Sangat jarang terjadi (biru-11)</td></tr>
            </tr>
            <td>&nbsp;</td>
            <tr>
              <td>Hasil matriks grading resiko</td>
              <td> : </td>
              <td><input type="text" id="desk_dept" name="deskripsi" maxlength="50"></td>
            </tr>
            <tr>
              <td height="43">&nbsp;</td>
              <td>&nbsp;</td>
              <td colspan="2"><button onClick="savedepartemen();">Save</button>  
            <button onClick="cleardept();">Reset</button></td>
            </tr>
          </table>

          <p> 
            <?php include "M_Dept_Search.php"; ?>
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
  function savedepartemen(){
    var kd_dept;
    var desk_dept;
    kd_dept = document.getElementById('kd_dept').value;
    desk_dept = document.getElementById('desk_dept').value;

    var cekradiobutton = document.getElementById('aktif');
    if (cekradiobutton.checked){
      statdept = "X";
    }else{
      statdept = " ";
    }

    var simpan;
    simpan = "baru";

    if (desk_dept) {
      window.location.href='M_Dept_Save.php?kd_dept=' + kd_dept + '&desk_dept=' + desk_dept + '&statdept=' + statdept + '&simpan=' + simpan;
    } else {
      alert("Kolom 'deskripsi' harus diisi..");
    }
  }

  function cleardept(){
    document.getElementById('desk_dept').value = '';
    document.getElementById('kd_dept').value = '';
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
