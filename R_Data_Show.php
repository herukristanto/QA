
<?php

error_reporting(0);
include "koneksi.php";


if (isset($_GET['filter'])) {

  $bulan    = $_GET['bulan'];
  $tahun    = $_GET['tahun'];
  $unit    = $_GET['unit'];

 // echo "$bulan";
 // echo "$tahun";

  if (isset($bulan) AND isset($tahun) AND isset($unit)) {
    $query = "SELECT * FROM T_Kejadian WHERE month(Tgl)= $bulan AND YEAR(Tgl)= $tahun AND kode_u = $unit ORDER BY Indikator ASC";
  }
  
   $data    = sqlsrv_query($conn, $query);
   $no=1;

   echo "

      <table id=\"TableDetail\" class='table table-striped table-bordered table-hover'>
        <thead>
        <tr>
       <th>No</th>
         <th>Indikator</th>
         <th>Tanggal</th>
         <th>Jumlah</th>
         <th>Numerator</th>
         <th>Denominator</th>
         <th>Hasil</th>
         <th>Analisa</th>
         <th>Tindak Lanjut</th>
       </tr>
        </thead>

        <tbody>";

        while($row = sqlsrv_fetch_array($data)){
          $kodeindi = $row['Indikator'];
          $jmlh = $row['Jml'];
          $numtor = $row['Numerator'];
          $dentor = $row['Denominator'];
          $bagi = $numtor / $dentor;
          $hasil = round($bagi, 2);
          $analis = $row['Analisa'];
          $tndklanjt = $row['Tindak_Lanjut'];
          $tgl = $row['Tgl']->format('d/m/Y');
          $jam = $row['Tgl']->format('H:i:s');

             echo "
             <tr>
               <td>".$no++."</td>
               <td>$kodeindi</td>
               <td class='center' >$tgl</td>
               <td class='center' style='text-align: center;'>$jmlh</td>
               <td class='center' style='text-align: center;'>$numtor</td>
               <td class='center' style='text-align: center;'>$dentor</td>
               <td class='center' style='text-align: center;'>$hasil</td>
               <td class='center'>$analis</td>
               <td class='center'>$tndklanjt</td>

             </tr>
             </tbody>
             </tabel>";
           }
        }

    ?>

   <script>
   </script>

   <script src="js/jquery-1.7.2.min.js"></script>
