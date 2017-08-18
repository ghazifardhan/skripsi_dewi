<?php
include("koneksi.php");
if(isset($_POST['simpan'])){

if($_POST["Sisa_Tagihan"] == 0)
{
    $jumlah = $_POST['Nilai_Kontrak'] - $_POST["Jumlah_Tagihan"];
}
else
{
    $jumlah = $_POST["Sisa_Tagihan"] - $_POST["Jumlah_Tagihan"];
}
//die(var_dump($_POST));
$query="insert into trx(Id_Proses,Nilai_Kontrak,Id_Kontrak, Tgl_Pengajuan,Jumlah_Tagihan,Sisa_Tagihan)
Value ('".$_POST["Id_Proses"]."',
        '".$_POST["Nilai_Kontrak"]."',
        '".$_POST["Id_Kontrak"]."',
        '".$_POST["Tgl_Pengajuan"]."',
        '".$_POST["Jumlah_Tagihan"]."',
        '".$jumlah."')";


$proses=mysqli_query($GLOBALS["___mysqli_ston"], $query);

if ($proses){

    $update_kontrak = mysqli_query($GLOBALS["___mysqli_ston"], "update kontrak set payment=payment+'".$_POST['Jumlah_Tagihan']."' where id_kontrak='".$_POST['Id_Kontrak']."'");
    $update_proses = mysqli_query($GLOBALS["___mysqli_ston"], "update proses set status='LUNAS' where Id_Proses='".$_POST['Id_Proses']."'");
    
    header('location:tampilan_trx.php');
}else{
    echo mysqli_error($GLOBALS["___mysqli_ston"]);
}
}
include('header.php');
?>
<form method="post" enctype="multipart/form-data">
<table border="1" class="table table-bordered">
<tr>
<td>Customer</td>
<td> <select class="form-control" class="form-control" name="Id_Customer" id="kodebarang">
<option value="">Pilih Customer</option>
<?php $pk=mysqli_query($GLOBALS["___mysqli_ston"], "select * from customer");

while($data=mysqli_fetch_array($pk)){
    ?>
    <option value="<?php echo $data['Id_Customer'];?>"><?php echo $data['Nama_Customer'];?></option>
<?php } ?>


</select></td>
</tr>
<tr>
<td>Proses Pengerjaan(%)</td>
<td><input type    ="text" class="form-control" id="progres"></td>
<input type    ="hidden" class="form-control" name="Id_Proses" id="Id_Proses">
</tr>
<tr>
<td>Nilai_Kontrak</td>
<td><input type="number" class="form-control" name="Nilai_Kontrak" id="nilai" readonly></td>

</tr>

<input type="hidden" class="form-control" name="Id_Kontrak" id="id_kontrak">
<tr>
<td>Tgl_Pengajuan</td>
<td> <input type="date"class="form-control datepicker" name="Tgl_Pengajuan"></td>
</tr>
<tr>
<td>Jumlah_Tagihan</td>
<td> <input type="number" class="form-control" name="Jumlah_Tagihan"></td>
</tr>
<tr>
<td>Sisa_Tagihan</td>
<td> <input type="number" class="form-control" name="Sisa_Tagihan" id="top" readonly></td>
</tr>
<tr>
<td>Jenis Customer</td>
<td> <input type="text"class="form-control" name="" id="jenis" readonly></td>
</tr>
<tr>
<td>Jenis Kontrak</td>
<td> <input type="text" class="form-control" name="" id="jenis_kontrak" readonly></td>
</tr>


<tr>
<td><input type="submit"value="simpan"class="btn btn-danger" name="simpan"/></td>
</tr>
</table>
</form>


<?php 
include('Footer.php');

?>
<script type="text/javascript">
$(document).ready(function(){
$("#kodebarang").click(function(){
    var kodebarang=$("#kodebarang").val();
    $.ajax({
        url:"get_trx.php",
        data:"kodebarang="+kodebarang,
        success:function(resp){
            /*
            var data = value.split(",");
            $("#progres").val(data[0]);
            $("#jenis").val(data[1]);
            $("#jenis_kontrak").val(data[2]);
            $("#nilai").val(data[3]);
            $("#Id_Proses").val(data[4]);
            $("#id_kontrak").val(data[5]);
            $("#top").val(data[6]);
            */
            console.log(resp.data);
            $("#progres").val(resp.data.progress);
            $("#jenis").val(resp.data.jenis);
            $("#jenis_kontrak").val(resp.data.jenis_kontrak);
            $("#nilai").val(resp.data.nilai);
            $("#Id_Proses").val(resp.data.id_proses);
            $("#id_kontrak").val(resp.data.id_kontrak);
            $("#top").val(resp.data.top);
            
            }
        
        
        });
    
    });
    });
</script> 