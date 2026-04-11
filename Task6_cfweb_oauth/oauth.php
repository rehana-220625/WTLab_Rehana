<?php
// ============================================
// Google OAuth Callback Handler
// ============================================

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/oauth-helpers.php';

if (isset($_GET['error'])) {
    set_flash('error', 'Authentication cancelled: ' . safe($_GET['error']));
    header('Location: index.php');
    exit;
}

if (!isset($_GET['code'])) {
    set_flash('error', 'No authorization code received from Google.');
    header('Location: index.php');
    exit;
}

$code = $_GET['code'];
$state = $_GET['state'] ?? '';

if (!verify_state($state)) {
    set_flash('error', 'Invalid state parameter. Security verification failed.');
    header('Location: index.php');
    exit;
}

// Exchange code for token
$token_result = exchange_google_code($code);
if (isset($token_result['error'])) {
    set_flash('error', $token_result['error']);
    header('Location: index.php');
    exit;
}

// Get user information
$user_result = get_google_user_info($token_result['token']);
if (isset($user_result['error'])) {
    set_flash('error', $user_result['error']);
    header('Location: index.php');
    exit;
}

// Create session
$user = $user_result['user'];
create_user_session($user, 'Google');

set_flash('success', 'Welcome back, ' . safe($user['name']) . '! You are now logged in.');
header('Location: pages/dashboard.php');
exit;
?>
