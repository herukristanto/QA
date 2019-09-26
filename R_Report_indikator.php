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
            <div class="alert alert-success fade in">
        			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        			Pesan Alert Sukses
        		</div>

          <div>
						<div class="">
							<a href="R_Report_1.php"><button href="R_Report_1.php" class="btn btn-success" >Back Indikator</button></a>
						</div>
            <br>
            <div class="">
              <table>
                <tr>
                  <td></td>
                </tr>
              </table>
              <label for="">Bulan</label>
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
                &nbsp;
                <label for="">Tahun</label>
                <input type="text" id="tahun" name="tahun" maxlength="4" style="height :auto; width : 50px">

            </div>
            <br>
          </div>
          <!-- <h3>INDIKATOR MUTU</h3> -->

					  <table class="w3-table-all" id="indikator_tbl">
					  <tr class="" style="background-color: #00BA8B; color: white;">
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

					  <tr>
              <td><?php echo $no++; ?></td>
              <td><?php echo $tgl; ?></td>
					    <td><?php echo $jam; ?></td>
					    <td><?php echo $kodeindi; ?></td>
					    <td><?php echo $jmlh; ?></td>
					    <td><?php echo $numtor; ?></td>
					    <td><?php echo $dentor; ?></td>
					    <td><?php echo $analis; ?></td>
					    <td><?php echo $tndklanjt; ?></td>
					  </tr>

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
