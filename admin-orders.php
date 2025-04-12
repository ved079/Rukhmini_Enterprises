<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: admin-login.php");
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Orders - Rukhmini Enterprises</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<header class="bg-blue-700 text-white p-4 shadow">
  <div class="max-w-6xl mx-auto flex justify-between items-center">
    <h1 class="text-xl font-bold">📦 Manage Orders</h1>
    <a href="admin-dashboard.php" class="text-sm underline hover:text-blue-200">← Back to Dashboard</a>
  </div>
</header>

<main class="max-w-6xl mx-auto py-10 px-4">
  <div class="bg-white shadow rounded-lg p-6">
    <h2 class="text-lg font-bold mb-4">All Orders</h2>
    <div id="order-container" class="space-y-6">
      <!-- Orders will be loaded here -->
    </div>
  </div>
</main>

<script>
  function loadOrders() {
    fetch("backend/get-all-orders.php")
      .then(res => res.json())
      .then(data => {
        const container = document.getElementById("order-container");
        container.innerHTML = "";

        if (!data.orders.length) {
          container.innerHTML = "<p class='text-gray-600 italic'>No orders found.</p>";
          return;
        }

        data.orders.forEach(order => {
          let itemsHTML = "";
          order.items.forEach(item => {
            itemsHTML += `
              <div class="flex justify-between text-sm text-gray-700">
                <span>${item.name} (x${item.quantity})</span>
                <span>₹${item.price * item.quantity}</span>
              </div>`;
          });

          const block = `
            <div class="border rounded p-4 bg-gray-50">
              <div class="flex justify-between items-center mb-2">
                <div>
                  <h3 class="font-bold text-lg">Order #${order.id}</h3>
                  <p class="text-sm text-gray-500">🕒 ${order.created_at}</p>
                </div>
                <div class="text-sm text-right">
                  <p><strong>${order.user_name}</strong></p>
                  <p>${order.email}</p>
                </div>
              </div>
              <div class="text-sm text-gray-600 mb-2">
                <p>📍 ${order.address}</p>
                <p>💬 ${order.notes}</p>
                <p>💳 Payment: <strong>${order.payment}</strong></p>
              </div>
              <div class="bg-white border-t pt-3 mt-3">
                ${itemsHTML}
              </div>
              <div class="text-right mt-4 font-bold text-gray-800">Total: ₹${order.total}</div>
            </div>`;
          
          container.innerHTML += block;
        });
      });
  }

  document.addEventListener("DOMContentLoaded", loadOrders);
</script>

</body>
</html>
