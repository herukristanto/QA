<?php
	error_reporting(0);
	ini_set('display_errors',0);
	include "koneksi.php";

	$bulan = $_POST['bulan'];
	$tahun = $_POST['tahun'];
	$dept = $_POST['departemen'];
	$unker = $_POST['unitkerja']; 

	$query  = "select Unit from V_Transaksi where DeskUnit = '".$unker."'";
	$sql    =  sqlsrv_query($conn,$query);
	$getarr =  sqlsrv_fetch_array ($sql);
	$Unit   =  $getarr['Unit'];
	
	/*$query2  	= "select DeskDept from V_Transaksi where Departemen = '".$dept."'";
	$sql2   	=  sqlsrv_query($conn,$query2);
	$getarr2 	=  sqlsrv_fetch_array ($sql2);
	$DeskDept   =  $getarr['DeskDept'];
	
	echo $DeskDept;*/
	
	
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<script type="text/javascript" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
    $('#members').DataTable();
} );
</script>
<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
  <br />
  <table class="table table-bordered" id="data" border="3">
    <thead>
      <tr>
	  	<th width="35">No.</th>
        <th width="245">Aspek yang dinilai</th>
        <th width="275">Standar</th>
        <th width="75">Jumlah</th>
        <th width="330">Analisa</th>
        <th width="330">Tindak Lanjut</th>
		
		
        <th width="120">Action</th>
        <th>id</th>
		
      </tr>
    </thead>
    <tbody>
      <?php
	$query = "SELECT * FROM Trans_Data WHERE Unit = '".$Unit."'";
	$sql = sqlsrv_query($conn,$query);
	  
	  while($row = sqlsrv_fetch_array($sql)){
/*      $members= $conn->query("SELECT * FROM Trans_Data WHERE Unit = '".$Unit."'");
      while($row = $members->fetch_array()) {*/
	  $no++;
       ?>
		
      	<tr>
		<td align="center"><?php echo $no; ?></td>
        <td><?php echo $row['Aspek'];?></td>
        <td><?php echo $row['Standar'];?></td>
      	<td align="center" contenteditable><?php echo $row['Jml'];?></td>
        <td contenteditable='true'><?php echo $row['Analisa'];?></td>
		<td contenteditable='true'><?php echo $row['TindakLanjut'];?></td>
		
      		
      		<td align="center">
			<button type="button" data-toggle="modal" data-target="#delete_data" class="btn btn-danger">
			 <a href="delete_data.php?id=<?php echo $row['id'];?>">Delete</a>
			</button>
			
      		<button type="button" data-toggle="modal" data-target="#edit_data" class="btn btn-warning">
			<a href="edit_data.php?id=<?php echo $row['id'];?>&jml=<?php echo $row['Jml'];?>&analisa=<?php echo $row['Analisa'];?>&tindaklanjut=<?php echo $row['TindakLanjut'];?>">Edit</a>
			</button></td>
			
			
		<td><?php echo $row['id']; ?></td> 	
      	</tr>
		
		
   
<?php }
      ?>
    </tbody> 
  </table>
</div>
	</div>
</div>

<div class='container'>
 
 <table width='100%' border='3'>
  <tr>
   		<th width="35">No.</th>
        <th width="245">Aspek yang dinilai</th>
        <th width="275">Standar</th>
        <th width="75">Jumlah</th>
        <th width="330">Analisa</th>
        <th width="330">Tindak Lanjut</th>
		
		
        <th width="120">Action</th>
        <th>id</th>
  </tr>
  
  <?php 
  // $query = "select * from users order by name";
//   $result = mysqli_query($con,$query);
   $count = 1;
//   while($row = mysqli_fetch_array($result) ){
//    $id = $row['id'];
//    $username = $row['username'];
//    $name = $row['name'];
	
	$query = "SELECT * FROM Trans_Data WHERE Unit = '".$Unit."'";
	$sql = sqlsrv_query($conn,$query);
	  
	while($row = sqlsrv_fetch_array($sql)){
		$no++;
		
		$id = $row['id'];
		$aspek = $row['Aspek'];
		$standar = $row['Standar'];
		$jml = $row['Jml'];
		$standar = $row['Standar'];
		$analisa = $row['Analisa'];
		$tindaklanjut = $row['TindakLanjut'];
	
	
  ?>
  <tr>
   <td><?php echo $count; ?></td>
   <td> 
     <div class='edit' id='aspek_<?php echo $id; ?>'> 
       <?php echo $aspek; ?>
     </div> 
   </td>
   <td> 
     <div class='edit' id='standar_<?php echo $id; ?>'>
       <?php echo $standar; ?> 
     </div> 
   </td>
   <td> 
     <div contentEditable='true' class='edit' id='jml_<?php echo $id; ?>'>
       <?php echo $jml; ?> 
     </div> 
   </td>
   <td> 
     <div contentEditable='true' class='edit' id='analisa_<?php echo $id; ?>'>
       <?php echo $analisa; ?> 
     </div> 
   </td>
   <td> 
     <div contentEditable='true' class='edit' id='tindaklanjut_<?php echo $id; ?>'>
       <?php echo $tindaklanjut; ?> 
     </div> 
   </td>
  </tr>
  <?php
   $count ++;
  }
  ?> 
 </table>
</div>
