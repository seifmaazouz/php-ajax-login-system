<?php
session_start();

// if user is already logged in, redirect to welcome page
if (isset($_SESSION['user_id'])) {
    header("Location: views/welcome.php");
    exit;
}

header("Location: public/login.html");
exit;