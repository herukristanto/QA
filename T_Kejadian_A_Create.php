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


          <!-- mulai -->

          <div class="span12">
	      		<div class="widget ">
	      			<div class="widget-header">
	      				<i class="icon-user"></i>
	      				<h3>Create Laporan Kejadian</h3>
	  				  </div> <!-- /widget-header -->

              <div class="widget-content">
						  <div class="tabbable">
						  <br>

							<div class="tab-content">
								<div class="tab-pane active" id="formcontrols">
								<form id="edit-profile" class="form-horizontal">
									<fieldset>

                    <div class="control-group">
                      <label class="control-label">Insiden Sudah Terjadi?</label>
                        <div class="controls">
                          <label class="radio inline">
                            <input type="radio" name="kejadian_terjadi" id="ya" value="Ya"> Ya
                          </label>

                          <label class="radio inline">
                            <input type="radio" name="kejadian_terjadi" id="tidak" value="Tidak"> Tidak
                          </label>
                      </div>	<!-- /controls -->
                    </div> <!-- /control-group -->

                    <div class="control-group">
                      <label class="control-label">Apakah Pasien Mengetahui?</label>
                        <div class="controls">
                          <label class="radio inline">
                            <input type="radio" name="pasien_mengetahui" id="ya" value="Ya"> Ya
                          </label>

                          <label class="radio inline">
                            <input type="radio" name="pasien_mengetahui" id="tidak" value="Tidak"> Tidak
                          </label>
                      </div>	<!-- /controls -->
                    </div> <!-- /control-group -->

                    <div class="control-group">
                      <label class="control-label">Pasien Mengalami Cedera?</label>
                        <div class="controls">
                          <label class="radio inline">
                            <input type="radio" name="cedera" id="ya" value="Ya"> Ya
                          </label>

                          <label class="radio inline">
                            <input type="radio" name="cedera" id="tidak" value="Tidak"> Tidak
                          </label>
                      </div>	<!-- /controls -->
                    </div> <!-- /control-group -->

                    <div class="control-group">
                      <label class="control-label">Hasil Cedera</label>
                        <div class="controls">
                          <label class="radio inline">
                            <input type="radio" name="hasil" id="radio3" value="KTC"> KTC
                          </label>

                          <label class="radio inline">
                            <input type="radio" name="hasil" id="radio4" value="KNC"> KNC
                          </label>

                          <label class="radio inline">
                            <input type="radio" name="hasil" id="radio5" value="KPC"> KPC
                          </label>

                          <label class="radio inline">
                            <input type="radio" name="hasil" id="radio6" value="KTD"> KTD
                          </label>

                          <label class="radio inline">
                            <input type="radio" name="hasil" id="radio7" value="Sentinel"> Sentinel
                          </label>
                      </div>	<!-- /controls -->
                    </div> <!-- /control-group -->



										<div class="control-group">
											<label class="control-label" for="nolap">No. Laporan</label>
											<div class="controls">
												<input type="text" class="span2 disabled" name="nolap" id="nolap" value="<?php echo $id; ?>" disabled="" style="text-align:center;font-weight:bold;font-size:14px">
											</div> <!-- /controls -->
										</div> <!-- /control-group -->


										<div class="control-group">
											<label class="control-label" for="TglTjd">Tanggal Kejadian</label>
											<div class="controls">
												<input type="text" class="span2" name="TglTjd" id="TglTjd" value="<?php
                        if(isset($app['App_Date']))
                          {echo $app['App_Date']->format('d/m/Y');}
                        else
                          {echo date('d/m/Y');} ?>"  style="text-align:center;">
											</div> <!-- /controls -->
										</div> <!-- /control-group -->


                    <div class="control-group">
											<label class="control-label" for="jam_kejadian">Jam Kejadian</label>
											<div class="controls">
												<input type="text" class="span2" name="jam_kejadian" id="jam_kejadian" value="<?php echo $jam;?>" style="text-align:center;">
											</div> <!-- /controls -->
										</div> <!-- /control-group -->


                    <div class="control-group">
											<label class="control-label" for="lokasi">Lokasi Kejadian</label>
											<div class="controls">
												<input type="text" class="span3" name="lokasi" id="lokasi" value="">
											</div> <!-- /controls -->
										</div> <!-- /control-group -->


                    <div class="control-group">
											<label class="control-label" for="no_rm">No. Rekam Medis</label>
											<div class="controls">
												<input type="text" class="span3" name="no_rm" id="no_rm" value="">
											</div> <!-- /controls -->
										</div> <!-- /control-group -->


                    <div class="control-group">
                      <label class="control-label" for="unit_kerja">Unit Terkait</label>

                      <div class="controls">
                        <span class="inputan">

                          <select id="unit_kerja" name="unit_kerja" class="span3">
                            <option value="">--------------------- P I L I H ---------------------</option>
                              <?php
                                foreach ($arrunit as $Unit=>$Kode) {
                                  echo "<option value='$Kode'>$Kode</option>";
                                }
                                ?>
                          </select>
                        </span>
                      </div>
                    </div>


                    <div class="control-group">
											<label class="control-label" for="nolap_unit">No. Laporan Unit Terkait</label>
											<div class="controls">
												<input type="text" class="span3" name="nolap_unit" id="nolap_unit" value="">
											</div> <!-- /controls -->
										</div> <!-- /control-group -->



                    <div class="control-group">
                      <label class="control-label">Tipe Layanan</label>
                        <div class="controls">
                          <label class="radio inline">
                            <input type="radio" onclick="enable11('tipe_lain')"name="radiolayanan" id="rawatinap" value="Rawat Inap"> Rawat Inap
                          </label>
                      </div>	<!-- /controls -->
                      <div class="controls">
                        <label class="radio inline">
                          <input type="radio" onclick="enable11('tipe_lain')"name="radiolayanan" id="rawatjalan" value="Rawat Jalan"> Rawat Jalan
                        </label>
                    </div>	<!-- /controls -->
                    <div class="controls">
                      <label class="radio inline">
                        <input type="radio" onclick="enable1('tipe_lain')" name="radiolayanan" id="rawatlain" value="Rawat Lain"> Lainnya
                        <input type="text" class="span3" id="tipe_lain" disabled="true" name="tipe_lain">
                      </label>
                  </div>	<!-- /controls -->
                    </div> <!-- /control-group -->



                    <div class="control-group">
                      <label class="control-label">Tingkat Cedera</label>
                        <div class="controls">
                          <label class="radio inline">
                            <input type="radio" name="radiocedera" onclick="enable22('cedera_lain')" id="kematian" value="kematian"> Kematian
                          </label>
                      </div>	<!-- /controls -->
                      <div class="controls">
                        <label class="radio inline">
                          <input type="radio" name="radiocedera" onclick="enable22('cedera_lain')" id="berat" value="berat"> Cedera Berat
                        </label>
                    </div>	<!-- /controls -->
                    <div class="controls">
                      <label class="radio inline">
                        <input type="radio" name="radiocedera" onclick="enable22('cedera_lain')" id="sedang" value="sedang"> Cedera Sedang
                      </label>
                  </div>	<!-- /controls -->
                  <div class="controls">
                    <label class="radio inline">
                      <input type="radio" name="radiocedera" onclick="enable22('cedera_lain')" id="ringan" value="ringan"> Cedera Ringan
                    </label>
                </div>	<!-- /controls -->
                <div class="controls">
                  <label class="radio inline">
                    <input type="radio" name="radiocedera" onclick="enable22('cedera_lain')" id="tidak ada" value="tidak ada"> Tidak Ada Cedera
                  </label>
              </div>	<!-- /controls -->
                    <div class="controls">
                      <label class="radio inline">
                        <input type="radio" onclick="enable2('cedera_lain')" name="radiocedera" id="lain" value="lain"> Lainnya
                        <input type="text" class="span3" id="cedera_lain" name="cedera_lain" disabled="true">
                      </label>
                  </div>	<!-- /controls -->
                    </div> <!-- /control-group -->


                    <div class="control-group">
                      <label class="control-label" for="radiobtns">Indikator Terkait</label>

                      <div class="controls">
                        <span class="inputan">
                          <select id="indikator" name="indikator" onChange="();" class="span3">
                        <option value="">---------------- P I L I H ----------------</option>
                        </select>
                        </span>
                      </div>
                    </div>


                    <div class="control-group">
                      <label class="control-label" for="radiobtns">Jenis insiden</label>

                      <div class="controls">

                        <span class="inputan">
                          <select id="jenis_insiden" name="jenis_insiden" class="span3">
                            <option value="">---------------- P I L I H ----------------</option>
                            <?php
                            foreach ($arrinsiden as $Kode=>$Kode) {
                              echo "<option value='$Kode'>$Kode</option>";
                            }
                            ?>
                          </select>
                        </span>
                      </div>
                    </div>


                    <div class="control-group">
                      <label class="control-label" for="radiobtns">Tipe Insiden</label>

                      <div class="controls">
                        <span class="inputan">
                          <select id="tipe_insiden" name="tipe_insiden" class="span3">
                            <option value="">---------------- P I L I H ----------------</option>
                            <?php
                              foreach ($arrtipe as $Kode=>$Kode) {
                                echo "<option value='$Kode'>$Kode</option>";
                              }
                            ?>
                          </select>
                        </span>
                      </div>
                    </div>


                    <div class="control-group">
                      <label class="control-label" for="radiobtns">Sub Tipe Insiden</label>

                      <div class="controls">
                        <span class="inputan">
                          <select id="sub_tipe" name="sub_tipe" class="span3">
                            <option value="">---------------- P I L I H ----------------</option>
                            <?php
                              foreach ($arrsub as $Kode=>$Kode) {
                                echo "<option value='$Kode'>$Kode</option>";
                              }
                            ?>
                          </select>
                        </span>
                      </div>
                    </div>


                    <div class="control-group">
											<label class="control-label" for="lastname">Kronologi Kejadian</label>
											<div class="controls">
                        <textarea name="kronologi" rows="1" id="kronologi" class="span3"></textarea>
											</div> <!-- /controls -->
										</div> <!-- /control-group -->


                    <div class="control-group">
                      <h4>Analisa Matriks grading resiko</h4>
                      <label class="control-label">i. Skor dampak klinis/ severity</label>
                        <div class="controls">
                          <label class="radio inline">
                            <input onclick="clik();" type="radio" name="radioKlinis" id="Katastropik" value="5">Katastropil (merah-5)
                          </label>
                      </div>	<!-- /controls -->
                      <div class="controls">
                        <label class="radio inline">
                          <input onclick="clik();" type="radio" name="radioKlinis" id="Mayor" value="4">Mayor (orange-4)
                        </label>
                    </div>	<!-- /controls -->
                    <div class="controls">
                      <label class="radio inline">
                        <input onclick="clik();" type="radio" name="radioKlinis" id="Moderat" value="3">Moderat (kuning-3)
                      </label>
                  </div>	<!-- /controls -->
                  <div class="controls">
                    <label class="radio inline">
                      <input onclick="clik();" type="radio" name="radioKlinis" id="Minor" value="2">Minor (hijau-2)
                    </label>
                  </div>	<!-- /controls -->
                  <div class="controls">
                  <label class="radio inline">
                    <input onclick="clik();" type="radio" name="radioKlinis" id="TidakSignifikan" value="1">Tidak Signifikan (biru-1)
                  </label>
                  </div>	<!-- /controls -->
                    </div> <!-- /control-group -->

                    <div class="control-group">

                      <label class="control-label">ii. Skor probabilitas/ frekuensi</label>
                        <div class="controls">
                          <label class="radio inline">
                            <input onclick="clik();" type="radio" name="radioProbabilitas" id="Sangatsering" value="5">Sangat sering terjadi (merah-5)
                          </label>
                      </div>	<!-- /controls -->
                      <div class="controls">
                        <label class="radio inline">
                          <input onclick="clik();" type="radio" name="radioProbabilitas" id="Sering" value="4">Sering terjadi (orange-4)
                        </label>
                    </div>	<!-- /controls -->
                    <div class="controls">
                      <label class="radio inline">
                        <input onclick="clik();" type="radio" name="radioProbabilitas" id="Mungkin" value="3">Mungkin terjadi (kuning-3)
                      </label>
                  </div>	<!-- /controls -->
                  <div class="controls">
                    <label class="radio inline">
                      <input onclick="clik();" type="radio" name="radioProbabilitas" id="Jarang" value="2">Jarang terjadi (hijau-2)
                    </label>
                  </div>	<!-- /controls -->
                  <div class="controls">
                  <label class="radio inline">
                    <input onclick="clik();" type="radio" name="radioProbabilitas" id="Sangatjarang" value="1">Sangat jarang terjadi (biru-1)
                  </label>
                  </div>	<!-- /controls -->
                    </div> <!-- /control-group -->


                    <div class="control-group">
											<label class="control-label" for="lastname">Hasil matriks grading resiko</label>
											<div class="controls">
												<input type="text" id="hg" maxlength="50" disabled="disabled" style="text-align:center;font-weight:bolder;font-size:14px;color:black">
											</div> <!-- /controls -->
										</div> <!-- /control-group -->


                    <div hidden="hidden" class="control-group">
											<label class="control-label" for="lastname">Created By</label>
											<div class="controls">
												<input <input type="text" id="username" name="user"
                          value="<?php echo $username; ?>" maxlength="50" style="text-align:center;font-weight:bolder;font-size:14px;color:black">
											</div> <!-- /controls -->
										</div> <!-- /control-group -->


                    <div class="form-actions">
  											<button type="submit" class="btn btn-success">Simpan</button>
  											<button class="btn" type="reset" name="Reset">Reset</button>
  										</div>

                  </div>

                  </div>

								</div>

							</div>

						</div>

					</div> <!-- /widget-content -->

				</div> <!-- /widget -->

        </div>
        <!-- /span12 -->
      </div>
      <!-- /row -->
    </div>
    <!-- /container -->
  </div>
  <!-- /main-inner -->

<!-- /main -->

<!-- extra -->
<div class="extra">

  	<div class="extra-inner">

  		<div class="container">

  			<div class="row">
        
                      <div class="span6">
                          <h4>Rumah Sakit Pantai Indah Kapuk</h4>
                        </div> <!-- /row -->

  		</div> <!-- /container -->

  	</div> <!-- /extra-inner -->

  </div>

  <!-- footer -->
  <div class="footer">

  	<div class="footer-inner">

  		<div class="container">

  			<div class="row">

      			<div class="span12">
      				© 2013 <a href="#">Bootstrap Responsive Admin Template</a>.
      			</div> <!-- /span12 -->

      		</div> <!-- /row -->

  		</div> <!-- /container -->

  	</div> <!-- /footer-inner -->

  </div>



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
