<?php
session_start();
if (!isset($_SESSION['user'])) {
  header("Location: login.php");
  exit;
}

$user = $_SESSION['user'];
include('includes/header.php');
?>

<section class="max-w-5xl mx-auto py-16 px-4">
  <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
    
    <!-- Sidebar -->
    <div class="bg-white shadow rounded-lg p-6">
      <h2 class="text-xl font-bold mb-4">👋 Hello, <?= htmlspecialchars($user['name']) ?></h2>
      <ul class="space-y-2 text-blue-700 text-sm font-medium">
        <li><a href="#info" class="hover:underline">📄 Profile Info</a></li>
        <li><a href="#orders" class="hover:underline">📦 My Orders</a></li>
        <li><a href="#settings" class="hover:underline">⚙️ Settings</a></li>
        <li><a href="logout.php" class="text-red-600 hover:underline">🚪 Logout</a></li>
      </ul>
    </div>

    <!-- Main Content -->
    <div class="md:col-span-2 space-y-12">

      <!-- Profile Info -->
      <div id="info" class="bg-white shadow rounded-lg p-6">
        <h3 class="text-xl font-semibold mb-4 text-gray-800">👤 Profile Information</h3>
        <div class="space-y-4 text-gray-700">
          <div class="flex justify-between">
            <span class="font-semibold">Name:</span>
            <span><?= htmlspecialchars($user['name']) ?></span>
          </div>
          <div class="flex justify-between">
            <span class="font-semibold">Email:</span>
            <span><?= htmlspecialchars($user['email']) ?></span>
          </div>
          <div class="flex justify-between">
            <span class="font-semibold">Membership:</span>
            <span class="italic text-gray-500">Standard</span>
          </div>
        </div>
      </div>

      <!-- Order History -->
      <div id="orders" class="bg-white shadow rounded-lg p-6">
        <h3 class="text-xl font-semibold mb-4 text-gray-800">📦 Recent Orders</h3>
        <div id="order-history" class="space-y-4 text-gray-700 text-sm">
          <!-- JS will populate here -->
          <p class="italic text-gray-500">Loading orders...</p>
        </div>
      </div>

      <!-- Settings -->
      <div id="settings" class="bg-white shadow rounded-lg p-6">
        <h3 class="text-xl font-semibold mb-4 text-gray-800">⚙️ Account Settings</h3>
        <div class="text-gray-600 text-sm italic">
          Feature coming soon: Edit Profile, Change Password, etc.
        </div>
      </div>

    </div>
  </div>
</section>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    fetch("backend/get-orders.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ email: "<?= $user['email'] ?>" })
    })
    .then(res => res.json())
    .then(data => {
      const container = document.getElementById("order-history");
      container.innerHTML = "";

      if (!data.success || data.orders.length === 0) {
        container.innerHTML = `<p class="italic text-gray-500">You haven't placed any orders yet.</p>`;
        return;
      }

      data.orders.forEach(order => {
        let itemsHTML = "";
        let total = 0;

        order.items.forEach(item => {
          const itemTotal = item.quantity * item.price;
          total += itemTotal;
          itemsHTML += `
            <div class="flex justify-between border-b py-2">
              <div>
                <p class="font-semibold">#${item.product_id}</p>
                <p class="text-xs text-gray-500">${item.quantity} × ₹${item.price}</p>
              </div>
              <p class="font-medium">₹${itemTotal.toFixed(2)}</p>
            </div>
          `;
        });

        container.innerHTML += `
          <div class="border rounded p-4 shadow-sm">
            <div class="flex justify-between text-gray-600 mb-2">
              <span>Order ID: #${order.id}</span>
              <span>${new Date(order.created_at).toLocaleString()}</span>
            </div>
            ${itemsHTML}
            <div class="text-right font-semibold mt-2 text-blue-700">Total: ₹${total.toFixed(2)}</div>
            <p class="text-xs mt-1 text-gray-500">Payment: ${order.payment_method}</p>
            <p class="text-xs text-gray-500">Address: ${order.address}</p>
          </div>
        `;
      });
    });
  });
</script>

<?php include('includes/footer.php'); ?>
