<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Login - Rukhmini Enterprises</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: #f9fafb url('assets/images/logo-faint.png') no-repeat center center;
      background-size: 300px;
      background-attachment: fixed;
      background-repeat: no-repeat;
      background-position: top 100px center;
    }
  </style>
</head>
<body class="min-h-screen flex flex-col items-center">

  <!-- Header -->
  <header class="w-full bg-blue-900 text-white text-center py-5 text-2xl font-semibold shadow">
    🔐 Rukhmini Enterprises - Admin Login
  </header>

  <!-- Logo + Form -->
  <main class="flex-1 flex flex-col items-center justify-center w-full mt-10">

    

    <!-- Login Form -->
    <form action="admin-auth.php" method="POST" class="bg-white p-8 rounded-lg shadow-md w-full max-w-md space-y-6">
      <h2 class="text-2xl font-bold text-blue-800 text-center">Welcome Admin</h2>

      <input type="text" name="username" placeholder="Admin Username" class="w-full border px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" required />

      <input type="password" name="password" placeholder="Password" class="w-full border px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" required />

      <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">Login</button>

      <?php if (isset($_GET['error'])): ?>
        <p class="text-sm text-red-600 text-center mt-2"><?= htmlspecialchars($_GET['error']) ?></p>
      <?php endif; ?>
    </form>
  </main>

</body>
</html>
