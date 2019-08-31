<?php
include "koneksi.php";

{
  #ambil data semua unit
    $query = "SELECT * FROM T_Kejadian_a WHERE Status = 'X'";
    $sql   = sqlsrv_query($conn, $query);
    $arrunit = array();
    while ($row = sqlsrv_fetch_array($sql)) {
      $arrunit [ $row['Deskripsi'] ] = $row['Kode'];
    }
  }


?>


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
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body>
<div id="header_rpt"></div>
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span12 mainPage">

    <h2>Report Pending</h2>

  <table class="w3-table-all w3-card-4">
  <!-- <div class="w3-responsive"> -->
  <table class="w3-table-all">
  <tr class="w3-green">
    <th>No. Lap Kejadian</th>
    <th>Tanggal Kejadian</th>
    <th>Insident</th>
    <th>Tipe Insident</th>
    <th>Unit Kerja</th>
    <th>Unit Keja Terkait</th>
    <th>No. Lap Unit Kerja Terkait</th>
  </tr>
  <tr>
    <td>Jill</td>
    <td>Smith</td>
    <td>50</td>
    <td>50</td>
    <td>50</td>
    <td>50</td>
    <td>50</td>

  </tr>
  <tr>
    <td>Eve</td>
    <td>Jackson</td>
    <td>94</td>
    <td>94</td>
    <td>94</td>
    <td>94</td>
    <td>94</td>

  </tr>
  <tr>
    <td>Adam</td>
    <td>Johnson</td>
    <td>67</td>
    <td>67</td>
    <td>67</td>
    <td>67</td>
    <td>67</td>

  </tr>
  </table>
  </div>

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

		function show() {
			var table = document.getElementById("myTable_2");
			table.rows[4].cells[0].removeAttribute('hidden');
			table.rows[5].cells[0].removeAttribute('hidden');
			table.rows[6].cells[0].removeAttribute('hidden');
			table.rows[7].cells[0].removeAttribute('hidden');
			table.rows[8].cells[0].removeAttribute('hidden');
			document.getElementById("btnshow").setAttribute('disabled','true');

			var tahun;
			var departemen;
			var unitkerja;

			tahun = document.getElementById('tahun').value;
			departemen = document.getElementById('departemen').value;
			unitkerja = document.getElementById('unitkerja').value;


		}


</script>



<script>
  function button(x)
  {
    window.location.href = x;
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
