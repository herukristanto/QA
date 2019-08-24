<?php
include "koneksi.php";

// Turn off error reporting
error_reporting(0);

// Report runtime errors
error_reporting(E_ERROR | E_WARNING | E_PARSE);

// Report all errors
error_reporting(E_ALL);

// Same as error_reporting(E_ALL);
ini_set("error_reporting", E_ALL);

// Report all errors except E_NOTICE
error_reporting(E_ALL & ~E_NOTICE);

$kdtranschange = $_GET['kdtranschange'];

?>

<p>File Upload Transaksi No.<?php echo $kdtranschange; ?> :
					<br>
		
		<form action="uploadfile_change.php?kdtranschange=<?php echo $kdtranschange ?>" method="post" enctype="multipart/form-data">
		
                    1. <input type="file" name="fileku[]" />
                    <br>
					<br>
                    2. <input type="file" name="fileku[]" />
                    <br>
					<br>
                    3. <input type="file" name="fileku[]" />
                    <br>
					<br>
                    <!--4. <input type="file" name="fileku[]" />
                    <br>
					<br>
                    5. <input type="file" name="fileku[]" />
                    <br>
					<br>-->
                    <input name="submit" type="submit" value="Upload" />
</form>
                    <p></p>			