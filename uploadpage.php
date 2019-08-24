<?php
include "koneksi.php";

//Create Autonumber
$sql = "SELECT MAX(Kode) AS id FROM T_Trans";

$sql_execute = sqlsrv_query($conn,$sql);
$sql_hasil = sqlsrv_fetch_array($sql_execute);
$cek = $sql_hasil['id'];

$kode = substr($cek,1,6);

$tambah = $kode + 1;
	
	if($tambah<10){
		$id = "T00000".$tambah;
		}else{
		$id = "T0000".$tambah;
		}

?>

<p>File Upload Transaksi No.<?php echo $id; ?> :
					<br>
		<form action="uploadfile.php?id=<?php echo $id ?>" method="post" enctype="multipart/form-data">
                    1. <input type="file" name="fileku[]" />
                    <br>
					<br>
                    2. <input type="file" name="fileku[]" />
                    <br>
					<br>
                    3. <input type="file" name="fileku[]" />
                    <br>
					<br>
                    4. <input type="file" name="fileku[]" />
                    <br>
					<br>
                    5. <input type="file" name="fileku[]" />
                    <br>
					<br>
                    <input name="submit" type="submit" value="Upload" />
		 </form>
                    <p></p>


  <!-- <table class="table table-bordered">         	
                <tr>
                  <td width="17%">	<label for="sub">Deskripsi: </label>	</td>
                    <td width="83%">	<input type="text" name="sub" id="sub" class="input-medium"  
					         required autofocus placeholder="Title of the subject"/>	</td>
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
-->
<!--<p>File yang diupload:<br>
<input type="file" name="fileku[]" /><br>
<input type="file" name="fileku[]" /><br>
<input type="file" name="fileku[]" /><br>
<input type="file" name="fileku[]" /><br>
<input type="file" name="fileku[]" /><br>
<input type="file" name="fileku[]" /><br>
<input type="file" name="fileku[]" /><br>
<input type="submit" value="Upload" />
</p>
</form>-->