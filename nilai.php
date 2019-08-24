<?php
//include_once 'header.php';
include "includes/nilai.inc.php";
include "includes/config.php";
$pro = new Nilai($db);
$stmt = $pro->readAll();
$count = $pro->countAll();

if(isset($_POST['hapus-contengan'])){
    $imp = "('".implode("','",array_values($_POST['QA']))."')";
    $result = $pro->hapusell($imp);
    if($result){
            ?>
            <script type="text/javascript">
            window.onload=function(){
                showSuccessToast();
                setTimeout(function(){
                    window.location.reload(1);
                    history.go(0)
                    location.href = location.href
                }, 5000);
            };
            </script>
            <?php
    } else{
            ?>
            <script type="text/javascript">
            window.onload=function(){
                showErrorToast();
                setTimeout(function(){
                    window.location.reload(1);
                    history.go(0)
                    location.href = location.href
                }, 5000);
            };
            </script>
            <?php
    }
}
?><style type="text/css">
<!--
body {
	background-image: url();
}
-->
</style>
<form method="post">
	<div class="row">
		<div class="col-md-6 text-right"">
			<h4>Data Nilai</h4>
		</div>
		<div class="col-md-6 text-right">
			<button type="button" onclick="location.href='nilai-baru.php'" class="btn btn-primary">+ Add Data</button>
		</div>
	</div>
	<br/>

	<table width="86%" class="table table-striped table-bordered" id="tabeldata" align="center">
        <thead>
            <tr>
              <th width="20"><input type="checkbox" name="select-all" id="select-all" /></th>
                <th width="682">Nilai</th>
                <th width="79">Jumlah</th>
                <th width="79">Update</th>
            </tr>
        </thead>

        <tfoot>
            <tr>
                <th><input type="checkbox" name="select-all2" id="select-all2" /></th>
                <th>--------------------------</th>
                <th>------------</th>
                <th>------------</th>
            </tr>
        </tfoot>

        <tbody>
<?php
$no=1;
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
?>
            <tr>
                <td style="vertical-align:middle;"><input type="checkbox" value="<?php echo $row['id_nilai'] ?>" name="checkbox[]" /></td>
                <td style="vertical-align:middle;"><?php echo $row['ket_nilai'] ?></td>
                <td style="vertical-align:middle;"><?php echo $row['jum_nilai'] ?></td>
                <td class="text-center" style="vertical-align:middle;">
					<a href="nilai-ubah.php?id=<?php echo $row['id_nilai'] ?>" class="btn btn-warning"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
					<a href="nilai-hapus.php?id=<?php echo $row['id_nilai'] ?>" onclick="return confirm('Yakin ingin menghapus data')" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
			    </td>
            </tr>
<?php
}
?>
        </tbody>

  </table>
    </form>		
<?php
include_once 'footer.php';
?>