<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login - Rukhmini Enterprises</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      background: #f1f1f1 url('assets/images/logo-faint.png') no-repeat center center fixed;
      background-size: 35%;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    header {
      width: 100%;
      padding: 20px 0;
      background-color: #003366;
      color: white;
      text-align: center;
      font-size: 24px;
      font-weight: bold;
      letter-spacing: 1px;
    }

    .container {
      margin-top: 40px;
      background: white;
      border-radius: 15px;
      box-shadow: 0px 0px 20px rgba(0,0,0,0.1);
      padding: 40px;
      width: 100%;
      max-width: 500px;
    }

    h2 {
      margin-bottom: 20px;
      font-size: 28px;
      text-align: center;
    }

    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border-radius: 6px;
      border: 1px solid #ccc;
    }

    .admin-checkbox {
      display: flex;
      align-items: center;
      margin-top: 10px;
    }

    .admin-checkbox input {
      margin-right: 10px;
    }

    button {
      margin-top: 20px;
      padding: 12px;
      width: 100%;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
      transition: 0.3s ease;
    }

    button:hover {
      background-color: #0056b3;
    }

    .message {
      margin-top: 15px;
      text-align: center;
      font-size: 14px;
      color: red;
    }

    .register-link {
      margin-top: 20px;
      text-align: center;
      font-size: 14px;
    }

    .register-link a {
      color: #007bff;
      text-decoration: none;
      font-weight: 600;
    }

    .register-link a:hover {
      text-decoration: underline;
    }

    .admin-login-btn {
      margin-top: 10px;
      text-align: center;
    }

    .admin-login-btn a {
      display: inline-block;
      padding: 10px 20px;
      background-color: #333;
      color: #fff;
      border-radius: 6px;
      font-weight: 600;
      text-decoration: none;
      transition: 0.3s;
    }

    .admin-login-btn a:hover {
      background-color: #000;
    }
  </style>
</head>
<body>

  <header>
    Rukhmini Enterprises - Login
  </header>

  <div class="container">
    <h2>Login</h2>
    <form id="loginForm">
      <input type="email" id="email" placeholder="Your email" required>
      <input type="password" id="password" placeholder="Your password" required>

      <div class="admin-checkbox">
        <input type="checkbox" id="is-admin" />
        <label for="is-admin">Are you an admin?</label>
      </div>

      <button type="submit">Login</button>
      <div class="message" id="message"></div>
    </form>

    <div class="register-link">
      New user? <a href="/backend/register.php">Register here</a>
    </div>

    <div class="admin-login-btn">
      <a href="/admin-login.php">🔐 Admin Login</a>
    </div>
  </div>

  <script>
    document.getElementById("loginForm").addEventListener("submit", function (e) {
      e.preventDefault();

      const isAdmin = document.getElementById("is-admin").checked;
      const email = document.getElementById("email").value;
      const password = document.getElementById("password").value;
      const msg = document.getElementById("message");

      if (isAdmin) {
        // Redirect to admin login
        window.location.href = "admin-login.php";
        return;
      }

      fetch("backend/login-user.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json"
        },
        body: JSON.stringify({ email, password })
      })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          localStorage.setItem("user", JSON.stringify(data.user));
          window.location.href = "index.php";
        } else {
          msg.innerText = data.error || "Invalid login";
        }
      })
      .catch(() => {
        msg.innerText = "Server error. Try again later.";
      });
    });
  </script>

</body>
</html>
