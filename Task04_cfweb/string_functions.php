<?php
/* ===================================
   PART B: PHP STRING FUNCTIONS
   string_functions.php
   =================================== */

// Store output in a variable to display later
$output = "";

// ========================================
// SECTION 1: BASIC STRING FUNCTIONS
// ========================================

$output .= "<h2>📝 BASIC STRING FUNCTIONS</h2>";

// Test strings
$test_string = "Brew Haven Cafe";
$test_message = "Welcome to our wonderful cafe experience!";
$user_input = "  John Doe  ";

// strlen() - Get string length
$output .= "<section style='background:#fff9c4; padding:20px; margin:15px 0; border-radius:5px;'>";
$output .= "<h3>1️⃣ strlen() - Get String Length</h3>";
$output .= "<p><strong>Syntax:</strong> <code>strlen(\$string)</code></p>";
$output .= "<p><strong>Input:</strong> \"" . htmlspecialchars($test_string) . "\"</p>";
$output .= "<p><strong>Output:</strong> " . strlen($test_string) . " characters</p>";
$output .= "<p><strong>Use:</strong> Returns the length of a string</p>";
$output .= "</section>";

// str_word_count() - Count words
$output .= "<section style='background:#e1f5fe; padding:20px; margin:15px 0; border-radius:5px;'>";
$output .= "<h3>2️⃣ str_word_count() - Count Words</h3>";
$output .= "<p><strong>Syntax:</strong> <code>str_word_count(\$string)</code></p>";
$output .= "<p><strong>Input:</strong> \"" . htmlspecialchars($test_message) . "\"</p>";
$output .= "<p><strong>Output:</strong> " . str_word_count($test_message) . " words</p>";
$output .= "<p><strong>Use:</strong> Counts the number of words in a string</p>";
$output .= "</section>";

// strrev() - Reverse string
$output .= "<section style='background:#f3e5f5; padding:20px; margin:15px 0; border-radius:5px;'>";
$output .= "<h3>3️⃣ strrev() - Reverse String</h3>";
$output .= "<p><strong>Syntax:</strong> <code>strrev(\$string)</code></p>";
$output .= "<p><strong>Input:</strong> \"" . htmlspecialchars($test_string) . "\"</p>";
$output .= "<p><strong>Output:</strong> \"" . htmlspecialchars(strrev($test_string)) . "\"</p>";
$output .= "<p><strong>Use:</strong> Reverses a string</p>";
$output .= "</section>";

// ========================================
// SECTION 2: CASE CONVERSION FUNCTIONS
// ========================================

$output .= "<h2>🔤 CASE CONVERSION FUNCTIONS</h2>";

// strtoupper() - Convert to uppercase
$output .= "<section style='background:#fce4ec; padding:20px; margin:15px 0; border-radius:5px;'>";
$output .= "<h3>4️⃣ strtoupper() - Convert to Uppercase</h3>";
$output .= "<p><strong>Syntax:</strong> <code>strtoupper(\$string)</code></p>";
$output .= "<p><strong>Input:</strong> \"" . htmlspecialchars($test_string) . "\"</p>";
$output .= "<p><strong>Output:</strong> \"" . htmlspecialchars(strtoupper($test_string)) . "\"</p>";
$output .= "<p><strong>Use:</strong> Converts all characters to uppercase</p>";
$output .= "</section>";

// strtolower() - Convert to lowercase
$output .= "<section style='background:#c8e6c9; padding:20px; margin:15px 0; border-radius:5px;'>";
$output .= "<h3>5️⃣ strtolower() - Convert to Lowercase</h3>";
$output .= "<p><strong>Syntax:</strong> <code>strtolower(\$string)</code></p>";
$output .= "<p><strong>Input:</strong> \"" . htmlspecialchars($test_string) . "\"</p>";
$output .= "<p><strong>Output:</strong> \"" . htmlspecialchars(strtolower($test_string)) . "\"</p>";
$output .= "<p><strong>Use:</strong> Converts all characters to lowercase</p>";
$output .= "</section>";

// ucfirst() - Uppercase first character
$output .= "<section style='background:#bbdefb; padding:20px; margin:15px 0; border-radius:5px;'>";
$output .= "<h3>6️⃣ ucfirst() - Uppercase First Character</h3>";
$output .= "<p><strong>Syntax:</strong> <code>ucfirst(\$string)</code></p>";
$output .= "<p><strong>Input:</strong> \"" . htmlspecialchars($user_input) . "\"</p>";
$output .= "<p><strong>Output:</strong> \"" . htmlspecialchars(ucfirst(trim($user_input))) . "\"</p>";
$output .= "<p><strong>Use:</strong> Capitalizes the first character</p>";
$output .= "</section>";

// ucwords() - Uppercase first character of each word
$output .= "<section style='background:#ffecb3; padding:20px; margin:15px 0; border-radius:5px;'>";
$output .= "<h3>7️⃣ ucwords() - Uppercase First Character of Each Word</h3>";
$output .= "<p><strong>Syntax:</strong> <code>ucwords(\$string)</code></p>";
$output .= "<p><strong>Input:</strong> \"" . htmlspecialchars(strtolower($test_message)) . "\"</p>";
$output .= "<p><strong>Output:</strong> \"" . htmlspecialchars(ucwords(strtolower($test_message))) . "\"</p>";
$output .= "<p><strong>Use:</strong> Capitalizes first character of each word</p>";
$output .= "</section>";

// ========================================
// SECTION 3: SEARCH & REPLACE FUNCTIONS
// ========================================

$output .= "<h2>🔎 SEARCH & REPLACE FUNCTIONS</h2>";

// strpos() - Find substring position
$test_search = "The password is secret123";
$output .= "<section style='background:#e0f2f1; padding:20px; margin:15px 0; border-radius:5px;'>";
$output .= "<h3>8️⃣ strpos() - Find Substring Position</h3>";
$output .= "<p><strong>Syntax:</strong> <code>strpos(\$haystack, \$needle)</code></p>";
$output .= "<p><strong>Input String:</strong> \"" . htmlspecialchars($test_search) . "\"</p>";
$output .= "<p><strong>Search for:</strong> \"password\"</p>";
$pos = strpos($test_search, "password");
$output .= "<p><strong>Output:</strong> Position " . ($pos !== false ? $pos : "NOT FOUND") . "</p>";
$output .= "<p><strong>Use:</strong> Finds the position of substring (returns 0-based index or FALSE)</p>";
$output .= "</section>";

// str_replace() - Replace substring
$original_message = "Coffee is delicious and coffee is healthy!";
$output .= "<section style='background:#f1f8e9; padding:20px; margin:15px 0; border-radius:5px;'>";
$output .= "<h3>9️⃣ str_replace() - Replace Substring</h3>";
$output .= "<p><strong>Syntax:</strong> <code>str_replace(\$find, \$replace, \$string)</code></p>";
$output .= "<p><strong>Original:</strong> \"" . htmlspecialchars($original_message) . "\"</p>";
$replaced_message = str_replace("coffee", "tea", $original_message);
$output .= "<p><strong>After Replacement:</strong> \"" . htmlspecialchars($replaced_message) . "\"</p>";
$output .= "<p><strong>Use:</strong> Replaces all occurrences of a substring (case-sensitive)</p>";
$output .= "</section>";

// ========================================
// SECTION 4: SUBSTRING & TRIMMING FUNCTIONS
// ========================================

$output .= "<h2>✂️ SUBSTRING & TRIMMING FUNCTIONS</h2>";

// substr() - Extract substring
$email_test = "customer@cafewebsite.com";
$output .= "<section style='background:#ede7f6; padding:20px; margin:15px 0; border-radius:5px;'>";
$output .= "<h3>1️⃣0️⃣ substr() - Extract Substring</h3>";
$output .= "<p><strong>Syntax:</strong> <code>substr(\$string, \$start, \$length)</code></p>";
$output .= "<p><strong>Input:</strong> \"" . htmlspecialchars($email_test) . "\"</p>";
$substring = substr($email_test, 0, 8);
$output .= "<p><strong>Extract first 8 characters:</strong> \"" . htmlspecialchars($substring) . "\"</p>";
$output .= "<p><strong>Use:</strong> Extracts a portion of a string</p>";
$output .= "</section>";

// trim() - Remove whitespace
$whitespace_string = "  hello world  ";
$output .= "<section style='background:#fce4ec; padding:20px; margin:15px 0; border-radius:5px;'>";
$output .= "<h3>1️⃣1️⃣ trim() - Remove Whitespace (Both Sides)</h3>";
$output .= "<p><strong>Syntax:</strong> <code>trim(\$string)</code></p>";
$output .= "<p><strong>Input:</strong> \"" . htmlspecialchars($whitespace_string) . "\"</p>";
$output .= "<p><strong>Output:</strong> \"" . htmlspecialchars(trim($whitespace_string)) . "\"</p>";
$output .= "<p><strong>Use:</strong> Removes whitespace from both beginning and end</p>";
$output .= "</section>";

// ltrim() - Remove left whitespace
$output .= "<section style='background:#c8e6c9; padding:20px; margin:15px 0; border-radius:5px;'>";
$output .= "<h3>1️⃣2️⃣ ltrim() - Remove Whitespace (Left Side)</h3>";
$output .= "<p><strong>Syntax:</strong> <code>ltrim(\$string)</code></p>";
$output .= "<p><strong>Input:</strong> \"" . htmlspecialchars($whitespace_string) . "\"</p>";
$output .= "<p><strong>Output:</strong> \"" . htmlspecialchars(ltrim($whitespace_string)) . "\"</p>";
$output .= "<p><strong>Use:</strong> Removes whitespace from left side only</p>";
$output .= "</section>";

// rtrim() - Remove right whitespace
$output .= "<section style='background:#bbdefb; padding:20px; margin:15px 0; border-radius:5px;'>";
$output .= "<h3>1️⃣3️⃣ rtrim() - Remove Whitespace (Right Side)</h3>";
$output .= "<p><strong>Syntax:</strong> <code>rtrim(\$string)</code></p>";
$output .= "<p><strong>Input:</strong> \"" . htmlspecialchars($whitespace_string) . "\"</p>";
$output .= "<p><strong>Output:</strong> \"" . htmlspecialchars(rtrim($whitespace_string)) . "\"</p>";
$output .= "<p><strong>Use:</strong> Removes whitespace from right side only</p>";
$output .= "</section>";

// ========================================
// SECTION 5: STRING COMPARISON FUNCTIONS
// ========================================

$output .= "<h2>🔄 STRING COMPARISON FUNCTIONS</h2>";

// strcmp() - Compare strings (case-sensitive)
$string1 = "Coffee";
$string2 = "Coffee";
$string3 = "coffee";
$output .= "<section style='background:#fff3e0; padding:20px; margin:15px 0; border-radius:5px;'>";
$output .= "<h3>1️⃣4️⃣ strcmp() - Compare Strings (Case-Sensitive)</h3>";
$output .= "<p><strong>Syntax:</strong> <code>strcmp(\$string1, \$string2)</code></p>";
$output .= "<p><strong>Returns:</strong> 0 if equal, negative if first < second, positive if first > second</p>";
$comp1 = strcmp($string1, $string2);
$comp2 = strcmp($string1, $string3);
$output .= "<p><strong>strcmp('$string1', '$string2'):</strong> " . $comp1 . " (Equal)</p>";
$output .= "<p><strong>strcmp('$string1', '$string3'):</strong> " . $comp2 . " (Not Equal - different case)</p>";
$output .= "<p><strong>Use:</strong> Case-sensitive string comparison</p>";
$output .= "</section>";

// strcasecmp() - Compare strings (case-insensitive)
$output .= "<section style='background:#f8bbd0; padding:20px; margin:15px 0; border-radius:5px;'>";
$output .= "<h3>1️⃣5️⃣ strcasecmp() - Compare Strings (Case-Insensitive)</h3>";
$output .= "<p><strong>Syntax:</strong> <code>strcasecmp(\$string1, \$string2)</code></p>";
$comp3 = strcasecmp($string1, $string3);
$output .= "<p><strong>strcasecmp('$string1', '$string3'):</strong> " . $comp3 . " (Equal - ignores case)</p>";
$output .= "<p><strong>Use:</strong> Case-insensitive string comparison</p>";
$output .= "</section>";

// ========================================
// SECTION 6: SECURITY FUNCTIONS
// ========================================

$output .= "<h2>🔒 SECURITY FUNCTIONS</h2>";

// htmlspecialchars() - Escape HTML characters
$user_input_2 = '<script>alert("XSS Attack")</script>';
$output .= "<section style='background:#ffccbc; padding:20px; margin:15px 0; border-radius:5px;'>";
$output .= "<h3>1️⃣6️⃣ htmlspecialchars() - Escape HTML Special Characters</h3>";
$output .= "<p><strong>Syntax:</strong> <code>htmlspecialchars(\$string)</code></p>";
$output .= "<p><strong>Input:</strong> " . htmlspecialchars($user_input_2) . "</p>";
$output .= "<p><strong>Output:</strong> " . htmlspecialchars(htmlspecialchars($user_input_2)) . "</p>";
$output .= "<p><strong>Use:</strong> Prevents XSS attacks by converting special characters</p>";
$output .= "</section>";

// addslashes() - Add backslashes
$user_quote = "It's a wonderful day";
$output .= "<section style='background:#d1c4e9; padding:20px; margin:15px 0; border-radius:5px;'>";
$output .= "<h3>1️⃣7️⃣ addslashes() - Add Backslashes Before Special Characters</h3>";
$output .= "<p><strong>Syntax:</strong> <code>addslashes(\$string)</code></p>";
$output .= "<p><strong>Input:</strong> \"" . htmlspecialchars($user_quote) . "\"</p>";
$output .= "<p><strong>Output:</strong> \"" . htmlspecialchars(addslashes($user_quote)) . "\"</p>";
$output .= "<p><strong>Use:</strong> Escapes quotes for database queries (use prepared statements instead!)</p>";
$output .= "</section>";

// ========================================
// SECTION 7: ECHO & PRINT DEMONSTRATION
// ========================================

$output .= "<h2>📢 OUTPUT FUNCTIONS (ECHO & PRINT)</h2>";

$output .= "<section style='background:#e0f2f1; padding:20px; margin:15px 0; border-radius:5px;'>";
$output .= "<h3>1️⃣8️⃣ echo - Output Text</h3>";
$output .= "<p><strong>Syntax:</strong> <code>echo \$variable;</code></p>";
$output .= "<p><strong>Characteristics:</strong></p>";
$output .= "<ul>";
$output .= "<li>✅ No return value</li>";
$output .= "<li>✅ Slightly faster than print</li>";
$output .= "<li>✅ Can take multiple parameters: echo \"Hello\", \" \", \"World\";</li>";
$output .= "<li>✅ Most commonly used for output</li>";
$output .= "</ul>";
$output .= "</section>";

$output .= "<section style='background:#f3e5f5; padding:20px; margin:15px 0; border-radius:5px;'>";
$output .= "<h3>1️⃣9️⃣ print - Output Text</h3>";
$output .= "<p><strong>Syntax:</strong> <code>print \$variable;</code></p>";
$output .= "<p><strong>Characteristics:</strong></p>";
$output .= "<ul>";
$output .= "<li>✅ Similar to echo (slightly slower)</li>";
$output .= "<li>✅ Can only take one argument</li>";
$output .= "<li>✅ Has a return value of 1</li>";
$output .= "<li>✅ Can be used in expressions: <code>\$result = print \"Hello\";</code></li>";
$output .= "</ul>";
$output .= "</section>";

$output .= "<section style='background:#fff3e0; padding:20px; margin:15px 0; border-radius:5px;'>";
$output .= "<h3>2️⃣0️⃣ die() - Terminate Script Execution</h3>";
$output .= "<p><strong>Syntax:</strong> <code>die(\$message);</code> or <code>exit(\$message);</code></p>";
$output .= "<p><strong>Use:</strong> Stops script execution immediately</p>";
$output .= "<p><strong>Common Uses:</strong></p>";
$output .= "<ul>";
$output .= "<li>Database connection errors: <code>if (\$conn->connect_error) die(\"Connection failed\");</code></li>";
$output .= "<li>Validation failures: <code>if (empty(\$username)) die(\"Username required\");</code></li>";
$output .= "<li>Authentication failures: <code>if (!authorized) die(\"Access denied\");</code></li>";
$output .= "</ul>";
$output .= "</section>";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP String Functions - Complete Demonstration</title>
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
            margin-top: 40px;
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
        }
        
        li {
            margin: 5px 0;
            color: #555;
        }
        
        code {
            background: #f5f5f5;
            padding: 2px 6px;
            border-radius: 3px;
            font-family: 'Courier New', monospace;
            color: #d63384;
            font-size: 0.9em;
        }
        
        section {
            margin: 15px 0;
        }
        
        strong {
            color: #333;
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
        
        .summary-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background: #f9f9f9;
            border-radius: 5px;
            overflow: hidden;
        }
        
        .summary-table th {
            background: #667eea;
            color: white;
            padding: 12px;
            text-align: left;
        }
        
        .summary-table td {
            padding: 10px 12px;
            border-bottom: 1px solid #ddd;
        }
        
        .summary-table tr:hover {
            background: #f0f8ff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>📚 PHP String Functions - Complete Demonstration</h1>
        <p style="text-align:center; background:#e8f4f8; padding:15px; border-radius:5px; margin-bottom:30px;">
            <strong>🎯 Objective:</strong> Demonstrate all required string functions from the lab task
        </p>
        
        <?php
        // Display all the generated output
        echo $output;
        ?>
        
        <div class="nav-links">
            <a href="index.html">← Back to Home</a>
            <a href="variables_scope.php">← Variables & Scope</a>
            <a href="register.html">Register</a>
            <a href="login.html">Login</a>
        </div>
    </div>
</body>
</html>
