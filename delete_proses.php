<?php
include_once('koneksi.php');
$query=mysqli_query($GLOBALS["___mysqli_ston"], "delete from proses where Id_Proses='".$_GET['Id_Proses']."'") or die (mysqli_error($GLOBALS["___mysqli_ston"]));
if($query)header("location:tampilan_proses.php");else die (mysqli_error($GLOBALS["___mysqli_ston"]));
?> 