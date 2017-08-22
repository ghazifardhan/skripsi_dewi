<?php
header("Content-type:application/json");
include('koneksi.php');
$kodebarang=$_GET['kodebarang'];
    $q_string = "SELECT
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
    `proses`
    LEFT JOIN `customer` ON `proses`.`Id_Customer` = `customer`.`Id_Customer`   
    LEFT JOIN `kontrak` ON `customer`.`Id_Customer` = `kontrak`.`Id_Customer`   
WHERE
  `proses`.`Id_Customer` = '" . $kodebarang . "' and `proses`.`status` ='BELUM LUNAS'";
  
  //dd($q_string);
$query=mysqli_query($GLOBALS["___mysqli_ston"], $q_string);
$fe=mysqli_fetch_array($query);
$progres=$fe['progress'];
$jenis=$fe['Jenis'];
$jenis_kontrak=$fe['Jenis_Kontrak'];
$nilai=$fe['Nilai_kontrak'];
$payment=$fe['payment'];
$id_proses=$fe['Id_Proses'];
$id_kontrak=$fe['Id_Kontrak'];

$data = array(
    'progress' => $progres,
    'jenis' => $fe['Jenis'],
    'jenis_kontrak' => $fe['Jenis_Kontrak'],
    'nilai' => $fe['Nilai_kontrak'],
    'payment' => $fe['payment'],
    'id_proses' => $fe['Id_Proses'],
    'id_kontrak' => $fe['Id_Kontrak'],
);

if(cekData($id_kontrak))
{
    $Top=$nilai - $payment;    
}
else
{
    $Top = $nilai;
}
//echo $progres.",".$jenis.",".$jenis_kontrak.",".$nilai.",".$id_proses.",".$id_kontrak.",".$Top;

$data = array(
    'data' => [
        'progress' => $progres,
        'jenis' => $fe['Jenis'],
        'jenis_kontrak' => $fe['Jenis_Kontrak'],
        'nilai' => number_format($fe['Nilai_kontrak'],0,",","."),
        'payment' => $fe['payment'],
        'id_proses' => $fe['Id_Proses'],
        'id_kontrak' => $fe['Id_Kontrak'],
        'top' => number_format($Top,0,",","."),
    ]
);

echo json_encode($data, true);

function cekData($id_kontrak)
{
    $q_string = "SELECT count(*) as tot from trx where Id_Kontrak = '$id_kontrak'";
    //dd($q_string);
    $query = mysqli_query($GLOBALS["___mysqli_ston"], $q_string);
    $fe=mysqli_fetch_array($query);
    if($fe['tot'] > 0)
    {
        return true;
    }
    return false;
}

function dd($var)
{
    die(var_dump($var));
}
?> 