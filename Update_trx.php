<?php
include ('koneksi.php');
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['authorized'])){
}else{
    echo ("<script type='text/javascript'>alert('Anda harus login');document.location='../index.php';</script>");
}
if(isset($_POST['save'])){
    $tgl_peng = $_POST["Tgl_Pengajuan"];
    $time_date = date("m");
    $tgl_pengajuan = date("m", strtotime($tgl_peng));
    $jml_tagihan = str_replace(".","",$_POST['Jumlah_Tagihan']);
    if($tgl_pengajuan != $time_date){
        echo ("<script type='text/javascript'>alert('Tanggal harus sesuai dengan bulan ini');</script>");
    } else {
        $knt = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from kontrak where Id_Kontrak = '".$_POST['Id_Kontrak']."'");
        $knt_fetch = mysqli_fetch_array($knt);

        $payment = $knt_fetch['payment'] - $_POST['jml_tagihan_before'] + $jml_tagihan;
        $sisa_tagihan = $_POST['Nilai_Kontrak'] - $payment;

        $query_update=mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE trx set
        Nilai_Kontrak ='".$_POST['Nilai_Kontrak']."',
        Id_Kontrak ='".$_POST['Id_Kontrak']."',
        Tgl_Pengajuan='".$_POST['Tgl_Pengajuan']."',
        Jumlah_Tagihan    ='".$jml_tagihan."',
        Sisa_Tagihan='". $sisa_tagihan ."'
        where
        Id_Proses='".$_POST['Id_Proses']."'");
        $update_payment = mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE kontrak set payment = '" . $payment . "' where Id_Kontrak = '". $_POST['Id_Kontrak'] ."'");
        if($query_update && $update_payment){
            header("location:tampilan_trx.php");
        }else{
            echo mysqli_error($GLOBALS["___mysqli_ston"]);
        }
}

}
$tampilan_data=mysqli_query($GLOBALS["___mysqli_ston"], "select*from trx where
Id_Proses='".$_GET['Id_Proses']."'");
$hasil_data= mysqli_fetch_array($tampilan_data);
include('header.php');
?>
<form method="post"/>
<table class="table table-bordered">
<tr>
<td>Nilai_Kontrak</td>
<td><input name="Nilai_Kontrak" type="text" class="form-control" value="<?php echo $hasil_data['Nilai_Kontrak'];?>"/></td>
</tr>

<tr>
<td>Id_Kontrak</td>
<td><input name="Id_Kontrak" type="text" class="form-control" value="<?php echo $hasil_data['Id_Kontrak'];?>"/></td>
</tr>

<tr>
<td>Tgl_Pengajuan</td>
<td><input name="Tgl_Pengajuan" type= "text" class="form-control" value="<?php echo $hasil_data['Tgl_Pengajuan'];?>"/></td>
</tr>

<tr>
<td>Jumlah_Tagihan</td>
<td><input name="Jumlah_Tagihan" type="text" class="form-control number" value="<?php echo $hasil_data['Jumlah_Tagihan'];?>"/>
<input name="jml_tagihan_before" type="hidden" class="form-control" value="<?php echo $hasil_data['Jumlah_Tagihan'];?>"/></td>
</tr>

<tr>
<td>Sisa_Tagihan</td>
<td><input name="Sisa_Tagihan" type="text" class="form-control" value="<?php echo $hasil_data['Sisa_Tagihan'];?>" readonly /></td>
</tr>

<input type="hidden" name="Id_Proses" class="form-control" value ="<?php echo $hasil_data['Id_Proses'];?>"/>

<tr>
<td><input type="submit" class="btn btn-danger"name="save"/></td>

</tr>
</table>
</form>
<?php 
include('Footer.php');
?> 