<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: index.html");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background: #f5f5f5;
        }
        .container {
            background: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        h1 {
            color: #28a745;
        }
        p {
            font-size: 18px;
            color: #666;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 30px;
            background: #dc3545;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            cursor: pointer;
        }
        a:hover {
            background: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🎉 Welcome, <?php echo htmlspecialchars($_SESSION['user']); ?>!</h1>
        <p>You are logged in successfully.</p>
        <p>This is your dashboard - you can add more features here!</p>
        <a href="logout.php">🚪 Logout</a>
    </div>
</body>
</html>
