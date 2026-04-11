# Task07 - Cafe Website with MongoDB Authentication

## 🎉 Setup Complete!

Your MongoDB-integrated authentication system is fully set up and ready to use.

## ✅ What's Been Installed

1. **Folder Structure** - Created at `C:\xampp\htdocs\Task07_cf_web_mongodb\`
2. **MongoDB PHP Library** - Installed via Composer
3. **All Authentication Files** - Login, Signup, Dashboard, Logout
4. **Database Configuration** - Connected to MongoDB at `mongodb://localhost:27017`

## 📁 Project Structure

```
Task07_cf_web_mongodb/
├── config/
│   └── db.php              # MongoDB connection & database setup
├── index.html              # Login & Signup UI page
├── signup.php              # User registration logic
├── login.php               # User authentication logic
├── dashboard.php           # Protected user dashboard
├── logout.php              # Session logout handler
├── test_mongo.php          # MongoDB connection tester
├── composer.json           # PHP dependencies
├── composer.lock           # Dependency lock file
└── vendor/                 # MongoDB PHP library (auto-installed)
```

## 🚀 How to Run

### Step 1: Ensure MongoDB is Running
```powershell
mongod
```

### Step 2: Start Apache in XAMPP
- Open XAMPP Control Panel
- Click **Start** next to Apache

### Step 3: Open in Browser
```
http://localhost/Task07_cf_web_mongodb/
```

## 📋 Features

✅ **User Signup**
- Enter email and password
- Password is hashed with bcrypt
- User data stored in MongoDB

✅ **User Login**
- Email and password verification
- Session management
- Secure session handling

✅ **Protected Dashboard**
- Only accessible when logged in
- Displays welcome message with user email
- Logout button

✅ **Database**
- Database: `i_mongoDB`
- Collection: `users` (auto-created on first signup)
- Fields: email, password (hashed), createdAt timestamp

## 🧪 Test MongoDB Connection

Run this in terminal to verify MongoDB is working:
```powershell
C:\xampp\php\php.exe test_mongo.php
```

Expected output:
```
✅ MongoDB connected successfully!
Available Databases:
- admin
- config
- local
- i_mongoDB (appears after first signup)

Collections in i_mongoDB:
- users
```

## 🔐 Security Notes

- **Passwords are hashed** using PHP's `password_hash()` with BCRYPT
- **Sessions are used** for secure authentication
- **No plaintext passwords** stored in MongoDB
- **Email uniqueness** checked before signup

## 💾 MongoDB Data Example

After signing up with `test@example.com` and password `password123`, the MongoDB document looks like:

```javascript
{
  "_id": ObjectId("..."),
  "email": "test@example.com",
  "password": "$2y$10$...", // bcrypt hash
  "createdAt": ISODate("2026-04-11T...")
}
```

## 📖 Next Steps

You can enhance this project by adding:
- Email verification
- Password reset functionality
- User profile updates
- Remember me functionality
- Two-factor authentication
- Social login (Google, GitHub OAuth)

## ⚠️ Troubleshooting

**Error: "MongoDB connected successfully but no collections appear"**
- This is normal! Collections are created when you first signup.

**Error: "User not found"**
- Make sure you signed up first before trying to login.

**Error: Failed opening '/vendor/autoload.php'**
- Run `composer install` in the Task07_cf_web_mongodb folder.

---

**Status**: ✅ READY TO USE

Start creating amazing cafe management features! 🎉
