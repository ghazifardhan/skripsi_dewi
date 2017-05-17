<?php 
session_start();
include('header.php');
if(isset($_SESSION['username']) && isset($_SESSION['authorized'])){
}else{
	echo ("<script type='text/javascript'>alert('Anda harus login');document.location='../index.php';</script>");
}
?>
<div class="col-lg-3 col-xs-6">
      
          </div>
          <!-- /.box -->

    
		
<?php 
include('Footer.php');

?>
