<?php
include ('koneksi.php');
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['authorized'])){
}else{
    echo ("<script type='text/javascript'>alert('Anda harus login');document.location='../index.php';</script>");
}
if(isset($_POST['save'])){
    $tgl_peng = $_POST["Tanggal_Pengajuan"];
    $tgl_meet = $_POST["Tgl_Meeting_Progress"];
    $time_date = date("m");
    $tgl_pengajuan = date("m", strtotime($tgl_peng));
    $tgl_meeting = date("m", strtotime($tgl_meet));
    if($tgl_pengajuan != $time_date || $tgl_meeting != $time_date){
        echo ("<script type='text/javascript'>alert('Tanggal harus sesuai dengan bulan ini');</script>");
    } else {

    $query_update=mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE proses set
    Tanggal_Pengajuan ='".$_POST['Tanggal_Pengajuan']."',
    progress='".$_POST['progress']."',
    Tgl_Meeting_Progress='".$_POST['Tgl_Meeting_Progress']."'
    where
    Id_Proses='".$_POST['Id_Proses']."'");
    if($query_update){
        header("location:tampilan_proses.php");
    }else{
        echo mysqli_error($GLOBALS["___mysqli_ston"]);
    }
    }

}

$tampilan_data=mysqli_query($GLOBALS["___mysqli_ston"], "select*from proses where
Id_Proses='".$_GET['Id_Proses']."'");
$hasil_data= mysqli_fetch_array($tampilan_data);

include('header.php');
?>

<form method="post"/>
<table border="1" class="table table-bordered">

<form method="post"/>
<table>
<tr>
<td>Tanggal_Pengajuan</td>
<td><input name="Tanggal_Pengajuan" type="text" value="<?php echo $hasil_data['Tanggal_Pengajuan'];?>"/></td>
</tr>

<tr>
<td>progress</td>
<td><input name="progress" type="text" value="<?php echo $hasil_data['progress'];?>"/></td>
</tr>

<tr>
<td>Tgl_Meeting_Progress</td>
<td><input name="Tgl_Meeting_Progress" type= "text" value="<?php echo $hasil_data['Tgl_Meeting_Progress'];?>"/></td>
</tr>

<input type="hidden" name="Id_Customer" value ="<?php echo $hasil_data['Id_Customer'];?>"/>

<tr>
<td><input type="submit" name="save"/></td>

</tr>
</table>
</form>

<?php 
include('Footer.php');

?> 