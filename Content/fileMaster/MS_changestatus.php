<!DOCTYPE html>
<html>
<head>

</head>
<body>
	<button id="myBtn">Search</button> &nbsp;
	<button onclick="savestatus();">Save</button> &nbsp;
	<button onclick="clearstatus();">Cancel</button>
	<br><br>
	<table>
		<tr>
			<td>Kode Status</td>
			<td> : </td>
			<td><input type="text" id="statusid" name="statusid" maxlength="5" disabled></td>
		</tr>
		<tr>
			<td>Name</td>
			<td> : </td>
			<td><input type="text" id="namestatus" name="namestatus" maxlength="30"></td>
		</tr>
		<tr>
			<td>Aktif</td>
			<td> : </td>
			<td><input type="radio" name="statstatus" id="aktif" checked> Aktif</td>
			<td><input type="radio" name="statstatus" id="nonaktif"> Non-Aktif</td>
		</tr>
	</table>

	<?php include "searchstatus.php"; ?>

	<script>
		function savestatus(){
			var statusid;
			var namestatus;
			var statstatus;
			statusid = document.getElementById('statusid').value;
			namestatus = document.getElementById('namestatus').value;
			var cekradiobutton = document.getElementById('aktif');
			if (cekradiobutton.checked){
				statstatus = "X";
			}else{
				statstatus = " ";
			}
			var simpan;
			simpan = "ubah";

			if (statusid != "" && namestatus != "" && statstatus != "") {
				window.location.href='savestatus.php?statusid=' + statusid + '& namestatus=' + namestatus + '& statstatus=' + statstatus + '& simpan=' + simpan;
			} else {
				alert("Data belum lengkap..");
			}
		}
		function clearstatus(){
			document.getElementById('statusid').value = '';
			document.getElementById('namestatus').value = '';
			radiobtn = document.getElementById("aktif");
			radiobtn.checked = true;
			radiobtn = document.getElementById("nonaktif");
			radiobtn.checked = false;
		}
	</script>
</body>
</html>