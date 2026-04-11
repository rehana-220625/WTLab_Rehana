<?php
// ============================================
// Logout Handler
// ============================================

require_once __DIR__ . '/includes/config.php';

logout_user();
set_flash('success', 'You have been logged out. We hope to see you again soon!');
header('Location: index.php');
exit;
?>
