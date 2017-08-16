<?php
include('koneksi.php');
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['authorized'])){
}else{
	echo ("<script type='text/javascript'>alert('Anda harus login');document.location='../index.php';</script>");
}
if(isset($_POST['cari'])){
$list_proses=mysql_query("SELECT
  `trx`.*,
  `customer`.`Nama_Customer`,
  `proses`.`progress`,
  `kontrak`.`Nilai_kontrak` AS `Nilai_kontrak1`,
  `kontrak`.`Paket_Pekerjaan`,
  `kontrak`.`Keterangan`
FROM
  `trx`
  INNER JOIN `proses` ON `trx`.`Id_Proses` = `proses`.`Id_Proses`
  INNER JOIN `customer` ON `proses`.`Id_Customer` = `customer`.`Id_Customer`
  INNER JOIN `kontrak` ON `trx`.`Id_Kontrak` = `kontrak`.`Id_Kontrak` where `customer`.`Id_Customer` ='".$_POST['Id_Customer']."'");
}else{
	$list_proses=mysql_query("SELECT
  `trx`.*,
  `customer`.`Nama_Customer`,
  `proses`.`progress`,
  `kontrak`.`Nilai_kontrak` AS `Nilai_kontrak1`,
  `kontrak`.`Paket_Pekerjaan`,
  `kontrak`.`Keterangan`
FROM
  `trx`
  INNER JOIN `proses` ON `trx`.`Id_Proses` = `proses`.`Id_Proses`
  INNER JOIN `customer` ON `proses`.`Id_Customer` = `customer`.`Id_Customer`
  INNER JOIN `kontrak` ON `trx`.`Id_Kontrak` = `kontrak`.`Id_Kontrak`");
}
include('header.php');
?>
<form method="post">
<table>
<tr>
<td><select name="Id_Customer" class="form-control">
<option value="">Pilih customer</option>
<?php $cs=mysql_query("select * from customer");
while($customer=mysql_fetch_array($cs)){ ?>
<option value="<?php echo $customer['Id_Customer'];?>"><?php echo $customer['Nama_Customer'];?></option>
<?php } ?>

</td>
<td>
<input type="submit" class="btn btn-danger"name="cari"/>
</td>
</tr>
</table>
</form>
<form method="post"/>
<div id="print-area" class="print-area">
<div style="text-align:right;"><a class="no-print" href="javascript:printDiv('print-area');">Print</a></div>
<br>
<h4>Laporan Tagihan </h4>
<table border="1" class="table table-bordered">

<tr>
<td>Nama_Customer</td>
<td>Tanggal_Pengajuan</td>
<td>Progress</td>
<td>Nilai_kontrak</td>
<td>Jumlah tagihan</td>
<td>Sisa Tagihan</td>

</tr>
<?php

$progres=0;
$tagihan=0;
$sisa=0;
$kontrak=0;
while ($proses=mysql_fetch_array($list_proses)){
	?>
	
	<tr>
	<td><?php echo $proses['Nama_Customer'];?></td>
	<td><?php echo $proses['Tgl_Pengajuan'];?></td>
	<td><?php echo $proses['progress'];?></td>
    <td>Rp.<?php echo number_format($proses['Nilai_Kontrak']);?></td>
	<td>Rp.<?php echo number_format($proses['Jumlah_Tagihan']);?></td>
    <td>Rp.<?php echo number_format($proses['Sisa_Tagihan']);?></td>
    </tr>
<?php 
$tp=$progres+=$proses['progress'];
$tt=$tagihan+=$proses['Jumlah_Tagihan'];
$ts=$sisa+=$proses['Sisa_Tagihan'];
$nk=$kontrak+=$proses['Nilai_kontrak1'];
}?>


<tr>
<td colspan="2">Jumlah</td>
<td><?php echo $tp ;?></td>
<td>Rp.<?php echo number_format($nk);?></td>
<td>Rp.<?php echo number_format ($tt) ;?></td>
<td>Rp.<?php echo number_format ($ts) ;?></td>
</tr>
</table>
<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg .tg-s6z2{text-align:center}
.tg .tg-baqh{text-align:center;vertical-align:top}
.tg .tg-hgcj{font-weight:bold;text-align:center}
.tg .tg-amwm{font-weight:bold;text-align:center;vertical-align:top}
</style>
<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg .tg-s6z2{text-align:center}
.tg .tg-baqh{text-align:center;vertical-align:top}
.tg .tg-hgcj{font-weight:bold;text-align:center}
.tg .tg-amwm{font-weight:bold;text-align:center;vertical-align:top}
</style>
<table class="tg">
  <tr>
    <th class="tg-hgcj">Di buat oleh</th>
    <th class="tg-hgcj">Mengetahui</th>
    <th class="tg-hgcj">Di print oleh</th>
    <th class="tg-amwm">Di cetak tanggal</th>
  </tr>
  <tr>
    <td class="tg-s6z2"></td>
    <td class="tg-s6z2"></td>
    <td class="tg-s6z2"></td>
    <td class="tg-baqh"><br><br><br><br><br></td>
  </tr>
  <tr>
    <td class="tg-baqh">Amirul AKbar</td>
    <td class="tg-baqh">Suwarta santosa</td>
    <td class="tg-baqh">Admin</td>
    <td class="tg-baqh"></td>
  </tr>
  <tr>
    <td class="tg-baqh">Quantity Surveyor</td>
    <td class="tg-baqh">Project Manager</td>
    <td class="tg-baqh"></td>
    <td class="tg-baqh">By Admin</td>
  </tr>
</table>
</div>

<textarea id="printing-css" style="display:none;">html,body,div,span,applet,object,iframe,h1,h2,h3,h4,h5,h6,p,blockquote,pre,a,abbr,acronym,address,big,cite,code,del,dfn,em,img,ins,kbd,q,s,samp,small,strike,strong,sub,sup,tt,var,b,u,i,center,dl,dt,dd,ol,ul,li,fieldset,form,label,legend,table,caption,tbody,tfoot,thead,tr,th,td,article,aside,canvas,details,embed,figure,figcaption,footer,header,hgroup,menu,nav,output,ruby,section,summary,time,mark,audio,video{margin:0;padding:0;border:0;font-size:100%;font:inherit;vertical-align:baseline}article,aside,details,figcaption,figure,footer,header,hgroup,menu,nav,section{display:block}body{line-height:1}ol,ul{list-style:none}blockquote,q{quotes:none}blockquote:before,blockquote:after,q:before,q:after{content:'';content:none}table{border-collapse:collapse;border-spacing:0}body{font:normal normal .8125em/1.4 Arial,Sans-Serif;background-color:white;color:#333}strong,b{font-weight:bold}cite,em,i{font-style:italic}a{text-decoration:none}a:hover{text-decoration:underline}a img{border:none}abbr,acronym{border-bottom:1px dotted;cursor:help}sup,sub{vertical-align:baseline;position:relative;top:-.4em;font-size:86%}sub{top:.4em}small{font-size:86%}kbd{font-size:80%;border:1px solid #999;padding:2px 5px;border-bottom-width:2px;border-radius:3px}mark{background-color:#ffce00;color:black}p,blockquote,pre,table,figure,hr,form,ol,ul,dl{margin:1.5em 0}hr{height:1px;border:none;background-color:#666}h1,h2,h3,h4,h5,h6{font-weight:bold;line-height:normal;margin:1.5em 0 0}h1{font-size:200%}h2{font-size:180%}h3{font-size:160%}h4{font-size:140%}h5{font-size:120%}h6{font-size:100%}ol,ul,dl{margin-left:3em}ol{list-style:decimal outside}ul{list-style:disc outside}li{margin:.5em 0}dt{font-weight:bold}dd{margin:0 0 .5em 2em}input,button,select,textarea{font:inherit;font-size:100%;line-height:normal;vertical-align:baseline}textarea{display:block;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box}pre,code{font-family:"Courier New",Courier,Monospace;color:inherit}pre{white-space:pre;word-wrap:normal;overflow:auto}blockquote{margin-left:2em;margin-right:2em;border-left:4px solid #ccc;padding-left:1em;font-style:italic}table[border="1"] th,table[border="1"] td,table[border="1"] caption{border:1px solid;padding:.5em 1em;text-align:left;vertical-align:top}th{font-weight:bold}table[border="1"] caption{border:none;font-style:italic}.no-print{display:none}</textarea>
<iframe id="printing-frame" name="print_frame" src="about:blank" style="display:none;"></iframe>
<script>
   
function printDiv(elementId) {
    var a = document.getElementById('printing-css').value;
    var b = document.getElementById(elementId).innerHTML;
    window.frames["print_frame"].document.title = document.title;
    window.frames["print_frame"].document.body.innerHTML = '<style>' + a + '</style>' + b;
    window.frames["print_frame"].window.focus();
    window.frames["print_frame"].window.print();
	
}
</script>

<style>

.print-area {border:1px solid red;padding:1em;margin:0 0 1em}
</style>
<?php 
include('Footer.php');

?>