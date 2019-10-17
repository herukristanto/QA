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
<title>T - Laporan Kejadian - Change</title>
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
  #ambil data semua indikator
    $query = "SELECT * FROM M_Indikator WHERE Status = 'X' ORDER BY Kode ASC";
    $sql   = sqlsrv_query($conn, $query);
    $arrind_display = array();
    while ($row = sqlsrv_fetch_array($sql)) {
      $arrind_display [ $row['Kode'] ] = $row['Kategori'];
    }
  }

// {
//   #ambil data semua indikator
//     $query = "SELECT * FROM M_Indikator WHERE Status = 'X' ORDER BY Kode ASC";
//     $sql   = sqlsrv_query($conn, $query);
//     $arrind = array();
//     while ($row = sqlsrv_fetch_array($sql)) {
//       $arrind [ $row['Kode'] ] = $row['Kategori'];
//     }
//   }

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
<body>
<div id="header_trn"></div>
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span12 mainPage">
  <br>

</br>
  <span class="style1">Change Laporan Kejadian</span><br>
    <td>&nbsp;</td>
<form action="T_Kejadian_A_Update.php" method="get">

  <table>
    <tr>
      <tr>
        <td>Insiden Sudah Terjadi ?</td>
        <td>  </td>
        <td colspan="2"><input type="radio" name="kejadian_terjadi" id="kjd_ya" value="Ya">Ya</td>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="2"><input type="radio" name="kejadian_terjadi" id="kjd_tidak" value="Tidak">Tidak</td>
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
        <td colspan="2"><input type="radio" name="pasien_mengetahui" id="pasien_ya" value="Ya">Ya</td>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="2"><input type="radio" name="pasien_mengetahui" id="pasien_tidak" value="Tidak">Tidak</td>
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
        <td colspan="2"><input type="radio" name="cedera" id="cedera_ya" value="Ya">Ya</td>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="2"><input type="radio" name="cedera" id="cedera_tidak" value="Tidak">Tidak</td>
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
        <td colspan="2"><input type="radio" name="hasil" id="KTC" value="KTC">KTC</td>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="2"><input type="radio" name="hasil" id="KNC" value="KNC">KNC</td>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="2"><input type="radio" name="hasil" id="KPC" value="KPC">KPC</td>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="2"><input type="radio" name="hasil" id="KTD" value="KTD">KTD</td>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="2"><input type="radio" name="hasil" id="Sentinel" value="Sentinel">Sentinel</td>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </tr>
  </table>

  <table>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>No. Laporan</td>
        <td> : </td>
        <td><input name="nolap" id="no_lap" type="text" readonly style="text-align:center;font-weight:bold;font-size:14px"></td>
      </tr>
      <tr>
        <td>Tanggal Kejadian </td>
        <td>:</td>
        <td><input  name="tgl_kejadian" id="tgl_kejadian" type="text" value="<?php
        if(isset($app['App_Date']))
          {echo $app['App_Date']->format('d/m/Y');}
        else
          {echo date('d/m/Y');} ?>" maxlength="10" style="text-align:center;font-weight:bold;font-size:15px"/></td>
      </tr>
        <tr>
          <td>Jam Kejadian</td>
          <td> : </td>
          <td><input   value="<?php echo $jam;?>" id="jam_kejadian" name="jam_kejadian" maxlength="50" style="text-align:center;font-weight:bold;font-size:14px"></td>
        </tr>
        <tr>
          <td>Lokasi Kejadian</td>
          <td> : </td>
          <td><input  type="text" id="lokasi" name="lokasi" maxlength="50"></td>
        </tr>
        <tr>
          <td>No. Rekam Medis</td>
          <td> : </td>
          <td><input  type="text" id="no_rm" name="no_rm" maxlength="50" onkeypress="return Angkasaja(event)"/></td>
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
          <td><input name="no_lap_1" type="text" id="no_lap_1" maxlength="50"></td>
        </tr>
          <td>&nbsp;</td>
        <tr>
          <td>Tipe Layanan</td>
          <td colspan="2">
            <input onclick="enable11('rawat_lain')" type="radio" name="tipe_layanan" id="rawatinap" value="Rawat Inap">Rawat Inap          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2">
            <input onclick="enable11('rawat_lain')" type="radio" name="tipe_layanan" id="rawatjalan" value="Rawat Jalan">Rawat Jalan          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2">
            <input onclick="enable1('rawat_lain')" type="radio" name="tipe_layanan" id="rawatlain" value="Rawat Lain">Lainnya &nbsp;
            <input type="text" id="rawat_lain" name="rawat_lain" maxlength="50" >          </td>
        </tr>
          <td>&nbsp;</td>
        <tr>
          <td>Tingkat Cedera</td>
          <td colspan="2"><input onclick="enable22('cedera_lain')" type="radio" name="tingkat_cidera" id="kematian" value="kematian">Kematian</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2"><input onclick="enable22('cedera_lain')" type="radio" name="tingkat_cidera" id="berat" value="berat">Cedera Berat</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2"><input onclick="enable22('cedera_lain')" type="radio" name="tingkat_cidera" id="sedang" value="sedang">Cedera Sedang</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2"><input onclick="enable22('cedera_lain')" type="radio" name="tingkat_cidera" id="ringan" value="ringan">Cedera Ringan</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2"><input onclick="enable22('cedera_lain')" type="radio" name="tingkat_cidera" id="tidak ada" value="tidak ada">Tidak Ada Cedera</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2"><input onclick="enable22('cedera_lain')" type="radio" name="tingkat_cidera" id="lain" value="lain">Lainnya&nbsp;
            <input  type="text" id="cedera_lain" name="cedera_lain" maxlength="50"></td>
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
              <select id="kode_insiden" name="kode_insiden"  style="width:auto">
                <option value="">---------------- P I L I H ----------------</option>
                <?php
                foreach ($arrinsiden as $Kode=>$Kode) {
                  echo "<option value='$Kode'>$Kode</option>";
                }
                ?>
              </select>
            </span>          </td>
        </tr>
        <tr>
          <td>Tipe insiden</td>
          <td> : </td>
          <td colspan="2">
            <span class="inputan">
              <select id="tipe_insiden" name="tipe_insiden"  style="width:auto">
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
          <td colspan="2">
            <span class="inputan">
              <select id="kode_sub" name="kode_sub"  style="width:auto">
                <option value="">---------------- P I L I H ----------------</option>
                <?php
                  foreach ($arrsub as $Kode=>$Kode) {
                    echo "<option value='$Kode'>$Kode</option>";
                  }
                ?>
              </select>
            </span>          </td>
        </tr>
        <tr>
          <td>Kronologi Kejadian</td>
          <td> : </td>
          <td><textarea name="kronologis" id="kronologis" rows="1" style="
          overflow: hidden;
          padding: 0;
          border-style: solid;
          border-width: 1px;
          background-color: white;
          font-size: 14px;
          height: 25px; width: 150;"></textarea></td>
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
          <td colspan="2"><input onclick="clik();" type="radio" name="skor_dampak" id="5"  value="5">Katastropil (merah-5)</td></tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2"><input onclick="clik();" type="radio" name="skor_dampak" id="4"  value="4">Mayor (orange-4)</td></tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2"><input onclick="clik();" type="radio" name="skor_dampak" id="3"  value="3">Moderat (kuning-3)</td></tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2"><input onclick="clik();" type="radio" name="skor_dampak" id="2"  value="2">Minor (hijau-2)</td></tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2"><input onclick="clik();" type="radio" name="skor_dampak" id="1"  value="1">Tidak Signifikan (biru-1)</td></tr>
        </tr>
        <tr>
          <td height="43">&nbsp;</td>
          <td>&nbsp;</td>
          <td>ii. Skor probabilitas/ frekuensi</td>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2"><input onclick="clik();" type="radio" name="skor_prob" id="prob_5"  value="5">Sangat sering terjadi (merah-5)</td></tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2"><input onclick="clik();" type="radio" name="skor_prob" id="prob_4"  value="4">Sering terjadi (orange-4)</td></tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2"><input onclick="clik();" type="radio" name="skor_prob" id="prob_3"  value="3">Mungkin terjadi (kuning-3)</td></tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2"><input onclick="clik();" type="radio" name="skor_prob" id="prob_2"  value="2">Jarang terjadi (hijau-2)</td></tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2"><input onclick="clik();" type="radio" name="skor_prob" id="prob_1"  value="1">Sangat jarang terjadi (biru-1)</td></tr>
        </tr>
          <td>&nbsp;</td>
        <tr>
          <td>Hasil matriks grading resiko</td>
          <td> : </td>
          <td><input type="text" id="hasil_skor" name="hasil_skor" style="text-align:center;font-weight:bold;font-size:14px;color:black" disabled="disabled" maxlength="15" ></td>
        </tr>
        <tr>
          <td height="43">&nbsp;</td>
          <td>&nbsp;</td>
            <td>
            <button type="submit" name="Submit" style=" background-color: #4CAF50; /* Green */
      border: none;
      color: white;
      padding: 6px 20px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 14px;
      border-radius: 8px;">Update</button>  
            <button type="reset" name="Reset" style=" background-color: #4CAF50; /* Green */
      border: none;
      color: white;
      padding: 6px 20px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 14px;
      border-radius: 8px;">Reset</button>
      &nbsp;
            <input type="button" id="myBtn" value="Search" style=" background-color: #4CAF50; /* Green */
      border: none;
      color: white;
      padding: 6px 20px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 14px;
      border-radius: 8px;">
            </td>
        </tr>
      </table>
      </form>
      <!-- <table>
        <tr>
          <td colspan="2">&nbsp;</td>
          <td colspan="2">&nbsp;</td>
          <td><button id="myBtn">Search</button></td>
        </tr>
      </table> -->

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
    document.getElementById(id).value;

}
function enable11(id){
  var elemen = document.getElementById(id);

    elemen.disabled = true;
    document.getElementById(id).value = '';

}
function enable2(id){
  var elemen = document.getElementById(id);
  elemen.disabled = false;
  document.getElementById(id).value;

}


function enable22(id){
  var elemen = document.getElementById(id);

    elemen.disabled = true;
    document.getElementById(id).value = '';

}


   function clik(){

    const rk = $('input[name=skor_dampak]:checked').val();
    const rp = $('input[name=skor_prob]:checked').val();

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
      $("#hasil_skor").val(hg);

    var inputVal = document.getElementById("hasil_skor");
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
