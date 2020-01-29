<!DOCTYPE html>
<html>
<head>
  <p align="center"><img src="Images/header.png" width="1000" height="140"></p>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <script src="script/jquery-1.12.4.js"></script>

  <title>Login Client Kamar</title>

  <style>
  #Footer {
    font-size: 10px;
    color: #000;
    background-color: #FFF;
  }
  body,td,th {
    font-family: Tahoma, Geneva, sans-serif;
    font-size: 18px;
  }
  .center{
    position: absolute;
    margin-top: -120px;
    margin-left: -200px;
    left: 50%;
    top: 450px;
    width: 400px;
    height: 220px;
  }
</style>
</head>

<title>Login</title>

<body>
  <div class="center">
    <form  method=POST action=cekLogin.php>
      <table align='center'>
        <tr>
          <td>LOGIN</td>
          <td></td>
        </tr>
        <tr>
          <td>Poliklinik</td>
          <td> :
            <select id="poli" onchange="change1()">
              <option></option>
              <?php
              include "koneksi.php";

              $que = "SELECT nama_poli FROM QP7RUANG GROUP BY nama_poli";
              $sql = sqlsrv_query($conn,$que);

              while($hasil = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC)){
                echo "<option value='".$hasil['nama_poli']."'>".$hasil['nama_poli']."</option>";
              }
              ?>
            </select>
          </td>
        </tr>
        <tr>
          <td>Ruang</td><td> : <span id="ini"></span></td>
        </tr>
        <tr>
          <td>Dokter</td><td> : <span id="itu"></span></td>
        </tr>
        <tr>
          <td>Username</td>
          <td> : <input type=text name=username /></td>
        </tr>
        <tr>
          <td>Password</td>
          <td> : <input type=password name=password /></td>
        </tr>

        <tr>
          <td colspan=2 align="Right"><input type=submit value=Login /></td>
        </tr>
      </table>
    </form>
    <div id="Footer">
      <br>
      <br>
      <p align="center">..:: Technology Information 2018 ::..</p>
    </div>
  </div>

  <script>

    function change1() {
      var nama = document.getElementById('poli').value;
      if (nama=='SKIN CENTER') {
        nama = 'SKIN';
      } else if (nama=='BREAST CENTER') {
        nama = 'BREAST';
      } else {
        nama = nama.substr(11,1);
      }
      
      $("#ini").empty();
      $("#ini").load('cariruang.php?nama=' + nama);
    }

    function change2() {
      var idruang = document.getElementById('idruang').value;
      $("#itu").empty();
      $("#itu").load('caridokter.php?idruang=' + idruang);
    }

  </script>
</body>
</html>