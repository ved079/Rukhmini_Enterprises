<?php
session_start();
$user = $_SESSION['user'] ?? null;

include('includes/header.php');
?>



<!-- Welcome Section -->
<section class="bg-gradient-to-r from-blue-50 to-blue-100 text-center py-6">
  <h2 class="text-xl font-semibold text-blue-800">Welcome to Rukhmini Enterprises</h2>
  <p class="text-gray-600">Your trusted partner in high-quality welding electrodes.</p>
</section>

<!-- Carousel Section -->
<section class="py-16 bg-white relative">
  <div class="max-w-4xl mx-auto">
    <div class="relative overflow-hidden rounded-xl shadow-lg">
      <div id="carousel" class="relative">
        <?php
        $names = ["Mild Steel Electrodes", "Low Hydrogen Electrodes", "Stainless Steel Electrodes"];
        $desc = [
          "Reliable welding for mild steel components.",
          "Perfect for structural welding jobs.",
          "Corrosion-resistant high-strength welding."
        ];
        for ($i = 1; $i <= 3; $i++) {
          echo '
          <div class="slide hidden text-center px-6 py-10">
            <a href="product-detail.php?id=' . $i . '">
              <img src="assets/images/electrode' . $i . '.jpg" class="mx-auto w-[400px] h-[400px] object-contain mb-6" />
              <h3 class="text-3xl font-bold text-gray-800 mb-2">' . $names[$i - 1] . '</h3>
              <p class="text-lg text-gray-600">' . $desc[$i - 1] . '</p>
            </a>
          </div>';
        }
        ?>
      </div>

      <!-- Carousel Buttons -->
      <button id="prevBtn" class="absolute top-1/2 left-3 transform -translate-y-1/2 bg-blue-600 text-white px-3 py-2 rounded-full shadow hover:bg-blue-700 z-10">←</button>
      <button id="nextBtn" class="absolute top-1/2 right-3 transform -translate-y-1/2 bg-blue-600 text-white px-3 py-2 rounded-full shadow hover:bg-blue-700 z-10">→</button>
    </div>
  </div>
</section>

<!-- Need Help Button -->
<div class="fixed bottom-6 right-6 z-50">
  <a href="contact.php">
    <button class="bg-blue-600 text-white px-4 py-2 rounded-full shadow-lg hover:bg-blue-700">
      💬 Need Help?
    </button>
  </a>
</div>

<!-- JS for Carousel -->
<script>
  const slides = document.querySelectorAll('.slide');
  let current = 0;

  function showSlide(i) {
    slides.forEach((s, idx) => s.classList.toggle('hidden', idx !== i));
  }

  document.getElementById('nextBtn').onclick = () => {
    current = (current + 1) % slides.length;
    showSlide(current);
  };

  document.getElementById('prevBtn').onclick = () => {
    current = (current - 1 + slides.length) % slides.length;
    showSlide(current);
  };

  setInterval(() => {
    current = (current + 1) % slides.length;
    showSlide(current);
  }, 5000);

  showSlide(current);
</script>

<!-- Cart Preview -->
<script src="/rukhmini-enterprises/assets/js/cart-preview.js"></script>

<?php include('includes/footer.php'); ?>
