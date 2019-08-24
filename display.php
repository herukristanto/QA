<html>
<head>
<link rel="stylesheet" href="css/bootstrap.min.css" />
	<title>Download Files</title>
	<style type="text/css">
	#wrapper {
	margin: 0 auto;
	float: none;
	width:70%;
}
.header {
	padding:10px 0;
	border-bottom:1px solid #CCC;
}
.title {
	padding: 0 5px 0 0;
	float:left;
	margin:0;
}
.container form input {
	height: 30px;
}
body
{
    
    font-size:14;
    font-weight:bold;
}
		</style>
</head>
<body  align="center">

<!--<br>
<div class="container home">
<font face="comic sans ms">
<h3><center> List of Files the can be download </center> </h3>
</font>

 <table class="table table-bordered">
  <thead>
   <tr>
    <th><font face="comic sans ms">Subject</font></th>
    <th><font face="comic sans ms">Topic </font></th>
	<th><font face="comic sans ms">Download Files </font></th>
  </tr>
   </thead>
    <tbody>-->
<?php
include "koneksi.php";


$query = "SELECT * FROM F_FILES";
	$sql = sqlsrv_query($conn,$query);
if  ($sql){
echo "

		<table id=\"TableDetail\" border=\"1\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\">
		<tr>
		<td style=\"font-weight:bold\" align=\"center\" width=\"60\">No</td>
		<td style=\"font-weight:bold\" align=\"center\" width=\"350\">ID</td>
		<td style=\"font-weight:bold\" align=\"center\" width=\"1000\">Deskripsi</td>
		<td style=\"font-weight:bold\" align=\"center\" width=\"60\">Nama File</td>
</tr>";
$no=0;
		while($rs = sqlsrv_fetch_array($sql)){
			$no++;
			
			echo "
			<tr>
				<td align=\"center\">$no</td>
				<td align=\"left\">".$rs['id']."</td>
				<td align=\"left\">".$rs['deskripsi']."</td>
				<td align=\"left\">".$rs['filename']."</td>
				</tr>";
				
				}
				echo"</table>";
	}
?>

</div>
</body>
</html>								
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								
                        
						
  

