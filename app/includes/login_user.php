<?php
header("Content-Type: application/json");
session_start();
require_once '../config/db_connect.php';

function respond($message, $success = false) {
    echo json_encode(["success" => $success, "message" => $message]);
    exit; // automatically closes $stmt and $conn
}

if ($_SERVER["REQUEST_METHOD"] !== "POST")
    exit ("Invalid request method.");

$email = trim($_POST["email"]);
$password = trim($_POST["password"]);

if (empty($email) && empty($password))
    respond("All fields are required.");

if (empty($email))
    respond("Email cannot be empty.");

if (empty($password))
    respond("Password cannot be empty.");

if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    respond("Invalid email format.");

// hash password
$hashed_password = md5($password);

// check user credentials
$stmt = $conn->prepare("SELECT user_id, name FROM user WHERE email = ? AND password = ?");
$stmt->bind_param("ss", $email, $hashed_password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    
    // set session variables
    $_SESSION['user_id'] = $user['user_id'];
    $_SESSION['name'] = $user['name'];
    respond("Login successful", true);
} else {
    respond("Invalid email or password.");
}