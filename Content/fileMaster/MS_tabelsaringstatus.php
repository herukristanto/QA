<?php
include "koneksi.php";
if (isset($_GET['katakunci']))
{
    $katakunci = $_GET['katakunci'];
    $query = "SELECT * FROM M_Status WHERE Status_Id like '%". $katakunci ."%' OR Name like '%". $katakunci ."%'";
    $sql = sqlsrv_query($conn,$query);
    if ($sql){
        echo "
        <table id=\"TableDetail\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\">
        <tr>
        <td>Kode Status</td>
        <td>Nama Status</td>
        <td>Aktif</td>
        </tr>";
        while($rs = sqlsrv_fetch_array($sql)){
            echo "
            <tr id='".$rs['Status_Id']."|".$rs['Name']."|".$rs['Active']."' >
            <td>".$rs['Status_Id']."</td>
            <td>".$rs['Name']."</td>
            <td>".$rs['Active']."</td>
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
        var statusid = res[0];
        var namestatus = res[1];
        var statstatus = res[2];
        $("#statusid").val(statusid);
        $("#namestatus").val(namestatus);
        if (statstatus=="X"){
            radiobtn = document.getElementById("aktif");
            radiobtn.checked = true;
        } else if(statstatus==" "){
            radiobtn = document.getElementById("nonaktif");
            radiobtn.checked = true;
        }
        modal.style.display = "none";
    })
</script>