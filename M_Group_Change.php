<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Group - Change</title>
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
/* <!--
.style1 {
	font-size: 17px;
	font-weight: bold;
}
--> */
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
					<span class="style1">Group Change</span><br>
						<table>
							<tr>
								<td width="94">Kode Group </td>
								<td width="10"> : </td>
							  <td width="302"><input type="text" id="kd_group" name="kodegroup" disabled></td>
							</tr>
							<tr>
								<td>Deskripsi</td>
								<td> : </td>
								<td><input type="text" id="desk_group" name="deskripsi" maxlength="50"></td>
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
								<td colspan="2">
									<span id="ini"></span>
								</td>
							</tr>
							<tr>
								<td>Aktif</td>
								<td>:</td>
								<td colspan="2"><input type="radio" name="statgroup" id="aktif" checked>&nbsp;&nbsp;Aktif</td>
							</tr>
							<tr>
								<td height="52">&nbsp;</td>
								<td>&nbsp;</td>
								<td colspan="2"><input type="radio" name="statgroup" id="nonaktif">&nbsp;&nbsp;Non-Aktif</td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td colspan="2">
									<button id="myBtn">Search</button>  
									<button onClick="savegroup();">Save</button>  
									<button onClick="cleargroup();">Reset</button>
								</td>
							</tr>
						</table>
						<input type="hidden" id="unit"></input>
						<?php include "M_Group_Search.php"; ?>
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
			$("#ini").load('cariunitkerja.php?depart=' + depart);
		}

		function change2() {
			var unit = document.getElementById('unit').value;
			// alert(unit);
			document.getElementById('unitkerja').value = unit;
			document.getElementById('unit').value="";
		}

		function savegroup(){
			var kd_group;
			var desk_group;
			var departemen;
			var unitkerja;
			var statgroup;

			kd_group = document.getElementById('kd_group').value;
			desk_group = document.getElementById('desk_group').value;
			departemen = document.getElementById('departemen').value;
			unitkerja = document.getElementById('unitkerja').value;

			var cekradiobutton = document.getElementById('aktif');
			if (cekradiobutton.checked){
				statgroup = "X";
			}else{
				statgroup = "";
			}
			var simpan;
			simpan = "ubah";

			if (desk_group) {
				window.location.href='M_Group_Save.php?kd_group=' + kd_group + '&desk_group=' + desk_group + '&departemen=' + departemen + '&unitkerja=' + unitkerja +'&statgroup=' + statgroup + '&simpan=' + simpan;
			} else {
				alert("Kolom 'Deskripsi' harus diisi..");
			}
		}

		function cleargroup(){
			document.getElementById('desk_group').value = '';
			document.getElementById('kd_group').value = '';
			document.getElementById('departemen').value = '';
			document.getElementById('unitkerja').value = '';
			radiobtn = document.getElementById("aktif");
			radiobtn.checked = true;
			radiobtn = document.getElementById("nonaktif");
			radiobtn.checked = false;
		}
	</script>



</body>
</html>
