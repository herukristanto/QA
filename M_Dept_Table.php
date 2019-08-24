<?php
include "koneksi.php";
if (isset($_GET['katakunci']))
{
    $katakunci = $_GET['katakunci'];
    $query = "SELECT * FROM M_Departemen WHERE Kode like '%". $katakunci ."%' OR Deskripsi like '%". $katakunci ."%' OR Status like '%". $katakunci ."%'";
    $sql = sqlsrv_query($conn,$query);
    if ($sql){
        echo "
        <table id=\"TableDetail\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\">
        <tr>
        <td>Kode</td>
        <td>Deskripsi</td>
        <td>Aktif</td>
        </tr>";
        while($rs = sqlsrv_fetch_array($sql)){
            echo "
            <tr id='".$rs['Kode']."|".$rs['Deskripsi']."|".$rs['Status']."' >
            <td>".$rs['Kode']."</td>
            <td>".$rs['Deskripsi']."</td>
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
        var id = $(this).attr('id');
        var res = id.split("|");
        var kd_dept = res[0];
        var desk_dept = res[1];
        var statdept = res[2];
		
        $("#kd_dept").val(kd_dept);
        $("#desk_dept").val(desk_dept);
		
        if (statdept=="X"){
            radiobtn = document.getElementById("aktif");
            radiobtn.checked = true;
        } else if(statdept==" "){
            radiobtn = document.getElementById("nonaktif");
            radiobtn.checked = true;
        }
        modal.style.display = "none";
    })
</script>