<?php
  include "koneksi.php";
  session_start();

  //Cek variabel user dan pass
  if (empty($_SESSION["username"])){
    echo "
    <script>
      alert('Silahkan Login Terlebih Dahulu');
      window.location.href = 'index.html';
    </script>
    ";
  }else{
    $page = basename($_SERVER['PHP_SELF']);
    $quer = "select count(*) as hasil from M_Authorization where User_ID = '".$_SESSION["username"]."' and Form_ID = '".$page."'";
    $sql_execute = sqlsrv_query($conn,$quer);
    $rs = sqlsrv_fetch_array($sql_execute, SQLSRV_FETCH_ASSOC);
    if($rs["hasil"] == 0)
    {
      echo '<script>
      alert("Anda tidak berhak membuka halaman ini");
      window.location="main.php";
      </script>';
    }
  }

  $username = $_SESSION["username"];

?>

<?php
include "koneksi.php";

#ambil data
$query = "SELECT * FROM M_Unit WHERE Status ='X' ";
$sql = sqlsrv_query($conn, $query);
$arrunit = array();
while ($row = sqlsrv_fetch_array($sql)) {
  $arrunit [ $row['Deskripsi'] ] = $row['Deskripsi'];
}


#action get indikator
if(isset($_GET['action']) && $_GET['action'] == "getUnker") {
  $kode_unit = $_GET['Deskripsi'];

#ambil data indikator
  $query = "SELECT * FROM V_Unit_Indikator WHERE Deskripsi= '$kode_unit' AND status_indikator='X'";
  $sql = sqlsrv_query($conn, $query);
  $arrind = array();
  while ($row = sqlsrv_fetch_array($sql)) {
    array_push($arrind, $row);
  }
  echo json_encode($arrind);
  exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>T - Laporan Kejadian - Create</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
<link href="css/font-awesome.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/pages/dashboard.css" rel="stylesheet">
<!-- <link rel="stylesheet" href="css/slider.css"> -->
<script src="js/jquery-1.7.2.min.js"></script>



<?php
include "koneksi.php";

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

<script type="text/javascript" src="libs/jquery.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function()
      {

        $('#unit_kerja').change(function()
        {
          $.getJSON('test.php',{action:'getUnker', Deskripsi:$(this).val()}, function(json)
          {
            $('#indikator').html('');
            $.each(json, function(index, row)
            {
              $('#indikator').append('<option value="'+row.Kode+' - '+row.Kategori+'">'+row.Kode+' - '+row.Kategori+'</option>');

            });
          });
        });
      });
    </script>

<script type="text/javascript">
    function Angkasaja(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
    return false;
    return true;
    }
</script>

    <script type="text/javascript" src="libs/jquery.min.js"></script>

</head>
<body onload="init();">
<div id="header_trn"></div>
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span12 mainPage">
        </br>
        <span><h3>Create Laporan Kejadian</h3></span>

<form  action="T_Kejadian_A_Save.php" method="POST">


      </br>

    <table>
      <tr>
        <tr>
          <td>Insiden Sudah Terjadi ?</td>
          <td>  </td>
          <td colspan="2"><input type="radio" name="kejadian_terjadi" id="ya" value="Ya">Ya</td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2"><input type="radio" name="kejadian_terjadi" id="radio" value="Tidak">Tidak</td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
        </tr>

        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
        </tr>

        <tr>
          <td>Apakah Pasien Mengetahui ?</td>
          <td>  </td>
          <td colspan="2"><input type="radio" name="pasien_mengetahui" id="ya" value="Ya">Ya</td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2"><input type="radio" name="pasien_mengetahui" id="radio2" value="Tidak">Tidak</td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
        </tr>

        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
        </tr>

        <tr>
          <td>Pasien Mengalami Cedera ?</td>
          <td>  </td>
          <td colspan="2"><input type="radio" name="cedera" id="ya" value="Ya">Ya</td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2"><input type="radio" name="cedera" id="tidak" value="Tidak">Tidak</td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
        </tr>

        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
        </tr>

        <tr>
          <td>Hasil Cidera</td>
          <td>  </td>
          <td colspan="2"><input type="radio" name="hasil" id="radio3" value="KTC">KTC</td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2"><input type="radio" name="hasil" id="radio4" value="KNC">KNC</td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2"><input type="radio" name="hasil" id="radio5" value="KPC">KPC</td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2"><input type="radio" name="hasil" id="radio6" value="KTD">KTD</td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2"><input type="radio" name="hasil" id="radio7" value="Sentinel">Sentinel</td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </tr>
    </table>


<br>
<!-- <div id="myDIV"> -->
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
          <td><input type="text" id="no_rm" name="no_rm" maxlength="50" onkeypress="return Angkasaja(event)"/></td>
        </tr>
        <tr>
          <td>Unit terkait</td>
          <td> : </td>
          <td colspan="2">
            <span class="inputan">
              <select id="unit_kerja" name="unit_kerja" style="width:auto">
                <option value="">---------------- P I L I H ----------------</option>
                  <?php
                    foreach ($arrunit as $Unit=>$Kode) {
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
          <td colspan="2"><input type="radio" onclick="enable11('tipe_lain')"name="radiolayanan" id="rawatinap" value="Rawat Inap">Rawat Inap</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2"><input type="radio" onclick="enable11('tipe_lain')"name="radiolayanan" id="rawatjalan" value="Rawat Jalan">Rawat Jalan</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2"><input type="radio" onclick="enable1('tipe_lain')" name="radiolayanan" id="rawatlain" value="Rawat Lain">Lainnya&nbsp;
            <input type="text" id="tipe_lain" disabled="true" name="tipe_lain" maxlength="50"></td>
        </tr>
          <td>&nbsp;</td>
        <tr>
          <td>Tingkat Cedera</td>
          <td colspan="2"><input type="radio" name="radiocedera" onclick="enable22('cedera_lain')" id="kematian" value="kematian">Kematian</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2"><input type="radio" name="radiocedera" onclick="enable22('cedera_lain')" id="berat" value="berat">Cedera Berat</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2"><input type="radio" name="radiocedera" onclick="enable22('cedera_lain')" id="sedang" value="sedang">Cedera Sedang</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2"><input type="radio" name="radiocedera" onclick="enable22('cedera_lain')" id="ringan" value="ringan">Cedera Ringan</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2"><input type="radio" name="radiocedera" onclick="enable22('cedera_lain')" id="tidak ada" value="tidak ada">Tidak Ada Cedera</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2"><input type="radio" onclick="enable2('cedera_lain')" name="radiocedera" id="lain" value="lain">Lainnya
            <input type="text" id="cedera_lain" name="cedera_lain" disabled="true" maxlength="50"></td>
        </tr>
          <td>&nbsp;</td>
        <tr>
          <td>Indikator terkait</td>
          <td> : </td>
          <td colspan="2">
            <select id="indikator" name="indikator" onChange="();">
          <option value="">---------------- P I L I H ----------------</option>
          </select>
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
          <td ><textarea name="kronologi" rows="1" id="kronologi" style="
          overflow: hidden;
          padding: 0;
          border-style: solid;
          border-width: 1px;
          background-color: white;
          font-size: 14px;
          height: 25px; width: 150;"></textarea></td>
        </tr>
          <td height="43">&nbsp;</td>

        <tr>
          <td>Analisa Matriks grading resiko</td>
        </tr>
        <tr>
          <td height="43">&nbsp;</td>
          <td>&nbsp;</td>
          <td>i. Skor dampak klinis/ severity</td>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2"><input onclick="clik();" type="radio" name="radioKlinis" id="Katastropik" value="5">Katastropil (merah-5)</td></tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2"><input onclick="clik();" type="radio" name="radioKlinis" id="Mayor" value="4">Mayor (orange-4)</td></tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2"><input onclick="clik();" type="radio" name="radioKlinis" id="Moderat" value="3">Moderat (kuning-3)</td></tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2"><input onclick="clik();" type="radio" name="radioKlinis" id="Minor" value="2">Minor (hijau-2)</td></tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2"><input onclick="clik();" type="radio" name="radioKlinis" id="TidakSignifikan" value="1">Tidak Signifikan (biru-1)</td></tr>
        </tr>
        <tr>
          <td height="43">&nbsp;</td>
          <td>&nbsp;</td>
          <td>ii. Skor probabilitas/ frekuensi</td>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2"><input onclick="clik();" type="radio" name="radioProbabilitas" id="Sangatsering" value="5">Sangat sering terjadi (merah-5)</td></tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2"><input onclick="clik();" type="radio" name="radioProbabilitas" id="Sering" value="4">Sering terjadi (orange-4)</td></tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2"><input onclick="clik();" type="radio" name="radioProbabilitas" id="Mungkin" value="3">Mungkin terjadi (kuning-3)</td></tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2"><input onclick="clik();" type="radio" name="radioProbabilitas" id="Jarang" value="2">Jarang terjadi (hijau-2)</td></tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2"><input onclick="clik();" type="radio" name="radioProbabilitas" id="Sangatjarang" value="1">Sangat jarang terjadi (biru-1)</td></tr>
        </tr>
          <td>&nbsp;</td>
        <tr>
          <td>Hasil matriks grading resiko</td>
          <td> : </td>
          <td><input type="text" id="hg" maxlength="50" disabled="disabled" style="text-align:center;font-weight:bolder;font-size:14px;color:black"></td>
        </tr>
        <tr hidden="hidden">
          <td>Created By</td>
          <td> : </td>
          <td><input type="text" id="username" name="user"
            value="<?php echo $username; ?>" maxlength="50" style="text-align:center;font-weight:bolder;font-size:14px;color:black"></td>
        </tr>
        <tr>
          <td height="43">&nbsp;</td>
          <td>&nbsp;</td>

            <td><button type="submit" name="Submit">Simpan</button>&nbsp;&nbsp;&nbsp;
            <button type="reset" name="Reset">Reset</button></td>

        </tr>
      </table>
</form>
<!-- </div> -->
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



function enable1(id){
  var elemen = document.getElementById(id);

    elemen.disabled = false;

}

function enable11(id){
  var elemen = document.getElementById(id);

    elemen.disabled = true;

}
function enable2(id){
  var elemen = document.getElementById(id);

    elemen.disabled = false;

}


function enable22(id){
  var elemen = document.getElementById(id);

    elemen.disabled = true;

}


   function clik(){

    const rk = $('input[name=radioKlinis]:checked').val();
    const rp = $('input[name=radioProbabilitas]:checked').val();

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

      $("#rkb").val(rk);
      $("#rpb").val(rp);
      $("#hg").val(hg);

    var inputVal = document.getElementById("hg");
     if (inputVal.value == "Ekstrim") {
         inputVal.style.backgroundColor = "red"; //red
     } else if (inputVal.value == "Tinggi") {
         inputVal.style.backgroundColor = "yellow";
     }else if (inputVal.value == "Moderat") {
          inputVal.style.backgroundColor = "green";
     }else if (inputVal.value == "Rendah") {
          inputVal.style.backgroundColor = "#1E90FF";
     }else if (inputVal.value == "") {
          inputVal.style.backgroundColor = "";
     }

}

var textarea = document.querySelector('textarea');

textarea.addEventListener('keydown', autosize);

function autosize(){
  var el = this;
  setTimeout(function(){
    el.style.cssText = 'height:auto; padding:0';
    // for box-sizing other than "content-box" use:
    // el.style.cssText = '-moz-box-sizing:content-box';
    el.style.cssText = 'height:' + el.scrollHeight + 'px';
  },0);
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
