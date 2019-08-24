<?php
include "koneksi.php";
if (isset($_GET['katakunci']))
{
    $katakunci = $_GET['katakunci'];
    $query = "SELECT * FROM M_Group WHERE Kode like '%". $katakunci ."%' OR Deskripsi like '%". $katakunci ."%' OR Departemen like '%". $katakunci ."%' OR Unit_Kerja like '%". $katakunci ."%' OR Status like '%". $katakunci ."%'";
    $sql = sqlsrv_query($conn,$query);
    if ($sql){
        echo "
        <table id=\"TableDetail\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\">
        <tr>
        <td>Kode Group</td>
        <td>Deskripsi</td>
        <td>Departemen</td>
		<td>Unit Kerja</td>
        <td>Aktif</td>
        </tr>";
        while($rs = sqlsrv_fetch_array($sql)){
            echo "
            <tr id= '".$rs['Kode']."|".$rs['Deskripsi']."|".$rs['Departemen']."|".$rs['Unit_Kerja']."|".$rs['Status']."' >
            <td>".$rs['Kode']."</td>
            <td>".$rs['Deskripsi']."</td>
            <td>".$rs['Departemen']."</td>
			<td>".$rs['Unit_Kerja']."</td>
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
        var kd_group	= res[0];
        var desk_group	= res[1];
        var departemen	= res[2];
		var unitkerja	= res[3];
        var statgroup	= res[4];
		
        $("#kd_group").val(kd_group);
        $("#desk_group").val(desk_group);
        $("#departemen").val(departemen);
        // ubah disini
		$("#unit").val(unitkerja);
        // sampai disini
        if (statgroup=="X"){
            radiobtn = document.getElementById("aktif");
            radiobtn.checked = true;
        } else if(statgroup==""){
            radiobtn = document.getElementById("nonaktif");
            radiobtn.checked = true;
        }
        // ubah disini
        change1();
        // change2();
        // sampe disini
        modal.style.display = "none";
        
    })
</script>