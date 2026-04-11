# 📁 Mini File Manager - Task05_cfweb

A comprehensive file manager application built with PHP demonstrating all major file handling functions.

## 🎯 Features

### ✅ Core Features
- **Upload Files** - Upload any file type (Max 10MB)
- **List Files** - View all uploaded files with details
- **Download Files** - Secure file download functionality
- **Delete Files** - Remove unwanted files
- **File Information** - View detailed file metadata

### ✅ File Functions Demonstrated

#### 📖 File Read/Write Functions
- `fopen()` - Open file handle with different modes
- `fclose()` - Close file handle
- `fread()` - Read from file
- `fwrite()` - Write to file
- `file_get_contents()` - Read entire file at once
- `file_put_contents()` - Write/append to file
- `file()` - Read file into array (line by line)

#### ℹ️ File Information Functions
- `file_exists()` - Check if file exists
- `filesize()` - Get file size in bytes
- `filetype()` - Determine file type
- `fileatime()` - Last access time
- `filemtime()` - Last modification time
- `filectime()` - File creation time
- `fileperms()` - File permissions
- `fileowner()` - File owner ID
- `filegroup()` - File group ID
- `fileinode()` - File inode number

#### 🔧 File & Folder Management Functions
- `copy()` - Copy files
- `rename()` - Rename files
- `unlink()` - Delete files
- `mkdir()` - Create directories
- `rmdir()` - Remove directories
- `is_file()` - Check if file
- `is_dir()` - Check if directory
- `is_readable()` - Check if readable
- `is_writable()` - Check if writable

#### 📂 Directory Handling Functions
- `scandir()` - List directory contents
- `opendir()` - Open directory handle
- `readdir()` - Read directory entries
- `closedir()` - Close directory handle
- `getcwd()` - Get current working directory
- `chdir()` - Change directory

#### 🔐 File Modes (fopen)
- `'r'` - Read only
- `'r+'` - Read and Write
- `'w'` - Write only (truncates file)
- `'w+'` - Read and Write (truncates file)
- `'a'` - Append only
- `'a+'` - Read and Append
- `'x'` - Create new file (fails if exists)
- `'x+'` - Create and Read/Write

## 📁 Project Structure

```
Task05_cfweb/
├── index.php                    # Main file manager application
├── download.php                 # File download handler
├── file_functions_demo.php      # Demonstration of all file functions
├── uploads/                     # Directory for uploaded files
├── demo_files/                  # Auto-created directory for demos
└── README.md                    # This file
```

## 🚀 Installation & Setup

### Step 1: Copy to XAMPP
```
Copy Task05_cfweb folder to: C:\xampp\htdocs\
```

### Step 2: Create Uploads Directory
```
The application automatically creates the 'uploads' folder
```

### Step 3: Access the Application
```
Open browser and go to:
http://localhost/Task05_cfweb/
```

## 💻 Usage

### Upload a File
1. Click "Select File" button
2. Choose file from your computer (Max 10MB)
3. Click "Upload File"
4. File appears in the files list

### Download a File
1. Located uploaded file in the list
2. Click "⬇️ Download" button
3. File is downloaded to your downloads folder

### View File Information
1. Find the file in the list
2. Click "ℹ️ Info" button
3. Modal shows detailed file information including:
   - File name and size
   - MIME type
   - Created, modified, and accessed dates
   - File permissions
   - Read/Write status

### Delete a File
1. Locate the file in the list
2. Click "🗑️ Delete" button
3. Confirm deletion

## 🧪 Testing File Functions

### Visit the File Functions Demo
1. From the file manager, click "📚 File Functions Demo"
2. See live demonstrations of:
   - Reading and writing files
   - File information retrieval
   - Directory listing
   - File operations
   - File mode explanations

## 📊 File Information Displayed

For each file, the application shows:
- **Name** - File name with icon
- **Size** - File size in bytes and formatted (KB, MB, GB)
- **Modified** - Last modification date and time
- **MIME Type** - File MIME type
- **Type** - File system type (file, directory, etc.)
- **Timestamps** - Created, modified, and accessed times
- **Permissions** - File permissions in octal format
- **Read/Write Status** - Whether file is readable/writable

## 🔒 Security Features

✅ **File Security**
- Files stored in isolated upload directory
- File path validation (prevents directory traversal)
- File type detection using finfo
- Size validation (max 10MB)
- Filename sanitization

✅ **Download Security**
- Real path verification
- Directory boundary checking
- Proper MIME type headers
- Efficient memory usage (streaming for large files)

✅ **Input Validation**
- Filename validation
- File size checking
- Existing file detection

## 🎓 Learning Outcomes

After using this file manager, you'll understand:

✅ **File Operations**
- Reading files (fread, file_get_contents, file)
- Writing files (fwrite, file_put_contents)
- Opening and closing file handles
- Understanding file modes

✅ **File Information**
- Getting file size and type
- Checking file timestamps
- Reading file permissions
- Verifying file readability/writability

✅ **Directory Operations**
- Listing directory contents (scandir, readdir)
- Creating and deleting directories
- Traversing directory structures
- Getting current directory

✅ **Security**
- Validating file paths
- Sanitizing filenames
- Handling file permissions
- Secure downloads with proper headers

## 📚 File Functions Reference

### Reading Files
```php
// Method 1: Using fopen and fread
$handle = fopen('file.txt', 'r');
$content = fread($handle, filesize('file.txt'));
fclose($handle);

// Method 2: Using file_get_contents
$content = file_get_contents('file.txt');

// Method 3: Using file (read into array)
$lines = file('file.txt');
```

### Writing Files
```php
// Method 1: Using fopen and fwrite
$handle = fopen('file.txt', 'w');
fwrite($handle, $content);
fclose($handle);

// Method 2: Using file_put_contents
file_put_contents('file.txt', $content);

// Method 3: Append mode
file_put_contents('file.txt', $newcontent, FILE_APPEND);
```

### File Information
```php
filesize($file);          // Get file size
filetype($file);          // Get file type
filemtime($file);         // Last modification
filectime($file);         // Creation time
fileatime($file);         // Last access
fileperms($file);         // Permissions
is_file($file);           // Check if file
is_dir($path);            // Check if directory
```

### Directory Operations
```php
scandir($dir);            // List files in directory
opendir($dir);            // Open directory
readdir($handle);         // Read from directory
closedir($handle);        // Close directory
getcwd();                 // Current working directory
mkdir($dir);              // Create directory
```

## 🐛 Troubleshooting

### Issue: Can't upload files
**Solution**: Check that the uploads folder is writable (777 permissions)

### Issue: Download returns error
**Solution**: Verify file exists in uploads folder and is readable

### Issue: File info shows "Permission denied"
**Solution**: Check file permissions and XAMPP process privileges

### Issue: Demo directory not created
**Solution**: Application creates it automatically on first visit

## 📝 File Manager in Action

### Real-world Use Cases
- 👤 **User Profiles** - Store and manage user documents
- 📧 **Email Attachments** - Upload and download file attachments
- 📚 **Learning Management System** - Upload assignments
- 📊 **Document Gallery** - Manage image and document uploads
- 🗂️ **Cloud Storage** - Personal file storage system
- 📱 **Mobile Backend** - Server-side file storage for apps

## 🎉 Conclusion

This Mini File Manager demonstrates real-world file handling in PHP with practical examples of:
- All major file functions
- Proper file security practices
- User-friendly interface
- Complete documentation

Perfect for learning PHP file operations and building practical web applications!

---

**Created:** April 2026  
**Technology:** PHP, HTML5, CSS3  
**XAMPP Compatible:** Yes  
**Max File Size:** 10MB  

Happy File Managing! 📁✨
