<?php
$host = "localhost";
$user = "root";
$pass = "Pratik@2006";  // Your MySQL password
$db = "ecommerce";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
