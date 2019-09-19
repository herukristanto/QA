<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
<script type="text/javascript" src="assets/js/jquery.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.validate.min.js"></script>
<title> Data Member </title>
</head>
<body>
<?php
include ('header.php');
?>
<?php
require_once('koneksi.php');
if($_GET['id']!=null){
$id        = $_GET['id'];
$koneksiObj = new Koneksi();
$koneksi    = $koneksiObj->getKoneksi();
if($koneksi->connect_error){
echo "Gagal Koneksi : ". $koneksi->connect_error;
}
$query = "select * from members where id='$id'";
$data = $koneksi->query($query);
}
if($data->num_rows <= 0){
echo "Data tidak ditemukan!";
} else{
while($row = $data->fetch_assoc()){
$id             = $row['id'];
$nama           = $row['nama'];
$username       = $row['username'];
$password       = $row['password'];
$email          = $row['email'];
}
}
?>
<div class="container">
<br>
<h2>Data Member <i class="fa fa-angle-double-right"></i> Edit Data</h2>
<hr>
<br>
<!-- start form edit data -->
<form id="editdata" class="form-horizontal" method="post" action="update.php">
<input type="hidden" class="form-control" id="id" name="id" value="<?php echo $id;?>">
<div class="form-group">
<label for="nim">Nama</label>
<div>
<input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama;?>">
</div>
</div>
<div class="form-group">
<label for="nama">Username</label>
<div>
<input type="text" class="form-control" id="username" name="username" value="<?php echo $username;?>">
</div>
</div>
<div class="form-group">
<label for="nama">Password</label>
<div>
<input type="text" class="form-control" id="password" name="password" value="<?php echo $password;?>">
</div>
</div>
<div class="form-group">
<label for="nama">Email</label>
<div>
<input type="text" class="form-control" id="email" name="email" value="<?php echo $email;?>">
</div>
</div>
<div class="form-group">
<div>
<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
<a href="index.php" class="btn btn-danger"><i class="fa fa-ban"></i> Batal</a>
</div>
</div>
</form>
</div>
<?php
include 'footer.php';
?>
<script language="javascript">
$.validator.addMethod("alpha", function(value, element){
return this.optional(element) || value.match(/^[a-zA-Z\s]+$/);
});
$("#editdata").validate({
rules: {
username: "required",
nama: {
required: true,
alpha: true
},
email: {
required: true,
email: true
},
password: {
required: true,
minlength: 8
}
},
message: {
username: "Masukkan username anda!",
nama: {
required: "Masukkan nama anda!",
alpha: "Inputan hanya diperbolehkan huruf dan spasi!"
},
email: "Masukkan email anda yang valid!",
password: {
required: "Masukkan password anda!",
minlength: "Password minimal 8 karakter!"
}
},
submitHandler: function(form) {
form.submit();
}
});
</script>
</body>
</html>
