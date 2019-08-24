<?php
include "koneksi.php";
if (isset($_GET['katakunci']))
{
    $katakunci = $_GET['katakunci'];
    $query = "SELECT * FROM T_Invest WHERE No_invest like '%". $katakunci ."%' OR No_lap like '%". $katakunci ."%' OR Penyebab like '%". $katakunci ."%' OR Akar_mslh like '%". $katakunci ."%' OR Tanggal_input like '%". $katakunci ."%' ORDER BY No_invest ASC" ;
    $sql = sqlsrv_query($conn,$query);
    if ($sql){
        echo "
        <table id=\"TableDetail\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\">
        <tr style=\"font-weight:bold\">
        <td align=\"center\">No. Invest</td>
        <td align=\"center\">No. Laporan</td>
        <td align=\"center\">Penyebab Langsung</td>
        <td align=\"center\">Akar Masalah</td>
        </tr>";

        while($rs = sqlsrv_fetch_array($sql)){

            echo "
            <tr id='".$rs['No_invest']."|".$rs['No_lap']."|".$rs['Penyebab']."|".$rs['Akar_mslh']."|".$rs['Pendek']."|".$rs['Pj_1']."|".$rs['Waktu_1']->format('d/m/Y')."|".$rs['Panjang']."|".$rs['Pj_2']."|".$rs['Waktu_2']->format('d/m/Y')."' >

            <td width=\"120px\">".$rs['No_invest']."</td>
            <td width=\"120px\">".$rs['No_lap']."</td>
            <td width=\"400px\">".$rs['Penyebab']."</td>
            <td width=\"400px\">".$rs['Akar_mslh']."</td>
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
        var id                  = $(this).attr('id');
        var res                 = id.split("|");
        var No_invest           = res[0];
        var No_lap              = res[1];
        var Penyebab            = res[2];
        var Akar_mslh           = res[3];
        var Pendek              = res[4];
        var penanggung_jawab_1  = res[5];
        var perkiraan_waktu_1   = res[6];
        var Panjang             = res[7];
        var penanggung_jawab_2  = res[8];
        var perkiraan_waktu_2   = res[9];

        $("#no_invest").val(No_invest);
        $("#no_lap").val(No_lap);
        $("#penyebab_langsung").val(Penyebab);
        $("#akar_masalah").val(Akar_mslh);
        $("#tindakan").val(Pendek);
        $("#penanggung_jawab_1").val(penanggung_jawab_1);
        $("#perkiraan_waktu_1").val(perkiraan_waktu_1);
        $("#rekomendasi").val(Panjang);
        $("#penanggung_jawab_2").val(penanggung_jawab_2);
        $("#perkiraan_waktu_2").val(perkiraan_waktu_2);

        modal.style.display = "none";

       })
</script>
