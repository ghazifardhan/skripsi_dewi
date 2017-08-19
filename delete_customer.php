<?php
include_once('koneksi.php');
$query=mysqli_query($GLOBALS["___mysqli_ston"], "delete from customer where Id_Customer='".$_GET['Id_Customer']."'") or die (mysql_error());
if($query)header("location:tampilan_customer.php");else die (mysql_error());
?>