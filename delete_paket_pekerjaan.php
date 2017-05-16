<?php
include_once('koneksi.php');
$query=mysql_query("delete from paket_pekerjaan where 	Id_Paket_Pekerjaan='".$_GET['Id_Paket_Pekerjaan']."'") or die (mysql_error());
if($query)header("location:tampilan_paket_pekerjaan.php");else die (mysql_error());
?>