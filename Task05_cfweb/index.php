<?php
/* ===============================================
   MINI FILE MANAGER APPLICATION
   Complete file handling functionality
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
    <title>File Manager - Cafe Website</title>
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
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }
        
        header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }
        
        header h1 {
            font-size: 2.2em;
            margin-bottom: 5px;
        }
        
        header p {
            opacity: 0.9;
            font-size: 1em;
        }
        
        .content {
            padding: 30px;
        }
        
        .upload-section {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 10px;
            margin-bottom: 30px;
            border: 2px dashed #667eea;
        }
        
        .upload-section h2 {
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
            border: 1px solid #ddd;
            border-radius: 5px;
            cursor: pointer;
            background: white;
        }
        
        input[type="file"]:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 5px rgba(102, 126, 234, 0.3);
        }
        
        button {
            padding: 12px 30px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 5px;
            font-weight: 600;
            cursor: pointer;
            font-size: 1em;
            transition: all 0.3s;
        }
        
        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        
        button:active {
            transform: translateY(0);
        }
        
        .message {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            font-size: 0.95em;
        }
        
        .success-message {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .error-message {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .files-section h2 {
            color: #333;
            margin-bottom: 20px;
            font-size: 1.3em;
            border-bottom: 2px solid #667eea;
            padding-bottom: 10px;
        }
        
        .file-stats {
            background: #e8f4f8;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }
        
        .stat {
            padding: 10px;
            background: white;
            border-left: 4px solid #667eea;
            border-radius: 3px;
        }
        
        .stat-label {
            color: #666;
            font-size: 0.9em;
            font-weight: 500;
        }
        
        .stat-value {
            color: #333;
            font-size: 1.3em;
            font-weight: 700;
            margin-top: 5px;
        }
        
        .files-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        
        .files-table thead {
            background: #667eea;
            color: white;
        }
        
        .files-table th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
        }
        
        .files-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
        }
        
        .files-table tbody tr:hover {
            background: #f8f9fa;
        }
        
        .file-icon {
            font-size: 1.3em;
            margin-right: 8px;
        }
        
        .file-name {
            color: #333;
            font-weight: 500;
            word-break: break-all;
        }
        
        .file-size {
            color: #666;
            font-size: 0.95em;
        }
        
        .file-date {
            color: #999;
            font-size: 0.9em;
            white-space: nowrap;
        }
        
        .file-actions {
            display: flex;
            gap: 8px;
        }
        
        .btn-small {
            padding: 8px 12px;
            font-size: 0.85em;
            border-radius: 4px;
            text-decoration: none;
            display: inline-block;
            transition: all 0.2s;
        }
        
        .btn-download {
            background: #28a745;
            color: white;
            border: none;
        }
        
        .btn-download:hover {
            background: #218838;
        }
        
        .btn-info {
            background: #17a2b8;
            color: white;
            border: none;
        }
        
        .btn-info:hover {
            background: #138496;
        }
        
        .btn-delete {
            background: #dc3545;
            color: white;
            border: none;
        }
        
        .btn-delete:hover {
            background: #c82333;
        }
        
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: #999;
        }
        
        .empty-state-icon {
            font-size: 3em;
            margin-bottom: 15px;
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
        }
        
        .modal-content {
            background: white;
            padding: 30px;
            border-radius: 10px;
            max-width: 500px;
            max-height: 80vh;
            overflow-y: auto;
            width: 90%;
        }
        
        .modal-header {
            font-size: 1.5em;
            font-weight: 700;
            color: #333;
            margin-bottom: 20px;
            border-bottom: 2px solid #667eea;
            padding-bottom: 10px;
        }
        
        .modal-info {
            margin-bottom: 15px;
        }
        
        .modal-info-label {
            color: #666;
            font-weight: 600;
            margin-bottom: 5px;
        }
        
        .modal-info-value {
            color: #333;
            background: #f5f5f5;
            padding: 10px;
            border-radius: 4px;
            word-break: break-all;
        }
        
        .modal-close {
            margin-top: 20px;
            width: 100%;
            background: #667eea;
        }
        
        .close-button {
            float: right;
            font-size: 1.5em;
            color: #666;
            cursor: pointer;
            background: none;
            border: none;
            padding: 0;
            width: auto;
        }
        
        .close-button:hover {
            color: #333;
        }
        
        .file-info-link {
            color: #667eea;
            cursor: pointer;
            text-decoration: underline;
        }
        
        .file-info-link:hover {
            color: #764ba2;
        }
        
        .nav-links {
            margin-top: 30px;
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
        <header>
            <h1>☕ File Manager</h1>
            <p>Upload, manage, and download your files</p>
        </header>
        
        <div class="content">
            <?php
            // Display messages
            if (!empty($success_message)) {
                echo "<div class='message success-message'>" . htmlspecialchars($success_message) . "</div>";
            }
            if (!empty($error_message)) {
                echo "<div class='message error-message'>" . htmlspecialchars($error_message) . "</div>";
            }
            ?>
            
            <!-- Upload Section -->
            <div class="upload-section">
                <h2>📤 Upload a File</h2>
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="file">Select File (Max 10MB)</label>
                        <input type="file" id="file" name="file" required>
                    </div>
                    <button type="submit">Upload File</button>
                </form>
            </div>
            
            <!-- Files Section -->
            <div class="files-section">
                <h2>📁 Your Files</h2>
                
                <?php
                // Display file statistics
                if (count($files) > 0) {
                    $total_size = 0;
                    foreach ($files as $file) {
                        $total_size += $file['size'];
                    }
                    
                    echo "<div class='file-stats'>";
                    echo "<div class='stat'>";
                    echo "<div class='stat-label'>Total Files</div>";
                    echo "<div class='stat-value'>" . count($files) . "</div>";
                    echo "</div>";
                    
                    echo "<div class='stat'>";
                    echo "<div class='stat-label'>Total Size</div>";
                    echo "<div class='stat-value'>" . format_filesize($total_size) . "</div>";
                    echo "</div>";
                    
                    echo "<div class='stat'>";
                    echo "<div class='stat-label'>Directory</div>";
                    echo "<div class='stat-value'>uploads/</div>";
                    echo "</div>";
                    
                    echo "</div>";
                }
                ?>
                
                <?php
                if (count($files) > 0) {
                    echo "<table class='files-table'>";
                    echo "<thead>";
                    echo "<tr>";
                    echo "<th>File Name</th>";
                    echo "<th>Size</th>";
                    echo "<th>Modified</th>";
                    echo "<th>Actions</th>";
                    echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    
                    foreach ($files as $file) {
                        echo "<tr>";
                        echo "<td><span class='file-icon'>" . get_file_icon($file['name']) . "</span><span class='file-name'>" . htmlspecialchars($file['name']) . "</span></td>";
                        echo "<td><span class='file-size'>" . format_filesize($file['size']) . "</span></td>";
                        echo "<td><span class='file-date'>" . format_date($file['modified']) . "</span></td>";
                        echo "<td class='file-actions'>";
                        echo "<a href='download.php?file=" . urlencode($file['name']) . "' class='btn-small btn-download'>⬇️ Download</a>";
                        echo "<button class='btn-small btn-info' onclick='showFileInfo(\"" . htmlspecialchars(json_encode($file), ENT_QUOTES) . "\")'>ℹ️ Info</button>";
                        echo "<a href='" . $_SERVER['PHP_SELF'] . "?delete=" . urlencode($file['name']) . "' class='btn-small btn-delete' onclick='return confirm(\"Delete this file?\")'>🗑️ Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    
                    echo "</tbody>";
                    echo "</table>";
                } else {
                    echo "<div class='empty-state'>";
                    echo "<div class='empty-state-icon'>📭</div>";
                    echo "<p>No files uploaded yet. Start by uploading a file above!</p>";
                    echo "</div>";
                }
                ?>
            </div>
            
            <div class="nav-links">
                <a href="file_functions_demo.php">📚 File Functions Demo</a>
                <a href="../Task04_cfweb/index.html">← Back to Home</a>
            </div>
        </div>
    </div>
    
    <!-- File Info Modal -->
    <div id="fileModal" class="modal">
        <div class="modal-content">
            <button class="close-button" onclick="closeFileInfo()">×</button>
            <div class="modal-header" id="modalTitle">File Information</div>
            
            <div class="modal-info">
                <div class="modal-info-label">File Name</div>
                <div class="modal-info-value" id="fileInfoName"></div>
            </div>
            
            <div class="modal-info">
                <div class="modal-info-label">File Size</div>
                <div class="modal-info-value" id="fileInfoSize"></div>
            </div>
            
            <div class="modal-info">
                <div class="modal-info-label">MIME Type</div>
                <div class="modal-info-value" id="fileInfoMime"></div>
            </div>
            
            <div class="modal-info">
                <div class="modal-info-label">File Type</div>
                <div class="modal-info-value" id="fileInfoType"></div>
            </div>
            
            <div class="modal-info">
                <div class="modal-info-label">Last Modified</div>
                <div class="modal-info-value" id="fileInfoModified"></div>
            </div>
            
            <div class="modal-info">
                <div class="modal-info-label">Created</div>
                <div class="modal-info-value" id="fileInfoCreated"></div>
            </div>
            
            <div class="modal-info">
                <div class="modal-info-label">Last Accessed</div>
                <div class="modal-info-value" id="fileInfoAccessed"></div>
            </div>
            
            <div class="modal-info">
                <div class="modal-info-label">Permissions</div>
                <div class="modal-info-value" id="fileInfoPerms"></div>
            </div>
            
            <div class="modal-info">
                <div class="modal-info-label">Is Readable</div>
                <div class="modal-info-value" id="fileInfoReadable"></div>
            </div>
            
            <div class="modal-info">
                <div class="modal-info-label">Is Writable</div>
                <div class="modal-info-value" id="fileInfoWritable"></div>
            </div>
            
            <button class="modal-close" onclick="closeFileInfo()">Close</button>
        </div>
    </div>
    
    <script>
        function showFileInfo(fileData) {
            const file = JSON.parse(fileData);
            
            document.getElementById('fileInfoName').textContent = file.name;
            document.getElementById('fileInfoSize').textContent = file.size + ' bytes (' + formatSize(file.size) + ')';
            document.getElementById('fileInfoMime').textContent = getMimeType(file.name);
            document.getElementById('fileInfoType').textContent = file.type;
            document.getElementById('fileInfoModified').textContent = new Date(file.modified * 1000).toLocaleString();
            document.getElementById('fileInfoCreated').textContent = new Date(file.created * 1000).toLocaleString();
            document.getElementById('fileInfoAccessed').textContent = new Date(file.accessed * 1000).toLocaleString();
            document.getElementById('fileInfoPerms').textContent = ('0000' + file.permissions.toString(8)).slice(-4);
            document.getElementById('fileInfoReadable').textContent = file.is_readable ? '✅ Yes' : '❌ No';
            document.getElementById('fileInfoWritable').textContent = file.is_writable ? '✅ Yes' : '❌ No';
            
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
        
        function getMimeType(filename) {
            const ext = filename.split('.').pop().toLowerCase();
            const mimeTypes = {
                'pdf': 'application/pdf',
                'jpg': 'image/jpeg',
                'jpeg': 'image/jpeg',
                'png': 'image/png',
                'gif': 'image/gif',
                'txt': 'text/plain',
                'doc': 'application/msword',
                'docx': 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'xls': 'application/vnd.ms-excel',
                'xlsx': 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'zip': 'application/zip',
                'mp4': 'video/mp4',
                'mp3': 'audio/mpeg'
            };
            
            return mimeTypes[ext] || 'application/octet-stream';
        }
        
        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('fileModal');
            if (event.target === modal) {
                modal.classList.remove('show');
            }
        }
    </script>
</body>
</html>
