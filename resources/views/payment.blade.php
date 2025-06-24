<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Payment | TAGA Car Rentals</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Use Laravel asset helper for CSS -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
  <style>
    .payment-box {
      max-width: 600px;
      margin: 100px auto;
      background: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .payment-box h2 {
      margin-bottom: 15px;
      color: var(--main-color);
    }
    .payment-box label {
      display: block;
      margin: 10px 0 5px;
    }
    .payment-box input, .payment-box select {
      width: 100%;
      padding: 8px;
      border-radius: 5px;
      border: 1px solid #ccc;
      margin-bottom: 10px;
    }
    .total {
      font-weight: bold;
      margin: 15px 0;
      font-size: 1.2rem;
    }
    .btn {
      padding: 10px 20px;
      background: var(--main-color);
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      display: inline-block;
      margin-right: 8px;
      margin-top: 8px;
      text-align: center;
      text-decoration: none;
    }
    .btn:hover {
      background: #a00000;
    }
    form {
      margin-top: 10px;
    }
    header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 18px 40px;
      background: #ff0000;
    }
    .logo img {
      width: 90px;
    }
    .navbar {
      display: flex;
      gap: 1rem;
    }
    .navbar li {
      list-style: none;
    }
    .navbar a {
      color: #fff;
      font-weight: 500;
      text-decoration: none;
      padding: 10px 20px;
    }
    .header-btn a {
      color: #fff;
      background: #0b0000;
      border-radius: 0.5rem;
      padding: 10px 20px;
      margin-left: 8px;
      text-decoration: none;
    }
    .header-btn .sign-in:hover {
      background: var(--main-color);
    }
    @media (max-width: 768px) {
      .payment-box { margin: 40px 10px; }
      header { flex-direction: column; padding: 10px 10px; }
      .navbar { flex-direction: column; gap: 0; }
      .header-btn { margin-top: 10px; }
    }
  </style>
</head>
<body>
  <script>
    // Check if the user is logged in via backend (session/cookie)
    async function checkUser() {
      try {
        const response = await fetch("{{ url('/api/user-info') }}", {
          method: "GET",
          headers: {
            "Accept": "application/json",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"

          },
          credentials: "same-origin"
        });
        if (response.status === 401) {
          alert("You must be signed in to rent a car.");
          window.location.href = "{{ url('/login') }}";
          return null;
        }
    }
    document.addEventListener('DOMContentLoaded', checkUser);
  </script>

  <header>
    <a href="{{ url('/') }}" class="logo"><img src="{{ asset('images/logo.png') }}" alt="TAGA Logo"></a>
    <ul class="navbar">
      <li><a href="{{ url('/#home') }}">Home</a></li>
      <li><a href="{{ url('/#ride') }}">Ride</a></li>
      <li><a href="{{ url('/#services') }}">Services</a></li>
      <li><a href="{{ url('/#about') }}">About</a></li>
      <li><a href="{{ url('/#reviews') }}">Reviews</a></li>
    </ul>
  </header>

  <div id="user-info" style="text-align:center; margin-top:10px; color:#333; font-weight:500;"></div>

  <div class="payment-box">
    <h2>Complete Your Booking</h2>
    <div id="car-details" style="background:#f9f9f9;padding:15px;border-radius:8px;margin-bottom:15px;">
      <div id="carImageContainer" style="text-align:center;margin-bottom:15px;">
        <img id="carImage"
             src="{{ request('image') ? asset(request('image')) : asset('images/default_car.png') }}"
             alt="Car Image"
             style="max-width:220px;max-height:140px;border-radius:8px;box-shadow:0 0 8px rgba(0,0,0,0.08);">
      </div>
      <p><strong>Car:</strong> <span id="carName"></span></p>
      <p><strong>Price Per Day:</strong> K<span id="pricePerDay"></span></p>
      <p><strong>Car Description:</strong> <span id="carDescription"></span></p>
      <p><strong>Car Type:</strong> <span id="carType"></span></p>
      <p><strong>Seats:</strong> <span id="carSeats"></span></p>
      <p><strong>Transmission:</strong> <span id="carTransmission"></span></p>
      <!-- Add more car details as needed -->
    </div>

    <form id="payment-form" onsubmit="event.preventDefault(); submitPayment();">
      <label>Pick-Up Date:</label>
      <input type="date" id="pickupDate" required>

      <label>Return Date:</label>
      <input type="date" id="returnDate" required>

      <p class="total">Total: K<span id="totalPrice">0</span></p>

      <label>Select Payment Method:</label>
      <select id="paymentMethod" required>
        <option value="">-- Choose Payment Method --</option>
        <option value="card">Debit/Credit Card</option>
        <option value="mobile">Mobile Money</option>
        <option value="cash">Cash on Pickup</option>
      </select>

      <!-- Card Payment Form -->
      <div id="card-form" style="display: none;">
        <label for="cardname">Cardholder Name</label>
        <input type="text" id="cardname" placeholder="Mary Banda">

        <label for="cardnumber">Card Number</label>
        <input type="text" id="cardnumber" maxlength="16" placeholder="1111 2222 3333 4444">

        <label for="expiry">Expiry Date</label>
        <input type="text" id="expiry" placeholder="MM/YY">

        <label for="cvv">CVV</label>
        <input type="text" id="cvv" maxlength="4" placeholder="123">
      </div>

      <!-- Mobile Money Form -->
      <div id="mobile-form" style="display: none;">
        <label for="provider">Select Provider</label>
        <select id="provider">
          <option value="">--Choose--</option>
          <option value="airtel">Airtel Money</option>
          <option value="mtn">MTN Mobile Money</option>
          <option value="zamtel">Zamtel Kwacha</option>
        </select>

        <label for="mobile-number">Mobile Number</label>
        <input type="tel" id="mobile-number" placeholder="097XXXXXXX">
      </div>

      <button class="btn" type="submit">Pay Now</button>
      <a href="{{ url('/') }}" class="btn">← Back to Main Page</a>
    </form>

  </div>

  <script>
    // Get car and price from URL
    const urlParams = new URLSearchParams(window.location.search);
    const carName = urlParams.get('car');
    const price = parseInt(urlParams.get('price'));
    // Optionally get image from URL or backend
    const carImage = urlParams.get('image'); // e.g. ?image=images/cars/toyota.jpg

    // Example: You may want to fetch car details from the backend using carName or carId
    // For demonstration, we'll use static/dummy data for car details
    const carDetails = {
      description: "Comfortable, fuel efficient, and perfect for city driving.",
      type: "Sedan",
      seats: 5,
      transmission: "Automatic"
    };

    document.getElementById('carName').innerText = carName || '';
    document.getElementById('pricePerDay').innerText = price || 0;
    document.getElementById('carDescription').innerText = carDetails.description;
    document.getElementById('carType').innerText = carDetails.type;
    document.getElementById('carSeats').innerText = carDetails.seats;
    document.getElementById('carTransmission').innerText = carDetails.transmission;

    // Set car image if provided in URL, else use default
    if (carImage) {
      document.getElementById('carImage').src = "{{ asset('') }}" + carImage;
    }

    const pickupInput = document.getElementById('pickupDate');
    const returnInput = document.getElementById('returnDate');
    const totalDisplay = document.getElementById('totalPrice');
    const paymentSelect = document.getElementById('paymentMethod');
    const cardForm = document.getElementById('card-form');
    const mobileForm = document.getElementById('mobile-form');

    function calculateDays() {
      const pickup = new Date(pickupInput.value);
      const drop = new Date(returnInput.value);
      if (pickup && drop && drop >= pickup) {
        const diffTime = drop - pickup;
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
        const total = diffDays * price;
        totalDisplay.innerText = total;
        return total;
      } else {
        totalDisplay.innerText = "0";
        return 0;
      }
    }

    pickupInput.addEventListener('change', calculateDays);
    returnInput.addEventListener('change', calculateDays);

    paymentSelect.addEventListener('change', () => {
      const method = paymentSelect.value;
      cardForm.style.display = method === "card" ? "block" : "none";
      mobileForm.style.display = method === "mobile" ? "block" : "none";
    });

    async function submitPayment() {
      const car = document.getElementById('carName').innerText;
      const price = document.getElementById('pricePerDay').innerText;
      const image = document.getElementById('carImage').getAttribute('src');
      const pickupDate = document.getElementById('pickupDate').value;
      const returnDate = document.getElementById('returnDate').value;
      const paymentMethod = document.getElementById('paymentMethod').value;
      let paymentDetails = {};

      // Validate form as before (not shown for brevity)...

      if (paymentMethod === "card") {
        paymentDetails = {
          cardname: document.getElementById('cardname').value,
          cardnumber: document.getElementById('cardnumber').value,
          expiry: document.getElementById('expiry').value,
          cvv: document.getElementById('cvv').value
        };
      } else if (paymentMethod === "mobile") {
        paymentDetails = {
          provider: document.getElementById('provider').value,
          mobile_number: document.getElementById('mobile-number').value
        };
      }

      try {
        const response = await fetch("{{ url('/payment/process') }}", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "Accept": "application/json"
          },
          body: JSON.stringify({
            car,
            price,
            image,
            pickup_date: pickupDate,
            return_date: returnDate,
            payment_method: paymentMethod,
            payment_details: paymentDetails
          })
        });

        const data = await response.json();

        if (response.ok) {
          alert("Payment Successful! " + (data.message || ""));
          window.location.href = "{{ url('/') }}";
        } else {
          alert(data.message || "Payment failed. Please try again.");
        }
      } catch (err) {
        alert("An error occurred while processing payment.");
      }
    }
  </script>

  <script>
    // Navbar toggle for mobile view
    let menu = document.querySelector('#menu-icon');
    let navbar = document.querySelector('.navbar');

    menu.onclick = () => {
      menu.classList.toggle('bx-x');
      navbar.classList.toggle('active');
    }

    window.onscroll = () => {
      menu.classList.remove('bx-x');
      navbar.classList.remove('active');
    }
  </script>


</body>
</html>
