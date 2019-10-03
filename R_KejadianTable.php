<?php
	include "koneksi.php";
	
	$unit = "";
	$bulan = "";
	$tahun = "";
	
	if(isset($_GET['unit']))
	{
		$unit = str_replace("%20", " ", $_GET['unit']);
	}
  	
	if(isset($_GET['bulan']))
	{
		$bulan = $_GET['bulan'];
	}
	
	if(isset($_GET['tahun']))
	{
		$tahun = $_GET['tahun'];
	}
	
	$cond = "";
	
	$periode = $tahun.".".$bulan;
	
	if($unit <> '')
  	{
		$cond = "where kode_u = '".$unit."'";
	}
	
	if($periode <> '.')
  	{
		if($cond <> '')
    	{
			if($tahun <> '' && $bulan == '')
			{
				$cond = $cond." and convert(varchar(5),tgl_kejadian,102) = '".$periode."'";	
			}
			else if($tahun == '' && $bulan <> '')
			{
				$periode = str_replace(".", "", $periode);
				$cond = $cond." and convert(varchar(2),tgl_kejadian,101) = '".$periode."'";
			}
			else
			{
				$cond = $cond." and convert(varchar(7),tgl_kejadian,102) = '".$periode."'";
			}
		}
		else
    	{
			if($tahun <> '' && $bulan == '')
			{
				$cond = "where convert(varchar(5),tgl_kejadian,102) = '".$periode."'";
			}
			else if($tahun == '' && $bulan <> '')
			{
				$periode = str_replace(".", "", $periode);
				$cond = "where convert(varchar(2),tgl_kejadian,101) = '".$periode."'";
			}
			else
			{
				$cond = "where convert(varchar(7),tgl_kejadian,102) = '".$periode."'";
			}
		}
	}
	
	$que = "SELECT * FROM T_Kejadian_a ".$cond." order by tgl_kejadian,no_lap asc";
	$sql = sqlsrv_query($conn,$que);
	
	echo "
	<table id='myTable' border='1' style='margin-top:10px;'>
		<tr>
			<td width='150'><div align='center'>No.Laporan Kejadian</div></td>
			<td width='100'><div align='center'>Tanggal Kejadian</div></td>
			<td><div align='center'>Insiden</div></td>
			<td><div align='center'>Tipe Insiden</div></td>
			<td><div align='center'>Unit Kerja</div></td>
			<td><div align='center'>Unit Kerja Terkait</div></td>
			<td width='50'><div align='center'>No.Laporan Unit Kerja Terkait</div></td>
			<td width='50'><div align='center'>Investigasi</div></td>
		</tr>
	";
	while($hasil = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC)){
		
		$que4 = "SELECT * from M_User where User_Id='".$hasil['createdby']."'";
		$sql4 = sqlsrv_query($conn3,$que4, array(), array( "Scrollable" => 'static' ));
		$unit = sqlsrv_fetch_array($sql4, SQLSRV_FETCH_ASSOC);
			
		$que2 = "SELECT * from T_Invest where No_lap='".$hasil['no_lap']."'";
		$sql2 = sqlsrv_query($conn2,$que2, array(), array( "Scrollable" => 'static' ));
		$invno = sqlsrv_fetch_array($sql2, SQLSRV_FETCH_ASSOC);
		$row_count = sqlsrv_num_rows( $sql2 );
		if($row_count == 0)
		{	
			$que3 = "SELECT * from T_RCA where No_lap='".$hasil['no_lap']."'";
			$sql3 = sqlsrv_query($conn1,$que3, array(), array( "Scrollable" => 'static' ));
			$rcano = sqlsrv_fetch_array($sql3, SQLSRV_FETCH_ASSOC);
			$row_count1 = sqlsrv_num_rows( $sql3 );
			if($row_count1 == 0)
			{	
				echo "
				<tr>
					<td align='center' id='".$hasil['no_lap']."' class='outrow'>".$hasil['no_lap']."</td>
					<td align='center'>".$hasil['tgl_kejadian']->format('d/m/Y')."</td>
					<td align='center'>".$hasil['kode_insiden']."</td>
					<td align='center'>".$hasil['tipe_insiden']."</td>
					<td align='center'>".$unit['Unit']."</td>
					<td align='center'>".$hasil['kode_u']."</td>
					<td align='center' id='".$hasil['no_lap_1']."' class='outrow1'>".$hasil['no_lap_1']."</td>
					<td align='center'>Pending</td>
				</tr>";
			}
			else
			{
				echo "
				<tr>
					<td align='center' id='".$hasil['no_lap']."' class='outrow'>".$hasil['no_lap']."</td>
					<td align='center'>".$hasil['tgl_kejadian']->format('d/m/Y')."</td>
					<td align='center'>".$hasil['kode_insiden']."</td>
					<td align='center'>".$hasil['tipe_insiden']."</td>
					<td align='center'>".$unit['Unit']."</td>
					<td align='center'>".$hasil['kode_u']."</td>
					<td align='center' id='".$hasil['no_lap_1']."' class='outrow1'>".$hasil['no_lap_1']."</td>
					<td align='center' class='rca' id='".$rcano['No_RCA']."'>".$rcano['No_RCA']."</td>
				</tr>";		
			}
		}
		else
		{
			echo "
			<tr>
				<td align='center' id='".$hasil['no_lap']."' class='outrow'>".$hasil['no_lap']."</td>
				<td align='center'>".$hasil['tgl_kejadian']->format('d/m/Y')."</td>
				<td align='center'>".$hasil['kode_insiden']."</td>
				<td align='center'>".$hasil['tipe_insiden']."</td>
				<td align='center'>".$unit['Unit']."</td>
				<td align='center'>".$hasil['kode_u']."</td>
				<td align='center' id='".$hasil['no_lap_1']."' class='outrow1'>".$hasil['no_lap_1']."</td>
				<td align='center' class='invest' id='".$invno['No_invest']."'>".$invno['No_invest']."</td>
			</tr>";		
		}	
	}
	echo "</table>";
	
	echo "
		<form method='post' action='R_Pending_Display.php' id='frmSub'>
			<input type='hidden' name='no_lap' id='no_lap' />
		</form>
		
		<script>
			$('.outrow').dblclick(function() {
				$('#no_lap').val($(this).attr('id'));
				$('#frmSub').submit();
			});
			$('.outrow1').dblclick(function() {
				$('#no_lap').val($(this).attr('id'));
				$('#frmSub').submit();
			});
		</script>
		
		
		
		<form method='post' action='' id='frmSub1'>
			<input type='hidden' name='no_rca' id='no_rca' />
		</form>
		<form method='post' action='' id='frmSub2'>
			<input type='hidden' name='no_invest' id='no_invest' />
		</form>
		
		<script>
			$('.rca').dblclick(function() {
				$('#no_rca').val($(this).attr('id'));
				$('#frmSub1').submit();
			});
			$('.invest').dblclick(function() {
				$('#no_invest').val($(this).attr('id'));
				$('#frmSub2').submit();
			});
		</script>
	";
?>