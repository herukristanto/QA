<script src="Script/jquery-1.12.4.js"></script>
<script src="script/numberonly.js"></script>
<meta http-equiv="refresh" content="5">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<body onload='cekisi();'>
    <?php
    include "koneksi.php";

    session_start();
    $idruang = $_SESSION['idruang'];
    $iddokter = $_SESSION['iddokter'];

    date_default_timezone_set('Asia/Jakarta');
    $tgl = DATE('Y M d');

    $query = "SELECT kode FROM QP7LISTDOCTOR WHERE Doctor_Id like '".$iddokter."' AND selesai_praktek='00:00:00.0000000' AND create_date='".$tgl."';";
    $params = array();
    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $sql = sqlsrv_query( $conn, $query , $params, $options );
    while($rs = sqlsrv_fetch_array($sql)){
        $kode = $rs['kode'];
    }

    $query = "SELECT nomor_antrian, id FROM qp7antrian WHERE Id_Ruang='".$idruang."' AND status='5' AND nomor_antrian like '".$kode."%'";
    $params = array();
    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $sql = sqlsrv_query( $conn, $query , $params, $options );
    $row_countskip = sqlsrv_num_rows( $sql );
    $hitung = 0;
    if ($row_countskip == 0) {
        echo "
        <table width=\"300\" id=\"antrianList\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\" id=\"tabelAntri\">
        <tr>
        <td bgcolor='#999999' align='center'>Urutan</td>
        <td bgcolor='#999999' align='center' hidden>ID</td>
        <td bgcolor='#999999' align='center'>Nomor Antrian</td>
        <td align=\"center\" colspan=\"2\" bgcolor='#999999'>Action</td>
        </tr>
        <tr>
        <td colspan='5' align=center>Tidak ada antrian</td>
        </tr>
        </table>";
    } else {
        if ($sql){
            echo "
            <table width=\"300\" id=\"antrianskipList\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\">
            <tr>
            <td bgcolor='#999999' align='center'>Urutan</td>
            <td bgcolor='#999999' align='center' hidden>ID</td>
            <td bgcolor='#999999' align='center'>Nomor Antrian</td>
            <td align=\"center\" colspan=\"2\" bgcolor='#999999'>Action</td>
            </tr>
            ";
            while($rs = sqlsrv_fetch_array($sql)){
                $hitung = $hitung + 1;
                echo "
                <tr>
                <td width='50px' align='center'>".$hitung."</td>

                <td width='25px' align='center' hidden>".$rs['id']."</td>

                <td width='150px' align='center'>".$rs['nomor_antrian']."</td>

                <td width='200px' align='center' contenteditable class='numberonly'></td>

                <td width='50px' align='center' bgcolor='#ffcccc' onclick='recall(this);'><input type='image' src='Images/button_recall.PNG'></input></td>
                </tr>
                ";
            }
        }
        echo"</table>";
    }

    $query = "SELECT Urutan, Id, nomor_antrian FROM QP7ANTRIANAA where Id_Ruang='".$idruang."' AND nomor_antrian like '".$kode."%' ORDER BY Urutan ASC";
    $params = array();
    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $sql = sqlsrv_query( $conn, $query , $params, $options );
    $row_count = sqlsrv_num_rows( $sql );
    if ($row_count == 0) {
        echo "
        <br>
        <table width=\"300\" id=\"antrianList\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\" id=\"tabelAntri\" hidden>
        <tr>
        <td bgcolor='#999999' align='center'>Urutan</td>
        <td bgcolor='#999999' align='center' hidden>ID</td>
        <td bgcolor='#999999' align='center'>Nomor Antrian</td>
        </tr>
        </table>";
    } else {
        if ($sql){
            echo "
            <br>
            <table width=\"300\" id=\"antrianList\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\" id=\"tabelAntri\" hidden>
            <tr>
            <td bgcolor='#999999' align='center'>Urutan</td>
            <td bgcolor='#999999' align='center' hidden>ID</td>
            <td bgcolor='#999999' align='center'>Nomor Antrian</td>
            </tr>";
            while($rs = sqlsrv_fetch_array($sql)){
                if ($rs['Urutan'] == 1) {
                    echo "
                    <tr>
                    <td width='50px' align='center' bgcolor='#ffcccc'>".$rs['Urutan']."</td>

                    <td width='200px' bgcolor='#ffcccc' align='center' hidden>".$rs['Id']."</td>

                    <td width='200px' bgcolor='#ffcccc' align='center'>".$rs['nomor_antrian']."</td>            
                    </tr>
                    ";
                } else {
                    echo "
                    <tr>
                    <td width='50px' align='center' align='center'>".$rs['Urutan']."</td>
                    <td width='200px' bgcolor='#ffcccc' align='center' hidden>".$rs['Id']."</td>
                    <td width='200px' align='center'>".$rs['nomor_antrian']."</td>
                    ";
                }
            }
        }
        echo"</table>";
    }

    $query = "SELECT nomor_antrian, flage FROM QP7ANTRIANAA WHERE Id_Ruang like '".$idruang."' AND nomor_antrian like '".$kode."%' AND flagee='x' ORDER BY Urutan ASC";
    $params = array();
    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $sql = sqlsrv_query( $conn, $query , $params, $options );
    $row_count = sqlsrv_num_rows( $sql );
    if ($row_count == 0) {
        echo "
        <table width=\"450\" id=\"antrianList4\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\" style=\"table-layout:fixed\" hidden>
        <tr>
        <td align='center'>Nomor Antrian</td>
        <td align='center'>Flage</td>
        </tr>
        </table>";
    } else {
        if ($sql){
            echo "
            <table width=\"450\" id=\"antrianList4\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\" style=\"table-layout:fixed\" hidden>
            <tr>
            <td align='center'>Nomor Antrian</td>
            <td align='center'>Flage</td>
            </tr>";
            while($rs = sqlsrv_fetch_array($sql)){
                echo "
                <tr>
                <td width='200px' align='center'>".$rs['nomor_antrian']."</td>
                <td width='200px' align='center'>".$rs['flage']."</td>
                </tr>
                ";
            }
        }
        echo"</table>";
    }
    ?>

    <script>
        $("br[type='_moz']").remove();

        function recall(x) {
            var emg = document.getElementById('antrianList4');
            var rowCount4 = emg.rows.length;
            if (rowCount4>1) {
                alert('Mohon tunggu.. Sedang ada pasien emergency');
            } else {
                var antrian2 = document.getElementById('antrianskipList');
                var rowIndex = x.parentNode.rowIndex;
                var idnya = antrian2.rows[rowIndex].cells[1].innerHTML;
                var nomor = antrian2.rows[rowIndex].cells[2].innerHTML;
                var selip = antrian2.rows[rowIndex].cells[3].innerHTML;

                if (selip =='' || selip=='0') {

                } else {
                    var antrian = document.getElementById('antrianList');
                    var rowCount = antrian.rows.length;
                    if (rowCount>0) {
                        var j;
                        var arr1 = [];
                        var arr2 = [];

                        for (i = 1; i < rowCount; i++) {
                            j = i - 1;
                            arr2 = [];

                            urutan = antrian.rows[i].cells[0].innerHTML;
                            id = antrian.rows[i].cells[1].innerHTML;

                            arr2[0] =  urutan;
                            arr2[1] =  id;

                            arr1[j] = arr2;
                        }

                        window.location.href = "recallantrian.php?id="+idnya+"&selip="+selip+"&nomor="+nomor+"&rowCount="+rowCount;

                        $.post("selipantrian.php", {'myData': arr1, 'selip':selip}, function(data, status){});
                    }
                }

                var iframe = parent.document.getElementById('antrian');
                iframe.src = iframe.src;
                var iframe = parent.document.getElementById('emergency');
                iframe.src = iframe.src;
            }
        }

        function cekisi() {
            var antrian = document.getElementById('antrianList');
            parent.row_countskip = antrian.rows[1].cells[0].innerHTML;
        }

    </script>
</body>