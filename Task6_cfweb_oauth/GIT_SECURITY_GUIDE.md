# Git and Security Setup Guide

## 🔐 Protecting Sensitive Credentials

This guide ensures your OAuth credentials are **NEVER committed to GitHub**.

## Step 1: Create .env File

### Copy the template:
```bash
cd Task6_cfweb_oauth
copy .env.example .env
```

### Edit .env with your actual credentials:
```ini
# Real credentials - NEVER commit this file!
GOOGLE_CLIENT_ID=YOUR_ACTUAL_CLIENT_ID_HERE
GOOGLE_CLIENT_SECRET=YOUR_ACTUAL_CLIENT_SECRET_HERE
GOOGLE_REDIRECT_URI=http://localhost/Task6_cfweb_oauth/oauth.php

GITHUB_CLIENT_ID=YOUR_ACTUAL_GITHUB_CLIENT_ID
GITHUB_CLIENT_SECRET=YOUR_ACTUAL_GITHUB_CLIENT_SECRET
GITHUB_REDIRECT_URI=http://localhost/Task6_cfweb_oauth/github-auth.php

FIREBASE_API_KEY=YOUR_ACTUAL_FIREBASE_API_KEY
# ... other Firebase credentials
```

## Step 2: Verify .gitignore Configuration

The `.gitignore` file **MUST** contain:

```
# Environment variables - NEVER commit real secrets!
.env
.env.local
.env.*.local

# Other sensitive files
sessions/
cache/
tmp/
```

## Step 3: Initialize Git Repository

```bash
cd c:\Users\acer\Desktop\cafewebsite

# Initialize git (if not already done)
git init

# Add all files
git add .

# Check which files will be committed
git status
```

## Step 4: Verify .env is NOT in Git

```bash
# This should show NOTHING related to .env
git ls-files | grep env

# If it shows .env, remove it:
git rm --cached .env
git add .gitignore
```

## Step 5: Create Initial Commit

```bash
# First commit with safe files only
git add .
git commit -m "Initial commit - Brew Haven Cafe OAuth integration

- Google OAuth implementation
- GitHub OAuth implementation  
- Firebase authentication support
- Secure credential management with .env
- Professional login and dashboard pages"
```

## Step 6: Verify .env.example is in Git

```bash
# This SHOULD appear (safe template file)
git ls-files | grep env.example

# It should show:
# Task6_cfweb_oauth/.env.example
```

## Step 7: Push to GitHub

### Create new repository on GitHub:

1. Go to https://github.com/new
2. Name: `cafe-website-oauth` or `cafewebsite-task6`
3. Description: "OAuth Integration for Brew Haven Cafe"
4. Choose Public or Private
5. Don't initialize with README (we have one)
6. Click "Create repository"

### Connect and push:

```bash
# Add remote repository
git remote add origin https://github.com/YOUR_USERNAME/cafe-website-oauth.git

# Rename branch to main if needed
git branch -M main

# Push to GitHub
git push -u origin main
```

## 🚨 SECURITY CHECKLIST

Before pushing to GitHub, verify:

- [ ] `.env` file exists locally with your credentials
- [ ] `.env` file is in `.gitignore`
- [ ] `.env.example` is committed (without real credentials)
- [ ] `git status` shows `.env` as ignored (not staged)
- [ ] No actual API keys in any `.php` files
- [ ] No credentials in HTML/JavaScript files
- [ ] `.gitignore` rule for `.env` is correct

### Check if .env would be committed:

```bash
git check-ignore -v .env
# Should output: .env:.gitignore:2:.env

git check-ignore -v .env.example
# Should give NO output (file is safe to commit)
```

## 📋 What SHOULD be in GitHub

✅ **Safe to commit:**
- `.env.example` (template only)
- `.gitignore`
- `*.php` files (no hardcoded secrets)
- `README.md`
- `html/css/js` files
- Documentation files

❌ **NEVER commit:**
- `.env` (your real credentials)
- `sessions/` directory
- Cache files
- IDE configuration (.vscode, .idea)
- API keys or secrets anywhere

## 🔑 Managing Multiple Environments

### Development (.env):
```
GOOGLE_CLIENT_ID=dev_google_id
GOOGLE_REDIRECT_URI=http://localhost/Task6_cfweb_oauth/oauth.php
```

### Production (.env.production):
```
GOOGLE_CLIENT_ID=prod_google_id
GOOGLE_REDIRECT_URI=https://yourdomain.com/Task6_cfweb_oauth/oauth.php
```

Add to `.gitignore`:
```
.env
.env.production
.env.staging
```

## 📝 Continuous Security

### Before each commit:
```bash
# Review what's about to be committed
git diff --cached

# Never commit secrets!
git status

# Check for accidentally added .env
grep -r "CLIENT_ID" --exclude-dir=.git
```

### When sharing your repository:
```bash
# Remind collaborators to create their own .env
# Include setup instructions in README

# Generate new OAuth credentials for shared environments
# Never share your .env file
```

## 🔄 If You Accidentally Committed .env

### Immediately revoke your credentials:
1. Go to Google Cloud Console → Regenerate credentials
2. Go to GitHub → Regenerate OAuth token
3. Go to Firebase → Regenerate API keys

### Remove from Git history:
```bash
# Remove file from history (caution: rewrites history)
git filter-branch --tree-filter 'rm -f Task6_cfweb_oauth/.env' HEAD

# Force push (only if not public yet)
git push --force-all
```

## ✅ Final Verification

Before submitting:

```bash
# Your repository should look like this:
git ls-files | grep -E "(\.env|\.gitignore)"

# Output should be:
# Task6_cfweb_oauth/.env.example  ← Safe to commit
# Task6_cfweb_oauth/.gitignore    ← Safe to commit
# (NO .env file without .example)
```

## 📞 Troubleshooting

### "My .env file keeps appearing in git status"

```bash
# Solution: Add and commit .gitignore
git add .gitignore
git commit -m "Add .gitignore to protect .env"
```

### "I need different credentials for production"

```bash
# Create environment-specific files
touch .env.production
touch .env.staging

# Add to .gitignore
echo ".env.production" >> .gitignore
echo ".env.staging" >> .gitignore

# Load based on environment
if (getenv('APP_ENV') === 'production') {
    $envPath = '.env.production';
} else {
    $envPath = '.env';
}
```

### "How do I give credentials to my team?"

```bash
# Create .env.example with placeholders
# Team members copy to .env and fill their credentials

# NEVER share .env file via email, Slack, or GitHub
# Use your team's secure credential management system
```

---

**Remember**: GitHub is public by default. Any credentials pushed to a public repo are compromised and must be regenerated immediately.

For questions about Git security, see: https://git-scm.com/book/en/v2/Git-Tools-Credential-Storage
