<?php
session_start();
$act=isset($_GET['act'])?$_GET['act']:'index';

if (!isset($_SESSION['auth'])) {
    header("location:login.php");
}