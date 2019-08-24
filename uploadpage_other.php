<?php
error_reporting(0);
ini_set('display_errors',0);

$Unit = $_GET['Unit'];
/*echo $dept;*/
?>

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
	<link rel="stylesheet" href="css/bootstrap.min.css" />
    <style type="text/css">
	#wrapper {
	margin: 0 auto;
	float: none;
	width:70%;
}
.header {
	padding:10px 0;
	border-bottom:1px solid #CCC;
}
.title {
	padding: 0 5px 0 0;
	float:left;
	margin:0;
}
.container form input {
	height: 30px;
}
body
{
    
    font-size:12;
    font-weight:bold;
}


		</style>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Upload File</title>
    
        <?php
			if(!empty($_POST))
			{
				$con = mssql_connect("QA","sa","w@tch9u@rd");
				if (!$con)
					echo('Could not connect: ' . mysql_error());
				else
				{
					if (file_exists("download/" . $_FILES["file"]["name"]))
					{
						echo '<script language="javascript">alert(" Sorry!! Filename Already Exists...")</script>';
					}
					else
					{
						move_uploaded_file($_FILES["file"]["tmp_name"],
						"download/" . $_FILES["file"]["name"]) ;
						mssql_select_db("QA", $con);
						$sql = "INSERT INTO F_FILES(subject,topic,file) VALUES ('" . $_POST["sub"] ."','" .$_FILES["file"]["name"] ."');";
						if (!mysql_query($sql,$con))
							echo('Error : ' . mysql_error());
						else
							echo '<script language="javascript">alert("Thank You!! File Uploded")</script>';
						}
				}
				mysql_close($con);
			}
        ?>
    </head>
     <body bgcolor="#FFFF99">
	   <div class="container home">
       <form id="form3" enctype="multipart/form-data" method="post" action="uploadpage.php">
		<!--  <form action="uploadfile.php?Unit=<?php echo $Unit ?>" method="post" enctype="multipart/form-data"> -->
             <table class="table table-bordered">         	
                <tr>
                    <td width="10%">	<label for="sub">Deskripsi: </label>	</td>
                    <td width="90%">	<input type="text" name="sub" id="sub" class="input-medium"  
					         required autofocus placeholder="Isi Deskripsi File"/>	</td>
                </tr>
                <tr>
                    <td><label for="file">File:</label></td>
                    <td><input type="file" name="file" id="file" 
                        title="Click here to select file to upload." required /></td>
                </tr>
                <tr>
                  
				   <td colspan="2" align="center">		    
				   <input type="submit" class="btn btn-primary" name="upload" id="upload" 
				   title="Click here to upload the file." value="Upload File" /> </td>
                </tr>
            </table>
        </form>
		</div>
    </body>
</html>
