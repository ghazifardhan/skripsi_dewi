<?php
include ('koneksi.php');
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['authorized'])){
}else{
	echo ("<script type='text/javascript'>alert('Anda harus login');document.location='../index.php';</script>");
}
if(isset($_POST['save'])){
$query_update=mysql_query("UPDATE proses set
Tanggal_Pengajuan ='".$_POST['Tanggal_Pengajuan']."',
progress='".$_POST['progress']."',
Tgl_Meeting_Progress='".$_POST['Tgl_Meeting_Progress']."'
where
Id_Customer='".$_POST['Id_Customer']."'");
if($query_update){
	header("location:tampilan_proses.php");
}else{
	echo mysql_error();
}
}
$tampilan_data=mysql_query("select*from proses where
Id_Customer='".$_GET['Id_Customer']."'");
$hasil_data= mysql_fetch_array($tampilan_data);

include('header.php');
?>

<form method="post"/>
<table border="1" class="table table-bordered">

<form method="post"/>
<table>
<tr>
<td>Tanggal_Pengajuan</td>
<td><input name="Tanggal_Pengajuan" type="text" value="<?php echo $hasil_data['Tanggal_Pengajuan'];?>"/></td>
</tr>

<tr>
<td>progress</td>
<td><input name="progress" type="text" value="<?php echo $hasil_data['progress'];?>"/></td>
</tr>

<tr>
<td>Tgl_Meeting_Progress</td>
<td><input name="Tgl_Meeting_Progress" type= "text" value="<?php echo $hasil_data['Tgl_Meeting_Progress'];?>"/></td>
</tr>

<input type="hidden" name="Id_Customer" value ="<?php echo $hasil_data['Id_Customer'];?>"/>

<tr>
<td><input type="submit" name="save"/></td>

</tr>
</table>
</form>

<?php 
include('Footer.php');

?>