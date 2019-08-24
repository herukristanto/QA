<?php
include "koneksi.php";
if (isset($_GET['katakunci']))
{
    $katakunci = $_GET['katakunci'];
    $query = "SELECT * FROM M_Insiden WHERE Kode like '%". $katakunci ."%' OR Insiden like '%". $katakunci ."%' OR Mark like '%". $katakunci ."%'";
    $sql = sqlsrv_query($conn,$query);
    if ($sql){
        echo "
        <table id=\"TableDetail\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\">
        <tr>
        <td>Kode</td>
        <td>Insiden</td>
        <td>Aktif</td>
        </tr>";
        while($rs = sqlsrv_fetch_array($sql)){
            echo "
            <tr id='".$rs['Kode']."|".$rs['Insiden']."|".$rs['Mark']."' >
            <td>".$rs['Kode']."</td>
            <td>".$rs['Insiden']."</td>
            <td>".$rs['Mark']."</td>
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
        var kd_insiden = res[0];
        var desk_insiden = res[1];
        var statinsiden = res[2];
		
        $("#kd_insiden").val(kd_insiden);
        $("#desk_insiden").val(desk_insiden);
		
        if (statinsiden=="X"){
            radiobtn = document.getElementById("aktif");
            radiobtn.checked = true;
        } else if(statinsiden==" "){
            radiobtn = document.getElementById("nonaktif");
            radiobtn.checked = true;
        }
        modal.style.display = "none";
    })
</script>