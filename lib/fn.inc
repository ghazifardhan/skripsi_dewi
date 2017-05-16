<?php
error_reporting(0); # Deployment
session_start();
#session_save_path('_session/');
define('GbIncl', TRUE);;
//error_reporting(E_ALL);   # Development
//default is jakarta ( GMT+7)
date_default_timezone_set("Asia/Jakarta");
ini_set("session.cookie_lifetime", "0");
ini_set("memory_limit", "128M");


function cek_admin_session(){    
    if(isset($_SESSION['auth'])){
        return TRUE;
    }else{
        return FALSE;
    }
}

if (!function_exists("Flash")) {
  function Flash($type,$msg) {
   $_SESSION['flash']['status']=$type;
   $_SESSION['flash']['msg']=$msg;
   $_SESSION['flash']['expired']=time()+2;   
  }
}

if (!function_exists("DQ")) {
  function DQ($Q) {
    $e = '';
    $e = mysql_query($Q);
    if ($e)
      return $e;else {
      die(mysql_error());
      exit;
    }
  }
}
if (!function_exists("FQ")) {
  function FQ($Q) {
    if (!empty($Q))
      return mysql_fetch_array($Q);
  }
}
if (!function_exists("FQO")) {
  function FQO($Q) {
    return mysql_fetch_object($Q);
  }
}
if (!function_exists("NQ")) {
  function NQ($Q) {
    return mysql_num_rows($Q);
  }
}
function SystemPeriod() {
  $q = DQ("select*from s_settings WHERE key_item='CurrentPeriod'");
  $r = FQ($q);
  return trim($r['value']);
}
function user() {
  return $_SESSION['auth_username'];
}
function YearPeriod() {
  $t = date("Y");
  return $t;
}
function CodeJual($id, $period) {
  //$q=DQ("select*from t_penjualan WHERE
  return 'S-' . time();
}
function nolin($angka) {
  $nol = array(1 => "000", "00", "0", "");
  $angka = $nol[strlen($angka)] . $angka;
  return $angka;
}
function PaymentLabel($txt) {
  switch ($txt) {
    case "TRF":
      $label = "TRANSFER";
      break;
    case "CASH":
      $label = "CASH";
      break;
    case "GIRO":
      $label = "GIRO";
      break;
  }
  return $label;
}
function getBulan($bln) {
  switch ($bln) {
    case 1:
      return "Januari";
      break;
    case 2:
      return "Februari";
      break;
    case 3:
      return "Maret";
      break;
    case 4:
      return "Maret";
      break;
    case 5:
      return "Mei";
      break;
    case 6:
      return "Juni";
      break;
    case 7:
      return "Juli";
      break;
    case 8:
      return "Agustus";
      break;
    case 9:
      return "September";
      break;
    case 10:
      return "Oktober";
      break;
    case 11:
      return "November";
      break;
    case 12:
      return "Desember";
      break;
  }
}
function tanggal_format_indonesia($tgl) {
  $tanggal = substr($tgl, 8, 2);
  $bulan = getBulan(substr($tgl, 5, 2));
  $tahun = substr($tgl, 0, 4);
  return $tanggal . ' ' . $bulan . ' ' . $tahun;
}
function ciDate($date, $specs = "") {
  $r_date = date("d-m-Y", strtotime($date));
  if (substr($date, 0, 10) == '0000-00-00')
    $r_date = "-";
  if (strlen($date) == 19 && substr($date, 11, 8) != '00:00:00' || isset($specs['full']))
    $r_date.= " " . ltrim(substr($date, 11, 5), '0');
  return $r_date;
}
function encode($x) {
  $Cipher = new AES();
  $key_128bit = '2b7e151628aed2a6abf7158809cf4f3c';
  $n = ceil(strlen($x) / 16);
  $encrypt = "";
  for ($i = 0; $i <= $n - 1; $i++) {
    $cryptext = $Cipher->encrypt($Cipher->stringToHex(substr($x, $i * 16, 16)), $key_128bit);
    $encrypt .= $cryptext;
  }
  return $encrypt;
}
function decode($x) {
  $Cipher = new AES();
  $key_128bit = '2b7e151628aed2a6abf7158809cf4f3c';
  $n = ceil(strlen($x) / 32);
  $decrypt = "";
  for ($i = 0; $i <= $n - 1; $i++) {
    $result = $Cipher->decrypt(substr($x, $i * 32, 32), $key_128bit);
    $decrypt .= $Cipher->hexToString($result);
  }
  return $decrypt;
}
function filter($data) {
  $data = trim(htmlentities(strip_tags($data)));
  if (get_magic_quotes_gpc())
    $data = stripslashes($data);
  $data = mysql_real_escape_string($data);
  return $data;
}
function gd($txt) {
  $txt = $_GET[$txt];
  $txt = mysql_real_escape_string($txt);
  $res = decode($txt);
  return $res;
}
function PostVar($name, $value = '') {
  if (isset($_POST[$name]))
    return ${$name} = $_POST[$name];
  else
    return ${$name} = $value;
}
function GetVar($name, $value = '') {
  if (isset($_GET[$name]))
    return ${$name} = $_GET[$name];
  else
    return ${$name} = $value;
}
function se($txt) {
  $res = encode($txt);
  return $res;
}
function sanitize($x) {
  return mysql_real_escape_string($x);
}
function GenerateColorCode() {
  $l = 'ABCDEF0123456789';
  $string = '';
  for ($i = 1; $i <= 6; $i++)
    $string.= $l[rand(0, strlen($l) - 1)];
  return $string;
}
function GenerateInternalInvoiceNumber1() {
  $s = strtoupper(md5(uniqid(rand(), true)));
  $guidText =
          substr($s, 0, 8) . '-' .
          substr($s, 8, 4) . '-' .
          substr($s, 12, 4) . '-' .
          substr($s, 16, 4) . '-' .
          substr($s, 20);
  return strtolower($guidText);
}
function GenerateInternalInvoiceNumber($ref) {
  $s = strtoupper(md5(uniqid(rand(), true)));
  if (empty($ref))
    $guidText = time() . '-' . strtoupper($_SESSION['USERNAME']) . '-' . substr($s, 0, 8);
  else
    $guidText = time() . '-' . $ref . '-' . strtoupper($_SESSION['auth_username']) . '-' . substr($s, 0, 8);
  return $guidText;
}
function nf($nb) {
  return number_format($nb, 2, '.', ',');
}
function nf0($nb) {
  return number_format($nb, 0, '.', ',');
}
#top
#$var=decode($_SERVER['REQUEST_URI']);
$id = isset($_GET['id']) ? $_GET['id'] : '';
#$totaldata=$_GET['totaldata'];
if (!defined('ROOT')) {
  $u = explode('.', $_SERVER['HTTP_HOST']);
  if ($u[0] == 'manager' || $u[0] == 'fb')
    define('ROOT', realpath(dirname(__FILE__)) . '/../');
  else
    define('ROOT', $_SERVER['DOCUMENT_ROOT'] . '/');
}
function Lib($file) {
  if (is_array($file))
    for ($i = 0; $i != count($file); $i++)
      include_once(ROOT . '_lib/' . $file[$i] . '.php');
  else
    include_once(ROOT . '_lib/' . $file . '.php');
}
function js_alert($msg) {
  $s = '<script>alert("' . $msg . '");</script>';
  echo $s;
}
function js_alert_redir($msg = '', $redir = '') {
  $s = '<script type="text/javascript">alert("' . $msg . '");window.location.replace("' . $redir . '");</script>';
  echo $s;
}
function cleanInput($input) {
  $search = array(
      '@<script[^>]*?>.*?</script>@si', // Strip out javascript
      '@<[\/\!]*?[^<>]*?>@si', // Strip out HTML tags
      '@<style[^>]*?>.*?</style>@siU', // Strip style tags properly
      '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
  );
  $output = preg_replace($search, '', $input);
  return $output;
}
function clean($v) {
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }
  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);
  return $v;
}
#  casting input
# cast($_GET['id'],'int');
function cast($v, $t, $d = "", $n = "") {
  $v = (!get_magic_quotes_gpc()) ? addslashes($v) : $v;
  switch ($t) {
    case "text":
      $v = ($t != "") ? "'" . $v . "'" : "NULL";
      break;
    case "long":
    case "int":
      $v = ($v != "") ? intval($v) : "NULL";
      break;
    case "double":
      $v = ($v != "") ? "'" . doubleval($v) . "'" : "NULL";
      break;
    case "date":
      $v = ($v != "") ? "'" . $v . "'" : "NULL";
      break;
    case "defined":
      $v = ($v != "") ? $d : $n;
      break;
  }
  return $v;
}
function JSRedir($url) {
  echo '<script type="text/javascript">window.location.replace("' . $url . '");</script>';
}
if (!function_exists("Romawi")) {
  function Romawi($n) {
    $hasil = "";
    $iromawi = array("", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X",
        20 => "XX", 30 => "XXX", 40 => "XL", 50 => "L", 60 => "LX", 70 => "LXX", 80 => "LXXX",
        90 => "XC", 100 => "C", 200 => "CC", 300 => "CCC", 400 => "CD", 500 => "D",
        600 => "DC", 700 => "DCC", 800 => "DCCC", 900 => "CM", 1000 => "M",
        2000 => "MM", 3000 => "MMM");
    if (array_key_exists($n, $iromawi)) {
      $hasil = $iromawi[$n];
    } elseif ($n >= 11 && $n <= 99) {
      $i = $n % 10;
      $hasil = $iromawi[$n - $i] . Romawi($n % 10);
    } elseif ($n >= 101 && $n <= 999) {
      $i = $n % 100;
      $hasil = $iromawi[$n - $i] . Romawi($n % 100);
    } else {
      $i = $n % 1000;
      $hasil = $iromawi[$n - $i] . Romawi($n % 1000);
    }
    return $hasil;
  }
}
if (!function_exists("GetSQLValueString")) {
  function GetSQLValueString($theValue, $theType = "", $theDefinedValue = "", $theNotDefinedValue = "") {
    if (PHP_VERSION < 6) {
      $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
    }
    $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);
    switch ($theType) {
      case "text":
        $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
        break;
      case "long":
      case "int":
        $theValue = ($theValue != "") ? intval($theValue) : "NULL";
        break;
      case "double":
        $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
        break;
      case "date":
        $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
        break;
      case "defined":
        $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
        break;
    }
    return $theValue;
  }
}
function bilang($x) {
  $x = abs($x);
  $angka = array("", "satu", "dua", "tiga", "empat", "lima",
      "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
  $result = "";
  if ($x < 12) {
    $result = " " . $angka[$x];
  } else if ($x < 20) {
    $result = bilang($x - 10) . " belas";
  } else if ($x < 100) {
    $result = bilang($x / 10) . " puluh" . bilang($x % 10);
  } else if ($x < 200) {
    $result = " seratus" . bilang($x - 100);
  } else if ($x < 1000) {
    $result = bilang($x / 100) . " ratus" . bilang($x % 100);
  } else if ($x < 2000) {
    $result = " seribu" . bilang($x - 1000);
  } else if ($x < 1000000) {
    $result = bilang($x / 1000) . " ribu" . bilang($x % 1000);
  } else if ($x < 1000000000) {
    $result = bilang($x / 1000000) . " juta" . bilang($x % 1000000);
  } else if ($x < 1000000000000) {
    $result = bilang($x / 1000000000) . " milyar" . bilang(fmod($x, 1000000000));
  } else if ($x < 1000000000000000) {
    $result = bilang($x / 1000000000000) . " trilyun" . bilang(fmod($x, 1000000000000));
  }
  return $result;
}
function terbilang($x) {
  if ($x < 0) {
    $hasil = "minus " . trim(bilang($x));
  } elseif ($x == 0) {
    $hasil = "nol";
  } else {
    $hasil = trim(bilang($x));
  }
  return $hasil;
}
if (!function_exists("getStok")) {
  function getStok($item) {
    $q = DQ("select sum(a.masuk) as s_masuk, sum(a.keluar) as s_keluar,b.STOK from transaksi_detail a JOIN m_barang b ON a.item_id=b.KODE_BRG WHERE a.item_id='" . $item . "' GROUP BY a.item_id");
    $res = FQO($q);
    return ($res->s_masuk + $res->STOK) - $res->s_keluar;
  }
}
if (!function_exists("getTotalOrderRupiah")) {
  function getTotalOrderRupiah($no) {
    $q = DQ("SELECT
                    `transaksi_detail`.`isbonus`,
                    `transaksi_detail`.`keluar`, 
                    `transaksi_detail`.`price`,
                    `m_barang`.`TINGGI`,
                    `m_barang`.`PANJANG`,
                    `m_barang`.*
                    FROM
                    `transaksi_header`
                    JOIN
                    `transaksi_detail` ON `transaksi_header`.`id` = `transaksi_detail`.`parent_id`
                    JOIN
                    `m_barang` ON `transaksi_detail`.`item_id` = `m_barang`.`KODE_BRG`
               WHERE 
                    `transaksi_header`.no_transaksi='" . $no . "'");
    while ($res = FQO($q)) {
      if ($res->isbonus == 'Y') {
        $jumlah+=0;
      } else {
        $jumlah+=$res->keluar * $res->price * $res->TINGGI * $res->PANJANG;
      }
    }
    $diskon = $jumlah * $res->discount / 100;
    $total = $jumlah - $diskon;
    return $total;
  }
}
if (!function_exists("getKirimAmount_BY_Customer")) {
  function getKirimAmount_BY_Customer($id) {
    $q = DQ("
                    SELECT
                    `transaksi_detail`.`isbonus`,
                    `transaksi_detail`.`keluar`, 
                    `transaksi_detail`.`price`,
                    `m_barang`.`TINGGI`,
                    `m_barang`.`PANJANG`,
                    `m_barang`.*,
                    `transaksi_header`.*
                    FROM
                    `transaksi_header`
                    JOIN
                    `transaksi_detail` ON `transaksi_header`.`id` = `transaksi_detail`.`parent_id`
                    JOIN
                    `m_barang` ON `transaksi_detail`.`item_id` = `m_barang`.`KODE_BRG`
                    WHERE 
                    `transaksi_header`.customer_id='" . $id . "' AND `transaksi_header`.type_transaksi='kirim'");
    while ($res = FQO($q)) {
      if ($res->isbonus == 'Y') {
        $jumlah+=0;
      } else {
        $jumlah+=$res->keluar * $res->price * $res->TINGGI * $res->PANJANG;
      }
      $diskon = $jumlah * $res->discount / 100;
    }
    $total = $jumlah - $diskon;
    return $total;
  }
}
if (!function_exists("getPaidOrderAmount_BY_Customer")) {
  function getPaidOrderAmount_BY_Customer($id) {
    $q = DQ("
                    SELECT
                    `transaksi_detail`.`isbonus`,
                    `transaksi_detail`.`keluar`, 
                    `transaksi_detail`.`price`,
                    `m_barang`.`TINGGI`,
                    `m_barang`.`PANJANG`,
                    `m_barang`.*,
                    `transaksi_header`.*
                    FROM
                    `transaksi_header`
                    JOIN
                    `transaksi_detail` ON `transaksi_header`.`id` = `transaksi_detail`.`parent_id`
                    JOIN
                    `m_barang` ON `transaksi_detail`.`item_id` = `m_barang`.`KODE_BRG`
                    WHERE 
                    `transaksi_header`.customer_id='" . $id . "' 
                        AND `transaksi_header`.type_transaksi='kirim'
                        AND `transaksi_header`.ispaid='Y'");
    while ($res = FQO($q)) {
      if ($res->isbonus == 'Y') {
        $jumlah+=0;
      } else {
        $jumlah+=$res->keluar * $res->price * $res->TINGGI * $res->PANJANG;
      }
      $diskon = $jumlah * $res->discount / 100;
    }
    $total = $jumlah - $diskon;
    return $total;
  }
}
if (!function_exists("getDOAmountNet")) {
  function getDOAmountNet($id) {
    $q = DQ("
                    SELECT
                    `transaksi_detail`.`isbonus`,
                    `transaksi_detail`.`keluar`, 
                    `transaksi_detail`.`price`,
                    `m_barang`.`TINGGI`,
                    `m_barang`.`PANJANG`,
                    `m_barang`.*,
                    `transaksi_header`.*
                    FROM
                    `transaksi_header`
                    JOIN
                    `transaksi_detail` ON `transaksi_header`.`id` = `transaksi_detail`.`parent_id`
                    JOIN
                    `m_barang` ON `transaksi_detail`.`item_id` = `m_barang`.`KODE_BRG`
                    WHERE 
                    `transaksi_header`.id='" . $id . "' 
                        AND `transaksi_header`.type_transaksi='kirim'");
    while ($res = FQO($q)) {
      if ($res->isbonus == 'Y') {
        $jumlah+=0;
      } else {
        $jumlah+=$res->keluar * $res->price * $res->PANJANG;
      }
      $diskon = $jumlah * $res->discount / 100;
    }
    $total = $jumlah - $diskon;
    return $total;
  }
}
if (!function_exists("getDOAmount__from_suratjalan")) {
  function getDOAmount__from_suratjalan($id) {
    $q = DQ("
                    SELECT
                    `transaksi_detail`.`isbonus`,
                    `transaksi_detail`.`keluar`, 
                    `transaksi_detail`.`price`,
                    `m_barang`.`TINGGI`,
                    `m_barang`.`PANJANG`,
                    `m_barang`.*,
                    `transaksi_header`.*
                    FROM
                    `transaksi_header`
                    JOIN
                    `transaksi_detail` ON `transaksi_header`.`id` = `transaksi_detail`.`parent_id`
                    JOIN
                    `m_barang` ON `transaksi_detail`.`item_id` = `m_barang`.`KODE_BRG`
                    WHERE 
                    `transaksi_header`.no_transaksi='" . $id . "' 
                        AND `transaksi_header`.type_transaksi='kirim'");
    while ($res = FQO($q)) {
      if ($res->isbonus == 'Y') {
        $jumlah+=0;
      } else {
        $jumlah+=$res->keluar * $res->price * $res->PANJANG;
      }
      $diskon = $jumlah * $res->discount / 100;
    }
    $total = $jumlah - $diskon;
    return $total;
  }
}
if (!function_exists("getTotalReturRupiah")) {
  function getTotalReturRupiah($id) {
    $q = DQ("SELECT
                    `transaksi_detail`.`masuk`, 
                    `transaksi_detail`.`price`,
                    `m_barang`.`PANJANG`,
                    `m_barang`.`KODE_BRG`,
                    `transaksi_header`.*
                FROM
                    `transaksi_header`
                    JOIN
                    `transaksi_detail` ON `transaksi_header`.`id` = `transaksi_detail`.`parent_id`
                    JOIN
                    `m_barang` ON `transaksi_detail`.`item_id` = `m_barang`.`KODE_BRG`
               WHERE 
                    `transaksi_header`.id='" . $id . "' AND 
					`transaksi_header`.type_transaksi='retur'");
    while ($res = FQO($q)) {
      $jumlah+=$res->masuk * $res->price * $res->PANJANG;
    }
    $total = $jumlah;
    return $total;
  }
}
function getAmountComission($transaction_id) {
  $net_income = getDOAmountNet($transaction_id);
  $Q = DQ("select*from transaksi_header a JOIN transaksi_detail b ON a.id=b.parent_id JOIN m_customer c ON a.customer_id=c.KODE_CUSTOMER 
			WHERE a.id='" . $transaction_id . "'");
  $res = FQO($Q);
  $komisi_persen = $res->comission;
  $komisi_rupiah = $net_income * ($komisi_persen / 100);
  return $komisi_rupiah;
}
if (!function_exists("getDODiscountAmount")) {
  function getDODiscountAmount($id) {
    $q = DQ("
                    SELECT
                    `transaksi_detail`.`isbonus`,
                    `transaksi_detail`.`keluar`, 
                    `transaksi_detail`.`price`,
                    `m_barang`.`TINGGI`,
                    `m_barang`.`PANJANG`,
                    `m_barang`.*,
                    `transaksi_header`.*
                    FROM
                    `transaksi_header`
                    JOIN
                    `transaksi_detail` ON `transaksi_header`.`id` = `transaksi_detail`.`parent_id`
                    JOIN
                    `m_barang` ON `transaksi_detail`.`item_id` = `m_barang`.`KODE_BRG`
                    WHERE 
                    `transaksi_header`.id='" . $id . "' 
                        AND `transaksi_header`.type_transaksi='kirim'");
    while ($res = FQO($q)) {
      if ($res->isbonus == 'Y') {
        $jumlah+=0;
      } else {
        $jumlah+=$res->keluar * $res->price * $res->TINGGI * $res->PANJANG;
      }
      $diskon = $jumlah * $res->discount / 100;
    }
    #$total=$jumlah-$diskon;               
    return $diskon;
  }
}
if (!function_exists("getReturAmount_BY_Customer")) {
  function getReturAmount_BY_Customer($id) {
    $q = DQ("
                    SELECT
                    SUM(
                    `transaksi_detail`.`masuk`* 
                    `transaksi_detail`.`price`*
                    `m_barang`.`TINGGI`*
                    `m_barang`.`PANJANG`) as td,
                    `m_barang`.*,
                    `transaksi_header`.*
                    FROM
                    `transaksi_header`
                    JOIN
                    `transaksi_detail` ON `transaksi_header`.`id` = `transaksi_detail`.`parent_id`
                    JOIN
                    `m_barang` ON `transaksi_detail`.`item_id` = `m_barang`.`KODE_BRG`
                    WHERE 
                    `transaksi_header`.customer_id='" . $id . "' AND `transaksi_header`.type_transaksi='retur' GROUP BY `transaksi_header`.customer_id");
    $res = FQO($q);
    $total = $res->td;
    return $total;
  }
}
if (!function_exists("isJournalled")) {
  function isJournalled($id) {
    $q = DQ("select*from u_journal_detail WHERE system_ref='" . $id . "'");
    if (NQ($q)) {
      return true;
    } else {
      return false;
    }
  }
}
if (!function_exists("getCustomerData")) {
  function getCustomerData($id, $field) {
    $q = DQ("select * from m_customer WHERE KODE_CUSTOMER='" . $id . "'");
    $r = FQO($q);
    return $r->$field;
  }
}
if (!function_exists("getProdukData")) {
  function getProdukData($id, $field) {
    $q = DQ("select " . $field . " from m_barang WHERE KODE_BRG='" . $id . "'");
    $r = FQO($q);
    return $r->$field;
  }
}
if (!function_exists("getPricefromPricelist")) {
  function getPricefromPricelist($id_customer, $item) {
    $q = DQ("select*from c_pricelist WHERE c_customer='" . $id_customer . "' AND c_item='" . $item . "'");
    $r = FQO($q);
    return $r->c_price;
  }
}
if (!function_exists("clog")) {
  function clog($type_ref, $msg_ref, $action_ref = '',$url_ref='',$id_ref='') {
    $user_ref = $_SESSION['auth_username'];
    if($url_ref=='')$url_ref = $_SERVER['REQUEST_URI'];
    $Q = DQ("INSERT INTO m_user_log(user_ref,date,type_ref,msg_ref,url_ref,action_ref,id_ref) VALUES ('" . $user_ref . "',sysdate(),'" . $type_ref . "','" . $msg_ref . "','" . $url_ref . "','" . $action_ref . "','" . $id_ref . "')") OR die(mysql_error());
    return $Q;
  }
}
function getGrupName($id) {
  $q = DQ("select nama_grup FROM m_barang_grup WHERE kode_grup='" . $id . "'");
  $r = FQO($q);
  return $r->nama_grup;
}
function getTOPName($id) {
  $q = DQ("select t_name FROM m_top WHERE t_id='" . $id . "'");
  $r = FQO($q);
  return $r->t_name;
}
function getWHName($id) {
  $q = DQ("select wh_name FROM m_warehouse WHERE id_wh='" . $id . "'");
  $r = FQO($q);
  return $r->wh_name;
}
function getUnitame($id) {
  $q = DQ("select NAMA_SATUAN FROM m_satuan WHERE KODE_SATUAN='" . $id . "'");
  $r = FQO($q);
  return $r->NAMA_SATUAN;
}
function getDONumberFromInvoice($number) {
  #invoice : INV/0001/IX/2012
  #Do : 0001/IX/2012/SRDNG
  $s = explode("/", $number);
  $x = $s[1] . '/' . $s[2] . '/' . $s[2] . '/SRDNG';
  return $t;
}
function getCustomerTransaction($id, $field = '') {
  $q = DQ("SELECT
			  *
			FROM
			  `m_customer` INNER JOIN
			  `transaksi_header` ON `transaksi_header`.`customer_id` =
				`m_customer`.`KODE_CUSTOMER`
		    WHERE `transaksi_header`.id='" . $id . "'");
  $r = FQO($q);
  return $r->$field;
}
function CheckBlockedIP($ip) {
  $Q = DQ("select*from intrusions WHERE ip='" . $ip . "' AND reaction='3'");
  return NQ($Q);
}
function ResetJournal($id) {
  if (!isset($id)) {
    $Q = "NO TRANSACT ID ASSIGNED!";
  } else {
    $Q = DQ("UPDATE u_journal SET t_posted='Y' WHERE id='" . $_GET['id'] . "'");
  }
  return $Q;
}
function CJDetail($account_no, $debit = 0, $credit = 0, $remark = '', $system_ref = '', $created_id = 'system', $parentid = '') {
  $Q = DQ("INSERT INTO u_journal_detail (account_no, debit, credit, remark,system_ref,created_id, created_date,parent_id)
			VALUES 
		('" . $account . "','" . $debit . "','" . $credit . "','" . $remark . "','" . $created_id . "','" . $system_ref . "',sysdate(),'" . $parent . "')");
  return $Q;
}
function CJ($input_date, $system_ref, $remark, $journal_type_id = 'JU') {
  $Q = DQ("INSERT INTO u_journal(input_date ,yearmonth_periode ,system_ref ,remark,journal_type_id,created_date)
					VALUES 
				('" . $input_date . "','" . SystemPeriod() . "','" . $system_ref . "','" . $remark . "','" . $journal_type_id . "',sysdate())");
  return $Q;
}
function CreateJournalDetail($account_no, $debit = 0, $credit = 0, $remark = '', $system_ref = '', $created_id = 'system', $parentid = '') {
  $Q = DQ("INSERT INTO u_journal_detail (account_no, debit, credit, remark,system_ref,created_id, created_date,parent_id)
			VALUES 
		('" . $account . "','" . $debit . "','" . $credit . "','" . $remark . "','" . $created_id . "','" . $system_ref . "',sysdate(),'" . $parent . "')");
  return $Q;
}
function CreateJournal($input_date, $system_ref, $remark, $journal_type_id = 'JU') {
  $Qj = DQ("INSERT INTO u_journal(input_date ,yearmonth_periode ,system_ref ,remark,journal_type_id,created_date)
					VALUES 
				('" . $input_date . "','" . SystemPeriod() . "','" . $system_ref . "','" . $remark . "','JU',sysdate())");
  return $Q;
}
function garis($txt, $n) {
  return str_repeat($txt, $n);
}
function getMaterialData($id, $field = 'c_id') {
  $Q = DQ("SELECT*FROM t_material_usage WHERE c_id='" . $id . "'");
  $r = FQO($Q);
  return $r->$field;
}
if (!function_exists("getOrderAmountRupiah")) {
  function getOrderAmountRupiah($id) {
    $q = DQ("SELECT
                    `transaksi_detail`.`isbonus`,
                    `transaksi_detail`.`order_amount`, 
                    `transaksi_detail`.`item_id`,
                    `transaksi_header`.`customer_id`,
                    `m_barang`.`TINGGI`,
                    `m_barang`.`PANJANG`
                    FROM
						`transaksi_header`
						JOIN
						`transaksi_detail` ON `transaksi_header`.`id` = `transaksi_detail`.`parent_id`
						JOIN
						`m_barang` ON `transaksi_detail`.`item_id` = `m_barang`.`KODE_BRG`
				   WHERE 
						`transaksi_header`.id='" . $id . "'");
    while ($res = FQO($q)) {
      $price = getPricefromPricelist($res->customer_id, $res->item_id);
      if ($res->isbonus == 'Y') {
        $jumlah+=0;
      } else {
        $jumlah+=$res->order_amount * $price * $res->PANJANG;
        $data[] = array("ITEM" => $res->item_id, "CUSTOMER" => $res->customer_id, "KELUAR" => $res->order_amount, "HARGA" => $price, "PANJANG" => $res->PANJANG);
      }
    }
    #print_r($data);
    return $jumlah;
  }
}
if (!function_exists("getDeliveredOrderAmountRupiah")) {
  function getDeliveredOrderAmountRupiah($id) {
    $q = DQ("SELECT
                    `transaksi_detail`.`isbonus`,
                    `transaksi_detail`.`keluar`, 
                    `transaksi_detail`.`price`,
                    `transaksi_detail`.`item_id`,
                    `transaksi_header`.`customer_id`,
                    `m_barang`.`TINGGI`,
                    `m_barang`.`PANJANG`
                    FROM
						`transaksi_header`
						JOIN
						`transaksi_detail` ON `transaksi_header`.`id` = `transaksi_detail`.`parent_id`
						JOIN
						`m_barang` ON `transaksi_detail`.`item_id` = `m_barang`.`KODE_BRG`
				   WHERE 
						`transaksi_header`.parent_id='" . $id . "' AND `transaksi_header`.type_transaksi='kirim'");
    while ($res = FQO($q)) {
      $price = $res->price;
      if ($res->isbonus == 'Y') {
        $jumlah+=0;
      } else {
        $jumlah+=$res->keluar * $price * $res->PANJANG;
        $data[] = array("ITEM" => $res->item_id, "CUSTOMER" => $res->customer_id, "KELUAR" => $res->keluar, "HARGA" => $price, "PANJANG" => $res->PANJANG);
      }
    }
    //print_r($data);
    return $jumlah;
  }
}
function _getLastCustomerPrice($id_customer, $id_item) {
  $Q = DQ("select a.price as last_price, c.kode_grup , c.HARGA_BELI, b.tgl_transaksi
								FROM 
									transaksi_detail a 
											JOIN transaksi_header b ON a.parent_id=b.id 
											JOIN m_barang c ON a.item_id=c.KODE_BRG
								WHERE
									b.customer_id='" . $id_customer . "' AND 
									a.item_id='" . $id_item . "' AND 
									b.type_transaksi='kirim' 
							    ORDER BY a.id DESC");
  $rlast_price = FQO($Q);
  $last_price_customer = $rlast_price->last_price;
  return $last_price_customer;
}
function _getLastMaterialPrice() {
  $qplast = DQ("select*from t_material_usage ORDER BY c_id DESC");
  $rplast = FQO($qplast);
  return $rplast->price;
}
/*
 * function _getLastMaterialPrice(){
  $qplast=DQ("select*from t_material_usage WHERE c_type='IN' AND in_type='BELI' ORDER BY c_id DESC");
  $rplast=FQO($qplast);
  return $rplast->price;
  }
 */
function _getColorName($id) {
  $q = DQ("select*from m_color WHERE id_color='" . $id . "'");
  $r = FQO($q);
  return $r->color_name;
}
function _getCorakName($d) {
  $q = DQ("select*from m_corak WHERE corak_id='" . $id . "'");
  $r = FQO($q);
  return $rplast->corak_name;
}
if (!function_exists("getAccess")) {
  function getAccess($id_menu, $access='v') {
    if ($access == 'v') {
      $field = "VIEW";
    } elseif ($access == 't') {
      $field = "TAMBAH";
    } elseif ($access == 'u') {
      $field = "UBAH";
    } elseif ($access == 'd') {
      $field = "HAPUS";
    }else{
      $field='';
    }
    $txt_priv = "SELECT * FROM menu_detail WHERE KODE_USER='" . $_SESSION['auth_user'] . "' AND KODE_MENU='" . $id_menu . "' AND " . $field . "='Y'";
    //return $txt_priv;
    $QPriv = DQ($txt_priv);
    if (NQ($QPriv) > 0) {
      return true;
    } else {
      return false;
    }
  }
}
function GetMenuVar($id, $field = "MENU_NAME") {
  $q = DQ("select*from menu WHERE KODE_MENU='" . $id . "'");
  $r = FQO($q);
  return $r->$field;
}
function thisUrle() {
  return base64_encode($_SERVER['REQUEST_URI']);
}
function thisUrld($url) {
  return base64_decode($url);
}
function Module($id) {
  $u = "index.php?m=" . $id;
  return $u;
}
function noty($type = 'error', $message = '') {
  $_SESSION['noty'] = array("start" => time(), "type" => $type, "message" => $message, "expire" => time() + 1);
}
function Go($url) {
  header("location:" . $url);
}
function GoNoty($module, $type = "error", $msg = "") {
  noty($type, $msg);
  header("location:" . $module);
}



function generatePL($do = '') {
  $a = DQ("select*from t_account WHERE account_no='5'");
  $rs_a = FQO($a);
  $qaa = DQ("select*from t_account WHERE parent_id='" . $rs_a->account_no . "'");
  $t_asset = 0;
  $tsales = 0;
  $sales = 0;
  $kurang = 0;
  $tkurang = 0;
  while ($rs_aa = FQO($qaa)) {
    if ($rs_aa->account_no == '5100' || $rs_aa->account_no == '5300') {
      $qsaldo_asset = DQ("select SUM(credit) AS saldo  FROM u_journal_detail WHERE account_no='" . $rs_aa->account_no . "'");
      $rsaldo_asset = FQO($qsaldo_asset);
      $sales+=$rsaldo_asset->saldo + $rs_aa->o_credit;
    } else {
      $qsaldo_asset = DQ("select SUM(debit) AS saldo  FROM u_journal_detail WHERE account_no='" . $rs_aa->account_no . "'");
      $rsaldo_asset = FQO($qsaldo_asset);
      $kurang = $rsaldo_asset->saldo + $rs_aa->o_debet;
    }
    $tsales = $sales;
    $tkurang = $kurang;
  }
  $tnetsales = $tsales - $tkurang;
  $q_modal = DQ("select*from t_account WHERE account_no='4'");
  $rs_modal = FQO($q_modal);
  $modal2 = DQ("select*from t_account WHERE LEFT(account_no,1)='4'");
  $texpense = 0;
  while ($rs_modal2 = FQO($modal2)) {
    $q_modal_saldo = DQ("select SUM(debit-credit) AS saldo  FROM u_journal_detail WHERE account_no='" . $rs_modal2->account_no . "'");
    $rs_saldo = FQO($q_modal_saldo);
    $texpense+=$rs_saldo->saldo + $rs_modal2->o_credit;
  }
  $pl = $tnetsales - $texpense;
  //return $pl;
  DQ("UPDATE t_account SET o_credit='" . $pl . "' WHERE account_no='3400'");
  
  /*
  if ($do == '') {
    return $pl;
  } else {
    DQ("UPDATE t_account SET o_credit='" . generatePL() . "' WHERE account_no='3400'");
  }
   
   */
}