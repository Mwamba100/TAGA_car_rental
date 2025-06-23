<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Payment | TAGA Car Rentals</title>
  <link rel="stylesheet" href="style.css">
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
    }

    .btn:hover {
      background: #a00000;
    }

    form {
      margin-top: 10px;
    }
  </style>
</head>
<body>

    <script>
  // Check if the user is signed in
  const user = localStorage.getItem("user");

  if (!user) {
    // If no user is found in localStorage, redirect to sign-in page
    alert("You must be signed in to rent a car.");
    window.location.href = "signin.html"; // Redirect to sign-in page
  }
</script>

    
<header>
  <a href="index.html" class="logo"><img src="logo.png" alt="TAGA Logo"></a>

  <div class="bx bx-menu" id="menu-icon"></div>

  <ul class="navbar">
    <li><a href="index.html#home">Home</a></li>
    <li><a href="index.html#ride">Ride</a></li>
    <li><a href="index.html#services">Services</a></li>
    <li><a href="index.html#about">About</a></li>
    <li><a href="index.html#reviews">Reviews</a></li>
  </ul>

  <div class="header-btn">
    <a href="#" class="sign-up">Sign Up</a>
    <a href="#" class="sign-in">Sign In</a>
  </div>
</header>

<div class="payment-box">
  <h2>Complete Your Booking</h2>
  <p><strong>Car:</strong> <span id="carName"></span></p>
  <p><strong>Price Per Day:</strong> K<span id="pricePerDay"></span></p>

  <label>Pick-Up Date:</label>
  <input type="date" id="pickupDate" required>

  <label>Return Date:</label>
  <input type="date" id="returnDate" required>

  <p class="total">Total: K<span id="totalPrice">0</span></p>

  <label>Select Payment Method:</label>
  <select id="paymentMethod">
    <option value="">-- Choose Payment Method --</option>
    <option value="card">Debit/Credit Card</option>
    <option value="mobile">Mobile Money</option>
    <option value="cash">Cash on Pickup</option>
  </select>

  <!-- Card Payment Form -->
  <form id="card-form" style="display: none;">
    <label for="cardname">Cardholder Name</label>
    <input type="text" id="cardname" placeholder="Mary Banda" required>

    <label for="cardnumber">Card Number</label>
    <input type="text" id="cardnumber" maxlength="16" placeholder="1111 2222 3333 4444" required>

    <label for="expiry">Expiry Date</label>
    <input type="text" id="expiry" placeholder="MM/YY" required>

    <label for="cvv">CVV</label>
    <input type="text" id="cvv" maxlength="4" placeholder="123" required>
  </form>

  <!-- Mobile Money Form -->
  <form id="mobile-form" style="display: none;">
    <label for="provider">Select Provider</label>
    <select id="provider" required>
      <option value="">--Choose--</option>
      <option value="airtel">Airtel Money</option>
      <option value="mtn">MTN Mobile Money</option>
      <option value="zamtel">Zamtel Kwacha</option>
    </select>

    <label for="mobile-number">Mobile Number</label>
    <input type="tel" id="mobile-number" placeholder="097XXXXXXX" required>
  </form>

  <button class="btn" onclick="submitPayment()">Pay Now</button>
  <a href="index.html" class="btn" style="margin-top: 10px; display: inline-block;">← Back to Main Page</a>

</div>

<script>
  const urlParams = new URLSearchParams(window.location.search);
  const carName = urlParams.get('car');
  const price = parseInt(urlParams.get('price'));

  document.getElementById('carName').innerText = carName;
  document.getElementById('pricePerDay').innerText = price;

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

  function submitPayment() {
    const total = calculateDays();
    const method = paymentSelect.value;

    if (!pickupInput.value || !returnInput.value) {
      alert("Please select pick-up and return dates.");
      return;
    }

    if (total === 0) {
      alert("Invalid date selection.");
      return;
    }

    if (method === "card") {
      if (
        !document.getElementById('cardname').value ||
        !document.getElementById('cardnumber').value ||
        !document.getElementById('expiry').value ||
        !document.getElementById('cvv').value
      ) {
        alert("Please fill in all card details.");
        return;
      }
    }

    if (method === "mobile") {
      if (
        !document.getElementById('provider').value ||
        !document.getElementById('mobile-number').value
      ) {
        alert("Please fill in mobile money details.");
        return;
      }
    }

    alert(`Payment Successful!\nCar: ${carName}\nMethod: ${method}\nTotal Paid: K${total}`);
    window.location.href = "index.html";
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
