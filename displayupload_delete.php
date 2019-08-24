<?php

header("Refresh:7");

include "koneksi.php";

if (isset($_GET['kdtrans'])){
$kdtrans = $_GET['kdtrans'];

foreach (glob("./hasilupload/".$kdtrans."*.pdf") as $filename) {
    
	$filename = basename($filename);
	
?>
		
		<a href="#" onClick="window.open('./hasilupload/<?php echo $filename ?>', '_blank'); return false;">
		
		<?php echo $filename ?></a>
		<button type="button" onclick="window.location.href='deletefile.php?file=<?php echo $filename ?>&kode=<?php echo $kdtrans ?>'"> Delete </button>
		<br/><br/><br/>
		
		
		
<?php

 		
	}
} 
?>
	