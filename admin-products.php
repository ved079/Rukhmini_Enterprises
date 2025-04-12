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
  <title>Manage Products - Rukhmini Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<!-- Header -->
<header class="bg-blue-700 text-white p-4 shadow">
  <div class="max-w-6xl mx-auto flex justify-between items-center">
    <h1 class="text-xl font-bold">🛒 Manage Products</h1>
    <a href="admin-dashboard.php" class="text-sm underline hover:text-blue-200">← Back to Dashboard</a>
  </div>
</header>

<main class="max-w-6xl mx-auto py-10 px-4">
  <!-- Add Form -->
  <div class="bg-white p-6 rounded-lg shadow mb-8">
    <h2 class="text-lg font-bold mb-4">Add New Product</h2>
    <form id="add-form" class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <input type="text" id="name" placeholder="Product Name" class="border rounded p-2" required />
      <input type="text" id="image" placeholder="Image (e.g. electrode1.jpg)" class="border rounded p-2" required />
      <textarea id="description" placeholder="Description" class="border rounded p-2 md:col-span-2" required></textarea>
      <input type="number" id="price" placeholder="Price" class="border rounded p-2" required />
      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 md:col-span-2">
        ➕ Add Product
      </button>
    </form>
  </div>

  <!-- Product Table -->
  <div class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-lg font-bold mb-4">All Products</h2>
    <div class="overflow-x-auto">
      <table class="w-full text-sm text-left border">
        <thead class="bg-blue-100 text-gray-700 font-semibold">
          <tr>
            <th class="p-3">ID</th>
            <th class="p-3">Image</th>
            <th class="p-3">Name</th>
            <th class="p-3">Price</th>
            <th class="p-3">Actions</th>
          </tr>
        </thead>
        <tbody id="product-table">
          <!-- Populated by JS -->
        </tbody>
      </table>
    </div>
  </div>
</main>

<script>
  const table = document.getElementById("product-table");

  function loadProducts() {
    fetch("backend/get-products.php")
      .then(res => res.json())
      .then(data => {
        table.innerHTML = "";
        data.products.forEach(p => {
          table.innerHTML += `
            <tr class="border-b">
              <td class="p-3">${p.id}</td>
              <td class="p-3"><img src="assets/images/${p.image}" class="w-12 h-12 object-contain"></td>
              <td class="p-3">${p.name}</td>
              <td class="p-3">₹${p.price}</td>
              <td class="p-3 space-x-2">
                <button onclick='editProduct(${JSON.stringify(p)})' class="text-yellow-600 hover:underline">Edit</button>
                <button onclick='deleteProduct(${p.id})' class="text-red-600 hover:underline">Delete</button>
              </td>
            </tr>`;
        });
      });
  }

  function deleteProduct(id) {
    if (!confirm("Delete this product?")) return;
    fetch("backend/delete-product.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ id })
    }).then(() => loadProducts());
  }

  function editProduct(p) {
    document.getElementById("name").value = p.name;
    document.getElementById("image").value = p.image;
    document.getElementById("description").value = p.description;
    document.getElementById("price").value = p.price;

    document.getElementById("add-form").onsubmit = function (e) {
      e.preventDefault();
      fetch("backend/update-product.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
          id: p.id,
          name: name.value,
          image: image.value,
          description: description.value,
          price: parseFloat(price.value)
        })
      }).then(() => {
        loadProducts();
        this.reset();
        this.onsubmit = handleAdd;
      });
    }
  }

  function handleAdd(e) {
  e.preventDefault();

  const name = document.getElementById("name").value;
  const image = document.getElementById("image").value;
  const description = document.getElementById("description").value;
  const price = parseFloat(document.getElementById("price").value);

  fetch("backend/add-product.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ name, image, description, price })
  })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        loadProducts();
        e.target.reset();
      } else {
        alert(data.error || "Failed to add product.");
      }
    })
    .catch(() => alert("Server error while adding product."));
}



  document.getElementById("add-form").onsubmit = handleAdd;
  document.addEventListener("DOMContentLoaded", loadProducts);
</script>

</body>
</html>
