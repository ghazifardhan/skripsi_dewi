<?php
include("koneksi.php");
if(isset($_POST['simpan'])){
$query="insert into customer(Id_Customer,Nama_Customer,Alamat, Telpon,Keterangan)
Value ('".$_POST["Id_Customer"]."',
		'".$_POST["Nama_Customer"]."',
		'".$_POST["Alamat"]."',
		'".$_POST["Telpon"]."',
		'".$_POST["Keterangan"]."')";

$proses=mysql_query($query);

if ($proses){
	echo " simpan data berhasil";
}else{
	echo mysql_error();
}
}
include('header.php');
?>
<form method="post"/>
<table border="1" class="table table-bordered">
<tr>
<td>Id_Customer</td>
<td><input type	="text" name="Id_Customer"></td>
</tr>
<tr>
<td>Nama_Customer</td>
<td><input type	="text"name="Nama_Customer"></td>
</tr>
<tr>
<td>Alamat</td>
<td><input type	="text"name="Alamat"></td>
</tr>
<tr>
<td>Telpon</td>
<td> <input type="text"name="Telpon"></td>
</tr?>
<tr>
<td>Keterangan</td>
<td> <input type="text"name="Keterangan"></td>
</tr?>
<tr>
<td><input type="submit"value="simpan"name="simpan"/></td>
</tr>
</table>
</form>

<?php 
include('Footer.php');

?>