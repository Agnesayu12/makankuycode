<?php

$serverName = "localhost";
$userName = "root";
$password = "";
$dbName = "cart_db";

$konek = mysqli_connect($serverName,$userName,$password,$dbName) or die(mysqli_error($konek));

?>