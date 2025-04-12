<?php
header('Content-Type: application/json');
require __DIR__ . '/backend/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  http_response_code(405);
  echo json_encode(['error' => 'Only POST method allowed']);
  exit;
}

$data = json_decode(file_get_contents("php://input"), true);

$id = (int)($data['id'] ?? 0);
$name = trim($data['name'] ?? '');
$description = trim($data['description'] ?? '');
$price = (float)($data['price'] ?? 0);
$image = trim($data['image'] ?? '');

if ($id <= 0 || !$name || !$description || !$price || !$image) {
  echo json_encode(['error' => 'All fields are required including ID']);
  exit;
}

try {
  $stmt = $pdo->prepare("UPDATE products SET name = ?, description = ?, price = ?, image = ? WHERE id = ?");
  $stmt->execute([$name, $description, $price, $image, $id]);

  echo json_encode(['success' => true, 'message' => "Product #$id updated successfully"]);
} catch (PDOException $e) {
  http_response_code(500);
  echo json_encode(['error' => 'Database error', 'details' => $e->getMessage()]);
}
