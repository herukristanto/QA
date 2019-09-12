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
            <form action="R_Report_1.php" method="get">
              <div class="">
                <table>
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
                      </span>
                    </td>
                  </tr>

                  
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    </br>
                    <tr>
                      <td></td>
                      <td></td>
                      <td><button type="submit" class="btn btn-success">Show</button></td>
                    </tr>
                </table>
              </div>
              <div class="row">

              <div>
</form>



<!-- Modal -->
<div class="modal fade" id="modalForm" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header" style="background-color: #00BA8B;">
                <button type="button" data-dismiss="modal" class="btn btn-success" style="">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="labelModalKu" style="color: white;  float: right;">LIST INDIKATOR MUTU</h4>
            </div>
            <!-- Modal Body -->
            <div class="modal-body" id="myForm">
                <p class="statusMsg"></p>
                <form role="form">
                <table>
                  <tr>
                    <td><label for="masukkanNama">Indikator</label></td>
                    <td> : </td>
                    <td><input type="text" class="form-control" id="kodeindikator" disabled="disabled"
                    style=" width: 100%;
                    padding: 14px 20px;
                    margin: 8px 0;
                    box-sizing: border-box;"/></td>
                  </tr>
                  <tr>
                    <td><label for="masukkanNama">Jumlah</label></td>
                    <td> : </td>
                    <td><input type="text" class="form-control" id="jumlah" disabled="disabled"
                    style=" width: 100%;
                    padding: 14px 20px;
                    margin: 8px 0;
                    box-sizing: border-box;"
                    /></td>
                  </tr>
                </table>
                    <!-- <div class="form-group">
                        <label for="masukkanNama">Indikator</label>
                        <input type="text" class="form-control" id="kodeindikator" disabled="disabled"
                        style=" width: 100%;
                        padding: 14px 20px;
                        margin: 8px 0;
                        box-sizing: border-box;"
                        />
                    </div>

                    <div class="form-group">
                        <label for="masukkanNama">Jumlah</label>
                        <input type="text" class="form-control" id="jumlah" disabled="disabled"
                        style=" width: 100%;
                        padding: 14px 20px;
                        margin: 8px 0;
                        box-sizing: border-box;"
                        />
                    </div> -->

                    <div class="form-group">
                        <label for="masukkanNama">Numerator</label>
                        <input type="text" class="form-control" id="numerator" placeholder="Masukkan Numerator"
                        style=" width: 100%;
                        padding: 14px 20px;
                        margin: 8px 0;
                        box-sizing: border-box;"
                        />
                    </div>
                    <div class="form-group">
                        <label for="masukkanNama">Denominator</label>
                        <input type="text" class="form-control" id="denominator" placeholder="Masukkan Denominator"
                        style=" width: 100%;
                        padding: 14px 20px;
                        margin: 8px 0;
                        box-sizing: border-box;"
                        />
                    </div>

                    <div class="form-group">
                        <label for="masukkanNama">Analisa</label>
                        <input type="text" class="form-control" id="analisa" placeholder="Masukkan Analisa"
                        style=" width: 100%;
                        padding: 14px 20px;
                        margin: 8px 0;
                        box-sizing: border-box;"
                        />
                    </div>

                    <div class="form-group">
                        <label for="masukkanNama">Tindak Lanjut</label>
                        <input type="text" class="form-control" id="tindaklanjut" placeholder="Masukkan Tindak Lanjut"
                        style=" width: 100%;
                        padding: 14px 20px;
                        margin: 8px 0;
                        box-sizing: border-box;"
                        />
                    </div>

                </form>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer" style="background-color: #00BA8B;">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success btn-lg" data-dismiss="modal" onclick="add()">Save</button>
            </div>
        </div>
    </div>
</div>

          <div>
            <br>
          </div>
          <h3>LIST INDIKATOR MUTU</h3>

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
    $hslsblm = array();
    }

    $no = 1;
    while($row = sqlsrv_fetch_array($data)){
      $kode_indi = $row['kode_indikator'];
      $kategori = $row['Kategori'];

      $queryjml = "SELECT count (kode_indikator) as jml FROM V_Indikator_Kejadian WHERE kode_indikator= '$kode_indi'";
      $sqldata = sqlsrv_query($conn,$queryjml);

      while( $dataarr = sqlsrv_fetch_array($sqldata)){
        $jumlah	= $dataarr["jml"];
        $total = $total + $jumlah;

      }

?>

  <tr>
    <td><?php echo $no++; ?></td>
    <td id="kodeindi"><?php echo $kode_indi; ?> - <?php echo $kategori; ?></td>
    <td id="jmlh"><?php echo $jumlah; ?></td>
    <td><?php ?></td>
    <td><?php ?></td>
    <td><?php ?></td>
    <td><?php ?></td>
    <td>
      <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#modalForm" onclick="clik('<?php echo $kode_indi; ?> - <?php echo $kategori; ?>','<?php echo $jumlah; ?>');">
          Edit
      </button>
    </td>
  </tr>

   <?php  } ?>
   <tr class="" style="background-color: #00BA8B; font-size: 15px; font-weight: bold; color: white;">
     <td>Total</td>
     <td></td>
     <td><?php echo $total; ?></td>
     <td></td>
     <td></td>
     <td></td>
     <td></td>
     <td></td>
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
  function clik(x,y){

    var kodeindi;
    var jmlh;

    kodeindi = document.getElementById('kodeindi').innerHTML;
    jmlh = document.getElementById('jmlh').innerHTML;


  $("#kodeindikator").val(x);
  $("#jumlah").val(y);
}

function add(){
  var kodeindi;
  var jmlh;
  var numtor;
  var dentor;
  var analis;
  var tndklnjut;

  kodeindi           = document.getElementById('kodeindikator').value;
  jmlh   = document.getElementById('jumlah').value;
  numtor        = document.getElementById('numerator').value;
  dentor            = document.getElementById('denominator').value;
  analis  = document.getElementById('analisa').value;
  tndklnjut   = document.getElementById('tindaklanjut').value;


  if (kodeindi) {
    window.location.href = "R_Report_Save.php?r1=" + kodeindi +
    "&r2=" + jmlh +
    "&r3=" + numtor +
    "&r4=" + dentor +
    "&r5=" + analis +
    "&r6=" + tndklnjut;

    } else {
      alert("Kolom tidak boleh kosong");
    }
}


//
// function add(){
//   document.getElementById("myForm").style.display = "none";
// }



</script>
<script src="js/excanvas.min.js"></script>
<script src="js/chart.min.js" type="text/javascript"></script>
<script src="js/bootstrap.js"></script>
<script src="js/Script.js"></script>
<script language="javascript" type="text/javascript" src="js/full-calendar/fullcalendar.min.js"></script>

<script src="js/base.js"></script>

</body>
</html>
