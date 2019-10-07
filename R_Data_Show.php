
<?php

error_reporting(0);
include "koneksi.php";
if (isset($_POST['filter'])) {

  $bulan    = $_POST['bulan'];
  $tahun    = $_POST['tahun'];

 echo "$bulan";
 echo "$tahun";

   if (isset($bulan) OR isset($tahun)) {
    $query = "SELECT * FROM T_Kejadian WHERE month(Tgl)= $bulan AND YEAR(Tgl)= $tahun ORDER BY Indikator ASC";
   }

   $data    = sqlsrv_query($conn, $query);
   $no=1;

   echo "

      <table class='table table-striped table-bordered table-hover'>
        <thead>
        <tr>
       <th>No</th>
          <th>Tanggal</th>
          <th>Jam</th>
         <th>Indikator</th>
         <th>Jumlah</th>
         <th>Numerator</th>
         <th>Denominator</th>
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
          $analis = $row['Analisa'];
          $tndklanjt = $row['Tindak_Lanjut'];
          $tgl = $row['Tgl']->format('d/m/Y');
          $jam = $row['Tgl']->format('H:i:s');

             echo "
             <tr>
               <td>".$no++."</td>
               <td class='center' >$tgl</td>
               <td class='center' style='text-align: center;'>$jam</td>
               <td class='center' style='text-align: center;'>$kodeindi</td>
               <td class='center' style='text-align: center;'>$jmlh</td>
               <td class='center' style='text-align: center;'>$numtor</td>
               <td class='center'>$dentor</td>
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
