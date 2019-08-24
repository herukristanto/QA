<?php

include "koneksi.php";

if (isset($_GET['kdtranss'])){
$kdtranss = $_GET['kdtranss'];

foreach (glob("./hasilupload/".$kdtranss."*.pdf") as $filename) {
    $filename = basename($filename);
	
?>
		   <a href="#" onClick="window.open('./hasilupload/<?php echo $filename ?>', '_blank'); return false;"><?php echo $filename ?></a><br/><br/><br/>
<?php
	}
} 
?>

