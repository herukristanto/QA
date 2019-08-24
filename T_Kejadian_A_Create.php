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
<form  action="T_Kejadian_A_Save.php" method="POST">
  <br>


    <table>
      <tr>
        <tr>
          <td>Insiden Sudah Terjadi ?</td>
          <td> : </td>
          <td colspan="2"><input type="radio" name="kejadian_terjadi" id="ya" value="Ya">Ya</td>
          <td>&nbsp;</td>
          <td colspan="2"><input type="radio" name="kejadian_terjadi" id="tidak" value="Tidak">Tidak</td>
        </tr>
      </tr>
        <tr>
          <tr>
            <td>Apakah Pasien Mengetahui ?</td>
            <td> : </td>
            <td colspan="2"><input type="radio" name="pasien_mengetahui" id="ya" value="Ya">Ya</td>
            <td>&nbsp;</td>
            <td colspan="2"><input type="radio" name="pasien_mengetahui" id="tidak" value="Tidak">Tidak</td>
          </tr>
        </tr>

        <tr>
          <tr>
            <td>Pasien Mengalami Cedera ?</td>
              <td> : </td>
              <td colspan="2"><input type="radio" name="cedera" id="ya" value="Ya">Ya</td>
              <td>&nbsp;</td>
              <td colspan="2"><input type="radio" name="cedera" id="tidak" value="Tidak">Tidak</td>
              </tr>
            </tr>
            <tr>
              <tr>
                <td>Hasil Cidera</td>
                <td> : </td>

                  <td colspan="2"><input type="radio" name="hasil" id="Katastropik" value="KTC">KTC</td>
                  <td>&nbsp;</td>

                  <td colspan="2"><input type="radio" name="hasil" id="Katastropik" value="KNC">KNC</td>
                  <td>&nbsp;</td>

                  <td colspan="2"><input type="radio" name="hasil" id="Mayor" value="KPC">KPC</td>
                  <td>&nbsp;</td>

                  <td colspan="2"><input type="radio" name="hasil" id="Moderat" value="KTD">KTD</td>
                  <td>&nbsp;</td>

                  <td colspan="2"><input type="radio" name="hasil" id="Minor" value="Sentinel">Sentinel</td>

              </tr>
            </tr>

    </table>

</br>
  <span class="style1">Create Laporan Kejadian</span><br>
    <td>&nbsp;</td>
    <table>
      <tr>
      <tr>
        <td>No. Laporan</td>
        <td> : </td>
        <td><input name="nolap" type="text" readonly value="<?php echo $id; ?>" style="text-align:center;font-weight:bold;font-size:14px"></td>
      </tr>
      <tr>
        <td>Tanggal Kejadian </td>
        <td>:</td>
        <td><input name="TglTjd" type="text" id="TglTjd" value="<?php
        if(isset($app['App_Date']))
          {echo $app['App_Date']->format('d/m/Y');}
        else
          {echo date('d/m/Y');} ?>" maxlength="10" style="text-align:center;font-weight:bold;font-size:15px"/></td>
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
          <td colspan="2">
            <span class="inputan">
              <select id="unit" name="unit" style="width:auto">
                <option value="">---------------- P I L I H ----------------</option>
                  <?php
                    foreach ($arrunit as $Kode=>$Kode) {
                      echo "<option value='$Kode'>$Kode</option>";
                    }
                    ?>
              </select>
            </span>
          </td>
        </tr>
        <tr>
          <td>No. Laporan unit terkait</td>
          <td> : </td>
          <td><input name="nolap_unit" type="text" id="nolap_unit" maxlength="50"></td>
        </tr>
          <td>&nbsp;</td>
        <tr>
          <td>Tipe Layanan</td>
          <td colspan="2"><input type="radio" name="radiolayanan" id="rawatinap" value="Rawat Inap">Rawat Inap</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2"><input type="radio" name="radiolayanan" id="rawatjalan" value="Rawat Jalan">Rawat Jalan</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2"><input type="radio" name="radiolayanan" id="rawatlain" value="rawatlain">Lainnya&nbsp;<input type="text" id="tipe_lain" name="tipe_lain" maxlength="50"></td>
        </tr>
          <td>&nbsp;</td>
        <tr>
          <td>Tingkat Cedera</td>
          <td colspan="2"><input type="radio" name="radiocedera" id="kematian" value="kematian">Kematian</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2"><input type="radio" name="radiocedera" id="berat" value="berat">Cedera Berat</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2"><input type="radio" name="radiocedera" id="sedang" value="sedang">Cedera Sedang</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2"><input type="radio" name="radiocedera" id="ringan" value="ringan">Cedera Ringan</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2"><input type="radio" name="radiocedera" id="tidakada" value="tidakada">Tidak Ada Cedera</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2"><input type="radio" name="radiocedera" id="lain" value="lain">Lainnya&nbsp;<input type="text" id="cedera_lain" name="cedera_lain" maxlength="50"></td>
        </tr>
          <td>&nbsp;</td>
        <tr>
          <td>Indikator terkait</td>
          <td> : </td>
          <td colspan="2">
            <span class="inputan">
              <select id="indikator" name="indikator" style="width:auto">
                <option value="">---------------- P I L I H ----------------</option>
                <?php
                  foreach ($arrind as $Kode=>$Kode) {
                    echo "<option value='$Kode'>$Kode</option>";
                  }
                ?>
              </select>
            </span>
          </td>
        </tr>
        <tr>
          <td>Jenis insiden</td>
          <td> : </td>
          <td colspan="2">
            <span class="inputan">
              <select id="jenis_insiden" name="jenis_insiden" style="width:auto">
                <option value="">---------------- P I L I H ----------------</option>
                <?php
                foreach ($arrinsiden as $Kode=>$Kode) {
                  echo "<option value='$Kode'>$Kode</option>";
                }
                ?>
              </select>
            </span>
          </td>
        </tr>
        <tr>
          <td>Tipe insiden</td>
          <td> : </td>
          <td colspan="2">
            <span class="inputan">
              <select id="tipe_insiden" name="tipe_insiden" style="width:auto">
                <option value="">---------------- P I L I H ----------------</option>
                <?php
                  foreach ($arrtipe as $Kode=>$Kode) {
                    echo "<option value='$Kode'>$Kode</option>";
                  }
                ?>
              </select>
            </span>
          </td>
        </tr>
        <tr>
          <td>Sub Tipe insiden</td>
          <td> : </td>
          <td colspan="2">
            <span class="inputan">
              <select id="sub_tipe" name="sub_tipe" style="width:auto">
                <option value="">---------------- P I L I H ----------------</option>
                <?php
                  foreach ($arrsub as $Kode=>$Kode) {
                    echo "<option value='$Kode'>$Kode</option>";
                  }
                ?>
              </select>
            </span>
          </td>
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
          <td colspan="2"><input class="rdoklinik" type="radio" name="radioKlinis" id="Katastropik"  value="5">Katastropil (merah-5)</td></tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2"><input class="rdoklinik" type="radio" name="radioKlinis" id="Mayor"  value="4">Mayor (orange-4)</td></tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2"><input class="rdoklinik" type="radio" name="radioKlinis" id="Moderat"  value="3">Moderat (kuning-3)</td></tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2"><input class="rdoklinik" type="radio" name="radioKlinis" id="Minor"  value="2">Minor (hijau-2)</td></tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2"><input class="rdoklinik" type="radio" name="radioKlinis" id="TidakSignifikan"  value="1">Tidak Signifikan (biru-1)</td></tr>
        </tr>
        <tr>
          <td height="43">&nbsp;</td>
          <td>&nbsp;</td>
          <td>ii. Skor probabilitas/ frekuensi</td>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2"><input class="rdoprob" type="radio" name="radioProbabilitas" id="Sangatsering"  value="5">Sangat sering terjadi (merah-5)</td></tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2"><input class="rdoprob" type="radio" name="radioProbabilitas" id="Sering"  value="4">Sering terjadi (orange-4)</td></tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2"><input class="rdoprob" type="radio" name="radioProbabilitas" id="Mungkin"  value="3">Mungkin terjadi (kuning-3)</td></tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2"><input class="rdoprob" type="radio" name="radioProbabilitas" id="Jarang"  value="2">Jarang terjadi (hijau-2)</td></tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2"><input class="rdoprob" type="radio" name="radioProbabilitas" id="Sangatjarang"  value="1">Sangat jarang terjadi (biru-1)</td></tr>
        </tr>
          <td>&nbsp;</td>
        <tr>
          <td>Hasil matriks grading resiko</td>
          <td> : </td>
          <td><input type="text" class="hasil_grading" id="hasil_grading" name="hasil_grading" maxlength="50" >

            <span id="hg"></span>
          </td>
        </tr>
        <tr>
          <td>
            <span id="hg"></span>
          </td>
        </tr>
        <tr>
          <td height="43">&nbsp;</td>
          <td>&nbsp;</td>

            <td><button type="submit" name="Submit">Simpan</button>&nbsp;&nbsp;&nbsp;
            <button type="reset" name="Reset">Reset</button></td>

        </tr>
      </table>
</form>
<button type="button" name="button" onClick="klik();">Cek</button>
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


<script src="js/excanvas.min.js"></script>
<script src="js/chart.min.js" type="text/javascript"></script>
<script src="js/bootstrap.js"></script>
<script src="js/Script.js"></script>
<script language="javascript" type="text/javascript" src="js/full-calendar/fullcalendar.min.js"></script>

<script>

function klik(){

var rk = document.getElementsByClassName("rdoklinik").value;
var rp = document.getElementsByClassName("rdoprob").value;
var hg;
  if (rk == 5 && rp == 5) {
    hg = "Ekstrim";
  }else if(rk == 5 && rp == 4){
    hg = "Ekstrim";
  }else if(rk == 5 && rp == 3){
    hg = "Ekstrim";
  }else if(rk == 5 && rp == 2){
    hg = "Ekstrim";
  }else if(rk == 5 && rp == 1){
    hg = "Ekstrim";
  }else if(rk == 4 && rp == 5){
    hg = "Ekstrim";
  }else if(rk == 4 && rp == 4){
    hg = "Ekstrim";
  }else if(rk == 4 && rp == 3){
    hg = "Ekstrim";
  }else if(rk == 4 && rp == 2){
    hg = "Tinggi";
  }else if(rk == 4 && rp == 1){
    hg = "Tinggi";
  }else if(rk == 3 && rp == 5){
    hg = "Tinggi";
  }else if(rk == 3 && rp == 4){
    hg = "Tinggi";
  }else if(rk == 3 && rp == 3){
    hg = "Tinggi";
  }else if(rk == 3 && rp == 2){
    hg = "Moderat";
  }else if(rk == 3 && rp == 1){
    hg = "Moderat";
  }else if(rk == 2 && rp == 5){
    hg = "Moderat";
  }else if(rk == 2 && rp == 4){
    hg = "Moderat";
  }else if(rk == 2 && rp == 3){
    hg = "Moderat";
  }else if(rk == 2 && rp == 2){
    hg = "Rendah";
  }else if(rk == 2 && rp == 1){
    hg = "Rendah";
  }else if(rk == 1 && rp == 5){
    hg = "Moderat";
  }else if(rk == 1 && rp == 4){
    hg = "Moderat";
  }else if(rk == 1 && rp == 3){
    hg = "Rendah";
  }else if(rk == 1 && rp == 2){
    hg = "Rendah";
  }else if(rk == 1 && rp == 1){
    hg = "Rendah";
  }

  document.getElementById('hg').innerHTML = hg;
}
</script>

</body>
</html>
