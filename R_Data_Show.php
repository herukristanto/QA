
<div id="myModal" class="modala">
  <div class="modala-content">
    <div class="modala-header">
      <span class="close">&times;</span>
      <h3>INPUT INDIKATOR MUTU</h3>
    </div>
  <div class="modala-body">
    <!-- <form>
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  <div class="form-group form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form> -->
    <label for="">Indikator</label>
    <input type="text" name="" value="" style="
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    box-sizing: border-box;
    ">
    <label for="">Jumlah</label>
    <input type="text" name="" value=""
    style="
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    box-sizing: border-box;
    "
    >
    <label for="">Numerator</label>
    <input type="text" name="" value="">
    <label for="">Denominator</label>
    <input type="text" name="" value="">
    <label for="">Analisa</label>
    <input type="text" name="" value="">
    <label for="">Tindak Lanjut</label>
    <input type="text" name="" value="">
    <br>
    <button type="button" class="btn btn-success" name="button">Simpan</button>
    <button type="button" class="btn btn-default" class="close" name="button">Close</button>
  </div>
</div>
</div>
<script>

// Get the modal
// $(document).ready(function(){
//     $("#saringtabel").click(function()
//     {
//         $("#tampiltabel").load('T_Kejadian_A_Table.php?katakunci='+$("#katakunci").val());
//     });
// });
//
// function cekKataKunci(){
//     var katakunci;
//     katakunci = document.getElementById('katakunci').value;
//     window.location.href='T_Kejadian_A_Search.php?katakunci=' + katakunci;
// }

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
