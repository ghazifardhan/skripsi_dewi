<?php
include_once('koneksi.php');
$query=mysqli_query($GLOBALS["___mysqli_ston"], "delete from kontrak where Id_Kontrak='".$_GET['Id_Kontrak']."'") or die (mysqli_error($GLOBALS["___mysqli_ston"]));
if($query)header("location:tampilan_kontrak.php");else die (mysqli_error($GLOBALS["___mysqli_ston"]));
?> 