<?php
$dbServerName = "localhost"; // Ganti dengan localhost atau 127.0.0.1
$dbUser       = "root";      // Default username untuk XAMPP
$dbPass       = "";          // Default password untuk XAMPP (kosong)
$db           = "rokto_db";  // Ganti dengan nama database Anda
$conn = mysqli_connect($dbServerName, $dbUser, $dbPass, $db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
