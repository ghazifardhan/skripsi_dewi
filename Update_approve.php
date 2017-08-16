<?php
include ('koneksi.php');
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['authorized'])){
}else{
	echo ("<script type='text/javascript'>alert('Anda harus login');document.location='../index.php';</script>");
}

$tampilan_data=mysql_query("update proses set approve = 1 where Id_Proses='".$_GET['Id_Proses']."'");
if($tampilan_data){
	header("location:tampil_approve.php");
}else{
	echo mysql_error();
}

include('header.php');
?>



<?php 
include('Footer.php');

?>