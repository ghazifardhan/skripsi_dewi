<?php
include("koneksi.php");
if(isset($_POST['simpan'])){

    $tgl_peng = $_POST["Tanggal_Pengajuan"];
    $tgl_meet = $_POST["Tgl_Meeting_Progress"];
    $time_date = date("m");
    $tgl_pengajuan = date("m", strtotime($tgl_peng));
    $tgl_meeting = date("m", strtotime($tgl_meet));
    if($tgl_pengajuan != $time_date || $tgl_meeting != $time_date){
        echo ("<script type='text/javascript'>alert('Tanggal harus sesuai dengan bulan ini');</script>");
    } else {
        $allowed_ext    = array("doc", "docx", "xls", "xlsx", "ppt", "pptx", "pdf", "rar", "zip");
        $file_name        =$_FILES['file']['name'];
        $file_size        =$_FILES['file']['size'];
        $file_tmp        =$_FILES['file']['tmp_name'];
        $gambar         = $file_name;
        $file_ext       = strtolower(end(explode(".",$gambar)));
        $tmp            = $file_tmp;
        $lokasi          = 'files/'.$gambar.'.'.$file_ext;
        
            move_uploaded_file($tmp,$lokasi);
    $query="INSERT into proses(Id_Customer,Tanggal_Pengajuan,progress,Tgl_Meeting_Progress,status,berita_acara)
    Value ('".$_POST["Id_Customer"]."',
            '".$_POST["Tanggal_Pengajuan"]."',
            '".$_POST["progress"]."',
            '".$_POST["Tgl_Meeting_Progress"]."',
            '".$_POST["status"]."',
            '".$lokasi."')";
            
    
    $proses=mysqli_query($GLOBALS["___mysqli_ston"], $query);
    
    if ($proses){
        header("location:tampilan_proses.php");
    }else{
        echo mysqli_error($GLOBALS["___mysqli_ston"]);
    }
    }
}
include('header.php');
?>
<form method="post" enctype="multipart/form-data">
<table border="1" class="table table-bordered">
<tr>
<td>Customer</td>
<td> <select class="form-control" class="form-control" name="Id_Customer">
<option value="">Pilih Customer</option>
<?php $pk=mysqli_query($GLOBALS["___mysqli_ston"], "select * from customer");

while($data=mysqli_fetch_array($pk)){
    ?>
    <option value="<?php echo $data['Id_Customer'];?>"><?php echo $data['Nama_Customer'];?></option>
<?php } ?>


</select></td>
</tr>
<tr>
<td>Tanggal_Pengajuan</td>
<td><input type    ="text"class="form-control datepicker" name="Tanggal_Pengajuan"/></td>
</tr>
<tr>
<td>progress(%)</td>
<td><input type    ="text"class="form-control" name="progress"/></td>
</tr>
<tr>
<td>Tgl_Meeting_Progress</td>
<td><input type="text" class="form-control datepicker" name="Tgl_Meeting_Progress"/>
<input type="hidden" class="form-control " name="status" value="BELUM LUNAS"/>
</td>
</tr>
<tr>
<td>Upload Berita acara</td>
<td> <input type="file" name="file" id="textfield3" class="form-control" /></td>
</tr>
<tr>
<td><input type="submit"value="simpan"class="btn btn-danger" name="simpan"/></td>
</tr>
</table>
</form>

<?php 
include('Footer.php');

?> 