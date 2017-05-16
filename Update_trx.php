<?php
include ('koneksi.php');
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['authorized'])){
}else{
	echo ("<script type='text/javascript'>alert('Anda harus login');document.location='../index.php';</script>");
}
if(isset($_POST['save'])){
$query_update=mysql_query("UPDATE trx set
Nilai_Kontrak ='".$_POST['Nilai_Kontrak']."',
Id_Kontrak ='".$_POST['Id_Kontrak']."',
Tgl_Pengajuan='".$_POST['Tgl_Pengajuan']."',
Jumlah_Tagihan	='".$_POST['Jumlah_Tagihan']."',
Sisa_Tagihan='".$_POST['Sisa_Tagihan']."'
where
Id_Proses='".$_POST['Id_Proses']."'");
if($query_update){
	header("location:tampilan_trx.php");
}else{
	echo mysql_error();
}
}
$tampilan_data=mysql_query("select*from trx where
Id_Proses='".$_GET['Id_Proses']."'");
$hasil_data= mysql_fetch_array($tampilan_data);
include('header.php');
?>
<form method="post"/>
<table class="table table-bordered">
<tr>
<td>Nilai_Kontrak</td>
<td><input name="Nilai_Kontrak" type="text" class="form-control" value="<?php echo $hasil_data['Nilai_Kontrak'];?>"/></td>
</tr>

<tr>
<td>Id_Kontrak</td>
<td><input name="Id_Kontrak" type="text" class="form-control" value="<?php echo $hasil_data['Id_Kontrak'];?>"/></td>
</tr>

<tr>
<td>Tgl_Pengajuan</td>
<td><input name="Tgl_Pengajuan" type= "text" class="form-control" value="<?php echo $hasil_data['Tgl_Pengajuan'];?>"/></td>
</tr>

<tr>
<td>Jumlah_Tagihan</td>
<td><input name="Jumlah_Tagihan" type="text" class="form-control" value="<?php echo $hasil_data['Jumlah_Tagihan'];?>"/></td>
</tr>

<tr>
<td>Sisa_Tagihan</td>
<td><input name="Sisa_Tagihan" type="text" class="form-control" value="<?php echo $hasil_data['Sisa_Tagihan'];?>"/></td>
</tr>

<input type="hidden" name="Id_Proses" class="form-control" value ="<?php echo $hasil_data['Id_Proses'];?>"/>

<tr>
<td><input type="submit" class="btn btn-danger"name="save"/></td>

</tr>
</table>
</form>
<?php 
include('Footer.php');
?>