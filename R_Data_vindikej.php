
<?php
error_reporting(0);
include "koneksi.php";
 $unit    = $_POST['kode_u'];
 $tahun   = $_POST['tahun'];





 if(!empty($unit)){


$query = "SELECT * FROM M_Indikator WHERE Unit = '".$unit."' AND YEAR(create_at) = '".$tahun."' AND Status = 'X' ORDER BY Kode ASC";
  $sql = sqlsrv_query($conn,$query);
if  ($sql){
echo "
    <table id=\"TableDetail\" class='table table-striped table-bordered table-hover'>
    <p></p>
    </caption>
      <tr>
      <thead>
    <th>No</th>
    <th>Indikator</th>
    <th hidden >JAN</th>
    <th hidden >FEB</th>
    <th hidden >MAR</th>
    <th hidden >APR</th>
    <th hidden >MAY</th>
    <th hidden >JUN</th>
    <th hidden >JUL</th>
    <th hidden >AUG</th>
    <th hidden >SEP</th>
    <th hidden >OCT</th>
    <th hidden >NOV</th>
    <th hidden >DEC</th>
    <th style='text-align: center;'><b>Jumlah</b></th>
    <th style='text-align: center;'><b>Numerator</b></th>
    <th style='text-align: center;'><b>Denominator</b></th>
    <th><b>Analisa</b></th>
    <th><b>Tindak Lanjut</b></th>
    <th style='text-align: center;'><b>Action</b></th>
    </thead>
    <tbody>
</tr>";
$no=1;
    $arrKode = array();
    $arrDesk = array();
    $arrnume = array();
    $hsl = array();
    $total = array("0","0","0","0","0","0","0","0","0","0","0","0","0","0");
    while($rs = sqlsrv_fetch_array($sql)){
      $arrDesk[$no] = $rs['Kategori'];
      $arrKode[$no] = $rs['Kode'];
      $arrnume[$no] = $rs['Numerator'];
      $arrdenom[$no] = $rs['Denominator'];

      $no++;
    }
      $arrlength = count( $arrKode );
      for($x=1;$x<=$arrlength;$x++)
       {  $sttl = 0;
        for($bln=1;$bln<=12;$bln++)
        {

        $kate = $arrDesk[$x];
        $que = "SELECT count (*) as jml FROM V_Indikator_Kejadian WHERE kode_u = '".$unit."' AND Kategori = '".$kate."' AND MONTH(tgl_input) = '".$bln."' AND YEAR(tgl_input) = '".$tahun."'";

        $sql1 = sqlsrv_query($conn,$que);

        while($rs1 = sqlsrv_fetch_array($sql1)){
          $hsl[$bln] = $rs1["jml"];
          $sttl = $sttl + $hsl[$bln];
          $total[$bln] = $total[$bln] + $hsl[$bln];

        }


        }
        $total[13] = $total[13] + $sttl ;
        $indikator = $arrKode[$x]. ' - '.$arrDesk[$x];
        $numerator = $arrnume[$x];
        $denominator = $arrdenom[$x];
       echo "
        <tr>
        <td align=\"center\">$x</td>
        <td align=\"left\">$indikator</td>
        <td hidden align=\"center\">$hsl[1]</td>
        <td hidden align=\"center\">$hsl[2]</td>
        <td hidden align=\"center\">$hsl[3]</td>
        <td hidden align=\"center\">$hsl[4]</td>
        <td hidden align=\"center\">$hsl[5]</td>
        <td hidden align=\"center\">$hsl[6]</td>
        <td hidden align=\"center\">$hsl[7]</td>
        <td hidden align=\"center\">$hsl[8]</td>
        <td hidden align=\"center\">$hsl[9]</td>
        <td hidden align=\"center\">$hsl[10]</td>
        <td hidden align=\"center\">$hsl[11]</td>
        <td hidden align=\"center\">$hsl[12]</td>
        <td style='text-align: center;'><b>$sttl</b></td>
        <td style='text-align: center;'><b>$numerator</b></td>
        <td style='text-align: center;'><b>$denominator</b></td>
        <td class='center'></td>
        <td class='center'></td>
        <td style='text-align: center;'>
          <button type='button' class='btn btn-success' data-toggle='modal'
           onClick='datapost(\"$indikator\", \"$sttl\", \"$numerator\", \"$denominator\")'  data-target='#myModal'>Add</button>

        </td>

        </tr>";


       }
       echo "
    <tr>
    <td class='center'></td>
      <td>Total</td>
      <td hidden align=\"center\"><b>$total[1]</b></td>
      <td hidden align=\"center\"><b>$total[2]</b></td>
      <td hidden align=\"center\"><b>$total[3]</b></td>
      <td hidden align=\"center\"><b>$total[4]</b></td>
      <td hidden align=\"center\"><b>$total[5]</b></td>
      <td hidden align=\"center\"><b>$total[6]</b></td>
      <td hidden align=\"center\"><b>$total[7]</b></td>
      <td hidden align=\"center\"><b>$total[8]</b></td>
      <td hidden align=\"center\"><b>$total[9]</b></td>
      <td hidden align=\"center\"><b>$total[10]</b></td>
      <td hidden align=\"center\"><b>$total[11]</b></td>
      <td hidden align=\"center\"><b>$total[12]</b></td>
      <td class='center' style='text-align: center;'><b>$total[13]</b></td>
      <td class='center'></td>
      <td class='center'></td>
      <td class='center'></td>
      <td class='center'></td>
      <td class='center'></td>
    </tr>
    </tbody>";
      echo"</table>";


  }
}
   ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <style>
  textarea{



width:500px;
font-size:14;

padding:10px;
}
</style>
</head>
  <body>


  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <br>
          <h4 class="modal-title">Input Indikator Mutu</h4>
        </div>
        <div class="modal-body">
          <label for="">Indikaor</label>
          <input type="text" id="kodeindi"  name="" value="" readonly style="height: 26px; width: 510px;">
          <label for="">Jumlah</label>
          <input type="text" name="" id="jumlah" value="" readonly >
          <label for="">Numerator</label>
          <input type="text" name="" id="numerator" value="" >
          <label for="">Denominator</label>
          <input type="text" name="" id="denominator" value="" >
          <label for="">Analisa</label>
          <textarea type="text" name="" id="analisa" value="" rows='1'></textarea>
          <label for="">Tindak Lanjut</label>
          <textarea type="text" name="" id="tindaklanjut" value="" rows='1'></textarea>
        </div>
        <div class="modal-footer">
          <button class="btn btn-danger" onClick='cleardata()'>Clear</button>
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

        document.getElementById('numerator').value = '';
        document.getElementById('denominator').value = '';
        document.getElementById('analisa').value  = '';
        document.getElementById('tindaklanjut').value = '';

      }

      function cleardata(){


        document.getElementById('numerator').value = '';
        document.getElementById('denominator').value = '';
        document.getElementById('analisa').value  = '';
        document.getElementById('tindaklanjut').value = '';
        //document.getElementById('kode').value = '';


      }

      function clik(){
        var unit = "<?php echo $unit ?>";
        var tahun = "<?php echo $tahun ?>";
        var kodeindikator = document.getElementById('kodeindi').value;
        var jumlah = document.getElementById('jumlah').value;
        var numerator = document.getElementById('numerator').value;
        var denominator = document.getElementById('denominator').value;
        var analisa = document.getElementById('analisa').value;
        var tindaklanjut = document.getElementById('tindaklanjut').value;



         $.ajax({
          type: 'GET',
          url: "R_Data_Save.php",
          data: "r1=" + kodeindikator +
          "&r2=" + jumlah +
          "&r3=" + numerator +
          "&r4=" + denominator +
          "&r5=" + analisa +
          "&unit=" + unit +
          "&tahun=" + tahun +
          "&r6=" + tindaklanjut,

         });
         return false;
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
   <!-- <script src='js/autosize.js'></script>
   <script>
		autosize(document.querySelectorAll('textarea'));
	</script> -->

   <script src="js/jquery-1.7.2.min.js"></script>
 </body>
</html>
