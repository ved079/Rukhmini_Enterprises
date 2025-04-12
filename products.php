<?php include('includes/header.php'); ?>

<section class="py-16">
  <div class="max-w-6xl mx-auto px-4">
    <h2 class="text-3xl font-bold text-center mb-10">Our Full Product Range</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <?php
        $productNames = [
          "Mild Steel Electrodes", "Low Hydrogen Electrodes", "Stainless Steel Electrodes",
          "Cast Iron Electrodes", "Hardfacing Electrodes", "Aluminium Electrodes",
          "Bronze Electrodes", "Nickel Electrodes", "Cellulosic Electrodes"
        ];

        $descriptions = [
          "Reliable welding for mild steel components.",
          "Perfect for structural welding jobs.",
          "Corrosion-resistant high-strength welding.",
          "Specially designed for cast iron repair.",
          "Wear-resistant for hardfacing applications.",
          "Lightweight and conductive for aluminum work.",
          "Great for bronze casting repairs.",
          "High-strength electrodes for critical work.",
          "Deep penetration and fast-freeze features."
        ];

        for ($i = 1; $i <= 9; $i++) {
          $img = "assets/images/electrode" . $i . ".jpg";
          echo '
          <a href="product-detail.php?id=' . $i . '" class="block bg-blue-50 shadow-md rounded-xl p-4 text-center hover:shadow-xl transition">
            <img src="' . $img . '" alt="' . $productNames[$i - 1] . '" class="w-52 h-52 object-contain mx-auto mb-4">
            <h3 class="text-xl font-semibold">' . $productNames[$i - 1] . '</h3>
            <p class="text-sm text-gray-600">' . $descriptions[$i - 1] . '</p>
          </a>';
        }
      ?>
    </div>
  </div>
</section>

<!-- Floating Chat Button -->
<div class="fixed bottom-6 right-6 z-50">
  <a href="contact.php">
    <button class="bg-blue-600 text-white px-4 py-2 rounded-full shadow-lg hover:bg-blue-700">
      💬 Need Help?
    </button>
  </a>
</div>
<!-- Cart Preview Script -->
<script src="/rukhmini-enterprises/assets/js/cart-preview.js"></script>


<?php include('includes/footer.php'); ?>
