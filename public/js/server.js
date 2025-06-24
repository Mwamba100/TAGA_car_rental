// server.js - Main Express server
const express = require('express');
const mongoose = require('mongoose');
const cors = require('cors');
const bcrypt = require('bcryptjs');
const jwt = require('jsonwebtoken');
const multer = require('multer');
const path = require('path');
require('dotenv').config();

const app = express();
const PORT = process.env.PORT || 3000;
const JWT_SECRET = process.env.JWT_SECRET || 'your-secret-key';

// Middleware
app.use(cors());
app.use(express.json());
app.use(express.static('public'));
app.use('/uploads', express.static('uploads'));

// MongoDB connection

const { MongoClient, ServerApiVersion } = require('mongodb');
const uri = "mongodb+srv://koder:<db_password>@cluster0.w4xwl.mongodb.net/?retryWrites=true&w=majority&appName=Cluster0";

// Create a MongoClient with a MongoClientOptions object to set the Stable API version
const client = new MongoClient(uri, {
  serverApi: {
    version: ServerApiVersion.v1,
    strict: true,
    deprecationErrors: true,
  }
});

async function run() {
  try {
    // Connect the client to the server	(optional starting in v4.7)
    await client.connect();
    // Send a ping to confirm a successful connection
    await client.db("admin").command({ ping: 1 });
    console.log("Pinged your deployment. You successfully connected to MongoDB!");
  } finally {
    // Ensures that the client will close when you finish/error
    await client.close();
  }
}
run().catch(console.dir);


mongoose.connect(process.env.MONGODB_URI || 'mongodb+srv://username:password@cluster0.mongodb.net/car_rental', {
  useNewUrlParser: true,
  useUnifiedTopology: true,
});

// User Schema
const userSchema = new mongoose.Schema({
  username: { type: String, required: true, unique: true },
  email: { type: String, required: true, unique: true },
  password: { type: String, required: true },
  role: { type: String, enum: ['user', 'admin'], default: 'user' },
  createdAt: { type: Date, default: Date.now }
});

// Car Schema
const carSchema = new mongoose.Schema({
  name: { type: String, required: true },
  year: { type: Number, required: true },
  price: { type: Number, required: true },
  image: { type: String, required: true },
  description: { type: String },
  availability: { type: Boolean, default: true },
  category: { type: String, enum: ['economy', 'compact', 'midsize', 'fullsize', 'luxury', 'suv'], default: 'economy' },
  features: [String],
  createdAt: { type: Date, default: Date.now }
});

// Booking Schema
const bookingSchema = new mongoose.Schema({
  userId: { type: mongoose.Schema.Types.ObjectId, ref: 'User', required: true },
  carId: { type: mongoose.Schema.Types.ObjectId, ref: 'Car', required: true },
  pickupDate: { type: Date, required: true },
  returnDate: { type: Date, required: true },
  totalPrice: { type: Number, required: true },
  paymentMethod: { type: String, enum: ['card', 'mobile', 'cash'], required: true },
  paymentStatus: { type: String, enum: ['pending', 'completed', 'failed'], default: 'pending' },
  bookingStatus: { type: String, enum: ['active', 'completed', 'cancelled'], default: 'active' },
  location: { type: String, required: true },
  createdAt: { type: Date, default: Date.now }
});

// Models
const User = mongoose.model('User', userSchema);
const Car = mongoose.model('Car', carSchema);
const Booking = mongoose.model('Booking', bookingSchema);

// File upload configuration
const storage = multer.diskStorage({
  destination: (req, file, cb) => {
    cb(null, 'uploads/');
  },
  filename: (req, file, cb) => {
    cb(null, Date.now() + path.extname(file.originalname));
  }
});

const upload = multer({ 
  storage: storage,
  limits: { fileSize: 5 * 1024 * 1024 }, // 5MB limit
  fileFilter: (req, file, cb) => {
    const allowedTypes = /jpeg|jpg|png|gif/;
    const extname = allowedTypes.test(path.extname(file.originalname).toLowerCase());
    const mimetype = allowedTypes.test(file.mimetype);
    
    if (mimetype && extname) {
      return cb(null, true);
    } else {
      cb(new Error('Only image files are allowed!'));
    }
  }
});

// Auth middleware
const authenticateToken = (req, res, next) => {
  const authHeader = req.headers['authorization'];
  const token = authHeader && authHeader.split(' ')[1];

  if (!token) {
    return res.status(401).json({ error: 'Access token required' });
  }

  jwt.verify(token, JWT_SECRET, (err, user) => {
    if (err) {
      return res.status(403).json({ error: 'Invalid token' });
    }
    req.user = user;
    next();
  });
};

// Admin middleware
const requireAdmin = (req, res, next) => {
  if (req.user.role !== 'admin') {
    return res.status(403).json({ error: 'Admin access required' });
  }
  next();
};

// ======================
// AUTH ROUTES
// ======================

// Register
app.post('/api/auth/register', async (req, res) => {
  try {
    const { username, email, password, role = 'user' } = req.body;

    // Check if user already exists
    const existingUser = await User.findOne({
      $or: [{ email }, { username }]
    });

    if (existingUser) {
      return res.status(400).json({ error: 'User already exists' });
    }

    // Hash password
    const hashedPassword = await bcrypt.hash(password, 10);

    // Create new user
    const user = new User({
      username,
      email,
      password: hashedPassword,
      role
    });

    await user.save();

    // Generate token
    const token = jwt.sign(
      { userId: user._id, username: user.username, role: user.role },
      JWT_SECRET,
      { expiresIn: '24h' }
    );

    res.status(201).json({
      message: 'User registered successfully',
      token,
      user: {
        id: user._id,
        username: user.username,
        email: user.email,
        role: user.role
      }
    });
  } catch (error) {
    res.status(500).json({ error: error.message });
  }
});

// Login
app.post('/api/auth/login', async (req, res) => {
  try {
    const { username, password } = req.body;

    // Find user
    const user = await User.findOne({ username });
    if (!user) {
      return res.status(400).json({ error: 'Invalid Username' });
    }

    // Check password
    const isValidPassword = await bcrypt.compare(password, user.password);
    if (!isValidPassword) {
      return res.status(400).json({ error: 'Invalid credentials' });
    }

    // Generate token
    const token = jwt.sign(
      { userId: user._id, username: user.username, role: user.role },
      JWT_SECRET,
      { expiresIn: '24h' }
    );

    res.json({
      message: 'Login successful',
      token,
      user: {
        id: user._id,
        username: user.username,
        email: user.email,
        role: user.role
      }
    });
  } catch (error) {
    res.status(500).json({ error: error.message });
  }
});

// ======================
// CAR ROUTES
// ======================

// Get all cars
app.get('/api/cars', async (req, res) => {
  try {
    const { category, available, search } = req.query;
    let filter = {};

    if (category) filter.category = category;
    if (available !== undefined) filter.availability = available === 'true';
    if (search) {
      filter.$or = [
        { name: { $regex: search, $options: 'i' } },
        { description: { $regex: search, $options: 'i' } }
      ];
    }

    const cars = await Car.find(filter).sort({ createdAt: -1 });
    res.json(cars);
  } catch (error) {
    res.status(500).json({ error: error.message });
  }
});

// Get single car
app.get('/api/cars/:id', async (req, res) => {
  try {
    const car = await Car.findById(req.params.id);
    if (!car) {
      return res.status(404).json({ error: 'Car not found' });
    }
    res.json(car);
  } catch (error) {
    res.status(500).json({ error: error.message });
  }
});

// Create car (Admin only)
app.post('/api/cars', authenticateToken, requireAdmin, upload.single('image'), async (req, res) => {
  try {
    const { name, year, price, description, category, features } = req.body;
    
    const car = new Car({
      name,
      year: parseInt(year),
      price: parseFloat(price),
      description,
      category,
      features: features ? features.split(',').map(f => f.trim()) : [],
      image: req.file ? `/uploads/${req.file.filename}` : ''
    });

    await car.save();
    res.status(201).json({ message: 'Car created successfully', car });
  } catch (error) {
    res.status(500).json({ error: error.message });
  }
});

// Update car (Admin only)
app.put('/api/cars/:id', authenticateToken, requireAdmin, upload.single('image'), async (req, res) => {
  try {
    const { name, year, price, description, category, features, availability } = req.body;
    
    const updateData = {
      name,
      year: parseInt(year),
      price: parseFloat(price),
      description,
      category,
      features: features ? features.split(',').map(f => f.trim()) : [],
      availability: availability === 'true'
    };

    if (req.file) {
      updateData.image = `/uploads/${req.file.filename}`;
    }

    const car = await Car.findByIdAndUpdate(req.params.id, updateData, { new: true });
    if (!car) {
      return res.status(404).json({ error: 'Car not found' });
    }

    res.json({ message: 'Car updated successfully', car });
  } catch (error) {
    res.status(500).json({ error: error.message });
  }
});

// Delete car (Admin only)
app.delete('/api/cars/:id', authenticateToken, requireAdmin, async (req, res) => {
  try {
    const car = await Car.findByIdAndDelete(req.params.id);
    if (!car) {
      return res.status(404).json({ error: 'Car not found' });
    }
    res.json({ message: 'Car deleted successfully' });
  } catch (error) {
    res.status(500).json({ error: error.message });
  }
});

// ======================
// BOOKING ROUTES
// ======================

// Create booking
app.post('/api/bookings', authenticateToken, async (req, res) => {
  try {
    const { carId, pickupDate, returnDate, location, paymentMethod } = req.body;
    
    // Check if car exists and is available
    const car = await Car.findById(carId);
    if (!car) {
      return res.status(404).json({ error: 'Car not found' });
    }
    
    if (!car.availability) {
      return res.status(400).json({ error: 'Car is not available' });
    }

    // Calculate total price
    const pickup = new Date(pickupDate);
    const returnD = new Date(returnDate);
    const days = Math.ceil((returnD - pickup) / (1000 * 60 * 60 * 24)) + 1;
    const totalPrice = days * car.price;

    // Create booking
    const booking = new Booking({
      userId: req.user.userId,
      carId,
      pickupDate: pickup,
      returnDate: returnD,
      totalPrice,
      paymentMethod,
      location
    });

    await booking.save();
    
    // Update car availability (optional - you might want to implement a more sophisticated system)
    await Car.findByIdAndUpdate(carId, { availability: false });

    res.status(201).json({ message: 'Booking created successfully', booking });
  } catch (error) {
    res.status(500).json({ error: error.message });
  }
});

// Get user bookings
app.get('/api/bookings/user', authenticateToken, async (req, res) => {
  try {
    const bookings = await Booking.find({ userId: req.user.userId })
      .populate('carId', 'name image year')
      .sort({ createdAt: -1 });
    res.json(bookings);
  } catch (error) {
    res.status(500).json({ error: error.message });
  }
});

// Get all bookings (Admin only)
app.get('/api/bookings', authenticateToken, requireAdmin, async (req, res) => {
  try {
    const bookings = await Booking.find()
      .populate('userId', 'username email')
      .populate('carId', 'name image year')
      .sort({ createdAt: -1 });
    res.json(bookings);
  } catch (error) {
    res.status(500).json({ error: error.message });
  }
});

// Update booking status (Admin only)
app.put('/api/bookings/:id/status', authenticateToken, requireAdmin, async (req, res) => {
  try {
    const { bookingStatus, paymentStatus } = req.body;
    
    const booking = await Booking.findByIdAndUpdate(
      req.params.id,
      { bookingStatus, paymentStatus },
      { new: true }
    );

    if (!booking) {
      return res.status(404).json({ error: 'Booking not found' });
    }

    // If booking is completed or cancelled, make car available again
    if (bookingStatus === 'completed' || bookingStatus === 'cancelled') {
      await Car.findByIdAndUpdate(booking.carId, { availability: true });
    }

    res.json({ message: 'Booking updated successfully', booking });
  } catch (error) {
    res.status(500).json({ error: error.message });
  }
});

// ======================
// DASHBOARD ROUTES (Admin)
// ======================

// Get dashboard stats
app.get('/api/admin/stats', authenticateToken, requireAdmin, async (req, res) => {
  try {
    const totalUsers = await User.countDocuments({ role: 'user' });
    const totalCars = await Car.countDocuments();
    const totalBookings = await Booking.countDocuments();
    const activeBookings = await Booking.countDocuments({ bookingStatus: 'active' });
    const completedBookings = await Booking.countDocuments({ bookingStatus: 'completed' });
    
    // Revenue calculation
    const revenue = await Booking.aggregate([
      { $match: { paymentStatus: 'completed' } },
      { $group: { _id: null, total: { $sum: '$totalPrice' } } }
    ]);
    
    const totalRevenue = revenue.length > 0 ? revenue[0].total : 0;

    res.json({
      totalUsers,
      totalCars,
      totalBookings,
      activeBookings,
      completedBookings,
      totalRevenue
    });
  } catch (error) {
    res.status(500).json({ error: error.message });
  }
});

// ======================
// SERVE ADMIN PANEL
// ======================

app.get('/admin', (req, res) => {
  res.sendFile(path.join(__dirname, 'public', 'admin.html'));
});

// Error handling middleware
app.use((error, req, res, next) => {
  if (error instanceof multer.MulterError) {
    if (error.code === 'LIMIT_FILE_SIZE') {
      return res.status(400).json({ error: 'File too large' });
    }
  }
  res.status(500).json({ error: error.message });
});

// Start server
app.listen(PORT, () => {
  console.log(`Server running on port ${PORT}`);
  console.log(`Admin panel available at http://localhost:${PORT}/admin`);
});

module.exports = app;