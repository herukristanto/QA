<?php
include "koneksi.php";

session_set_cookie_params(0);
error_reporting(0);
session_start();

$user = $_SESSION[username];

//echo $user;

//echo "<br>";

#cekuser

$cekuser		= "SELECT Unit FROM M_User WHERE User_ID = '" .$user. "'";
$sql_execute	= sqlsrv_query($conn,$cekuser);
$sql_hasil		= sqlsrv_fetch_array($sql_execute);
$Unit 			= $sql_hasil['Unit'];

$cekuser2		= "SELECT Departemen FROM M_User WHERE User_ID = '" .$user. "'";
$sql_execute	= sqlsrv_query($conn,$cekuser2);
$sql_hasil		= sqlsrv_fetch_array($sql_execute);
$Dept 			= $sql_hasil['Departemen'];

echo "Departemen = "; echo $Dept;
echo "<br>";
echo "Unit Kerja = "; echo $Unit;


/* {
	
if ( $Unit == '*') 
	{
	#ambil data semua
		$query = "SELECT * FROM V_Transaksi WHERE Status = 'X'";
		$sql = sqlsrv_query($conn, $query);

	}	
elseif ( $Unit !== '*')	
	{ 
	#ambil data semua
		$query = "SELECT * FROM V_Transaksi WHERE Status = 'X' AND Unit = '".$Unit."'";
		$sql = sqlsrv_query($conn, $query);

	}
}	 */

if (isset($_GET['katakunci']))
{
    $katakunci = $_GET['katakunci'];
   /* $query = "SELECT * FROM T_Trans WHERE Kode like '%". $katakunci ."%'
										OR Aspek like '%". $katakunci ."%'
										OR Analisa like '%". $katakunci ."%'
										OR TindakLanjut like '%". $katakunci ."%'
										OR UserClient like '%". $katakunci ."%'
										OR Tgl_Kejadian like '%". $katakunci ."%'
										OR Status like '%". $katakunci ."%'
										ORDER BY Kode ASC";*/
										
	$query = "SELECT * FROM V_Transaksi WHERE ( Kode like '%". $katakunci ."%'
										OR Aspek like '%". $katakunci ."%'
										OR Indikator like '%". $katakunci ."%'
										OR Analisa like '%". $katakunci ."%'
										OR TindakLanjut like '%". $katakunci ."%'
										OR UserClient like '%". $katakunci ."%'
										OR Tgl_Kejadian like '%". $katakunci ."%'
										OR Status like '%". $katakunci ."%' )
										AND ( Unit='".$Unit."' )
										ORDER BY Kode ASC";	

										
	$sql = sqlsrv_query($conn,$query);
		
    if ($sql){
        echo "
        <table id=\"TableDetail\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\">
        <tr>
        <td align='center'>Kode Trans</td>
        <td align='center'>Kode Aspek</td>
		<td align='center'>Indikator</td>
		<td align='center'>Analisa</td>
        <td align='center'>Tindak Lanjut</td>
		<td align='center'>User</td>
		<td align='center'>Tanggal Kejadian</td>
        <td align='center'>Selesai</td>
        </tr>";
        while($rs = sqlsrv_fetch_array($sql)){
		
			$TglTjd = date_format($rs['Tgl_Kejadian'], 'd/m/Y');
            
			echo 
			
			" <tr id='".$rs['Kode']."|".$rs['Aspek']."|".$rs['Indikator']."|".$rs['Analisa']."|".$rs['TindakLanjut']."
			|".$rs['UserClient']."|".$TglTjd."|".$rs['Status']."' >
			
            <td align='center'>".$rs['Kode']."</td>
            <td align='center'>".$rs['Aspek']."</td>
			<td>".$rs['Indikator']."</td>
			<td>".$rs['Analisa']."</td>
            <td>".$rs['TindakLanjut']."</td>
			<td>".$rs['UserClient']."</td>
			<td align='center'>".$TglTjd."</td>
            <td align='center'>".$rs['Status']."</td>
            </tr>
            ";
        }
    }
    echo"</table>";
} else {
    $katakunci = "0";
}
?>

<script>
    $('tr').dblclick(function(){
        var id 				= $(this).attr('id');
        var res 			= id.split("|");
// 		var id 				= res[0];
//      var aspek 			= res[1];
//      var analisa 		= res[2];
//		var tindaklanjut	= res[3];
//      var user 			= res[4];
//		var TglTjd			= res[5];
//		var statinput 		= res[6];
		
		var id 				= res[0];
        var aspek 			= res[1];
        var analisa 		= res[3];
		var tindaklanjut	= res[4];
        var user 			= res[5];
		var TglTjd			= res[6];
		var statinput 		= res[7];
		
        $("#id").val(id);
        $("#aspek").val(aspek);
		$("#analisa").val(analisa);
        $("#tindaklanjut").val(tindaklanjut);
		$("#user").val(user);
		$("#TglTjd").val(TglTjd);
		
        if (statinput=="X"){
            radiobtn = document.getElementById("Selesai");
            radiobtn.checked = true;
        } else if(statinput==""){
            radiobtn = document.getElementById("Pending");
            radiobtn.checked = true;
        }
        modal.style.display = "none";
		
		var kdtranss = "./displayupload.php?kdtranss="+id;
		
		var kdtrans = "./displayupload_delete.php?kdtrans="+id;
		
		var kdtranschange = "./uploadpage_change.php?kdtranschange="+id;
		
		$("#kdtranss").attr('src',kdtranss);
		$("#kdtrans").attr('src',kdtrans); 
		$("#kdtranschange").attr('src',kdtranschange);
    })
</script>