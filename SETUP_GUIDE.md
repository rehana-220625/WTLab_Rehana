# Cafe Website - Backend & MongoDB Setup Guide

## ✅ What's Been Set Up

Your cafe website is now **fully connected** to:
- ✓ **Express.js Backend Server** (Node.js)
- ✓ **MongoDB Database** (Local installation)
- ✓ **Frontend Website** with async API calls

---

## 🚀 How to Run the Entire Stack

### Step 1: Start MongoDB
MongoDB must be running first. Open a **new PowerShell terminal** and run:

```powershell
# Windows - MongoDB should be in your system PATH
mongod
```

**Output should show:**
```
waiting for connections on port 27017
```

Keep this terminal open while using the app.

---

### Step 2: Start the Backend Server
Open a **second PowerShell terminal** and run:

```powershell
cd c:\Users\acer\Desktop\cafewebsite\backend
npm start
```

If npm start doesn't work, run:
```powershell
node index.js
```

**Expected output:**
```
✓ MongoDB Connected Successfully!
⭐ Backend server running on http://localhost:5000
```

Keep this terminal open.

---

### Step 3: Open the Website
In your browser, open the website file:
```
c:\Users\acer\Desktop\cafewebsite\Task03_cfweb\index.html
```

The website will automatically connect to the backend and MongoDB!

---

## 📊 How the Connection Works

### Frontend → Backend → MongoDB Flow:

1. **Website loads** (`index.html`)
2. **Runs `script.js`** which:
   - Fetches data from backend API at `http://localhost:5000/api`
   - Loads orders and ratings from MongoDB
   - Updates the display automatically

3. **When you click buttons:**
   - "Process Order" → Posts to `/api/orders` → Saves to MongoDB
   - "Update Rating" → Posts to `/api/rating` → Saves to MongoDB
   - Backend stores everything in the `cafewebsite` database

---

## 🔌 Backend API Endpoints

| Method | Endpoint | Purpose |
|--------|----------|---------|
| GET | `/api/health` | Health check |
| GET | `/api/cafe-info` | Get cafe information |
| GET | `/api/orders` | Fetch all orders from MongoDB |
| POST | `/api/orders` | Create new order in MongoDB |
| GET | `/api/rating` | Get latest rating from MongoDB |
| POST | `/api/rating` | Update rating in MongoDB |

---

## 📂 Database Structure

### MongoDB Database: `cafewebsite`

**Orders Collection:**
```javascript
{
  _id: ObjectId,
  item: "Coffee",
  quantity: 1,
  price: 4.50,
  timestamp: Date
}
```

**Ratings Collection:**
```javascript
{
  _id: ObjectId,
  rating: 4.8,
  timestamp: Date
}
```

---

## ⚙️ Configuration

**Backend Configuration** (`backend/index.js`):
- MongoDB Connection: `mongodb://127.0.0.1:27017/cafewebsite`
- Server Port: `5000`
- CORS: Enabled for all origins

**Frontend Configuration** (`Task03_cfweb/script.js`):
- API URL: `http://localhost:5000/api`
- Auto-loads data on page load
- Fallback to local values if backend unavailable

---

## 🐛 Troubleshooting

### "Cannot GET /api/orders"
- MongoDB server not running
- Solution: Start `mongod` in a terminal

### "Backend not available, using default values"
- Backend server not started
- Solution:
  1. Navigate to `backend` folder
  2. Run `node index.js`

### SyntaxError in Terminal
- Node.js or npm not installed
- Solution: Install from nodejs.org

### MongoDB not found
- MongoDB not installed
- Solution: Download from mongodb.com or use MongoDB Compass

---

## 📝 Next Steps

1. **Start MongoDB**: `mongod`
2. **Start Backend**: `node backend/index.js`
3. **Open Website**: `Task03_cfweb/index.html`
4. **Test It**: Click buttons to see data save to MongoDB

---

## ✨ Features Connected

✓ **View cafe info** from backend
✓ **Process orders** → Saved to MongoDB
✓ **Update ratings** → Saved to MongoDB
✓ **View order count** → From MongoDB
✓ **Dynamic reload** → Pulls latest data

Enjoy! ☕
