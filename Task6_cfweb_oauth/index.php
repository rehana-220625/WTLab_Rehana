<?php
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/oauth-helpers.php';

// If already logged in, redirect to dashboard
if (is_logged_in()) {
    header('Location: pages/dashboard.php');
    exit;
}

$flash = get_flash();
$google_available = validate_oauth_config('google');
$github_available = validate_oauth_config('github');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join Brew Haven - Your Coffee Community</title>
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
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .container {
            max-width: 500px;
            width: 100%;
            background: white;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }
        
        .header {
            background: linear-gradient(135deg, #6f4e37 0%, #8b6f47 100%);
            color: white;
            padding: 50px 30px;
            text-align: center;
            border-bottom: 4px solid #d4a574;
        }
        
        .header h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
            letter-spacing: 1px;
        }
        
        .header p {
            font-size: 1em;
            opacity: 0.95;
            font-style: italic;
            color: #f5e6d3;
        }
        
        .content {
            padding: 40px;
        }
        
        .flash-message {
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 30px;
            border-left: 5px solid;
            font-weight: 500;
        }
        
        .flash-success {
            background: #d4edda;
            color: #155724;
            border-left-color: #28a745;
        }
        
        .flash-error {
            background: #f8d7da;
            color: #721c24;
            border-left-color: #dc3545;
        }
        
        .welcome-section {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .welcome-section h2 {
            color: #6f4e37;
            font-size: 1.8em;
            margin-bottom: 12px;
        }
        
        .welcome-section p {
            color: #8b6f47;
            font-size: 1.05em;
            line-height: 1.6;
        }
        
        .login-options {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        
        .login-btn {
            padding: 14px 20px;
            border: none;
            border-radius: 10px;
            font-size: 1em;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            transition: all 0.3s;
            text-decoration: none;
            text-align: center;
            color: white;
        }
        
        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }
        
        .google-btn {
            background: linear-gradient(135deg, #4285f4 0%, #357ae8 100%);
        }
        
        .google-btn:hover {
            background: linear-gradient(135deg, #357ae8 0%, #2f5bbf 100%);
        }
        
        .github-btn {
            background: linear-gradient(135deg, #333 0%, #1a1a1a 100%);
        }
        
        .github-btn:hover {
            background: linear-gradient(135deg, #1a1a1a 0%, #000 100%);
        }
        
        .disabled-btn {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none !important;
        }
        
        .disabled-btn:hover {
            transform: none !important;
            box-shadow: none !important;
        }
        
        .icon {
            font-size: 1.3em;
        }
        
        .divider {
            text-align: center;
            margin: 30px 0;
            color: #b8a896;
            font-size: 0.9em;
            position: relative;
        }
        
        .divider::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            width: 35%;
            height: 1px;
            background: #e0d5c7;
        }
        
        .divider::after {
            content: '';
            position: absolute;
            right: 0;
            top: 50%;
            width: 35%;
            height: 1px;
            background: #e0d5c7;
        }
        
        .footer {
            text-align: center;
            color: #8b6f47;
            font-size: 0.85em;
            line-height: 1.6;
        }
        
        .footer p {
            margin: 8px 0;
        }
        
        .no-providers {
            text-align: center;
            padding: 30px 20px;
            background: #fff3cd;
            border-radius: 10px;
            border-left: 5px solid #ffc107;
            color: #856404;
        }
        
        .no-providers h3 {
            margin-bottom: 10px;
        }
        
        .features {
            background: #faf7f2;
            padding: 20px;
            border-radius: 10px;
            margin: 30px 0;
        }
        
        .features h3 {
            color: #6f4e37;
            margin-bottom: 15px;
            font-size: 1.1em;
        }
        
        .feature-list {
            list-style: none;
        }
        
        .feature-list li {
            color: #8b6f47;
            padding: 8px 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .feature-list::before {
            content: '';
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>☕ Brew Haven</h1>
            <p>Your Coffee Community</p>
        </div>
        
        <div class="content">
            <?php if ($flash): ?>
                <div class="flash-message flash-<?php echo $flash['type']; ?>">
                    <?php echo safe($flash['message']); ?>
                </div>
            <?php endif; ?>
            
            <div class="welcome-section">
                <h2>Welcome Back!</h2>
                <p>Log in to your account and join our coffee loving community</p>
            </div>
            
            <?php if ($google_available || $github_available): ?>
                <div class="login-options">
                    <?php if ($google_available): ?>
                        <a href="?action=login_google" class="login-btn google-btn">
                            <span class="icon">🔐</span>
                            <span>Continue with Google</span>
                        </a>
                    <?php else: ?>
                        <button class="login-btn disabled-btn" disabled>
                            <span class="icon">🔐</span>
                            <span>Google Login (Not Configured)</span>
                        </button>
                    <?php endif; ?>
                    
                    <?php if ($github_available): ?>
                        <a href="?action=login_github" class="login-btn github-btn">
                            <span class="icon">💻</span>
                            <span>Continue with GitHub</span>
                        </a>
                    <?php else: ?>
                        <button class="login-btn disabled-btn" disabled>
                            <span class="icon">💻</span>
                            <span>GitHub Login (Not Configured)</span>
                        </button>
                    <?php endif; ?>
                </div>
                
                <div class="features">
                    <h3>✨ What You Get</h3>
                    <ul class="feature-list">
                        <li>✓ Save your favorite coffee moments</li>
                        <li>✓ Order tracking and history</li>
                        <li>✓ Share your reviews and feedback</li>
                        <li>✓ Join our coffee community</li>
                    </ul>
                </div>
            <?php else: ?>
                <div class="no-providers">
                    <h3>⚠️ Setup Required</h3>
                    <p>This application is not yet configured.<br>Please create a .env file with your OAuth credentials.</p>
                    <p style="margin-top: 15px; font-size: 0.9em;">See .env.example for setup instructions.</p>
                </div>
            <?php endif; ?>
            
            <div class="footer">
                <p style="margin-top: 30px;">🏪 Brew Haven Cafe</p>
                <p>Where Every Cup Tells a Story</p>
                <p style="font-size: 0.8em; color: #b8a896; margin-top: 15px;">Your data is secure • We never share your information</p>
            </div>
        </div>
    </div>
    
    <script>
        // Handle login actions
        const params = new URLSearchParams(window.location.search);
        const action = params.get('action');
        
        if (action === 'login_google') {
            <?php if ($google_available): ?>
                window.location.href = '<?php echo $config['google']['redirect_uri']; ?>?action=start';
            <?php endif; ?>
        } else if (action === 'login_github') {
            <?php if ($github_available): ?>
                // Redirect to GitHub OAuth
                const clientId = '<?php echo safe($config['github']['client_id']); ?>';
                const redirectUri = '<?php echo safe($config['github']['redirect_uri']); ?>';
                const state = Math.random().toString(36).substring(7);
                sessionStorage.setItem('oauth_state', state);
                window.location.href = `https://github.com/login/oauth/authorize?client_id=${clientId}&redirect_uri=${encodeURIComponent(redirectUri)}&scope=user:email&state=${state}`;
            <?php endif; ?>
        }
        
        // Handle direct OAuth initiation from button click
        function loginWithGoogle() {
            // Trigger OAuth flow
            const form = document.createElement('form');
            form.method = 'GET';
            form.action = '<?php echo $config['google']['redirect_uri']; ?>';
            document.body.appendChild(form);
            form.submit();
        }
        
        function loginWithGithub() {
            const clientId = '<?php echo safe($config['github']['client_id']); ?>';
            const redirectUri = '<?php echo safe($config['github']['redirect_uri']); ?>';
            const state = Math.random().toString(36).substring(7);
            sessionStorage.setItem('oauth_state', state);
            window.location.href = `https://github.com/login/oauth/authorize?client_id=${clientId}&redirect_uri=${encodeURIComponent(redirectUri)}&scope=user:email&state=${state}`;
        }
    </script>
</body>
</html>
