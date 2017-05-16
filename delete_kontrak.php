<?php
include_once('koneksi.php');
$query=mysql_query("delete from kontrak where Id_Kontrak='".$_GET['Id_Kontrak']."'") or die (mysql_error());
if($query)header("location:tampilan_kontrak.php");else die (mysql_error());
?>