<?php 
include('koneksi.php');
$kodebarang=$_GET['kodebarang'];
$query=mysql_query("SELECT
  `customer`.`Nama_Customer`,
  `proses`.`progress`,
  `customer`.`Jenis`,
  `kontrak`.`Jenis_Kontrak`,
  `kontrak`.`Nilai_kontrak`,
  `kontrak`.`payment`,
  `customer`.`Id_Customer`,
  `proses`.`Id_Proses`,
  `proses`.`status`,
  `kontrak`.`Id_Kontrak`
FROM
  `kontrak`
  INNER JOIN `customer` ON `kontrak`.`Id_Customer` = `customer`.`Id_Customer`
  INNER JOIN `proses` ON `customer`.`Id_Customer` = `proses`.`Id_Customer`
WHERE
  `proses`.`Id_Customer` ='$kodebarang' and `proses`.`status` ='BELUM LUNAS'");
$fe=mysql_fetch_array($query);
$progres=$fe['progress'];
$jenis=$fe['Jenis'];
$jenis_kontrak=$fe['Jenis_Kontrak'];
$nilai=$fe['Nilai_kontrak'];
$payment=$fe['payment'];
$id_proses=$fe['Id_Proses'];
$id_kontrak=$fe['Id_Kontrak'];
$Top=$nilai - $payment;
echo $progres.",".$jenis.",".$jenis_kontrak.",".$nilai.",".$id_proses.",".$id_kontrak.",".$Top;

?>