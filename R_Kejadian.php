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
<script src="js/jquery-1.7.2.min.js"></script>
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
	
<style>
div.mainPage{
  min-height: 600px;
}

td{
  padding-left: 3px;
}
</style>

<!--<script type="text/javascript" src="libs/jquery.min.js"></script>-->
		
</head>
<body>
<div id="header_rpt"></div>
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span12 mainPage">
         
		  <table width="461" border="0">
		    <tr>
		      <td width="61">Unit Kerja</td>
		      <td width="13">:</td>
		      <td width="373"><label for="unitkerja">
		        <select name="unitkerja" id="unitkerja" class="key" style="width:auto">
                	<option value="">---------------- P I L I H ----------------</option>
		        	<?php
                      include "koneksi.php";

                      $que = "SELECT * FROM M_Unit where Status = 'X'";
                      $sql = sqlsrv_query($conn,$que);

                  		while($hasil = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC)){
                  			echo "<option value='$hasil[Deskripsi]'>$hasil[Deskripsi]</option>";
                  		}
                  	?>
                </select>
		      </label></td>
	        </tr>
		    <tr>
		      <td>Bulan</td>
		      <td>:</td>
		      <td><label for="bulan">
		        <select name="bulan" id="bulan" class="key" style="width:auto">
                	<option selected="selected"></option>
                    <?php
						$bulan=array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
						for($c=0; $c<12; $c++)
						{
							$bln = $c + 1;
							if($bln<=9)
							{
								echo"<option value='0$bln'>$bulan[$c]</option>";		
							}
							else
							{
								echo"<option value='$bln'>$bulan[$c]</option>";
							}
						}	
					?>
		          </select>
		      </label></td>
	        </tr>
		    <tr>
		      <td>Tahun</td>
		      <td>:</td>
		      <td><label for="tahun">
		        <input name="tahun" type="text" class="key" id="tahun" maxlength="4">
		      </label></td>
	        </tr>
	      </table>
          <span id="tab"></span>

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
<!-- <div class="extra">
  <div class="extra-inner">
    <div class="container">
      <div class="row">
        <p>
          Rumah Sakit Pantai Indah Kapuk
        </p>
      </div>
    </div>
  </div>
</div> -->
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

	$('.key').bind("enterKey",function(e){
		var url = 'R_KejadianTable.php?unit=' + $("#unitkerja").val() + "&bulan=" + $("#bulan").val() + "&tahun=" + $("#tahun").val();
		url = url.replace(" ","%20");
	
		$("#tab").empty();
		$("#tab").html("<h2>Please Wait. . . .</h2>");
		$("#tab").load(url);
	});
	
	$('.key').keyup(function(e){
		if(e.keyCode == 13)
		{
		  
		  $(this).trigger("enterKey");
		}
	});
	
	$('#unitkerja').change(function(e){
	  $(this).trigger("enterKey");
	});
	
	$('#bulan').change(function(e){
	  $(this).trigger("enterKey");
	});
	
</script>


<script src="js/bootstrap.js"></script>
<script src="js/Script.js"></script>
<script src="js/base.js"></script>

</body>
</html>
