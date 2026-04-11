<?php
// ============================================
// Firebase Callback Handler
// Validates Firebase ID token and creates session
// ============================================

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/firebase-auth.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

try {
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (!isset($data['idToken'])) {
        http_response_code(400);
        echo json_encode(['error' => 'No ID token provided']);
        exit;
    }
    
    // Verify the Firebase token
    $verification = verify_firebase_token($data['idToken']);
    
    if (isset($verification['error'])) {
        http_response_code(401);
        echo json_encode(['error' => $verification['error']]);
        exit;
    }
    
    // Create session with verified user data
    $user = $verification['user'];
    create_firebase_session($user);
    
    set_flash('success', 'Welcome back, ' . htmlspecialchars($user['name']) . '! You are now logged in.');
    
    http_response_code(200);
    echo json_encode(['success' => true, 'message' => 'Authenticated successfully']);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Server error: ' . $e->getMessage()]);
}
?>
