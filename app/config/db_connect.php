<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "registration";

// Create connection
try {
    $conn = new mysqli($servername, $username, $password, $dbname);
} catch (Exception $e) {
    die("Connection failed: " . $e->getMessage());
}

// $conn->close();