<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Transaction - Change</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<link href="../../../QA/css/bootstrap.min.css" rel="stylesheet">
<link href="../../../QA/css/bootstrap-responsive.min.css" rel="stylesheet">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
<link href="../../../QA/css/font-awesome.css" rel="stylesheet">
<link href="../../../QA/css/style.css" rel="stylesheet">
<link href="../../../QA/css/pages/dashboard.css" rel="stylesheet">


<?php
include "koneksi.php";
{
	#ambil data semua
		$query = "SELECT * FROM M_Indikator WHERE Status = 'X'";
		$sql = sqlsrv_query($conn, $query);
		$arrind = array();
		$arrstd = array();
		while ($row = sqlsrv_fetch_array($sql)) {
			$arrind [ $row['Kode'] ] = $row['Aspek'];
		}
	}	
	
#action get standar
if(isset($_GET['action']) && $_GET['action'] == "getStandar") {
	$aspek = $_GET['aspek'];
	
#ambil data standar
	$query = "Select Standar from M_Indikator where aspek= '$aspek'";
	
	echo $query;
	$sql = sqlsrv_query($conn, $query);
	$arrstandar = array();
	while ($row = sqlsrv_fetch_array($sql)) {
		array_push($arrstandar, $row);
	}
	echo json_encode($arrstandar);
	exit;
}	
?>

<?php
//Create Autonumber
$sql = "SELECT MAX(Kode) AS id FROM T_Trans";

$sql_execute = sqlsrv_query($conn,$sql);
$sql_hasil = sqlsrv_fetch_array($sql_execute);
$cek = $sql_hasil['id'];

$kode = substr($cek,1,6);

$tambah = $kode + 1;
	
	if($tambah<10){
		$id = "T00000".$tambah;
		}else{
		$id = "T0000".$tambah;
		}
//Create Autonumber		
//echo $sql_hasil;
//echo "<br>";
//echo $cek;
//echo "<br>";
//echo $kode;
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

<script language="javascript">
function submit_form(){
document.form1.submit();
document.form2.image();
}
</script>
<script type="text/javascript" src="../../../QA/libs/jquery.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function()
			{
			
				$('#indikator').change(function()
				{	
					$.getJSON('T_Transaction.php',{action:'getStandar', aspek:$(this).val()}, function(json)
					{	
						$('#indikator').html('');
						$.each(json, function(index, row) 
						{
							$('#indikator').append('<option value="'+row.aspek+'">'+row.standar+'</option>');
							
						});
					});
				});
			});
		</script>
		
		<script type="text/javascript" src="../../../QA/libs/jquery.min.js"></script>
				
</head>
<body>
<div id="header_trn"></div>
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span12 mainPage">
          
          <p><span class="style1">Change Transaction</span></p>
		  
          <table width="959">
            <tr>
              <td>Kode Transaksi </td>
              <td>:</td>
              <td><input name="id" type="text" id="id" size="8" maxlength="6" disabled="disabled"
			  style="text-align:center;font-weight:bold;font-size:16px" /></td>
             <td colspan="2" rowspan="8"><span class="style1">Edit File Upload : </span>
              <iframe src="./displayupload_delete.php" height="155" width="575" id="kdtrans"></iframe></br>
			  <iframe src="./uploadpage_change.php" height="155" width="575" id="kdtranschange"></iframe></td>
             <div id="iframeHolder"></div>
            </tr>
            <tr>
              <td width="97">Aspek</td>
              <td width="17">:</td>
              <td width="248"><span class="inputan">
                <select id="aspek" name="aspek">
                  <option value="" selected>-------------- Pilih Aspek --------------</option>
                  <?php
			foreach ($arrind as $Kode=>$Aspek) {
				echo "<option value='$Kode'>$Aspek</option>";
			}
			?>
                </select>
              </span></td>
            </tr>
            <tr>
              <td height="35">Analisa</td>
              <td>:</td>
              <td rowspan="2"><textarea name="analisa" rows="4" id="analisa" ></textarea></td>
            </tr>
            <tr>
              <td height="24">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td height="30">Tindak Lanjut</td>
              <td>:</td>
              <td rowspan="2"><textarea name="tindaklanjut" rows="4" id="tindaklanjut" ></textarea></td>
            </tr>
            <tr>
              <td height="24">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>User</td>
              <td>:</td>
              <td><input type="text" id="user" name="user" maxlength="50" > </td>
            </tr>
            <tr>
              <td>Status</td>
              <td>:</td>
              <td><input type="radio" name="statinput" id="Selesai" >
              Selesai</td>
            </tr>
            <tr>
              <td height="39">&nbsp;</td>
              <td>&nbsp;</td>
              <td><input type="radio" name="statinput" id="Pending" >
              Pending</td>
              <td width="577">&nbsp;</td>
            </tr>
            <tr>
              <td height="43">&nbsp;</td>
              <td>&nbsp;</td>
              <td colspan="2"><button id="myBtn">Search</button>  
							<button onClick="saveinput();">Save</button>  
							<button onClick="clearinput();">Cancel</button>  </td>
            </tr>
          </table>
          </form>
<p> 
            <?php include "T_Transaction_Search.php"; ?>
          </p>
      		
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
  function saveinput(){
  	var id;
    var aspek;
    var analisa;
    var tindaklanjut;
	var user;
	id 				= document.getElementById('id').value;
    aspek 			= document.getElementById('aspek').value;
    analisa 		= document.getElementById('analisa').value;
    tindaklanjut 	= document.getElementById('tindaklanjut').value;
	user			= document.getElementById('user').value;

    var cekradiobutton = document.getElementById('aktif');
    if (cekradiobutton.checked){
      statinput = "X";
    }else{
      statinput = " ";
    }

    var simpan;
    simpan = "ubah";
	
    if (aspek) {
      window.location.href='T_Transaction_Save.php?id=' + id + '&aspek=' + aspek + '&analisa=' + analisa + '&tindaklanjut=' + tindaklanjut + '&user=' + user + '&statinput=' + statinput + '&simpan=' + simpan;
    } else {
      alert("Kolom 'analisa' harus diisi..");
    }
  }

  function clearinput(){
  	document.getElementById('id').value = '';
    document.getElementById('aspek').value = '';
    document.getElementById('analisa').value = '';
    document.getElementById('tindaklanjut').value = '';
	document.getElementById('user').value = '';
    cekradiobutton = document.getElementById("Selesai");
    cekradiobutton.checked = false;
    cekradiobutton = document.getElementById("Pending");
    cekradiobutton.checked = false;
  }
</script>

<!--<script type="text/javascript" src="libs/jquery.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function()
			{
				$('#departemen').change(function()
				{
					$.getJSON('M_Unit_Create.php',{action:'getdepartemen', departemen:$(this).val()}, function(json)
					{
						$('#departemen').html('');
						$.each(json, function(index, row) 
						{
							$('#departemen').append('<option value="'+row.kode+'">'+row.nama+'</option>');
						});
					});
				});
			});
		</script>-->

<script src="../../../QA/js/excanvas.min.js"></script>
<script src="../../../QA/js/chart.min.js" type="text/javascript"></script>
<script src="../../../QA/js/bootstrap.js"></script>
<script src="../../../QA/js/Script.js"></script>
<script language="javascript" type="text/javascript" src="../../../QA/js/full-calendar/fullcalendar.min.js"></script>
<script src="../../../QA/js/jquery-1.7.2.min.js"></script>
<script src="../../../QA/js/base.js"></script>


</body>
</html>
