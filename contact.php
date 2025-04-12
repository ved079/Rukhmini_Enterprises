<?php include('includes/header.php'); ?>

<section class="py-16 max-w-xl mx-auto px-4">
  <h2 class="text-3xl font-bold text-center mb-6">Contact Us</h2>
  <p class="text-center text-gray-600 mb-8">Send us your inquiry and we’ll get back to you soon.</p>

  <form id="contactForm" class="grid grid-cols-1 gap-4">
  <input type="text" name="name" placeholder="Your Name" required class="p-3 border rounded">
  <input type="email" name="email" placeholder="Your Email" required class="p-3 border rounded">
  <input type="text" name="phone" placeholder="Phone Number" class="p-3 border rounded">
  <textarea name="message" placeholder="Your Message" rows="4" required class="p-3 border rounded"></textarea>
  <button type="submit" class="bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Send Message</button>
</form>

<script>
  document.getElementById("contactForm").addEventListener("submit", function (e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch("backend/contact.php", {
      method: "POST",
      body: formData
    })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        alert(data.message); // ✅ show popup
        this.reset();        // 🔁 reset form
      } else {
        alert(data.error || "Failed to send message.");
      }
    })
    .catch(() => {
      alert("Server error. Please try again.");
    });
  });
</script>

</section>


<?php include('includes/footer.php'); ?>
