<?php
$servername = "mysql.hostinger.in";
$username = "u231711877_yash";
$password = "yashjain";
$dbname = "u231711877_mydat";
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>