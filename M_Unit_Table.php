<?php
include "koneksi.php";
if (isset($_GET['katakunci']))
{
    $katakunci = $_GET['katakunci'];
    $query = "SELECT * FROM M_Unit WHERE Kode like '%". $katakunci ."%' OR Deskripsi like '%". $katakunci ."%' OR Departemen like '%". $katakunci ."%' OR Status like '%". $katakunci ."%'";
    $sql = sqlsrv_query($conn,$query);
    if ($sql){
        echo "
        <table id=\"TableDetail\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\">
        <tr>
        <td>Kode</td>
        <td>Deskripsi</td>
        <td>Departemen</td>
        <td>Aktif</td>
        </tr>";
        while($rs = sqlsrv_fetch_array($sql)){
            echo "
            <tr id='".$rs['Kode']."|".$rs['Deskripsi']."|".$rs['Departemen']."|".$rs['Status']."' >
            <td>".$rs['Kode']."</td>
            <td>".$rs['Deskripsi']."</td>
            <td>".$rs['Departemen']."</td>
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
        var kd_unit = res[0];
        var desk_unit = res[1];
        var departemen = res[2];
        var statunit = res[3];

        $("#kd_unit").val(kd_unit);
        $("#desk_unit").val(desk_unit);
        $("#departemen").val(departemen);
        if (statunit=="X"){
            radiobtn = document.getElementById("aktif");
            radiobtn.checked = true;
        } else if(statunit==""){
            radiobtn = document.getElementById("nonaktif");
            radiobtn.checked = true;
        }
        modal.style.display = "none";
    })
</script>
