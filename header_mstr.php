<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600"
        rel="stylesheet">
<link href="css/font-awesome.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/pages/dashboard.css" rel="stylesheet">

<?php
  include "koneksi.php";
  session_start();

  //Cek variabel user dan pass
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
      window.location="main_mstr.php";
      </script>';
    }
  }

  $username = $_SESSION["username"];

  // echo $username;
?>

<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span
                    class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span> </a><a class="brand" href="main.php">QA RS Pantai Indah Kapuk </a>
      <!--/.nav-collapse -->
    </div>
    <!-- /container -->
  </div>
  <!-- /navbar-inner -->
</div>
<!-- /navbar -->
<div class="subnavbar">
  <div class="subnavbar-inner">
    <div class="container">
      <ul class="mainnav">
        <li class="active"><a href="main.php"><i class="icon-home"></i><span>Home</span> </a> </li>
        <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-file"></i><span>Departemen</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="M_Dept_Create.php">Create</a></li>
            <li><a href="M_Dept_Display.php">Display</a></li>
            <li><a href="M_Dept_Change.php">Change</a></li>
          </ul>
        </li>
        <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-file"></i><span>Unit</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="M_Unit_Create.php">Create</a></li>
            <li><a href="M_Unit_Display.php">Display</a></li>
            <li><a href="M_Unit_Change.php">Change</a></li>
          </ul>
        </li>
        <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-file"></i><span>Group</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="M_Group_Create.php">Create</a></li>
            <li><a href="M_Group_Display.php">Display</a></li>
            <li><a href="M_Group_Change.php">Change</a></li>
          </ul>
        </li>
        <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-file"></i><span>Indikator</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="M_Indikator_Create.php">Create</a></li>
            <li><a href="M_Indikator_Display.php">Display</a></li>
            <li><a href="M_Indikator_Change.php">Change</a></li>
          </ul>
        </li>
        <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-file"></i><span>Insiden</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="M_Insiden_Create.php">Create</a></li>
            <li><a href="M_Insiden_Display.php">Display</a></li>
            <li><a href="M_Insiden_Change.php">Change</a></li>
          </ul>
        </li>
        <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-file"></i><span>Tipe Insiden</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="M_Tipe_Insiden_Create.php">Create</a></li>
            <li><a href="M_Tipe_Insiden_Display.php">Display</a></li>
            <li><a href="M_Tipe_Insiden_Change.php">Change</a></li>
          </ul>
        </li>
        <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-file"></i><span>Sub Tipe Insiden</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="M_Sub_Tipe_Insiden_Create.php">Create</a></li>
            <li><a href="M_Sub_Tipe_Insiden_Display.php">Display</a></li>
            <li><a href="M_Sub_Tipe_Insiden_Change.php">Change</a></li>
          </ul>
        </li>
        <li><a href="logout.php"><i class="icon-off"></i><span>Log Off</span> </a> </li>
      </ul>
    </div>
    <!-- /container -->
  </div>
  <!-- /subnavbar-inner -->
</div>
<!-- /subnavbar -->

<script>
  function keluar(){
    var r = confirm("Apakah Anda Yakin Ingin Keluar?");
    if(r == true){
      $.post("logoff.php", {}, function(data, status){
        $(location).attr('href',"index.html");
      });
    }
  }
</script>
