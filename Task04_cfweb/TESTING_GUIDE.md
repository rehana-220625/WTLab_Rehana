# 🚀 PHP Lab Task - Quick Start Guide

## ✅ Project Setup Complete!

Your PHP Login & Registration project is now ready in:
```
C:\xampp\htdocs\php_cafewebsite
```

---

## 🧪 TESTING INSTRUCTIONS (Step-by-Step)

### Phase 1️⃣: Start Services

1. **Open XAMPP Control Panel**
   - Windows: Search for "XAMPP Control Panel" and open
   
2. **Start Apache Server**
   - Click the "Start" button next to "Apache"
   - Wait until it shows "Running" (green indicator)
   
3. **Start MySQL Server**
   - Click the "Start" button next to "MySQL"
   - Wait until it shows "Running" (green indicator)

**✓ Verification:** Both Apache and MySQL should now show as "Running"

---

### Phase 2️⃣: Initialize Database

1. **Open Web Browser**
   - Go to: `http://localhost/php_cafewebsite/`
   - You should see the Brew Haven Cafe homepage

2. **Click Database Setup**
   - Find the button: "🗂️ Click Here to Initialize Database"
   - Click it
   
3. **Verify Setup**
   - Should see message: "✅ Database 'userdb' created successfully"
   - Should see message: "✅ Table 'users' created successfully"

**✓ Verification:** Database is now ready!

---

### Phase 3️⃣: Test Registration

1. **Click Register Link**
   - On homepage, click: "📝 Register New Account"
   
2. **Fill Registration Form with Test Data**
   ```
   Full Name:        John Doe
   Username:         johndoe
   Email:            john@example.com
   Password:         password123
   Confirm Password: password123
   ```
   
3. **Click "Create Account"**
   
4. **Expected Result**
   - ✅ Success message: "✅ Registration successful! Welcome, John Doe!"
   - ✅ Auto-redirect to login page after 3 seconds
   
5. **Test Validation** (Try again with incorrect data)
   - Username too short: "ab" → Should show error
   - Passwords don't match → Should show error
   - Missing fields → Should show error
   - Duplicate username → Should show error

**✓ Verification:** Registration module working correctly!

---

### Phase 4️⃣: Test Login

1. **On Login Page, Enter Credentials**
   ```
   Username or Email: johndoe
   Password:          password123
   ```
   
2. **Click "Login"**
   
3. **Expected Result**
   - ✅ Success message: "✅ Login successful! Welcome, John Doe!"
   - ✅ Auto-redirect to dashboard after 2 seconds
   - ✅ Can view dashboard with learning resources
   
4. **Test Invalid Login** (Try incorrect credentials)
   - Wrong password → "❌ Username/Email or Password is incorrect!"
   - Non-existent username → "❌ Username/Email or Password is incorrect!"

**✓ Verification:** Login module working correctly!

---

### Phase 5️⃣: Explore Learning Modules

#### A) String Functions Demo
1. **From Home Page, Click:** "✂️ String Functions Demo"
2. **Verify These Functions Are Demonstrated:**
   - ✅ strlen() - String length
   - ✅ str_word_count() - Word count
   - ✅ strrev() - Reverse string
   - ✅ strtoupper() - Uppercase conversion
   - ✅ strtolower() - Lowercase conversion
   - ✅ ucfirst() - Capitalize first letter
   - ✅ ucwords() - Capitalize each word
   - ✅ strpos() - Find substring position
   - ✅ str_replace() - Replace substring
   - ✅ substr() - Extract substring
   - ✅ trim() / ltrim() / rtrim() - Whitespace removal
   - ✅ strcmp() - Case-sensitive comparison
   - ✅ strcasecmp() - Case-insensitive comparison
   - ✅ htmlspecialchars() - HTML escaping
   - ✅ addslashes() - Add escape slashes

#### B) Variables & Scope Demo
1. **From Home Page, Click:** "📚 Variables & Scope Demo"
2. **Verify These Concepts Are Demonstrated:**
   - ✅ String datatype with examples
   - ✅ Integer datatype with examples
   - ✅ Float datatype with examples
   - ✅ Boolean datatype with examples
   - ✅ Array datatype (indexed and associative)
   - ✅ Local scope (variables inside functions)
   - ✅ Global scope (using global keyword)
   - ✅ Static scope (value retention across calls)
   - ✅ Superglobal $_SERVER variable

**✓ Verification:** Learning modules working correctly!

---

### Phase 6️⃣: Verify Database

1. **Open phpMyAdmin**
   - Go to: `http://localhost/phpmyadmin`
   
2. **Navigate to Users Table**
   - Left sidebar → `userdb` → `users`
   
3. **Verify User Record Exists**
   - ✅ Username: johndoe (lowercase)
   - ✅ Email: john@example.com
   - ✅ Fullname: John Doe (properly formatted)
   - ✅ Password: Hashed (starts with $2y$ or similar - not plain text!)
   - ✅ created_at & updated_at: Timestamps recorded

**✓ Verification:** Data stored correctly in database!

---

## 📋 Test Case Summary

| Feature | Test | Expected Result | Status |
|---------|------|-----------------|--------|
| Database Setup | Click setup.php | Database/table created | ✅ |
| Registration | Valid data | Success + redirect | ✅ |
| Validation | Short username | Error message | ✅ |
| Validation | Password mismatch | Error message | ✅ |
| SQL Security | Duplicate username | Error message | ✅ |
| Login | Correct credentials | Success + redirect | ✅ |
| Login | Wrong password | Error message | ✅ |
| String Functions | Access demo page | All 15+ functions shown | ✅ |
| Variables & Scope | Access demo page | All datatypes & scopes shown | ✅ |
| Database | phpMyAdmin | User data visible & hashed | ✅ |

---

## 📊 String Functions Applied in Code

### In Registration (register.php):
- `strlen()` - Validate username and password length
- `strtolower()` - Normalize username to lowercase
- `ucwords()` - Format full name with capital letters
- `trim()` - Remove extra whitespace
- `strcmp()` - Compare password and confirm password
- `addslashes()` - Escape special characters for database
- `htmlspecialchars()` - Safely display user input

### In Login (login.php):
- `strlen()` - Validate input length
- `strtolower()` - Normalize username/email for case-insensitive matching
- `trim()` - Remove whitespace from input
- `addslashes()` - Escape for database query
- `password_verify()` - Verify hashed password (security best practice)
- `htmlspecialchars()` - Display names safely

---

## 📁 Project Structure

```
C:\xampp\htdocs\php_cafewebsite\
├── config.php                 # Database connection
├── setup.php                  # Initialize database
├── index.html                 # Main homepage
├── register.html              # Registration form
├── register.php               # Registration logic (with string functions)
├── login.html                 # Login form
├── login.php                  # Login logic (with string comparison)
├── variables_scope.php        # PHP datatypes & scope demo
├── string_functions.php       # 20+ string functions demo
├── dashboard.html             # Post-login dashboard
├── .git/                      # Git repository preserved
├── backend/                   # Original backend (MongoDB)
├── Task03_cfweb/              # Original Task03 files
└── [Other original files]
```

---

## 🔐 Security Features Implemented

✅ **Password Security:**
- Uses `password_hash()` with DEFAULT algorithm
- Uses `password_verify()` for comparison
- Passwords are never displayed or logged

✅ **Input Validation:**
- `strlen()` for length validation
- `filter_var()` for email validation
- `trim()` to remove whitespace
- `strcmp()` for string comparison
- Edge cases handled (short usernames, mismatched passwords, etc.)

✅ **SQL Safety:**
- `addslashes()` escapes special characters
- **Note:** Prepared statements recommended for production

✅ **Output Security:**
- `htmlspecialchars()` prevents XSS attacks
- User names displayed safely in forms and messages

---

## 🐛 Troubleshooting

### Problem: Can't access http://localhost/php_cafewebsite/
**Solution:**
1. Verify Apache is running (green indicator in XAMPP)
2. Check XAMPP htdocs folder exists: `C:\xampp\htdocs\`
3. Verify project folder exists: `C:\xampp\htdocs\php_cafewebsite\`

### Problem: "Connection failed" error
**Solution:**
1. Verify MySQL is running (green indicator in XAMPP)
2. Check username is "root" and password is empty in config.php
3. Try creating database manually via phpMyAdmin

### Problem: Database setup fails
**Solution:**
1. Check MySQL is running
2. Open phpMyAdmin: `http://localhost/phpmyadmin`
3. Look for any errors in browser console (F12)
4. Try creating database manually in phpMyAdmin

### Problem: Passwords not matching error during registration
**Solution:**
- Make sure both password fields are exactly the same
- Check for spaces before/after the password
- Verify Caps Lock is not on

### Problem: "This user already exists"
**Solution:**
- Try registering with a different username or email
- Check in phpMyAdmin if the user really exists

---

## 📝 Next Step: Push to GitHub

Once all tests pass, commit and push your code:

```powershell
# Navigate to project folder
cd C:\xampp\htdocs\php_cafewebsite

# Check git status
git status

# Add all changes
git add .

# Commit with descriptive message
git commit -m "Added PHP login and registration with variables, scope, and string functions"

# Push to GitHub
git push origin main
# (or git push origin master, depending on your branch name)
```

---

## 📚 Learning Outcomes

After completing this lab, you should understand:

✅ **PHP Basics:**
- Request/Response cycle
- Form handling with GET/POST
- Variable scope and datatypes

✅ **String Functions:**
- 20+ built-in PHP string functions
- How to validate and format user input
- Security functions like htmlspecialchars() and addslashes()

✅ **Database Operations:**
- SQL CREATE TABLE statements
- SQL INSERT statements for user registration
- SQL SELECT statements for user login
- Password hashing and verification

✅ **Security:**
- Input validation and sanitization
- SQL injection prevention (basic)
- XSS prevention with htmlspecialchars()
- Secure password storage with password_hash()

✅ **Variable Scope:**
- Local scope (inside functions)
- Global scope (global keyword)
- Static scope (persistent variables)
- Superglobal arrays ($_SERVER, etc.)

---

## 🎉 Congratulations!

Your PHP Login & Registration project is complete with:
- ✅ User registration with validation
- ✅ User login with authentication
- ✅ String functions demonstrations
- ✅ Variable scope examples
- ✅ Database integration
- ✅ Security best practices

Happy coding! 🚀
