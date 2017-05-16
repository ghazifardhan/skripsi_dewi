<?php
include("koneksi.php");
if(isset($_POST['simpan'])){
$query="insert into paket_pekerjaan(Id_Paket_Pekerjaan,Nama_perusahaan,Keterangan)
Value ('".$_POST["Id_Paket_Pekerjaan"]."',
		'".$_POST["Nama_perusahaan"]."',
		'".$_POST["Keterangan"]."')";

$proses=mysql_query($query);

if ($proses){
	header('location:tampilan_paket_pekerjaan.php');
}else{
	echo mysql_error();
}
}
include('header.php');
?>
<form method="post"/>
<table border="1" class="table table-bordered">

<tr>
<td>Id_Paket_Pekerjaan</td>
<td><input type	="text" class="form-control" name="Id_Paket_Pekerjaan"></td>
</tr>
<tr>
<td>Nama_perusahaan</td>
<td><input type	="text"class="form-control" name="Nama_perusahaan"></td>
</tr>
<tr>
<td>Keterangan</td>
<td><input type	="text"class="form-control" name="Keterangan"></td>
</tr>
<tr>
<td><input type="submit"value="simpan"class="btn btn-danger" name="simpan"/></td>
</tr>
</table>
</form>

<?php 
include('Footer.php');

?>
