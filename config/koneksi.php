<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "spkayam(new)";
//
// $server = "localhost";
// $username = "trydev98";
// $password = "trydev9898";
// $database = "spktht";

mysql_connect($server,$username,$password) or die("Koneksi gagal");
mysql_select_db($database) or die("Maaf, Database tidak bisa dibuka");
?>
