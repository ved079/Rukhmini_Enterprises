<?php include('includes/header.php'); ?>

<section class="py-20 text-center max-w-2xl mx-auto px-4">
  <h2 class="text-4xl font-bold text-green-600 mb-4">✅ Thank You!</h2>
  <p class="text-gray-700 text-lg mb-6">Your order has been received. We'll get in touch with you shortly.</p>

  <div class="space-x-4 mt-6">
    <a href="index.php" class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700">Go to Home</a>
    <a href="products.php" class="bg-gray-100 text-blue-600 px-5 py-2 rounded hover:bg-gray-200">Continue Shopping</a>
  </div>
</section>

<!-- Clear cart from localStorage -->
<script>
  localStorage.removeItem("cart");
</script>

<?php include('includes/footer.php'); ?>
