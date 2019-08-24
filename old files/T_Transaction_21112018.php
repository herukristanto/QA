<?php
include "koneksi.php";
{
	#ambil data semua
		$query = "SELECT * FROM M_Indikator WHERE Status = 'X'";
		$sql = sqlsrv_query($conn, $query);
		$arrind = array();
		while ($row = sqlsrv_fetch_array($sql)) {
			$arrind [ $row['Kode'] ] = $row['Aspek'];
		}
	}	
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"> 
<title>Transaction - Input Data</title>
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
<script language="javascript">
function submit_form(){
document.form1.submit();
document.form2.image();
}
</script>
<script type="text/javascript" src="libs/jquery.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function()
			{
			
				$('#departemen').change(function()
				{	
					$.getJSON('T_Transaction.php',{action:'getUnker', kode_dept:$(this).val()}, function(json)
					{	
						$('#unitkerja').html('');
						$('#unit_kerja').append('<option value="">--Pilih Unit Kerja--</option>');
						$.each(json, function(index, row) 
						{
							$('#unitkerja').append('<option value="'+row.Unit_Kerja+'">'+row.Unit_Kerja+'</option>');
						});
					});
				});
			});
		</script>
		
		<script type="text/javascript" src="libs/jquery.min.js"></script>
				
</head>
<body>
<div id="header_trn"></div>
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span12 mainPage">
         
          <table>
		 <!-- <form name="form" method="get" action="Transaction_Save.php"/>-->
		  <!--<form action="saveinputdata.php" method="post">-->
		  <!--<form action="" target="" method="post">-->
            <tr>
              <td width="92">Aspek</td>
              <td width="14"> : </td>
              <td width="550"><select id="aspek" name="aspek">
                <option value="">------ Pilih Aspek yang dinilai ------</option>
               <?php
			foreach ($arrind as $Kode=>$Aspek) {
				echo "<option value='$Kode'>$Aspek</option>";
			}
			?>
            </select></td>
              <td width="258">&nbsp;</td>
            </tr>
            <tr>
              <td height="25">Analisa</td>
              <td> : </td>
              <td rowspan="2"><textarea name="analisa" rows="5"></textarea></td>
              <td>&nbsp;</td>
              </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td height="29">Tindak Lanjut </td>
              <td> : </td>
              <td rowspan="2"><textarea name="tindaklanjut" rows="5"></textarea></td>
              <td>&nbsp;</td>
              </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td height="24">User</td>
              <td>:</td>
              <td><label>
                <input type="text" name="user">
              </label></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>Status</td>
              <td>:</td>
              <td><input type="radio" name="status" id="selesai" checked>
                Selesai</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td><input type="radio" name="status" id="pending">
                Pending</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td hidden>Attach File </td>
              <td hidden>:</td>
              <td colspan="4">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td colspan="4"><button onClick="saveinput();">Save</button>  
            <button onClick="clearinput();">Reset</button></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="4"></td>
            </tr>
           <!-- <tr>
              <td colspan="4"></td>
            </tr>-->
			<tr>
			  <td colspan="4" hidden>&nbsp;</td>
			</tr>
			<!--</form>-->
          </table>

          <label></label>
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
<script>

function clearinput(){
		document.getElementById('aspek').value = '';
		document.getElementById('analisa').value = '';
		document.getElementById('tindaklanjut').value = '';
		document.getElementById('user').value = '';
		cekradiobutton = document.getElementById("selesai");
		cekradiobutton.checked = true;
		cekradiobutton = document.getElementById("pending");
		cekradiobutton.checked = false;
}

function saveinput(){
    var aspek;
    var analisa;
	var tindaklanjut;
	var user;
    aspek = document.getElementById('aspek').value;
    analisa = document.getElementById('analisa').value;
	tindaklanjut = document.getElementById('tindaklanjut').value;
    user = document.getElementById('user').value;

    var cekradiobutton = document.getElementById('selesai');
    if (cekradiobutton.checked){
      status = "X";
    }else{
      status = " ";
    }
	
	var simpan;
    simpan = "baru";

    if (aspek) {
      window.location.href='T_Transaction_Save.php?aspek=' + aspek + '&analisa=' + analisa + '&tindaklanjut=' + tindaklanjut + '&user' + user + '&status=' + status + '&simpan=' + simpan;
    } else {
      alert("Kolom 'aspek' harus dipilih..");
    }
  }
	
		
	
		
	
</script>



<script>
  function button(x)
  {
    window.location.href = x;
  }
</script>

<script src="js/excanvas.minjs"></script>
<script src="js/chart.min.js" type="text/javascript"></script>
<script src="js/bootstrap.js"></script>
<script src="js/Script.js"></script>
<script language="javascript" type="text/javascript" src="js/full-calendar/fullcalendar.min.js"></script>

<script src="js/base.js"></script>

</body>
</html>
