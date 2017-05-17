<?php
include("koneksi.php");
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['authorized'])){
}else{
	echo ("<script type='text/javascript'>alert('Anda harus login');document.location='../index.php';</script>");
}
if(isset($_POST['simpan'])){
$query="update tbl_login set 
UserName='".$_POST["UserName"]."',
Password='".$_POST["Password"]."',
Level='".$_POST["Level"]."',
Status='".$_POST["Status"]."'
where
Id_User='".$_POST["Id_User"]."'";


$proses=mysql_query($query);

if ($proses){
	header('location:tampilan_user.php');
}else{
	echo mysql_error();
}
}
include('header.php');
$user=mysql_query("select * from tbl_login where Id_User='".$_GET['Id_User']."'");
$data=mysql_fetch_array($user);
?>
<form method="post"/>
<table border="1" class="table table-bordered">
<tr>
<td>No User</td>
<td><input type	="text" name="Id_User" class="form-control" value="<?php echo $data['Id_User'];?>" readonly></td>
</tr>
<tr>
<td>UserName</td>
<td><input type	="text"name="UserName" class="form-control" value="<?php echo $data['UserName'];?>" ></td>
</tr>
<tr>
<td>Password</td>
<td><input type	="text"name="Password" class="form-control" value="<?php echo $data['Password'];?>" ></td>
</tr>
<tr>
<td>Level</td>
<td> <select name="Level" class="form-control">
<option value="<?php echo $data['Level'];?>"><?php echo $data['Level'];?>"</option>
<option value="Director">Director</option>
<option value="Manager">Manager</option>
<option value="Konsultan">Konsultan</option>
<option value="Admin">Admin</option>

</select></td>
</tr>
<tr>
<td>Status</td>
<td> <select name="Status" class="form-control">
<option value="<?php echo $data['Status'];?>"><?php echo $data['Status'];?></option>
<option value="Aktif">Aktif</option>
<option value="Tidak Aktif">Tidak Aktif</option>

</select></td>
</tr>

<tr>
<td><input type="submit"value="simpan"name="simpan"/></td>
</tr>
</table>
</form>

<?php 
include('Footer.php');

?>