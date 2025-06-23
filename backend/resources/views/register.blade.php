<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Register | TAGA Car Rental</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="homepage.css"/>
</head>
<body>
    <section class="page-header">
        <div class="container">
          <h1 class="fw-bold">Login to Your Account</h1> <!-- or "Register an Account" -->
        </div>
      </section>
      
      <section class="section">
        <div class="container">
          <form class="auth-form">
            <!-- Your form fields here -->
          </form>
        </div>
      </section>
      
  <div class="container d-flex justify-content-center align-items-center vh-100">
    <form class="w-100" style="max-width: 400px;">
      <h2 class="mb-4 text-center">Register</h2>
      <div class="mb-3">
        <label>Full Name</label>
        <input type="text" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Email address</label>
        <input type="email" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Password</label>
        <input type="password" class="form-control" required>
      </div>
      <button class="btn btn-primary w-100">Register</button>
      <p class="text-center mt-3">Already have an account? <a href="login.html">Login</a></p>
    </form>
  </div>
</body>
</html>
