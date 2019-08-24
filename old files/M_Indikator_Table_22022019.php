<?php
include "koneksi.php";
if (isset($_GET['katakunci']))
{
    $katakunci = $_GET['katakunci'];
    $query = "SELECT * FROM M_Indikator WHERE Kode like '%". $katakunci ."%' OR Aspek like '%". $katakunci ."%' OR Standar like '%". $katakunci ."%' OR Departemen like '%". $katakunci ."%' OR Unit like '%". $katakunci ."%' OR GrpIndikator like '%". $katakunci . "%' OR Status like '%". $katakunci ."%' ORDER BY Kode ASC";
    $sql = sqlsrv_query($conn,$query);
    if ($sql){
        echo "
        <table id=\"TableDetail\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\">
        <tr>
        <td>Kode</td>
        <td>Aspek</td>
		<td>Standar</td>
        <td>Departemen</td>
		<td>Unit</td>
		<td>Group</td>
        <td>Aktif</td>
        </tr>";
        while($rs = sqlsrv_fetch_array($sql)){
            echo "
            <tr id='".$rs['Kode']."|".$rs['Aspek']."|".$rs['Standar']."|".$rs['Departemen']."|".$rs['Unit']."|".$rs['GrpIndikator']."|".$rs['Status']."' >
            <td>".$rs['Kode']."</td>
            <td>".$rs['Aspek']."</td>
			<td>".$rs['Standar']."</td>
            <td>".$rs['Departemen']."</td>
			<td>".$rs['Unit']."</td>
			<td>".$rs['GrpIndikator']."</td>
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
        var id 				= $(this).attr('id');
        var res 			= id.split("|");
        var kode 			= res[0];
        var aspek 			= res[1];
        var standar 		= res[2];
		var departemen		= res[3];
        var unit_kerja		= res[4];
		var group_unit		= res[5];
		var statindikator	= res[6];
        $("#kode").val(kode);
        $("#aspek").val(aspek);
		$("#standar").val(standar);
        $("#departemen").val(departemen);
		$("#unit").val(unit_kerja);
		$("#group").val(group_unit);
        if (statindikator=="X"){
            radiobtn = document.getElementById("aktif");
            radiobtn.checked = true;
        } else if(statindikator==""){
            radiobtn = document.getElementById("nonaktif");
            radiobtn.checked = true;
        }
		change1();
		
        modal.style.display = "none";
    })
</script>