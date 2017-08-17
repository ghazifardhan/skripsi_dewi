<?php
include('koneksi.php');
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['authorized'])){
}else{
    echo ("<script type='text/javascript'>alert('Anda harus login');document.location='../index.php';</script>");
}
include('header.php');
?>

<form method="post"/>
<table border="1" class="table table-bordered">

<tr>
<td>Id_Customer</td>
<td>Tanggal_Pengajuan</td>
<td>progress</td>
<td>Tgl_Meeting_Progress</td>
<td>Status</td>
<td>Berita Acara</td>
<td>Approve</td>
<td colspan="2">Action</td>
</tr>
<?php

$list_proses=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT
  `proses`.*,
  `customer`.`Nama_Customer`
FROM
  `proses`
  INNER JOIN `customer` ON `proses`.`Id_Customer` = `customer`.`Id_Customer`");
while ($proses=mysqli_fetch_array($list_proses)){
    ?>
    
    <tr>
    <td><?php echo $proses['Nama_Customer'];?></td>
    <td><?php echo $proses ['Tanggal_Pengajuan'];?></td>
    <td><?php echo $proses['progress'];?></td>
    <td><?php echo $proses['Tgl_Meeting_Progress'];?></td>
    <td><?php echo $proses['status'];?></td>
    <td><a href="<?php echo $proses['berita_acara'] ?>"><?php echo $proses['berita_acara'] ?></a></td>
    <td><?php 
    if($proses['approve']=== '1'){
        echo 'Sudah Di approve';
    }else{
        echo 'Belum approve';
    }?>
    
    </td>
    
    <td><a class="btn btn-warning" href="Update_approve.php?Id_Proses=<?php echo $proses['Id_Proses'];?>">Approve</a><td>
     
    </tr>
<?php }?>

</table>

<?php 
include('Footer.php');

?> 