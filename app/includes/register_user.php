<?php
require_once '../config/db_connect.php';

// $response = ['success' => false, 'message' => ''];

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Invalid request.");
}  

$name = trim($_POST["name"]);
$email = trim($_POST["email"]);
$password = trim($_POST["password"]);
$confirm_password = trim($_POST["confirmPassword"]);

// validate inputs
if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
    $error = "All fields are required.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = "Invalid email format.";
} elseif (empty($password)) {
    $error = "Password cannot be empty.";
} elseif ($password !== $confirm_password) {
    $error = "Passwords do not match.";
} else {
    // check if user already exists
    $stmt = $conn->prepare("SELECT user_id FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $error = "User with this email already exists.";
    } else {
        // insert new user
        $hashed_password = md5($password); // Hash the password
        $stmt = $conn->prepare("INSERT INTO user (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $hashed_password);  // avoids SQL injection
        if ($stmt->execute()) {
            $success = "Registration successful";
        } else {
            $error = "Error: " . $stmt->error;
        }
    }
    $stmt->close();
}
$conn->close();

?>

<!DOCTYPE html>
<html>
<head>
  <title>Register</title>
</head>
<body>
  <?php if (isset($error)): ?>
    <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
  <?php elseif (isset($success)): ?>
    <p style="color:green;"><?php echo htmlspecialchars($success); ?></p>
  <?php endif; ?>

  <a href="../../public/login.html">Go to Login</a>
</body>
</html>
