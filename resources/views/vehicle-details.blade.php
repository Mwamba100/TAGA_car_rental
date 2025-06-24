<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Vehicle Details | TAGA Car Rental</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="homepage.css"/>
</head>
<body>
    <section class="page-header">
        <div class="container">
          <h1 class="fw-bold" id="car-name">Vehicle Details</h1>
          <p>Complete details and booking options for your selected vehicle</p>
        </div>
      </section>
      
      <section class="section">
        <div class="container" id="vehicle-detail">
          <!-- Vehicle details will be injected here -->
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
      <div class="row g-5">
        <div class="col-md-6">
          <img src="img/economy.jpg" class="img-fluid rounded shadow-sm" alt="Vehicle">
        </div>
        <div class="col-md-6">
          <h2 class="fw-bold">Economy Sedan</h2>
          <p>🚪 4 Doors | 🪑 5 Seats | ⚙️ Auto | ❄️ A/C</p>
          <p><strong>$45/day</strong></p>
          <button class="btn btn-primary">Book This Car</button>
        </div>
      </div>
    </div>
  </section>
</body>
</html>
