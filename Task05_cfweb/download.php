<?php
/* ===============================================
   FILE DOWNLOAD HANDLER
   Handles secure file downloads with headers
   =============================================== */

// Get uploads directory
$uploads_dir = __DIR__ . '/uploads';

// Get requested file
if (!isset($_GET['file']) || empty($_GET['file'])) {
    die("❌ No file specified!");
}

$filename = basename($_GET['file']);
$filepath = $uploads_dir . '/' . $filename;

// Security: Check if file exists and is in uploads directory
if (!file_exists($filepath)) {
    die("❌ File not found!");
}

// Security: Verify file is in uploads directory (prevent directory traversal)
if (realpath($filepath) === false || strpos(realpath($filepath), realpath($uploads_dir)) !== 0) {
    die("❌ Invalid file path!");
}

// Check if it's actually a file
if (!is_file($filepath)) {
    die("❌ Item is not a file!");
}

// Check if file is readable
if (!is_readable($filepath)) {
    die("❌ File is not readable!");
}

// Get file information
$file_size = filesize($filepath);  // Get file size for Content-Length header
$mime_type = mime_content_type($filepath);  // Get MIME type

// Use finfo if mime_content_type is not available
if ($mime_type === false) {
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime_type = finfo_file($finfo, $filepath);
    finfo_close($finfo);
}

// Set default MIME type if still unknown
if ($mime_type === false) {
    $mime_type = 'application/octet-stream';
}

// Set headers for download
header('Content-Type: ' . $mime_type);
header('Content-Length: ' . $file_size);
header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

// ========================================
// READ AND OUTPUT FILE CONTENT
// ========================================

// Method 1: Using fopen() and fread() - For learning purposes
// Efficient for large files
$handle = fopen($filepath, 'rb');  // 'rb' = read binary mode

if ($handle) {
    // Read and output file in chunks to save memory
    while (!feof($handle)) {
        // Read 1MB at a time
        echo fread($handle, 1024 * 1024);
    }
    
    // Close file handle
    fclose($handle);
} else {
    die("❌ Error opening file for download!");
}

/* Alternative Method 2 (commented): Using readfile()
// Simpler but less control
readfile($filepath);
*/

/* Alternative Method 3 (commented): Using file_get_contents()
// Good for small files
echo file_get_contents($filepath);
*/

exit;
?>
