<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/oauth-helpers.php';

// Require login
require_login();

$user = get_current_user();
$flash = get_flash();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account - Brew Haven Cafe</title>
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
            padding: 20px;
        }
        
        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        header {
            background: linear-gradient(135deg, #6f4e37 0%, #8b6f47 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
            border-bottom: 4px solid #d4a574;
        }
        
        header h1 {
            font-size: 2.2em;
            margin-bottom: 8px;
            letter-spacing: 1px;
        }
        
        .header-subtitle {
            font-size: 1em;
            opacity: 0.95;
            color: #f5e6d3;
        }
        
        .logout-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            padding: 10px 20px;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 2px solid white;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 0.9em;
        }
        
        .logout-btn:hover {
            background: white;
            color: #6f4e37;
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
        
        .user-profile {
            display: flex;
            align-items: center;
            gap: 30px;
            background: #faf7f2;
            padding: 30px;
            border-radius: 12px;
            margin-bottom: 40px;
            border: 2px solid #e0d5c7;
        }
        
        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: linear-gradient(135deg, #8b6f47 0%, #6f4e37 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 3em;
            flex-shrink: 0;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }
        
        .profile-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .profile-info h2 {
            color: #6f4e37;
            font-size: 1.8em;
            margin-bottom: 8px;
        }
        
        .profile-email {
            color: #8b6f47;
            font-size: 1.05em;
            margin-bottom: 12px;
        }
        
        .profile-badge {
            display: inline-block;
            padding: 6px 12px;
            background: linear-gradient(135deg, #d4a574 0%, #c99559 100%);
            color: white;
            border-radius: 20px;
            font-size: 0.85em;
            font-weight: 600;
        }
        
        .sections {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            margin-top: 40px;
        }
        
        .section-card {
            background: #faf7f2;
            padding: 25px;
            border-radius: 12px;
            border-left: 5px solid #d4a574;
            transition: all 0.3s;
            text-decoration: none;
            color: inherit;
            cursor: pointer;
        }
        
        .section-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-left-color: #8b6f47;
        }
        
        .section-icon {
            font-size: 2.5em;
            margin-bottom: 12px;
        }
        
        .section-title {
            color: #6f4e37;
            font-size: 1.3em;
            font-weight: 700;
            margin-bottom: 8px;
        }
        
        .section-desc {
            color: #8b6f47;
            font-size: 0.95em;
            line-height: 1.5;
        }
        
        .account-options {
            background: #faf7f2;
            padding: 25px;
            border-radius: 12px;
            border: 2px dashed #d4a574;
            margin-top: 40px;
        }
        
        .account-options h3 {
            color: #6f4e37;
            margin-bottom: 20px;
            font-size: 1.2em;
        }
        
        .info-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #e0d5c7;
        }
        
        .info-item:last-child {
            border-bottom: none;
        }
        
        .info-label {
            color: #8b6f47;
            font-weight: 600;
        }
        
        .info-value {
            color: #6f4e37;
            font-weight: 600;
        }
        
        .footer {
            text-align: center;
            margin-top: 50px;
            padding-top: 30px;
            border-top: 2px solid #e0d5c7;
            color: #8b6f47;
        }
        
        .footer p {
            margin: 8px 0;
        }
        
        @media (max-width: 768px) {
            .user-profile {
                flex-direction: column;
                text-align: center;
            }
            
            .logout-btn {
                position: static;
                margin-bottom: 20px;
                width: 100%;
            }
            
            header {
                padding: 30px 20px;
            }
            
            .content {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <a href="../logout.php" class="logout-btn">👋 Logout</a>
            <h1>☕ Brew Haven Cafe</h1>
            <p class="header-subtitle">Welcome to Your Coffee Experience</p>
        </header>
        
        <div class="content">
            <?php if ($flash): ?>
                <div class="flash-message flash-<?php echo $flash['type']; ?>">
                    ✓ <?php echo safe($flash['message']); ?>
                </div>
            <?php endif; ?>
            
            <div class="user-profile">
                <div class="profile-avatar">
                    <?php if ($user['picture']): ?>
                        <img src="<?php echo safe($user['picture']); ?>" alt="Profile">
                    <?php else: ?>
                        👤
                    <?php endif; ?>
                </div>
                <div class="profile-info">
                    <h2><?php echo safe($user['name']); ?></h2>
                    <p class="profile-email">📧 <?php echo safe($user['email']); ?></p>
                    <span class="profile-badge">
                        <?php 
                        if ($user['provider'] === 'Google') {
                            echo '✓ Verified with Google';
                        } elseif ($user['provider'] === 'GitHub') {
                            echo '✓ Verified with GitHub';
                        } else {
                            echo '✓ Verified Member';
                        }
                        ?>
                    </span>
                </div>
            </div>
            
            <div class="sections">
                <div class="section-card">
                    <div class="section-icon">☕</div>
                    <h3 class="section-title">My Orders</h3>
                    <p class="section-desc">View your order history, track recent purchases, and see your favorite items.</p>
                </div>
                
                <div class="section-card">
                    <div class="section-icon">⭐</div>
                    <h3 class="section-title">Reviews & Ratings</h3>
                    <p class="section-desc">Share your coffee experience and help other coffee lovers find their perfect cup.</p>
                </div>
                
                <div class="section-card">
                    <div class="section-icon">❤️</div>
                    <h3 class="section-title">Favorites</h3>
                    <p class="section-desc">Save your favorite drinks and items for quick access next time.</p>
                </div>
                
                <div class="section-card">
                    <div class="section-icon">🎁</div>
                    <h3 class="section-title">Loyalty Rewards</h3>
                    <p class="section-desc">Earn points with every purchase and unlock exclusive rewards and discounts.</p>
                </div>
                
                <div class="section-card">
                    <div class="section-icon">🔔</div>
                    <h3 class="section-title">Notifications</h3>
                    <p class="section-desc">Stay updated with new menu items, special offers, and community events.</p>
                </div>
                
                <div class="section-card">
                    <div class="section-icon">💬</div>
                    <h3 class="section-title">Community Chat</h3>
                    <p class="section-desc">Connect with other coffee enthusiasts and share your brewing tips.</p>
                </div>
            </div>
            
            <div class="account-options">
                <h3>📋 Account Information</h3>
                <div class="info-item">
                    <span class="info-label">Account Name</span>
                    <span class="info-value"><?php echo safe($user['name']); ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">Email Address</span>
                    <span class="info-value"><?php echo safe($user['email']); ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">Authentication Method</span>
                    <span class="info-value"><?php echo safe($user['provider']); ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">Member Since</span>
                    <span class="info-value"><?php echo date('F j, Y', $_SESSION['login_time']); ?></span>
                </div>
            </div>
            
            <div class="footer">
                <p>🏪 Brew Haven Cafe | Where Every Cup Tells a Story</p>
                <p style="font-size: 0.9em; color: #b8a896; margin-top: 15px;">Thank you for being part of our coffee community!</p>
            </div>
        </div>
    </div>
</body>
</html>
