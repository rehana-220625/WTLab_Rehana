<?php
// ============================================
// Firebase Authentication Module
// Supports both server and client-side auth
// ============================================

// Prevent multiple includes
if (function_exists('get_firebase_config')) {
    return;
}

require_once __DIR__ . '/config.php';

/**
 * Initialize Firebase Configuration for Client-side Auth
 * This can be embedded in a script tag for client-side Firebase authentication
 */
function get_firebase_config() {
    global $config;
    
    $firebase_config = [
        'apiKey' => $config['firebase']['api_key'],
        'authDomain' => $config['firebase']['auth_domain'],
        'projectId' => $config['firebase']['project_id'],
        'storageBucket' => $config['firebase']['storage_bucket'],
        'messagingSenderId' => $config['firebase']['messaging_sender_id'],
        'appId' => $config['firebase']['app_id'],
        'databaseURL' => $config['firebase']['database_url'],
    ];
    
    return $firebase_config;
}

/**
 * Get Firebase Config as JSON for client-side use
 */
function get_firebase_config_json() {
    $config = get_firebase_config();
    return json_encode($config);
}

/**
 * Server-side Firebase ID Token Verification
 * This validates ID tokens sent from the client after Firebase authentication
 * 
 * @param string $id_token The Firebase ID token from client
 * @return array User data if valid, error otherwise
 */
function verify_firebase_token($id_token) {
    global $config;
    
    try {
        // This would typically use Firebase Admin SDK (PHP)
        // For now, verify the token format and basic structure
        $parts = explode('.', $id_token);
        
        if (count($parts) !== 3) {
            return ['error' => 'Invalid token format'];
        }
        
        // Decode header and payload (not signature - needs Firebase Admin SDK for proper verification)
        $header = json_decode(base64_decode(strtr($parts[0], '-_', '+/')), true);
        $payload = json_decode(base64_decode(strtr($parts[1], '-_', '+/')), true);
        
        if (!$payload) {
            return ['error' => 'Invalid token payload'];
        }
        
        // Verify token expiration
        if (isset($payload['exp']) && $payload['exp'] < time()) {
            return ['error' => 'Token has expired'];
        }
        
        // Extract user information from the payload
        return [
            'success' => true,
            'user' => [
                'id' => $payload['sub'] ?? $payload['uid'] ?? '',
                'email' => $payload['email'] ?? '',
                'name' => $payload['name'] ?? 'Firebase User',
                'picture' => $payload['picture'] ?? null,
            ],
        ];
    } catch (Exception $e) {
        return ['error' => 'Token verification failed: ' . $e->getMessage()];
    }
}

/**
 * Create a Firebase session from verified token
 */
function create_firebase_session($user) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_email'] = $user['email'];
    $_SESSION['user_name'] = $user['name'];
    $_SESSION['user_picture'] = $user['picture'];
    $_SESSION['auth_provider'] = 'Firebase';
    $_SESSION['login_time'] = time();
}

/**
 * Get Firebase Client-Side Authentication Script
 * This returns a script that should be included in your pages for Firebase auth
 */
function get_firebase_auth_html() {
    $config = get_firebase_config();
    $config_json = json_encode($config);
    
    return <<<HTML
    <!-- Firebase Auth -->
    <script src="https://www.gstatic.com/firebasejs/10.5.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/10.5.0/firebase-auth.js"></script>
    <script>
        // Firebase Configuration
        const firebaseConfig = $config_json;
        
        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);
        
        // Get Auth instance
        const auth = firebase.auth();
        
        // Monitor auth state changes
        auth.onAuthStateChanged((user) => {
            if (user) {
                // Get ID token for server verification
                user.getIdToken().then((token) => {
                    // Send token to server for verification
                    fetch('./firebase-callback.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            idToken: token,
                            email: user.email,
                            displayName: user.displayName,
                            photoURL: user.photoURL,
                        })
                    }).then(response => response.json())
                      .then(data => {
                          if (data.success) {
                              window.location.href = './pages/dashboard.php';
                          }
                      });
                });
            }
        });
        
        // Google Sign-In via Firebase
        function firebaseGoogleLogin() {
            const provider = new firebase.auth.GoogleAuthProvider();
            auth.signInWithPopup(provider);
        }
        
        // GitHub Sign-In via Firebase
        function firebaseGithubLogin() {
            const provider = new firebase.auth.GithubAuthProvider();
            auth.signInWithPopup(provider);
        }
        
        // Email/Password Sign-In
        function firebaseEmailLogin(email, password) {
            auth.signInWithEmailAndPassword(email, password)
                .catch((error) => {
                    console.error('Login error:', error.message);
                });
        }
        
        // Sign Out
        function firebaseLogout() {
            auth.signOut().then(() => {
                window.location.href = './logout.php';
            });
        }
    </script>
    HTML;
}
?>
