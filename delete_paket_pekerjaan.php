<?php
include_once('koneksi.php');
$query=mysqli_query($GLOBALS["___mysqli_ston"], "delete from paket_pekerjaan where     Id_Paket_Pekerjaan='".$_GET['Id_Paket_Pekerjaan']."'") or die (mysqli_error($GLOBALS["___mysqli_ston"]));
if($query)header("location:tampilan_paket_pekerjaan.php");else die (mysqli_error($GLOBALS["___mysqli_ston"]));
?> 