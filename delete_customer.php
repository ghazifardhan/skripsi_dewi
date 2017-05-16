<?php
include_once('koneksi.php');
$query=mysql_query("delete from customer where Id_Customer='".$_GET['Id_Customer']."'") or die (mysql_error());
if($query)header("location:tampilan_customer.php");else die (mysql_error());
?>