<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TAGA Car Rental</title>
    <!-- Link to CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Box icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
  </head>
  <body>
    <header>
      <a href="#" class="logo">
        <img src="{{ asset('images/logo.png') }}" alt="logo">
      </a>
      <div class="bx bx-menu" id="menu-icon"></div>
      <ul class="navbar">
        <li><a href="#home">Home</a></li>
        <li><a href="#ride">Ride</a></li>
        <li><a href="#services">Services</a></li>
        <li><a href="#about">About</a></li>
        <li><a href="#reviews">Reviews</a></li>
      </ul>
      <div class="header-btn">
        <a href="#" class="sign-up">Sign Up</a>
        <a href="#" class="sign-in">Sign In</a>
      </div>
    </header>

    <section class="home" id="home">
      <div class="text">
        <h1><span>Looking</span> for <br>rent a car</h1>
        <p>Lorem ipsum dolor sit amet consectetur adi <br> pisicing elit. Fuga, ut qui.</p>
        <!-- Get the app icons -->
        <a href="#" class="btn">Get The App</a>
        <!--
        <p>Available on</p>
        <div class="app-stores">
          <img src="{{ asset('images/ios.png') }}" alt="iOS App">
          <img src="{{ asset('images/512x512.png') }}" alt="App Icon">
        </div>
        <!-->
      </div>
      <div class="form-container">
        <form action="">
          <div class="input-box">
            <span>Location</span>
            <input type="search" placeholder="Search Places">
          </div>
          <div class="input-box">
            <span>Pick-Up Date</span>
            <input type="date">
          </div>
          <div class="input-box">
            <span>Return Date</span>
            <input type="date">
          </div>
          <input type="submit" class="btn" value="Search">
        </form>
      </div>
    </section>

    <section class="ride" id="ride">
      <div class="heading">
        <span>How Its Work</span>
        <h1>Rent With 3 Easy Steps</h1>
      </div>
      <div class="ride-container">
        <div class="box">
          <i class="bx bxs-map"></i>
          <h2>Choose A Location</h2>
          <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Et eveniet assumenda aliquam! Voluptates ipsa ratione, maiores facere accusamus nostrum debitis odit fugit, libero molestias consequuntur dolores doloribus velit, odio commodi.</p>
        </div>
        <div class="box">
          <i class="bx bxs-calendar-check"></i>
          <h2>Pick-Up Date</h2>
          <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Et eveniet assumenda aliquam! Voluptates ipsa ratione, maiores facere accusamus nostrum debitis odit fugit, libero molestias consequuntur dolores doloribus velit, odio commodi.</p>
        </div>
        <div class="box">
          <i class="bx bxs-calendar-star"></i>
          <h2>Book A Car</h2>
          <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Et eveniet assumenda aliquam! Voluptates ipsa ratione, maiores facere accusamus nostrum debitis odit fugit, libero molestias consequuntur dolores doloribus velit, odio commodi.</p>
        </div>
      </div>
    </section>

    <section class="services" id="services">
      <div class="heading">
        <span>Best Services</span>
        <h1>Explore Our Top Deals <br> From Top Rated Dealers</h1>
      </div>
      <div class="services-container">
        <div class="box">
          <div class="box-img">
            <img src="{{ asset('images/car1.jpg') }}" alt="Car 1">
          </div>
          <p>2017</p>
          <h3>Car 1</h3>
          <h2>K1000 <span>/.day</span></h2>
          <a href="<?= url('payment/201/1000')?>" class="btn rent-btn">Rent Now</a>
        </div>
        <div class="box">
          <div class="box-img">
            <img src="{{ asset('images/car2.jpg') }}" alt="Car 2">
          </div>
          <p>2017</p>
          <h3>Car 2</h3>
          <h2>K1000 <span>/.day</span></h2>
          <a href="<?= url('payment/202/1000')?>" class="btn rent-btn">Rent Now</a>
        </div>
        <div class="box">
          <div class="box-img">
            <img src="{{ asset('images/car3.jpg') }}" alt="Car 3">
          </div>
          <p>2017</p>
          <h3>Car 3</h3>
          <h2>K1000 <span>/.day</span></h2>
          <a href="<?= url('payment/203/1000')?>" class="btn rent-btn">Rent Now</a>
        </div>
        <div class="box">
          <div class="box-img">
            <img src="{{ asset('images/car4.jpg') }}" alt="Car 4">
          </div>
          <p>2017</p>
          <h3>Car 4</h3>
          <h2>K1000 <span>/.day</span></h2>
          <a href="<?= url('payment/204/1000')?>" class="btn rent-btn">Rent Now</a>
        </div>
        <div class="box">
          <div class="box-img">
            <img src="{{ asset('images/car5.jpg') }}" alt="Car 5">
          </div>
          <p>2017</p>
          <h3>Car 5</h3>
          <h2>K1000 <span>/.day</span></h2>
          <a href="?= url('payment/205/1000')?>" class="btn rent-btn">Rent Now</a>
        </div>
        <div class="box">
          <div class="box-img">
            <img src="{{ asset('images/car6.jpg') }}" alt="Car 6">
          </div>
          <p>2017</p>
          <h3>Car 6</h3>
          <h2>K1000 <span>/.day</span></h2>
          <a href="<?= url('payment/206/1000')?>" class="btn rent-btn">Rent Now</a>
        </div>
      </div>
    </section>

    <section class="about" id="about">
      <div class="heading">
        <span>About Us</span>
        <h1>Best Customer Experience</h1>
      </div>
      <div class="about-container">
        <div class="about-img">
          <!-- Use an image that represents your company -->
          <!--
          <img src="{{ asset('images/about.jpg') }}" alt="About Us">
          -->
        </div>
        <div class="about-text">
          <span>About Us</span>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi, pariatur omnis voluptatibus delectus hic harum provident sunt odit error sit fuga impedit, eum minus fugiat, quaerat mollitia labore deserunt maiores.</p>
          <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Amet odit dolores quisquam recusandae possimus odio labore ut vero magni consequuntur ducimus saepe asperiores consectetur sed libero, quos exercitationem similique perspiciatis!</p>
          <a href="#" class="btn">Learn More</a>
        </div>
      </div>
    </section>

    <section class="reviews" id="reviews">
      <div class="heading">
        <span>Reviews</span>
        <h1>What Our Customers Say</h1>
      </div>
      <div class="reviews-container">
        <div class="box">
          <div class="rev-img">
            <img src="{{asset('images/user.svg')}}" alt="Review 1" width="70" height="70">
          </div>
          <h2>Someone Name</h2>
          <div class="stars">
            <i class="bx bxs-star"></i>
            <i class="bx bxs-star"></i>
            <i class="bx bxs-star"></i>
            <i class="bx bxs-star"></i>
            <i class="bx bxs-star-half"></i>
          </div>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur eos rerum molestiae fugiat. Eius accusantium ad architecto aliquid.</p>
        </div>
        <div class="box">
          <div class="rev-img">
            <img src="{{asset('images/user.svg')}}" alt="Review 2" width="70" height="70">
          </div>
          <h2>Someone Name</h2>
          <div class="stars">
            <i class="bx bxs-star"></i>
            <i class="bx bxs-star"></i>
            <i class="bx bxs-star"></i>
            <i class="bx bxs-star"></i>
            <i class="bx bxs-star-half"></i>
          </div>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat fuga itaque consectetur tempore labore perspiciatis perferendis eligendi incidunt!</p>
        </div>
        <div class="box">
          <div class="rev-img">
            <img src="{{asset('images/user.svg')}}" alt="Review 3" width="70" height="70">
          </div>
          <h2>Someone Name</h2>
          <div class="stars">
            <i class="bx bxs-star"></i>
            <i class="bx bxs-star"></i>
            <i class="bx bxs-star"></i>
            <i class="bx bxs-star"></i>
            <i class="bx bxs-star-half"></i>
          </div>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam quis architecto suscipit. Debitis repudiandae facilis illum in est!</p>
        </div>
      </div>
    </section>

    <section class="newsletter">
      <h2>Subscribe To Newsletter</h2>
      <div class="box">
        <input type="text" placeholder="Enter Your Email...">
        <a href="#" class="btn">Subscribe</a>
      </div>
    </section>

    <div class="copyright">
      <p>&#169; 2025 TAGA Car Rentals All Right Reserved</p>
      <div class="social">
        <a href="#"><i class="bx bxl-facebook"></i></a>
        <a href="#"><i class="bx bxl-twitter"></i></a>
        <a href="#"><i class="bx bxl-instagram"></i></a>
      </div>
    </div>

    <script>
      const rentButtons = document.querySelectorAll('.rent-btn');
      rentButtons.forEach(btn => {
        btn.addEventListener('click', function(e) {
          const user = localStorage.getItem("user");
          if (!user) {
            e.preventDefault();
            alert("Please sign in to rent a car.");
            // Redirect to sign-in page
            window.location.href = "<?php echo url('/login'); ?>";
          }
        });
      });
    </script>
    <script src="{{ asset('js/main.js') }}"></script>
  </body>
</html>