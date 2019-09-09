
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
            <form action="T_Report_1.php" method="get">
              <div class="">
                <table>
                  <tr>
                    <td>Unit</td>
                    <td> : </td>
                    <td>
                      <span class="inputan">
                        <!-- option -->

                        <!-- option -->
                        <select id="kode_u" name="kode_u"  style="width:auto">
                          <option value="">---------------- P I L I H ----------------</option>
                          <?php
                            foreach ($arrind as $Kode=>$Kode) {
                              echo "<option value='$Kode'>$Kode</option>";
                            }
                          ?>
                        </select>
                    </span></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                </br>
                  <tr>
                    <td></td>
                    <td></td>
                    <td><button type="submit" class="btn btn-success" name="submit">Show</button></td>

                  </tr>
                </table>
              </div>
</form>



<!-- Modal -->
<div class="modal fade" id="modalForm" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header" style="background-color: #00BA8B;">
                <button type="button" class="" data-dismiss="modal" style="background-color: #F08080; float: right;">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="labelModalKu" style="color: white;">INPUT INDIKATOR MUTU</h4>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <p class="statusMsg"></p>
                <form role="form">
                    <div class="form-group">
                        <label for="masukkanNama">ID</label>
                        <input type="text" class="form-control" id="masukkanNama" placeholder="Masukkan Indikator"
                        style=" width: 100%;
                        padding: 14px 20px;
                        margin: 8px 0;
                        box-sizing: border-box;"
                        />
                    </div>
                    <div class="form-group">
                        <label for="masukkanNama">Indikator</label>
                        <input type="text" class="form-control" id="masukkanNama" placeholder="Masukkan Indikator"
                        style=" width: 100%;
                        padding: 14px 20px;
                        margin: 8px 0;
                        box-sizing: border-box;"
                        />
                    </div>

                    <div class="form-group">
                        <label for="masukkanNama">Jumlah</label>
                        <input type="text" class="form-control" id="masukkanNama" placeholder="Masukkan Jumlah"
                        style=" width: 100%;
                        padding: 14px 20px;
                        margin: 8px 0;
                        box-sizing: border-box;"
                        />
                    </div>

                    <div class="form-group">
                        <label for="masukkanNama">Numerator</label>
                        <input type="text" class="form-control" id="masukkanNama" placeholder="Masukkan Numerator"
                        style=" width: 100%;
                        padding: 14px 20px;
                        margin: 8px 0;
                        box-sizing: border-box;"
                        />
                    </div>
                    <div class="form-group">
                        <label for="masukkanNama">Denominator</label>
                        <input type="text" class="form-control" id="masukkanNama" placeholder="Masukkan Denominator"
                        style=" width: 100%;
                        padding: 14px 20px;
                        margin: 8px 0;
                        box-sizing: border-box;"
                        />
                    </div>

                    <div class="form-group">
                        <label for="masukkanNama">Analisa</label>
                        <input type="text" class="form-control" id="masukkanNama" placeholder="Masukkan Analisa"
                        style=" width: 100%;
                        padding: 14px 20px;
                        margin: 8px 0;
                        box-sizing: border-box;"
                        />
                    </div>

                    <div class="form-group">
                        <label for="masukkanNama">Tindak Lanjut</label>
                        <input type="text" class="form-control" id="masukkanNama" placeholder="Masukkan Tindak Lanjut"
                        style=" width: 100%;
                        padding: 14px 20px;
                        margin: 8px 0;
                        box-sizing: border-box;"
                        />
                    </div>

                </form>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary submitBtn" onclick="kirimContactForm()">Update</button>
            </div>
        </div>
    </div>
</div>

          <div>
            <br>
          </div>
          <h3>INDIKATOR MUTU</h3>

  <table class="w3-table-all" id="indikator_tbl">
  <tr class="" style="background-color: #00BA8B; color: white;">
    <th>No</th>
    <th>Indikator</th>
    <th>Jumlah</th>
    <th>Numerator</th>
    <th>Denominator</th>
    <th>Analisa</th>
    <th>Tindak Lanjut</th>
    <th>Action</th>
  </tr>

  <?php

  if(isset($_GET['kode_u'])){
  $cari = $_GET['kode_u'];
  $query = "SELECT DISTINCT kode_indikator, Kategori FROM V_Indikator_Kejadian WHERE kode_u= '$cari' ORDER BY kode_indikator ASC";
  $data = sqlsrv_query($conn, $query);
  {
    $queryjmlh =   "SELECT COUNT(kode_indikator) FROM V_Indikator_Kejadian WHERE kode_u='$cari'";
    $sqljmlh  = sqlsrv_query($conn, $queryjmlh);
    $arr1 = array();
     while ($jmlh = sqlsrv_fetch_array($sqljmlh)){
        $arr1 [ $jmlh['kode_indikator'] ] = $jmlh['kode_indikator'];
     }
  }






}

$no = 1;
while($kode_indi = sqlsrv_fetch_array($data)){
?>

  <tr>
    <td><?php echo $no++; ?></td>
    <td><?php echo $kode_indi['kode_indikator']; ?> - <?php echo $kode_indi['Kategori']; ?></td>
    <td><?php echo "test"?></td>
    <td><?php echo "tes34"?></td>
    <td><?php echo "test5"?></td>
    <td><?php echo "test5"?></td>
    <td><?php echo "test5"?></td>
    <td>
      <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#modalForm">
          Edit
      </button>
    </td>
  </tr>
   <?php  } ?>

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


</script>
<script src="js/excanvas.min.js"></script>
<script src="js/chart.min.js" type="text/javascript"></script>
<script src="js/bootstrap.js"></script>
<script src="js/Script.js"></script>
<script language="javascript" type="text/javascript" src="js/full-calendar/fullcalendar.min.js"></script>

<script src="js/base.js"></script>

</body>
</html>
