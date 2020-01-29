<!DOCTYPE html>
<html>
<head>
	<script src="script/jquery-1.12.4.js"></script>
	<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
	<meta content="utf-8" http-equiv="encoding">
</head>
<body onload='buatTabel(),buatTabel2()'>
	<?php
	include "koneksi.php";
	$query = "SELECT id, tgl_antrian, kode, hitung, status FROM V_Report_Antrian WHERE status=6 and hitung is not null";
	$params = array();
	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$sql = sqlsrv_query( $conn, $query , $params, $options );
	$row_count = sqlsrv_num_rows( $sql );
	if ($sql) {
		echo "
		<table id=\"tabelbase1\" border=\"1\" hidden>
		<tr>
		<td>Id</td>
		<td>Tanggal</td>
		<td>Kode</td>
		<td>Hitung</td>
		<td>Id</td>
		</tr>";
		while($rs = sqlsrv_fetch_array($sql)) {
			$tgl_antrian = $rs['tgl_antrian']->format('d-m-Y');
			echo "
			<tr>
			<td>".$rs['id']."</td>
			<td>".$tgl_antrian."</td>
			<td>".$rs['kode']."</td>
			<td>".$rs['hitung']."</td>
			<td>".$rs['status']."</td>
			</tr>
			";
		}
		echo"</table>";
	}

	$query = "SELECT id, tgl_antrian, kode, hitung, hitung2, status FROM V_Report_Antrian2 WHERE status=6 and hitung is not null";
	$params = array();
	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$sql = sqlsrv_query( $conn, $query , $params, $options );
	$row_count = sqlsrv_num_rows( $sql );
	if ($sql) {
		echo "
		<table id=\"tabelbase2\" border=\"1\">
		<tr>
		<td>Id</td>
		<td>Tanggal</td>
		<td>Kode</td>
		<td>Hitung</td>
		<td>Hitung2</td>
		<td>Id</td>
		</tr>";
		while($rs = sqlsrv_fetch_array($sql)) {
			$tgl_antrian = $rs['tgl_antrian']->format('d-m-Y');
			echo "
			<tr>
			<td>".$rs['id']."</td>
			<td>".$tgl_antrian."</td>
			<td>".$rs['kode']."</td>
			<td>".$rs['hitung']."</td>
			<td>".$rs['hitung2']."</td>
			<td>".$rs['status']."</td>
			</tr>
			";
		}
		echo"</table><br>";
	}
	?>

	<table id='tabel1' border=1 hidden>
		<tr>
			<td width=40 rowspan=2 align=center>No</td>
			<td width=150 rowspan=2 align=center>Tanggal</td>
			<td width=100 rowspan=2 align=center>Ruang</td>
			<td width=420 colspan=3 align=center>Lama Pasien di Poliklinik (pasien)</td>
			<td width=140 rowspan=2 align=center>Total Pasien</td>
		</tr>
		<tr>
			<td align=center>0-30 menit</td>
			<td align=center>31-60 menit</td>
			<td align=center>> 60 menit</td>
		</tr>
	</table>
	
	<br>

	<table id='tabel2' border=1>
		<tr>
			<td width=40 rowspan=2 align=center>No</td>
			<td width=150 rowspan=2 align=center>Tanggal</td>
			<td width=140 rowspan=2 align=center>Total Pasien</td>
			<td width=100 rowspan=2 align=center>Ruang</td>
			<td width=420 colspan=3 align=center>Lama Tunggu Masuk Ruang Anamnesa (pasien)</td>
			<td width=280 colspan=2 align=center>Lama di Ruang Anamnesa (pasien)</td>
			
		</tr>
		<tr>
			<td align=center>0-5 menit</td>
			<td align=center>6-15 menit</td>
			<td align=center>> 15 menit</td>
			<td align=center>0-5 menit</td>
			<td align=center>> 5 menit</td>
		</tr>
	</table>

	<br>

	<button onclick='buatbaris2()'>Buat Baris</button>

	<script>

		$("br[type='_moz']").remove();
		
		function buatTabel() {
			var tabelbase1 = document.getElementById('tabelbase1');
			var tabel1 = document.getElementById('tabel1');
			var rowCountBase1 = tabelbase1.rows.length;

			if (rowCountBase1 > 1) {

				for (i = 1; i < rowCountBase1; i++) {

					var isitgl = tabelbase1.rows[i].cells[1].innerHTML;
					var isirg = tabelbase1.rows[i].cells[2].innerHTML;

					var isimnt = tabelbase1.rows[i].cells[3].innerHTML;

					var r = tabel1.rows.length - 1;

					var hitungtotal;

					if (tabelbase1.rows[i].cells[1].innerHTML != tabel1.rows[r].cells[1].innerHTML) {
						buatbaris();
						var r = tabel1.rows.length - 1;
						tabel1.rows[r].cells[1].innerHTML = isitgl;
						tabel1.rows[r].cells[2].innerHTML = isirg;

						hitungtotal = 1;
						tabel1.rows[r].cells[6].innerHTML = hitungtotal;

						if (isimnt < 31) {
							tabel1.rows[r].cells[3].innerHTML = 1;
							tabel1.rows[r].cells[4].innerHTML = 0;
							tabel1.rows[r].cells[5].innerHTML = 0;
						} else if (isimnt > 30 && isimnt < 61) {
							tabel1.rows[r].cells[3].innerHTML = 0;
							tabel1.rows[r].cells[4].innerHTML = 1;
							tabel1.rows[r].cells[5].innerHTML = 0;
						} else if (isimnt > 60) {
							tabel1.rows[r].cells[3].innerHTML = 0;
							tabel1.rows[r].cells[4].innerHTML = 0;
							tabel1.rows[r].cells[5].innerHTML = 1;
						} else {
							//do nothing
						}
					} else {
						if (tabelbase1.rows[i].cells[2].innerHTML != tabel1.rows[r].cells[2].innerHTML) {
							buatbaris();
							var r = tabel1.rows.length - 1;
							tabel1.rows[r].cells[1].innerHTML = isitgl;
							tabel1.rows[r].cells[2].innerHTML = isirg;

							hitungtotal = 1;
							tabel1.rows[r].cells[6].innerHTML = hitungtotal;

							if (isimnt < 31) {
								tabel1.rows[r].cells[3].innerHTML = 1;
								tabel1.rows[r].cells[4].innerHTML = 0;
								tabel1.rows[r].cells[5].innerHTML = 0;
							} else if (isimnt > 30 && isimnt < 61) {
								tabel1.rows[r].cells[3].innerHTML = 0;
								tabel1.rows[r].cells[4].innerHTML = 1;
								tabel1.rows[r].cells[5].innerHTML = 0;
							} else if (isimnt > 60) {
								tabel1.rows[r].cells[3].innerHTML = 0;
								tabel1.rows[r].cells[4].innerHTML = 0;
								tabel1.rows[r].cells[5].innerHTML = 1;
							} else {
								//do nothing
							}
						} else {
							hitungtotal = hitungtotal + 1;
							tabel1.rows[r].cells[6].innerHTML = hitungtotal;

							if (isimnt < 31) {
								tabel1.rows[r].cells[3].innerHTML = Number(tabel1.rows[r].cells[3].innerHTML) + 1;
							} else if (isimnt > 30 && isimnt < 61) {
								tabel1.rows[r].cells[4].innerHTML = Number(tabel1.rows[r].cells[4].innerHTML) + 1;
							} else if (isimnt > 60) {
								tabel1.rows[r].cells[5].innerHTML = Number(tabel1.rows[r].cells[5].innerHTML) + 1;
							} else {
								//do nothing
							}
						}
					}
				}

			} else {
				var row = tabel1.insertRow();
				var cell0 = row.insertCell(0);
				cell0.innerHTML = 'Tidak ada data';
				cell0.setAttribute('colspan','7');
				cell0.setAttribute('align','center');
			}			
		}

		function buatTabel2() {
			var tabelbase2 = document.getElementById('tabelbase2');
			var tabel2 = document.getElementById('tabel2');
			var rowCountBase2 = 1;

			if (rowCountBase2 > 1) {
				
			} else {
				var row = tabel2.insertRow();
				var cell0 = row.insertCell(0);
				cell0.innerHTML = 'Tidak ada data';
				cell0.setAttribute('colspan','9');
				cell0.setAttribute('align','center');
			}
		}

		function buatbaris() {
			var tabel1 = document.getElementById('tabel1');
			var rowCountTabel1 = tabel1.rows.length - 1;
			var row = tabel1.insertRow();

			var cell0 = row.insertCell(0);
			cell0.innerHTML = rowCountTabel1;
			cell0.setAttribute('align','center');

			var cell1 = row.insertCell(1);
			cell1.setAttribute('align','center');

			var cell2 = row.insertCell(2);
			cell2.setAttribute('align','center');

			var cell3 = row.insertCell(3);
			cell3.setAttribute('align','center');

			var cell4 = row.insertCell(4);
			cell4.setAttribute('align','center');

			var cell5 = row.insertCell(5);
			cell5.setAttribute('align','center');

			var cell6 = row.insertCell(6);
			cell6.setAttribute('align','center');
		}

		function buatbaris2() {
			var tabel2 = document.getElementById('tabel2');
			var rowCountTabel2 = tabel2.rows.length - 1;
			var row = tabel2.insertRow();

			var cell0 = row.insertCell(0);
			cell0.innerHTML = rowCountTabel2;
			cell0.setAttribute('align','center');

			var cell1 = row.insertCell(1);
			cell1.setAttribute('align','center');

			var cell2 = row.insertCell(2);
			cell2.setAttribute('align','center');

			var cell3 = row.insertCell(3);
			cell3.setAttribute('align','center');

			var cell4 = row.insertCell(4);
			cell4.setAttribute('align','center');

			var cell5 = row.insertCell(5);
			cell5.setAttribute('align','center');

			var cell6 = row.insertCell(6);
			cell6.setAttribute('align','center');

			var cell7 = row.insertCell(7);
			cell7.setAttribute('align','center');

			var cell8 = row.insertCell(8);
			cell8.setAttribute('align','center');
		}
	</script>
</body>
</html>