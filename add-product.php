<?php
header('Content-Type: application/json');

// Load database connection
require __DIR__ . '/backend/db.php';

// Allow only POST method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  http_response_code(405);
  echo json_encode(['success' => false, 'error' => 'Only POST method allowed']);
  exit;
}

// Parse JSON request body
$data = json_decode(file_get_contents('php://input'), true);

// Sanitize inputs
$name = trim($data['name'] ?? '');
$description = trim($data['description'] ?? '');
$price = (float)($data['price'] ?? 0);
$image = trim($data['image'] ?? '');

// Validate input
if (!$name || !$description || !$price || !$image) {
  http_response_code(400);
  echo json_encode(['success' => false, 'error' => 'All fields are required']);
  exit;
}

// Insert product into database
try {
  $stmt = $pdo->prepare("INSERT INTO products (name, description, price, image) VALUES (?, ?, ?, ?)");
  $stmt->execute([$name, $description, $price, $image]);

  echo json_encode([
    'success' => true,
    'message' => 'Product added successfully'
  ]);
} catch (PDOException $e) {
  http_response_code(500);
  echo json_encode([
    'success' => false,
    'error' => 'Database error',
    'details' => $e->getMessage()
  ]);
}
