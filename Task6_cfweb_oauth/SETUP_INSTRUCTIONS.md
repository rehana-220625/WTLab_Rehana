# SETUP INSTRUCTIONS - Brew Haven Cafe OAuth Project

Follow these steps to get the project running on your machine.

## ✅ Prerequisites

Before starting, ensure you have:
- ✅ XAMPP installed (Apache + PHP + MySQL)
- ✅ Git installed
- ✅ A Gmail account (for Google OAuth testing)
- ✅ A GitHub account (for GitHub OAuth testing)

## 📋 Step 1: Project Structure Setup

### Copy Project to XAMPP
```bash
# Navigate to your project folder
cd c:\Users\acer\Desktop\cafewebsite

# Copy to XAMPP htdocs
copy /E Task6_cfweb_oauth C:\xampp\htdocs\
```

Verify folder exists:
```
C:\xampp\htdocs\Task6_cfweb_oauth\
├── .env.example
├── .gitignore
├── index.php
├── README.md
└── [other files]
```

## 🔑 Step 2: Setup .env File

### Create .env from template:
```bash
cd C:\xampp\htdocs\Task6_cfweb_oauth

# Copy the example file
copy .env.example .env
```

### Edit .env with your credentials

Open `.env` in VS Code and update:

```ini
# ===== GOOGLE OAUTH =====
GOOGLE_CLIENT_ID=YOUR_GOOGLE_CLIENT_ID
GOOGLE_CLIENT_SECRET=YOUR_GOOGLE_CLIENT_SECRET
GOOGLE_REDIRECT_URI=http://localhost/Task6_cfweb_oauth/oauth.php

# ===== GITHUB OAUTH =====
GITHUB_CLIENT_ID=YOUR_GITHUB_CLIENT_ID
GITHUB_CLIENT_SECRET=YOUR_GITHUB_CLIENT_SECRET
GITHUB_REDIRECT_URI=http://localhost/Task6_cfweb_oauth/github-auth.php

# ===== FIREBASE CONFIG =====
FIREBASE_API_KEY=YOUR_FIREBASE_API_KEY
FIREBASE_PROJECT_ID=YOUR_FIREBASE_PROJECT_ID
FIREBASE_MESSAGING_SENDER_ID=YOUR_SENDER_ID
FIREBASE_APP_ID=YOUR_APP_ID
FIREBASE_AUTH_DOMAIN=your-project.firebaseapp.com
FIREBASE_DATABASE_URL=https://your-project.firebaseio.com
FIREBASE_STORAGE_BUCKET=your-project.appspot.com

# ===== SESSION CONFIG =====
SESSION_NAME=brew_haven_session
SESSION_LIFETIME=3600

# ===== APPLICATION SETTINGS =====
APP_NAME=Brew Haven Cafe
APP_URL=http://localhost/Task6_cfweb_oauth/
APP_ENV=development
```

## 🔐 Step 3: Get OAuth Credentials

### Option A: Google OAuth

1. **Go to Google Cloud Console**
   - Open: https://console.cloud.google.com/
   - Click "Select a Project" → "New Project"
   - Project name: `Brew Haven Cafe`
   - Click "Create"

2. **Enable Google+ API**
   - Left sidebar → "APIs & Services" → "Library"
   - Search: "Google+ API"
   - Click it → "Enable"

3. **Create OAuth Credentials**
   - "APIs & Services" → "Credentials"
   - "Create Credentials" → "OAuth 2.0 Client IDs"
   - Choose: "Web application"
   - Name: "Brew Haven Cafe"
   
4. **Add Authorized Redirect URIs**
   - Under "Authorized redirect URIs" click "Add URI"
   - Add: `http://localhost/Task6_cfweb_oauth/oauth.php`
   - Click "Create"

5. **Copy the credentials**
   - Copy **Client ID** and **Client Secret**
   - Paste into `.env` file

### Option B: GitHub OAuth

1. **Go to GitHub Settings**
   - Open: https://github.com/settings/developers
   - Click "New OAuth App"

2. **Fill in Application Details**
   - Application name: `Brew Haven Cafe`
   - Homepage URL: `http://localhost/Task6_cfweb_oauth/`
   - Authorization callback URL: `http://localhost/Task6_cfweb_oauth/github-auth.php`
   - Click "Create application"

3. **Copy the credentials**
   - Copy **Client ID** and **Client Secret**
   - Paste into `.env` file

### Option C: Firebase Setup

1. **Create Firebase Project**
   - Open: https://console.firebase.google.com/
   - Click "Add project"
   - Name: `brew-haven-cafe`
   - Click "Create project"

2. **Get Configuration**
   - Project Settings → "Your apps"
   - Register a new Web App
   - Copy Firebase Configuration JSON
   - Extract values and add to `.env`

3. **Enable Authentication**
   - "Build" → "Authentication"
   - "Get Started"
   - Enable: Google, GitHub, Email/Password

## 🚀 Step 4: Start XAMPP

1. **Open XAMPP Control Panel**
2. **Start Services**
   - Click "Start" for Apache
   - Click "Start" for MySQL
   - Wait for them to show "Running" (green)

## 🌐 Step 5: Test the Application

### Open in Browser:
```
http://localhost/Task6_cfweb_oauth/
```

You should see:
- ✅ Brew Haven Cafe login page
- ✅ "Continue with Google" button
- ✅ "Continue with GitHub" button

### Test Google Login:
1. Click "Continue with Google"
2. Log in with your Gmail account
3. See permission request → Click "Allow"
4. Should redirect to Dashboard
5. See your name, email, and profile picture

### Test GitHub Login:
1. Click "Continue with GitHub"
2. Log in with your GitHub account
3. See authorization request → Click "Authorize"
4. Should redirect to Dashboard
5. See your GitHub profile info

### Test Logout:
1. Click "👋 Logout" button
2. Should return to login page
3. Session should be cleared

## 📁 Step 6: Verify Files Structure

Your project should have:

```
Task6_cfweb_oauth/
├── .env                    ← YOUR CREDENTIALS (local only)
├── .env.example            ← TEMPLATE (safe to commit)
├── .gitignore              ← Git rules
├── index.php               ← Login page
├── oauth.php               ← Google callback
├── github-auth.php         ← GitHub callback
├── firebase-callback.php   ← Firebase handler
├── logout.php              ← Logout handler
├── README.md               ← Documentation
├── GIT_SECURITY_GUIDE.md   ← Git instructions
│
├── includes/
│   ├── config.php          ← Loads .env
│   ├── oauth-helpers.php   ← OAuth functions
│   └── firebase-auth.php   ← Firebase module
│
└── pages/
    └── dashboard.php       ← User dashboard
```

## 🔧 Troubleshooting

### Problem: ".env file not found" error

**Solution:**
```bash
# Make sure you created .env (not .env.example)
cd C:\xampp\htdocs\Task6_cfweb_oauth
copy .env.example .env

# Edit .env with your credentials
```

### Problem: "Invalid Client ID"

**Solution:**
1. Double-check your credentials are copied correctly
2. Make sure there are no extra spaces
3. Verify the exact client ID from provider (no typos)
4. Try regenerating credentials

### Problem: "Invalid redirect URI"

**Solution:**
1. Must match EXACTLY in OAuth provider settings
2. Should be: `http://localhost/Task6_cfweb_oauth/oauth.php`
3. Check for typos or extra slashes

### Problem: "Permission denied" or "Cannot create .env"

**Solution:**
```bash
# Run as Administrator
# Or change folder permissions
# Right-click folder → Properties → Security → Edit → Allow Full Control
```

## 📱 Testing Checklist

- [ ] .env file created with credentials
- [ ] XAMPP Apache is running
- [ ] Login page loads at http://localhost/Task6_cfweb_oauth/
- [ ] Google login button works
- [ ] GitHub login button works
- [ ] Dashboard shows user info after login
- [ ] Logout button works
- [ ] Session clears after logout

## 🎯 Next Steps

### After testing locally:

1. **Initialize Git** (if not already done)
   ```bash
   cd c:\Users\acer\Desktop\cafewebsite
   git init
   ```

2. **Create GitHub repository** 
   - Go to https://github.com/new
   - Name: `cafewebsite-oauth` or `cafe-website`

3. **Push to GitHub**
   ```bash
   git remote add origin https://github.com/YOUR_USERNAME/your-repo.git
   git add .
   git commit -m "OAuth integration complete"
   git push -u origin main
   ```

4. **Verify Git Security**
   - Check that `.env` is NOT in your GitHub repository
   - Only `.env.example` should be there
   - See `GIT_SECURITY_GUIDE.md` for details

## 📞 Support Resources

- **Google OAuth Docs**: https://developers.google.com/identity/protocols/oauth2
- **GitHub OAuth Docs**: https://docs.github.com/en/developers/apps/building-oauth-apps
- **Firebase Docs**: https://firebase.google.com/docs/auth
- **XAMPP Help**: https://www.apachefriends.org/

## ✅ Success Indicators

You're done when:
- ✅ Login page loads
- ✅ Google OAuth works
- ✅ GitHub OAuth works  
- ✅ Dashboard displays user info
- ✅ Logout works
- ✅ .env file is created and works
- ✅ Project is on GitHub with .env.example (not .env)
- ✅ README.md explains how to set it up

---

**Congratulations!** 🎉 Your OAuth-integrated cafe website is ready!
