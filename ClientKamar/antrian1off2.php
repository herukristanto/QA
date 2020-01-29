<!DOCTYPE html>
<html>
<head>
  <title>Antrian</title>
  <meta http-equiv="refresh" content="5" >
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <script src="script/jquery-1.12.4.js"></script>
  <style>
  body{
    background-image: url('Images/Display antrian kamar dokterPoli 2 - off.jpg');
    background-repeat: no-repeat;
    background-size: cover;
    font-size: 54;
  }

  table{
    margin: 15px 0;
    table-layout: fixed;
    width: 100%;
  }

  h1 {
    font-size: 180px;
    font-family: "Arial Bold", Arial, Sans-serif;
  }

  h2 {
    font-size: 50px;
    font-family: "Arial Bold", Arial, Sans-serif;
  }

  h3 {
    font-size: 42px;
    font-family: "Arial Bold", Arial, Sans-serif;
  }

  h4 {
    font-size: 25px;
    font-family: "Arial Bold", Arial, Sans-serif;
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

$idruang = 'x';
$kode = 'x';

$query = "SELECT Id_Ruang, kode FROM QP7STATUSRUANG WHERE terminal = '".$terminal."' AND tgl_antrian='".$tgl."' AND Jam_Tutup_Ruang is null";
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$sql = sqlsrv_query( $conn, $query , $params, $options );
$row_count = sqlsrv_num_rows( $sql );
if ($row_count > 0) {
  while($rs = sqlsrv_fetch_array($sql)){
    $idruang = $rs['Id_Ruang'];
    $kode = $rs['kode'];
  }
}
?>

</head>


<body id="myBody" onload="updatedata();">
 <table id="myTable">
  <tr height=44>
    <td width=3%></td>
    <td width=20%></td>
    <td width=2%></td>
    <td width=20%></td>
    <td width=2%></td>
    <td width=11%></td>
    <td width=2%></td>
    <td width=11%></td>
    <td width=1%></td>
    <td width=12%></td>
    <td width=1%></td>
    <td width=12%></td>
    <td width=3%></td>
  </tr>
  <tr height=140>
    <td></td>
    <td align=center colspan=3 rowspan=7></td>
    <td></td>
    <td align=center></td>
    <td></td>
    <td align=center></td>
    <td></td>
    <td align=center></td>
    <td></td>
    <td align=center></td>
    <td></td>
  </tr>
  <tr height=25>
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
  <tr height=145>
    <td></td>
    <td></td>
    <td align=center></td>
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
  </tr>
  <tr height=140>
    <td></td>
    <td></td>
    <td align=center></td>
    <td></td>
    <td align=center></td>
    <td></td>
    <td align=center></td>
    <td></td>
    <td align=center></td>
    <td></td>
  </tr>
  <tr height=25>
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
  <tr height=70>
    <td></td>
    <td></td>
    <td rowspan="3" align=center></td>
    <td></td>
    <td rowspan="3" align=center></td>
    <td></td>
    <td rowspan="3" align=center></td>
    <td></td>
    <td rowspan="3" align=center></td>
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
    <td></td>
  </tr>
  <tr height=50>
    <td></td>
    <td rowspan="3" align=center></td>
    <td></td>
    <td rowspan="3" align=center></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr height=22>
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
  <tr height=145>
    <td></td>
    <td></td>
    <td></td>
    <td align=center></td>
    <td></td>
    <td align=center></td>
    <td></td>
    <td align=center></td>
    <td></td>
    <td align=center></td>
    <td></td>
  </tr>
  <tr height=150>
    <td align=center colspan=9></td>
    <td align=right colspan=3><h4><?php echo $tanggal ?>&nbsp;<?php echo $bulan ?>&nbsp;<?php echo $tahun ?><br><?php echo $waktu ?></h4></td>
    <td></td>
  </tr>
</table>

<?php
if ($idruang != 'x') {
  $query = "SELECT status FROM qp7STATUSRUANG WHERE Id_Ruang='".$idruang."' AND kode='".$kode."' AND terminal='".$terminal."' AND tgl_antrian='".$tgl."' AND Jam_Tutup_Ruang is null";
  $params = array();
  $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
  $sql = sqlsrv_query( $conn, $query , $params, $options );
  $row_count = sqlsrv_num_rows( $sql );
  if ($row_count > 0){
    while($rs = sqlsrv_fetch_array($sql)){
      $status = $rs['status'];
    }
  }

  $query = "SELECT Nama_Poli FROM QP7RUANG WHERE Id_Ruang='".$idruang."'";
  $params = array();
  $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
  $sql = sqlsrv_query( $conn, $query , $params, $options );
  $row_count = sqlsrv_num_rows( $sql );
  if ($row_count > 0) {
    while($rs = sqlsrv_fetch_array($sql)){
      $poli = $rs['Nama_Poli'];
    }
  }
} else {
  $status = '0';
  $poli = '';
}
?>

<script>
  function updatedata() {
    var status = "<?php echo $status ?>";
    var idruang = "<?php echo $idruang ?>";
    var poli = "<?php echo $poli ?>";
    var kode = "<?php echo $kode ?>";

    if (status=='1') {
      if (poli=='BREAST CENTER') {
        window.location.href="antrian1bc.php?idruang="+idruang;
      } else if (poli=='POLIKLINIK 7') {
        window.location.href="antrian1.php?idruang="+idruang;
      } else if (poli=='SKIN CENTER') {
        window.location.href="antrian1sc.php?idruang="+idruang;
      } else if (poli=='POLIKLINIK 2') {
        window.location.href="antrian12.php?idruang="+idruang;
      }
    }
  }
</script>

</body>
</html>
