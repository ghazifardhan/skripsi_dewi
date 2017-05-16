<?php
include("koneksi.php");
if(isset($_POST['simpan'])){
$query="insert into proses(Id_Customer,Tanggal_Pengajuan,progress,Tgl_Meeting_Progress,status)
Value ('".$_POST["Id_Customer"]."',
		'".$_POST["Tanggal_Pengajuan"]."',
		'".$_POST["progress"]."',
		'".$_POST["Tgl_Meeting_Progress"]."',
		'".$_POST["status"]."')";
		

$proses=mysql_query($query);

if ($proses){
	header("location:tampilan_proses.php");
}else{
	echo mysql_error();
}
}
include('header.php');
?>

<form method="post"/>
<table border="1" class="table table-bordered">
<tr>
<td>Customer</td>
<td> <select class="form-control" class="form-control" name="Id_Customer">
<option value="">Pilih Customer</option>
<?php $pk=mysql_query("select * from customer");

while($data=mysql_fetch_array($pk)){
	?>
	<option value="<?php echo $data['Id_Customer'];?>"><?php echo $data['Nama_Customer'];?></option>
<?php } ?>


</select></td>
</tr>
<tr>
<td>Tanggal_Pengajuan</td>
<td><input type	="text"class="form-control datepicker" name="Tanggal_Pengajuan"/></td>
</tr>
<tr>
<td>progress(%)</td>
<td><input type	="text"class="form-control" name="progress"/></td>
<tr>
<td>Tgl_Meeting_Progress</td>
<td><input type	="text"class="form-control datepicker" name="Tgl_Meeting_Progress"/>
<input type	="hidden"class="form-control " name="status" value="BELUM LUNAS"/>
</td>
</tr>
</tr>
<tr>
<td><input type="submit"value="simpan"class="btn btn-danger" name="simpan"/></td>
</tr>
</table>
</form>

<?php 
include('Footer.php');

?>