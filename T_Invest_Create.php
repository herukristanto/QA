<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>T - Invest - Create</title>
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


//Create Autonumber Invest
$sql = "SELECT MAX(No_invest) AS id FROM T_Invest";
$sql_execute = sqlsrv_query($conn,$sql);
$sql_hasil = sqlsrv_fetch_array($sql_execute);
$cek = $sql_hasil['id'];

$kode = substr($cek,10,14);

$tambah = $kode + 1;

  if($tambah<=9){
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

//Create Autonumber RCA
$sql_RCA          = "SELECT MAX(No_RCA) AS id FROM T_RCA";
$sql_execute_RCA  = sqlsrv_query($conn,$sql_RCA);
$sql_hasil_RCA    = sqlsrv_fetch_array($sql_execute_RCA);
$cek_RCA          = $sql_hasil_RCA['id'];

$kode_RCA         = substr($cek_RCA,10,14);

$tambah_RCA       = $kode_RCA + 1;

  if($tambah_RCA<=9){
    $id_RCA = "R/".$month."/".$year."/0000".$tambah_RCA;
    }else if($tambah_RCA>9 && $tambah_RCA<99){
    $id_RCA = "R/".$month."/".$year."/000".$tambah_RCA;
    }else if($tambah_RCA>99 && $tambah_RCA<999){
    $id_RCA = "R/".$month."/".$year."/00".$tambah_RCA;
    }else if($tambah_RCA>999 && $tambah_RCA<9999){
    $id_RCA = "R/".$month."/".$year."/0".$tambah_RCA;
    }else if($tambah_RCA>9999 && $tambah_RCA<99999){
    $id_RCA = "RCA/".$month."/".$year."/".$tambah_RCA;
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
          <table>
            <tr>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No. Laporan</td>
              <td> : </td>
              <td><input type="text" id="no_lap" name="no_lap" maxlength="17" style="text-align:center;font-weight:bold;font-size:14px" disabled="disabled"></td>
              <td colspan="2"><button id="myBtn">Search</button> &nbsp;
                <?php include "T_Invest_Search_No_Laporan.php"; ?></td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tanggal Kejadian</td>
              <td> : </td>
               <td><input name="TglTjd" type="text" id="TglTjd" maxlength="15" disabled="disabled" style="text-align:center;font-weight:bold;font-size:14px"/></td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Unit</td>
              <td> : </td>
              <td colspan="2"><input type="text" id="kode_u" name="kode_u" style="text-align:center;font-weight:bold;font-size:14px" disabled="disabled"></td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Matriks Grading</td>
              <td> : </td>
              <td colspan="2"><input type="text" id="hasil_skor" name="hasil_skor" style="text-align:center;font-weight:bold;font-size:14px;color:red" disabled="disabled"></td>
            </tr>
            <tr>
              <td height="42">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td class="style1">Tindah Lanjut  ( Rendah / Moderat )</td>
              <td></td>
              <td></td>
            </tr>

            <tr>
              <td>a. Formulir investigasi sederhana</td>
              <td height="42">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>No. Invest</td>
              <td> : </td>
              <td><input name="no_invest" type="text" id="no_invest" value="<?php echo $id; ?>" style="text-align:center;font-weight:bold;font-size:14px" disabled="disabled"></td>
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
              <td><input type="text" id="penanggung_jawab_1" name="penanggung_jawab_1" maxlength="20"></td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Perkiraan waktu pelaksanaan</td>
              <td> : </td>
              <td><input name="perkiraan_waktu_1" type="text" id="perkiraan_waktu_1" value="<?php
             if(isset($app['App_Date']))
               {echo $app['App_Date']->format('d/m/Y');}
             else
               {echo date('d/m/Y');} ?>" maxlength="15" style="text-align:center;font-weight:bold;font-size:14px"/></td>
            </tr>
            <tr>
              <td>Rekomendasi (rencana jangka panjang)</td>
              <td> : </td>
              <td colspan="2" rowspan="2"><textarea rows="4" id="rekomendasi" name="rekomendasi" maxlength="50"></textarea></td>
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
               {echo date('d/m/Y');} ?>" maxlength="15" style="text-align:center;font-weight:bold;font-size:14px"/></td>
            </tr>
            <tr>
              <td height="42">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>b. Formulir RCA</td>
              <td height="42">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No. RCA</td>
              <td> : </td>
              <td><input type="text" id="no_rca" name="no_rca" value="<?php echo $id_RCA; ?>" style="text-align:center;font-weight:bold;font-size:14px" disabled="disabled"></td>
            </tr>
            <!--  <tr>
              <td height="42">&nbsp;</td>
              <td>&nbsp;</td>
            </tr> -->
            <tr>
              <td class="style1">Pengumpulan Data ( Tinggi / Ekstrim )</td>
              <td></td>
              <td></td>
            </tr>
            <!-- <tr>
              <td height="42">&nbsp;</td>
              <td>&nbsp;</td>
            </tr> -->
            <tr>
              <td>Kronologis</td>
              <td> : </td>
              <td colspan="2" rowspan="2"><textarea name="kronologis" rows="3" id="kronologis"></textarea></td>
            </tr>
             <tr>
              <td>1. Observasi</td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tanggal</td>
              <td> : </td>
               <td><input name="TglObs" type="text" id="TglObs" value="<?php
              if(isset($app['App_Date']))
                {echo $app['App_Date']->format('d/m/Y');}
              else
                {echo date('d/m/Y');} ?>" maxlength="15" style="text-align:center;font-weight:bold;font-size:14px"/></td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jam</td>
              <td> : </td>
              <td><input type="text" value="<?php echo $jam;?>" id="jam_obs" name="jam_obs" maxlength="50" style="text-align:center;font-weight:bold;font-size:14px"></td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hasil</td>
              <td> : </td>
              <td colspan="2" rowspan="2"><textarea name="hasil_obs" rows="3" id="hasil_obs"></textarea></td>
            </tr>
            <tr>
              <td height="42">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>2. Dokumentasi</td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="laporan_kejadian" id="laporan_kejadian" >
              Laporan Kejadian</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="berkas_RM" id="berkas_RM" >
              Berkas RM + Hasil pemeriksaan</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" onclick="enable1('kebijakan_text')" name="kebijakan_prosedur" id="kebijakan_prosedur" >
              Kebijakan dan prosedur yang berhubungan (sebutkan nomor dan judul) : </td>
              <td colspan="2" rowspan="2"><input type="text" id="kebijakan_text" name="kebijakan_text" maxlength="50" disabled="true"></td>
            </tr>
            <tr>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="daftarstaf" id="daftarstaf" >
              Daftar Staf</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" onclick="enable2('bukti_text')" name="buktifisik" id="buktifisik" >
              Bukti Fisik, berupa : </td>
              <td colspan="2" rowspan="2"><input type="text" id="bukti_text" name="bukti_text" maxlength="50" disabled="true"></td>
            </tr>
            <tr>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" onclick="enable3('informasi_text')" name="informasi_lain" id="informasi_lain" >
              Informasi lain yang mempengaruhi insiden, berupa : </td>
              <td colspan="2" rowspan="2"><input type="text" id="informasi_text" name="informasi_text" maxlength="50" disabled="true"></td>
            </tr>
            <tr>
              <td height="42">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>3. Interview / Wawancara</td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tanggal</td>
              <td> : </td>
               <td><input name="TglWaw" type="text" id="TglWaw" value="<?php
              if(isset($app['App_Date']))
                {echo $app['App_Date']->format('d/m/Y');}
              else
                {echo date('d/m/Y');} ?>" maxlength="10" style="text-align:center;font-weight:bold;font-size:14px"/></td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jam</td>
              <td> : </td>
              <td><input type="text" value="<?php echo $jam;?>" id="jam_waw" name="jam_waw" maxlength="50" style="text-align:center;font-weight:bold;font-size:14px"></td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hasil</td>
              <td> : </td>
              <td colspan="2" rowspan="2"><textarea name="hasil_waw" rows="4" id="hasil_waw"></textarea></td>
            </tr>
             <tr>
              <td height="42">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td class="style1">Peta Informasi</td>
              <td></td>
              <td></td>
            </tr>
             <tr>
              <td height="42">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>Berdasarkan data yang ditemukan, maka dapat dibuat peta sebagai berikut</td>
              <td> : </td>
              <td colspan="2" rowspan="2"><textarea name="peta_informasi" rows="4" id="peta_informasi"></textarea></td>
            </tr>
            <tr>
              <td height="42">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td class="style1">Identifikasi Masalah</td>
              <td></td>
              <td></td>
            </tr>
             <tr>
              <td height="42">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>Sesuai dengan data, ditemukan masalah</td>
              <td> : </td>
              <td colspan="2" rowspan="2"><textarea name="masalah" rows="4" id="masalah"></textarea></td>
            </tr>
            <tr>
              <td height="42">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td class="style1">Analisis</td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td height="42">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>Analisis dilakukan dengan cara</td>
              <td> : </td>
              <td colspan="2" rowspan="2"><textarea name="analisis" rows="4" id="analisis"></textarea></td>
            </tr>
            <tr>
              <td height="42">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td class="style1">Kesimpulan</td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td height="42">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>Berdasarkan hasil analisa yang berlangsung pada tanggal</td>
              <td> : </td>
              <td><input name="TglAna1" type="text" id="TglAna1" value="<?php
              if(isset($app['App_Date']))
                {echo $app['App_Date']->format('d/m/Y');}
              else
                {echo date('d/m/Y');} ?>" maxlength="10" style="text-align:center;font-weight:bold;font-size:14px"/></td>
              <td>s/d</td>
              <td><input name="TglAna2" type="text" id="TglAna2" value="<?php
              if(isset($app['App_Date']))
                {echo $app['App_Date']->format('d/m/Y');}
              else
                {echo date('d/m/Y');} ?>" maxlength="10" style="text-align:center;font-weight:bold;font-size:14px"/></td>
            </tr>
            <tr>
              <td height="42">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;a. Masalah Utama</td>
              <td> : </td>
              <td colspan="2" rowspan="2"><textarea name="masalah_utama" rows="4" id="masalah_utama"></textarea></td>
            </tr>
            <tr>
              <td height="42">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;b. Saran dan Rekomendasi</td>
              <td> : </td>
              <td colspan="2" rowspan="2"><textarea name="saran_rekomendasi" rows="4" id="saran_rekomendasi"></textarea></td>
            </tr>
            <tr>
              <td height="42">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td height="43">&nbsp;</td>
              <td>&nbsp;</td>
              <td colspan="2"><button onClick="saveinvest();">Save</button>  
            <button onClick="clearinvest();">Reset</button></td>
            </tr>


          </table>
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

  function enable1(id){
  var elemen = document.getElementById(id);
  if (kebijakan_prosedur.checked==true){
    elemen.disabled = false;
  }else{
    elemen.disabled = true;
    }
  }

  function enable2(id){
  var elemen = document.getElementById(id);
  if (buktifisik.checked==true){
    elemen.disabled = false;
  }else{
    elemen.disabled = true;
    }
  }

  function enable3(id){
  var elemen = document.getElementById(id);
  if (informasi_lain.checked==true){
    elemen.disabled = false;
  }else{
    elemen.disabled = true;
    }
  }



  function saveinvest(){
    var no_lap;
    var Tgl_kejadian;
    var kode_u
    var hasil_skor;
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

    // tinggi && extrim
    var no_rca;
    var kronologis;
    var TglObs;
    var jam_obs;
    var hasil_obs;
    var laporan_kejadian;
    var berkas_RM;
    var kebijakan_prosedur;
    var kebijakan_text;
    var daftarstaf;
    var buktifisik;
    var bukti_text;
    var informasi_lain;
    var informasi_text;
    var TglWaw;
    var jam_waw;
    var hasil_waw;
    var peta_informasi;
    var masalah;
    var analisis;
    var TglAna1;
    var TglAna2;
    var masalah_utama;
    var saran_rekomendasi;
    // a value
    no_lap              = document.getElementById('no_lap').value;
    Tgl_kejadian        = document.getElementById('TglTjd').value;
    kode_u              = document.getElementById('kode_u').value;
    hasil_skor          = document.getElementById('hasil_skor').value;
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
    // tinggi && extrim
    no_rca              = document.getElementById('no_rca').value;
    kronologis          = document.getElementById('kronologis').value;
    TglObs              = document.getElementById('TglObs').value;
    jam_obs             = document.getElementById('jam_obs').value;
    hasil_obs           = document.getElementById('hasil_obs').value;
    kebijakan_text      = document.getElementById('kebijakan_text').value;
    bukti_text          = document.getElementById('bukti_text').value;
    informasi_text      = document.getElementById('informasi_text').value;
    //checkbox
    laporan_kejadian    = document.getElementById('laporan_kejadian').checked;
    berkas_RM           = document.getElementById('berkas_RM').checked;
    kebijakan_prosedur  = document.getElementById('kebijakan_prosedur').checked;
    daftarstaf          = document.getElementById('daftarstaf').checked;
    buktifisik          = document.getElementById('buktifisik').checked;
    informasi_lain      = document.getElementById('informasi_lain').checked;
    //checkbox
    TglWaw              = document.getElementById('TglWaw').value;
    jam_waw             = document.getElementById('jam_waw').value;
    hasil_waw           = document.getElementById('hasil_waw').value;
    peta_informasi      = document.getElementById('peta_informasi').value;
    masalah             = document.getElementById('masalah').value;
    analisis            = document.getElementById('analisis').value;
    TglAna1             = document.getElementById('TglAna1').value;
    TglAna2             = document.getElementById('TglAna2').value;
    masalah_utama       = document.getElementById('masalah_utama').value;
    saran_rekomendasi   = document.getElementById('saran_rekomendasi').value;

    if (laporan_kejadian == true) {
      laporan_kejadian = "X";
    } else {
      laporan_kejadian = " ";
    }

    if (berkas_RM == true) {
      berkas_RM = "X";
    } else {
      berkas_RM = " ";
    }

    if (kebijakan_prosedur == true) {
      kebijakan_prosedur = "X";
    } else {
      kebijakan_prosedur = " ";
    }

    if (daftarstaf == true) {
      daftarstaf = "X";
    } else {
      daftarstaf = " ";
    }

    if (buktifisik == true) {
      buktifisik = "X";
    } else {
      buktifisik = " ";
    }

    if (informasi_lain == true) {
      informasi_lain = "X";
    } else {
      informasi_lain = " ";
    }

    if (no_lap) {
      if (hasil_skor == "Rendah" || hasil_skor == "Moderat") {
        window.location.href = "T_Invest_Save1.php?a1=" + no_lap +"&rm1=" + no_invest +"&rm2=" + penyebab_langsung +"&rm3=" +
         akar_masalah +"&rm4=" + tindakan +"&rm5=" + penanggung_jawab_1 +"&rm6=" + perkiraan_waktu_1 +"&rm7=" + rekomendasi +"&rm8=" + penanggung_jawab_2 +"&rm9=" + perkiraan_waktu_2;
      } else if (hasil_skor == "Tinggi" || hasil_skor == "Ekstrim") {
        window.location.href = "T_Invest_Save2.php?a1=" + no_lap +
        "&te1=" + no_rca +
        "&te2=" + kronologis +
        "&te3=" + TglObs +
        "&te4=" + jam_obs +
        "&te5=" + hasil_obs +
        "&te6=" + laporan_kejadian +
        "&te7=" + berkas_RM +
        "&te8=" + kebijakan_prosedur +
        "&te9=" + daftarstaf +
        "&te10=" + buktifisik +
        "&te11=" + informasi_lain +
        "&te12=" + TglWaw +
        "&te13=" + jam_waw +
        "&te14=" + hasil_waw +
        "&te15=" + peta_informasi +
        "&te16=" + masalah +
        "&te17=" + analisis +
        "&te18=" + TglAna1 +
        "&te19=" + TglAna2 +
        "&te20=" + masalah_utama +
        "&te21=" + saran_rekomendasi +
        "&te22=" + kebijakan_text +
        "&te23=" + bukti_text +
        "&te24=" + informasi_text;
      }
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
