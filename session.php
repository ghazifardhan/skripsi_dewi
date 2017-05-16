<?php
session_start();
include_once("koneksi.php");
if(isset($_POST['login'])?$_POST['login']:''){
$username=isset($_POST['username'])?$_POST['username']:'';
$password=isset($_POST['password'])?$_POST['password']:'';
$passmd5=$password;

if(empty($username)|| empty($username)){
echo ("<script type='text/javascript'>
alert('silahkan isi semua data');document.location='javascript:history.back(1)';
</script>");
}else{
$query=mysql_query("select*from tbl_login where UserName='$username'
and	Password='$passmd5'");
$data=mysql_fetch_array($query);
if($username==$data['UserName'] && $passmd5==$data['Password']){
	$_SESSION['username']=$data['UserName'];
	$_SESSION['level']=$data['Level'];
	$_SESSION['authorized']=1;
	header('location:home.php');
	$q=mysql_query("select*from tbl_login where UserName='$username'");
	}else{
echo("<script type ='text/javascript'> alert('username atau password anda salah');document.location='javascript:history.back(1)';
</script>");
	}
	}
}
?>