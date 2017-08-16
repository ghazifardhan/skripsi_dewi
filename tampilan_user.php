<?php
include('koneksi.php');
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['authorized'])){
}else{
	echo ("<script type='text/javascript'>alert('Anda harus login');document.location='../index.php';</script>");
}
include('header.php');
?>


<table border="1" class="table table-bordered">

<tr>
<td>No User</td>
<td>User Name</td>
<td>Password</td>
<td>Level</td>
<td>Status</td>
<td colspan="2">Action</td>
</tr>
<?php

$list_customer=mysql_query("select * from tbl_login");
while ($proses=mysql_fetch_array($list_customer)){
	?>
	
	<tr>
	<td><?php echo $proses['Id_User'];?></td>
	<td><?php echo $proses ['UserName'];?></td>
	<td><?php echo $proses['Password'];?></td>
	<td><?php echo $proses ['Level'];?></td>
	<td><?php echo $proses ['Status'];?></td>

	
     <td><a  class="btn btn-warning" href="edit_user.php?Id_User=<?php echo $proses['Id_User'];?>">Edit</a><td>
     <td><a class="btn btn-danger" href="delete_user.php?Id_User=<?php echo $proses['Id_User'];?>">Delete</a><td>
    </tr>
<?php }?>

</table>
           

<?php 
include('Footer.php');

?>