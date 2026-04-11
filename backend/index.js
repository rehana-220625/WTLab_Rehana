const express = require('express');
const mongoose = require('mongoose');
const cors = require('cors');
const app = express();

// Middleware
app.use(cors());
app.use(express.json());

// MongoDB Connection Configuration
const mongoURI = process.env.MONGODB_URI || 'mongodb://127.0.0.1:27017/cafewebsite';

// Connect to MongoDB with error handling
mongoose.connect(mongoURI, { 
    useNewUrlParser: true, 
    useUnifiedTopology: true,
    serverSelectionTimeoutMS: 5000 
})
.then(() => {
    console.log('✓ MongoDB Connected Successfully!');
    console.log('Connection URI:', mongoURI);
})
.catch(err => {
    console.log('⚠ MongoDB Connection Error:', err.message);
    console.log('Make sure MongoDB is running on your system');
    console.log('Command to start MongoDB: mongod');
});

// Order Schema
const orderSchema = new mongoose.Schema({
  item: String,
  quantity: Number,
  price: Number,
  timestamp: { type: Date, default: Date.now }
});

const Order = mongoose.model('Order', orderSchema);

// Rating Schema
const ratingSchema = new mongoose.Schema({
  rating: Number,
  timestamp: { type: Date, default: Date.now }
});

const Rating = mongoose.model('Rating', ratingSchema);

// ============================================
// API ROUTES
// ============================================

// GET - Health Check
app.get('/api/health', (req, res) => {
  res.json({ 
    status: 'Backend is running!',
    mongodb: mongoose.connection.readyState === 1 ? 'Connected' : 'Disconnected'
  });
});

// GET - Cafe Info
app.get('/api/cafe-info', (req, res) => {
  res.json({
    name: "Brew Haven Cafe",
    location: "123 Coffee Street",
    openingHour: "6:00 AM",
    closingHour: "10:00 PM",
    isOpen: true
  });
});

// GET - All Orders
app.get('/api/orders', async (req, res) => {
  try {
    const orders = await Order.find();
    const totalOrders = orders.length;
    res.json({ 
      totalOrders, 
      orders,
      source: 'MongoDB'
    });
  } catch (err) {
    console.error('Error fetching orders:', err);
    res.status(500).json({ error: err.message });
  }
});

// POST - Create New Order
app.post('/api/orders', async (req, res) => {
  try {
    const { item, quantity, price } = req.body;
    
    if (!item || !quantity || !price) {
      return res.status(400).json({ 
        error: 'Missing required fields: item, quantity, price' 
      });
    }

    const order = new Order({ item, quantity, price });
    await order.save();
    
    const totalOrders = await Order.countDocuments();
    
    res.json({ 
      success: true, 
      order, 
      totalOrders,
      message: `Order #${totalOrders} processed!`,
      source: 'MongoDB'
    });
  } catch (err) {
    console.error('Error creating order:', err);
    res.status(500).json({ error: err.message });
  }
});

// GET - Latest Rating
app.get('/api/rating', async (req, res) => {
  try {
    const latestRating = await Rating.findOne().sort({ timestamp: -1 });
    res.json({ 
      rating: latestRating ? latestRating.rating : 4.8,
      source: 'MongoDB'
    });
  } catch (err) {
    console.error('Error fetching rating:', err);
    res.status(500).json({ error: err.message });
  }
});

// POST - Update Rating
app.post('/api/rating', async (req, res) => {
  try {
    const { rating } = req.body;
    
    if (!rating || rating < 1 || rating > 5) {
      return res.status(400).json({ 
        error: 'Rating must be between 1 and 5' 
      });
    }

    const newRating = new Rating({ rating });
    await newRating.save();
    
    res.json({ 
      success: true, 
      rating: newRating.rating,
      source: 'MongoDB'
    });
  } catch (err) {
    console.error('Error updating rating:', err);
    res.status(500).json({ error: err.message });
  }
});

// ============================================
// ERROR HANDLING
// ============================================

// 404 Handler
app.use((req, res) => {
  res.status(404).json({ 
    error: 'Route not found',
    availableRoutes: [
      'GET /api/health',
      'GET /api/cafe-info',
      'GET /api/orders',
      'POST /api/orders',
      'GET /api/rating',
      'POST /api/rating'
    ]
  });
});

// Start server
const PORT = process.env.PORT || 5000;
app.listen(PORT, () => {
  console.log(`\n⭐ Backend server running on http://localhost:${PORT}`);
  console.log(`Frontend should connect to: ${mongoURI}`);
  console.log('Press Ctrl+C to stop the server\n');
});

// Handle server shutdown gracefully
process.on('SIGINT', async () => {
  console.log('\n⏹ Shutting down server...');
  await mongoose.connection.close();
  process.exit(0);
});
