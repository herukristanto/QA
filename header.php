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
    	window.location="main.php";
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
        <li><a href="main_mstr.php"><i class="icon-file"></i><span>Master</span> </a> </li>
        <li><a href="main_tran.php"><i class="icon-plus"></i><span>Transaction</span> </a> </li>
        <li><a href="R_Report.php"><i class="icon-print"></i><span>Report</span> </a> </li>
    <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
    <i class="icon-cog"></i><span>Tools</span> <b class="caret"></b></a>
      <ul class="dropdown-menu">
         <li><a href="FormManagement.php">Form Management</a></li>
               <li><a href="UserForm.php">User Management</a></li>
        </ul>
    </li>
    <!--<li><a href="index_user.html"><i class="icon-user"></i><span>User Management</span> </a> </li>-->
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
