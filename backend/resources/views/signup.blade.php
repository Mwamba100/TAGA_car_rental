<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Sign Up | TAGA Car Rentals</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
  <style>
    body {
      background: #f5f5f5;
      font-family: 'Poppins', sans-serif;
    }

    .sign-in-box {
      max-width: 400px;
      margin: 120px auto;
      padding: 30px;
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }

    .sign-in-box h2 {
      text-align: center;
      margin-bottom: 20px;
      color: var(--main-color);
    }

    .sign-in-box label {
      display: block;
      margin-bottom: 6px;
      font-weight: 500;
    }

    .sign-in-box input {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 6px;
      margin-bottom: 15px;
    }

    .sign-in-box .btn {
      width: 100%;
      background: var(--main-color);
      border: none;
      color: #fff;
      padding: 12px;
      border-radius: 6px;
      cursor: pointer;
      font-weight: 600;
    }

    .sign-in-box .btn:hover {
      background: #a00000;
    }

    .sign-in-box p {
      text-align: center;
      margin-top: 15px;
    }

    .sign-in-box a {
      color: var(--main-color);
      font-weight: 500;
      text-decoration: none;
    }

    .copyright {
      text-align: center;
      padding: 20px;
      font-size: 0.9rem;
      color: #777;
    }
  </style>
</head>
<body>

  <div class="sign-in-box">
    <h2>Sign Up</h2>

    <form id="signup-form">
      <label for="new-username">Username</label>
      <input type="text" id="new-username" placeholder="Choose a username" required>

      <label for="new-password">Password</label>
      <input type="password" id="new-password" placeholder="Choose a password" required>

      <button type="submit" class="btn">Create Account</button>
    </form>

    <p>Already have an account? <a href="signin.html">Sign In</a></p>
  </div>

  <div class="copyright">
    &#169; 2025 TAGA Car Rentals All Right Reserved
  </div>

  <script>
    // Simple sign-up mock
    document.getElementById('signup-form').addEventListener('submit', function(e) {
      e.preventDefault();
      const username = document.getElementById('new-username').value;
      const password = document.getElementById('new-password').value;

      alert("Account created successfully! Please sign in.");
      window.location.href = "signin.html";
    });
  </script>
</body>
</html>
