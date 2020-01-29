<!DOCTYPE html>
<html>

<head>
	<title>Report Antrian</title>
	<?php include "koneksi.php"; ?>
</head>

<body>
	<form id="formsaring" name="formsaring" method="post" action="tabelreport1.php">
		<table id="TabelFilter">
			<tr>
				<td colspan="5"><font size="5">Saring Data</font></td>
			</tr>
			<tr>
				<td colspan="5" height="10"></td>
			</tr>
			<tr>
				<td width="100">Poliklinik</td>
				<td colspan="3"> : &nbsp;
					<select name="poli">
						<option></option>
						<?php
						$que = "SELECT * FROM QP7POLI";
						$sql = sqlsrv_query($conn,$que);
						while($hasil = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC)){
							echo "<option value='".$hasil[Id_Poli]."'>$hasil[Name_Poli]</option>";
						}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td colspan="5" height="3"></td>
			</tr>
			<tr>
				<td>Tanggal</td>
				<td> : &nbsp; <input type="date" id="datepicker1"></td>
				<td> &nbsp; - &nbsp; </td>
				<td><input type="date" id="datepicker2"></td>
			</tr>
			<tr>
				<td colspan="5" height="3"></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="4">  &nbsp; &nbsp; <input type='image' src='Images/button_find.PNG'></input></td>
			</tr>
		</table>
	</form>

	<br>

	<div id="tabel1"></div>

	<br>

	<div id="tabel2"></div>

	<br>

	<div id="tabel3"></div>
</body>

</html>