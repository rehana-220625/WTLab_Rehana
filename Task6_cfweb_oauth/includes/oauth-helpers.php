<?php
// ============================================
// OAuth Helper Functions
// ============================================

// Prevent multiple includes
if (function_exists('initiate_google_oauth')) {
    return;
}

/**
 * Initiate Google OAuth login flow
 */
function initiate_google_oauth() {
    global $config;
    
    if (!validate_oauth_config('google')) {
        return ['error' => 'Google OAuth is not properly configured.'];
    }
    
    $state = generate_state();
    $_SESSION['oauth_state'] = $state;
    
    $auth_url = "https://accounts.google.com/o/oauth2/v2/auth?" . http_build_query([
        'client_id' => $config['google']['client_id'],
        'redirect_uri' => $config['google']['redirect_uri'],
        'response_type' => 'code',
        'scope' => 'openid email profile',
        'state' => $state,
        'prompt' => 'select_account',
    ]);
    
    header('Location: ' . $auth_url);
    exit;
}

/**
 * Exchange Google authorization code for access token
 */
function exchange_google_code($code) {
    global $config;
    
    $token_url = "https://oauth2.googleapis.com/token";
    
    $post_fields = [
        'code' => $code,
        'client_id' => $config['google']['client_id'],
        'client_secret' => $config['google']['client_secret'],
        'redirect_uri' => $config['google']['redirect_uri'],
        'grant_type' => 'authorization_code',
    ];
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $token_url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_fields));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($http_code !== 200) {
        return ['error' => 'Failed to authenticate with Google'];
    }
    
    $token_data = json_decode($response, true);
    
    if (!isset($token_data['access_token'])) {
        return ['error' => 'Failed to obtain access token'];
    }
    
    return ['success' => true, 'token' => $token_data['access_token']];
}

/**
 * Get user information from Google using access token
 */
function get_google_user_info($access_token) {
    $userinfo_url = "https://www.googleapis.com/oauth2/v2/userinfo?access_token=" . urlencode($access_token);
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $userinfo_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    $response = curl_exec($ch);
    curl_close($ch);
    
    $user_data = json_decode($response, true);
    
    if (!isset($user_data['email'])) {
        return ['error' => 'Failed to retrieve user information'];
    }
    
    return [
        'success' => true,
        'user' => [
            'id' => $user_data['id'],
            'email' => $user_data['email'],
            'name' => $user_data['name'] ?? 'Coffee Lover',
            'picture' => $user_data['picture'] ?? null,
        ],
    ];
}

/**
 * Initiate GitHub OAuth login flow
 */
function initiate_github_oauth() {
    global $config;
    
    if (!validate_oauth_config('github')) {
        return ['error' => 'GitHub OAuth is not properly configured.'];
    }
    
    $state = generate_state();
    $_SESSION['oauth_state'] = $state;
    
    $auth_url = "https://github.com/login/oauth/authorize?" . http_build_query([
        'client_id' => $config['github']['client_id'],
        'redirect_uri' => $config['github']['redirect_uri'],
        'scope' => 'user:email',
        'state' => $state,
    ]);
    
    header('Location: ' . $auth_url);
    exit;
}

/**
 * Exchange GitHub authorization code for access token
 */
function exchange_github_code($code) {
    global $config;
    
    $token_url = "https://github.com/login/oauth/access_token";
    
    $post_fields = [
        'client_id' => $config['github']['client_id'],
        'client_secret' => $config['github']['client_secret'],
        'code' => $code,
        'state' => $_SESSION['oauth_state'] ?? '',
    ];
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $token_url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_fields));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Accept: application/json']);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    $response = curl_exec($ch);
    curl_close($ch);
    
    $token_data = json_decode($response, true);
    
    if (!isset($token_data['access_token'])) {
        return ['error' => 'Failed to authenticate with GitHub'];
    }
    
    return ['success' => true, 'token' => $token_data['access_token']];
}

/**
 * Get user information from GitHub using access token
 */
function get_github_user_info($access_token) {
    $userinfo_url = "https://api.github.com/user";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $userinfo_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: token ' . $access_token,
        'User-Agent: Brew-Haven-Cafe',
    ]);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    $response = curl_exec($ch);
    curl_close($ch);
    
    $user_data = json_decode($response, true);
    
    if (!isset($user_data['id'])) {
        return ['error' => 'Failed to retrieve user information'];
    }
    
    // Get email if not in main response
    $email = $user_data['email'];
    if (!$email) {
        $email = get_github_user_email($access_token);
    }
    
    return [
        'success' => true,
        'user' => [
            'id' => $user_data['id'],
            'email' => $email ?: 'user@github.com',
            'name' => $user_data['name'] ?? $user_data['login'] ?? 'Coffee Lover',
            'picture' => $user_data['avatar_url'] ?? null,
        ],
    ];
}

/**
 * Get GitHub user email (since it might be private)
 */
function get_github_user_email($access_token) {
    $url = "https://api.github.com/user/emails";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: token ' . $access_token,
        'User-Agent: Brew-Haven-Cafe',
    ]);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    $response = curl_exec($ch);
    curl_close($ch);
    
    $emails = json_decode($response, true);
    
    if (is_array($emails) && count($emails) > 0) {
        // Return primary email or first one
        foreach ($emails as $email) {
            if ($email['primary'] ?? false) {
                return $email['email'];
            }
        }
        return $emails[0]['email'] ?? null;
    }
    
    return null;
}

/**
 * Create or update user session
 */
function create_user_session($user, $provider = 'unknown') {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_email'] = $user['email'];
    $_SESSION['user_name'] = $user['name'];
    $_SESSION['user_picture'] = $user['picture'];
    $_SESSION['auth_provider'] = $provider;
    $_SESSION['login_time'] = time();
}
?>
