<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <center>

    		<h2>MENAMPILKAN DATA DARI DATABASE SESUAI TANGGAL DENGAN PHP<br/><a href="https://www.malasngoding.com">WWW.MALASNGODING.COM</a></h2>


    		<?php
    		include 'koneksi.php';
    		?>

    		<br/><br/><br/>

    		<form method="get">
    			<label>PILIH TANGGAL</label>
    			<input type="date" name="Tgl">
    			<input type="submit" value="FILTER">
    		</form>

    		<br/> <br/>

    		<table border="1">
    			<tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Jam</th>
            <th>Indikator</th>
            <th>Jumlah</th>
            <th>Numerator</th>
            <th>Denominator</th>
            <th>Analisa</th>
            <th>Tindak Lanjut</th>
    			</tr>
    			<?php
    			$no = 1;

    			if(isset($_GET['Tgl'])){
    				$tgl = $_GET['Tgl'];
    				$sql = sqlsrv_query($conn,"SELECT * FROM T_Kejadian WHERE Tgl = '$tgl' ORDER BY Indikator ASC");
    			}else{
    				$sql = sqlsrv_query($conn,"SELECT * FROM T_Kejadian ORDER BY Indikator ASC");
    			}


    			while($data = sqlsrv_fetch_array($sql)){
    			?>
    			<tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $tgl; ?></td>
            <td><?php echo $jam; ?></td>
            <td><?php echo $kodeindi; ?></td>
            <td><?php echo $jmlh; ?></td>
            <td><?php echo $numtor; ?></td>
            <td><?php echo $dentor; ?></td>
            <td><?php echo $analis; ?></td>
            <td><?php echo $tndklanjt; ?></td>
    			</tr>
    			<?php
    			}
    			?>
    		</table>

    	</center>

  </body>
</html>
