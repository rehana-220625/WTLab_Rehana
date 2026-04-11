# ✅ Cafe Website - Fixed & Connected

## 🎯 What Was Done

### ✓ Error Fixes
- **Fixed corrupted `script.js`** - Removed duplicate functions and broken syntax
- **Cleaned up async functions** - Properly structured MongoDB API calls
- **Fixed function declarations** - Removed `updateRating()` duplicate declarations
- **Proper error handling** - Added try-catch blocks with fallbacks

### ✓ MongoDB Integration
- **Connected frontend to backend** via REST API
- **Configured Express.js server** with MongoDB support
- **Created database schemas** for Orders and Ratings
- **Added proper error logging** for debugging

### ✓ Configuration Files
- **backend/index.js** - Express server with MongoDB connection
- **backend/package.json** - Updated with npm start script
- **Task03_cfweb/script.js** - Async functions for API calls

---

## 🚀 Quick Start (3 Simple Steps)

### Option A: Automatic Start (Recommended)
```powershell
# Double-click this file:
START_ALL.bat
```

This will automatically start both MongoDB and the backend server.

---

### Option B: Manual Start

#### Step 1️⃣: Start MongoDB
```powershell
mongod
```
Keep this terminal open. You should see:
```
waiting for connections on port 27017
```

#### Step 2️⃣: Start Backend Server
```powershell
cd backend
npm start
```
Keep this terminal open. You should see:
```
✓ MongoDB Connected Successfully!
⭐ Backend server running on http://localhost:5000
```

#### Step 3️⃣: Open Website
Open in your browser or double-click:
```
Task03_cfweb/index.html
```

---

## 📊 Database & API

### MongoDB Collections
```
Database: cafewebsite
├── orders (stores cafe orders)
└── ratings (stores cafe ratings)
```

### Backend API (Port 5000)
```
GET  /api/health         - Check if backend is running
GET  /api/cafe-info      - Get cafe information
GET  /api/orders         - Retrieve all orders
POST /api/orders         - Create new order
GET  /api/rating         - Get latest rating
POST /api/rating         - Update rating
```

---

## ✨ Features Enabled

✅ **Order Management**
- Click "Process Order" → Saved to MongoDB
- View total orders from database

✅ **Rating System**
- Click "Update Rating" → Saved to MongoDB
- Display latest rating from database

✅ **Cafe Information**
- Display from backend
- Auto-load on page load

✅ **Error Handling**
- Graceful fallback if backend unavailable
- Detailed console logging

✅ **All JavaScript Features**
- Variables (let, const)
- Functions (declaration, expression, arrow)
- Objects with methods
- Events (click, hover, input)
- Pop-ups (alert, confirm, prompt)
- Loops and conditionals

---

## 🔧 File Structure

```
cafewebsite/
├── backend/
│   ├── index.js              ← Express + MongoDB server
│   ├── package.json          ← Dependencies & npm scripts
│   └── node_modules/         ← Installed packages
├── Task03_cfweb/
│   ├── index.html            ← Main webpage
│   ├── script.js             ← FIXED - All frontend logic
│   └── style.css             ← Styling
├── START_ALL.bat             ← Auto-start script (Windows)
└── SETUP_GUIDE.md            ← Detailed setup instructions
```

---

## 🆘 Troubleshooting

| Problem | Solution |
|---------|----------|
| **"Cannot find MongoDB"** | Install MongoDB from mongodb.com |
| **"Backend not running"** | Run `npm start` in the backend folder |
| **"Using default values"** | Make sure both MongoDB and backend are running |
| **Blank website** | Clear browser cache (Ctrl+Shift+Del) and reload |
| **CORS errors** | Backend server must be running on port 5000 |

---

## 📝 Environment Variables (Optional)

You can customize by setting:
```powershell
# Set MongoDB URI (optional, default is localhost)
$env:MONGODB_URI="mongodb://127.0.0.1:27017/cafewebsite"

# Set Backend Port (optional, default is 5000)
$env:PORT=5000
```

---

## ✅ Verification Checklist

- [ ] MongoDB is installed
- [ ] Node.js is installed
- [ ] Run `npm install` in backend folder (done once)
- [ ] `mongod` is running in a terminal
- [ ] `npm start` backend is running
- [ ] Website opens in browser without errors
- [ ] Console (F12) shows "✓ Backend: ... loaded"
- [ ] Clicking "Process Order" shows success message
- [ ] Orders are saved to MongoDB and displayed

---

## 🎉 You're All Set!

Your cafe website is now:
- ✅ Connected to MongoDB
- ✅ Running Express.js backend
- ✅ Free of all syntax errors
- ✅ Ready for production!

Enjoy! ☕

---

**Last Updated:** April 10, 2026
