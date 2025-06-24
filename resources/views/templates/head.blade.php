<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>TAGA Car Rentals</title>
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
      <header>
    <a href="{{ url('/') }}" class="logo"><img src="{{ asset('images/logo.png') }}" alt="TAGA Logo"></a>
    <ul class="navbar">
      <li><a href="{{ url('/#home') }}">Home</a></li>
      <li><a href="{{ url('/#ride') }}">Ride</a></li>
      <li><a href="{{ url('/#services') }}">Services</a></li>
      <li><a href="{{ url('/#about') }}">About</a></li>
      <li><a href="{{ url('/#reviews') }}">Reviews</a></li>
    </ul>
    <div class="header-btn">
      <a href="{{ url('/register') }}" class="sign-up">Sign Up</a>
      <a href="{{ url('/signin') }}" class="sign-in">Sign In</a>
    </div>
  </header>