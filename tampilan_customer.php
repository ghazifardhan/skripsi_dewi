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
<table border="1" class="table table-bordered">

<tr>
<td>Id_Customer</td>
<td>Nama_Customer</td>
<td>Alamat</td>
<td>Telpon</td>
<td>Keterangan</td>
<td>Jenis Customer</td>
<td colspan="2">Action</td>
</tr>
<?php

$list_customer=mysqli_query($GLOBALS["___mysqli_ston"], "select * from customer where jenis='Konsultan'");
while ($proses=mysqli_fetch_array($list_customer)){
    ?>
    
    <tr>
    <td><?php echo $proses['Id_Customer'];?></td>
    <td><?php echo $proses ['Nama_Customer'];?></td>
    <td><?php echo $proses['Alamat'];?></td>
    <td><?php echo $proses ['Telpon'];?></td>
    <td><?php echo $proses ['Keterangan'];?></td>
    <td><?php echo $proses ['Jenis'];?></td>
    
    <td><a  class="btn btn-warning" href="Update_Customer.php?Id_Customer=<?php echo $proses['Id_Customer'];?>">Edit</a><td>
     <td><a class="btn btn-danger" href="delete_customer.php?Id_Customer=<?php echo $proses['Id_Customer'];?>">Delete</a><td>
    </tr>
<?php }?>

</table>
                
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
              <h1>List Customer Kontraktor</h1>
              <form method="post"/>
<table border="1" class="table table-bordered">

<tr>
<td>Id_Customer</td>
<td>Nama_Customer</td>
<td>Alamat</td>
<td>Telpon</td>
<td>Keterangan</td>
<td>Jenis Customer</td>
<td colspan="2">Action</td>
</tr>
<?php

$list_customer=mysqli_query($GLOBALS["___mysqli_ston"], "select * from customer where jenis='Kontraktor'");
while ($proses=mysqli_fetch_array($list_customer)){
    ?>
    
    <tr>
    <td><?php echo $proses['Id_Customer'];?></td>
    <td><?php echo $proses ['Nama_Customer'];?></td>
    <td><?php echo $proses['Alamat'];?></td>
    <td><?php echo $proses ['Telpon'];?></td>
    <td><?php echo $proses ['Keterangan'];?></td>
    <td><?php echo $proses ['Jenis'];?></td>
    
     <td><a  class="btn btn-warning" href="Update_Customer.php?Id_Customer=<?php echo $proses['Id_Customer'];?>">Edit</a><td>
     <td><a class="btn btn-danger" href="delete_customer.php?Id_Customer=<?php echo $proses['Id_Customer'];?>">Delete</a><td>
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