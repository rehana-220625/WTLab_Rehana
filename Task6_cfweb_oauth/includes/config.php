<?php
// ============================================
// Brew Haven Cafe - OAuth Configuration
// ============================================

session_start();

// Load environment variables from .env file
$envPath = __DIR__ . '/../.env';

if (file_exists($envPath)) {
    $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        // Skip comments
        if (strpos(trim($line), '#') === 0) continue;
        
        // Skip lines without =
        if (strpos($line, '=') === false) continue;
        
        [$name, $value] = explode('=', $line, 2);
        $name = trim($name);
        $value = trim($value);
        
        // Remove quotes if present
        $value = trim($value, '"\'');
        
        putenv("$name=$value");
    }
} else {
    die("❌ Configuration Error: .env file not found. Please create .env file using .env.example as template.");
}

// Load configuration from environment
$config = [
    'app_name' => getenv('APP_NAME') ?: 'Brew Haven Cafe',
    'app_url' => getenv('APP_URL') ?: 'http://localhost/Task6_cfweb_oauth/',
    'app_env' => getenv('APP_ENV') ?: 'development',
    
    // Google OAuth
    'google' => [
        'client_id' => getenv('GOOGLE_CLIENT_ID'),
        'client_secret' => getenv('GOOGLE_CLIENT_SECRET'),
        'redirect_uri' => getenv('GOOGLE_REDIRECT_URI'),
    ],
    
    // GitHub OAuth
    'github' => [
        'client_id' => getenv('GITHUB_CLIENT_ID'),
        'client_secret' => getenv('GITHUB_CLIENT_SECRET'),
        'redirect_uri' => getenv('GITHUB_REDIRECT_URI'),
    ],
    
    // Firebase
    'firebase' => [
        'api_key' => getenv('FIREBASE_API_KEY'),
        'project_id' => getenv('FIREBASE_PROJECT_ID'),
        'messaging_sender_id' => getenv('FIREBASE_MESSAGING_SENDER_ID'),
        'app_id' => getenv('FIREBASE_APP_ID'),
        'auth_domain' => getenv('FIREBASE_AUTH_DOMAIN'),
        'database_url' => getenv('FIREBASE_DATABASE_URL'),
        'storage_bucket' => getenv('FIREBASE_STORAGE_BUCKET'),
    ],
    
    // Session
    'session_lifetime' => (int)getenv('SESSION_LIFETIME') ?: 3600,
];

// Validate required OAuth credentials
if (!function_exists('validate_oauth_config')) {
    function validate_oauth_config($provider) {
        global $config;
        
        if (empty($config[$provider]['client_id']) || 
            empty($config[$provider]['client_secret']) || 
            empty($config[$provider]['redirect_uri'])) {
            return false;
        }
        return true;
    }
}

// Check if user is logged in
if (!function_exists('is_logged_in')) {
    function is_logged_in() {
        return isset($_SESSION['user_id']) && isset($_SESSION['user_email']);
    }
}

// Get current logged in user
if (!function_exists('get_current_user')) {
    function get_current_user() {
        if (!is_logged_in()) return null;
        
        return [
            'id' => $_SESSION['user_id'],
            'email' => $_SESSION['user_email'],
            'name' => $_SESSION['user_name'] ?? 'Friend',
            'picture' => $_SESSION['user_picture'] ?? null,
            'provider' => $_SESSION['auth_provider'] ?? 'unknown',
        ];
    }
}

// Redirect to login if not authenticated
if (!function_exists('require_login')) {
    function require_login() {
        global $config;
        if (!is_logged_in()) {
            header('Location: ' . $config['app_url'] . 'index.php');
            exit;
        }
    }
}

// Logout user
if (!function_exists('logout_user')) {
    function logout_user() {
        $_SESSION = [];
        session_destroy();
    }
}

// Flash message functions
if (!function_exists('set_flash')) {
    function set_flash($type, $message) {
        $_SESSION['flash'] = [
            'type' => $type,
            'message' => $message,
        ];
    }
}

if (!function_exists('get_flash')) {
    function get_flash() {
        $flash = $_SESSION['flash'] ?? null;
        unset($_SESSION['flash']);
        return $flash;
    }
}

// Sanitize output
if (!function_exists('safe')) {
    function safe($str) {
        return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
    }
}

// Generate random state for OAuth security
if (!function_exists('generate_state')) {
    function generate_state() {
        return bin2hex(random_bytes(16));
    }
}

// Verify state parameter
if (!function_exists('verify_state')) {
    function verify_state($state) {
        return isset($_SESSION['oauth_state']) && $_SESSION['oauth_state'] === $state;
    }
}
?>
