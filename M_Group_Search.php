<link href="css/customStyle.css" rel="stylesheet">

<div id="myModal" class="modala">

  <div class="modala-content">
    <div class="modala-header">
      <span class="close">&times;</span>
      <h2>Filter Data Group</h2>
  </div>
  <div class="modala-body">
      <p>Pilih Data Group yang dimaksud</p>
      <table>
          <tr>
              <td>Masukan Kode atau Deskripsi Group</td>
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
        $("#tampiltabel").load('M_Group_Table.php?katakunci='+$("#katakunci").val());
    });
});

function cekKataKunci(){
    var katakunci;
    katakunci = document.getElementById('katakunci').value;
    window.location.href='M_Group_Search.php?katakunci=' + katakunci;
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
