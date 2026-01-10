<?php
function isLoggedInUser() { return isset($_SESSION['user_id']); }
function isLoggedInProvider() { return isset($_SESSION['provider_id']); }
function isLoggedInAdmin() { return isset($_SESSION['admin_id']); }

function requireUser() { if (!isLoggedInUser()) { header('Location: login_user.php'); exit; } }
function requireProvider() { if (!isLoggedInProvider()) { header('Location: login_provider.php'); exit; } }
function requireAdmin() { if (!isLoggedInAdmin()) { header('Location: login_admin.php'); exit; } }
?>
