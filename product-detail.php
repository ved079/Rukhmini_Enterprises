<?php include('includes/header.php'); ?>

<?php
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$productNames = [
  1 => "Mild Steel Electrodes",
  2 => "Low Hydrogen Electrodes",
  3 => "Stainless Steel Electrodes",
  4 => "Cast Iron Electrodes",
  5 => "Hardfacing Electrodes",
  6 => "Nickel Electrodes",
  7 => "Aluminium Electrodes",
  8 => "Bronze Electrodes",
  9 => "Cellulosic Electrodes"
];

$productDescriptions = [
  1 => "Reliable welding for mild steel components.",
  2 => "Perfect for structural welding jobs.",
  3 => "Corrosion-resistant high-strength welding.",
  4 => "Specially designed for cast iron repair.",
  5 => "Wear-resistant for hardfacing applications.",
  6 => "Lightweight and conductive for aluminum work.",
  7 => "Great for bronze casting repairs.",
  8 => "High-strength electrodes for critical work.",
  9 => "Deep penetration and fast-freeze features."
];

$productImages = [
  1 => "assets/images/electrode1.jpg",
  2 => "assets/images/electrode2.jpg",
  3 => "assets/images/electrode3.jpg",
  4 => "assets/images/electrode4.jpg",
  5 => "assets/images/electrode5.jpeg",
  6 => "assets/images/electrode6.jpg",
  7 => "assets/images/electrode7.jpg",
  8 => "assets/images/electrode8.jpg",
  9 => "assets/images/electrode9.jpg"
];
?>

<section class="py-16 max-w-3xl mx-auto px-4 text-center">
  <?php if (array_key_exists($id, $productNames)): ?>
    <img src="<?= $productImages[$id] ?>" alt="<?= $productNames[$id] ?>" class="w-full h-auto max-h-[450px] object-contain mx-auto rounded shadow mb-6">

    <h2 class="text-3xl font-bold mb-2"><?= $productNames[$id] ?></h2>
    <p class="text-gray-600 mb-4"><?= $productDescriptions[$id] ?></p>
    <p class="font-semibold text-lg mb-4">₹950.00 per box</p>

    <div class="flex items-center justify-center space-x-4">
      <input type="number" min="1" value="1" class="w-24 border rounded p-2" id="qty">
      <button onclick="addToCart(<?= $id ?>)" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
        Add to Cart
      </button>
    </div>
    <div class="mt-4">
      <a href="products.php" class="text-blue-600 hover:underline text-sm">← Back to Products</a>
    </div>
  <?php else: ?>
    <p class="text-center text-red-500 text-lg">Product not found.</p>
  <?php endif; ?>
</section>

<!-- Floating Chat Button -->
<div class="fixed bottom-6 right-6 z-50">
  <a href="/rukhmini-enterprises/contact.php">
    <button class="bg-blue-600 text-white px-4 py-2 rounded-full shadow-lg hover:bg-blue-700">
      💬 Need Help?
    </button>
  </a>
</div>

<script>
  function addToCart(productId) {
    const qty = parseInt(document.getElementById('qty').value);
    if (!qty || qty < 1) return;

    const productName = document.querySelector("h2").innerText;
    const cart = JSON.parse(localStorage.getItem("cart") || "{}");

    if (!cart[productId]) {
      cart[productId] = {
        name: productName,
        price: 950,
        quantity: qty
      };
    } else {
      cart[productId].quantity += qty;
    }

    localStorage.setItem("cart", JSON.stringify(cart));

    // Show toast
    const msg = document.createElement("div");
    msg.textContent = "✅ Added to cart";
    msg.className = "fixed top-6 right-6 bg-green-600 text-white px-4 py-2 rounded shadow-lg z-50 animate-bounce";
    document.body.appendChild(msg);
    setTimeout(() => msg.remove(), 2000);
    updateCartCount();

  }
</script>

<!-- Cart Preview Script -->
<script src="/rukhmini-enterprises/assets/js/cart-preview.js"></script>

<?php include('includes/footer.php'); ?>
