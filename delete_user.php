<?php
include_once('koneksi.php');
$query=mysql_query("delete from tbl_login where Id_User='".$_GET['Id_User']."'") or die (mysql_error());
if($query)header("location:tampilan_user.php");else die (mysql_error());
?>