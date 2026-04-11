<?php
/* ===================================
   LOGIN MODULE (login.php)
   Uses string functions for validation
   =================================== */

// Include database configuration
include 'config.php';

// Variables to store form data
$username_input = "";
$error = "";
$success = "";

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // ===== PART C: STRING FUNCTION CLEANING & VALIDATION =====
    
    // Retrieve and clean input data
    $username_input = trim($_POST['username']);
    $password_input = $_POST['password'];
    
    // Step 1: Validate input is not empty
    if (empty($username_input) || empty($password_input)) {
        $error = "❌ Both username/email and password are required!";
    }
    // Step 2: Validate input length using strlen()
    else if (strlen($username_input) < 3) {
        $error = "❌ Invalid username or email format!";
    }
    else {
        // Clean input for database query
        $username_clean = strtolower(trim($username_input));
        $username_clean = addslashes($username_clean);
        
        // Query to check if user exists (accept both username and email)
        $login_sql = "SELECT id, username, email, password, fullname FROM users 
                      WHERE (username = '$username_clean' OR email = '$username_clean') LIMIT 1";
        
        $result = $conn->query($login_sql);
        
        // Check if user exists
        if ($result->num_rows == 0) {
            // User not found
            $error = "❌ Username/Email or Password is incorrect!";
        } else {
            // User found - verify password
            $row = $result->fetch_assoc();
            
            // Use password_verify() for hashed passwords
            if (password_verify($password_input, $row['password'])) {
                $success = "✅ Login successful! Welcome, " . htmlspecialchars(ucfirst($row['fullname'])) . "!";
                
                // In a real application, you would set sessions here
                // $_SESSION['user_id'] = $row['id'];
                // $_SESSION['username'] = $row['username'];
                
                // Redirect to dashboard after 2 seconds
                echo "<script>
                    setTimeout(function() {
                        window.location.href = 'dashboard.html';
                    }, 2000);
                </script>";
            } else {
                // Password verification failed using strcmp() for demonstration
                $feedback = strcmp($password_input, $row['password']);
                $error = "❌ Username/Email or Password is incorrect!";
            }
        }
    }
    
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Cafe Website</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        
        .container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            padding: 40px;
            max-width: 500px;
            width: 100%;
        }
        
        h1 {
            color: #333;
            margin-bottom: 10px;
            text-align: center;
        }
        
        .subtitle {
            color: #666;
            text-align: center;
            margin-bottom: 30px;
            font-size: 0.9em;
        }
        
        .message {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            font-weight: 500;
        }
        
        .error {
            background-color: #fee;
            color: #c00;
            border: 1px solid #fcc;
        }
        
        .success {
            background-color: #efe;
            color: #0a0;
            border: 1px solid #cfc;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            color: #333;
            font-weight: 600;
            margin-bottom: 8px;
        }
        
        input {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 1em;
        }
        
        input:focus {
            outline: none;
            border-color: #667eea;
        }
        
        button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 5px;
            font-weight: 600;
            cursor: pointer;
        }
        
        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        
        .register-link {
            text-align: center;
            margin-top: 20px;
        }
        
        .register-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>☕ Cafe Website</h1>
        <div class="subtitle">User Login</div>
        
        <?php
        // Display error or success messages
        if (!empty($error)) {
            echo "<div class='message error'>" . htmlspecialchars($error) . "</div>";
        }
        if (!empty($success)) {
            echo "<div class='message success'>" . htmlspecialchars($success) . "</div>";
        }
        ?>
        
        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Username or Email *</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username_input); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password *</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <button type="submit">Login</button>
        </form>
        
        <div class="register-link">
            Don't have an account? <a href="register.html">Register here</a>
        </div>
    </div>
</body>
</html>
