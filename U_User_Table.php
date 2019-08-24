<?php
include "koneksi.php";
if (isset($_GET['katakunci']))
{
    $katakunci = $_GET['katakunci'];
    $query = "SELECT * FROM M_User WHERE ID like '%". $katakunci ."%' OR Departemen like '%". $katakunci ."%' OR Unit like '%". $katakunci ."%'";
    $sql = sqlsrv_query($conn,$query);
    if ($sql){
        echo "
        <table id=\"TableDetail\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\">
        <tr>
        <td>ID</td>
		<td>Departemen</td>
        <td>Unit</td>
        <td>Aktif</td>
        </tr>";
        while($rs = sqlsrv_fetch_array($sql)){
            echo "
            <tr id='".$rs['ID']."|".$rs['Departemen']."|".$rs['Unit']."|".$rs['Status']."' >
            <td>".$rs['ID']."</td>
            <td>".$rs['Departemen']."</td>
			<td>".$rs['Unit']."</td>
            <td>".$rs['Status']."</td>
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
        var id 			= $(this).attr('id');
        var res 		= id.split("|");
        var id_user		= res[0];
		var departemen	= res[1];
        var unit_kerja	= res[2];
        var statuser 	= res[3];
		
        $("#id_user").val(id_user);
		$("#departemen").val(departemen);
		$("#unit_kerja").val(unit_kerja);

        if (statuser=="X"){
            radiobtn = document.getElementById("aktif");
            radiobtn.checked = true;
        } else if(statuser==" "){
            radiobtn = document.getElementById("nonaktif");
            radiobtn.checked = true;
        }
        modal.style.display = "none";
    })
</script>