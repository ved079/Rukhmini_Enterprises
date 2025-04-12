<?php
header('Content-Type: application/json');

file_put_contents("debug_log.txt", "Reached start\n", FILE_APPEND);

require 'backend/db.php';

$data = json_decode(file_get_contents('php://input'), true);

file_put_contents("debug_log.txt", "Data: " . json_encode($data) . "\n", FILE_APPEND);

$name = trim($data['name'] ?? '');
$email = trim($data['email'] ?? '');
$address = trim($data['address'] ?? '');
$notes = trim($data['notes'] ?? '');
$payment = trim($data['payment'] ?? '');
$cart = $data['cart'] ?? [];

if (!$name || !$email || !$address || empty($cart)) {
  file_put_contents("debug_log.txt", "Missing field!\n", FILE_APPEND);
  echo json_encode(['success' => false, 'error' => 'Missing fields or empty cart']);
  exit;
}

try {
  $pdo->beginTransaction();

  $stmt = $pdo->prepare("INSERT INTO orders (name, email, address, notes, payment_method) VALUES (?, ?, ?, ?, ?)");

  $stmt->execute([$name, $email, $address, $notes, $payment]);

  $orderId = $pdo->lastInsertId();

  $stmtItem = $pdo->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");

  foreach ($cart as $item) {
    $stmtItem->execute([
      $orderId,
      $item['id'],
      $item['quantity'],
      $item['price']
    ]);
  }

  $pdo->commit();

  file_put_contents("debug_log.txt", "Order success\n", FILE_APPEND);
  echo json_encode(['success' => true, 'message' => 'Order placed successfully']);
} catch (Exception $e) {
  $pdo->rollBack();
  file_put_contents("debug_log.txt", "Error: " . $e->getMessage() . "\n", FILE_APPEND);
  echo json_encode([
    'success' => false,
    'error' => 'Order failed',
    'details' => $e->getMessage()
  ]);
}
