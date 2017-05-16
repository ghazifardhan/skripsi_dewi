<?php
include ('koneksi.php');
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['authorized'])){
}else{
	echo ("<script type='text/javascript'>alert('Anda harus login');document.location='../index.php';</script>");
}
if(isset($_POST['save'])){
$query_update=mysql_query("UPDATE paket_pekerjaan set
Nama_Perusahaan ='".$_POST['Nama_Perusahaan']."',
Keterangan='".$_POST['Keterangan']."'
where
Id_Paket_Pekerjaan='".$_POST['Id_Paket_Pekerjaan']."'");
if($query_update){
	header("location :tampilan_paket_pekerjaan.php");
}else{
	echo mysql_error();
}
}
$tampilan_data=mysql_query("select * from paket_pekerjaan where
Id_Paket_Pekerjaan='".$_GET['Id_Paket_Pekerjaan']."'");
$hasil_data= mysql_fetch_array($tampilan_data);

include('header.php');
?>

<form method="post"/>
<table border="1" class="table table-bordered">

<form method="post"/>
<table>
<tr>
<td>Nama_Perusahaan</td>
<td><input name="Nama_Perusahaan" type="text" value="<?php echo $hasil_data['Nama_Perusahaan'];?>"/></td>
</tr>

<tr>
<td>Keterangan </td>
<td><input name="Keterangan" type="text" value="<?php echo $hasil_data['Keterangan'];?>"/></td>
</tr>


<input type="hidden" name="Id_Paket_Pekerjaan" value ="<?php echo $hasil_data['Id_Paket_Pekerjaan'];?>"/>

<tr>
<td><input type="submit" name="save"/></td>

</tr>
</table>
</form>

<?php 
include('Footer.php');

?>