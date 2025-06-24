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
      <input type="text" id="new-username" name="name" placeholder="Choose a username" required>

      <label for="new-email">Email</label>
      <input type="email" id="new-email" name="email" placeholder="Enter your email" required>

      <label for="new-phone">Phone Number</label>
      <input type="text" id="new-phone" name="phone" placeholder="Enter your phone number" required pattern="\d*" inputmode="numeric" maxlength="20" oninput="this.value = this.value.replace(/[^0-9]/g, '')">

      <label for="new-password">Password</label>
      <input type="password" id="new-password" name="password" placeholder="Choose a password" required>

      <label for="confirm-password">Confirm Password</label>
      <input type="password" id="confirm-password" name="password_confirmation" placeholder="Confirm your password" required>

      <button type="submit" class="btn">Create Account</button>
    </form>

    <p>Already have an account? <a href="<?= url('login')?>">Sign In</a></p>
  </div>

  <div class="copyright">
    &#169; 2025 TAGA Car Rentals All Right Reserved
  </div>

  <script>
    document.getElementById('signup-form').addEventListener('submit', async function(e) {
      e.preventDefault();
      const name = document.getElementById('new-username').value;
      const email = document.getElementById('new-email').value;
      const phone = document.getElementById('new-phone').value;
      const password = document.getElementById('new-password').value;
      const password_confirmation = document.getElementById('confirm-password').value;

      try {
        const response = await fetch("{{ url('/auth/register') }}", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            "Accept": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
          },
          body: JSON.stringify({
            name,
            email,
            phone,
            password,
            password_confirmation
          })
        });

        const data = await response.json();

        if (response.ok) {
          alert("Account created successfully! Please sign in.");
          window.location.href = "{{ url('/login') }}";
        } else {
          let msg = data.message || "Registration failed.";
          if (data.errors) {
            msg += "\n" + Object.values(data.errors).flat().join('\n');
          }
          alert(msg);
        }
      } catch (error) {
        alert("An error occurred. Please try again.");
      }
    });

    document.getElementById('new-phone').addEventListener('input', function(e) {
      this.value = this.value.replace(/[^0-9]/g, '');
    });
  </script>
</body>
</html>
