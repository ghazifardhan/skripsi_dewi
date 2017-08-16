<?php
include('koneksi.php');
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['authorized'])){
}else{
	echo ("<script type='text/javascript'>alert('Anda harus login');document.location='../index.php';</script>");
}
include('header.php');
?>


<div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">Konsultan</a></li>
              <li><a href="#tab_2" data-toggle="tab">Kontraktor</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
			  <h1>List Customer Konsultan</h1>
<form method="post"/>
<table class="table table-bordered">

<tr>
<td>Id_Kontrak</td>
<td>Jenis_Kontrak</td>
<td>Nilai_kontrak</td>
<td>Paket_Pekerjaan</td>
<td>Keterangan</td>
<td>Nama Customer</td>
<td colspan="4">Action</td>
</tr>
<?php

$list_kontrak=mysql_query(" SELECT
  `kontrak`.*,
  `customer`.`Nama_Customer`
FROM
  `kontrak`
  INNER JOIN `customer` ON `kontrak`.`Id_Customer` = `customer`.`Id_Customer` where `customer`.`Jenis` ='Konsultan'");
while ($proses=mysql_fetch_array($list_kontrak)){
	?>
	
	<tr>
	<tr>
	<td><?php echo $proses['Id_Kontrak'];?></td>
	<td><?php echo $proses ['Jenis_Kontrak'];?></td>
    <td>Rp.<?php echo number_format($proses['Nilai_kontrak']);?></td>
	<td><?php echo $proses['Paket_Pekerjaan'];?></td>
	<td><?php echo $proses ['Keterangan'];?></td>
	<td><?php echo $proses ['Nama_Customer'];?></td>
	
	 <td><a class="btn btn-warning" href="Update_kontrak.php?Id_Kontrak=<?php echo $proses['Id_Kontrak'];?>">Edit</a><td>
   
     <td><a class="btn btn-danger" href="delete_kontrak.php?Id_Kontrak=<?php echo $proses['Id_Kontrak'];?>">Delete</a><td>
    </tr>
<?php }?>

</table>
                
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
			  <h1>List Customer Kontraktor</h1>
              <form method="post"/>
<table class="table table-bordered">

<tr>
<td>Id_Kontrak</td>
<td>Jenis_Kontrak</td>
<td>Nilai_kontrak</td>
<td>Paket_Pekerjaan</td>
<td>Keterangan</td>
<td>Nama Customer</td>
<td colspan="4">Action</td>
</tr>
<?php

$list_kontrak=mysql_query("SELECT
  `kontrak`.*,
  `customer`.`Nama_Customer`
FROM
  `kontrak`
  INNER JOIN `customer` ON `kontrak`.`Id_Customer` = `customer`.`Id_Customer` where `customer`.`Jenis` ='Kontraktor'");
while ($proses=mysql_fetch_array($list_kontrak)){
	?>
	
	<tr>
	<tr>
	<td><?php echo $proses['Id_Kontrak'];?></td>
	<td><?php echo $proses ['Jenis_Kontrak'];?></td>
    <td>Rp.<?php echo number_format($proses['Nilai_kontrak']);?></td>
	<td><?php echo $proses['Paket_Pekerjaan'];?></td>
	<td><?php echo $proses ['Keterangan'];?></td>
	<td><?php echo $proses ['Nama_Customer'];?></td>
	
	 <td><a class="btn btn-warning" href="Update_kontrak.php?Id_Kontrak=<?php echo $proses['Id_Kontrak'];?>">Edit</a><td>
   
     <td><a class="btn btn-danger" href="delete_kontrak.php?Id_Kontrak=<?php echo $proses['Id_Kontrak'];?>">Delete</a><td>
    </tr>
<?php }?>

</table>
              </div>
              
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>

<?php 
include('Footer.php');

?>