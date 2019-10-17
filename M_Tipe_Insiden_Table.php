<?php
include "koneksi.php";
if (isset($_GET['katakunci']))
{
    $katakunci = $_GET['katakunci'];
    $query = "SELECT * FROM M_Tipe_Insiden WHERE Kode_tipe like '%". $katakunci ."%' OR Kode like '%". $katakunci ."%' OR Tipe_insiden like '%". $katakunci ."%' OR Mark like '%". $katakunci ."%' ORDER BY Kode_tipe ASC";
    $sql = sqlsrv_query($conn,$query);
    if ($sql){
        echo "
        <table id=\"TableDetail\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\">
        <tr>
        <td>Kode Tipe Insiden</td>
        <td>Kode Insiden</td>
        <td>Tipe Insiden</td>
        <td>Status Aktif</td>
        </tr>";
        while($rs = sqlsrv_fetch_array($sql)){
            echo "
            <tr id='".$rs['Kode_tipe']."|".$rs['Kode']."|".$rs['Tipe_insiden']."|".$rs['Mark']."' >
            <td>".$rs['Kode_tipe']."</td>
            <td>".$rs['Kode']."</td>
            <td>".$rs['Tipe_insiden']."</td>
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
        var id              = $(this).attr('id');
        var res             = id.split("|");
        var kd_tipe         = res[0];
        var kd_insiden      = res[1];
        var tipe_insiden    = res[2];
        var status_tipe     = res[3];
		
        $("#kd_tipe").val(kd_tipe);
        $("#kd_insiden").val(kd_insiden);
        $("#tipe_insiden").val(tipe_insiden);
		
        if (status_tipe=="X"){
            radiobtn = document.getElementById("aktif");
            radiobtn.checked = true;
        } else if(status_tipe==" "){
            radiobtn = document.getElementById("nonaktif");
            radiobtn.checked = true;
        }
        modal.style.display = "none";
    })
</script>