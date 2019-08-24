<?php
include "koneksi.php";
if (isset($_GET['katakunci']))
{
    $katakunci = $_GET['katakunci'];
    $query = "SELECT * FROM T_RCA WHERE No_RCA like '%". $katakunci ."%' OR No_lap like '%". $katakunci ."%' OR Obs_tanggal like '%". $katakunci ."%' OR Wwcr_tgl like '%". $katakunci ."%' ORDER BY No_RCA ASC" ;
    $sql = sqlsrv_query($conn,$query);
    if ($sql){
        echo "
        <table id=\"TableDetail\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\">
        <tr style=\"font-weight:bold\">
        <td>No. RCA</td>
        <td>No. Laporan</td>
        <td>Tgl Observasi</td>
        <td>Tgl Interview</td>

        </tr>";

        while($rs = sqlsrv_fetch_array($sql)){

            echo "
            <tr id='".$rs['No_RCA'].
            "|".$rs['No_lap'].
            "|".$rs['Kronologis'].
            "|".$rs['Obs_tanggal']->format('d/m/Y').
            "|".$rs['Obs_jam']->format('H:i:s').
            "|".$rs['Obs_hasil'].
            "|".$rs['Obs_lap'].
            "|".$rs['Doc_berkas'].
            "|".$rs['Doc_kebijakan'].
            "|".$rs['Doc_staf'].
            "|".$rs['Doc_fisik'].
            "|".$rs['Doc_infor'].
            "|".$rs['Wwcr_tgl']->format('d/m/Y').
            "|".$rs['Wwcr_jam']->format('H:i:s').
            "|".$rs['Wwcr_hasil'].
            "|".$rs['keterangan'].
            "|".$rs['Iden_mslh'].
            "|".$rs['Analisis'].
            "|".$rs['Tgl_start']->format('d/m/Y').
            "|".$rs['Tgl_end']->format('d/m/Y').
            "|".$rs['Masalah'].
            "|".$rs['Saran']."

            ' >

            <td>".$rs['No_RCA']."</td>
            <td width=\"200px\">".$rs['No_lap']."</td>
            <td align='center'>".$rs['Obs_tanggal']->format('d/m/Y')."</td>
            <td align=\"center\" width=\"120px\">".$rs['Wwcr_tgl']->format('d/m/Y')."</td>
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

        var No_RCA              = res[0];
        var No_lap              = res[1];
        var Kronologis          = res[2];
        var Obs_tanggal         = res[3];
        var Obs_jam             = res[4];
        var Obs_hasil           = res[5];
        var Obs_lap             = res[6];
        var Doc_berkas          = res[7];
        var Doc_kebijakan       = res[8];
        var Doc_staf            = res[9];
        var Doc_fisik           = res[10];
        var Doc_infor           = res[11];
        var Wwcr_tgl            = res[12];
        var Wwcr_jam            = res[13];
        var Wwcr_hasil          = res[14];
        var Keterangan          = res[15];
        var Iden_mslh           = res[16];
        var Analisis            = res[17];
        var Tgl_start           = res[18];
        var Tgl_end             = res[19];
        var Masalah             = res[20];
        var Saran               = res[21];


        $("#no_rca").val(No_RCA);
        $("#no_lap").val(No_lap);
        $("#kronologis").val(Kronologis);
        $("#TglObs").val(Obs_tanggal);
        $("#jam_obs").val(Obs_jam);
        $("#hasil_obs").val(Obs_hasil);
        $("#laporan_kejadian").val(Obs_lap);
        $("#berkas_RM").val(Doc_berkas);
        $("#kebijakan_prosedur").val(Doc_kebijakan);
        $("#daftarstaf").val(Doc_staf);
        $("#buktifisik").val(Doc_fisik);
        $("#informasi_lain").val(Doc_infor);
        $("#TglWaw").val(Wwcr_tgl);
        $("#jam_waw").val(Wwcr_jam);
        $("#hasil_waw").val(Wwcr_hasil);
        $("#peta_informasi").val(Keterangan);
        $("#masalah").val(Iden_mslh);
        $("#analisis").val(Analisis);
        $("#TglAna1").val(Tgl_start);
        $("#TglAna2").val(Tgl_end);
        $("#masalah_utama").val(Masalah);
        $("#saran_rekomendasi").val(Saran);

        if (Obs_lap == "X") {
          checkbtn = document.getElementById("laporan_kejadian");
          checkbtn.checked = true;
        } else {
          checkbtn = document.getElementById("laporan_kejadian");
          checkbtn.checked = false;
        }

        if (Doc_berkas == "X") {
          checkbtn = document.getElementById("berkas_RM");
          checkbtn.checked = true;
        } else {
          checkbtn = document.getElementById("berkas_RM");
          checkbtn.checked = false;
        }

        if (Doc_kebijakan == "X") {
          checkbtn = document.getElementById("kebijakan_prosedur");
          checkbtn.checked = true;
        } else {
          checkbtn = document.getElementById("kebijakan_prosedur");
          checkbtn.checked = false;
        }

        if (Doc_staf == "X") {
          checkbtn = document.getElementById("daftarstaf");
          checkbtn.checked = true;
        } else {
          checkbtn = document.getElementById("daftarstaf");
          checkbtn.checked = false;
        }

        if (Doc_fisik == "X") {
          checkbtn = document.getElementById("buktifisik");
          checkbtn.checked = true;
        } else {
          checkbtn = document.getElementById("buktifisik");
          checkbtn.checked = false;
        }

        if (Doc_infor == "X") {
          checkbtn = document.getElementById("informasi_lain");
          checkbtn.checked = true;
        } else {
          checkbtn = document.getElementById("informasi_lain");
          checkbtn.checked = false;
        }

        modal.style.display = "none";

       })
</script>
