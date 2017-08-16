<?php
include("koneksi.php");
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['authorized'])){
}else{
	echo ("<script type='text/javascript'>alert('Anda harus login');document.location='../index.php';</script>");
}
if(isset($_POST['simpan'])){
$query="insert into customer(Id_Customer,Nama_Customer,Alamat, Telpon,Keterangan,Jenis)
Value ('".$_POST["Id_Customer"]."',
		'".$_POST["Nama_Customer"]."',
		'".$_POST["Alamat"]."',
		'".$_POST["Telpon"]."',
		'".$_POST["Keterangan"]."',
		'".$_POST["Jenis"]."')";

$proses=mysql_query($query);

if ($proses){
	header('location:tampilan_customer.php');
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
<td><input type	="text" name="Id_Customer" class="form-control"></td>
</tr>
<tr>
<td>Nama_Customer</td>
<td><input type	="text"name="Nama_Customer" class="form-control"></td>
</tr>
<tr>
<td>Alamat</td>
<td><input type	="text"name="Alamat" class="form-control"></td>
</tr>
<tr>
<td>Telpon</td>

<td> <input type="number"name="Telpon" class="form-control"></td>
</tr?>
<tr>
<td>Keterangan</td>
<td> <input type="text"name="Keterangan" class="form-control"></td>
</tr>
<tr>
<td>Jenis Customer</td>
<td> <select name="Jenis" class="form-control">
<option value="">Jenis Customer</option>
<option value="Kontraktor">Kontraktor</option>
<option value="Konsultan">Konsultan</option>

</select></td>
</tr>
<tr>
<td><input type="submit"value="simpan"name="simpan"/></td>
</tr>
</table>
</form>

<?php 
include('Footer.php');

?>