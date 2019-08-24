<link href="css/customStyle.css" rel="stylesheet">

<div id="myModal" class="modala">

  <div class="modala-content">
    <div class="modala-header">
      <span class="close">&times;</span>
      <h2>Filter Data Laporan</h2>
  </div>
  <div class="modala-body">
      <p>Pilih data Laporan yang dimaksud</p>
      <table>
          <tr>
              <td>Masukan No. Laporan atau Deskripsi Laporan</td>
              <td> : </td>
              <td><input type="text" id="katakunci" name="katakunci"></td>
              <td><button id="saringtabel">Saring</button></td>
          </tr>
      </table>
      <div id="tampiltabel">
        <!-- div untuk menampilkan tabel -->
      </div>
      <br>

      <br><br>
  </div>
</div>
</div>
<script>

// Get the modal
$(document).ready(function(){
    $("#saringtabel").click(function()
    {
        $("#tampiltabel").load('T_Invest_Table_No_Laporan.php?katakunci='+$("#katakunci").val());
    });
});

function cekKataKunci(){
    var katakunci;
    katakunci = document.getElementById('katakunci').value;
    window.location.href='T_Invest_Search_No_Laporan.php?katakunci=' + katakunci;
}

var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
