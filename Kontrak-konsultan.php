<?php
include("koneksi.php");
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['authorized'])){
}else{
	echo ("<script type='text/javascript'>alert('Anda harus login');document.location='../index.php';</script>");
}
if(isset($_POST['simpan'])){
$query="insert into Kontrak(Id_Kontrak,Jenis_Kontrak,Nilai_Kontrak, Id_Paket_Pekerjaan,Keterangan,Id_Customer)
Value ('".$_POST["Id_Kontrak"]."',
		'".$_POST["Jenis_Kontrak"]."',
		'".$_POST["Nilai_Kontrak"]."',
		'".$_POST["Id_Paket_Pekerjaan"]."',
		'".$_POST["Keterangan"]."',
		'".$_POST["Id_Customer"]."')";

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
<td>Id_Kontrak</td>
<td><input type	="text" name="Id_Kontrak"></td>
</tr>
<tr>
<td>Jenis_Kontrak</td>
<td><input type	="text"name="Jenis_Kontrak"></td>
</tr>

<tr>
<td>Nilai_Kontrak</td>
<td><input type	="text"name="Nilai_Kontrak"></td>
</tr>

<tr>
<td><strong>Id_Paket_Pekerjaan</strong></td>
<td><select name="Id_Paket_Pekerjaan"/>
<option value=""/>------Pilih Id Paket Pekerjaan------</option>
	<?php
	$data=mysql_query("select * from paket_pekerjaan");
	while($list=mysql_fetch_array($data)){?>
		<option value="<?php echo $list['Id_Paket_Pekerjaan'];?>"/><?php echo $list['Nama_Perusahaan'];?></option>
		<?php} ?>
	</select>
	</td>
</tr>

	


<tr>
<td>Keterangan</td>
<td> <input type="text"name="Keterangan"></td>
</tr>

<tr>
<td>Id_customer</td>
<td> <input type="text"name="Id_Customer"></td>
</tr>


</table>
</form>

<?php 
include('Footer.php');
?>