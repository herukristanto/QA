<script src="script/jquery-1.12.4.js"></script>
<meta http-equiv="refresh" content="5" >
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<head>
    <style type="text/css">
    .tombol1{
        height: 40px;
        width: 70px;
        color: white;
        background-color: green;
        border-radius: 8px;
    }
    .tombol2{
        height: 25px;
        width: 70px;
        color: white;
        background-color: orange;
        border-radius: 8px;
    }
    .tombol3{
        height: 40px;
        width: 90px;
        color: white;
        background-color: blue;
        border-radius: 8px;
    }
    .tombol4{
        height: 25px;
        width: 70px;
        color: white;
        background-color: red;
        border-radius: 8px;
    }
</style>
</head>
<body onload="reload()">
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


    $query = "SELECT Urutan, Id, nomor_antrian, status FROM QP7ANTRIANAA WHERE Id_Ruang like '".$idruang."' AND nomor_antrian like '".$kode."%' ORDER BY Urutan ASC";
    $params = array();
    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $sql = sqlsrv_query( $conn, $query , $params, $options );
    $row_count = sqlsrv_num_rows( $sql );
    if ($row_count == 0) {
        echo "
        <table width=\"450\" id=\"antrianList\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\" style=\"table-layout:fixed\">
        <tr>
        <td bgcolor='#999999' align='center'>Urutan</td>
        <td bgcolor='#999999' align='center' >ID</td>
        <td bgcolor='#999999' align='center'>Nomor Antrian</td>
        <td align=\"center\" colspan=\"4\" bgcolor='#999999'>Action</td>
        <td bgcolor='#999999' align='center' >status</td>
        </tr>
        <tr>
        <td colspan='6' align=center>Tidak ada antrian</td>
        </tr>
        </table><br><br>";
    } else {
        if ($sql){
            echo "
            <table width=\"550\" id=\"antrianList\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\" style=\"table-layout:fixed\">
            <tr>
            <td bgcolor='#999999' align='center'>Urutan</td>
            <td bgcolor='#999999' align='center' >ID</td>
            <td bgcolor='#999999' align='center'>Nomor Antrian</td>
            <td align=\"center\" colspan=\"4\" bgcolor='#999999'>Action</td>
            <td bgcolor='#999999' align='center' >status</td>
            </tr>";
            while($rs = sqlsrv_fetch_array($sql)){
                if ($rs['Urutan'] == 1) {
                    echo "
                    <tr>
                    <td width='50px' align='center' bgcolor='#ffcccc'>".$rs['Urutan']."</td>

                    <td width='200px' bgcolor='#ffcccc' align='center' >".$rs['Id']."</td>

                    <td width='200px' bgcolor='#ffcccc' align='center'>".$rs['nomor_antrian']."</td>

                    <td width='50px' align='center' bgcolor='#ffcccc'><button class='tombol1' onclick='call();'>Call</button></td>

                    <td width='50px' align='center' bgcolor='#ffcccc'><button class='tombol2' onclick='skip();'>Skip</button></td>

                    <td width='150px' align='center' bgcolor='#ffcccc'><button class='tombol3' onclick='complete();'>Complete</button></td>

                    <td width='50px' align='center' bgcolor='#ffcccc'><button class='tombol4' onclick='cancel();'>Cancel</button></td>

                    <td width='200px' bgcolor='#ffcccc' align='center' >".$rs['status']."</td>
                    </tr>
                    ";
                } else {
                    echo "
                    <tr>
                    <td width='50px' align='center' align='center'>".$rs['Urutan']."</td>
                    <td width='200px' bgcolor='#ffcccc' align='center' >".$rs['Id']."</td>
                    <td width='200px' align='center'>".$rs['nomor_antrian']."</td>
                    <td width='200px' bgcolor='#ffcccc' align='center' >".$rs['status']."</td>
                    ";
                }
            }
        }
        echo"</table>";
    }

    $query = "SELECT Urutan, Id, nomor_antrian, status FROM QP7ANTRIANAA WHERE Id_Ruang like '".$idruang."' AND nomor_antrian like '".$kode."%' AND selip='n' ORDER BY Urutan ASC";
    $params = array();
    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $sql = sqlsrv_query( $conn, $query , $params, $options );
    $row_count = sqlsrv_num_rows( $sql );
    if ($row_count == 0) {
        echo "
        <table width=\"450\" id=\"antrianList1\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\" style=\"table-layout:fixed\"  >
        <tr>
        <td align='center'>Urutan</td>
        <td align='center'>ID</td>
        <td align='center'>Nomor Antrian</td>
        </tr>
        </table>";
    } else {
        if ($sql){
            echo "
            <table width=\"450\" id=\"antrianList1\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\" style=\"table-layout:fixed\"  >
            <tr>
            <td align='center'>Urutan</td>
            <td align='center'>ID</td>
            <td align='center'>Nomor Antrian</td>
            </tr>";
            while($rs = sqlsrv_fetch_array($sql)){
                if ($rs['Urutan'] == 1) {
                    echo "
                    <tr>
                    <td width='50px' align='center'>".$rs['Urutan']."</td>
                    <td width='200px' align='center'>".$rs['Id']."</td>
                    <td width='200px' align='center'>".$rs['nomor_antrian']."</td>
                    </tr>
                    ";
                } else {
                    echo "
                    <tr>
                    <td width='50px' align='center' align='center'>".$rs['Urutan']."</td>
                    <td width='200px' align='center'>".$rs['Id']."</td>
                    <td width='200px' align='center'>".$rs['nomor_antrian']."</td>
                    ";
                }
            }
        }
        echo"</table>";
    }

    $query = "SELECT Urutan, Id, nomor_antrian, status, selip, flagee FROM QP7ANTRIANAA WHERE Id_Ruang like '".$idruang."' AND nomor_antrian like '".$kode."%' AND selip<>'n' ORDER BY Urutan ASC";
    $params = array();
    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $sql = sqlsrv_query( $conn, $query , $params, $options );
    $row_count = sqlsrv_num_rows( $sql );
    if ($row_count == 0) {
        echo "
        <table width=\"450\" id=\"antrianList2\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\" style=\"table-layout:fixed\"  >
        <tr>
        <td align='center'>Urutan</td>
        <td align='center'>ID</td>
        <td align='center'>Nomor Antrian</td>
        <td align='center'>Selip</td>
        <td align='center'>Status</td>
        <td align='center'>flagee</td>
        </tr>
        </table>";
    } else {
        if ($sql){
            echo "
            <table width=\"450\" id=\"antrianList2\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\" style=\"table-layout:fixed\"  >
            <tr>
            <td align='center'>Urutan</td>
            <td align='center'>ID</td>
            <td align='center'>Nomor Antrian</td>
            <td align='center'>Selip</td>
            <td align='center'>Status</td>
            <td align='center'>flagee</td>
            </tr>";
            while($rs = sqlsrv_fetch_array($sql)){
                if ($rs['Urutan'] == 1) {
                    echo "
                    <tr>
                    <td width='50px' align='center'>".$rs['Urutan']."</td>
                    <td width='200px' align='center'>".$rs['Id']."</td>
                    <td width='200px' align='center'>".$rs['nomor_antrian']."</td>
                    <td width='200px' align='center'>".$rs['selip']."</td>
                    <td width='200px' align='center'>".$rs['status']."</td>
                    <td width='200px' align='center'>".$rs['flagee']."</td>
                    </tr>
                    ";
                } else {
                    echo "
                    <tr>
                    <td width='50px' align='center' align='center'>".$rs['Urutan']."</td>
                    <td width='200px' align='center'>".$rs['Id']."</td>
                    <td width='200px' align='center'>".$rs['nomor_antrian']."</td>
                    <td width='200px' align='center'>".$rs['selip']."</td>
                    <td width='200px' align='center'>".$rs['status']."</td>
                    <td width='200px' align='center'>".$rs['flagee']."</td>
                    ";
                }
            }
        }
        echo"</table>";
    }

    $query = "SELECT Urutan, Id, Id_Ruang, nomor_antrian, status, selip, flage, baru FROM QP7ANTRIANA WHERE Id_Ruang like '".$idruang."' AND nomor_antrian like '".$kode."%' ORDER BY Urutan ASC";
    $params = array();
    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $sql = sqlsrv_query( $conn, $query , $params, $options );
    $row_count = sqlsrv_num_rows( $sql );
    if ($row_count == 0) {
        echo "
        <table width=\"450\" id=\"antrianList3\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\" style=\"table-layout:fixed\"  >
        <tr>
        <td align='center'>Urutan</td>
        <td align='center'>ID</td>
        <td align='center'>ID Ruang</td>
        <td align='center'>Nomor Antrian</td>
        <td align='center'>Status</td>
        <td align='center'>Selip</td>
        <td align='center'>Flage</td>
        <td align='center'>Baru</td>
        </tr>
        </table>";
    } else {
        if ($sql){
            echo "
            <table width=\"450\" id=\"antrianList3\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\" style=\"table-layout:fixed\"  >
            <tr>
            <td align='center'>Urutan</td>
            <td align='center'>ID</td>
            <td align='center'>ID Ruang</td>
            <td align='center'>Nomor Antrian</td>
            <td align='center'>Status</td>
            <td align='center'>Selip</td>
            <td align='center'>Flage</td>
            <td align='center'>Baru</td>
            </tr>";
            while($rs = sqlsrv_fetch_array($sql)){
                if ($rs['Urutan'] == 1) {
                    echo "
                    <tr>
                    <td width='50px' align='center'>".$rs['Urutan']."</td>
                    <td width='200px' align='center'>".$rs['Id']."</td>
                    <td width='200px' align='center'>".$rs['Id_Ruang']."</td>
                    <td width='200px' align='center'>".$rs['nomor_antrian']."</td>
                    <td width='200px' align='center'>".$rs['status']."</td>
                    <td width='200px' align='center'>".$rs['selip']."</td>
                    <td width='200px' align='center'>".$rs['flage']."</td>
                    <td width='200px' align='center'>".$rs['baru']."</td>
                    </tr>
                    ";
                } else {
                    echo "
                    <tr>
                    <td width='50px' align='center'>".$rs['Urutan']."</td>
                    <td width='200px' align='center'>".$rs['Id']."</td>
                    <td width='200px' align='center'>".$rs['Id_Ruang']."</td>
                    <td width='200px' align='center'>".$rs['nomor_antrian']."</td>
                    <td width='200px' align='center'>".$rs['status']."</td>
                    <td width='200px' align='center'>".$rs['selip']."</td>
                    <td width='200px' align='center'>".$rs['flage']."</td>
                    <td width='200px' align='center'>".$rs['baru']."</td>
                    ";
                }
            }
        }
        echo"</table>";
    }

    $query = "SELECT nomor_antrian, flage FROM QP7ANTRIANAA WHERE Id_Ruang like '".$idruang."' AND nomor_antrian like '".$kode."%' AND flage='y' ORDER BY Urutan ASC";
    $params = array();
    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $sql = sqlsrv_query( $conn, $query , $params, $options );
    $row_count = sqlsrv_num_rows( $sql );
    if ($row_count == 0) {
        echo "
        <table width=\"450\" id=\"antrianList4\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\" style=\"table-layout:fixed\" >
        <tr>
        <td align='center'>Nomor Antrian</td>
        <td align='center'>Flage</td>
        </tr>
        </table>";
    } else {
        if ($sql){
            echo "
            <table width=\"450\" id=\"antrianList4\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\" style=\"table-layout:fixed\" >
            <tr>
            <td align='center'>Nomor Antrian</td>
            <td align='center'>Flage</td>
            </tr>";
            while($rs = sqlsrv_fetch_array($sql)){
                echo "
                <tr>
                <td width='200px' align='center'>".$rs['nomor_antrian']."</td>
                <td width='200px' align='center'>".$rs['flage']."</td>
                ";
            }
        }
        echo"</table>";
    }

    $query = "SELECT Id_Ruang, kode, nomor_antrian FROM QP7LASTANTRIAN WHERE Id_Ruang like '".$idruang."' AND nomor_antrian like '".$kode."%'";
    $params = array();
    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $sql = sqlsrv_query( $conn, $query , $params, $options );
    $row_countlast = sqlsrv_num_rows( $sql );
    if ($row_countlast == 0) {
        echo "<table width=\"450\" id=\"lastantrian\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\" style=\"table-layout:fixed\" ></table>";
    } else {
        if ($sql){
            echo "<table width=\"450\" id=\"lastantrian\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\" style=\"table-layout:fixed\" >";
            while($rs = sqlsrv_fetch_array($sql)){
                echo "
                <tr>
                <td width='200px' align='center' >".$rs['Id_Ruang']."</td>
                <td width='200px' align='center' >".$rs['kode']."</td>
                <td width='200px' align='center'>".$rs['nomor_antrian']."</td>
                ";
            }
        }
        echo"</table>";
    }
    ?>

    <script>
        function call() {
            var antrian2 = document.getElementById('antrianList2');
            var id = antrian2.rows[1].cells[1].innerHTML;
            var nomor = antrian2.rows[1].cells[2].innerHTML;
            var selip = antrian2.rows[1].cells[3].innerHTML;
            var gantinomor = 0;

            if (selip=='y') {
                gantinomor = 0;
            } else {
                gantinomor = 1;
            }

            var idruang = "<?php echo $idruang ?>";
            var kode = "<?php echo $kode ?>";
            window.location.href = "callantrian.php?id="+id+"&idruang="+idruang+"&kode="+kode+"&nomor="+nomor+"&gantinomor="+gantinomor;
        }

        function skip() {
            var antrian = document.getElementById('antrianList');
            var id = antrian.rows[1].cells[1].innerHTML;
            window.location.href = "skipantrian.php?id="+id;

            var rowCount = antrian.rows.length;
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

            $.post("ubahurutan.php", {'myData': arr1}, function(data, status){});
            var iframe = parent.document.getElementById('antrianskip');
            iframe.src = iframe.src;
            var iframe = parent.document.getElementById('emergency');
            iframe.src = iframe.src;
        }

        function complete() {

            var antrian = document.getElementById('antrianList');
            var id = antrian.rows[1].cells[1].innerHTML;
            window.location.href = "completeantrian.php?id="+id;

            var rowCount = antrian.rows.length;
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

            $.post("ubahurutan.php", {'myData': arr1}, function(data, status){});
            var iframe = parent.document.getElementById('antrianskip');
            iframe.src = iframe.src;
            var iframe = parent.document.getElementById('emergency');
            iframe.src = iframe.src;

        }

        function cancel() {
            if (confirm('Apa anda yakin membatalkan antrian?')) {
                var antrian = document.getElementById('antrianList');
                var id = antrian.rows[1].cells[1].innerHTML;
                window.location.href = "cancelantrian.php?id="+id;

                var rowCount = antrian.rows.length;
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

                $.post("ubahurutan.php", {'myData': arr1}, function(data, status){});
                var iframe = parent.document.getElementById('antrianskip');
                iframe.src = iframe.src;
                var iframe = parent.document.getElementById('emergency');
                iframe.src = iframe.src;
                jalan = 1;
            } else {
                //do nothing
            }
        }

        function reload() {                                                   //refresh and action function

            var antrian = document.getElementById('antrianList');             //tabel antrian live
            var antrian1 = document.getElementById('antrianList1');           //tabel antrian 1
            var antrian2 = document.getElementById('antrianList2');           //tabel antrian 2
            var antrian3 = document.getElementById('antrianList3');           //tabel antrian 3
            var lastantrian = document.getElementById('lastantrian');         //tabel antrian last

            var rowCount = antrian.rows.length;
            var rowCount1 = antrian1.rows.length;
            var rowCount2 = antrian2.rows.length;
            var rowCount3 = antrian3.rows.length;
            //kondisi 1 =======================berlaku di tabel antrian3
            if (rowCount3>1) {
                var j;
                var arr1 = [];
                var arr2 = [];
                for (i = 1 ; i < rowCount3 ; i++) {
                    var urut3 = antrian3.rows[i].cells[0].innerHTML;    //}
                    var id3 = antrian3.rows[i].cells[1].innerHTML;      //}
                    var idr3 = antrian3.rows[i].cells[2].innerHTML;     //}
                    var no3 = antrian3.rows[i].cells[3].innerHTML;      // tabel antrian 3
                    var stat3 = antrian3.rows[i].cells[4].innerHTML;    //}
                    var selip3 = antrian3.rows[i].cells[5].innerHTML;   //}
                    var flage3 = antrian3.rows[i].cells[6].innerHTML;   //}
                    var baru = antrian3.rows[i].cells[7].innerHTML;     //}
                    if (baru == 'y') {
                        j = i - 1;
                        arr2 = [];

                        arr2[0] =  urut3;
                        arr2[1] =  id3;
                        arr2[2] =  idr3;
                        arr2[3] =  no3;
                        arr2[4] =  stat3;
                        arr2[5] =  selip3;
                        arr2[6] =  flage3;

                        arr1[j] = arr2;
                    }
                }
                $.post("masukantrianclient.php", {'myData': arr1}, function(data, status){});
            }
            //======================================================================================

            var hitungmin = 0;

            //kondisi 2 ==============================berlaku di tabel antrian 1
            if (rowCount1>1) {
                var urut1 = antrian1.rows[1].cells[0].innerHTML;      //}
                var id1 = antrian1.rows[1].cells[1].innerHTML;        //tabel antrian 1
                var nomor1 = antrian1.rows[1].cells[2].innerHTML;      //}

                var bdgNo1;

                if (nomor1.length == 5) {
                    bdgNo1 = Number(nomor1.substring(3));
                } else if (nomor1.length == 6) {
                    bdgNo1 = Number(nomor1.substring(4));
                }

                var loop = rowCount2;

                for (i = 1 ; i < loop ; i++) {
                    var urut2 = antrian2.rows[i].cells[0].innerHTML;    //
                    var id2 = antrian2.rows[i].cells[1].innerHTML;      //tabel antrian 2
                    var nomor2 = antrian2.rows[i].cells[2].innerHTML;   //
                    var selip = antrian2.rows[i].cells[3].innerHTML;    //

                    if (nomor2.length == 5) {
                        var bdgNo2 = Number(nomor2.substring(3));
                    } else if (nomor2.length == 6) {
                        var bdgNo2 = Number(nomor2.substring(4));
                    }
                    //kondisi 2.1 ==============================berlaku di tabel antrian
                    if (selip == 'y') {
                        hitungmin = hitungmin + 1;
                    } else {
                        if (bdgNo1 > bdgNo2) {
                            hitungmin = hitungmin + 1;
                        } else {
                            break;
                        }
                    }
                }


                if (hitungmin == 0) {
                    var status = antrian3.rows[1].cells[4].innerHTML;

                    if (status == 'y'){
                        //alert('1');
                        window.location.href = "cekurutmasukselip.php?id="+id1;
                    } else {
                        //alert('2');
                        var idnya = id1;
                        var nomor = nomor1;
                        var selip = 0;

                        if (rowCount2>0) {
                            var j;
                            var arr1 = [];
                            var arr2 = [];

                            for (i = 1; i < rowCount2; i++) {
                                j = i - 1;
                                arr2 = [];

                                urutan = antrian2.rows[i].cells[0].innerHTML;
                                id = antrian2.rows[i].cells[1].innerHTML;

                                arr2[0] =  urutan;
                                arr2[1] =  id;

                                arr1[j] = arr2;
                            }

                            window.location.href = "cekurutanmasuk.php?id="+idnya+"&selip="+selip+"&nomor="+nomor+"&rowCount="+rowCount2;

                            $.post("selipantrian.php", {'myData': arr1, 'selip':selip}, function(data, status){});
                        }
                    }
                } else {
                    var status = antrian3.rows[1].cells[4].innerHTML;
                    if (status == 'y'){
                        var flagee = antrian2.rows[1].cells[5].innerHTML;
                        if (flagee=='x') {                                        //flagee x "emergency naik"
                            var nomor2 = antrian2.rows[1].cells[2].innerHTML;

                            if (nomor2.length == 5) {
                                var bdgNo2 = Number(nomor2.substring(3));
                            } else if (nomor2.length == 6) {
                                var bdgNo2 = Number(nomor2.substring(4));
                            }

                            if (bdgNo1<bdgNo2) {
                                //alert('3');
                                var nomorakhir = lastantrian.rows[0].cells[2].innerHTML;
                                if (nomorakhir.length == 5) {
                                    var bdglast = Number(nomorakhir.substring(3));
                                } else if (nomor2.length == 6) {
                                    var bdglast = Number(nomorakhir.substring(4));
                                }

                                if (bdgNo1 > bdglast) {
                                    var idnya = id1;
                                    var nomor = nomor1;
                                    var selip = hitungmin;

                                    if (rowCount2>0) {
                                        var j;
                                        var arr1 = [];
                                        var arr2 = [];

                                        for (i = 1; i < rowCount2; i++) {
                                            j = i - 1;
                                            arr2 = [];

                                            urutan = antrian2.rows[i].cells[0].innerHTML;
                                            id = antrian2.rows[i].cells[1].innerHTML;

                                            arr2[0] =  urutan;
                                            arr2[1] =  id;

                                            arr1[j] = arr2;
                                        }

                                        window.location.href = "cekurutanmasuk.php?id="+idnya+"&selip="+selip+"&nomor="+nomor+"&rowCount="+rowCount2;

                                        $.post("selipantrian.php", {'myData': arr1, 'selip':selip}, function(data, status){});
                                    }
                                } else if (bdgNo1 < bdglast) {
                                  window.location.href = "cekurutmasukselip.php?id="+id1;
                                }else {
                                    window.location.href = "cekurutmasukselip.php?id="+id1;
                                }

                            } else {
                                //alert('4');
                                var idnya = id1;
                                var nomor = nomor1;
                                var selip = hitungmin;

                                if (rowCount2>0) {
                                    var j;
                                    var arr1 = [];
                                    var arr2 = [];

                                    for (i = 1; i < rowCount2; i++) {
                                        j = i - 1;
                                        arr2 = [];

                                        urutan = antrian2.rows[i].cells[0].innerHTML;
                                        id = antrian2.rows[i].cells[1].innerHTML;

                                        arr2[0] =  urutan;
                                        arr2[1] =  id;

                                        arr1[j] = arr2;
                                    }

                                    window.location.href = "cekurutanmasuk.php?id="+idnya+"&selip="+selip+"&nomor="+nomor+"&rowCount="+rowCount2;

                                    $.post("selipantrian.php", {'myData': arr1, 'selip':selip}, function(data, status){});
                                }
                            }
                        } else {
                            //alert('5');
                            var nomor2 = antrian2.rows[1].cells[2].innerHTML;

                            if (nomor2.length == 5) {
                                var bdgNo2 = Number(nomor2.substring(3));
                            } else if (nomor2.length == 6) {
                                var bdgNo2 = Number(nomor2.substring(4));
                            }

                            if (bdgNo1<bdgNo2) {
                                //alert('6');
                                window.location.href = "cekurutmasukselip.php?id="+id1;
                            }else {
                                //alert('7');
                                var idnya = id1;
                                var nomor = nomor1;
                                var selip = hitungmin;

                                if (rowCount2>0) {
                                    var j;
                                    var arr1 = [];
                                    var arr2 = [];

                                    for (i = 1; i < rowCount2; i++) {
                                        j = i - 1;
                                        arr2 = [];

                                        urutan = antrian2.rows[i].cells[0].innerHTML;
                                        id = antrian2.rows[i].cells[1].innerHTML;

                                        arr2[0] =  urutan;
                                        arr2[1] =  id;

                                        arr1[j] = arr2;
                                    }

                                    window.location.href = "cekurutanmasuk.php?id="+idnya+"&selip="+selip+"&nomor="+nomor+"&rowCount="+rowCount2;

                                    $.post("selipantrian.php", {'myData': arr1, 'selip':selip}, function(data, status){});
                                }
                            }

                        }
                    } else {
                        var nomor2 = antrian2.rows[1].cells[2].innerHTML;

                        if (nomor2.length == 5) {
                            var bdgNo2 = Number(nomor2.substring(3));
                        } else if (nomor2.length == 6) {
                            var bdgNo2 = Number(nomor2.substring(4));
                        }

                        if (bdgNo1<bdgNo2) {
                            //alert('8');
                            window.location.href = "cekurutmasukselip.php?id="+id1;
                        }
                        else {
                            //alert('9');
                            var idnya = id1;
                            var nomor = nomor1;
                            var selip = hitungmin;

                            if (rowCount2>0) {
                                var j;
                                var arr1 = [];
                                var arr2 = [];

                                for (i = 1; i < rowCount2; i++) {
                                    j = i - 1;
                                    arr2 = [];

                                    urutan = antrian2.rows[i].cells[0].innerHTML;
                                    id = antrian2.rows[i].cells[1].innerHTML;

                                    arr2[0] =  urutan;
                                    arr2[1] =  id;

                                    arr1[j] = arr2;
                                }

                                window.location.href = "cekurutanmasuk.php?id="+idnya+"&selip="+selip+"&nomor="+nomor+"&rowCount="+rowCount2;

                                $.post("selipantrian.php", {'myData': arr1, 'selip':selip}, function(data, status){});
                            }
                        }

                        //test
                        var flagge1 = antrian2.rows[1].cells[5].innerHTML;

                        // if (status == 'y') {
                        //   if (flagge1 == '7') {
                        //     if (bdgNo1>bdgNo2 && flagge1 != '7') {
                        //       window.location.href = "cekurutmasukselip.php?id="+id1;
                        //     }
                        //
                        //   }
                        //
                        // }



                    }
                }

            }

            //menampilkan antrian yang asli
            if (rowCount>1) {
                if (antrian.rows[1].cells[0].innerHTML == 'Tidak ada antrian') {

                } else {
                    var status = antrian.rows[1].cells[7].innerHTML;
                    if (status=='x') {
                        antrian.rows[1].cells[5].innerHTML="";
                        antrian.rows[1].cells[4].innerHTML="";
                    }
                }
            }

            parent.row_countantri = antrian.rows[1].cells[0].innerHTML;

            var iframe = parent.document.getElementById('antrianskip');
            iframe.src = "tablelistantrianskip.php";

            kembaliflage();
        }

        function kembaliflage() {
            var antrian = document.getElementById('antrianList3');
            var rowCount3 = antrian.rows.length;

            for (i = 2 ; i < rowCount3 ; i++) {
                var cekflage = antrian.rows[i].cells[6].innerHTML;
                var id = antrian.rows[i].cells[1].innerHTML;

                if (cekflage == ' ') {
                    window.location.href = "balikflage.php?id="+id;
                    break;
                }
            }
        }
    </script>
</body>
