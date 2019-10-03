<?php error_reporting(0); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Report</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
<link href="css/font-awesome.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/pages/dashboard.css" rel="stylesheet">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<script src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="libs/jquery.min.js"></script>



<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <?php
    include "koneksi.php";

    {
      #ambil data semua indikator
        $query = "SELECT * FROM V_Indikator_Kejadian WHERE status = 'X' ";
        $sql  = sqlsrv_query($conn, $query);
        $arrind = array();
        while ($row = sqlsrv_fetch_array($sql)) {
          $arrind [ $row['kode_u'] ] = $row['kode_u'];

        }

      }

    ?>

</head>
<body>
<div id="header_rpt"></div>
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span12 mainPage">
          <div class="w3-container">
            <?php if(isset($_GET["success"])) {?>
              <div class="alert alert-success" role="alert">
                Data Berhasil Disimpan
                <button type="button" style="none" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            	<?php } ?>
            	<?php if(isset($_GET["failed"])) {?>
            		<div class="alert alert-danger alert-dismissible" role="alert">
            		  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            		  Proses simpan <strong>gagal</strong>!. Data Gagal Disimpan.
            		</div>
            	<?php } ?>
          <div>

            <br>
            <div class="">
              <table>
                <tr>
                  <td><label for=""> Pilih Bulan</label></td>
                  <td>
                    <select name="bulan">
                      <?php
                      $bulan = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
                      for($a=1;$a<=12;$a++){
                       if($a==date("m")){
                         $pilih="selected";
                       } else {
                       $pilih="";
                       }

                      echo("<option value=\"$a\" $pilih>$bulan[$a]</option>"."\n");
                      }
                      ?>
                      </select>
                  </td>
                  <!-- <td><label for="">Tahun</label></td> -->
                  <td><input type="text" id="tahun" name="tahun" maxlength="4" style="height :auto; width : 50px"></td>
                  <td>
                    <button type="button" name="button" class="btn btn-primary">
                      <i class="icon-search"></i>
                      Search</button>
                  </td>
                </tr>
              </table>

            </div>
            <br>
          </div>
          <!-- <h3>INDIKATOR MUTU</h3> -->

					  <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                 <th>No</th>
                  <th>Tanggal</th>
                  <th>Jam</th>
                 <th>Indikator</th>
                 <th>Jumlah</th>
                 <th>Numerator</th>
                 <th>Denominator</th>
                 <th>Analisa</th>
                 <th>Tindak Lanjut</th>
               </tr>
              </thead>


					  <?php
					    $query = "SELECT * FROM T_Kejadian ORDER BY Indikator ASC";
					    $data = sqlsrv_query($conn, $query);

					    $no = 1;
					    while($row = sqlsrv_fetch_array($data)){
					      $kodeindi = $row['Indikator'];
					      $jmlh = $row['Jml'];
								$numtor = $row['Numerator'];
								$dentor = $row['Denominator'];
								$analis = $row['Analisa'];
								$tndklanjt = $row['Tindak_Lanjut'];
                $tgl = $row['Tgl']->format('d/m/Y');;
                $jam = $row['Tgl']->format('H:i:s');;
					  ?>

<tbody>
  <tr>
    <td class="center" style="text-align: center;"><?php echo $no++; ?></td>
    <td class="center" style="text-align: center;"><?php echo $tgl; ?></td>
    <td class="center" style="text-align: center;"><?php echo $jam; ?></td>
    <td><?php echo $kodeindi; ?></td>
    <td class="center" style="text-align: center;"><?php echo $jmlh; ?></td>
    <td class="center" style="text-align: center;"><?php echo $numtor; ?></td>
    <td class="center" style="text-align: center;"><?php echo $dentor; ?></td>
    <td><?php echo $analis; ?></td>
    <td><?php echo $tndklanjt; ?></td>
  </tr>
</tbody>

					   <?php  } ?>

					  </table>

				  </div>
				</div>
      </div>
    </div>
  </div>
</div>
<!-- /main -->

  <!-- /extra-inner -->
</div>
<!-- /extra -->
<div class="footer">
  <div class="footer-inner">
    <div class="container">
      <!-- <div class="row">
        <p>
          Rumah Sakit Pantai Indah Kapuk
        </p> -->
      </div>
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

<script src="js/base.js"></script>

</body>
</html>
