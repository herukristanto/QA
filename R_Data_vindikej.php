
<?php
error_reporting(0);
include "koneksi.php";
 $unit    = $_POST['kode_u'];
 $bulan    = $_POST['bulan'];
 $tahun    = $_POST['tahun'];


 if(!empty($unit)){
   // if(!empty($bulan)){
   //   if(!empty($tahun)){
   $query   = "SELECT DISTINCT kode_indikator, Kategori, Numerator, Denominator FROM V_Indikator_Kejadian WHERE kode_u= '$unit' ORDER BY kode_indikator ASC"; //OR month(tgl_input)='$bulan' OR year(tgl_input)='$tahun'
   $data    = sqlsrv_query($conn, $query);
   $no=1;

     echo "
     <table class='table table-striped table-bordered table-hover'>
       <thead>
       <tr>
       <th>No</th>
       <th>Indikator</th>
       <th>Jumlah</th>
       <th style='text-align: center;'>Numerator</th>
       <th style='text-align: center;'>Denominator</th>
       <th>Analisa</th>
       <th>Tindak Lanjut</th>
       <th style='text-align: center;'>Action</th>
       </tr>
       </thead>

       <tbody>";

       while($row     = sqlsrv_fetch_array($data)){
         $kodeindi    = $row['kode_indikator'];
         $kategori    = $row['Kategori'];
         $numerator   = $row['Numerator'];
         $denominator = $row['Denominator'];
         $query1      = "SELECT COUNT(kode_indikator) as jml FROM V_Indikator_Kejadian WHERE kode_indikator= '$kodeindi'";
         $data1       = sqlsrv_query($conn, $query1);

         while($row1  = sqlsrv_fetch_array($data1)){
           $jumlh = $row1['jml'];
           $total 	= $total + $jumlh;

            echo "
            <tr>
              <td>".$no++."</td>
              <td class='center' >".$kodeindi." - ".$kategori."</td>
              <td class='center' style='text-align: center;'>$jumlh</td>
              <td class='center' style='text-align: center;'>$numerator</td>
              <td class='center' style='text-align: center;'>$denominator</td>
              <td class='center'></td>
              <td class='center'></td>
              <td class='center' id='myBtn' style='text-align: center;'>

                <button type='button' class='btn btn-success' data-toggle='modal'
                 onClick='datapost(\"$kodeindi - $kategori\", \"$jumlh\", \"$numerator\", \"$denominator\")' data-target='#myModal'>Add</button>
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
          <td class='center' style='font-weight:bold;;text-align:center;;font-size:14px;'>$total</td>
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
          <input type="text" id="kodeindi"  name="" value="" readonly style="height: 26px;">
          <label for="">Jumlah</label>
          <input type="text" name="" id="jumlah" value="" readonly style="height: 26px;">
          <label for="">Numerator</label>
          <input type="text" name="" id="numerator" value="" style="height: 26px;">
          <label for="">Denominator</label>
          <input type="text" name="" id="denominator" value="" style="height: 26px;">
          <label for="">Analisa</label>
          <textarea type="text" name="" id="analisa" value="" style="height: 26px; width: 100%;"></textarea>
          <label for="">Tindak Lanjut</label>
          <textarea type="text" name="" id="tindaklanjut" value="" style="height: 26px; width: 100%;"></textarea>
        </div>
        <div class="modal-footer">
          <button type="button" id="btn" onclick="clik()" class="btn btn-success" data-dismiss="modal">Save</button>
        </div>
      </div>
    </div>
  </div>

   <script>
      function datapost(indikate, jumlah, numera, denomina){
        document.getElementById('kodeindi').value=indikate;
        document.getElementById('jumlah').value=jumlah;
        var elemen1 = document.getElementById('numerator');
        var elemen2 = document.getElementById('denominator');

        var num = numera;
        var deno = denomina;

        if (num == "X") {
          elemen1.disabled = false;
        }else if (num == "") {
          elemen1.disabled = true;
        }

        if (deno == "X") {
          elemen2.disabled = false;
        }else if (deno == "") {
          elemen2.disabled = true;
        }

      }

      function clik(){
        var kodeindikator = document.getElementById('kodeindi').value;
        var jumlah = document.getElementById('jumlah').value;
        var numerator = document.getElementById('numerator').value;
        var denominator = document.getElementById('denominator').value;
        var analisa = document.getElementById('analisa').value;
        var tindaklanjut = document.getElementById('tindaklanjut').value;
        if (kodeindikator) {
            window.location.href = "R_Data_Save.php?r1=" + kodeindikator +
            "&r2=" + jumlah +
            "&r3=" + numerator +
            "&r4=" + denominator +
            "&r5=" + analisa +
            "&r6=" + tindaklanjut;

      }
    }

    var textarea1 = document.getElementById('analisa');
    var textarea2 = document.getElementById('tindaklanjut');

    textarea1.addEventListener('keydown', autosize);
    textarea2.addEventListener('keydown', autosize);
    function autosize(){
      var el = this;
      setTimeout(function(){
        el.style.cssText = 'height:auto; padding:0';
        // for box-sizing other than "content-box" use:
        // el.style.cssText = '-moz-box-sizing:content-box';
        el.style.cssText = 'height:' + el.scrollHeight + 'px';
      },0);
    }

   </script>

   <script src="js/jquery-1.7.2.min.js"></script>
