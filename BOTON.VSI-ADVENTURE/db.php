<?php
$servername = "localhost";
$username = "root";  // por defecto en XAMPP
$password = "";
$dbname = "vsiadventure_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
