

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
<title>T - Laporan Kejadian - Display</title>
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

</head>
<body>
<div id="header_trn"></div>
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">

          <!-- mulai -->
          <!-- <form class="" action="T_Kejadian_A_Save.php" method="post"> -->
          <div class="span12">
	      		<div class="widget ">
	      			<div class="widget-header">
	      				<i class="icon-desktop"></i>
	      				<h3>Display Laporan Kejadian</h3>
	  				  </div> <!-- /widget-header -->

              <div class="widget-content">
						  <div class="tabbable">
						  <br>

							<div class="tab-content">
								<div class="tab-pane active" id="formcontrols">
								<div id="edit-profile" class="form-horizontal">
									<fieldset>

                    <div class="control-group">
                      <label class="control-label">Insiden Sudah Terjadi?</label>
                        <div class="controls">
                          <label class="radio inline">
                            <input type="radio" name="kejadian_terjadi" id="kjd_ya" value="Ya" disabled="disabled"> Ya
                          </label>

                          <label class="radio inline">
                            <input type="radio" name="kejadian_terjadi" id="kjd_tidak" value="Tidak" disabled="disabled"> Tidak
                          </label>
                      </div>	<!-- /controls -->
                    </div> <!-- /control-group -->

                    <div class="control-group">
                      <label class="control-label">Apakah Pasien Mengetahui?</label>
                        <div class="controls">
                          <label class="radio inline">
                            <input type="radio" name="pasien_mengetahui" id="pasien_ya" value="Ya" disabled="disabled"> Ya
                          </label>

                          <label class="radio inline">
                            <input type="radio" name="pasien_mengetahui" id="pasien_tidak" value="Tidak" disabled="disabled"> Tidak
                          </label>
                      </div>	<!-- /controls -->
                    </div> <!-- /control-group -->

                    <div class="control-group">
                      <label class="control-label">Pasien Mengalami Cedera?</label>
                        <div class="controls">
                          <label class="radio inline">
                            <input type="radio" name="cedera" id="cedera_ya" value="Ya" disabled="disabled"> Ya
                          </label>

                          <label class="radio inline">
                            <input type="radio" name="cedera" id="cedera_tidak" value="Tidak" disabled="disabled"> Tidak
                          </label>
                      </div>	<!-- /controls -->
                    </div> <!-- /control-group -->

                    <div class="control-group">
                      <label class="control-label">Hasil Cedera</label>
                        <div class="controls">
                          <label class="radio inline">
                            <input type="radio" name="hasil" id="KTC" value="KTC" disabled="disabled" readonly="true"> KTC
                          </label>

                          <label class="radio inline">
                            <input type="radio" name="hasil" id="KNC" value="KNC" disabled="disabled" readonly="true"> KNC
                          </label>

                          <label class="radio inline">
                            <input type="radio" name="hasil" id="KPC" value="KPC" disabled="disabled" readonly="true"> KPC
                          </label>

                          <label class="radio inline">
                            <input type="radio" name="hasil" id="KTD" value="KTD" disabled="disabled" readonly="true"> KTD
                          </label>

                          <label class="radio inline">
                            <input type="radio" name="hasil" id="Sentinel" value="Sentinel" disabled="disabled" readonly="true"> Sentinel
                          </label>
                      </div>	<!-- /controls -->
                    </div> <!-- /control-group -->



										<div class="control-group">
											<label class="control-label" for="nolap">No. Laporan</label>
											<div class="controls">
												<input type="text" class="span2 disabled" name="nolap" id="no_lap" readonly="true" style="text-align:center;font-weight:bold;font-size:14px">
											</div> <!-- /controls -->
										</div> <!-- /control-group -->


										<div class="control-group">
											<label class="control-label" for="TglTjd">Tanggal Kejadian</label>
											<div class="controls">
												<input type="text" class="span2" name="TglTjd" id="TglTjd" value="<?php
                        if(isset($app['App_Date']))
                          {echo $app['App_Date']->format('d/m/Y');}
                        else
                          {echo date('d/m/Y');} ?>"  style="text-align:center;font-weight:bold;font-size:14px" readonly="true">
											</div> <!-- /controls -->
										</div> <!-- /control-group -->


                    <div class="control-group">
											<label class="control-label" for="jam_kejadian">Jam Kejadian</label>
											<div class="controls">
												<input type="text" class="span2" name="jam_kejadian" id="jam_kejadian" style="text-align:center;font-weight:bold;font-size:14px" value="<?php echo $jam;?>" style="text-align:center;" readonly="true">
											</div> <!-- /controls -->
										</div> <!-- /control-group -->


                    <div class="control-group">
											<label class="control-label" for="lokasi">Lokasi Kejadian</label>
											<div class="controls">
												<input type="text" class="span3" name="lokasi" id="lokasi" value="" readonly="true">
											</div> <!-- /controls -->
										</div> <!-- /control-group -->


                    <div class="control-group">
											<label class="control-label" for="no_rm">No. Rekam Medis</label>
											<div class="controls">
												<input type="text" class="span3" name="no_rm" id="no_rm" value="" readonly="true">
											</div> <!-- /controls -->
										</div> <!-- /control-group -->


                    <div class="control-group">
                      <label class="control-label" for="unit_kerja">Unit Terkait</label>

                      <div class="controls">
                        <span class="inputan">

                          <select id="unit_kerja" name="unit_kerja" class="span3" readonly="true">
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
												<input type="text" class="span3" name="nolap_unit" id="no_lap_1" value="" readonly="true">
											</div> <!-- /controls -->
										</div> <!-- /control-group -->



                    <div class="control-group">
                      <label class="control-label">Tipe Layanan</label>
                        <div class="controls">
                          <label class="radio inline">
                            <input type="radio" onclick="enable33('tipe_lain')"name="radiolayanan" id="rawatinap" checked value="Rawat Inap" readonly="true"> Rawat Inap
                          </label>
                      </div>	<!-- /controls -->
                      <div class="controls">
                        <label class="radio inline">
                          <input type="radio" onclick="enable33('tipe_lain')"name="radiolayanan" id="rawatjalan" value="Rawat Jalan" readonly="true"> Rawat Jalan
                        </label>
                    </div>	<!-- /controls -->
                    <div class="controls">
                      <label class="radio inline">
                        <input type="radio" onclick="enable3('tipe_lain')" name="radiolayanan" id="rawatlain" value="Rawat Lain" readonly="true"> Lainnya
                        <input type="text" class="span3" disabled="true" name="radiolayanan" id="text_layanan" value="" readonly="true">
                      </label>
                  </div>	<!-- /controls -->
                    </div> <!-- /control-group -->



                    <div class="control-group">
                      <label class="control-label">Tingkat Cedera</label>
                        <div class="controls">
                          <label class="radio inline">
                            <input type="radio" name="radiocedera" onclick="enable22('cedera_lain')" id="kematian" checked value="kematian" readonly="true"> Kematian
                          </label>
                      </div>	<!-- /controls -->
                      <div class="controls">
                        <label class="radio inline">
                          <input type="radio" name="radiocedera" onclick="enable22('cedera_lain')" id="berat" value="berat" readonly="true"> Cedera Berat
                        </label>
                    </div>	<!-- /controls -->
                    <div class="controls">
                      <label class="radio inline">
                        <input type="radio" name="radiocedera" onclick="enable22('cedera_lain')" id="sedang" value="sedang" readonly="true"> Cedera Sedang
                      </label>
                  </div>	<!-- /controls -->
                  <div class="controls">
                    <label class="radio inline">
                      <input type="radio" name="radiocedera" onclick="enable22('cedera_lain')" id="ringan" value="ringan" readonly="true"> Cedera Ringan
                    </label>
                </div>	<!-- /controls -->
                <div class="controls">
                  <label class="radio inline">
                    <input type="radio" name="radiocedera" onclick="enable22('cedera_lain')" id="tidak ada" value="tidak ada" readonly="true"> Tidak Ada Cedera
                  </label>
              </div>	<!-- /controls -->
                    <div class="controls">
                      <label class="radio inline">
                        <input type="radio" onclick="enable2('cedera_lain')" name="radiocedera" id="lain" value="lain" readonly="true"> Lainnya
                        <input type="text" class="span3" id="text_cedera" name="radiocedera" value="" disabled="true" readonly="true">
                      </label>
                  </div>	<!-- /controls -->
                    </div> <!-- /control-group -->


                    <div class="control-group">
                      <label class="control-label" for="radiobtns">Indikator Terkait</label>

                      <div class="controls">
                        <span class="inputan">
                          <select id="indikator" name="indikator" onChange="();" class="span3" readonly="true">
                        <option value="">---------------- P I L I H ----------------</option>
                        <?php
                          foreach ($arrind_display as $Kode=>$Kategori) {
                            echo "<option value='$Kode'>$Kode - $Kategori</option>";
                          }
                          ?>
                        </select>
                        </span>
                      </div>
                    </div>

                    <div class="control-group">
                      <label class="control-label" for="radiobtns">Jenis insiden</label>

                      <div class="controls">

                        <span class="inputan">
                          <select id="kode_insiden" name="jenis_insiden" class="span3" readonly="true">
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
                          <select id="tipe_insiden" name="tipe_insiden" class="span3" readonly="true">
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
                          <select id="kode_sub" name="sub_tipe" class="span3" readonly="true">
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
                        <textarea name="kronologi" rows="1" id="kronologis" class="span3" readonly="true"></textarea>
											</div> <!-- /controls -->
										</div> <!-- /control-group -->


                    <div class="control-group">
                      <h4>Analisa Matriks grading resiko</h4>
                      <label class="control-label">i. Skor dampak klinis/ severity</label>
                        <div class="controls">
                          <label class="radio inline">
                            <input onclick="clik();" type="radio" name="radioKlinis" id="5" value="5" readonly="true">Katastropil (merah-5)
                          </label>
                      </div>	<!-- /controls -->
                      <div class="controls">
                        <label class="radio inline">
                          <input onclick="clik();" type="radio" name="radioKlinis" id="4" value="4" readonly="true">Mayor (orange-4)
                        </label>
                    </div>	<!-- /controls -->
                    <div class="controls">
                      <label class="radio inline">
                        <input onclick="clik();" type="radio" name="radioKlinis" id="3" value="3" readonly="true">Moderat (kuning-3)
                      </label>
                  </div>	<!-- /controls -->
                  <div class="controls">
                    <label class="radio inline">
                      <input onclick="clik();" type="radio" name="radioKlinis" id="2" value="2" readonly="true">Minor (hijau-2)
                    </label>
                  </div>	<!-- /controls -->
                  <div class="controls">
                  <label class="radio inline">
                    <input onclick="clik();" type="radio" name="radioKlinis" id="1" value="1" readonly="true">Tidak Signifikan (biru-1)
                  </label>
                  </div>	<!-- /controls -->
                    </div> <!-- /control-group -->

                    <div class="control-group">

                      <label class="control-label">ii. Skor probabilitas/ frekuensi</label>
                        <div class="controls">
                          <label class="radio inline">
                            <input onclick="clik();" type="radio" name="radioProbabilitas" id="prob_5" value="5" readonly="true">Sangat sering terjadi (merah-5)
                          </label>
                      </div>	<!-- /controls -->
                      <div class="controls">
                        <label class="radio inline">
                          <input onclick="clik();" type="radio" name="radioProbabilitas" id="prob_4" value="4" readonly="true">Sering terjadi (orange-4)
                        </label>
                    </div>	<!-- /controls -->
                    <div class="controls">
                      <label class="radio inline">
                        <input onclick="clik();" type="radio" name="radioProbabilitas" id="prob_3" value="3" readonly="true">Mungkin terjadi (kuning-3)
                      </label>
                  </div>	<!-- /controls -->
                  <div class="controls">
                    <label class="radio inline">
                      <input onclick="clik();" type="radio" name="radioProbabilitas" id="prob_2" value="2" readonly="true">Jarang terjadi (hijau-2)
                    </label>
                  </div>	<!-- /controls -->
                  <div class="controls">
                  <label class="radio inline">
                    <input onclick="clik();" type="radio" name="radioProbabilitas" id="prob_1" value="1" readonly="true">Sangat jarang terjadi (biru-1)
                  </label>
                  </div>	<!-- /controls -->
                    </div> <!-- /control-group -->


                    <div class="control-group">
											<label class="control-label" for="lastname">Hasil matriks grading resiko</label>
											<div class="controls">
												<input type="text" id="hasil_skor" maxlength="50" disabled="disabled" style="text-align:center;font-weight:bolder;font-size:14px;color:black" readonly="true">
											</div> <!-- /controls -->
										</div> <!-- /control-group -->


                    <div hidden="hidden" class="control-group">
											<!-- <label class="control-label" for="lastname">Created By</label> -->
											<div class="controls">
												<input type="text" id="username" name="user"
                          value="<?php echo "$username" ?>" readonly="true">
											</div> <!-- /controls -->
										</div> <!-- /control-group -->


                    <div class="form-actions">
  											<!-- <button type="submit" name="submit"  class="btn btn-success">Simpan</button>
  											<button class="btn" type="reset" name="Reset">Reset</button> -->
                        <button id="myBtn" class="btn btn-success">Search</button>   
                        <button class="btn btn-danger" type="reset" name="Reset">Reset</button>
  										</div>

                    </div>
                  </div>
                  <?php include "T_Kejadian_A_Search.php"; ?>
                  </div>


								</div>

							</div>

						</div>

					</div> <!-- /widget-content -->

				</div> <!-- /widget -->


        <!-- /span12 -->
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



</script>

<script src="js/excanvas.min.js"></script>
<script src="js/chart.min.js" type="text/javascript"></script>
<script src="js/bootstrap.js"></script>
<script src="js/Script.js"></script>
<script language="javascript" type="text/javascript" src="js/full-calendar/fullcalendar.min.js"></script>

<script src="js/base.js"></script>

</body>
</html>
