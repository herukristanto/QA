<style>
  .table-container{
    overflow: auto;
  }
</style>
<?php
include "koneksi.php";
if (isset($_GET['katakunci']))
{
    $katakunci = $_GET['katakunci'];
    $query = "SELECT * FROM T_Kejadian_a WHERE no_lap like '%". $katakunci ."%' OR lokasi like '%". $katakunci ."%' OR no_rm like '%". $katakunci ."%' ORDER BY no_lap ASC";
    $sql = sqlsrv_query($conn,$query);

    if ($sql){
        echo "
        <div class='table-container'>
        <table id=\"TableDetail\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\">
        <tr>
        <td>No. Lap</td>
        <td>Tgl Kejadian</td>
        <td>Lokasi</td>
        <td>No. RM</td>
        <td>Unit</td>

        <td>Cidera</td>
        <td>Kode Indikator</td>
        <td>Kode Insident</td>
        <td>Hasil Grading</td>

        </tr>";
        while($rs = sqlsrv_fetch_array($sql)){
          $hg = $rs['hasil_skor'];

            echo "
            <tr id='
            ".$rs['kejadian_terjadi'].
            "|".$rs['kejadian_terjadi'].
            "|".$rs['pasien_mengetahui'].
            "|".$rs['cedera'].
            "|".$rs['hasil'].
            "|".$rs['no_lap'].
            "|".$rs['tgl_kejadian']->format('d/m/Y').
            "|".$rs['jam_kejadian'].
            "|".$rs['lokasi'].
            "|".$rs['no_rm'].
            "|".$rs['kode_u'].
            "|".$rs['no_lap_1'].
            "|".$rs['tipe_layanan'].
            "|".$rs['tingkat_cidera'].
            "|".$rs['kode_indikator'].
            "|".$rs['kode_insiden'].
            "|".$rs['tipe_insiden'].
            "|".$rs['kode_sub'].
            "|".$rs['kronologis'].
            "|".$rs['skor_dampak'].
            "|".$rs['skor_prob'].
            "|".$rs['skor_prob'].
            "|".$rs['hasil_skor'].
            "|".$rs['rawat_lain'].
            "|".$rs['cedera_lain'].

            "'>

            <td width=\"110px\">".$rs['no_lap']."</td>
            <td>".$rs['tgl_kejadian']->format('d/m/Y')."</td>
            <td>".$rs['lokasi']."</td>
            <td>".$rs['no_rm']."</td>
            <td>".$rs['kode_u']."</td>
            <td>".$rs['tingkat_cidera']."</td>
            <td>".$rs['kode_indikator']."</td>
            <td>".$rs['kode_insiden']."</td>";
            if ($hg == 'Ekstrim') {
              echo
              "<td style=\"text-align:center;width:90px;font-weight:bold;font-size:14px;background-color:red\">".$hg."</td>";
            } elseif ($hg == 'Moderat') {
              echo
              "<td style=\"text-align:center;width:90px;font-weight:bold;font-size:14px;background-color:green\">".$hg."</td>";
            } elseif ($hg == 'Tinggi') {
              echo
              "<td style=\"text-align:center;width:90px;font-weight:bold;font-size:14px;background-color:yellow\">".$hg."</td>";
            } elseif ($hg == 'Rendah') {
              echo
              "<td style=\"text-align:center;width:90px;font-weight:bold;font-size:14px;background-color:#1E90FF\">".$hg."</td>";
            } elseif ($hg == '') {
              echo
              "<td style=\"text-align:center;width:90px;font-weight:bold;font-size:14px;background-color:none\"></td>";
            }
            "

            </tr>
            ";
        }
    }
    echo"</table> </div>";
} else {
    $katakunci = "0";
}
?>

<script>
    $('tr').dblclick(function(){
        var id = $(this).attr('id');
        var res = id.split("|");

        var kjd_terjadi = res[1];
        var pasien_tahu = res[2];
        var cedera = res[3];
        var hasil = res[4];
        var no_lap = res[5];
        var tgl_kejadian = res[6];
        var jam_kejadian = res[7];
        var lokasi = res[8];
        var no_rm = res[9];
        var kode_u = res[10];
        var no_lap_1 = res[11];
        var tipe_layanan = res[12];
        var tingkat_cidera = res[13];
        var kode_indikator = res[14];
        var kode_insiden = res[15];
        var tipe_insiden = res[16];
        var kode_sub = res[17];
        var kronologis = res[18];
        var skor_dampak = res[19];

        var skor_prob = res[21];
        var hasil_skor = res[22];

        var rawat_lain      = res[23];
        var cedera_lain     = res[24];

        $("#no_lap").val(no_lap);
        $("#tgl_kejadian").val(tgl_kejadian);
        $("#jam_kejadian").val(jam_kejadian);
        $("#lokasi").val(lokasi);
        $("#no_rm").val(no_rm);
        $("#kode_u").val(kode_u);
        $("#no_lap_1").val(no_lap_1);
        $("#tipe_layanan").val(tipe_layanan);
        $("#tingkat_cidera").val(tingkat_cidera);
        $("#kode_indikator").val(kode_indikator);
        $("#kode_insiden").val(kode_insiden);
        $("#tipe_insiden").val(tipe_insiden);
        $("#kode_sub").val(kode_sub);
        $("#kronologis").val(kronologis);
        $("#skor_prob").val(skor_prob);
        $("#skor_dampak").val(skor_dampak);
        $("#hasil_skor").val(hasil_skor);
        $("#rawat_lain").val(rawat_lain);
        $("#cedera_lain").val(cedera_lain);

        if (kjd_terjadi=="Ya"){
            radiobtn = document.getElementById("kjd_ya");
            radiobtn.checked = true;
        }else if(kjd_terjadi=="Tidak"){
            radiobtn = document.getElementById("kjd_tidak");
            radiobtn.checked = true;
        }

        if (pasien_tahu=="Ya"){
            radiobtn = document.getElementById("pasien_ya");
            radiobtn.checked = true;
        }else if(pasien_tahu=="Tidak"){
            radiobtn = document.getElementById("pasien_tidak");
            radiobtn.checked = true;
        }

        if (cedera=="Ya"){
            radiobtn = document.getElementById("cedera_ya");
            radiobtn.checked = true;
        }else if(cedera=="Tidak"){
            radiobtn = document.getElementById("cedera_tidak");
            radiobtn.checked = true;
        }

        if (hasil=="KTC"){
            radiobtn = document.getElementById("KTC");
            radiobtn.checked = true;
        }else if(hasil=="KNC"){
            radiobtn = document.getElementById("KNC");
            radiobtn.checked = true;
        }else if(hasil=="KPC"){
            radiobtn = document.getElementById("KPC");
            radiobtn.checked = true;
        }else if(hasil=="KTD"){
            radiobtn = document.getElementById("KTD");
            radiobtn.checked = true;
        }else if(hasil=="Sentinel"){
            radiobtn = document.getElementById("Sentinel");
            radiobtn.checked = true;
        }

        var elemen = document.getElementById("rawat_lain")

        if (tipe_layanan=="Rawat Inap"){
            radiobtn = document.getElementById("rawatinap");
            radiobtn.checked = true;
            elemen.disabled = true;
        }else if(tipe_layanan=="Rawat Jalan"){
            radiobtn = document.getElementById("rawatjalan");
            radiobtn.checked = true;
            elemen.disabled = true;
        }else if(tipe_layanan=="Rawat Lain"){
            radiobtn = document.getElementById("rawatlain");
            radiobtn.checked = true;
              elemen.disabled = false;
        }

        var elemen1 = document.getElementById("cedera_lain")

        if(tingkat_cidera=="kematian"){
            radiobtn = document.getElementById("kematian");
            radiobtn.checked = true;
            elemen1.disabled = true;
        }else if(tingkat_cidera=="berat"){
            radiobtn = document.getElementById("berat");
            radiobtn.checked = true;
            elemen1.disabled = true;
        }else if(tingkat_cidera=="sedang"){
            radiobtn = document.getElementById("sedang");
            radiobtn.checked = true;
            elemen1.disabled = true;
        }else if(tingkat_cidera=="ringan"){
            radiobtn = document.getElementById("ringan");
            radiobtn.checked = true;
            elemen1.disabled = true;
        }else if(tingkat_cidera=="tidak ada"){
            radiobtn = document.getElementById("tidak ada");
            radiobtn.checked = true;
            elemen1.disabled = true;
        }else if(tingkat_cidera=="lain"){
            radiobtn = document.getElementById("lain");
            radiobtn.checked = true;
            if (radiobtn.checked == true) {
              elemen.disabled = false;
            }
        }

        if (skor_dampak=="5"){
            radiobtn = document.getElementById("5");
            radiobtn.checked = true;
        }else if(skor_dampak=="4"){
            radiobtn = document.getElementById("4");
            radiobtn.checked = true;
        }else if(skor_dampak=="3"){
            radiobtn = document.getElementById("3");
            radiobtn.checked = true;
        }else if(skor_dampak=="2"){
            radiobtn = document.getElementById("2");
            radiobtn.checked = true;
        }else if(skor_dampak=="1"){
            radiobtn = document.getElementById("1");
            radiobtn.checked = true;
        }

        if (skor_prob=="5"){
            radiobtn = document.getElementById("prob_5");
            radiobtn.checked = true;
        }else if(skor_prob=="4"){
            radiobtn = document.getElementById("prob_4");
            radiobtn.checked = true;
        }else if(skor_prob=="3"){
            radiobtn = document.getElementById("prob_3");
            radiobtn.checked = true;
        }else if(skor_prob=="2"){
            radiobtn = document.getElementById("prob_2");
            radiobtn.checked = true;
        }else if(skor_prob=="1"){
            radiobtn = document.getElementById("prob_1");
            radiobtn.checked = true;
        }

        var inputVal = document.getElementById("hasil_skor");
         if (inputVal.value == "Ekstrim") {
             inputVal.style.backgroundColor = "red"; //red
         } else if (inputVal.value == "Tinggi") {
             inputVal.style.backgroundColor = "yellow";
         }else if (inputVal.value == "Moderat") {
              inputVal.style.backgroundColor = "green";
         }else if (inputVal.value == "Rendah") {
              inputVal.style.backgroundColor = "#1E90FF";
         }else if (inputVal.value == "") {
              inputVal.style.backgroundColor = "";
         }

            modal.style.display = "none";


    })
</script>
