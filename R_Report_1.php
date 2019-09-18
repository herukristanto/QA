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
            <form name="frmrange" method="post">
            <table style="margin-top:10px;">
              <tr>
                <td>Unit</td>
                <td> : </td>
                <td>
                  <span class="inputan">
                    <select id="kode_u" name="kode_u"  style="width:auto">
                      <option value="">---------------- P I L I H ----------------</option>
                      <?php
                        foreach ($arrind as $Kode=>$Kode) {
                          echo "<option value='$Kode'>$Kode</option>";
                        }
                      ?>
                    </select>
                </span></td>
                <!-- <td><input type="text" id="katakunci" name="katakunci"></td> -->
                <!-- <td><button type="button" class="btn btn-success" id="saringtabel">Show</button></td> -->
              </tr>
            </table>
          </form>
            <!-- <h3>List Indikator Mutu</h3> -->
            <div>

<input type="button" id="myBtn" value="Search" class="btn brn-success">

              <div id="tabel_range"></div>

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
 $('select[id=kode_u]').change(function(){
  R_Data_vindikej();
 });

 function R_Data_vindikej(){
  var a = $('#kode_u').val();
  $.ajax({
   type: 'POST',
   url: "R_Data_vindikej.php",
   data: "kode_u="+a,
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
