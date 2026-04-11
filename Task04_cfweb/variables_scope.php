<?php
/* ===================================
   PART A: PHP VARIABLES & SCOPE
   variables_scope.php
   =================================== */

// Store output in a variable to display later
$output = "";

// ========================================
// SECTION 1: DATATYPES DEMONSTRATION
// ========================================

$output .= "<h2>📊 PHP DATATYPES DEMONSTRATION</h2>";
$output .= "<section style='background:#f0f8ff; padding:20px; margin:20px 0; border-radius:5px;'>";

// 1. STRING - Text data
$cafe_name = "Brew Haven Cafe";
$message = "Welcome to our cafe!";
$output .= "<h3>1️⃣ String Datatype</h3>";
$output .= "<p><strong>Variable:</strong> \$cafe_name = \"" . htmlspecialchars($cafe_name) . "\"</p>";
$output .= "<p><strong>Type:</strong> " . gettype($cafe_name) . "</p>";
$output .= "<p><strong>Length:</strong> " . strlen($cafe_name) . " characters</p>";

// 2. INTEGER - Whole numbers
$daily_orders = 45;
$cafe_age = 15;
$output .= "<h3>2️⃣ Integer Datatype</h3>";
$output .= "<p><strong>Variable:</strong> \$daily_orders = " . $daily_orders . "</p>";
$output .= "<p><strong>Type:</strong> " . gettype($daily_orders) . "</p>";
$output .= "<p><strong>Value Range:</strong> Whole numbers without decimals</p>";

// 3. FLOAT - Decimal numbers
$coffee_price = 4.99;
$discount_percentage = 15.5;
$output .= "<h3>3️⃣ Float Datatype</h3>";
$output .= "<p><strong>Variable:</strong> \$coffee_price = " . $coffee_price . "</p>";
$output .= "<p><strong>Type:</strong> " . gettype($coffee_price) . "</p>";
$output .= "<p><strong>Use:</strong> Decimal numbers and prices</p>";

// 4. BOOLEAN - True/False
$is_open = true;
$is_holiday = false;
$output .= "<h3>4️⃣ Boolean Datatype</h3>";
$output .= "<p><strong>Variable:</strong> \$is_open = " . ($is_open ? "true" : "false") . "</p>";
$output .= "<p><strong>Type:</strong> " . gettype($is_open) . "</p>";
$output .= "<p><strong>Use:</strong> Simple true/false conditions</p>";

// 5. ARRAY - Collection of data
$menu_items = array("Coffee", "Tea", "Pastries", "Sandwiches", "Desserts");
$prices = ["Latte" => 4.99, "Espresso" => 3.99, "Cappuccino" => 5.49];
$output .= "<h3>5️⃣ Array Datatype</h3>";
$output .= "<p><strong>Indexed Array:</strong></p>";
$output .= "<ul>";
foreach ($menu_items as $item) {
    $output .= "<li>" . htmlspecialchars($item) . "</li>";
}
$output .= "</ul>";
$output .= "<p><strong>Associative Array (Key-Value):</strong></p>";
$output .= "<ul>";
foreach ($prices as $drink => $price) {
    $output .= "<li>" . htmlspecialchars($drink) . " - \$" . $price . "</li>";
}
$output .= "</ul>";

$output .= "</section>";

// ========================================
// SECTION 2: VARIABLE SCOPE
// ========================================

$output .= "<h2>🔍 VARIABLE SCOPE DEMONSTRATION</h2>";

// GLOBAL SCOPE - Accessible everywhere
$global_cafe_status = "OPEN";
$global_temperature = 72; // degrees

// LOCAL SCOPE - Only inside functions
function check_local_scope() {
    $local_message = "This variable is LOCAL to this function only!";
    $local_counter = 10;
    
    $output = "<h3>📍 LOCAL SCOPE</h3>";
    $output .= "<p><strong>Local Variable:</strong> \$local_message</p>";
    $output .= "<p><strong>Value:</strong> \"" . htmlspecialchars($local_message) . "\"</p>";
    $output .= "<p><strong>Local Counter:</strong> " . $local_counter . "</p>";
    $output .= "<p style='color:red;'><strong>❌ Cannot access \$global_cafe_status here without 'global' keyword!</strong></p>";
    $output .= "<p style='background:yellow; padding:10px; border-radius:5px;'>";
    $output .= "💡 Try to use \$global_cafe_status inside this function → \$global_cafe_status is NOT accessible!";
    $output .= "</p>";
    
    return $output;
}

// GLOBAL SCOPE - Access with 'global' keyword inside functions
function access_global_variables() {
    global $global_cafe_status, $global_temperature;
    
    $local_message = "I am a local variable in this function";
    
    $output = "<h3>🌍 GLOBAL SCOPE</h3>";
    $output .= "<p><strong>Global Variables (accessed with 'global' keyword):</strong></p>";
    $output .= "<ul>";
    $output .= "<li>\$global_cafe_status = \"" . htmlspecialchars($global_cafe_status) . "\"</li>";
    $output .= "<li>\$global_temperature = " . $global_temperature . "°F</li>";
    $output .= "</ul>";
    $output .= "<p><strong>Local Variable:</strong> \"" . htmlspecialchars($local_message) . "\"</p>";
    $output .= "<p style='background:#e8f5e9; padding:10px; border-radius:5px;'>";
    $output .= "✅ <strong>Global variables are accessible inside functions when declared with 'global' keyword</strong>";
    $output .= "</p>";
    
    return $output;
}

// STATIC SCOPE - Value retained across function calls
$static_call_count = 0;

function demonstrate_static_variable() {
    // Static variable - retains value between function calls
    static $static_counter = 0;
    $static_counter++;
    
    // Local variable - resets each time function is called
    static $visit_count = 0;
    $visit_count++;
    
    return $static_counter;
}

$output .= "<section style='background:#fff3e0; padding:20px; margin:20px 0; border-radius:5px;'>";
$output .= check_local_scope();
$output .= "</section>";

$output .= "<section style='background:#e3f2fd; padding:20px; margin:20px 0; border-radius:5px;'>";
$output .= access_global_variables();
$output .= "</section>";

$output .= "<section style='background:#f3e5f5; padding:20px; margin:20px 0; border-radius:5px;'>";
$output .= "<h3>🔄 STATIC SCOPE (Value Retained)</h3>";
$output .= "<p><strong>Static variables retain their values across function calls</strong></p>";
$output .= "<p>Call the function multiple times to see the counter increment:</p>";
$output .= "<ul>";
for ($i = 1; $i <= 5; $i++) {
    $counter_value = demonstrate_static_variable();
    $output .= "<li>Function Call #" . $i . " → Static Counter = " . $counter_value . "</li>";
}
$output .= "</ul>";
$output .= "<p style='background:#ffcccc; padding:10px; border-radius:5px;'>";
$output .= "💡 <strong>Notice:</strong> The static counter increments and retains its value!\n";
$output .= "If you refresh this page, the counter resets (session-based).";
$output .= "</p>";
$output .= "</section>";

// ========================================
// SECTION 3: SUPERGLOBAL VARIABLE
// ========================================

$output .= "<h2>🌐 SUPERGLOBAL VARIABLE EXAMPLE</h2>";
$output .= "<section style='background:#e0f2f1; padding:20px; margin:20px 0; border-radius:5px;'>";
$output .= "<h3>$_SERVER (Superglobal)</h3>";
$output .= "<p><strong>Request Method:</strong> " . htmlspecialchars($_SERVER['REQUEST_METHOD']) . "</p>";
$output .= "<p><strong>Current Script:</strong> " . htmlspecialchars($_SERVER['SCRIPT_NAME']) . "</p>";
$output .= "<p><strong>Server Software:</strong> " . htmlspecialchars($_SERVER['SERVER_SOFTWARE']) . "</p>";
$output .= "<p><strong>HTTP Host:</strong> " . htmlspecialchars($_SERVER['HTTP_HOST']) . "</p>";
$output .= "<p style='font-size:0.9em; color:#666;'>✅ Superglobals are accessible everywhere in your script</p>";
$output .= "</section>";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Variables & Scope - Demonstration</title>
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
            padding: 20px;
        }
        
        .container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            padding: 40px;
        }
        
        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #667eea;
            padding-bottom: 15px;
        }
        
        h2 {
            color: #667eea;
            margin-top: 30px;
            margin-bottom: 15px;
        }
        
        h3 {
            color: #333;
            margin: 15px 0 10px 0;
        }
        
        p {
            color: #555;
            margin: 10px 0;
            line-height: 1.6;
        }
        
        ul {
            margin: 10px 0 10px 20px;
            color: #555;
        }
        
        li {
            margin: 5px 0;
        }
        
        section {
            margin: 20px 0;
        }
        
        strong {
            color: #333;
        }
        
        code {
            background: #f5f5f5;
            padding: 2px 6px;
            border-radius: 3px;
            font-family: 'Courier New', monospace;
            color: #d63384;
        }
        
        .nav-links {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            text-align: center;
        }
        
        .nav-links a {
            display: inline-block;
            margin: 0 15px;
            padding: 10px 20px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 600;
            transition: background 0.3s;
        }
        
        .nav-links a:hover {
            background: #764ba2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>📚 PHP Variables & Variable Scope - Complete Demonstration</h1>
        
        <?php
        // Display all the generated output
        echo $output;
        ?>
        
        <div class="nav-links">
            <a href="index.html">← Back to Home</a>
            <a href="string_functions.php">String Functions →</a>
            <a href="register.html">Register</a>
            <a href="login.html">Login</a>
        </div>
    </div>
</body>
</html>
