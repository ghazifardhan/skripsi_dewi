<?php
include ('koneksi.php');
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['authorized'])){
}else{
	echo ("<script type='text/javascript'>alert('Anda harus login');document.location='../index.php';</script>");
}
if(isset($_POST['save'])){
$query_update=mysql_query("UPDATE customer set
Nama_Customer ='".$_POST['Nama_Customer']."',
Alamat ='".$_POST['Alamat']."',
Telpon='".$_POST['Telpon']."',
Keterangan='".$_POST['Keterangan']."',
Jenis='".$_POST['Jenis']."'
where
Id_Customer='".$_POST['Id_Customer']."'");
if($query_update){
	header("location:tampilan_customer.php");
}else{
	echo mysql_error();
}
}
$tampilan_data=mysql_query("select*from customer where Id_Customer='".$_GET['Id_Customer']."'");
$hasil_data= mysql_fetch_array($tampilan_data);

include('header.php');
?>

<form method="post"/>
<table border="1" class="table table-bordered">

<form method="post"/>
<table class="table table-bordered">
<tr>
<td>Nama_Customer</td>
<td><input name="Nama_Customer" type="text" class="form-control" value="<?php echo $hasil_data['Nama_Customer'];?>"/></td>
</tr>

<tr>
<td>Alamat </td>
<td><input name="Alamat" type="text" class="form-control" value="<?php echo $hasil_data['Alamat'];?>"/></td>
</tr>

<tr>
<td>Telpon</td>
<td><input name="Telpon" type= "text" class="form-control"  value="<?php echo $hasil_data['Telpon'];?>"/></td>
</tr>

<tr>
<td>Keterangan</td>
<td><input name="Keterangan" type="text" class="form-control" value="<?php echo $hasil_data['Keterangan'];?>"/></td>
</tr>
<tr>
<td>Jenis Customer</td>
<td> <select name="Jenis" class="form-control">
<option value="<?php echo $hasil_data['Jenis'];?>"/><?php echo $hasil_data['Jenis'];?></option>
<option value="Kontraktor">Kontraktor</option>
<option value="Konsultan">Konsultan</option>

</select></td>
</tr>

<input type="hidden" name="Id_Customer" value ="<?php echo $hasil_data['Id_Customer'];?>"/>

<td><input type="submit" name="save"/></td>
</tr>
</table>
</form>

<?php 
include('Footer.php');

?>