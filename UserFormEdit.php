<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>User Form</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
  <link href="css/css/font-awesome.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link href="css/pages/dashboard.css" rel="stylesheet">
  <script src="js/jquery-1.7.2.min.js"></script>
  <style>
  td{
    padding-left: 3px;
  }
  td.mid{
    padding-left: 0px;
    text-align: center;
  }
</style>
</head>
<body>
<div id="header_user"></div>
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span12 mainPage">
          <?php
            include "koneksi.php";
            $id = $_GET['ID'];
          ?>
          <br>
          <form action="UserForm.php">
            <p>
              <Button type="submit" id="back" value="back">Cancel</Button>
              <Button type="reset" id="reset" value="reset">Reset</Button>
              <Button type="button" id="save" value="Save">Save</Button>
            </p>

            <table border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td>User ID</td>
                <td>&nbsp; : &nbsp;</td>
                <td><?php echo $id ?></td>
              </tr>
            </table>
            --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

            <?php
              $sql = "
              select a.Form_Id as frm, a.Form_Name as name, b.User_Id as users from M_Form a
              left join
              (Select Form_Id, User_Id from M_Authorization where User_Id = '".$id."') b
              on a.Form_Id = b.Form_Id
              where a.Form_Id like '%%'
              order by frm";
              $sql_execute = sqlsrv_query($conn,$sql);

              if($sql_execute)
              {
                echo "<table>";
                while($rs = sqlsrv_fetch_array($sql_execute))
              {
                echo '
                <tr>
                <td><input type="checkbox" id="chck[]" value="'.$rs['frm'].'"';
                if(is_null($rs['users']) == false){echo "checked";}
                  echo '> &nbsp; '.$rs['name'].'</input></td></tr>';
                }
                echo "</table>";
              }
            ?>
            <br/>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script>
  $(function(){
    $('#save').click(function(){
      val = "";
      $(':checkbox:checked').each(function(i){
        val = val + $(this).val() + ";";
      });
      $.post("UserFormSave.php",{str:val, id:"<?php echo $id ?>"},function(data,status){
        alert(data);
      });
    });
  });
</script>

<script src="js/excanvas.min.js"></script>
<script src="js/chart.min.js" type="text/javascript"></script>
<script src="js/bootstrap.js"></script>
<script src="js/Script.js"></script>
<script language="javascript" type="text/javascript" src="js/full-calendar/fullcalendar.min.js"></script>

<script src="js/base.js"></script>

</body>
</html>
