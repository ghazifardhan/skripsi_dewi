<?php
include('koneksi.php');

?>

<?php
include('header.php');
?>

<form method="post"/>
<table border="1" class="table table-bordered">

<tr>
<td>Id_Proses</td>
<td>Nilai_Kontrak</td>
<td>Id_Kontrak</td>
<td>Tgl_Pengajuan</td>
<td>Jumlah_Tagihan</td>
<td>Sisa_Tagihan</td>
</tr>
<?php

$list_trx=mysql_query("select * from trx");
while ($proses=mysql_fetch_array($list_trx)){
	?>
	<tr>
	<td><?php echo $proses['Id_Proses'];?></td>
	<td><?php echo $proses ['Nilai_Kontrak'];?></td>
	<td><?php echo $proses['Id_Kontrak'];?></td>
	<td><?php echo $proses ['Tgl_Pengajuan'];?></td>
	<td><?php echo $proses ['Jumlah_Tagihan'];?></td>
    	<td><?php echo $proses ['Sisa_Tagihan'];?></td>
	
    <td><a href="Update_trx.php?Id_Proses=<?php echo $proses['Id_Proses'];?>">Edit</a><td>
     <td><a href="delete_trx.php?Id_Proses=<?php echo $proses['Id_Proses'];?>">Delete</a><td>
    </tr>
<?php }?>

</table>

<?php 
include('Footer.php');

?>
