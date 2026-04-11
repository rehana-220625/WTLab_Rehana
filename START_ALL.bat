@echo off
REM ============================================
REM Cafe Website - Quick Start Script (Windows)
REM ============================================

echo.
echo ╔════════════════════════════════════════════╗
echo ║   CAFE WEBSITE - AUTO START (MongoDB + Backend)
echo ╚════════════════════════════════════════════╝
echo.

REM Check if MongoDB is installed
where mongod >nul 2>nul
if %errorlevel% neq 0 (
    echo ❌ MongoDB not found in PATH
    echo Install MongoDB from: https://www.mongodb.com/try/download/community
    pause
    exit /b 1
)

REM Check if Node.js is installed
where node >nul 2>nul
if %errorlevel% neq 0 (
    echo ❌ Node.js not found
    echo Install Node.js from: https://nodejs.org/
    pause
    exit /b 1
)

echo ✓ MongoDB found
echo ✓ Node.js found
echo.

REM Start MongoDB in a new window
echo Starting MongoDB...
start "MongoDB Server" cmd /k "mongod --dbpath %USERPROFILE%\MongoDB\data"
echo ⏳ Waiting 3 seconds for MongoDB to start...
timeout /t 3 /nobreak

REM Navigate to backend and start server
echo.
echo Starting Backend Server...
cd /d "%~dp0backend"
if not exist "node_modules" (
    echo Installing dependencies...
    call npm install
)

REM Start backend in a new window
start "Cafe Website Backend" cmd /k "node index.js"

echo.
echo ╔════════════════════════════════════════════╗
echo ║   ✅ Services Started Successfully!
echo ╚════════════════════════════════════════════╝
echo.
echo 📊 MongoDB Server: http://localhost:27017
echo 🔌 Backend API: http://localhost:5000/api/health
echo 🌐 Open Website: Task03_cfweb/index.html
echo.
echo 💡 Tip: Keep these windows open while using the website
echo 🛑 To stop: Close the "MongoDB Server" and "Cafe Website Backend" windows
echo.
pause
