<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Indikator - Display</title>
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
		$query = "SELECT * FROM M_Departemen";
		$sql = sqlsrv_query($conn, $query);
		$arrind = array();
		while ($row = sqlsrv_fetch_array($sql)) {
			$arrind [ $row['Kode'] ] = $row['Kode'];
		}
	}	

{
	#ambil data semua
		$query = "SELECT * FROM M_Unit";
		$sql = sqlsrv_query($conn, $query);
		$arrunit = array();
		while ($row = sqlsrv_fetch_array($sql)) {
			$arrunit [ $row['Kode'] ] = $row['Kode'];
		}
	}				
	
{
	#ambil data semua
		$query = "SELECT * FROM M_Group";
		$sql = sqlsrv_query($conn, $query);
		$arrgroup = array();
		while ($row = sqlsrv_fetch_array($sql)) {
			$arrgroup [ $row['Kode'] ] = $row['Kode'];
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
.style1 {	
	font-size: 17px;
	font-weight: bold;
}
</style>

</head>
<body>
<div id="header_mstr"></div>
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span12 mainPage">
					
					<br>
					<span class="style1">Display Indikator </span><br>
					<table>
						<tr>
							<td>Kode Indikator </td>
							<td> : </td>
							<td><input name="kodeindikator" type="text" id="kode" maxlength="6" disabled="disabled" style="text-align:center;font-weight:bold;font-size:16px"></td>
						</tr>
						<tr>
							<td>Aspek yang dinilai</td>
							<td> : </td>
							<td colspan="2" rowspan="2"><textarea name="aspek" rows="5" disabled id="aspek"></textarea></td>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
					  </tr>
						<tr>
						  <td>Standar</td>
						  <td>:</td>
						  <td colspan="2" rowspan="2"><textarea name="standar" rows="5" disabled id="standar"></textarea></td>
					  </tr>
						<tr>
						  <td height="56">&nbsp;</td>
						  <td>&nbsp;</td>
					  </tr>
						<tr>
						  <td>Departemen</td>
						  <td>:</td>
						  <td colspan="2"><span class="inputan">
						    <select id="departemen" name="departemen" disabled="disabled">
                              <option value="">--Pilih Departemen--</option>
                              <?php
			foreach ($arrind as $Kode=>$Kode) {
				echo "<option value='$Kode'>$Kode</option>";
			}
			?>
                            </select>
						  </span></td>
					  </tr>
						<tr>
						  <td>Unit</td>
						  <td>:</td>
						  <td colspan="2"><select id="unit_kerja" name="unit_kerja" disabled="disabled">
                            <option value="">--Pilih Unit Kerja--</option>
                            <?php
			foreach ($arrunit as $Kode=>$Kode) {
				echo "<option value='$Kode'>$Kode</option>";
			}
			?>
                          </select></td>
					  </tr>
						<tr>
						  <td>Group</td>
						  <td>:</td>
						  <td colspan="2"><select id="group_unit" name="group_unit" disabled="disabled">
                            <option value="">--Pilih Group--</option>
                            <?php
			foreach ($arrgroup as $Kode=>$Kode) {
				echo "<option value='$Kode'>$Kode</option>";
			}
			?>
                          </select></td>
					  </tr>
						<tr>
						  <td>Aktif</td>
						  <td>: </td>
						  <td colspan="2"><input type="radio" name="statindikator" id="aktif" checked disabled>
					      Aktif</td>
					  </tr>
						<tr>
						  <td height="50">&nbsp;</td>
						  <td>&nbsp;</td>
						  <td colspan="2"><input type="radio" name="statindikator" id="nonaktif" disabled>
					      Non-Aktif</td>
					  </tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td colspan="2"><button id="myBtn">Search</button>  
					<button>Exit</button></td>
						</tr>
					</table>

					<?php include "M_Indikator_Search.php"; ?>

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
	function saveindikator(){
    var kode;
    var aspek;
	var standar;
    var departemen;
	var unit_kerja;
	var group_unit;
	
    kode 		= document.getElementById('kode').value;
    aspek 		= document.getElementById('aspek').value;
	standar 	= document.getElementById('standar').value;
    departemen	= document.getElementById('departemen').value;
	unit_kerja	= document.getElementById('unit_kerja').value;
	group_unit	= document.getElementById('group_unit').value;

    var cekradiobutton = document.getElementById('aktif');
    if (cekradiobutton.checked){
      statindikator = "X";
    }else{
      statindikator = " ";
    }

    var simpan;
    simpan = "baru";

    if (aspek) {
      window.location.href='M_Indikator_Save.php?kode=' + kode + '&aspek=' + aspek + '&standar=' + standar + '&departemen=' + departemen + '&unit_kerja=' + unit_kerja + '&group_unit=' + group_unit + '&statindikator=' + statindikator + '&simpan=' + simpan;
    } else {
      alert("Kolom 'Aspek' harus diisi..");
    }
  }

  function clearindikator(){
    document.getElementById('kode').value = '';
    document.getElementById('aspek').value = '';
	document.getElementById('standar').value = '';
    document.getElementById('departemen').value = '';
	document.getElementById('unit_kerja').value = '';
	document.getElementById('group_unit').value = '';
    radiobtn = document.getElementById("aktif");
    radiobtn.checked = true;
    radiobtn = document.getElementById("nonaktif");
    radiobtn.checked = false;
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
