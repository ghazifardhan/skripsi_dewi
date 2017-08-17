<?php
include_once('koneksi.php');
$query=mysqli_query($GLOBALS["___mysqli_ston"], "delete from customer where Id_Customer='".$_GET['Id_Customer']."'") or die (mysqli_error($GLOBALS["___mysqli_ston"]));
if($query)header("location:tampilan_customer.php");else die (mysqli_error($GLOBALS["___mysqli_ston"]));
?> 