<!DOCTYPE html>
<html>
<head>
  <title>Antrian</title>
  <meta http-equiv="refresh" content="1" >
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <script src="script/jquery-1.12.4.js"></script>
  <style>

  body{
    background-image: url('Images/Display antrian kamar dokter 2 - on.jpg');
    background-repeat: no-repeat;
  }

  table{
    margin: 15px 0;
    table-layout: fixed;
    /*width: 100%;*/
  }

  h1 {
    font-size: 200px;
    font-family: "Arial Bold", Arial, Sans-serif;
    margin-top: 0em;
    margin-bottom: 0em;
    margin-left: 0;
    margin-right: 0;
    font-weight: bold;
  }

  h2 {
    font-size: 70px;
    font-family: "Arial Bold", Arial, Sans-serif;
    margin-top: 0em;
    margin-bottom: 0em;
    margin-left: 0;
    margin-right: 0;
    font-weight: bold;
  }

  h5 {
    font-size: 90px;
    font-family: "Arial Bold", Arial, Sans-serif;
    color: yellow;
    margin-top: 0em;
    margin-bottom: 0em;
    margin-left: 0;
    margin-right: 0;
    font-weight: bold;
  }

  h3 {
    font-size: 70px;
    font-family: "Arial Bold", Arial, Sans-serif;
    margin-top: 0em;
    margin-bottom: 0em;
    margin-left: 0;
    margin-right: 0;
    font-weight: bold;
  }

  h4 {
    font-size: 40px;
    font-family: "Arial Bold", Arial, Sans-serif;
    margin-top: 0em;
    margin-bottom: 0em;
    margin-left: 0;
    margin-right: 0;
    font-weight: bold;
  }

</style>

<?php
include "koneksi.php";

date_default_timezone_set('Asia/Jakarta');
$date = DATE('d M Y H:i:s');
$hari = DATE('D');
$tanggal = DATE('d');
$bulan = DATE('F');
$tahun = DATE('Y');
$waktu = DATE('H:i:s');
$tgl = DATE('Y M d');

$terminal = $_SERVER['REMOTE_ADDR'];
?>

</head>

<!-- <body id="myBody"> -->
  <body id="myBody" onload="updatedata()">
    <table id="myTable">

      <tr height=45>
        <td width=57></td>
        <td width=370></td>
        <td width=40></td>
        <td width=365></td>
        <td width=28></td>
        <td width=295></td>
        <td width=25></td>
        <td width=290></td>
        <td width=25></td>
        <td width=290></td>
        <td width=50></td>
      </tr>
      <tr height=180>
        <td></td>
        <td colspan=3 rowspan=5 align=center></td>
        <td></td>
        <td align=center></td>
        <td></td>
        <td align=center></td>
        <td></td>
        <td align=center></td>
        <td></td>
      </tr>
      <tr height=30>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr height=180>
        <td></td>
        <td></td>
        <td align=center></td>
        <td></td>
        <td align=center></td>
        <td></td>
        <td align=center></td>
        <td></td>
      </tr>
      <tr height=30>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr height=110>
        <td></td>
        <td></td>
        <td rowspan=3 align=center></td>
        <td></td>
        <td rowspan=3 align=center></td>
        <td></td>
        <td rowspan=3 align=center></td>
        <td></td>
      </tr>
      <tr height=20>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr height=50>
        <td></td>
        <td rowspan=3 align=center></td>
        <td></td>
        <td rowspan=3 align=center></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr height=30>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr height=180>
        <td></td>
        <td></td>
        <td></td>
        <td align=center></td>
        <td></td>
        <td align=center></td>
        <td></td>
        <td align=center></td>
        <td></td>
      </tr>
      <tr height=30>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr height=100>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td colspan=2 align=right><h4><?php echo $tanggal ?>&nbsp;<?php echo $bulan ?>&nbsp;<?php echo $tahun ?>&nbsp;<br><?php echo $waktu ?>&nbsp;</h4></td>
      </tr>
    </table>

    <?php

    $idruang = $_GET['idruang'];
    // $kode = $_GET['kode'];
    $datesave = date('Y/m/d');
    $terminal = $_SERVER['REMOTE_ADDR'];

    $query = "SELECT terminal FROM qp7STATUSRUANG WHERE Id_Ruang='".$idruang."' AND terminal='".$terminal."' AND tgl_antrian='".$tgl."' AND Jam_Tutup_Ruang is null";
    // echo $query;
    $params = array();
    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $sql = sqlsrv_query( $conn, $query , $params, $options );
    $row_count = sqlsrv_num_rows( $sql );
    if ($row_count == 0) {
      $status = 0;
    } else {
      $query = "SELECT Status, kode FROM qp7STATUSRUANG WHERE Id_Ruang='".$idruang."' AND terminal='".$terminal."' AND tgl_antrian='".$tgl."' AND Jam_Tutup_Ruang is null";
      $params = array();
      $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
      $sql = sqlsrv_query( $conn, $query , $params, $options );
      if ($sql){
        while($rs = sqlsrv_fetch_array($sql)){
          $status = $rs['Status'];
          $kode = $rs['kode'];
        }
      }

      $query = "SELECT nomor_antrian, id, flage FROM qp7antrianaa where Id_Ruang = '".$idruang."' AND nomor_antrian like'".$kode."%' ORDER BY Urutan ASC";
      $params = array();
      $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
      $sql = sqlsrv_query( $conn, $query , $params, $options );
      $row_count = sqlsrv_num_rows( $sql );
      if ($sql){
        echo "
        <table id=\"tabelAntrian\" border=\"1\" hidden>
        <tr>
        <td>Nomor Antrian</td>
        <td>Id</td>
        <td>Flage</td>
        </tr>";
        while($rs = sqlsrv_fetch_array($sql)){
          echo "
          <tr>
          <td>".$rs['nomor_antrian']."</td>
          <td>".$rs['id']."</td>
          <td>".$rs['flage']."</td>
          </tr>
          ";
        }
        echo"</table>";
      }

      $query = "SELECT nomor_antrian FROM qp7antrianaa where Id_Ruang = '".$idruang."' AND nomor_antrian like'".$kode."%' AND flagee='x' ORDER BY Urutan ASC";
      $params = array();
      $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
      $sql = sqlsrv_query( $conn, $query , $params, $options );
      $row_count = sqlsrv_num_rows( $sql );
      if ($sql){
        echo "
        <table id=\"tabelAntrian1\" border=\"1\" hidden>
        <tr>
        <td>Nomor Antrian</td>
        </tr>";
        while($rs = sqlsrv_fetch_array($sql)){
          echo "
          <tr>
          <td>".$rs['nomor_antrian']."</td>
          </tr>
          ";
        }
        echo"</table>";
      }

      $query = "SELECT nomor_antrian FROM qp7antrianaa where Id_Ruang = '".$idruang."' AND nomor_antrian like'".$kode."%' AND flagee<>'x' ORDER BY Urutan ASC";
      $params = array();
      $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
      $sql = sqlsrv_query( $conn, $query , $params, $options );
      $row_count = sqlsrv_num_rows( $sql );
      if ($sql){
        echo "
        <table id=\"tabelAntrian2\" border=\"1\" hidden>
        <tr>
        <td>Nomor Antrian</td>
        </tr>";
        while($rs = sqlsrv_fetch_array($sql)){
          echo "
          <tr>
          <td>".$rs['nomor_antrian']."</td>
          </tr>
          ";
        }
        echo"</table>";
      }
    }

    ?>

    <script>
      function updatedata() {
        var status = "<?php echo $status ?>";
        var idruang = "<?php echo $idruang ?>";

        if (status!=0) {


          var tabel = document.getElementById("tabelAntrian");
          var tabel1 = document.getElementById("tabelAntrian1");
          var tabel2 = document.getElementById("tabelAntrian2");
          var myTable = document.getElementById("myTable");
          var rowCount = tabel.rows.length;
          var rowCount1 = tabel1.rows.length;
          var rowCount2 = tabel2.rows.length;
          var r = rowCount2;

          if (rowCount>1) {
            var nomoremg = tabel.rows[1].cells[2].innerHTML;
            var id = tabel.rows[1].cells[1].innerHTML;
          }

          if (nomoremg=='y' || nomoremg=='x') {
            window.location.href="ubahflage2.php?idruang="+idruang+"&id="+id;
          }

          if (rowCount1>1) {
            var emg = tabel1.rows[1].cells[0].innerHTML;
            myTable.rows[7].cells[1].innerHTML = "<h5>" + emg + "</h5>";
          }


          for (i = 0; i < r; i++) {
            if (i==0) {
              var a0 = '';
              myTable.rows[1].cells[1].innerHTML = "<h1>" + a0 + "</h1>";
            }

            if (i==1) {
              var a1 = tabel2.rows[1].cells[0].innerHTML;
              myTable.rows[7].cells[3].innerHTML = "<h5>" + a1 + "</h5>";
            }

            if (i==2) {
              var a2 = tabel2.rows[2].cells[0].innerHTML;
              myTable.rows[1].cells[3].innerHTML = "<h3>" + a2 + "</h3>";
            }

            if (i==3) {
              var a3 = tabel2.rows[3].cells[0].innerHTML;
              myTable.rows[1].cells[5].innerHTML = "<h3>" + a3 + "</h3>";
            }

            if (i==4) {
              var a4 = tabel2.rows[4].cells[0].innerHTML;
              myTable.rows[1].cells[7].innerHTML = "<h3>" + a4 + "</h3>";
            }

            if (i==5) {
              var a5 = tabel2.rows[5].cells[0].innerHTML;
              myTable.rows[3].cells[2].innerHTML = "<h3>" + a5 + "</h3>";
            }

            if (i==6) {
              var a6 = tabel2.rows[6].cells[0].innerHTML;
              myTable.rows[3].cells[4].innerHTML = "<h3>" + a6 + "</h3>";
            }

            if (i==7) {
              var a7 = tabel2.rows[7].cells[0].innerHTML;
              myTable.rows[3].cells[6].innerHTML = "<h3>" + a7 + "</h3>";
            }

            if (i==8) {
              var a8 = tabel2.rows[8].cells[0].innerHTML;
              myTable.rows[5].cells[2].innerHTML = "<h3>" + a8 + "</h3>";
            }

            if (i==9) {
              var a9 = tabel2.rows[9].cells[0].innerHTML;
              myTable.rows[5].cells[4].innerHTML = "<h3>" + a9 + "</h3>";
            }

            if (i==10) {
              var a10 = tabel2.rows[10].cells[0].innerHTML;
              myTable.rows[5].cells[6].innerHTML = "<h3>" + a10 + "</h3>";
            }

            if (i==11) {
              var a11 = tabel2.rows[11].cells[0].innerHTML;
              myTable.rows[9].cells[3].innerHTML = "<h3>" + a11 + "</h3>";
            }

            if (i==12) {
              var a12 = tabel2.rows[12].cells[0].innerHTML;
              myTable.rows[9].cells[5].innerHTML = "<h3>" + a12  + "</h3>";
            }

            if (i==13) {
              var a13 = tabel2.rows[13].cells[0].innerHTML;
              myTable.rows[9].cells[7].innerHTML = "<h3>" + a13  + "</h3>";
            }

          }
        }

        if (status=='0') {
          window.location.href="antrian1off2.php";
        } else if (status=='2') {
          window.location.href="antrian1blink2.php?idruang="+idruang;
        }
      }
    </script>

  </body>
  </html>
