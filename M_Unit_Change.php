<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Unit - Change</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
<link href="css/font-awesome.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/pages/dashboard.css" rel="stylesheet">
<script src="js/jquery-1.7.2.min.js"></script>

<?php
include "koneksi.php";
{
	#ambil data semua
		$query = "SELECT * FROM M_Departemen WHERE Status = 'X'";
		$sql = sqlsrv_query($conn, $query);
		$arrind = array();
		while ($row = sqlsrv_fetch_array($sql)) {
			$arrind [ $row['Kode'] ] = $row['Kode'];
		}
	}
?>
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
.style1 {	font-size: 17px;
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

				<form class="" action="M_Unit_Save.php" method="GET">
        <div class="span12">
          <div class="widget ">
            <div class="widget-header">
              <i class="icon-edit"></i>
              <h3><span>Change Unit </span</h3>
            </div> <!-- /widget-header -->

            <div class="widget-content">
            <div class="tabbable">
            <br>

            <div class="tab-content">
              <div class="tab-pane active" id="formcontrols">

								<div id="edit-profile" class="form-horizontal">


                  <div class="control-group">
                    <label class="control-label" for="lokasi">Kode Unit</label>
                    <div class="controls">
                      <input type="text" class="span3" name="kd_unit" id="kd_unit" maxlength="6" value="" readonly>
                    </div> <!-- /controls -->
                  </div> <!-- /control-group -->

                  <div class="control-group">
                    <label class="control-label" for="lokasi">Deskripsi</label>
                    <div class="controls">
                      <input type="text" class="span3" name="desk_unit" id="desk_unit" maxlength="50" value="" >
                    </div> <!-- /controls -->
                  </div> <!-- /control-group -->

									<div class="control-group">
										<label class="control-label" for="departemen">Departemen</label>

										<div class="controls">
											<span class="inputan">

												<select id="departemen" name="departemen" class="span3" >
													<option value="">--------------------- P I L I H ---------------------</option>
													<?php
													foreach ($arrind as $Kode=>$Kode) {
														echo "<option value='$Kode'>$Kode</option>";
													}
													?>
												</select>
											</span>
										</div>
									</div>

                  <div class="control-group">
                    <label class="control-label">Status</label>
                      <div class="controls">
                        <label class="radio inline">
                          <input type="radio" name="statunit" id="aktif" checked value="X" > Aktif
                        </label>
                    </div>	<!-- /controls -->
                    <div class="controls">
                      <label class="radio inline">
                        <input type="radio" name="statunit" id="nonaktif" value="" > Non-Aktif
                      </label>
                  </div>	<!-- /controls -->
                  </div> <!-- /control-group -->

                  <div class="form-actions">
										<input type="button" id="myBtn" class="btn btn-success" value="Search">

										<button type="submit" name="simpan" value="ubah" class="btn btn-success">Save</button>
										<button class="btn btn-danger" type="reset">Reset</button>
                    </div>

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

</div>

<?php include "M_Unit_Search.php"; ?>

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


<script type="text/javascript" src="libs/jquery.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function()
			{
				$('#departemen').change(function()
				{
					$.getJSON('M_Unit_Change.php',{action:'getdepartemen', departemen:$(this).val()}, function(json)
					{
						$('#departemen').html('');
						$.each(json, function(index, row)
						{
							$('#departemen').append('<option value="'+row.kode+'">'+row.nama+'</option>');
						});
					});
				});
			});
		</script>

<script src="js/base.js"></script>

</body>
</html>
