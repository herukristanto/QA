<?php
include "koneksi.php";

#ambil data
$query = "SELECT * FROM M_Unit WHERE Status ='X' ";
$sql = sqlsrv_query($conn, $query);
$arrunit = array();
while ($row = sqlsrv_fetch_array($sql)) {
  $arrunit [ $row['Deskripsi'] ] = $row['Deskripsi'];
}


#action get indikator
if(isset($_GET['action']) && $_GET['action'] == "getUnker") {
  $kode_unit = $_GET['Deskripsi'];

#ambil data indikator
  $query = "SELECT * FROM M_Indikator WHERE Unit= '$kode_unit' AND Status='X' ORDER BY Kode ASC";
  $sql = sqlsrv_query($conn, $query);
  $arrind = array();
  while ($row = sqlsrv_fetch_array($sql)) {
    array_push($arrind, $row);
  }
  echo json_encode($arrind);
  exit;
}

?>

<script type="text/javascript" src="libs/jquery.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function()
      {

        $('#unit_kerja').change(function()
        {
          $.getJSON('test.php',{action:'getUnker', Deskripsi:$(this).val()}, function(json)
          {
            $('#indikator').html('');
            $.each(json, function(index, row)
            {
              //$('#indikator').append('<option value="'+row.kode_unit+' - '+row.Unit_Kerja+'">'+row.kode_unit+' - '+row.Unit_Kerja+'</option>');
              $('#indikator').append('<option value="'+row.Kategori+'">'+row.Kategori+'</option>');

            });
          });
        });
      });
    </script>

    <script type="text/javascript" src="libs/jquery.min.js"></script>

  <table>
    <tr>
              <td>unit kerja</td>
              <td>:</td>
              <td colspan="2">
        <select id="unit_kerja" name="unit_kerja">

        <option value="">---------------- P I L I H ----------------</option>
              <?php
      foreach ($arrunit as $unit=>$kode) {
        echo "<option value='$kode'>$kode</option>";
      }
      ?>
            </select></td>
            </tr>
            <tr>
              <td>Unit</td>
              <td>:</td>
              <td colspan="2">
        <select id="indikator" name="indikator" onChange="();">
          <option value="">---------------- P I L I H ----------------</option>
          </select></td>
            </tr>
  </table>
