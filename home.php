<?php 
session_start();
include('header.php');
if(isset($_SESSION['username']) && isset($_SESSION['authorized'])){
}else{
	echo ("<script type='text/javascript'>alert('Anda harus login');document.location='../index.php';</script>");
}
?>
<?php if($_SESSION['level']==='Konsultan'){ ?>
	<table border="0">
	<tr>
	<td><a href="files/Contoh BAP & BAPKP UTK konsultan.xls">Dowload Dokumen BAPKP & BAP<strong></strong></a></td>
	</tr>
		
	</table>
	
<?php }elseif($_SESSION['level']==='Kontraktor'){  ?>
<table border="0">
	<table border="0">
	<tr>
	<br>
	<td><a href="files/Contoh BAP & BAPKP UTK kontraktor.xls"><strong>Dowload Dokumen BAPKP & BAP</strong></a></td></br>
	<tr>
	<td><br><a href="files/Monitoring_Progress_Fisik.xls"><strong>Dowload Dokumen Progres</strong></a></br></td>
	</tr>
	</tr>
	</table>
	

	
<?php } ?>
<div clas="row">
<br>
<br>
<br>
      <center><img src="LOGO_VIC ORI.jpg" width="50%"/><center>
          </div>
          

    
		
<?php 
include('Footer.php');

?>
