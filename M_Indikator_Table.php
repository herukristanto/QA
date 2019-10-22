<?php
include "koneksi.php";
if (isset($_GET['katakunci']))
{
    $katakunci = $_GET['katakunci'];
    $query = "SELECT * FROM M_Indikator WHERE Kode like '%". $katakunci ."%'
												OR Kategori like '%". $katakunci ."%'
												OR Target like '%". $katakunci ."%'
												OR Departemen like '%". $katakunci ."%'
												OR Unit like '%". $katakunci ."%'
												OR Group_indikator like '%". $katakunci . "%'
                                                OR Lap_Kej like '%". $katakunci ."%'
                                                OR Tolak_ukur like '%". $katakunci ."%'
                                                OR Numerator like '%". $katakunci ."%'
                                                OR Denominator like '%". $katakunci ."%'
												OR Status like '%". $katakunci ."%' ORDER BY Kode ASC";

    $sql = sqlsrv_query($conn,$query);
    if ($sql){
        echo "
        <table id=\"TableDetail\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\">
        <tr>
        <td>Kode</td>
        <td>Aspek</td>
		<td>Standar</td>
        <td>Tolak ukur</td>
        <td>Departemen</td>
		<td>Unit</td>
		<td>Group</td>
        <td>Numerator</td>
        <td>Denominator</td>
        <td>Lap. Kejadian</td>
        <td>Status</td>
        </tr>";
        while($rs = sqlsrv_fetch_array($sql)){
            echo "
            <tr id='".$rs['Kode']."|".$rs['Kategori']."|".$rs['Target']."|".$rs['Tolak_ukur']."|".$rs['Departemen']."|".$rs['Unit']."|".$rs['Group_indikator']."|".$rs['Numerator']."|".$rs['Denominator']."|".$rs['Lap_Kej']."|".$rs['Status']."' >
            <td>".$rs['Kode']."</td>
            <td>".$rs['Kategori']."</td>
			<td>".$rs['Target']."</td>
            <td>".$rs['Tolak_ukur']."</td>
            <td>".$rs['Departemen']."</td>
			<td>".$rs['Unit']."</td>
			<td>".$rs['Group_indikator']."</td>
            <td>".$rs['Numerator']."</td>
            <td>".$rs['Denominator']."</td>
            <td>".$rs['Lap_Kej']."</td>
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
        var id 				= $(this).attr('id');
        var res 			= id.split("|");
        var kode 			= res[0];
        var aspek 			= res[1];
        var standar         = res[2];
        var tolakukur       = res[3];
		var departemen		= res[4];
        var unit_kerja		= res[5];
		var stat_group	    = res[6];
        var statnum         = res[7];
        var statden         = res[8];
        var statlap         = res[9];
        var statindikator   = res[10];

        $("#kode").val(kode);
        $("#aspek").val(aspek);
		$("#standar").val(standar);
        $("#departemen").val(departemen);
		$("#unit").val(unit_kerja);
		$("#stat_group").val(stat_group);
        $("#tolakukur").val(tolakukur);
        // $("#statnum").val(statnum);
        // $("#statden").val(statden);

        if (statnum=="X"){
            radiobtn = document.getElementById("Ya_num");
            radiobtn.checked = true;
        } else if(statnum==""){
            radiobtn = document.getElementById("Tidak_num");
            radiobtn.checked = true;
        }

        if (statden=="X"){
            radiobtn = document.getElementById("Ya_den");
            radiobtn.checked = true;
        } else if(statden==""){
            radiobtn = document.getElementById("Tidak_den");
            radiobtn.checked = true;
        }

        if (stat_group=="IAK"){
            radiobtn = document.getElementById("IAK");
            radiobtn.checked = true;
        } else if(stat_group=="IAM"){
            radiobtn = document.getElementById("IAM");
            radiobtn.checked = true;
        } else if(stat_group=="ISKP"){
            radiobtn = document.getElementById("ISKP");
            radiobtn.checked = true;
        }

        if (statlap=="X"){
            radiobtn = document.getElementById("Ya_lap");
            radiobtn.checked = true;
        } else if(statlap==""){
            radiobtn = document.getElementById("Tidak_lap");
            radiobtn.checked = true;
        }

        if (statindikator=="X"){
            radiobtn = document.getElementById("aktif");
            radiobtn.checked = true;
        } else if(statindikator==""){
            radiobtn = document.getElementById("nonaktif");
            radiobtn.checked = true;
        }

		change1();

        modal.style.display = "none";
    })
</script>
