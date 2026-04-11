# ☕ Brew Haven Cafe - OAuth Integration Project

A professional cafe website with secure OAuth authentication integration for Google, GitHub, and Firebase.

## 📋 Project Overview

This project demonstrates proper OAuth implementation with:
- ✅ Google OAuth 2.0 authentication
- ✅ GitHub OAuth 2.0 authentication  
- ✅ Firebase authentication (client & server-side)
- ✅ Secure credential management with .env files
- ✅ Professional user-friendly interface
- ✅ Proper session handling and security practices

## 🔐 Security Features

- **Environment Variables**: All sensitive credentials stored in `.env` (never committed to Git)
- **State Parameter Validation**: CSRF protection for OAuth flows
- **HTTPS Ready**: Configured for secure token transmission
- **Session Management**: Secure session handling with proper timeouts
- **Token Verification**: Server-side validation of OAuth tokens

## 📁 Project Structure

```
Task6_cfweb_oauth/
├── .env.example              # Template for environment variables (commit this)
├── .gitignore               # Git ignore rules (protects .env)
├── index.php                # Main login page
├── oauth.php                # Google OAuth callback handler
├── github-auth.php          # GitHub OAuth callback handler
├── firebase-callback.php    # Firebase token verification
├── logout.php               # Logout handler
│
├── includes/
│   ├── config.php           # Configuration loader & helper functions
│   ├── oauth-helpers.php    # OAuth flow implementations
│   └── firebase-auth.php    # Firebase authentication module
│
├── pages/
│   └── dashboard.php        # User dashboard (after login)
│
├── css/                     # Stylesheets
├── js/                      # JavaScript files
└── README.md               # This file
```

## 🚀 Quick Start Setup

### 1. Clone or Download the Project

```bash
cd c:\Users\acer\Desktop\cafewebsite
```

### 2. Create .env File

Copy `.env.example` to `.env`:

```bash
copy .env.example .env
```

Edit `.env` and add your OAuth credentials:

```ini
GOOGLE_CLIENT_ID=your_google_client_id
GOOGLE_CLIENT_SECRET=your_google_client_secret
GOOGLE_REDIRECT_URI=http://localhost/Task6_cfweb_oauth/oauth.php

GITHUB_CLIENT_ID=your_github_client_id
GITHUB_CLIENT_SECRET=your_github_client_secret
GITHUB_REDIRECT_URI=http://localhost/Task6_cfweb_oauth/github-auth.php

FIREBASE_API_KEY=your_firebase_api_key
FIREBASE_PROJECT_ID=your_firebase_project_id
# ... other Firebase credentials
```

### 3. Verify .gitignore

Ensure `.env` is in `.gitignore` to prevent committing secrets:

```
.env
.env.local
.env.*.local
```

### 4. Copy to XAMPP

```bash
copy Task6_cfweb_oauth C:\xampp\htdocs\
```

### 5. Start XAMPP

- Open XAMPP Control Panel
- Start **Apache** and **MySQL**

### 6. Access the Application

```
http://localhost/Task6_cfweb_oauth/
```

## 🔑 Setting Up OAuth Providers

### Google OAuth Setup

1. **Go to Google Cloud Console**
   - https://console.cloud.google.com/
   - Create a new project

2. **Enable Google+ API**
   - APIs & Services → Library
   - Search "Google+ API" → Enable

3. **Create OAuth 2.0 Credentials**
   - APIs & Services → Credentials
   - Create → OAuth 2.0 Client ID
   - Application type: Web application
   - Authorized redirect URIs:
     - `http://localhost/Task6_cfweb_oauth/oauth.php`
     - `https://yourdomain.com/Task6_cfweb_oauth/oauth.php`

4. **Copy credentials to .env**
   ```
   GOOGLE_CLIENT_ID=your_client_id
   GOOGLE_CLIENT_SECRET=your_client_secret
   ```

### GitHub OAuth Setup

1. **Go to GitHub Settings**
   - GitHub → Settings → Developer settings → OAuth Apps
   - New OAuth App

2. **Fill Application Details**
   - Application name: Brew Haven Cafe
   - Homepage URL: `http://localhost/Task6_cfweb_oauth/`
   - Authorization callback URL: `http://localhost/Task6_cfweb_oauth/github-auth.php`

3. **Copy credentials to .env**
   ```
   GITHUB_CLIENT_ID=your_client_id
   GITHUB_CLIENT_SECRET=your_client_secret
   ```

### Firebase Setup

1. **Go to Firebase Console**
   - https://console.firebase.google.com/
   - Create a new project

2. **Enable Authentication**
   - Project settings → Service accounts
   - Copy configuration JSON

3. **Enable Sign-in Methods**
   - Authentication → Sign-in method
   - Enable: Google, GitHub, Email/Password

4. **Copy credentials to .env**
   ```
   FIREBASE_API_KEY=your_api_key
   FIREBASE_PROJECT_ID=your_project_id
   # ... other credentials
   ```

## 📖 How It Works

### Google OAuth Flow

1. User clicks "Continue with Google" button
2. Redirected to Google login page
3. Google returns authorization code
4. `oauth.php` exchanges code for access token
5. Token used to fetch user information
6. Session created and user logged in
7. Redirected to dashboard

### GitHub OAuth Flow

1. User clicks "Continue with GitHub" button
2. Redirected to GitHub login page
3. GitHub returns authorization code
4. `github-auth.php` exchanges code for access token
5. Token used to fetch user information (including email)
6. Session created and user logged in
7. Redirected to dashboard

### Firebase Flow (Client-side)

1. Firebase JavaScript SDK initializes
2. User authenticates via Google or GitHub
3. Firebase returns ID token
4. Token sent to `firebase-callback.php` for verification
5. Server validates token and creates session
6. User logged in successfully

## 🔒 Security Best Practices Implemented

✅ **Environment Variables**
- All secrets in `.env`, never in code
- `.env` file in `.gitignore`
- `.env.example` serves as template

✅ **OAuth Security**
- State parameter for CSRF protection
- Token validation on server
- Secure redirect URIs configured

✅ **Session Management**
- Secure session initialization
- Token stored in server session only
- Logout properly clears session

✅ **Code Security**
- Input sanitization with `safe()` function
- Proper error handling without exposing details
- No sensitive data in HTML/JavaScript

## 🧪 Testing the Application

### Test Google Login

1. Open http://localhost/Task6_cfweb_oauth/
2. Click "Continue with Google"
3. Log in with your Gmail account
4. Verify redirected to dashboard
5. Check user information displays correctly

### Test GitHub Login

1. Open http://localhost/Task6_cfweb_oauth/
2. Click "Continue with GitHub"
3. Log in with your GitHub account
4. Verify redirected to dashboard
5. Check user information and profile picture displays

### Test Logout

1. Click "Logout" button on dashboard
2. Verify redirected to login page
3. Verify session is cleared

## 📋 File Descriptions

| File | Purpose |
|------|---------|
| `.env.example` | Template for environment variables |
| `.gitignore` | Prevents committing sensitive files |
| `config.php` | Loads environment & provides helpers |
| `oauth-helpers.php` | OAuth flow implementations |
| `firebase-auth.php` | Firebase authentication |
| `oauth.php` | Google OAuth callback |
| `github-auth.php` | GitHub OAuth callback |
| `firebase-callback.php` | Firebase token verification |
| `index.php` | Login page |
| `dashboard.php` | User profile page |

## 🐛 Troubleshooting

### "Missing OAuth environment variables"

**Solution**: Create `.env` file and add your credentials

```bash
copy .env.example .env
# Edit .env with your credentials
```

### "Invalid state parameter"

**Solution**: Clear browser cookies/cache, login again

### "Access token error"

**Solution**: 
- Verify credentials are correct
- Check redirect URI matches exactly
- Ensure Client Secret is correct

### Firebase not loading

**Solution**: 
- Check Firebase API key is correct
- Verify Firebase project exists
- Enable required authentication methods

## 📝 Git Workflow

### Initial Setup

```bash
git init
git add .
git commit -m "Initial commit - Brew Haven Cafe OAuth integration"
```

### Important - NEVER commit these:

```bash
# Never add .env file
git rm --cached .env 2>/dev/null
echo ".env" >> .gitignore
git add .gitignore
git commit -m "Add .env to gitignore"
```

### Safe files to commit:

✅ `.env.example` - Safe, no real credentials
✅ All source code files
✅ `.gitignore` configuration
✅ `README.md` documentation
✅ CSS and JavaScript files

### Push to GitHub

```bash
git add .
git commit -m "Production ready - OAuth integration complete"
git push origin main
```

## 📊 User Flow Diagram

```
Login Page
    ↓
┌─────────────────────────────────┐
│ Choose Login Method             │
├─────────────────────────────────┤
│ • Continue with Google          │
│ • Continue with GitHub          │
│ • Firebase Authentication       │
└─────────────────────────────────┘
    ↓
OAuth Provider Login (Google/GitHub)
    ↓
Callback Handler (oauth.php / github-auth.php)
    ↓
Exchange Code → Access Token
    ↓
Fetch User Information
    ↓
Create Session
    ↓
Dashboard (Logged In)
    ↓
Logout → Clear Session → Back to Login
```

## 🎯 Features

### Login Options
- ✅ Google OAuth
- ✅ GitHub OAuth
- ✅ Firebase (multiple methods)

### Dashboard Features
- ✅ Display user profile
- ✅ Show authentication provider
- ✅ User information display
- ✅ Logout functionality
- ✅ Responsive design

## 📞 Support

For issues or questions:
1. Check `.env` file is properly configured
2. Review OAuth provider settings
3. Check browser console for errors
4. Verify redirect URIs match exactly
5. Clear cache and try again

## 📜 License

This project is part of an educational assignment on OAuth integration.

---

**Brew Haven Cafe** - *Where Every Cup Tells a Story* ☕
