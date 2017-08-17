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

<td>Nama Customer</td>
<td>Jenis Customer</td>
<td>Proses</td>
<td>Progres</td>
<td>Nilai_Kontrak</td>
<td>Jenis_Kontrak</td>
<td>Tgl_Pengajuan</td>
<td>Jumlah_Tagihan</td>
<td>Sisa_Tagihan</td>

</tr>
<?php

$list_trx=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT
  `trx`.*,
  `customer`.`Nama_Customer`,
  `proses`.`progress`,
  `proses`.`status`,
  `customer`.`Jenis`,
  `kontrak`.`Jenis_Kontrak`,
  `kontrak`.`Nilai_kontrak` AS `Nilai_kontrak1`
FROM
  `trx`
  INNER JOIN `proses` ON `trx`.`Id_Proses` = `proses`.`Id_Proses`
  INNER JOIN `customer` ON `proses`.`Id_Customer` = `customer`.`Id_Customer`
  INNER JOIN `kontrak` ON `trx`.`Id_Kontrak` = `kontrak`.`Id_Kontrak` where `customer`.`Jenis` ='Konsultan'");
while ($proses=mysqli_fetch_array($list_trx)){
    ?>
    <tr>
    <td><?php echo $proses['Nama_Customer'];?></td>
    <td><?php echo $proses['Jenis'];?></td>
    <td><?php echo $proses['status'];?></td>
    <td><?php echo $proses['progress'];?></td>
    <td>Rp.<?php echo number_format($proses['Nilai_Kontrak']);?></td>
    <td><?php echo $proses['Jenis_Kontrak'];?></td>
    <td><?php echo $proses['Tgl_Pengajuan'];?></td>
    <td>Rp.<?php echo number_format($proses['Jumlah_Tagihan']);?></td>
    <td>Rp.<?php echo number_format($proses['Sisa_Tagihan']);?></td>

    
    <td><a class="btn btn-warning" href="Update_trx.php?Id_Proses=<?php echo $proses['Id_Proses'];?>">Edit</a><td>
     <td><a class="btn btn-danger" href="delete_trx.php?Id_Proses=<?php echo $proses['Id_Proses'];?>">Delete</a><td>
    </tr>
<?php }?>

</table>
                
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
              <h1>List Customer Kontraktor</h1>
              <form method="post"/>
<form method="post"/>
<table border="1" class="table table-bordered">

<tr>

<td>Nama Customer</td>
<td>Jenis Customer</td>
<td>Proses</td>
<td>Progres</td>
<td>Nilai_Kontrak</td>
<td>Jenis_Kontrak</td>
<td>Tgl_Pengajuan</td>
<td>Jumlah_Tagihan</td>
<td>Sisa_Tagihan</td>

</tr>
<?php
$qs = "SELECT
  `trx`.*,
  `customer`.`Nama_Customer`,
  `proses`.`progress`,
  `proses`.`status`,
  `customer`.`Jenis`,
  `kontrak`.`Jenis_Kontrak`,
  `kontrak`.`Nilai_kontrak` AS `Nilai_kontrak1`
FROM
  `trx`
  INNER JOIN `proses` ON `trx`.`Id_Proses` = `proses`.`Id_Proses`
  INNER JOIN `customer` ON `proses`.`Id_Customer` = `customer`.`Id_Customer`
  INNER JOIN `kontrak` ON `trx`.`Id_Kontrak` = `kontrak`.`Id_Kontrak` where `customer`.`Jenis` ='Kontraktor'";
$list_trx=mysqli_query($GLOBALS["___mysqli_ston"], $qs);
while ($proses=mysqli_fetch_array($list_trx)){
    ?>
    <tr>
    <td><?php echo $proses['Nama_Customer'];?></td>
    <td><?php echo $proses['Jenis'];?></td>
    <td><?php echo $proses['status'];?></td>
    <td><?php echo $proses['progress'];?></td>
    <td>Rp.<?php echo number_format($proses['Nilai_Kontrak']);?></td>
    <td><?php echo $proses['Jenis_Kontrak'];?></td>
    <td><?php echo $proses['Tgl_Pengajuan'];?></td>
    <td>Rp.<?php echo number_format($proses['Jumlah_Tagihan']);?></td>
    <td>Rp.<?php echo number_format($proses['Sisa_Tagihan']);?></td>
<!--    <td><a href="<php echo $proses['berita_acara'] ?>"><php echo $proses['berita_acara'] ?></a></td>-->
    
    <td><a class="btn btn-warning" href="Update_trx.php?Id_Proses=<?php echo $proses['Id_Proses'];?>">Edit</a><td>
     <td><a class="btn btn-danger" href="delete_trx.php?Id_Proses=<?php echo $proses['Id_Proses'];?>">Delete</a><td>
    
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
function dd($var)
{
    die(var_dump($var));
}
?> 