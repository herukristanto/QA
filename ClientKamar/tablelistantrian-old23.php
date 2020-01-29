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


    $query = "SELECT Urutan, Id, nomor_antrian, status FROM QP7ANTRIANA WHERE Id_Ruang like '".$idruang."' AND nomor_antrian like '".$kode."%' ORDER BY Urutan ASC";
    $params = array();
    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $sql = sqlsrv_query( $conn, $query , $params, $options );
    $row_count = sqlsrv_num_rows( $sql );
    if ($row_count == 0) {
        echo "
        <table width=\"530\" id=\"antrianList\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\" style=\"table-layout:fixed\">
        <tr>
        <td bgcolor='#999999' align='center'>Urutan</td>

        <td bgcolor='#999999' align='center'>Nomor Antrian</td>
        <td align=\"center\" colspan=\"4\" bgcolor='#999999'>Action</td>

        </tr>
        <tr>
        <td colspan='6' align=center>Tidak ada antrian</td>
        </tr>
        </table><br><br>";
    } else {
        if ($sql){
            echo "
            <table width=\"530\" id=\"antrianList\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\" style=\"table-layout:fixed\">
            <tr>
            <td bgcolor='#999999' align='center'>Urutan</td>

            <td bgcolor='#999999' align='center'>Nomor Antrian</td>
            <td align=\"center\" colspan=\"4\" bgcolor='#999999'>Action</td>

            </tr>";
              while($rs = sqlsrv_fetch_array($sql)){
                  if ($rs['Urutan'] == 1) {
                      echo "
                      <tr>
                      <td width='50px' align='center' bgcolor='#ffcccc'>".$rs['Urutan']."</td>

                      <td width='200px' bgcolor='#ffcccc' align='center'>".$rs['nomor_antrian']."</td>


                      <td><button onclick='call();'>Call</button></td>

                      <td><button onclick='skip();'>Skip</button></td>

                      <td><button onclick='complete();'>Complete</button></td>

                      <td><button onclick='cancel();'>Cancel</button></td>



                      </tr>  ";
                    } else {
                        echo "
                        <tr>
                        <td width='50px' align='center' align='center'>".$rs['Urutan']."</td>

                        <td width='200px' align='center'>".$rs['nomor_antrian']."</td>
                        </tr>

                        ";
                    }
                }
                echo"</table>";
            }






    }

  ?>
</body>
