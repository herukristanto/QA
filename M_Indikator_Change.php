<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Indikator - Change</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
	<link href="css/font-awesome.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<link href="css/pages/dashboard.css" rel="stylesheet">
	<script src="js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="libs/jquery.min.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/Script.js"></script>
	<script src="js/base.js"></script>
	<style type="text/css">
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
						<span class="style1">Indikator Change</span><br>
						<table>
							<tr>
							<td>Kode Indikator </td>
							<td> : </td>
							<td><input name="kodeindikator" type="text" id="kode" maxlength="6" disabled="disabled" style="text-align:center;font-weight:bold;font-size:16px"></td>
						</tr>
							<tr>
							<td>Aspek yang dinilai</td>
							<td> : </td>
							<td colspan="2" rowspan="2"><textarea name="aspek" rows="5" id="aspek"></textarea></td>
						</tr>
						 <tr>
				              <td height="42">&nbsp;</td>
				              <td>&nbsp;</td>
				            </tr>
				            <tr>
				              <td>Tolak Ukur </td>
				              <td> : </td>
				              <td colspan="2" rowspan="2"><textarea name="tolakukur" rows="5" id="tolakukur"></textarea></td>
				            </tr>
				            <tr>
				              <td height="42">&nbsp;</td>
				              <td>&nbsp;</td>
				            </tr>
						<tr>
						  <td>Standar</td>
						  <td>:</td>
						  <td colspan="2" rowspan="2"><textarea name="standar" rows="5" id="standar"></textarea></td>
					  </tr>
						<tr>
						  <td height="56">&nbsp;</td>
						  <td>&nbsp;</td>
					  </tr>
					  <tr>
			              <td>Laporan Kejadian</td>
			              <td>:</td>
			              <td colspan="2"><input type="radio" name="statlap" id="Ya_lap" checked>
			              Ya</td>
			            </tr>
			            <tr>
			              <td height="24">&nbsp;</td>
			              <td>&nbsp;</td>
			              <td colspan="2"><input type="radio" name="statlap" id="Tidak_lap">
			              Tidak</td>
			            </tr>
			            <tr>
			              <td>Indikator</td>
			              <td>:</td>
			              <td colspan="2"><input type="radio" name="stat_group" id="IAK" value="IAK" checked>
			              IAK</td>
			            </tr>
			            <tr>
			              <td height="24">&nbsp;</td>
			              <td>&nbsp;</td>
			              <td colspan="2"><input type="radio" name="stat_group" id="IAM" value="IAM">
			              IAM</td>
			            </tr>
			            <tr>
			              <td height="24">&nbsp;</td>
			              <td>&nbsp;</td>
			              <td colspan="2"><input type="radio" name="stat_group" id="ISKP" value="ISKP">
			              ISKP</td>
			            </tr>
			            <tr>
			              <td>Numerator</td>
			              <td> : </td>
			              <td colspan="2"><input type="radio" name="statnum" id="Ya_num" checked>
			              Ya</td>
			            </tr>
			            <tr>
			              <td height="24">&nbsp;</td>
			              <td>&nbsp;</td>
			              <td colspan="2"><input type="radio" name="statnum" id="Tidak_num">
			              Tidak</td>
			            </tr>
			            <tr>
			              <td>Denominator</td>
			              <td>:</td>
			              <td colspan="2"><input type="radio" name="statden" id="Ya_den" checked>
			              Ya</td>
			            </tr>
			            <tr>
			              <td height="24">&nbsp;</td>
			              <td>&nbsp;</td>
			              <td colspan="2"><input type="radio" name="statden" id="Tidak_den">
			              Tidak</td>
			            </tr>
							<tr>
								<td>Departemen</td>
								<td>:</td>
								<td colspan="2">
									<select id="departemen" oninput="change1()">
										<option></option>
										<?php
										include "koneksi.php";

										$que = "SELECT Kode FROM M_Departemen WHERE Status ='X'";
										$sql = sqlsrv_query($conn,$que);

										while($hasil = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC)){
											echo "<option value='".$hasil[Kode]."'>$hasil[Kode]</option>";
										}
										?>
									</select>
								</td>
							</tr>
							<tr>
								<td>Unit</td>
								<td>:</td>
								<td>
									<span id="ini"></span>
								</td>
							</tr>
							<!-- <tr>
								<td>Group</td>
								<td>:</td>
								<td>
									<span id="itu"></span>
								</td>
							</tr> -->
							<tr>
								<td>Aktif</td>
								<td>:</td>
								<td><input type="radio" name="statindikator" id="aktif" checked>&nbsp;&nbsp;Aktif</td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td><input type="radio" name="statindikator" id="nonaktif">&nbsp;&nbsp;Non-Aktif</td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td colspan="2">
									<button id="myBtn">Search</button>  
									<button onClick="saveindikator();">Save</button>  
									<button onClick="clearindikator();">Cancel</button>
								</td>
							</tr>
						</table>
						<input type="hidden" id="unit"></input>
						<input type="hidden" id="group"></input>
						<?php include "M_Indikator_Search.php"; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="extra">
		<div class="extra-inner">
			<div class="container">
				<div class="row">
					<p>
						Rumah Sakit Pantai Indah Kapuk
					</p>
				</div>
			</div>
		</div>
	</div>
	<div class="footer">
		<div class="footer-inner">
			<div class="container">
				<div class="row">
					<div class="span12"> &copy; 2013 <a href="#">Bootstrap Responsive Admin Template</a>. </div>
				</div>
			</div>
		</div>
	</div>
	<script>
		function change1() {
			var depart = document.getElementById('departemen').value;
			$("#ini").empty();
			$("#itu").empty();
			if (depart!='') {
				$("#ini").load('cariunitkerja_indi.php?depart=' + depart);
			}
		}

		function change2() {
			var unit = document.getElementById('unit').value;
			if (unit!='') {
				document.getElementById('unitkerja').value = unit;
				document.getElementById('unit').value="";
				change3();
			}
		}

		function change3() {
			var namaunit = document.getElementById('unitkerja').value;
			namaunit = namaunit.replace(' ', '|');
			$("#itu").empty();
			if (namaunit != '') {
				$("#itu").load('cariunitkerja_indi_2.php?namaunit=' + namaunit);
			}
		}

		function change4() {
			var group = document.getElementById('group').value;
			if (group!=null) {
				document.getElementById('namagroup').value = group;
				document.getElementById('group').value="";
			}
		}



	function saveindikator(){
    	var kode;
    	var aspek;
		var standar;
    	var tolakukur;
    	var departemen;
		var unit;
    	// var numerator;
    	// var denominator;


	    kode		= document.getElementById('kode').value;

	    aspek		= document.getElementById('aspek').value;

			standar		= document.getElementById('standar').value;

	    tolakukur 	= document.getElementById('tolakukur').value;

	    departemen	= document.getElementById('departemen').value;

			unit_kerja	= document.getElementById('unitkerja').value;

	    // numerator 	= document.getElementById('numerator').value;

	    // denominator = document.getElementById('denominator').value;


	    var cekradiobuttonlap = document.getElementById('Ya_lap');
	    if (cekradiobuttonlap.checked){
	      statlap = "X";
	    }else{
	      statlap = "";
	    }

	    var cekradiobuttonnum = document.getElementById('Ya_num');
	    if (cekradiobuttonnum.checked){
	      statnum = "X";
	    }else{
	      statnum = "";
	    }

	    var cekradiobuttonden = document.getElementById('Ya_den');
	    if (cekradiobuttonden.checked){
	      statden = "X";
	    }else{
	      statden = "";
	    }

	    var cekradiobuttontipe = document.getElementById('IAK');
	    var cekradiobuttontipe = document.getElementById('IAM');
	    var cekradiobuttontipe = document.getElementById('ISKP');

	    if(document.getElementById('IAK').checked) {
	      stat_group = "IAK";
	    }else if(document.getElementById('IAM').checked) {
	      stat_group = "IAM";
	    }else if(document.getElementById('ISKP').checked) {
	      stat_group = "ISKP";
	    }

	    var cekradiobutton = document.getElementById('aktif');
	    if (cekradiobutton.checked){
	      statindikator = "X";
	    }else{
	      statindikator = "";
	    }

	    var simpan;
	    simpan = "ubah";



	    if (aspek) {
	      window.location.href='M_Indikator_Save.php?kode=' + kode + '&aspek=' + aspek + '&standar=' + standar + '&tolakukur=' + tolakukur + '&departemen=' + departemen + '&unit=' + unit_kerja + '&statindikator=' + statindikator + '&statlap=' + statlap + '&stat_group=' + stat_group + '&statnum=' + statnum + '&statden=' + statden + '&simpan=' + simpan;
	    } else {
	      alert("Kolom 'Aspek' harus diisi..");
	    }
	  }
	// function saveindikator(){
 //    var kode;
 //    var aspek;
	// var standar;
 //    var departemen;
	// var unit_kerja;
	// var group_unit;

 //    kode		= document.getElementById('kode').value;
	// //alert(id);
 //    aspek		= document.getElementById('aspek').value;
	// //alert(aspek);
	// standar		= document.getElementById('standar').value;
	// //alert(standar);
 //    departemen	= document.getElementById('departemen').value;
	// //alert(departemen);
	// unit_kerja	= document.getElementById('unitkerja').value;
	// //alert(unit_kerja);
	// group_unit	= document.getElementById('namagroup').value;
	// //alert(group_unit);



 //    var cekradiobutton = document.getElementById('aktif');
 //    if (cekradiobutton.checked){
 //      statindikator = "X";
 //    }else{
 //      statindikator = "";
 //    }

 //    var simpan;
 //    simpan = "ubah";

	// //alert(aspek);

 //    if (aspek) {
 //      window.location.href='M_Indikator_Save.php?kode=' + kode + '&aspek=' + aspek + '&standar=' + standar + '&departemen=' + departemen + '&unit_kerja=' + unit_kerja + '&group_unit=' + group_unit + '&statindikator=' + statindikator + '&simpan=' + simpan;
 //    } else {
 //      alert("Kolom 'Aspek' harus diisi..");
 //    }
 //  }

  function clearindikator(){
    document.getElementById('id').value = '';
    document.getElementById('aspek').value = '';
	document.getElementById('standar').value = '';
    document.getElementById('departemen').value = '';
	document.getElementById('unit').value = '';
	document.getElementById('group').value = '';
    radiobtn = document.getElementById("aktif");
    radiobtn.checked = true;
    radiobtn = document.getElementById("nonaktif");
    radiobtn.checked = false;
  }
	</script>
</body>
</html>
