<?php
include_once('koneksi.php');
$query=mysql_query("delete from proses where Id_Proses='".$_GET['Id_Proses']."'") or die (mysql_error());
if($query)header("location:tampilan_proses.php");else die (mysql_error());
?>