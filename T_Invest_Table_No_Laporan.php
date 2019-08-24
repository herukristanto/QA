<?php
include "koneksi.php";
if (isset($_GET['katakunci']))
{
    $katakunci = $_GET['katakunci'];
    $query = "SELECT * FROM T_Kejadian_a WHERE no_lap like '%". $katakunci ."%' OR kode_u like '%". $katakunci ."%' OR tgl_kejadian like '%". $katakunci ."%' OR hasil_skor like '%". $katakunci ."%' ORDER BY no_lap ASC" ;
    $sql = sqlsrv_query($conn,$query);
    if ($sql){
        echo "
        <table id=\"TableDetail\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\">
        <tr style=\"font-weight:bold\">
        <td>No. Laporan</td>
        <td>Kode Unit</td>
        <td>Tanggal Kejadian</td>
        <td>Matriks Grading</td>
        </tr>";

        while($rs = sqlsrv_fetch_array($sql)){

            $TglTjd = date_format($rs['tgl_kejadian'], 'd/m/Y');

            echo "
            <tr id='".$rs['no_lap']."|".$rs['kode_u']."|".$TglTjd."|".$rs['hasil_skor']."' >
            <td width=\"120px\">".$rs['no_lap']."</td>
            <td width=\"200px\">".$rs['kode_u']."</td>
            <td align='center'>".$TglTjd."</td>
            <td align=\"center\" width=\"120px\">".$rs['hasil_skor']."</td>
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
        var no_lap              = res[0];
        var kode_u              = res[1];
        var TglTjd              = res[2];
        var hasil_skor          = res[3];

        $("#no_lap").val(no_lap);
        $("#kode_u").val(kode_u);
        $("#TglTjd").val(TglTjd);
        $("#hasil_skor").val(hasil_skor);

        //Matriks grading skor
        if(hasil_skor == "Tinggi"){
            $("#penyebab_langsung").attr('disabled', 'disabled');
            $("#akar_masalah").attr('disabled', 'disabled');
            $("#tindakan").attr('disabled', 'disabled');
            $("#penanggung_jawab_1").attr('disabled', 'disabled');
            $("#perkiraan_waktu_1").attr('disabled', 'disabled');
            $("#rekomendasi").attr('disabled', 'disabled');
            $("#penanggung_jawab_2").attr('disabled', 'disabled');
            $("#perkiraan_waktu_2").attr('disabled', 'disabled');

            $("#kronologis").removeAttr('disabled', 'disabled');
            $("#TglObs").removeAttr('disabled', 'disabled');
            $("#jam_obs").removeAttr('disabled', 'disabled');
            $("#hasil_obs").removeAttr('disabled', 'disabled');
            $("#laporan").removeAttr('disabled', 'disabled');
            $("#berkas").removeAttr('disabled', 'disabled');
            $("#kebijakan").removeAttr('disabled', 'disabled');
            $("#daftarstaf").removeAttr('disabled', 'disabled');
            $("#buktifisik").removeAttr('disabled', 'disabled');
            $("#informasi").removeAttr('disabled', 'disabled');
            $("#TglWaw").removeAttr('disabled', 'disabled');
            $("#jam_waw").removeAttr('disabled', 'disabled');
            $("#hasil_waw").removeAttr('disabled', 'disabled');
            $("#peta_informasi").removeAttr('disabled', 'disabled');
            $("#masalah").removeAttr('disabled', 'disabled');
            $("#analisis").removeAttr('disabled', 'disabled');
            $("#TglAna1").removeAttr('disabled', 'disabled');
            $("#TglAna2").removeAttr('disabled', 'disabled');
            $("#masalah_utama").removeAttr('disabled', 'disabled');
            $("#saran_rekomendasi").removeAttr('disabled', 'disabled');

        }else if(hasil_skor == "Ekstrim"){
            $("#penyebab_langsung").attr('disabled', 'disabled');
            $("#akar_masalah").attr('disabled', 'disabled');
            $("#tindakan").attr('disabled', 'disabled');
            $("#penanggung_jawab_1").attr('disabled', 'disabled');
            $("#perkiraan_waktu_1").attr('disabled', 'disabled');
            $("#rekomendasi").attr('disabled', 'disabled');
            $("#penanggung_jawab_2").attr('disabled', 'disabled');
            $("#perkiraan_waktu_2").attr('disabled', 'disabled');

            $("#kronologis").removeAttr('disabled', 'disabled');
            $("#TglObs").removeAttr('disabled', 'disabled');
            $("#jam_obs").removeAttr('disabled', 'disabled');
            $("#hasil_obs").removeAttr('disabled', 'disabled');
            $("#laporan").removeAttr('disabled', 'disabled');
            $("#berkas").removeAttr('disabled', 'disabled');
            $("#kebijakan").removeAttr('disabled', 'disabled');
            $("#daftarstaf").removeAttr('disabled', 'disabled');
            $("#buktifisik").removeAttr('disabled', 'disabled');
            $("#informasi").removeAttr('disabled', 'disabled');
            $("#TglWaw").removeAttr('disabled', 'disabled');
            $("#jam_waw").removeAttr('disabled', 'disabled');
            $("#hasil_waw").removeAttr('disabled', 'disabled');
            $("#peta_informasi").removeAttr('disabled', 'disabled');
            $("#masalah").removeAttr('disabled', 'disabled');
            $("#analisis").removeAttr('disabled', 'disabled');
            $("#TglAna1").removeAttr('disabled', 'disabled');
            $("#TglAna2").removeAttr('disabled', 'disabled');
            $("#masalah_utama").removeAttr('disabled', 'disabled');
            $("#saran_rekomendasi").removeAttr('disabled', 'disabled');

        }else if(hasil_skor == "Rendah"){
            $("#penyebab_langsung").removeAttr('disabled', 'disabled');
            $("#akar_masalah").removeAttr('disabled', 'disabled');
            $("#tindakan").removeAttr('disabled', 'disabled');
            $("#penanggung_jawab_1").removeAttr('disabled', 'disabled');
            $("#perkiraan_waktu_1").removeAttr('disabled', 'disabled');
            $("#rekomendasi").removeAttr('disabled', 'disabled');
            $("#penanggung_jawab_2").removeAttr('disabled', 'disabled');
            $("#perkiraan_waktu_2").removeAttr('disabled', 'disabled');

            $("#kronologis").attr('disabled', 'disabled');
            $("#TglObs").attr('disabled', 'disabled');
            $("#jam_obs").attr('disabled', 'disabled');
            $("#hasil_obs").attr('disabled', 'disabled');
            $("#laporan").attr('disabled', 'disabled');
            $("#berkas").attr('disabled', 'disabled');
            $("#kebijakan").attr('disabled', 'disabled');
            $("#daftarstaf").attr('disabled', 'disabled');
            $("#buktifisik").attr('disabled', 'disabled');
            $("#informasi").attr('disabled', 'disabled');
            $("#TglWaw").attr('disabled', 'disabled');
            $("#jam_waw").attr('disabled', 'disabled');
            $("#hasil_waw").attr('disabled', 'disabled');
            $("#peta_informasi").attr('disabled', 'disabled');
            $("#masalah").attr('disabled', 'disabled');
            $("#analisis").attr('disabled', 'disabled');
            $("#TglAna1").attr('disabled', 'disabled');
            $("#TglAna2").attr('disabled', 'disabled');
            $("#masalah_utama").attr('disabled', 'disabled');
            $("#saran_rekomendasi").attr('disabled', 'disabled');

        }else if(hasil_skor == "Moderat"){
            $("#penyebab_langsung").removeAttr('disabled', 'disabled');
            $("#akar_masalah").removeAttr('disabled', 'disabled');
            $("#tindakan").removeAttr('disabled', 'disabled');
            $("#penanggung_jawab_1").removeAttr('disabled', 'disabled');
            $("#perkiraan_waktu_1").removeAttr('disabled', 'disabled');
            $("#rekomendasi").removeAttr('disabled', 'disabled');
            $("#penanggung_jawab_2").removeAttr('disabled', 'disabled');
            $("#perkiraan_waktu_2").removeAttr('disabled', 'disabled');

            $("#kronologis").attr('disabled', 'disabled');
            $("#TglObs").attr('disabled', 'disabled');
            $("#jam_obs").attr('disabled', 'disabled');
            $("#hasil_obs").attr('disabled', 'disabled');
            $("#laporan").attr('disabled', 'disabled');
            $("#berkas").attr('disabled', 'disabled');
            $("#kebijakan").attr('disabled', 'disabled');
            $("#daftarstaf").attr('disabled', 'disabled');
            $("#buktifisik").attr('disabled', 'disabled');
            $("#informasi").attr('disabled', 'disabled');
            $("#TglWaw").attr('disabled', 'disabled');
            $("#jam_waw").attr('disabled', 'disabled');
            $("#hasil_waw").attr('disabled', 'disabled');
            $("#peta_informasi").attr('disabled', 'disabled');
            $("#masalah").attr('disabled', 'disabled');
            $("#analisis").attr('disabled', 'disabled');
            $("#TglAna1").attr('disabled', 'disabled');
            $("#TglAna2").attr('disabled', 'disabled');
            $("#masalah_utama").attr('disabled', 'disabled');
            $("#saran_rekomendasi").attr('disabled', 'disabled');
        }

        modal.style.display = "none";

       })
</script>
