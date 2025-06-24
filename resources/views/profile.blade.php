<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Profile | TAGA Car Rental</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="homepage.css"/>
</head>
<body>
    <section class="page-header">
        <div class="container">
          <h1 class="fw-bold">Welcome, [User]</h1>
          <p>Your profile & booking history</p>
        </div>
      </section>
      
      <section class="section">
        <div class="container">
          <div class="profile-section">
            <h4 class="mb-3">Your Details</h4>
            <!-- Name, Email, etc. -->
          </div>
      
          <div class="profile-section mt-4">
            <h4 class="mb-3">Past Bookings</h4>
            <ul class="list-group" id="booking-history">
              <!-- Bookings via JS -->
            </ul>
          </div>
        </div>
      </section>
      
 <!-- Navigation -->
 <nav class="navbar navbar-expand-lg bg-white shadow-sm fixed-top">
    <div class="container">
      <a class="navbar-brand fw-bold" href="homepage.html"><span class="text-primary">TAGA</span> Car Rental</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link active" href="homepage.html">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="vehicles.html">Vehicles</a></li>
          <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
          <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
          <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
          <li class="nav-item"><a class="nav-link" href="login.html">Login</a></li>
        </ul>
        <a class="btn btn-primary ms-3" href="vehicle-details.html">Book Now</a>
      </div>
    </div>
  </nav>

  <section class="py-5 mt-5">
    <div class="container">
      <h2 class="mb-4">Welcome, John Doe</h2>
      <h4>Booking History</h4>
      <ul class="list-group">
        <li class="list-group-item">Economy Sedan - Booked on 2025-05-15</li>
        <li class="list-group-item">Premium SUV - Booked on 2025-04-20</li>
      </ul>
    </div>
  </section>
</body>
</html>
