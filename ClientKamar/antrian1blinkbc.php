<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Antrian</title>
  <style>
  /*body{
    background: url('Images/Display antrian POLI 7 - 1on.jpg');
    background-repeat: no-repeat;
    background-size: cover;
    font-size: 54;
    }*/

    h1 {
      font-size: 350px;
      font-family: "Arial Bold", Arial, Sans-serif;
    }

    blink {
     color:#33cc00;
     -webkit-animation: blink 1s step-end infinite;
     animation: blink 1s step-end infinite;
   }

   @-webkit-keyframes blink {
     67% { opacity: 0 }
   }

   @keyframes blink {
     67% { opacity: 0 }
   }
 </style>

 <?php 
 include "koneksi.php";
 ?>

</head>


<body onload="updatedata(), movepage()">
 <table id="myTable">
  <tr height=23>
    <td width=35></td>
    <td width=1810></td>
  </tr>
  <tr height=880>
    <td></td>
    <td align=center bgcolor="#000000"></td>
  </tr>
</table>

<?php

date_default_timezone_set('Asia/Jakarta');
$tgl = DATE('Y M d');

$terminal = $_SERVER['REMOTE_ADDR'];

$idruang = $_GET['idruang'];
// $kode = $_GET['kode'];

// $query = "SELECT kode FROM qp7STATUSRUANG WHERE Id_Ruang='".$idruang."'";
// $params = array();
// $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
// $sql = sqlsrv_query( $conn, $query , $params, $options );
// if ($sql){
//   while($rs = sqlsrv_fetch_array($sql)){
//     $kode = $rs['kode'];
//   }
// }

$terminal = $_SERVER['REMOTE_ADDR'];

$query = "SELECT kode FROM qp7STATUSRUANG WHERE Id_Ruang='".$idruang."' AND terminal='".$terminal."' AND tgl_antrian='".$tgl."' AND Jam_Tutup_Ruang is null";
    // echo $query;
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$sql = sqlsrv_query( $conn, $query , $params, $options );
if ($sql){
  while($rs = sqlsrv_fetch_array($sql)){
    $kode = $rs['kode'];
  }
}

$datesave = date('Y/m/d');
$query = "SELECT nomor_antrian FROM qp7antriana where Id_Ruang = '".$idruang."' AND nomor_antrian like'".$kode."%' ORDER BY Urutan ASC";
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$sql = sqlsrv_query( $conn, $query , $params, $options );
$row_count = sqlsrv_num_rows( $sql );
if ($sql){
  echo "
  <table id=\"tabelAntrian\" border=\"1\" hidden>
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

$sql = "UPDATE QP7STATUSRUANG SET Status=3 WHERE Id_Ruang='".$idruang."' AND kode='".$kode."' AND terminal = '".$terminal."' AND tgl_antrian='".$tgl."' AND Jam_Tutup_Ruang is null";
$sql_execute = sqlsrv_query($conn,$sql);
?>

<script>
  function updatedata() {
    var tabel = document.getElementById("tabelAntrian");
    var myTable = document.getElementById("myTable");
    var rowCount = tabel.rows.length;
    var r = rowCount - 1;
    for (i = 0; i < r; i++) {
      if (i==0) {
        var a0 = tabel.rows[1].cells[0].innerHTML;
        myTable.rows[1].cells[1].innerHTML = "<h1><blink>" + a0 + "</blink></h1>";
      }
    }
  }

  var idruang = "<?php echo $idruang ?>";
  var kode = "<?php echo $kode ?>";

  document.body.style.background = "url('Images/Display antrian kamar dokter BC - on.jpg')"; 

  function movepage() {
    setTimeout(
      function() {
        window.location.href="antrian1showbc.php?idruang="+idruang;
      }, 15000);
  }
</script>

</body>
</html>