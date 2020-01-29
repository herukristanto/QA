<!DOCTYPE html>
<html>
<head>

</head>
<body>
  <br>
  <input type='file' id='filedirectory'></input><br><br>
  <button onclick='copyfile()'>Submit</button>

  <script>
    function copyfile() {
      var filedirectory = document.getElementById('filedirectory').value;
      alert(filedirectory);
      // window.location.href='copyfile.php';
    }
  </script>
</body>
</html>