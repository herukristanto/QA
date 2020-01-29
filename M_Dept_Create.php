<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Departemen - Create</title>
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
</head>
<body>
<div id="header_mstr"></div>

<!-- mulai -->
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">

        <div class="span12">
          <div class="widget ">
            <div class="widget-header">
              <i class="icon-pencil"></i>
              <h3><span>Create Departemen </span</h3>
            </div> <!-- /widget-header -->

            <div class="widget-content">
            <div class="tabbable">
            <br>

            <div class="tab-content">
              <div class="tab-pane active" id="formcontrols">
              <form id="edit-profile" action="M_Dept_Save.php" method="GET" class="form-horizontal">
                <fieldset>

                  <div class="control-group">
                    <label class="control-label" for="lokasi">Kode Departemen</label>
                    <div class="controls">
                      <input type="text" class="span3" name="kd_dept" id="kd_dept" maxlength="3" value="">
                    </div> <!-- /controls -->
                  </div> <!-- /control-group -->

                  <div class="control-group">
                    <label class="control-label" for="lokasi">Deskripsi</label>
                    <div class="controls">
                      <input type="text" class="span3" name="desk_dept" id="desk_dept" value="">
                    </div> <!-- /controls -->
                  </div> <!-- /control-group -->

                  <div class="control-group">
                    <label class="control-label">Status</label>
                      <div class="controls">
                        <label class="radio inline">
                          <input type="radio" name="statdept" id="aktif" checked value="X"> Aktif
                        </label>
                    </div>	<!-- /controls -->
                    <div class="controls">
                      <label class="radio inline">
                        <input type="radio" name="statdept" id="nonaktif" value=""> Non-Aktif
                      </label>
                  </div>	<!-- /controls -->
                  </div> <!-- /control-group -->

                  <div class="form-actions">
                      <button type="submit" name="simpan" value="baru"  class="btn btn-success">Save</button>
                      <button class="btn btn-danger" type="reset" name="Reset">Reset</button>
                    </div>

                  </form>
                  </div>

                  </div>

                </div>

              </div>

            </div>

          </div> <!-- /widget-content -->

        </div> <!-- /widget -->

      </div>
      <!-- /span12 -->

    <!-- /row -->
  </div>
  <!-- /container -->
</div>
<!-- /main-inner -->

<!-- tutup -->
<div class="">
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
</div>

<!-- tutp -->


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


<script src="js/excanvas.min.js"></script>
<script src="js/chart.min.js" type="text/javascript"></script>
<script src="js/bootstrap.js"></script>
<script src="js/Script.js"></script>
<script language="javascript" type="text/javascript" src="js/full-calendar/fullcalendar.min.js"></script>

<script src="js/base.js"></script>

</body>
</html>
