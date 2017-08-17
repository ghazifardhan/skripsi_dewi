
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$connection=array(
    'host'=>'localhost',
    'user'=>'root',
    'password'=>'',
    'db'=>'haris',
    'port'=>'3306'
);
$dbconnection=($GLOBALS["___mysqli_ston"] = mysqli_connect($connection['host'],  $connection['user'], $connection['password']));
$db=  mysqli_select_db($GLOBALS["___mysqli_ston"], $connection['db']); 