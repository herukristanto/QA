<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>T - Invest - Display</title>
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
// {
//   #ambil data semua unit
//     $query = "SELECT * FROM M_Unit WHERE Status = 'X'";
//     $sql   = sqlsrv_query($conn, $query);
//     $arrunit = array();
//     while ($row = sqlsrv_fetch_array($sql)) {
//       $arrunit [ $row['Deskripsi'] ] = $row['Kode'];
//     }
//   } 

// {
//   #ambil data semua indikator
//     $query = "SELECT * FROM M_Indikator WHERE Status = 'X'";
//     $sql   = sqlsrv_query($conn, $query);
//     $arrind = array();
//     while ($row = sqlsrv_fetch_array($sql)) {
//       $arrind [ $row['Kategori'] ] = $row['Kode'];
//     }
//   }   

// {
//   #ambil data semua insiden
//     $query = "SELECT * FROM M_Insiden WHERE Mark = 'X'";
//     $sql   = sqlsrv_query($conn, $query);
//     $arrinsiden = array();
//     while ($row = sqlsrv_fetch_array($sql)) {
//       $arrinsiden [ $row['Insiden'] ] = $row['Kode'];
//     }
//   }   

// {
//   #ambil data semua tipe insiden
//     $query = "SELECT * FROM M_Tipe_Insiden WHERE Mark = 'X'";
//     $sql   = sqlsrv_query($conn, $query);
//     $arrtipe = array();
//     while ($row = sqlsrv_fetch_array($sql)) {
//       $arrtipe [ $row['Tipe_insiden'] ] = $row['Kode_tipe'];
//     }
//   }   

// {
//   #ambil data semua sub tipe insiden
//     $query = "SELECT * FROM M_Sub_Tipe_Insiden WHERE Mark = 'X'";
//     $sql   = sqlsrv_query($conn, $query);
//     $arrsub = array();
//     while ($row = sqlsrv_fetch_array($sql)) {
//       $arrsub [ $row['Sub_tipe'] ] = $row['Kode_sub'];
//     }
//   }   
?>

<?php

// echo date('d/m/Y');
// echo "<br>";
// echo date('m');
// echo "<br>";
// echo date('Y');
$month  = date('m');
$year   = date('Y');
// echo "<br>";

//Create Autonumber
$sql = "SELECT MAX(No_invest) AS id FROM T_Invest";
$sql_execute = sqlsrv_query($conn,$sql);
$sql_hasil = sqlsrv_fetch_array($sql_execute);
$cek = $sql_hasil['id'];

$kode = substr($cek,10,14);

$tambah = $kode + 1;
  
  if($tambah<9){
    $id = "I/".$month."/".$year."/0000".$tambah;
    }else if($tambah>9 && $tambah<99){
    $id = "I/".$month."/".$year."/000".$tambah;
    }else if($tambah>99 && $tambah<999){
    $id = "I/".$month."/".$year."/00".$tambah;
    }else if($tambah>999 && $tambah<9999){
    $id = "I/".$month."/".$year."/0".$tambah; 
    }else if($tambah>9999 && $tambah<99999){
    $id = "Invest/".$month."/".$year."/".$tambah;
    }

 // }else{
    // $id = "L/".$month."/".$year."/0".$tambah;
// echo $id;
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
          <span class="style1">Create Tindak Lanjut</span><br>
          <table>
            <tr>
              <td>No. Invest</td>
              <td> : </td>
              <td><input name="noinvest" type="text" id="noinvest" value="<?php echo $id; ?>" style="text-align:center;font-weight:bold;font-size:14px" disabled="disabled"></td>
            </tr>
            <tr>
              <td>No. Laporan</td>
              <td> : </td>
              <td><input type="text" id="no_lap" name="no_lap" maxlength="17" disabled="disabled"></td>
            </tr>
            <tr>
              <td>Penyebab langsung insiden</td>
              <td> : </td>
              <td colspan="2" rowspan="2"><textarea rows="4" id="penyebab_langsung" name="penyebab_langsung" maxlength="50" disabled="disabled"></textarea></td>
            </tr>
            <tr>
              <td height="42">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>Penyebab yang melatarbelakangi/ akar masalah insiden</td>
              <td> : </td>
              <td colspan="2" rowspan="2"><textarea rows="4" id="akar_masalah" name="akar_masalah" maxlength="50" disabled="disabled"></textarea></td>
            </tr>
            <tr>
              <td height="42">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>  
            <tr>
              <td>Tindakan yang akan dilakukan (rencana jangka pendek)</td>
              <td> : </td>
              <td colspan="2" rowspan="2"><textarea rows="4" id="tindakan" name="tindakan" maxlength="50" disabled="disabled"></textarea></td>
            </tr>
            <tr>
              <td height="42">&nbsp;</td>
              <td>&nbsp;</td>
            </tr> 
            <tr>
              <td>---------------- Penanggung jawab</td>
              <td> : </td>
              <td><input type="text" id="penanggung_jawab_1" name="penanggung_jawab_1" maxlength="20" disabled="disabled"></td>
            </tr>
            <tr>
              <td>---------------- Perkiraan waktu pelaksanaan</td>
              <td> : </td>
              <td><input type="text" id="perkiraan_waktu_1" name="perkiraan_waktu_1" maxlength="20" disabled="disabled"></td>
            </tr>
            <tr>
              <td>Rekomendasi (rencana jangka panjang)</td>
              <td> : </td>
              <td colspan="2" rowspan="2"><textarea rows="4" id="rekomendasi" name="rekomendasi" maxlength="50" disabled="disabled"></textarea></td>
            </tr>
            <tr>
              <td height="42">&nbsp;</td>
              <td>&nbsp;</td>
            </tr> 
            <tr>
              <td>---------------- Penanggung jawab</td>
              <td> : </td>
              <td><input type="text" id="penanggung_jawab_2" name="penanggung_jawab_2" maxlength="20" disabled="disabled"></td>
            </tr>
            <tr>
              <td>---------------- Perkiraan waktu pelaksanaan</td>
              <td> : </td>
              <td><input type="text" id="perkiraan_waktu_2" name="perkiraan_waktu_2" maxlength="20" disabled="disabled"></td>
            </tr>
            <tr>
              <td>No. RCA</td>
              <td> : </td>
              <td><input type="text" id="no_rca" name="no_rca" maxlength="20" disabled="disabled"></td>
            </tr>
            <tr>
              <td height="43">&nbsp;</td>
              <td>&nbsp;</td>
              <td colspan="2"><button onClick="saveinvest();">Save</button>  
            <button onClick="clearinvest();">Reset</button></td>
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
