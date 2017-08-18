<?php
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['authorized'])){
}else{
    echo ("<script type='text/javascript'>alert('Anda harus login');document.location='../index.php';</script>");
}
include("koneksi.php");
if(isset($_POST['simpan'])){
$query="insert into kontrak(Id_Kontrak,Jenis_Kontrak,Nilai_Kontrak, Paket_Pekerjaan,Keterangan,payment,Id_Customer)
Value ('".$_POST["Id_Kontrak"]."',
        '".$_POST["Jenis_Kontrak"]."',
        '".$_POST["Nilai_Kontrak"]."',
        '".$_POST["Paket_Pekerjaan"]."',
        '".$_POST["Keterangan"]."',
        '0',
        '".$_POST["Id_Customer"]."')";
$proses=mysqli_query($GLOBALS["___mysqli_ston"], $query);

if ($proses){
    header('location:tampilan_kontrak.php');
}else{
    echo mysqli_error($GLOBALS["___mysqli_ston"]);
}
}
include('header.php');
?>
<form method="post"/>
<table border="1" class="table table-bordered">

<tr>
<td>Id_Kontrak</td>
<td><input type    ="text"  class="form-control" name="Id_Kontrak"></td>
</tr>
<tr>
<td>Jenis_Kontrak</td>
<td>
    <select name="Jenis_Kontrak" class="form-control">
        <option value="Monthly Progress">Monthly Progress</option>
        <option value="Termin">Termin</option>
    </select>
</td>
</tr>
<tr>
<td>Nilai_Kontrak</td>
<td><input type    ="number" class="form-control" name="Nilai_Kontrak"></td>
</tr>
<tr>
<td>Paket_Pekerjaan</td>
<td> <input type="text" class="form-control" name="Paket_Pekerjaan"></td>
</tr>
<tr>
<td>Keterangan</td>
<td> <input type="text" class="form-control" name="Keterangan"></td>
</tr>

<tr>
<td>Customer</td>
<td> <select class="form-control" name="Id_Customer">
<option value="">Pilih Customer</option>
<?php $pk=mysqli_query($GLOBALS["___mysqli_ston"], "select * from customer");

while($data=mysqli_fetch_array($pk)){
    ?>
    <option value="<?php echo $data['Id_Customer'];?>"><?php echo $data['Nama_Customer'];?></option>
<?php } ?>


</select></td>
</tr>
<tr>
<td><input type="submit"value="simpan" class="btn btn-danger" name="simpan"/></td>
</tr>
</table>
</form>

<?php 
include('Footer.php');

?>