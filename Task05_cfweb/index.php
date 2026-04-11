<?php
/* ===============================================
   MODERN CAFE WEBSITE
   Customer Portal with Profiles, Orders & Reviews
   =============================================== */

// Get the uploads directory path
$uploads_dir = __DIR__ . '/uploads';

// Ensure uploads directory exists
if (!is_dir($uploads_dir)) {
    mkdir($uploads_dir, 0777, true);
}

// Initialize messages
$upload_message = "";
$error_message = "";
$success_message = "";

// ========================================
// HANDLE FILE UPLOAD
// ========================================
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $filename = basename($file['name']);
    $file_tmp = $file['tmp_name'];
    $file_size = $file['size'];
    $file_error = $file['error'];
    
    // Validate file upload
    if ($file_error === UPLOAD_ERR_OK) {
        // Check file size (max 10MB)
        if ($file_size > 10 * 1024 * 1024) {
            $error_message = "❌ File size exceeds 10MB limit!";
        } else {
            // Sanitize filename
            $filename = preg_replace('/[^a-zA-Z0-9._-]/', '_', $filename);
            $filepath = $uploads_dir . '/' . $filename;
            
            // Move uploaded file to uploads folder
            if (move_uploaded_file($file_tmp, $filepath)) {
                $success_message = "✅ File uploaded successfully: " . htmlspecialchars($filename);
            } else {
                $error_message = "❌ Error moving uploaded file!";
            }
        }
    } else {
        $error_message = "❌ Upload error: " . $file_error;
    }
}

// ========================================
// HANDLE FILE DELETION
// ========================================
if (isset($_GET['delete']) && !empty($_GET['delete'])) {
    $delete_file = basename($_GET['delete']);
    $delete_path = $uploads_dir . '/' . $delete_file;
    
    // Check if file exists and is in uploads directory
    if (file_exists($delete_path) && is_file($delete_path)) {
        if (unlink($delete_path)) {
            $success_message = "✅ File deleted successfully: " . htmlspecialchars($delete_file);
        } else {
            $error_message = "❌ Error deleting file!";
        }
    }
    
    // Redirect to prevent resubmission
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// ========================================
// GET LIST OF FILES
// ========================================
$files = array();
if (is_dir($uploads_dir)) {
    // Using scandir() to list files
    $dir_contents = scandir($uploads_dir);
    
    // Filter out . and ..
    $dir_contents = array_diff($dir_contents, array('.', '..'));
    
    // Build file information array using file functions
    foreach ($dir_contents as $filename) {
        $filepath = $uploads_dir . '/' . $filename;
        
        // Check if it's a file (not directory)
        if (is_file($filepath)) {
            $files[] = array(
                'name' => $filename,
                'path' => $filepath,
                'size' => filesize($filepath),  // Get file size in bytes
                'type' => filetype($filepath),  // Get file type (file, dir, link, etc)
                'modified' => filemtime($filepath),  // Get last modification time
                'created' => filectime($filepath),  // Get file creation time
                'accessed' => fileatime($filepath),  // Get last access time
                'permissions' => fileperms($filepath),  // Get file permissions
                'is_readable' => is_readable($filepath),  // Check if readable
                'is_writable' => is_writable($filepath),  // Check if writable
                'owner_id' => fileowner($filepath),  // Get file owner ID
                'group_id' => filegroup($filepath),  // Get file group ID
                'inode' => fileinode($filepath)  // Get file inode
            );
        }
    }
}

// Sort files by modification time (newer first)
usort($files, function($a, $b) {
    return $b['modified'] - $a['modified'];
});

// ========================================
// HELPER FUNCTIONS
// ========================================

// Format file size (bytes to KB, MB, GB)
function format_filesize($bytes) {
    $units = array('B', 'KB', 'MB', 'GB');
    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);
    $bytes /= (1 << (10 * $pow));
    
    return round($bytes, 2) . ' ' . $units[$pow];
}

// Format timestamp to readable date
function format_date($timestamp) {
    return date('Y-m-d H:i:s', $timestamp);
}

// Format file permissions as octal
function format_permissions($perms) {
    return substr(sprintf('%o', $perms), -4);
}

// Get MIME type
function get_mime_type($filepath) {
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $filepath);
    finfo_close($finfo);
    return $mime;
}

// Get file icon based on extension
function get_file_icon($filename) {
    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    
    $icons = array(
        'pdf' => '📄',
        'jpg' => '🖼️',
        'jpeg' => '🖼️',
        'png' => '🖼️',
        'gif' => '🖼️',
        'zip' => '📦',
        'rar' => '📦',
        '7z' => '📦',
        'txt' => '📝',
        'doc' => '📄',
        'docx' => '📄',
        'xls' => '📊',
        'xlsx' => '📊',
        'ppt' => '🎯',
        'pptx' => '🎯',
        'mp3' => '🎵',
        'mp4' => '🎬',
        'avi' => '🎬',
        'mov' => '🎬',
    );
    
    return isset($icons[$ext]) ? $icons[$ext] : '📁';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brew Haven Cafe - Your Coffee Journey</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5e6d3 0%, #e8d4c0 100%);
            min-height: 100vh;
            padding: 0;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        header {
            background: linear-gradient(135deg, #6f4e37 0%, #8b6f47 100%);
            color: white;
            padding: 40px 20px;
            text-align: center;
            border-bottom: 4px solid #d4a574;
        }
        
        header h1 {
            font-size: 2.8em;
            margin-bottom: 5px;
            letter-spacing: 1px;
        }
        
        header .tagline {
            font-size: 1.1em;
            opacity: 0.95;
            font-style: italic;
            color: #f5e6d3;
        }40px;
        }
        
        .nav-tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 40px;
            border-bottom: 2px solid #e0d5c7;
            flex-wrap: wrap;
        }
        
        .nav-tab {
            padding: 12px 24px;
            background: none;
            border: none;
            font-size: 1em;
            font-weight: 600;
            color: #8b6f47;
            cursor: pointer20px;
        }
        
        label {
            display: block;
            color: #6f4e37;
            font-weight: 600;
            margin-bottom: 8px;
            text-transform: uppercase;
            font-size: 0.9em;
            letter-spacing: 0.5
            color: #6f4e37;
            background: #faf7f2;
        }
        
        .nav-tab.active {
            color: #6f4e37;
            border-bottom-color: #d4a574;
        }
        
        .tab-content {
            display: none;
        }
        
        .tab-content.active {
            display: block;
            animation: fadeIn 0.3s ease-in;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        .section {
            background: #faf7f2;
            padding: 30px;
            border-radius: 12px;
            margin-bottom: 30px;
            border-left: 5px solid #d4a574;
        }
        
        .section h2 {
            color: #6f4e37;
            margin-bottom: 25px;
            font-size: 1.5em;
            display: flex;
            align-items: center;
            gap: 10px
            color: #333;
            margin-bottom: 20px;
            font-size: 1.3em;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        label {
            display: block;
            color: #333;
            font-weight: 600;
            margin-bottom: 8px;
        }
        
        input[type="file"] {
            display: block;
            width: 100%;
            padding: 12px;
            border: 2px dashed #d4a574;
            border-radius: 8px;
            cursor: pointer;
            background: white;
            transition: all 0.3s;
        }
        
        input[type="file"]:focus {
            outline: none;
            border-color: #8b6f47;
            background: #fffbf7;
        }
        
        button {
            padding: 12px 30px;
            background: linear-gradient(135deg, #8b6f47 0%, #6f4e37 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            font-size: 0.95em;
            transition: all 0.3s;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(111, 78, 55, 0.3);
        }
        
        button:active {
            transform: translateY(0);
        }
        
        .message {
            padding: 15px 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            font-size: 0.95em;
            border-left: 4px solid;
        }
        
        .success-message {
            background: #d4edda;
            color: #155724;
            border-left-color: #28a745;
        }
        
        .error-message {
            background: #f8d7da;
            color: #721c24;
            border-left-color: #dc3545;
        }
        
        .files-section h2 {
            color: #6f4e37;
            margin-bottom: 20px;
            font-size: 1.3em;
            border-bottom: 3px solid #d4a574;
            padding-bottom: 10px;
        }
        
        .file-stats {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 25px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            border: 2px solid #e0d5c7;
        }
        
        .stat {
            padding: 15px;
            background: linear-gradient(135deg, #faf7f2 0%, #f5e6d3 100%);
            border-left: 4px solid #d4a574;
            border-radius: 6px;
            text-align: center;
        }
        
        .stat-label {
            color: #8b6f47;
            font-size: 0.85em;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .stat-value {
            color: #6f4e37;
            font-size: 1.8em;
            font-weight: 700;
            margin-top: 8px;
        }
        
        .files-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }
        
        .files-table thead {
            background: linear-gradient(135deg, #8b6f47 0%, #6f4e37 100%);
            color: white;
        }
        
        .files-table th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85em;
            letter-spacing: 0.5px;
        }
        
        .files-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #e0d5c7;
        }
        
        .files-table tbody tr:hover {
            background: #faf7f2;
        }
        
        .file-icon {
            font-size: 1.3em;
            margin-right: 8px;
        }
        
        .file-name {
            color: #6f4e37;
            font-weight: 500;
            word-break: break-all;
        }
        
        .file-size {
            color: #8b6f47;
            font-size: 0.95em;
        }
        
        .file-date {
            color: #b8a896;
            font-size: 0.9em;
            white-space: nowrap;
        }
        
        .file-actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }
        
        .btn-small {
            padding: 8px 14px;
            font-size: 0.8em;
            border-radius: 6px;
            text-decoration: none;
            display: inline-block;
            transition: all 0.2s;
            border: none;
            cursor: pointer;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }
        
        .btn-download {
            background: #28a745;
            color: white;
        }
        
        .btn-download:hover {
            background: #218838;
            transform: translateY(-1px);
        }
        
        .btn-info {
            background: #6f4e37;
            color: white;
        }
        
        .btn-info:hover {
            background: #5a3f2f;
            transform: translateY(-1px);
        }
        
        .btn-delete {
            background: #dc3545;
            color: white;
        }
        
        .btn-delete:hover {
            background: #c82333;
            transform: translateY(-1px);
        }
        
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #b8a896;
        }
        
        .empty-state-icon {
            font-size: 4em;
            margin-bottom: 20px;
        }
        
        .empty-state p {
            font-size: 1.1em;
            color: #8b6f47;
        }
        
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }
        
        .modal.show {
            display: flex;
            align-items: center;
            justify-content: center;
            animation: modalSlideIn 0.3s ease-out;
        }
        
        @keyframes modalSlideIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        
        .modal-content {
            background: white;
            padding: 30px;
            border-radius: 12px;
            max-width: 500px;
            max-height: 80vh;
            overflow-y: auto;
            width: 90%;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            border-left: 5px solid #d4a574;
        }
        
        .modal-header {
            font-size: 1.5em;
            font-weight: 700;
            color: #6f4e37;
            margin-bottom: 20px;
            border-bottom: 2px solid #d4a574;
            padding-bottom: 10px;
        }
        
        .modal-info {
            margin-bottom: 15px;
        }
        
        .modal-info-label {
            color: #8b6f47;
            font-weight: 600;
            margin-bottom: 5px;
            text-transform: uppercase;
            font-size: 0.85em;
            letter-spacing: 0.5px;
        }
        
        .modal-info-value {
            color: #6f4e37;
            background: #faf7f2;
            padding: 10px;
            border-radius: 6px;
            word-break: break-all;
            border-left: 3px solid #d4a574;
        }
        
        .modal-close {
            margin-top: 20px;
            width: 100%;
            background: linear-gradient(135deg, #8b6f47 0%, #6f4e37 100%);
        }
        
        .close-button {
            float: right;
            font-size: 1.5em;
            color: #8b6f47;
            cursor: pointer;
            background: none;
            border: none;
            padding: 0;
            width: auto;
            font-weight: bold;
        }
        
        .close-button:hover {
            color: #6f4e37;
        }
        
        .file-info-link {
            color: #d4a574;
            cursor: pointer;
            text-decoration: underline;
            font-weight: 600;
        }
        
        .file-info-link:hover {
            color: #8b6f47;
        }
        
        .footer {
            margin-top: 40px;
            padding-top: 30px;
            border-top: 2px solid #e0d5c7;
            text-align: center;
            color: #8b6f47;
            font-size: 0.9em;
        }
        
        .feature-intro {
            background: linear-gradient(135deg, #fff9f0 0%, #faf7f2 100%);
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #d4a574;
            margin-bottom: 25px;
            color: #6f4e37;
        }
        
        .up-icon {
            font-size: 1.2em;
            margin-right: 8px;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>☕ Brew Haven Cafe</h1>
            <p class="tagline">Experience the Perfect Cup</p>
        </header>
        
        <div class="content">
            <?php
            // Display messages
            if (!empty($success_message)) {
                echo "<div class='message success-message'>✓ " . htmlspecialchars($success_message) . "</div>";
            }
            if (!empty($error_message)) {
                echo "<div class='message error-message'>✗ " . htmlspecialchars($error_message) . "</div>";
            }
            ?>
            
            <div class="nav-tabs">
                <button class="nav-tab active" onclick="switchTab('profile', this)">👤 My Profile</button>
                <button class="nav-tab" onclick="switchTab('orders', this)">📜 My Orders</button>
                <button class="nav-tab" onclick="switchTab('reviews', this)">⭐ Reviews</button>
                <button class="nav-tab" onclick="switchTab('feedback', this)">💬 Suggestions</button>
            </div>
            
            <!-- MY PROFILE TAB -->
            <div id="profile" class="tab-content active">
                <div class="section">
                    <h2><span class="up-icon">👤</span>My Profile Picture</h2>
                    <div class="feature-intro">
                        Upload a profile picture to personalize your account. Your photo helps our baristas remember you and creates a friendly community atmosphere.
                    </div>
                    
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="file">Choose Your Photo</label>
                            <input type="file" id="file" name="file" accept="image/*" required>
                            <small style="display: block; margin-top: 8px; color: #8b6f47;">Supported: JPG, PNG, GIF (Max 10MB)</small>
                        </div>
                        <button type="submit">Upload Profile Picture</button>
                    </form>
                </div>
                
                <div class="section">
                    <h2>My Photos</h2>
                    <?php
                    // Get only image files for profile
                    $profile_files = array_filter($files, function($f) {
                        $ext = strtolower(pathinfo($f['name'], PATHINFO_EXTENSION));
                        return in_array($ext, ['jpg', 'jpeg', 'png', 'gif']);
                    });
                    
                    if (count($profile_files) > 0) {
                        echo "<p style='color: #8b6f47; margin-bottom: 20px;'>You have " . count($profile_files) . " profile photo(s)</p>";
                        echo "<div style='display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 15px;'>";
                        
                        foreach ($profile_files as $file) {
                            echo "<div style='background: white; padding: 15px; border-radius: 8px; border: 2px solid #e0d5c7;'>";
                            echo "<div style='background: #faf7f2; width: 100%; height: 180px; border-radius: 6px; overflow: hidden; margin-bottom: 10px;'>";
                            echo "<img src='uploads/" . urlencode($file['name']) . "' style='width: 100%; height: 100%; object-fit: cover; border-radius: 6px;'>";
                            echo "</div>";
                            echo "<p style='color: #6f4e37; font-weight: 600; margin-bottom: 10px; word-break: break-all;'>" . htmlspecialchars($file['name']) . "</p>";
                            echo "<div class='file-actions'>";
                            echo "<a href='download.php?file=" . urlencode($file['name']) . "' class='btn-small btn-download'>Download</a>";
                            echo "<a href='" . $_SERVER['PHP_SELF'] . "?delete=" . urlencode($file['name']) . "' class='btn-small btn-delete' onclick='return confirm(\"Remove this photo?\")'>Remove</a>";
                            echo "</div>";
                            echo "</div>";
                        }
                        
                        echo "</div>";
                    } else {
                        echo "<div class='empty-state'>";
                        echo "<div class='empty-state-icon'>📷</div>";
                        echo "<p>No profile photos yet. Upload your first photo above!</p>";
                        echo "</div>";
                    }
                    ?>
                </div>
            </div>
            
            <!-- MY ORDERS TAB -->
            <div id="orders" class="tab-content">
                <div class="section">
                    <h2><span class="up-icon">📜</span>Upload Order Receipt</h2>
                    <div class="feature-intro">
                        Save your order receipts and invoices. This helps you keep track of your favorite purchases and builds your coffee journey with us.
                    </div>
                    
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="file">Upload Receipt or Invoice</label>
                            <input type="file" id="file" name="file" accept=".pdf,.jpg,.jpeg,.png" required>
                            <small style="display: block; margin-top: 8px; color: #8b6f47;">Supported: PDF, JPG, PNG (Max 10MB)</small>
                        </div>
                        <button type="submit">Save Order</button>
                    </form>
                </div>
                
                <div class="section">
                    <h2>My Order History</h2>
                    <?php
                    // Get order files (PDFs and images)
                    $order_files = array_filter($files, function($f) {
                        $ext = strtolower(pathinfo($f['name'], PATHINFO_EXTENSION));
                        return in_array($ext, ['pdf', 'jpg', 'jpeg', 'png', 'doc', 'docx']);
                    });
                    
                    if (count($order_files) > 0) {
                        echo "<p style='color: #8b6f47; margin-bottom: 15px;'>📋 You have saved " . count($order_files) . " order(s)</p>";
                        echo "<table class='files-table'>";
                        echo "<thead><tr><th>Receipt</th><th>Date Saved</th><th>Size</th><th>Actions</th></tr></thead>";
                        echo "<tbody>";
                        
                        foreach ($order_files as $file) {
                            echo "<tr>";
                            echo "<td><span class='file-icon'>" . get_file_icon($file['name']) . "</span><span class='file-name'>" . htmlspecialchars(substr($file['name'], 0, 30)) . (strlen($file['name']) > 30 ? '...' : '') . "</span></td>";
                            echo "<td><span class='file-date'>" . date('M d, Y', $file['modified']) . "</span></td>";
                            echo "<td><span class='file-size'>" . format_filesize($file['size']) . "</span></td>";
                            echo "<td class='file-actions'>";
                            echo "<a href='download.php?file=" . urlencode($file['name']) . "' class='btn-small btn-download'>Download</a>";
                            echo "<a href='" . $_SERVER['PHP_SELF'] . "?delete=" . urlencode($file['name']) . "' class='btn-small btn-delete' onclick='return confirm(\"Remove this order?\")'>Delete</a>";
                            echo "</td></tr>";
                        }
                        
                        echo "</tbody></table>";
                    } else {
                        echo "<div class='empty-state'>";
                        echo "<div class='empty-state-icon'>📭</div>";
                        echo "<p>No orders saved yet. Start saving your receipts above!</p>";
                        echo "</div>";
                    }
                    ?>
                </div>
            </div>
            
            <!-- REVIEWS TAB -->
            <div id="reviews" class="tab-content">
                <div class="section">
                    <h2><span class="up-icon">⭐</span>Share Your Review</h2>
                    <div class="feature-intro">
                        Write a review and attach supporting documents, photos, or videos. Your feedback helps us improve and shows our appreciation to the community.
                    </div>
                    
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="file">Attach Review File</label>
                            <input type="file" id="file" name="file" required>
                            <small style="display: block; margin-top: 8px; color: #8b6f47;">You can attach: Photos, Text files, PDFs, Videos (Max 10MB)</small>
                        </div>
                        <button type="submit">Submit Review</button>
                    </form>
                </div>
                
                <div class="section">
                    <h2>Customer Reviews & Feedback</h2>
                    <?php
                    // Get all files (for reviews)
                    if (count($files) > 0) {
                        $recent_files = array_slice($files, 0, 10); // Show 10 most recent
                        echo "<p style='color: #8b6f47; margin-bottom: 15px;'>⭐ " . count($files) . " review(s) from our coffee community</p>";
                        echo "<table class='files-table'>";
                        echo "<thead><tr><th>Review</th><th>Submitted</th><th>Actions</th></tr></thead>";
                        echo "<tbody>";
                        
                        foreach ($recent_files as $file) {
                            echo "<tr>";
                            echo "<td><span class='file-icon'>" . get_file_icon($file['name']) . "</span><span class='file-name'>" . htmlspecialchars(substr($file['name'], 0, 35)) . (strlen($file['name']) > 35 ? '...' : '') . "</span></td>";
                            echo "<td><span class='file-date'>" . date('M d, Y', $file['modified']) . "</span></td>";
                            echo "<td class='file-actions'>";
                            echo "<a href='download.php?file=" . urlencode($file['name']) . "' class='btn-small btn-download'>View</a>";
                            echo "</td></tr>";
                        }
                        
                        echo "</tbody></table>";
                    } else {
                        echo "<div class='empty-state'>";
                        echo "<div class='empty-state-icon'>⭐</div>";
                        echo "<p>Be the first to share your coffee experience with us!</p>";
                        echo "</div>";
                    }
                    ?>
                </div>
            </div>
            
            <!-- SUGGESTIONS TAB -->
            <div id="feedback" class="tab-content">
                <div class="section">
                    <h2><span class="up-icon">💬</span>Send a Suggestion</h2>
                    <div class="feature-intro">
                        Have a great idea? Share your suggestions, menu ideas, or improvements. You can attach photos, sketches, or detailed notes.
                    </div>
                    
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="file">Attach Your Suggestion</label>
                            <input type="file" id="file" name="file" required>
                            <small style="display: block; margin-top: 8px; color: #8b6f47;">Share sketches, photos, or detailed documents (Max 10MB)</small>
                        </div>
                        <button type="submit">Submit Suggestion</button>
                    </form>
                </div>
                
                <div class="section">
                    <h2>Community Suggestions</h2>
                    <?php
                    if (count($files) > 5) {
                        echo "<p style='color: #8b6f47; margin-bottom: 15px;'>💡 " . count($files) . " total suggestions from our community</p>";
                        echo "<p style='color: #b8a896; margin-bottom: 20px; font-style: italic;'>Here are the most recent community ideas:</p>";
                        echo "<table class='files-table'>";
                        echo "<thead><tr><th>Suggestion</th><th>Date</th><th>Action</th></tr></thead>";
                        echo "<tbody>";
                        
                        $recent = array_slice($files, 0, 5);
                        foreach ($recent as $file) {
                            echo "<tr>";
                            echo "<td><span class='file-icon'>" . get_file_icon($file['name']) . "</span><span class='file-name'>" . htmlspecialchars(substr($file['name'], 0, 35)) . (strlen($file['name']) > 35 ? '...' : '') . "</span></td>";
                            echo "<td><span class='file-date'>" . date('M d, Y', $file['modified']) . "</span></td>";
                            echo "<td class='file-actions'>";
                            echo "<a href='download.php?file=" . urlencode($file['name']) . "' class='btn-small btn-download'>View</a>";
                            echo "</td></tr>";
                        }
                        
                        echo "</tbody></table>";
                    } else {
                        echo "<div class='empty-state'>";
                        echo "<div class='empty-state-icon'>💡</div>";
                        echo "<p>Share your ideas and help us grow! Submit your first suggestion above.</p>";
                        echo "</div>";
                    }
                    ?>
                </div>
            </div>
            
            <div class="footer">
                <p>🏪 Brew Haven Cafe &bull; Where Every Cup Tells a Story</p>
                <p style="margin-top: 10px; font-size: 0.85em;">Thank you for being part of our coffee community!</p>
            </div>
        </div>
    </div>
    
    <!-- File Info Modal (Hidden - No longer needed for display) -->
    <div id="fileModal" class="modal" style="display: none;">
        <div class="modal-content">
            <button class="close-button" onclick="closeFileInfo()">×</button>
            <div class="modal-header">File Details</div>
            <div class="modal-info">
                <div class="modal-info-label">File Name</div>
                <div class="modal-info-value" id="fileInfoName"></div>
            </div>
            <div class="modal-info">
                <div class="modal-info-label">Size</div>
                <div class="modal-info-value" id="fileInfoSize"></div>
            </div>
            <div class="modal-info">
                <div class="modal-info-label">Uploaded Date</div>
                <div class="modal-info-value" id="fileInfoModified"></div>
            </div>
            <button class="modal-close" onclick="closeFileInfo()">Close</button>
        </div>
    </div>
    
    <script>
        function switchTab(tabName, btn) {
            // Hide all tabs
            const tabs = document.querySelectorAll('.tab-content');
            tabs.forEach(tab => tab.classList.remove('active'));
            
            // Show selected tab
            document.getElementById(tabName).classList.add('active');
            
            // Update button styles
            const buttons = document.querySelectorAll('.nav-tab');
            buttons.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
        }
        
        function showFileInfo(fileData) {
            const file = JSON.parse(fileData);
            document.getElementById('fileInfoName').textContent = file.name;
            document.getElementById('fileInfoSize').textContent = formatSize(file.size);
            document.getElementById('fileInfoModified').textContent = new Date(file.modified * 1000).toLocaleString();
            document.getElementById('fileModal').classList.add('show');
        }
        
        function closeFileInfo() {
            document.getElementById('fileModal').classList.remove('show');
        }
        
        function formatSize(bytes) {
            const units = ['B', 'KB', 'MB', 'GB'];
            let size = bytes;
            let unitIndex = 0;
            while (size >= 1024 && unitIndex < units.length - 1) {
                size /= 1024;
                unitIndex++;
            }
            return size.toFixed(2) + ' ' + units[unitIndex];
        }
        
        // Close modal on outside click
        window.onclick = function(event) {
            const modal = document.getElementById('fileModal');
            if (event.target === modal) {
                modal.classList.remove('show');
            }
        }
    </script>
</body>
</html>
