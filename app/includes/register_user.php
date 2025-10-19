<?php
header("Content-Type: application/json");
require_once '../config/db_connect.php';

function respond($message, $success = false) {
    echo json_encode(["success" => $success, "message" => $message]);
    exit; // automatically closes $stmt and $conn
}

if ($_SERVER["REQUEST_METHOD"] !== "POST")
    exit ("Invalid request method.");

$name = trim($_POST["name"]);
$email = trim($_POST["email"]);
$password = trim($_POST["password"]);
$confirm_password = trim($_POST["confirmPassword"]);

// validate inputs
if (empty($name) && empty($email) && empty($password) && empty($confirm_password))
    respond("All fields are required.");

if (empty($name))
    respond("Name cannot be empty.");

if (empty($email))
    respond("Email cannot be empty.");

if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    respond("Invalid email format.");

if (empty($password))
    respond("Password cannot be empty.");

if (empty($confirm_password))
    respond("Confirm Password cannot be empty.");

if ($password !== $confirm_password)
    respond("Passwords do not match.");

// check if email already exists
$stmt = $conn->prepare("SELECT user_id FROM user WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    respond("Email is already registered.");
}
$stmt->close();

// register new user
$hashed_password = md5($password);
$stmt = $conn->prepare("INSERT INTO user (name, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $hashed_password);  // avoids SQL injection

if ($stmt->execute()) {
    respond("Registration successful", true);
} else {
    respond("Error: " . $stmt->error);
}