<?php include('includes/header.php'); ?>

<section class="py-16 max-w-5xl mx-auto px-4">
  <h2 class="text-3xl font-bold mb-10 text-center">Your Cart</h2>

  <!-- Cart Items -->
  <div id="cart-section" class="space-y-6 mb-10">
    <!-- Cart items will be injected here -->
  </div>

  <!-- Total -->
  <div class="text-right mb-10">
    <p class="text-2xl font-semibold">Grand Total: ₹<span id="grand-total">0</span></p>
  </div>

  <!-- Checkout Form -->
<div class="bg-white shadow-md rounded-xl p-6">
  <h3 class="text-2xl font-semibold mb-4">Checkout</h3>
  <form id="checkout-form" class="space-y-4">
    <input type="text" name="name" placeholder="Full Name" class="w-full border rounded px-4 py-2" required>
    <input type="email" name="email" placeholder="Email Address" class="w-full border rounded px-4 py-2" required>
    <input type="text" name="address" placeholder="Shipping Address" class="w-full border rounded px-4 py-2" required>
    <textarea name="notes" placeholder="Any Notes..." class="w-full border rounded px-4 py-2"></textarea>

    <select name="payment" class="w-full border rounded px-4 py-2" required>
      <option value="" disabled selected>Choose Payment Method</option>
      <option value="Cash on Delivery">Cash on Delivery</option>
      <option value="UPI">UPI</option>
      <option value="Credit/Debit Card">Credit/Debit Card</option>
    </select>

    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">
      Place Order
    </button>
  </form>
</div>
<script>
  document.getElementById("checkout-form").addEventListener("submit", function (e) {
    e.preventDefault();

    const cart = JSON.parse(localStorage.getItem("cart") || "{}");
    const cartItems = Object.entries(cart).map(([id, item]) => ({
      id: parseInt(id),
      name: item.name,
      price: parseFloat(item.price),
      quantity: parseInt(item.quantity)
    }));

    const payload = {
      name: this.name.value.trim(),
      email: this.email.value.trim(),
      address: this.address.value.trim(),
      notes: this.notes.value.trim(),
      payment: this.payment.value,
      cart: cartItems
    };

    // Optional debug log
    console.log("Sending Order:", payload);

    fetch("process-order.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(payload)
    })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        alert("✅ Order placed successfully!");
        localStorage.removeItem("cart");
        window.location.href = "profile.php";
      } else {
        alert("❌ Error: " + (data.error || "Something went wrong"));
      }
    });
  });
</script>

</section>

<!-- Need Help Button -->
<div class="fixed bottom-6 right-6 z-50">
  <a href="contact.php">
    <button class="bg-blue-600 text-white px-4 py-2 rounded-full shadow-lg hover:bg-blue-700">
      💬 Need Help?
    </button>
  </a>
</div>

<script>
  function getImage(productName) {
    const name = productName.toLowerCase();
    if (name.includes("mild")) return "electrode1.jpg";
    if (name.includes("low")) return "electrode2.jpg";
    if (name.includes("stainless")) return "electrode3.jpg";
    if (name.includes("cast")) return "electrode4.jpg";
    if (name.includes("hardfacing")) return "electrode5.jpg";
    if (name.includes("aluminium")) return "electrode6.jpg";
    if (name.includes("bronze")) return "electrode7.jpg";
    if (name.includes("nickel")) return "electrode8.jpg";
    return "electrode9.jpg";
  }

  function loadCart() {
    updateCartCount();

    const cart = JSON.parse(localStorage.getItem("cart")) || {};
    const container = document.getElementById("cart-section");
    const totalDOM = document.getElementById("grand-total");

    container.innerHTML = "";
    let total = 0;

    Object.entries(cart).forEach(([id, item]) => {
      const itemTotal = item.quantity * item.price;
      total += itemTotal;

      const image = getImage(item.name);

      const html = `
        <div class="flex items-center bg-white shadow rounded-lg overflow-hidden">
          <img src="assets/images/${image}" alt="${item.name}" class="w-28 h-28 object-contain bg-gray-100 p-2">
          <div class="flex-grow px-4 py-2">
            <h4 class="text-lg font-bold">${item.name}</h4>
            <p class="text-sm text-gray-500">₹${item.price} x ${item.quantity}</p>
            <p class="font-semibold mt-1">Total: ₹${itemTotal}</p>

            <div class="mt-2 flex space-x-2 items-center">
              <button class="bg-gray-200 px-2 rounded decrement" data-id="${id}">−</button>
              <span>${item.quantity}</span>
              <button class="bg-gray-200 px-2 rounded increment" data-id="${id}">+</button>
              <button class="ml-auto text-red-500 hover:text-red-700 remove-item" data-id="${id}">❌ Remove</button>
            </div>
          </div>
        </div>
      `;

      container.insertAdjacentHTML("beforeend", html);
    });

    totalDOM.innerText = total.toFixed(2);
  }
  updateCartCount();


  // Update cart and UI when +/-/remove is clicked
  document.addEventListener("click", (e) => {
    const cart = JSON.parse(localStorage.getItem("cart")) || {};
    const id = e.target.getAttribute("data-id");

    if (e.target.classList.contains("increment")) {
      cart[id].quantity += 1;
    } else if (e.target.classList.contains("decrement")) {
      if (cart[id].quantity > 1) cart[id].quantity -= 1;
    } else if (e.target.classList.contains("remove-item")) {
      delete cart[id];
    } else {
      return;
    }

    localStorage.setItem("cart", JSON.stringify(cart));
    loadCart();
  });

  document.addEventListener("DOMContentLoaded", loadCart);

  function submitOrder() {
    const cart = localStorage.getItem('cart');
    if (!cart || cart === '{}') {
      alert("Your cart is empty!");
      return false;
    }

    document.getElementById('cart-data').value = cart;
    return true;
  }
</script>

<?php include('includes/footer.php'); ?>
