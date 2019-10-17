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
include "koneksi.php";

date_default_timezone_set("Asia/Jakarta");

$jam = date('G:i:s');

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

//Create Autonumber RCA
$sql_RCA          = "SELECT MAX(No_RCA) AS id FROM T_RCA";
$sql_execute_RCA  = sqlsrv_query($conn,$sql_RCA);
$sql_hasil_RCA    = sqlsrv_fetch_array($sql_execute_RCA);
$cek_RCA          = $sql_hasil_RCA['id'];

$kode_RCA         = substr($cek_RCA,10,14);

$tambah_RCA       = $kode_RCA + 1;
  
  if($tambah_RCA<9){
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

           <!--  <script>
               function getskor(){  
                    var hasil_skor=document.getElementById("hasil_skor").value;  
                    if var hasil_skor = "Tinggi";  
                      var penyebab_langsung = document.getElementById('penyebab_langsung');
                      penyebab_langsung.disabled = true;
                    }  
            </script> -->
            
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
              <td><input type="text" id="perkiraan_waktu_1" name="perkiraan_waktu_1" maxlength="20"></td>
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
              <td><input type="text" id="perkiraan_waktu_2" name="perkiraan_waktu_2" maxlength="20"></td>
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
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="laporan_kejadian" id="laporan_kejadian" value="laporan kejadian">
              Laporan Kejadian</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="berkas_RM" id="berkas_RM" value="berkas RM">
              Berkas RM + Hasil pemeriksaan</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="kebijakan_prosedur" id="kebijakan_prosedur" value="kebijakan dan prosedur">
              Kebijakan dan prosedur yang berhubungan (sebutkan nomor dan judul) :</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="daftarstaf" id="daftarstaf" value="daftar staf">
              Daftar Staf</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="buktifisik" id="buktifisik" value="bukti fisik">
              Bukti Fisik</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="informasi_lain" id="informasi_lain" value="informasi lain">
              Informasi lain yang mempengaruhi insiden</td>
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
               <td><input name="TglObs" type="text" id="TglWaw" value="<?php
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
  function saveinvest(){
    var no_lap;
    var hasil_skor;
    var no_invest;
    var penyebab_langsung;
    var akar_masalah;
    var tindakan;
    var penanggung_jawab_1;
    var perkiraan_waktu_1;
    var rekomendasi;
    var penanggung_jawab_2;
    var perkiraan_waktu_2;
    var no_rca;
    var kronologis;
    var TglObs;
    var jam_obs;
    var hasil_obs;
    var laporan_kejadian;
    var berkas_RM;
    var kebijakan_prosedur;
    var daftarstaf;
    var buktifisik;
    var informasi_lain;
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

    no_lap              = document.getElementById('no_lap').value;
    hasil_skor          = document.getElementById('hasil_skor').value;
    no_invest           = document.getElementById('no_invest').value;
    penyebab_langsung   = document.getElementById('penyebab_langsung').value;
    akar_masalah        = document.getElementById('akar_masalah').value;
    tindakan            = document.getElementById('tindakan').value;
    penanggung_jawab_1  = document.getElementById('penanggung_jawab_1').value;
    perkiraan_waktu_1   = document.getElementById('perkiraan_waktu_1').value;
    rekomendasi         = document.getElementById('rekomendasi').value;
    penanggung_jawab_2  = document.getElementById('penanggung_jawab_2').value;
    perkiraan_waktu_2   = document.getElementById('perkiraan_waktu_2').value;
    no_rca              = document.getElementById('no_rca').value;
    kronologis          = document.getElementById('kronologis').value;  
    TglObs              = document.getElementById('TglObs').value;
    jam_obs             = document.getElementById('jam_obs').value;
    hasil_obs           = document.getElementById('hasil_obs').value;
    laporan_kejadian    = document.getElementById('laporan_kejadian').value;
    berkas_RM           = document.getElementById('berkas_RM').value;
    kebijakan_prosedur  = document.getElementById('kebijakan_prosedur').value;
    daftarstaf          = document.getElementById('daftarstaf').value;
    buktifisik          = document.getElementById('buktifisik').value;
    informasi_lain      = document.getElementById('informasi_lain').value;
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

    var simpan;
    simpan = "baru";

    if (no_lap) {
      window.location.href='T_Invest_Save.php?no_lap=' + no_lap + '&hasil_skor' + hasil_skor + '&no_invest=' + no_invest + '&penyebab_langsung=' + penyebab_langsung + '&akar_masalah' + akar_masalah + '&tindakan' + tindakan + '&penanggung_jawab_1' + penanggung_jawab_1 + '&perkiraan_waktu_1' + perkiraan_waktu_1 +
         '&rekomendasi' + rekomendasi + '&penanggung_jawab_2' + penanggung_jawab_2 + '&perkiraan_waktu_2' + perkiraan_waktu_2 + '&no_rca' + no_rca + '&kronologis'  + kronologis  + '&TglObs' + TglObs + '&jam_obs' + jam_obs + '&hasil' + hasil + '&laporan_kejadian' + laporan_kejadian + '&berkas_RM' + berkas_RM + '&kebijakan_prosedur' + kebijakan_prosedur + '&daftarstaf' + daftarstaf + '&buktifisik' + buktifisik + '&informasi_lain' + informasi_lain + '&TglWaw' + TglWaw + '&jam_waw' + jam_waw + '&peta_informasi' + peta_informasi + '&masalah' + masalah + '&analisis' + analisis + '&TglAna1' + TglAna1 + '&TglAna2' + TglAna2 + '&masalah_utama' + masalah_utama + '&saran_rekomendasi' + saran_rekomendasi + '&simpan=' + simpan;
    } else {
      alert("Kolom 'No. Laporan' tidak boleh kosong");
    }
  }

  function clearinvest(){
    document.getElementById('no_lap').value;
    document.getElementById('no_invest').value;
    document.getElementById('penyebab_langsung').value;
    document.getElementById('akar_masalah').value;
    document.getElementById('tindakan').value;
    document.getElementById('penanggung_jawab_1').value;
    document.getElementById('perkiraan_waktu_1').value;
    document.getElementById('rekomendasi').value;
    document.getElementById('penanggung_jawab_2').value;
    document.getElementById('perkiraan_waktu_2').value;
    document.getElementById('no_rca').value = '';
    document.getElementById('kronologis').value = '';
    document.getElementById('TglObs').value = '';
    document.getElementById('jam_obs').value = '';
    document.getElementById('hasil').value = '';
    document.getElementById('laporan_kejadian').value = '';
    document.getElementById('berkas_RM').value = '';
    document.getElementById('kebijakan_prosedur').value = '';
    document.getElementById('daftarstaf').value = '';
    document.getElementById('buktifisik').value = '';
    document.getElementById('informasi_lain').value = '';
    document.getElementById('TglWaw').value = '';
    document.getElementById('jam_waw').value = '';
    document.getElementById('hasil_waw').value = '';
    document.getElementById('peta_informasi').value = '';
    document.getElementById('masalah').value = '';
    document.getElementById('analisis').value = '';
    document.getElementById('TglAna1').value = '';
    document.getElementById('TglAna2').value = '';
    document.getElementById('masalah_utama').value = '';
    document.getElementById('saran_rekomendasi').value = '';
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
