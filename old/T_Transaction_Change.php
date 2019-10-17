<?php
include "koneksi.php";
session_set_cookie_params(0);
error_reporting(0);
session_start();

$user = $_SESSION[username];

//echo $user;



//echo "<br>";
//echo $Unit;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Transaction - Change</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
<link href="css/font-awesome.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/pages/dashboard.css" rel="stylesheet">


<?php

include "koneksi.php";

#cekuser

$cekuser		= "SELECT Unit FROM M_User WHERE User_ID = '" .$user. "'";
$sql_execute	= sqlsrv_query($conn,$cekuser);
$sql_hasil		= sqlsrv_fetch_array($sql_execute);
$Unit 			= $sql_hasil['Unit']; {

if ( $Unit == '*') 
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
elseif ( $Unit !== '*')	
	{ 
	#ambil data semua
		$query = "SELECT * FROM M_Indikator WHERE Status = 'X' AND Unit = '".$Unit."'";
		$sql = sqlsrv_query($conn, $query);
		$arrind = array();
		$arrstd = array();
		while ($row = sqlsrv_fetch_array($sql)) {
			$arrind [ $row['Kode'] ] = $row['Aspek'];
		}
	}
}

/* include "koneksi.php";
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
}	 */
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

<!--<script language="javascript">
function submit_form(){
document.form1.submit();
document.form2.image();
}-->
</script>
<script type="text/javascript" src="libs/jquery.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function()
			{
			
				$('#indikator').change(function()
				{	
					$.getJSON('T_Transaction_Change.php',{action:'getStandar', aspek:$(this).val()}, function(json)
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
		
		<script type="text/javascript" src="libs/jquery.min.js"></script>
				
</head>
<body>
<div id="header_trn"></div>
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span12 mainPage">
          
          <p><span class="style1">Change Transaction</span></p>
		  
           <table width="990">
            
			<tr>
              <td>Kode Transaksi </td>
              <td>:</td>
              <td><input name="id" type="text" id="id" size="8" maxlength="6" disabled="disabled"
			  style="text-align:center;font-weight:bold;font-size:16px" /></td>
             <td colspan="2" rowspan="9"><span class="style1">Edit File Upload : </span>
              <iframe src="./displayupload_delete.php" height="180" width="435" id="kdtrans"></iframe></br>
			  <iframe src="./uploadpage_change.php" height="200" width="435" id="kdtranschange"></iframe></td>
             <div id="iframeHolder"></div>
            </tr>
            
			<tr>
              <td>Tanggal Kejadian</td>
              <td>:</td>
              <td><input name="TglTjd" type="text" id="TglTjd" value="<?php
          		if(isset($app['App_Date']))
          			{echo $app['App_Date']->format('d/m/Y');}
          		else
          			{echo date('d/m/Y');} ?>" maxlength="10" disabled="disabled" style="text-align:center;font-weight:bold;font-size:15px"/></td>
            </tr>
			
            <tr>
              <td width="199">Aspek</td>
              <td width="20">:</td>
              <td width="253"><span class="inputan">
                <select name="aspek" id="aspek" style="width:auto">
                  <option value="" selected>---------------- P I L I H ----------------</option>
                  <?php
			foreach ($arrind as $Kode=>$Aspek) {
				echo "<option value='$Kode'>$Aspek</option>";
			}
			?>
                </select>
              </span></td>
            </tr>
            <tr>
              <td height="24">Analisa</td>
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
              <td><input type="radio" name="statinput" id="Selesai" checked="checked">
              Selesai</td>
            </tr>
            <tr>
              <td height="39">&nbsp;</td>
              <td>&nbsp;</td>
              <td><input type="radio" name="statinput" id="Pending" >
              Pending</td>
              <td width="498">&nbsp;</td>
            </tr>
            <tr>
              <td height="43">&nbsp;</td>
              <td>&nbsp;</td>
              <td colspan="2"><button id="myBtn">Search</button>  
                			<button onClick="saveinput();">Save</button>  
							<button onClick="clearinput();">Cancel</button>  </td>
            </tr>
          </table>
              <?php include "T_Transaction_Search.php"; ?>
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
	var TglTjd;
	
	id 				= document.getElementById('id').value;
    aspek 			= document.getElementById('aspek').value;
    analisa 		= document.getElementById('analisa').value;
    tindaklanjut 	= document.getElementById('tindaklanjut').value;
	user			= document.getElementById('user').value;
	TglTjd			= document.getElementById('TglTjd').value;

    var cekradiobutton = document.getElementById('Selesai');
    if (cekradiobutton.checked){
      statinput = "X";
    }else{
      statinput = "";
    }

    var simpan;
    simpan = "ubah";
	
    if (aspek) {
      window.location.href='T_Transaction_Save.php?id=' + id + '&aspek=' + aspek + '&analisa=' + analisa + '&tindaklanjut=' + tindaklanjut + '&user=' + user + '&statinput=' + statinput + '&TglTjd=' + TglTjd + '&simpan=' + simpan;
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


<script src="js/excanvas.min.js"></script>
<script src="js/chart.min.js" type="text/javascript"></script>
<script src="js/bootstrap.js"></script>
<script src="js/Script.js"></script>
<script language="javascript" type="text/javascript" src="js/full-calendar/fullcalendar.min.js"></script>
<script src="js/jquery-1.7.2.min.js"></script>
<script src="js/base.js"></script>


</body>
</html>
