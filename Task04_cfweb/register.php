<?php
/* ===================================
   REGISTRATION MODULE (register.php)
   Uses string functions and validation
   =================================== */

// Include database configuration
include 'config.php';

// Variables to store form data
$fullname = $username = $email = $password = $confirm_password = "";
$error = "";
$success = "";

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // ===== PART C: STRING FUNCTION CLEANING & VALIDATION =====
    
    // Retrieve and clean input data
    $fullname = trim($_POST['fullname']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    // Step 1: Validate input is not empty
    if (empty($fullname) || empty($username) || empty($email) || empty($password)) {
        $error = "❌ All fields are required!";
        // die() will stop execution if there's a critical error
    }
    // Step 2: Validate username length using strlen()
    else if (strlen($username) < 4 || strlen($username) > 20) {
        $error = "❌ Username must be between 4 and 20 characters. (Current: " . strlen($username) . " characters)";
    }
    // Step 3: Validate password length using strlen()
    else if (strlen($password) < 6) {
        $error = "❌ Password must be at least 6 characters long. (Current: " . strlen($password) . " characters)";
    }
    // Step 4: Check if passwords match using strcmp()
    else if (strcmp($password, $confirm_password) !== 0) {
        $error = "❌ Passwords do not match!";
    }
    // Step 5: Validate email format
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "❌ Invalid email format!";
    }
    // Step 6: Validate fullname has minimum length
    else if (strlen($fullname) < 2) {
        $error = "❌ Full name is too short!";
    }
    
    // If no errors, proceed with database operations
    if (empty($error)) {
        // ===== STRING FUNCTION DEMONSTRATIONS =====
        
        // Format username: convert to lowercase
        $username_clean = strtolower($username);
        // Escape input for SQL safety
        $username_clean = addslashes($username_clean);
        
        // Format fullname: capitalize first letter of each word
        $fullname_formatted = ucwords(strtolower(trim($fullname)));
        $fullname_formatted = addslashes($fullname_formatted);
        
        // Clean email
        $email_clean = strtolower($email);
        $email_clean = addslashes($email_clean);
        
        // Hash password for security
        $password_hashed = password_hash($password, PASSWORD_DEFAULT);
        
        // Check if username already exists using database query
        $check_username = "SELECT id FROM users WHERE username = '$username_clean' LIMIT 1";
        $result = $conn->query($check_username);
        
        if ($result->num_rows > 0) {
            $error = "❌ Username already exists! Please choose a different username.";
        }
        // Check if email already exists
        else {
            $check_email = "SELECT id FROM users WHERE email = '$email_clean' LIMIT 1";
            $result = $conn->query($check_email);
            
            if ($result->num_rows > 0) {
                $error = "❌ Email already registered! Please use a different email.";
            }
            // All validations passed - insert user into database
            else {
                $insert_sql = "INSERT INTO users (username, email, password, fullname) 
                               VALUES ('$username_clean', '$email_clean', '$password_hashed', '$fullname_formatted')";
                
                if ($conn->query($insert_sql) === TRUE) {
                    $success = "✅ Registration successful! Welcome, " . htmlspecialchars($fullname_formatted) . "!";
                    // Clear form data after successful registration
                    $fullname = $username = $email = $password = $confirm_password = "";
                    
                    // Redirect to login page after 3 seconds
                    echo "<script>
                        setTimeout(function() {
                            window.location.href = 'login.html';
                        }, 3000);
                    </script>";
                } else {
                    $error = "❌ Error registering user: " . $conn->error;
                    die();
                }
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
    <title>Registration - Cafe Website</title>
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
        
        .login-link {
            text-align: center;
            margin-top: 20px;
        }
        
        .login-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>☕ Cafe Website</h1>
        <div class="subtitle">User Registration</div>
        
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
                <label for="fullname">Full Name *</label>
                <input type="text" id="fullname" name="fullname" value="<?php echo htmlspecialchars($fullname); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="username">Username *</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email Address *</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password *</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <div class="form-group">
                <label for="confirm_password">Confirm Password *</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            
            <button type="submit">Create Account</button>
        </form>
        
        <div class="login-link">
            Already have an account? <a href="login.html">Login here</a>
        </div>
    </div>
</body>
</html>
