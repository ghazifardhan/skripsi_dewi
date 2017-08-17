<?php
include('koneksi.php');
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['authorized'])){
}else{
    echo ("<script type='text/javascript'>alert('Anda harus login');document.location='../index.php';</script>");
}
?>


<?php
include('header.php');
?>

<form method="post"/>
<table border="1" class="table table-bordered">

<tr>
<td>Id_Paket_Pekerjaan</td>
<td>Nama_Perusahaan</td>
<td>Keterangan</td>
</tr>
<?php

$list_paket_pekerjaan=mysqli_query($GLOBALS["___mysqli_ston"], "select * from paket_pekerjaan");
while ($proses=mysqli_fetch_array($list_paket_pekerjaan)){
    ?>
    
    <tr>
    <td><?php echo $proses['Id_Paket_Pekerjaan'];?></td>
    <td><?php echo $proses ['Nama_Perusahaan'];?></td>
    <td><?php echo $proses['Keterangan'];?></td>

    
    <td><a class="btn btn-warning" href="Update_paket_pekerjaan.php?Id_Paket_Pekerjaan=<?php echo $proses['Id_Paket_Pekerjaan'];?>">Edit</a><td>
     <td><a class="btn btn-warning" href="delete_paket_pekerjaan.php?Id_Paket_Pekerjaan=<?php echo $proses['Id_Paket_Pekerjaan'];?>">Delete</a><td>
    </tr>
<?php }?>

</table>

<?php 
include('Footer.php');

?> 