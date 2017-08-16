<?php
include ('koneksi.php');
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['authorized'])){
}else{
	echo ("<script type='text/javascript'>alert('Anda harus login');document.location='../index.php';</script>");
}
if(isset($_POST['save'])){
$query_update=mysql_query("UPDATE Kontrak set
Jenis_Kontrak ='".$_POST['Jenis_Kontrak']."',
Nilai_kontrak='".$_POST['Nilai_kontrak']."',
Paket_Pekerjaan='".$_POST['Paket_Pekerjaan']."',
Keterangan='".$_POST['Keterangan']."',
Id_Customer='".$_POST['Id_Customer']."'
where
	Id_Kontrak='".$_POST['Id_Kontrak']."'");
if($query_update){
	header("location:tampilan_kontrak.php");
}else{
	echo mysql_error();
}
}
$tampilan_data=mysql_query("select*from Kontrak where
Id_Kontrak='".$_GET['Id_Kontrak']."'");
$hasil_data= mysql_fetch_array($tampilan_data);

include('header.php');
?>

<form method="post"/>
<table border="1" class="table table-bordered">

<form method="post"/>
<table>
<tr>
<td>Jenis_Kontrak</td>
<td><input name="Jenis_Kontrak" type="text" value="<?php echo $hasil_data['Jenis_Kontrak'];?>"/></td>
</tr>

<tr>
<td>Nilai_kontrak</td>
<td><input name="Nilai_kontrak" type="text" value="<?php echo $hasil_data['Nilai_kontrak'];?>"/></td>
</tr>

<tr>
<td>Paket_Pekerjaan</td>
<td><input name="Paket_Pekerjaan" type= "text" value="<?php echo $hasil_data['Id_Paket_Pekerjaan'];?>"/></td>
</tr>

<tr>
<td>Keterangan</td>
<td><input name="Keterangan" type="text" value="<?php echo $hasil_data['Keterangan'];?>"/></td>
</tr>

<tr>
<td>Id_Customer</td>
<td><input name="Id_Customer" type="text" value="<?php echo $hasil_data['Id_Customer'];?>"/></td>
</tr>


<input type="hidden" name="Id_Kontrak" value ="<?php echo $hasil_data['Id_Kontrak'];?>"/>

<tr>
<td><input type="submit" name="save"/></td>

</tr>
</table>
</form>

<?php 
include('Footer.php');

?>