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

<script type="text/javascript" src="libs/jquery.min.js"></script>
		
</head>
<body>
<div id="header_rpt"></div>
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span12 mainPage">
         
		<?php
			include "koneksi.php";
			
			$que = "SELECT * FROM T_Kejadian_a order by no_lap";
			$sql = sqlsrv_query($conn,$que);
			
			echo "
			<table id='myTable' border='1' style='margin-top:10px;'>
				<caption><h2><u>Pending Laporan</u></h2><br></caption>
			  <tr>
				<td width='150'><div align='center'>No.Laporan Kejadian</div></td>
				<td width='100'><div align='center'>Tanggal Kejadian</div></td>
				<td><div align='center'>Insiden</div></td>
				<td><div align='center'>Tipe Insiden</div></td>
				<td><div align='center'>Unit Kerja</div></td>
				<td><div align='center'>Unit Kerja Terkait</div></td>
				<td width='50'><div align='center'>No.Laporan Unit Kerja Terkait</div></td>
				<td width='50'><div align='center'>Investigasi</div></td>
			  </tr>
			";
			while($hasil = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC)){
				
				$que2 = "SELECT * from T_Invest where No_lap='".$hasil['no_lap']."'";
				$sql2 = sqlsrv_query($conn2,$que2, array(), array( "Scrollable" => 'static' ));
				$row_count = sqlsrv_num_rows( $sql2 );
				if($row_count == 0)
				{	
					$que3 = "SELECT * from T_RCA where No_lap='".$hasil['no_lap']."'";
					$sql3 = sqlsrv_query($conn1,$que3, array(), array( "Scrollable" => 'static' ));
					$row_count1 = sqlsrv_num_rows( $sql3 );
					if($row_count1 == 0)
					{
						$que4 = "SELECT * from M_User where User_Id='".$hasil['createdby']."'";
						$sql4 = sqlsrv_query($conn3,$que4, array(), array( "Scrollable" => 'static' ));
						$unit = sqlsrv_fetch_array($sql4, SQLSRV_FETCH_ASSOC);
						 	
						echo "
						  <tr>
							<td align='center' id='".$hasil['no_lap']."' class='outrow1'>".$hasil['no_lap']."</td>
							<td align='center'>".$hasil['tgl_kejadian']->format('d/m/Y')."</td>
							<td align='center'>".$hasil['kode_insiden']."</td>
							<td align='center'>".$hasil['tipe_insiden']."</td>
							<td align='center'>".$unit['Unit']."</td>
							<td align='center'>".$hasil['kode_u']."</td>
							<td align='center' id='".$hasil['no_lap_1']."' class='outrow2'>".$hasil['no_lap_1']."</td>
							<td align='center'>Pending</td>
						  </tr>";
					}
				}
			
			}
			echo "</table>";
			
			echo "
				<form method='post' action='R_Pending_Display.php' id='frmSub'>
					<input type='hidden' name='no_lap' id='no_lap' />
				</form>
				
				<script src='js/jquery-1.7.2.min.js'></script>
				<script>
					$('.outrow1').dblclick(function() {
						$('#no_lap').val($(this).attr('id'));
						$('#frmSub').submit();
					});
					$('.outrow2').dblclick(function() {
						$('#no_lap').val($(this).attr('id'));
						$('#frmSub').submit();
					});
				</script>
			";
		?>


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

<script src="js/bootstrap.js"></script>
<script src="js/Script.js"></script>
<script src="js/base.js"></script>

</body>
</html>
