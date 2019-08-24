<?php
include "koneksi.php";
if (isset($_GET['katakunci']))
{
    $katakunci = $_GET['katakunci'];
    $query = "SELECT * FROM M_Sub_Tipe_Insiden WHERE Kode_sub like '%". $katakunci ."%'
                                                OR Kode_tipe like '%". $katakunci ."%'
                                                OR Kode like '%". $katakunci ."%'
                                                OR Sub_tipe like '%". $katakunci ."%'
                                                OR Mark like '%". $katakunci ."%'";
    $sql = sqlsrv_query($conn,$query);
    if ($sql){
        echo "
        <table id=\"TableDetail\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\">
        <tr>
        <td>Kode Sub</td>
        <td>Kode Tipe</td>
        <td>Kode Insiden</td>
        <td>Sub Tipe Insiden</td>
        <td>Status Aktif</td>
        </tr>";
        while($rs = sqlsrv_fetch_array($sql)){
            echo "
            <tr id='".$rs['Kode_sub']."|".$rs['Kode_tipe']."|".$rs['Kode']."|".$rs['Sub_tipe']."|".$rs['Mark']."' >
            <td>".$rs['Kode_sub']."</td>
            <td>".$rs['Kode_tipe']."</td>
            <td>".$rs['Kode']."</td>
            <td>".$rs['Sub_tipe']."</td>
            <td align=\"center\">".$rs['Mark']."</td>
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
        var id               = $(this).attr('id');
        var res              = id.split("|");
        var Kd_sub           = res[0];
        var Kd_tipe          = res[1];
        var Kd_insiden       = res[2];
		var Sub_tipe_insiden = res[3];  
        var Status_sub       = res[4];

        $("#Kd_sub").val(Kd_sub);
        $("#Kd_tipe").val(Kd_tipe);
        $("#Kd_insiden").val(Kd_insiden);
        $("#Sub_tipe_insiden").val(Sub_tipe_insiden);
		
        if (Status_sub=="X"){
            radiobtn = document.getElementById("aktif");
            radiobtn.checked = true;
        } else if(Status_sub==" "){
            radiobtn = document.getElementById("nonaktif");
            radiobtn.checked = true;
        }
        modal.style.display = "none";
    })
</script>