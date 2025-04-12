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

if ($id <= 0) {
  echo json_encode(['error' => 'Invalid product ID']);
  exit;
}

try {
  $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
  $stmt->execute([$id]);

  echo json_encode([
    'success' => true,
    'message' => "Product with ID $id deleted successfully"
  ]);
} catch (PDOException $e) {
  http_response_code(500);
  echo json_encode(['error' => 'Database error', 'details' => $e->getMessage()]);
}
