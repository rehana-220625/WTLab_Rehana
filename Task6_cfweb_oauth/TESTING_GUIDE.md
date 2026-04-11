# 🧪 Testing Guide - Brew Haven Cafe OAuth

Follow these steps to thoroughly test your OAuth implementation.

## 📋 Pre-Testing Checklist

- [ ] XAMPP installed and working
- [ ] Project copied to C:\xampp\htdocs\Task6_cfweb_oauth\
- [ ] .env file created with credentials
- [ ] Apache started in XAMPP
- [ ] MySQL started in XAMPP

## 🔑 Testing Google OAuth

### Test 1: Google Login Flow

**Steps:**
1. Open http://localhost/Task6_cfweb_oauth/ in Chrome
2. Verify login page loads
3. Click "Continue with Google" button
4. Verify redirected to Google login page
5. Log in with your Gmail account
6. Grant permissions when asked
7. Verify redirected back to dashboard

**Expected Results:**
- ✅ Login page loads cleanly
- ✅ Google button is clickable
- ✅ Redirected to Google properly
- ✅ Returned to your app successfully
- ✅ Dashboard accessible

**What to verify on Dashboard:**
- [ ] Your name displays (from Google profile)
- [ ] Your email shows
- [ ] Profile badge says "✓ Verified with Google"
- [ ] Profile picture displays (if you have one on Google)
- [ ] "Logout" button visible

### Test 2: Session Persistence

**Steps:**
1. Log in with Google (from Test 1)
2. Open new browser tab
3. Navigate to: http://localhost/Task6_cfweb_oauth/pages/dashboard.php
4. Should see dashboard without logging in again
5. Go back to first tab
6. Refresh page
7. Should still be logged in

**Expected Results:**
- ✅ Session persists across tabs
- ✅ Session persists on refresh
- ✅ Direct dashboard access works while logged in

### Test 3: Logout Functionality

**Steps:**
1. While logged in, click "👋 Logout" button
2. Verify redirected to login page
3. Try to directly visit: http://localhost/Task6_cfweb_oauth/pages/dashboard.php
4. Should redirect to login page

**Expected Results:**
- ✅ Logout clears session
- ✅ Dashboard no longer accessible
- ✅ Redirected to login

## 🐙 Testing GitHub OAuth

### Test 4: GitHub Login Flow

**Steps:**
1. At login page, click "Continue with GitHub"
2. Verify redirected to GitHub login
3. Log in with your GitHub account
4. Grant permissions when asked
5. Verify redirected back to dashboard

**Expected Results:**
- ✅ GitHub login page loads
- ✅ Permissions request shown
- ✅ Successfully authenticated
- ✅ Redirected to dashboard

**What to verify on Dashboard:**
- [ ] Your GitHub username displays
- [ ] Your GitHub profile picture shows
- [ ] Email from GitHub is displayed
- [ ] Badge says "✓ Verified with GitHub"
- [ ] All profile info is correct

### Test 5: GitHub vs Google Distinction

**Steps:**
1. Clear browser cookies and cache
2. Log in with Google
3. Verify provider badge says "Google"
4. Log out
5. Log in with GitHub
6. Verify provider badge says "GitHub"

**Expected Results:**
- ✅ Different login methods work independently
- ✅ Provider badge updates correctly
- ✅ User info comes from correct provider

## 🔒 Security Testing

### Test 6: Credentials Not Exposed

**Steps:**
1. Right-click on login page → Inspect
2. Search page source for: "secret", "CLIENT_ID", API keys
3. Open network tab (F12 → Network)
4. Log in and monitor requests
5. Check that tokens aren't visible in URLs

**Expected Results:**
- ✅ No credentials in HTML source
- ✅ No secrets in JavaScript
- ✅ Tokens not shown in URLs
- ✅ HTTPS ready (scheme allows https)

### Test 7: State Parameter Validation

**Steps:**
1. Attempt to forge a callback request manually
2. Change the state parameter
3. Should fail with security error

Or

1. Log in normally
2. Check if state parameter is present
3. Verify it matches between request and response

**Expected Results:**
- ✅ State validation works
- ✅ CSRF protection active
- ✅ Forged requests rejected

### Test 8: .env File Protection

**Steps:**
1. Open folder: C:\xampp\htdocs\Task6_cfweb_oauth\
2. Verify .env file exists
3. Verify .env contains your real credentials
4. Verify .env.example exists
5. Open .env.example - should have YOUR_xxx placeholders

**Expected Results:**
- ✅ .env has real credentials
- ✅ .env.example is template only
- ✅ .gitignore created properly

## 📱 Responsive Design Testing

### Test 9: Mobile Responsiveness

**Steps:**
1. Open login page
2. Open Chrome DevTools (F12)
3. Click device toggle (Ctrl+Shift+M)
4. Test on mobile viewport (iPhone 12)
5. Verify buttons are clickable
6. Verify text is readable
7. Verify no horizontal scroll
8. Test login on mobile

**Expected Results:**
- ✅ Layout adapts to mobile
- ✅ Buttons easy to tap (large enough)
- ✅ Text readable without zoom
- ✅ No overflow
- ✅ Login works on mobile

### Test 10: Tablet Responsiveness

**Steps:**
1. DevTools → Choose tablet (iPad)
2. Verify layout is optimal
3. Test login

**Expected Results:**
- ✅ Layout looks good on tablet
- ✅ Elements properly spaced
- ✅ Responsive grid works

## 🧬 Error Handling Testing

### Test 11: Missing Credentials

**Steps:**
1. Rename .env to .env.backup
2. Refresh login page
3. Should see error message

**Expected Results:**
- ✅ User-friendly error message
- ✅ Instructions to fix problem
- ✅ No technical jargon in error

**Restore:**
```bash
rename .env.backup .env
```

### Test 12: Invalid Client ID

**Steps:**
1. Edit .env - change GOOGLE_CLIENT_ID to invalid value
2. Try to log in with Google
3. Should get error from Google

**Expected Results:**
- ✅ Error message shown
- ✅ Not a confusing technical error
- ✅ User knows what went wrong

**Restore:**
```bash
# Put real CLIENT_ID back
```

### Test 13: Network Error Handling

**Steps:**
1. Disconnect internet
2. Try to click "Continue with Google"
3. Should handle gracefully

Or simulate with DevTools:
1. DevTools → Network
2. Set to "Offline"
3. Try login
4. Should show network error

**Expected Results:**
- ✅ Error handled gracefully
- ✅ User-friendly message
- ✅ App doesn't crash

## 🧪 Browser Compatibility

### Test 14: Different Browsers

Test each browser:
- [ ] Chrome (latest)
- [ ] Firefox (latest)
- [ ] Edge (latest)
- [ ] Safari (if on Mac)

**For each browser:**
1. Load login page
2. Test Google login
3. Test GitHub login
4. Log out
5. Verify responsive design

**Expected Results:**
- ✅ Works on all modern browsers
- ✅ No console errors
- ✅ Styling consistent

## 📊 Performance Testing

### Test 15: Load Time

**Steps:**
1. Open DevTools → Network
2. Refresh login page
3. Check load time (should be < 2 seconds)
4. Check number of requests
5. Check total size (should be < 500KB)

**Expected Results:**
- ✅ Fast load time
- ✅ Efficient resource usage
- ✅ Minimal requests

### Test 16: Dashboard Load Time

**Steps:**
1. Log in to dashboard
2. DevTools → Network
3. Refresh dashboard
4. Check load time

**Expected Results:**
- ✅ Dashboard loads quickly
- ✅ No unnecessary resources
- ✅ Smooth user experience

## 🔐 Git Security Testing

### Test 17: Git Security

**Steps:**
```bash
cd c:\Users\acer\Desktop\cafewebsite

# Check what would be committed
git add --dry-run -A

# Verify .env is ignored
git check-ignore -v Task6_cfweb_oauth\.env

# Verify .env.example is included
git ls-files | grep env

# Search for any hardcoded secrets
git grep -i "client_secret" *.php

# Check history for secrets
git log -p | grep -i "secret"
```

**Expected Results:**
- ✅ .env would NOT be added to git
- ✅ git check-ignore confirms .env is ignored
- ✅ .env.example shows in git ls-files
- ✅ No secrets in code
- ✅ No secrets in history

## ✅ Complete Testing Checklist

### Login & Authentication
- [ ] Google login works
- [ ] GitHub login works
- [ ] Session persists across pages
- [ ] Logout clears session
- [ ] Direct dashboard access redirects if not logged in

### User Interface
- [ ] Login page looks professional
- [ ] Dashboard displays user info
- [ ] Mobile responsive
- [ ] Tablet responsive
- [ ] Error messages friendly
- [ ] No technical jargon visible

### Security
- [ ] .env file exists with credentials
- [ ] .env.example is template
- [ ] No credentials in source code
- [ ] State parameter present
- [ ] HTTPS ready
- [ ] No network exposure

### Performance
- [ ] Login page loads fast (< 2s)
- [ ] Dashboard loads fast (< 2s)
- [ ] Responsive design works
- [ ] No console errors

### Compatibility
- [ ] Works on Chrome
- [ ] Works on Firefox
- [ ] Works on Edge
- [ ] Works on mobile browsers
- [ ] Works on Safari

### Git & Deployment
- [ ] .env is ignored by git
- [ ] .env.example is in git
- [ ] No secrets in code
- [ ] README is complete
- [ ] Documentation ready

## 📝 Test Results Recording

Create a file `TEST_RESULTS.txt`:

```
BREW HAVEN CAFE - OAUTH TESTING RESULTS
======================================

Date: [YOUR DATE]
Tester: [YOUR NAME]

Google OAuth:
- Login: ✅ PASS
- Session Persistence: ✅ PASS
- Logout: ✅ PASS

GitHub OAuth:
- Login: ✅ PASS
- Session Persistence: ✅ PASS
- Logout: ✅ PASS

Security:
- .env Protected: ✅ PASS
- No Hardcoded Secrets: ✅ PASS
- CSRF Protection: ✅ PASS

UI/UX:
- Responsive: ✅ PASS
- Professional: ✅ PASS
- Friendly Messages: ✅ PASS

Performance:
- Load Time: ✅ PASS (< 2s)
- Resources: ✅ PASS (< 500KB)

Browser Compatibility:
- Chrome: ✅ PASS
- Firefox: ✅ PASS
- Edge: ✅ PASS
- Mobile: ✅ PASS

Overall Status: ✅ ALL TESTS PASS
Ready for Submission: YES
```

## 🎯 Troubleshooting During Tests

### "Login page doesn't load"
- Check XAMPP Apache is running
- Check correct URL: http://localhost/Task6_cfweb_oauth/
- Check .env file exists
- Check config.php can load .env

### "Google login shows error"
- Verify CLIENT_ID in .env is correct
- Check redirect URI is exact match
- Verify credentials not expired
- Check Google Cloud Console settings

### "GitHub login fails"
- Verify CLIENT_ID in .env
- Check GitHub OAuth app settings
- Verify redirect URI exact match
- Check GitHub account has access

### "No profile picture shows"
- Google: Profile picture optional
- GitHub: Public profile picture usually shows
- Check user profile settings in provider

### "Session doesn't persist"
- Check cookies enabled in browser
- Clear cache/cookies and retry
- Check session.save_path in php.ini
- Verify session directory exists

## 🎓 What to Document

After testing, create summary:
- [ ] All tests completed
- [ ] Tests that passed
- [ ] Any issues found and fixed
- [ ] Screenshots of working app
- [ ] Browsers tested
- [ ] Date testing completed

---

**Testing Complete?** ✅

You're ready to submit when:
- All tests pass
- Documentation complete
- Git repo set up
- .env protected
- Ready to push to GitHub
