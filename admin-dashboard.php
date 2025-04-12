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
  <title>Admin Dashboard - Rukhmini Enterprises</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

  <!-- Header -->
  <header class="bg-blue-700 text-white p-4 shadow">
    <div class="max-w-6xl mx-auto flex justify-between items-center">
      <h1 class="text-xl font-bold">🔧 Admin Panel</h1>
      <nav class="space-x-4 text-sm">
        <a href="admin-dashboard.php" class="hover:underline">Dashboard</a>
        <a href="admin-products.php" class="hover:underline">Manage Products</a>
        <a href="admin-orders.php" class="hover:underline">Manage Orders</a>
        <a href="backend/admin-logout.php" class="text-red-300 hover:text-red-500">Logout</a>
      </nav>
    </div>
  </header>

  <!-- Main Content -->
  <main class="max-w-6xl mx-auto p-8">
    <h2 class="text-2xl font-semibold mb-4 text-gray-800">Welcome, Admin!</h2>
    <p class="text-gray-600 mb-6">Use the links above to manage products and view orders.</p>

    <!-- Placeholder for future stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div class="bg-white p-6 rounded shadow">
        <h3 class="text-lg font-semibold text-gray-700 mb-2">📦 Manage Products</h3>
        <p class="text-sm text-gray-600">View, add, update or delete product listings.</p>
        <a href="admin-products.php" class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Go to Products</a>
      </div>
      <div class="bg-white p-6 rounded shadow">
        <h3 class="text-lg font-semibold text-gray-700 mb-2">🧾 Manage Orders</h3>
        <p class="text-sm text-gray-600">Track and manage all customer orders.</p>
        <a href="admin-orders.php" class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Go to Orders</a>
      </div>
    </div>
  </main>

</body>
</html>
