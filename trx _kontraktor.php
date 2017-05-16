<?php
include("koneksi.php");
if(isset($_POST['simpan'])){
$query="insert into trx(Id_Proses,Nilai_Kontrak,Id_Kontrak, Tgl_Pengajuan,Jumlah_Tagihan,Sisa_Tagihan)
Value ('".$_POST["Id_Proses"]."',
		'".$_POST["Nilai_Kontrak"]."',
		'".$_POST["Id_Kontrak"]."',
		'".$_POST["Tgl_Pengajuan"]."',
		'".$_POST["Jumlah_Tagihan"]."',
		'".$_POST["Sisa_Tagihan"]."')";

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
<td>Id_Proses</td>
<td><input type	="text" name="Id_Proses"></td>
</tr>
<tr>
<td>Nilai_Kontrak</td>
<td><input type	="text"name="Nilai_Kontrak"></td>
</tr>
<tr>
<td>Id_Kontrak</td>
<td><input type	="text"name="Id_Kontrak"></td>
</tr>
<tr>
<td>Tgl_Pengajuan</td>
<td> <input type="text"name="Tgl_Pengajuan"></td>
</tr>
<tr>
<td>Jumlah_Tagihan</td>
<td> <input type="text"name="Jumlah_Tagihan"></td>
</tr>
<tr>
<td>Sisa_Tagihan</td>
<td> <input type="text"name="Sisa_Tagihan"></td>
</tr>
<tr>
<td><input type="submit"value="simpan"name="simpan"/></td>
</tr>
</table>
</form>

<?php 
include('Footer.php');

?>