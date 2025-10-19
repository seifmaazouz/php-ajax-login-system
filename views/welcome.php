<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../public/login.html");
    exit;
}

// Prevent going back after logout
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="../public/assets/css/welcome.css">
</head>

<body>
    <div class="welcome-container">
        <div class="welcome-card">
            <h2>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?>!</h2>
            <p>You are now logged in.</p>
            <button id="logoutBtn">Logout</button>
        </div>
    </div>

    <script>
        document.getElementById("logoutBtn").addEventListener("click", async () => {
            try {
                const response = await fetch("../app/includes/logout.php");
                const data = await response.json();
                if (data.success) {
                    window.location.href = "../public/login.html";
                }
            } catch {
                alert("Logout failed. Try again.");
            }
        });
    </script>
</body>

</html>