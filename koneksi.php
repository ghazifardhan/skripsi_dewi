
<?php
$server = "localhost";
$user = "root";
$passsword = "root";
$database = "dewi";

($GLOBALS["___mysqli_ston"] = mysqli_connect($server, $user, $passsword));
mysqli_select_db($GLOBALS["___mysqli_ston"], $database);
?> 