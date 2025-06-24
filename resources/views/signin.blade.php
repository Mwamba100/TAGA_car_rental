<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Sign In | TAGA Car Rentals</title>
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
    <h2>Sign In</h2>

    <form id="signin-form">
      <label for="email">Email</label>
      <input type="email" id="email" name="email" placeholder="Enter your email" required>

      <label for="password">Password</label>
      <input type="password" id="password" name="password" placeholder="Enter your password" required>

      <button type="submit" class="btn">Sign In</button>
    </form>

    <p>Don't have an account? <a href="{{ url('/register') }}">Sign Up</a></p>
  </div>

  <div class="copyright">
    &#169; 2025 TAGA Car Rentals All Right Reserved
  </div>

  <script>
  document.getElementById('signin-form').addEventListener('submit', async function(e) {
    e.preventDefault();
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value.trim();

    try {
      const response = await fetch("{{ url('/auth/login') }}", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "Accept": "application/json",
          "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({ email, password })
      });

      const data = await response.json();

      if (response.ok) {
        alert("Sign In Successful!");
        window.location.href = "{{ url('/') }}";
      } else {
        let msg = data.message || "Login failed.";
        if (data.errors) {
          msg += "\n" + Object.values(data.errors).flat().join('\n');
        }
        alert(msg);
      }
    } catch (error) {
      alert("An error occurred. Please try again.");
    }
  });
  </script>

</body>
</html>
