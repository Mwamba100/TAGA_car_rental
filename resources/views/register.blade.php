<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Register Admin | TAGA Car Rental</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="homepage.css"/>
</head>
<body>
  <section class="page-header">
    <div class="container">
      <h1 class="fw-bold">Register an Admin Account</h1>
    </div>
  </section>
  
  <div class="container d-flex justify-content-center align-items-center vh-100">
    <form class="w-100" style="max-width: 400px;" method="POST" action="{{ url('/admin/register') }}">
      @csrf
      <h2 class="mb-4 text-center">Admin Registration</h2>

      {{-- Display Validation Errors --}}
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <div class="mb-3">
        <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
        <input type="text" name="name" id="name" class="form-control" required value="{{ old('name') }}">
      </div>
      <div class="mb-3">
        <label for="phone" class="form-label">Phone Number <span class="text-danger">*</span></label>
        <input type="text" name="phone" id="phone" class="form-control" required value="{{ old('phone') }}">
      </div>
      <div class="mb-3">
        <label for="city" class="form-label">City <span class="text-danger">*</span></label>
        <input type="text" name="city" id="city" class="form-control" required value="{{ old('city') }}">
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email address <span class="text-danger">*</span></label>
        <input type="email" name="email" id="email" class="form-control" required value="{{ old('email') }}">
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
        <input type="password" name="password" id="password" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="password_confirmation" class="form-label">Confirm Password <span class="text-danger">*</span></label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
      </div>
      <input type="hidden" name="role" value="admin">
      <button class="btn btn-danger w-100" type="submit">Register as Admin</button>
      <p class="text-center mt-3">Already have an account? <a href="{{ url('/login') }}">Login</a></p>
    </form>
  </div>
</body>
</html>
