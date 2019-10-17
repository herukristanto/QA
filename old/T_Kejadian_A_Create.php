<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>T - Laporan Kejadian A - Create</title>
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
    $query = "SELECT * FROM M_Unit WHERE Status = 'X'";
    $sql   = sqlsrv_query($conn, $query);
    $arrind = array();
    while ($row = sqlsrv_fetch_array($sql)) {
      $arrind [ $row['DeptUnit'] ] = $row['Kode'];
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

<?php

date_default_timezone_set("Asia/Jakarta");

$jam = date('G:i:s');

$month  = date('m');
$year   = date('Y');

$date = '2019-02-15 16:56:01';
 
//12 hour format with lowercase AM/PM

// echo "<br>";

//Create Autonumber
$sql = "SELECT MAX(No_lap) AS id FROM T_Kejadian_a";
$sql_execute = sqlsrv_query($conn,$sql);
$sql_hasil = sqlsrv_fetch_array($sql_execute);
$cek = $sql_hasil['id'];

$kode = substr($cek,10,14);

$tambah = $kode + 1;
  
  if($tambah<=9){
    $id = "L/".$month."/".$year."/0000".$tambah;
    }else if($tambah>9 && $tambah<99){
    $id = "L/".$month."/".$year."/000".$tambah;
    }else if($tambah>99 && $tambah<999){
    $id = "L/".$month."/".$year."/00".$tambah;
    }else if($tambah>999 && $tambah<9999){
    $id = "L/".$month."/".$year."/0".$tambah; 
    }else if($tambah>9999 && $tambah<99999){
    $id = "L/".$month."/".$year."/".$tambah;
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
          <span class="style1">Create Laporan Kejadian</span><br>
          <table>
            <tr>
              <td>No. Laporan</td>
              <td> : </td>
              <td><input name="nolap" type="text" id="nolap" value="<?php echo $id; ?>" style="text-align:center;font-weight:bold;font-size:14px" disabled="disabled"></td>
            </tr>
            <tr>
              <td>Tanggal Kejadian</td>
              <td> : </td>
              <td><input name="TglTjd" type="text" id="TglTjd" value="<?php
              if(isset($app['App_Date']))
                {echo $app['App_Date']->format('d/m/Y');}
              else
                {echo date('d/m/Y');} ?>" maxlength="10" style="text-align:center;font-weight:bold;font-size:14px"/></td>
            </tr>
            <tr>
              <td>Jam Kejadian</td>
              <td> : </td>
              <td><input type="text" value="<?php echo $jam;?>" id="jam_kejadian" name="jam_kejadian" maxlength="50" style="text-align:center;font-weight:bold;font-size:14px"></td>
            </tr>
            <tr>
              <td>Lokasi Kejadian</td>
              <td> : </td>
              <td><input type="text" id="lokasi" name="lokasi" maxlength="50"></td>
            </tr>
            <tr>
              <td>No. Rekam Medis</td>
              <td> : </td>
              <td><input type="text" id="no_rm" name="no_rm" maxlength="50"></td>
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
              <td><input name="nolap_unit" type="text" id="nolap_unit" maxlength="50"></td>
            </tr>
            <td>&nbsp;</td>
            <tr>
              <td>Tipe Layanan</td>
             <!--  <td>:</td> -->
              <td colspan="2"><input type="radio" name="radiolayanan" id="rawatinap" value="rawatinap">
              Rawat Inap</td>
            </tr>
            <tr>
              <!-- <td height="43">&nbsp;</td> -->
              <td>&nbsp;</td>
              <td colspan="2"><input type="radio" name="radiolayanan" id="rawatjalan" value="rawatjalan">
              Rawat Jalan</td>
            </tr>
            <tr>
              <!-- <td height="43">&nbsp;</td> -->
              <td>&nbsp;</td>
              <td colspan="2"><input type="radio" name="radiolayanan" id="rawatlain" value="rawatlain">
              Lainnya&nbsp;<input type="text" id="tipe_lain" name="tipe_lain" maxlength="50"></td>
            </tr>
            <td>&nbsp;</td>
            <tr>
              <td>Tingkat Cedera</td>
              <!-- <td>:</td> -->
              <td colspan="2"><input type="radio" name="radiocedera" id="kematian" value="kematian">
              Kematian</td>
            </tr>
            <tr>
              <!-- <td height="43">&nbsp;</td> -->
              <td>&nbsp;</td>
              <td colspan="2"><input type="radio" name="radiocedera" id="berat" value="berat">
              Cedera Berat</td>
            </tr>
            <tr>
              <!-- <td height="43">&nbsp;</td> -->
              <td>&nbsp;</td>
              <td colspan="2"><input type="radio" name="radiocedera" id="sedang" value="sedang">
              Cedera Sedang</td>
            </tr>
            <tr>
              <!-- <td height="43">&nbsp;</td> -->
              <td>&nbsp;</td>
              <td colspan="2"><input type="radio" name="radiocedera" id="ringan" value="ringan">
              Cedera Ringan</td>
            </tr>
            <tr>
              <!-- <td height="43">&nbsp;</td> -->
              <td>&nbsp;</td>
              <td colspan="2"><input type="radio" name="radiocedera" id="tidakada" value="tidakada">
              Tidak Ada Cedera</td>
            </tr>
             <tr>
              <!-- <td height="43">&nbsp;</td> -->
              <td>&nbsp;</td>
              <td colspan="2"><input type="radio" name="radiocedera" id="lain" value="lain">
              Lainnya&nbsp;<input type="text" id="cedera_lain" name="cedera_lain" maxlength="50"></td>
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
            <select id="jenis_insiden" name="jenis_insiden" style="width:auto">
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
            <select id="tipe_insiden" name="tipe_insiden" style="width:auto">
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
            <select id="sub_tipe" name="sub_tipe" style="width:auto">
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
              <td> : b n</td>
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
              <td colspan="2"><input type="radio" name="radioKlinis" id="Katastropik" value="5">
              Katastropil (merah-5)</td></tr>
              <tr>
                <td>&nbsp;</td>
              <td colspan="2"><input type="radio" name="radioKlinis" id="Mayor" value="4">
              Mayor (orange-4)</td></tr>
              <tr>
                <td>&nbsp;</td>
              <td colspan="2"><input type="radio" name="radioKlinis" id="Moderat" value="3">
              Moderat (kuning-3)</td></tr>
              <tr>
                <td>&nbsp;</td>
              <td colspan="2"><input type="radio" name="radioKlinis" id="Minor" value="2">
              Minor (hijau-2)</td></tr>
              <tr>
                <td>&nbsp;</td>
              <td colspan="2"><input type="radio" name="radioKlinis" id="TidakSignifikan" value="1">
              Tidak Signifikan (biru-1)</td></tr>
            </tr>
            <tr>
              <td height="43">&nbsp;</td>
              <td>&nbsp;</td>
              <td>ii. Skor probabilitas/ frekuensi</td>
              <tr>
                <td>&nbsp;</td>
              <td colspan="2"><input type="radio" name="radioProbabilitas" id="Sangatsering" value="5">
              Sangat sering terjadi (merah-5)</td></tr>
              <tr>
                <td>&nbsp;</td>
              <td colspan="2"><input type="radio" name="radioProbabilitas" id="Sering" value="4">
              Sering terjadi (orange-4)</td></tr>
              <tr>
                <td>&nbsp;</td>
              <td colspan="2"><input type="radio" name="radioProbabilitas" id="Mungkin" value="3">
              Mungkin terjadi (kuning-3)</td></tr>
              <tr>
                <td>&nbsp;</td>
              <td colspan="2"><input type="radio" name="radioProbabilitas" id="Jarang" value="2">
              Jarang terjadi (hijau-2)</td></tr>
              <tr>
                <td>&nbsp;</td>
              <td colspan="2"><input type="radio" name="radioProbabilitas" id="Sangatjarang" value="1">
              Sangat jarang terjadi (biru-1)</td></tr>
            </tr>
            <td>&nbsp;</td>
            <tr>
              <td>Hasil matriks grading resiko</td>
              <td> : </td>
              <td><input type="text" id="hasil_grading" name="hasil_grading" maxlength="50" disabled="disabled"></td>
            </tr>
            <tr>
              <td height="43">&nbsp;</td>
              <td>&nbsp;</td>
              <td colspan="2"><button onClick="savekejadian();">Save</button>  
            <button onClick="clearkejadian();">Reset</button></td>
            </tr>
          </table>

          <p> 
            <?php include "T_Kejadian_A_Search.php"; ?>
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
  function savekejadian(){
    var nolap;
    var TglTjd;
    var jam_kejadian;
    var lokasi;
    var no_rm;
    var unit;
    var nolap_unit;
    var indikator;
    var jenis_insiden;
    var tipe_insiden;
    var sub_tipe;
    var kronologi;
    var Analisa;
    var hasil_grading;

    nolap         = document.getElementById('nolap').value;
    TglTjd        = document.getElementById('TglTjd').value;
    jam_kejadian  = document.getElementById('jam_kejadian').value;
    no_rm         = document.getElementById('no_rm').value;
    unit          = document.getElementById('unit').value;
    nolap_unit    = document.getElementById('nolap_unit').value;
    kronologi     = document.getElementById('kronologi').value;
    indikator     = document.getElementById('indikator').value;
    Jenis         = document.getElementById('Jenis').value;
    Sub_tipe      = document.getElementById('Sub_tipe').value;
    
    var cektipelayanan = document.getElementById('rawatinap');
    var cektipelayanan = document.getElementById('rawatjalan');
    var cektipelayanan = document.getElementById('rawatlain');

    if(document.getElementById('rawatinap').checked) {
      radiolayanan = "rawatinap";
    }else if(document.getElementById('rawatjalan').checked) {
      radiolayanan = "rawatjalan";
    }else if(document.getElementById('rawatlain').checked) {
      radiolayanan = "rawatlain";
    }

    var cektipecedera = document.getElementById('kematian');
    var cektipecedera = document.getElementById('berat');
    var cektipecedera = document.getElementById('sedang');
    var cektipecedera = document.getElementById('ringan');
    var cektipecedera = document.getElementById('tidakada');
    var cektipecedera = document.getElementById('lain');

    if(document.getElementById('kematian').checked) {
      radiocedera = "kematian";
    }else if(document.getElementById('berat').checked) {
      radiocedera = "berat";
    }else if(document.getElementById('sedang').checked) {
      radiocedera = "sedang";
    }else if(document.getElementById('ringan').checked) {
      radiocedera = "ringan";
    }else if(document.getElementById('tidakada').checked) {
      radiocedera = "tidakada";
    }else if(document.getElementById('lain').checked) {
      radiocedera = "lain";
    }


    //Matriks grading resiko ( skor dampak )
    var cekskordampak = document.getElementById('Katastropil');
    var cekskordampak = document.getElementById('Mayor');
    var cekskordampak = document.getElementById('Moderate');
    var cekskordampak = document.getElementById('Minor');
    var cekskordampak = document.getElementById('TidakSignifikan');

    if(document.getElementById('Katastropil').checked) {
      radioKlinis = "5";
    }else if(document.getElementById('Mayor').checked) {
      radioKlinis = "4";
    }else if(document.getElementById('Moderate').checked) {
      radioKlinis = "3";
    }else if(document.getElementById('Minor').checked) {
      radioKlinis = "2";
    }else if(document.getElementById('TidakSignifikan').checked) {
      radioKlinis = "1";
    }

    //Matriks grading resiko ( skor probabilitas )
    var cekskorProbabilitas = document.getElementById('Sangatsering');
    var cekskorProbabilitas = document.getElementById('Sering');
    var cekskorProbabilitas = document.getElementById('Mungkin');
    var cekskorProbabilitas = document.getElementById('Jarang');
    var cekskorProbabilitas = document.getElementById('Sangatjarang');

    if(document.getElementById('Sangatsering').checked) {
      radioProbabilitas = "5";
    }else if(document.getElementById('Sering').checked) {
      radioProbabilitas = "4";
    }else if(document.getElementById('Mungkin').checked) {
      radioProbabilitas = "3";
    }else if(document.getElementById('Jarang').checked) {
      radioProbabilitas = "2";
    }else if(document.getElementById('Sangatjarang').checked) {
      radioProbabilitas = "1";
    }

    //Perhitungan grading
    if(radioProbabilitas = "5" && radioKlinis = "1"){
      hasil_grading = "Moderat";
    }else if(radioProbabilitas = "5" && radioKlinis = "2"){
      hasil_grading = "Moderat";
    }else if(radioProbabilitas = "5" && radioKlinis = "3"){
      hasil_grading = "Tinggi";
    }else if(radioProbabilitas = "5" && radioKlinis = "4"){
      hasil_grading = "Ekstrim";
    }else if(radioProbabilitas = "5" && radioKlinis = "5"){
      hasil_grading = "Ekstrim";
    }else if(radioProbabilitas = "4" && radioKlinis = "1"){
      hasil_grading = "Moderat";
    }else if(radioProbabilitas = "4" && radioKlinis = "2"){
      hasil_grading = "Moderat";
    }else if(radioProbabilitas = "4" && radioKlinis = "3"){
      hasil_grading = "Tinggi";
    }else if(radioProbabilitas = "4" && radioKlinis = "4"){
      hasil_grading = "Ekstrim";
    }else if(radioProbabilitas = "4" && radioKlinis = "5"){
      hasil_grading = "Ekstrim";
    }else if(radioProbabilitas = "3" && radioKlinis = "1"){
      hasil_grading = "Rendah";
    }else if(radioProbabilitas = "3" && radioKlinis = "2"){
      hasil_grading = "Moderat";
    }else if(radioProbabilitas = "3" && radioKlinis = "3"){
      hasil_grading = "Tinggi";
    }else if(radioProbabilitas = "3" && radioKlinis = "4"){
      hasil_grading = "Ekstrim";
    }else if(radioProbabilitas = "3" && radioKlinis = "5"){
      hasil_grading = "Ekstrim";
    }else if(radioProbabilitas = "2" && radioKlinis = "1"){
      hasil_grading = "Rendah";
    }else if(radioProbabilitas = "2" && radioKlinis = "2"){
      hasil_grading = "Rendah"; 
    }else if(radioProbabilitas = "2" && radioKlinis = "3"){
      hasil_grading = "Moderat";
    }else if(radioProbabilitas = "2" && radioKlinis = "4"){
      hasil_grading = "Tinggi";
    }else if(radioProbabilitas = "2" && radioKlinis = "5"){
      hasil_grading = "Ekstrim";
    }else if(radioProbabilitas = "1" && radioKlinis = "1"){
      hasil_grading = "Rendah";
    }else if(radioProbabilitas = "1" && radioKlinis = "2"){
      hasil_grading = "Rendah"; 
    }else if(radioProbabilitas = "1" && radioKlinis = "3"){ 
      hasil_grading = "Moderat";
    }else if(radioProbabilitas = "1" && radioKlinis = "4"){
      hasil_grading = "Tinggi";
    }else if(radioProbabilitas = "1" && radioKlinis = "5"){
      hasil_grading = "Ekstrim";       
    }

    var hasil_grading = document.getElementById('hasil_grading');
    

    var simpan;
    simpan = "baru";

    if (lokasi) {
      window.location.href='T_Kejadian_A_Save.php?nolap=' + nolap + '&TglTjd=' + TglTjd + '&jam_kejadian=' + jam_kejadian + '&lokasi' + lokasi + '&no_rm' + no_rm + '&unit' + unit + '&nolap_unit' + nolap_unit + '&tipe' + tipe + '&indikator' + indikator + '&jenis_insiden' + jenis_insiden + '&tipe_insiden' + tipe_insiden + '&sub_tipe' + sub_tipe + '$cekskordampak' + cekskordampak  +'$cekskorProbabilitas' + cekskorProbabilitas  +'&kronologi' + kronologi + '&hasil_grading' + hasil_grading +'&simpan=' + simpan;
    } else {
      alert("Kolom 'lokasi' harus diisi..");
    }
  }

  function clearkejadian(){
    document.getElementById('lokasi').value = '';
    document.getElementById('no_rm').value = '';
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