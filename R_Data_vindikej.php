
<?php
error_reporting(0);
include "koneksi.php";
 $unit    = $_POST['kode_u'];
 $bulan    = $_POST['bulan'];
 $tahun    = $_POST['tahun'];


 if(!empty($unit)){
   // if(!empty($bulan)){
   //   if(!empty($tahun)){
   $query   = "SELECT DISTINCT kode_indikator, Kategori FROM V_Indikator_Kejadian WHERE kode_u= '$unit'  ORDER BY kode_indikator ASC"; //OR month(tgl_input)='$bulan' OR year(tgl_input)='$tahun'
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
         $kategori = $row['Kategori'];
         $query1      = "SELECT COUNT(kode_indikator) as jml FROM V_Indikator_Kejadian WHERE kode_indikator= '$kodeindi'";
         $data1       = sqlsrv_query($conn, $query1);

         while($row1  = sqlsrv_fetch_array($data1)){
           $jumlh = $row1['jml'];
           $total 	= $total + $jumlh;

            echo "
            <tr>
              <td>".$no++."</td>
              <td class='center' >".$kodeindi."-".$kategori."</td>
              <td class='center'>$jumlh</td>
              <td class='center'></td>
              <td class='center'></td>
              <td class='center'></td>
              <td class='center'></td>
              <td class='center' id='myBtn'>

                <button type='button' class='btn btn-success' data-toggle='modal'
                 onClick='datapost(\"$kodeindi - $kategori\", \"$jumlh\")' data-target='#myModal'>Add</button>
              </td>
            </tr>
            </tbody>
            </tabel>";
          }
        }
      }

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

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Input Indikator Mutu</h4>
        </div>
        <div class="modal-body">
          <label for="">Indikaor</label>
          <input type="text" id="kodeindi"  name="" value="" style="height: 26px;">
          <label for="">Jumlah</label>
          <input type="text" name="" id="jumlah" value="" style="height: 26px;">
          <label for="">Numerator</label>
          <input type="text" name="" value="" style="height: 26px;">
          <label for="">Denominator</label>
          <input type="text" name="" value="" style="height: 26px;">
          <label for="">Analisa</label>
          <input type="text" name="" value="" style="height: 26px;">
          <label for="">Tindak Lanjut</label>
          <input type="text" name="" value="" style="height: 26px;">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal">Save</button>
        </div>
      </div>

    </div>
  </div>

   <script>
      function datapost(indikate, jumlah){
        document.getElementById('kodeindi').value=indikate;
        document.getElementById('jumlah').value=jumlah;
      }
   </script>
   <script src="js/jquery-1.7.2.min.js"></script>
