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
                    <select name="bulan" id="bulan">
                      <option value="">Pilih</option>
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
                  <td>
                    <div>

            <select name="tahun" id="tahun">
                <option value="">Pilih</option>
                <?php
                $query = "SELECT YEAR(Tgl) AS tahun FROM T_Kejadian GROUP BY YEAR(Tgl)"; // Tampilkan tahun sesuai di tabel transaksi
                $sql = sqlsrv_query($conn, $query); // Eksekusi/Jalankan query dari variabel $query
                while($data = sqlsrv_fetch_array($sql)){ // Ambil semua data dari hasil eksekusi $sql
                    echo '<option value="'.$data['tahun'].'">'.$data['tahun'].'</option>';
                }
                ?>
            </select>

        </div>
                  </td>
                  <td>
                    <button type="button" name="button" id="filter" onclick="click1()" class="btn btn-success">
                      <i class="icon-search"></i>
                      Search</button>
                  </td>
                </tr>
              </table>

            </div>
            <br>
          </div>
          <!-- <h3>INDIKATOR MUTU</h3> -->
          <!-- <a target="_blank" href="R_Report_indikator.php">EXPORT KE EXCEL</a> -->
          <div>
            <div id="tabel_range"></div>
            <div>
              <button>Export</button>
            </div>
          </div>
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
  function click1(){
  var bulan   = $('#bulan').val();
	var tahun = $('#tahun').val();
  var filter = $('#filter').val();

	$.ajax({
		//Alamat url harap disesuaikan dengan lokasi script pada komputer anda
		url	     : 'R_Data_Show.php',
		type     : 'POST',
		dataType : 'html',
		data     : 'bulan='+bulan+'&tahun='+tahun+'&filter='+filter,
    success: function(info) {
     $("#tabel_range").html(info);   }
   });
   return false;
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
