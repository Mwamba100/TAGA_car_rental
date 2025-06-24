
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TAGA Car Rental - Admin Panel</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
            line-height: 1.6;
        }
        .container { display: flex; min-height: 100vh; }
        .sidebar {
            width: 250px; background: #2c3e50; color: white; padding: 20px 0;
            position: fixed; height: 100vh; overflow-y: auto;
        }
        .sidebar h2 { text-align: center; margin-bottom: 30px; color: #e74c3c; }
        .nav-menu { list-style: none; }
        .nav-menu li { margin-bottom: 5px; }
        .nav-menu a {
            display: block; padding: 15px 20px; color: white; text-decoration: none;
            transition: background 0.3s;
        }
        .nav-menu a:hover, .nav-menu a.active {
            background: #34495e; border-left: 4px solid #e74c3c;
        }
        .main-content {
            margin-left: 250px; padding: 20px; width: calc(100% - 250px);
        }
        .header {
            background: white; padding: 20px; border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1); margin-bottom: 20px;
            display: flex; justify-content: space-between; align-items: center;
        }
        .logout-btn {
            background: #e74c3c; color: white; border: none; padding: 10px 20px;
            border-radius: 5px; cursor: pointer;
        }
        .stats-grid {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px; margin-bottom: 30px;
        }
        .stat-card {
            background: white; padding: 20px; border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1); text-align: center;
        }
        .stat-card h3 { color: #2c3e50; margin-bottom: 10px; }
        .stat-number { font-size: 2.5rem; font-weight: bold; color: #e74c3c; }
        .data-table {
            background: white; border-radius: 10px; overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1); margin-bottom: 20px;
        }
        .table-header {
            background: #2c3e50; color: white; padding: 15px 20px;
            display: flex; align-items: center; justify-content: space-between;
        }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #f8f9fa; font-weight: 600; }
        .form-container {
            background: white; padding: 20px; border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1); margin-bottom: 20px;
        }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: 500; }
        .form-group input, .form-group select, .form-group textarea {
            width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px;
        }
        .form-group textarea { height: 100px; resize: vertical; }
        .btn {
            background: #e74c3c; color: white; padding: 10px 20px; border: none;
            border-radius: 5px; cursor: pointer; font-size: 14px; margin-right: 10px;
        }
        .btn:hover { background: #c0392b; }
        .btn-success { background: #27ae60; }
        .btn-success:hover { background: #219a52; }
        .btn-warning { background: #f39c12; }
        .btn-warning:hover { background: #d68910; }
        .btn-danger { background: #e74c3c; }
        .btn-danger:hover { background: #c0392b; }
        .modal {
            display: none; position: fixed; z-index: 1000; left: 0; top: 0;
            width: 100%; height: 100%; background-color: rgba(0,0,0,0.5);
        }
        .modal-content {
            background-color: white; margin: 15% auto; padding: 20px;
            border-radius: 10px; width: 80%; max-width: 500px;
        }
        .close { color: #aaa; float: right; font-size: 28px; font-weight: bold; cursor: pointer; }
        .close:hover { color: black; }
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); transition: transform 0.3s; }
            .sidebar.active { transform: translateX(0); }
            .main-content { margin-left: 0; width: 100%; }
            .stats-grid { grid-template-columns: 1fr; }
        }
        .hidden { display: none; }
        .status-badge { padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold; text-transform: uppercase; }
        .status-active { background: #d4edda; color: #155724; }
        .status-completed { background: #cce5ff; color: #004085; }
        .status-cancelled { background: #f8d7da; color: #721c24; }
        .status-pending { background: #fff3cd; color: #856404; }
        .car-image { width: 60px; height: 40px; object-fit: cover; border-radius: 4px; }
    </style>
</head>
<body>
    <!-- Login Modal -->
    <div id="loginModal" class="modal" style="display: block;">
        <div class="modal-content">
            <h2>Admin Login</h2>
            <form id="loginForm">
                <div class="form-group">
                    <label>Username:</label>
                    <input type="text" id="loginUsername" required>
                </div>
                <div class="form-group">
                    <label>Password:</label>
                    <input type="password" id="loginPassword" required>
                </div>
                <button type="submit" class="btn">Login</button>
            </form>
        </div>
    </div>

    <div class="container" id="adminPanel" style="display: none;">
        <!-- Sidebar -->
        <div class="sidebar">
            <h2>TAGA Admin</h2>
            <ul class="nav-menu">
                <li><a href="#" class="nav-link active" data-section="dashboard">Dashboard</a></li>
                <li><a href="#" class="nav-link" data-section="cars">Cars</a></li>
                <li><a href="#" class="nav-link" data-section="bookings">Bookings</a></li>
                <li><a href="#" class="nav-link" data-section="users">Users</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="header">
                <h1 id="pageTitle">Dashboard</h1>
                <div>
                    <span id="adminName">Admin</span>
                    <button class="logout-btn" onclick="logout()">Logout</button>
                </div>
            </div>

            <!-- Dashboard Section -->
            <div id="dashboard" class="section">
                <div class="stats-grid">
                    <div class="stat-card">
                        <h3>Total Users</h3>
                        <div class="stat-number" id="totalUsers">0</div>
                    </div>
                    <div class="stat-card">
                        <h3>Total Cars</h3>
                        <div class="stat-number" id="totalCars">0</div>
                    </div>
                    <div class="stat-card">
                        <h3>Active Bookings</h3>
                        <div class="stat-number" id="activeBookings">0</div>
                    </div>
                    <div class="stat-card">
                        <h3>Total Revenue</h3>
                        <div class="stat-number" id="totalRevenue">K0</div>
                    </div>
                </div>
                <div class="data-table">
                    <div class="table-header">
                        <h3>Recent Bookings</h3>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Car</th>
                                <th>Dates</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="recentBookings"></tbody>
                    </table>
                </div>
            </div>

            <!-- Cars Section -->
            <div id="cars" class="section hidden">
                <div class="form-container">
                    <h3 id="carFormTitle">Add New Car</h3>
                    <form id="carForm" enctype="multipart/form-data">
                        <input type="hidden" id="carId">
                        <div class="form-group">
                            <label>Car Name:</label>
                            <input type="text" id="carName" required>
                        </div>
                        <div class="form-group">
                            <label>Year:</label>
                            <input type="number" id="carYear" required min="2000" max="2025">
                        </div>
                        <div class="form-group">
                            <label>Price per Day (K):</label>
                            <input type="number" id="carPrice" required min="1">
                        </div>
                        <div class="form-group">
                            <label>Category:</label>
                            <select id="carCategory" required>
                                <option value="economy">Economy</option>
                                <option value="compact">Compact</option>
                                <option value="midsize">Midsize</option>
                                <option value="fullsize">Full Size</option>
                                <option value="luxury">Luxury</option>
                                <option value="suv">SUV</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Image:</label>
                            <input type="file" id="carImage" accept="image/*">
                        </div>
                        <div class="form-group">
                            <label>Description:</label>
                            <textarea id="carDescription"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Features (comma separated):</label>
                            <input type="text" id="carFeatures" placeholder="Air Conditioning, GPS, Bluetooth">
                        </div>
                        <div class="form-group">
                            <label>
                                <input type="checkbox" id="carAvailability" checked>
                                Available for rent
                            </label>
                        </div>
                        <button type="submit" class="btn" id="carSubmitBtn">Add Car</button>
                        <button type="button" class="btn btn-warning" onclick="resetCarForm()">Reset</button>
                    </form>
                </div>
                <div class="data-table">
                    <div class="table-header">
                        <h3>All Cars</h3>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Year</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Available</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="carsTable"></tbody>
                    </table>
                </div>
            </div>

            <!-- Bookings Section -->
            <div id="bookings" class="section hidden">
                <div class="data-table">
                    <div class="table-header">
                        <h3>All Bookings</h3>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Car</th>
                                <th>Pickup Date</th>
                                <th>Return Date</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="bookingsTable"></tbody>
                    </table>
                </div>
            </div>

            <!-- Users Section -->
            <div id="users" class="section hidden">
                <div class="data-table">
                    <div class="table-header">
                        <h3>All Users</h3>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="usersTable"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for interactivity -->
    <script>
        // Login Logic (for demo purposes only)
        document.getElementById("loginForm").addEventListener("submit", function (e) {
            e.preventDefault();
            const username = document.getElementById("loginUsername").value;
            const password = document.getElementById("loginPassword").value;
            if (username === "admin" && password === "admin123") {
                document.getElementById("loginModal").style.display = "none";
                document.getElementById("adminPanel").style.display = "flex";
                document.getElementById("adminName").innerText = username;
            } else {
                alert("Invalid credentials!");
            }
        });

        // Logout
        function logout() {
            document.getElementById("adminPanel").style.display = "none";
            document.getElementById("loginModal").style.display = "block";
            document.getElementById("loginForm").reset();
        }

        // Navigation
        const links = document.querySelectorAll(".nav-link");
        const sections = document.querySelectorAll(".section");
        links.forEach(link => {
            link.addEventListener("click", function (e) {
                e.preventDefault();
                links.forEach(l => l.classList.remove("active"));
                this.classList.add("active");
                const section = this.getAttribute("data-section");
                document.getElementById("pageTitle").innerText = this.innerText;
                sections.forEach(s => s.classList.add("hidden"));
                document.getElementById(section).classList.remove("hidden");
            });
        });

        // Reset Car Form
        function resetCarForm() {
            document.getElementById("carForm").reset();
            document.getElementById("carId").value = "";
            document.getElementById("carFormTitle").innerText = "Add New Car";
            document.getElementById("carSubmitBtn").innerText = "Add Car";
        }
    </script>
</body>
</html>
