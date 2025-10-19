<?php
session_start();
require_once '../config/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Invalid request.");
}

$email = trim($_POST["email"]);
$password = trim($_POST["password"]);

if (empty($email) && empty($password)) {
    $error = "All fields are required.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = "Invalid email format.";
} else {
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
        $_SESSION['username'] = $user['name'];

        header("Location: ../../views/welcome.php");
        exit;
    } else {
        $error = "Invalid email or password.";
    }

    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login Result</title>
</head>
<body>
  <?php if (isset($error)): ?>
    <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
    <a href="../../public/login.html">Try Again</a>
  <?php endif; ?>
</body>
</html>
