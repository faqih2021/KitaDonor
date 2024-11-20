<?php
$dbServerName = "mysql";
$dbUser       = "root";
$dbPass       = "root_password"; 
$db           = "rokto_db";
$conn = mysqli_connect($dbServerName, $dbUser, $dbPass, $db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
