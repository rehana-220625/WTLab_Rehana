<?php
/* ===============================================
   PHP FILE FUNCTIONS DEMONSTRATION
   Complete showcase of all file functions
   =============================================== */

$demo_dir = __DIR__ . '/demo_files';
$output = "";

// Create demo directory if it doesn't exist
if (!is_dir($demo_dir)) {
    mkdir($demo_dir, 0777, true);
}

// ========================================
// SECTION 1: FILE READ/WRITE FUNCTIONS
// ========================================

$output .= "<h2>📖 FILE READ/WRITE FUNCTIONS</h2>";
$output .= "<section style='background:#fff9c4; padding:20px; margin:15px 0; border-radius:5px;'>";

// 1. fopen(), fwrite(), fclose() - Write to file
$test_file = $demo_dir . '/test_write.txt';
$output .= "<h3>1️⃣ fopen() + fwrite() + fclose() - Write to File</h3>";
$output .= "<p><strong>Mode 'w':</strong> Write only (erases old content)</p>";

$handle = fopen($test_file, 'w');
if ($handle) {
    $content = "Hello from fwrite()!\nThis is line 2.\nFile created at: " . date('Y-m-d H:i:s');
    fwrite($handle, $content);
    fclose($handle);
    $output .= "<p>✅ File created and written successfully</p>";
    $output .= "<p><strong>File path:</strong> " . htmlspecialchars($test_file) . "</p>";
} else {
    $output .= "<p>❌ Error opening file for writing</p>";
}

$output .= "</section>";

// 2. fopen(), fread(), fclose() - Read from file
$output .= "<section style='background:#e1f5fe; padding:20px; margin:15px 0; border-radius:5px;'>";
$output .= "<h3>2️⃣ fopen() + fread() + fclose() - Read from File</h3>";
$output .= "<p><strong>Mode 'r':</strong> Read only</p>";

if (file_exists($test_file)) {
    $handle = fopen($test_file, 'r');
    if ($handle) {
        $file_content = fread($handle, filesize($test_file));
        fclose($handle);
        $output .= "<p><strong>File content:</strong></p>";
        $output .= "<pre style='background:#f5f5f5; padding:10px; border-left:4px solid #2196f3;'>" . htmlspecialchars($file_content) . "</pre>";
    }
}

$output .= "</section>";

// 3. file_get_contents() - Read entire file
$output .= "<section style='background:#f3e5f5; padding:20px; margin:15px 0; border-radius:5px;'>";
$output .= "<h3>3️⃣ file_get_contents() - Read Entire File at Once</h3>";
$output .= "<p><strong>Advantage:</strong> Simpler than fopen/fread for small files</p>";

if (file_exists($test_file)) {
    $content = file_get_contents($test_file);
    $output .= "<p>✅ File read successfully</p>";
    $output .= "<p><strong>Content length:</strong> " . strlen($content) . " bytes</p>";
}

$output .= "</section>";

// 4. file_put_contents() - Write to file (simpler method)
$append_file = $demo_dir . '/test_append.txt';
$output .= "<section style='background:#c8e6c9; padding:20px; margin:15px 0; border-radius:5px;'>";
$output .= "<h3>4️⃣ file_put_contents() - Write to File (Simple)</h3>";
$output .= "<p><strong>Advantage:</strong> No need for fopen/fclose</p>";

$new_content = "Line 1: Created with file_put_contents()\nLine 2: No fopen needed!\n";
if (file_put_contents($append_file, $new_content)) {
    $output .= "<p>✅ File written successfully</p>";
}

// Append to file using FILE_APPEND flag
if (file_put_contents($append_file, "Appended line at " . date('H:i:s') . "\n", FILE_APPEND)) {
    $output .= "<p>✅ Content appended successfully</p>";
}

$output .= "</section>";

// 5. file() - Read file into array
$output .= "<section style='background:#bbdefb; padding:20px; margin:15px 0; border-radius:5px;'>";
$output .= "<h3>5️⃣ file() - Read File into Array (Line by Line)</h3>";
$output .= "<p><strong>Advantage:</strong> Each line becomes an array element</p>";

if (file_exists($append_file)) {
    $lines = file($append_file);
    $output .= "<p><strong>Total lines:</strong> " . count($lines) . "</p>";
    $output .= "<p><strong>Line contents:</strong></p>";
    $output .= "<ul>";
    foreach ($lines as $index => $line) {
        $output .= "<li>Line " . ($index + 1) . ": " . htmlspecialchars(trim($line)) . "</li>";
    }
    $output .= "</ul>";
}

$output .= "</section>";

// ========================================
// SECTION 2: FILE INFORMATION FUNCTIONS
// ========================================

$output .= "<h2>ℹ️ FILE INFORMATION FUNCTIONS</h2>";

$output .= "<section style='background:#e0f2f1; padding:20px; margin:15px 0; border-radius:5px;'>";
$output .= "<h3>6️⃣ file_exists() - Check if File Exists</h3>";

if (file_exists($test_file)) {
    $output .= "<p>✅ File exists: " . htmlspecialchars($test_file) . "</p>";
} else {
    $output .= "<p>❌ File does not exist</p>";
}

$output .= "</section>";

$output .= "<section style='background:#fff3e0; padding:20px; margin:15px 0; border-radius:5px;'>";
$output .= "<h3>7️⃣ filesize() - Get File Size</h3>";

if (file_exists($test_file)) {
    $size = filesize($test_file);
    $output .= "<p><strong>Size in bytes:</strong> " . $size . "</p>";
    $output .= "<p><strong>Size formatted:</strong> " . format_filesize($size) . "</p>";
}

function format_filesize($bytes) {
    $units = array('B', 'KB', 'MB', 'GB');
    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);
    $bytes /= (1 << (10 * $pow));
    return round($bytes, 2) . ' ' . $units[$pow];
}

$output .= "</section>";

$output .= "<section style='background:#fce4ec; padding:20px; margin:15px 0; border-radius:5px;'>";
$output .= "<h3>8️⃣ filetype() - Get File Type</h3>";

if (file_exists($test_file)) {
    $type = filetype($test_file);
    $output .= "<p><strong>File type:</strong> " . htmlspecialchars($type) . "</p>";
}

$output .= "</section>";

$output .= "<section style='background:#d1c4e9; padding:20px; margin:15px 0; border-radius:5px;'>";
$output .= "<h3>9️⃣ filemtime() - Last Modification Time</h3>";

if (file_exists($test_file)) {
    $mtime = filemtime($test_file);
    $output .= "<p><strong>Last modified:</strong> " . date('Y-m-d H:i:s', $mtime) . "</p>";
}

$output .= "</section>";

$output .= "<section style='background:#ffccbc; padding:20px; margin:15px 0; border-radius:5px;'>";
$output .= "<h3>🔟 filectime() - File Creation Time</h3>";

if (file_exists($test_file)) {
    $ctime = filectime($test_file);
    $output .= "<p><strong>Created:</strong> " . date('Y-m-d H:i:s', $ctime) . "</p>";
}

$output .= "</section>";

$output .= "<section style='background:#c8e6c9; padding:20px; margin:15px 0; border-radius:5px;'>";
$output .= "<h3>1️⃣1️⃣ fileatime() - Last Access Time</h3>";

if (file_exists($test_file)) {
    $atime = fileatime($test_file);
    $output .= "<p><strong>Last accessed:</strong> " . date('Y-m-d H:i:s', $atime) . "</p>";
}

$output .= "</section>";

$output .= "<section style='background:#bbdefb; padding:20px; margin:15px 0; border-radius:5px;'>";
$output .= "<h3>1️⃣2️⃣ fileperms() - File Permissions</h3>";

if (file_exists($test_file)) {
    $perms = fileperms($test_file);
    $output .= "<p><strong>Permissions (octal):</strong> " . substr(sprintf('%o', $perms), -4) . "</p>";
}

$output .= "</section>";

// ========================================
// SECTION 3: FILE/FOLDER MANAGEMENT
// ========================================

$output .= "<h2>🔧 FILE & FOLDER MANAGEMENT FUNCTIONS</h2>";

$output .= "<section style='background:#e8f5e9; padding:20px; margin:15px 0; border-radius:5px;'>";
$output .= "<h3>1️⃣3️⃣ is_file() & is_dir() - Check Type</h3>";

if (file_exists($test_file)) {
    $is_file = is_file($test_file);
    $is_dir = is_dir($test_file);
    $output .= "<p><strong>Is file:</strong> " . ($is_file ? "✅ Yes" : "❌ No") . "</p>";
    $output .= "<p><strong>Is directory:</strong> " . ($is_dir ? "✅ Yes" : "❌ No") . "</p>";
}

$output .= "</section>";

$output .= "<section style='background:#f1f8e9; padding:20px; margin:15px 0; border-radius:5px;'>";
$output .= "<h3>1️⃣4️⃣ is_readable() & is_writable() - Check Permissions</h3>";

if (file_exists($test_file)) {
    $readable = is_readable($test_file);
    $writable = is_writable($test_file);
    $output .= "<p><strong>Is readable:</strong> " . ($readable ? "✅ Yes" : "❌ No") . "</p>";
    $output .= "<p><strong>Is writable:</strong> " . ($writable ? "✅ Yes" : "❌ No") . "</p>";
}

$output .= "</section>";

$output .= "<section style='background:#fff3e0; padding:20px; margin:15px 0; border-radius:5px;'>";
$output .= "<h3>1️⃣5️⃣ copy() - Copy File</h3>";

$copy_file = $demo_dir . '/test_copy.txt';
if (file_exists($test_file) && !file_exists($copy_file)) {
    if (copy($test_file, $copy_file)) {
        $output .= "<p>✅ File copied successfully</p>";
        $output .= "<p><strong>From:</strong> " . htmlspecialchars(basename($test_file)) . "</p>";
        $output .= "<p><strong>To:</strong> " . htmlspecialchars(basename($copy_file)) . "</p>";
    }
}

$output .= "</section>";

$output .= "<section style='background:#f3e5f5; padding:20px; margin:15px 0; border-radius:5px;'>";
$output .= "<h3>1️⃣6️⃣ rename() - Rename File</h3>";

$rename_file = $demo_dir . '/test_renamed.txt';
if (file_exists($copy_file) && !file_exists($rename_file)) {
    if (rename($copy_file, $rename_file)) {
        $output .= "<p>✅ File renamed successfully</p>";
        $output .= "<p><strong>From:</strong> " . htmlspecialchars(basename($copy_file)) . "</p>";
        $output .= "<p><strong>To:</strong> " . htmlspecialchars(basename($rename_file)) . "</p>";
    }
}

$output .= "</section>";

// ========================================
// SECTION 4: DIRECTORY HANDLING
// ========================================

$output .= "<h2>📂 DIRECTORY HANDLING FUNCTIONS</h2>";

$output .= "<section style='background:#e3f2fd; padding:20px; margin:15px 0; border-radius:5px;'>";
$output .= "<h3>1️⃣7️⃣ getcwd() - Get Current Working Directory</h3>";

$cwd = getcwd();
$output .= "<p><strong>Current Directory:</strong> " . htmlspecialchars($cwd) . "</p>";

$output .= "</section>";

$output .= "<section style='background:#fce4ec; padding:20px; margin:15px 0; border-radius:5px;'>";
$output .= "<h3>1️⃣8️⃣ scandir() - List Directory Contents</h3>";

if (is_dir($demo_dir)) {
    $files = scandir($demo_dir);
    $files = array_diff($files, array('.', '..'));
    
    $output .= "<p><strong>Files in demo directory:</strong></p>";
    $output .= "<ul>";
    foreach ($files as $file) {
        $full_path = $demo_dir . '/' . $file;
        $type = is_file($full_path) ? "📄" : "📁";
        $output .= "<li>$type " . htmlspecialchars($file) . "</li>";
    }
    $output .= "</ul>";
}

$output .= "</section>";

$output .= "<section style='background:#c8e6c9; padding:20px; margin:15px 0; border-radius:5px;'>";
$output .= "<h3>1️⃣9️⃣ opendir() + readdir() + closedir() - Manual Directory Reading</h3>";

if (is_dir($demo_dir)) {
    $dir_handle = opendir($demo_dir);
    $output .= "<p><strong>Using opendir() + readdir() + closedir():</strong></p>";
    $output .= "<ul>";
    
    if ($dir_handle) {
        while (($file = readdir($dir_handle)) !== false) {
            if ($file !== '.' && $file !== '..') {
                $output .= "<li>" . htmlspecialchars($file) . "</li>";
            }
        }
        closedir($dir_handle);
    }
    
    $output .= "</ul>";
}

$output .= "</section>";

// ========================================
// SECTION 5: FILE MODES DEMONSTRATION
// ========================================

$output .= "<h2>📝 FILE OPEN MODES DEMONSTRATION</h2>";

$output .= "<section style='background:#fff9c4; padding:20px; margin:15px 0; border-radius:5px;'>";
$output .= "<h3>2️⃣0️⃣ File Modes with fopen()</h3>";

$modes_info = array(
    'r' => 'Read only (file pointer at beginning)',
    'r+' => 'Read & Write (file pointer at beginning)',
    'w' => 'Write only (truncates file, creates if not exists)',
    'w+' => 'Read & Write (truncates file, creates if not exists)',
    'a' => 'Append only (file pointer at end, creates if not exists)',
    'a+' => 'Read & Append (file pointer at end, creates if not exists)',
    'x' => 'Create & Write (fails if file exists)',
    'x+' => 'Create & Read/Write (fails if file exists)',
    'c' => 'Character mode (for non-binary files)',
    't' => 'Text mode (for text files)',
    'b' => 'Binary mode (for binary files)'
);

$output .= "<table style='width:100%; border-collapse:collapse; background:white;'>";
$output .= "<tr style='background:#667eea; color:white;'><th style='padding:10px; text-align:left;'>Mode</th><th style='padding:10px; text-align:left;'>Description</th></tr>";

foreach ($modes_info as $mode => $description) {
    $output .= "<tr style='border-bottom:1px solid #ddd;'>";
    $output .= "<td style='padding:10px;'><code>" . htmlspecialchars($mode) . "</code></td>";
    $output .= "<td style='padding:10px;'>" . htmlspecialchars($description) . "</td>";
    $output .= "</tr>";
}

$output .= "</table>";
$output .= "</section>";

// ========================================
// SUMMARY TABLE
// ========================================

$output .= "<h2>📊 FUNCTION SUMMARY TABLE</h2>";
$output .= "<section style='background:#eceff1; padding:20px; margin:15px 0; border-radius:5px;'>";

$functions_summary = array(
    'File Reading' => array(
        'fopen()' => 'Open file handle',
        'fread()' => 'Read from file',
        'fclose()' => 'Close file handle',
        'file_get_contents()' => 'Read entire file',
        'file()' => 'Read file into array'
    ),
    'File Writing' => array(
        'fwrite()' => 'Write to file',
        'file_put_contents()' => 'Write/append to file'
    ),
    'File Info' => array(
        'file_exists()' => 'Check if file exists',
        'filesize()' => 'Get file size',
        'filetype()' => 'Get file type',
        'filemtime()' => 'Get modification time',
        'filectime()' => 'Get creation time',
        'fileatime()' => 'Get access time',
        'fileperms()' => 'Get permissions'
    ),
    'File Operations' => array(
        'copy()' => 'Copy file',
        'rename()' => 'Rename file',
        'unlink()' => 'Delete file',
        'is_file()' => 'Check if file',
        'is_dir()' => 'Check if directory',
        'is_readable()' => 'Check if readable',
        'is_writable()' => 'Check if writable'
    ),
    'Directory Operations' => array(
        'scandir()' => 'List directory',
        'opendir()' => 'Open directory',
        'readdir()' => 'Read directory entry',
        'closedir()' => 'Close directory',
        'getcwd()' => 'Get current directory',
        'chdir()' => 'Change directory',
        'mkdir()' => 'Create directory',
        'rmdir()' => 'Remove directory'
    )
);

foreach ($functions_summary as $category => $functions) {
    $output .= "<h4>$category</h4>";
    $output .= "<table style='width:100%; border-collapse:collapse; margin-bottom:20px;'>";
    
    foreach ($functions as $func => $desc) {
        $output .= "<tr style='border-bottom:1px solid #ddd;'>";
        $output .= "<td style='padding:8px; width:200px;'><code style='background:#f5f5f5; padding:3px 5px;'>" . htmlspecialchars($func) . "</code></td>";
        $output .= "<td style='padding:8px;'>" . htmlspecialchars($desc) . "</td>";
        $output .= "</tr>";
    }
    
    $output .= "</table>";
}

$output .= "</section>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP File Functions - Complete Demonstration</title>
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
            max-width: 1000px;
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
        
        h4 {
            color: #555;
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
        
        pre {
            background: #f5f5f5;
            padding: 10px;
            border-left: 4px solid #667eea;
            overflow-x: auto;
            margin: 10px 0;
        }
        
        code {
            background: #f5f5f5;
            padding: 2px 6px;
            border-radius: 3px;
            font-family: 'Courier New', monospace;
        }
        
        section {
            margin: 15px 0;
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
        
        table {
            border-collapse: collapse;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>📚 PHP File Functions - Complete Demonstration</h1>
        
        <?php echo $output; ?>
        
        <div class="nav-links">
            <a href="index.php">← Back to File Manager</a>
        </div>
    </div>
</body>
</html>
