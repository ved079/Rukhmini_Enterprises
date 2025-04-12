<?php
session_start();

// Hardcoded admin credentials (for now)
$adminUser = "admin";
$adminPass = "rukhmini123"; // Strong passwords later, ok?

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if ($username === $adminUser && $password === $adminPass) {
  $_SESSION['admin'] = true;
  header("Location: admin-dashboard.php");
  exit;
}

header("Location: admin-login.php");
exit;
