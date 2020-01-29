<?php
if (empty($_SESSION["username"])){
  echo "
  <script>
    alert('Silahkan Login Terlebih Dahulu');
    window.location.href = 'index.html';
  </script>
  ";
}else{
  $page = basename($_SERVER['PHP_SELF']);
  $quer = "select count(*) as hasil from M_Authorization where User_ID = '".$_SESSION["username"]."' and Form_ID = '".$page."'";
  $sql_execute = sqlsrv_query($conn,$quer);
  $rs = sqlsrv_fetch_array($sql_execute, SQLSRV_FETCH_ASSOC);
  if($rs["hasil"] == 0)
  {
    echo '<script>
    alert("Anda tidak berhak membuka halaman ini");
    window.location="main.php";
    </script>';
  }
}

$username = $_SESSION["username"];
?>
