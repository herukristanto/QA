

<?php
error_reporting(0);
include "koneksi.php";
 $unit    = $_POST['kode_u'];
 $data    = "";
 if(!empty($unit)){
   $query   = "SELECT DISTINCT kode_indikator, Kategori FROM V_Indikator_Kejadian WHERE kode_u= '$unit' ORDER BY kode_indikator ASC";
   $data    = sqlsrv_query($conn, $query);

   $no=1;

     echo "
     <table class='table table-striped table-bordered table-hover'>
       <thead>
       <tr>
       <th>No</th>
       <th>Indikator</th>
       <th>Jumlah</th>
       <th>Numerator</th>
       <th>Denominator</th>
       <th>Analisa</th>
       <th>Tindak Lanjut</th>
       <th>Action</th>
       </tr>
       </thead>
     <tbody>";

     while($row     = sqlsrv_fetch_array($data)){
       $kodeindi = $row['kode_indikator'];
       $query1      = "SELECT COUNT(kode_indikator) as jml FROM V_Indikator_Kejadian WHERE kode_indikator= '$kodeindi'";
       $data1       = sqlsrv_query($conn, $query1);
       while($row1  = sqlsrv_fetch_array($data1)){
          $jumlh = $row1['jml'];

          $total 	= $total + $jumlh;

       echo "
      <tr>
        <td>".$no++."</td>
        <td class='center'>".$kodeindi."-".$row['Kategori']."</td>
        <td class='center'>$jumlh</td>
        <td class='center'></td>
        <td class='center'></td>
        <td class='center'></td>
        <td class='center'></td>
        <td class='center'>
          <a id='myBtn' class='btn btn-success'><i class='fa fa-plus'></i> Add</a>
        </td>
      </tr>
      </tbody>
      </tabel>
      ";

    }}}
echo "
<tr>
<td class='center'></td>
<td class='center' style=font-weight:bold;;font-size:14px;>Total</td>
<td class='center' style=font-weight:bold;;font-size:14px;>$total</td>
<td class='center'></td>
<td class='center'></td>
<td class='center'></td>
<td class='center'></td>
<td class='center'></td>
</tr>";
   ?>
