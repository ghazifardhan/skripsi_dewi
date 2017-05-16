<?php
include('koneksi.php');
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['authorized'])){
}else{
	echo ("<script type='text/javascript'>alert('Anda harus login');document.location='../index.php';</script>");
}
include('header.php');
?>

<form method="post"/>
<table border="1" class="table table-bordered">

<tr>
<td>Id_Customer</td>
<td>Tanggal_Pengajuan</td>
<td>progress</td>
<td>Tgl_Meeting_Progress</td>
<td>Status</td>
<td colspan="2">Action</td>
</tr>
<?php

$list_proses=mysql_query("select * from proses");
while ($proses=mysql_fetch_array($list_proses)){
	?>
	
	<tr>
	<td><?php echo $proses['Id_Customer'];?></td>
	<td><?php echo $proses ['Tanggal_Pengajuan'];?></td>
	<td><?php echo $proses['progress'];?></td>
    <td><?php echo $proses['Tgl_Meeting_Progress'];?></td>
	<td><?php echo $proses['status'];?></td>

	
    <td><a class="btn btn-warning" href="Update_proses.php?Id_Customer=<?php echo $proses['Id_Customer'];?>">Edit</a><td>
     <td><a class="btn btn-danger" href="delete_proses.php?Id_Customer=<?php echo $proses['Id_Customer'];?>">Delete</a><td>
    </tr>
<?php }?>

</table>

<?php 
include('Footer.php');

?>