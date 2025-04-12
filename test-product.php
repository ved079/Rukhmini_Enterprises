<?php
header('Content-Type: application/json');

// 👇 Add your correct PostgreSQL connection
$host = 'localhost';
$db   = 'rukhmini_db';
$user = 'postgres';
$pass = 'root123'; // set your password if any
$dsn  = "pgsql:host=$host;dbname=$db";

try {
  $pdo = new PDO($dsn, $user, $pass, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
  ]);
} catch (PDOException $e) {
  http_response_code(500);
  echo json_encode(['error' => 'Connection failed', 'details' => $e->getMessage()]);
  exit;
}

// Dummy product insertion
try {
  $stmt = $pdo->prepare("INSERT INTO products (name, description, price, image) VALUES (?, ?, ?, ?)");
  $stmt->execute([
    'Test Product',
    'Added from test script',
    999,
    'electrode-test.jpg'
  ]);

  echo json_encode(['success' => true, 'message' => 'Inserted test product successfully']);
} catch (PDOException $e) {
  http_response_code(500);
  echo json_encode(['error' => 'Insert failed', 'details' => $e->getMessage()]);
}
