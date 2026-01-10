<?php require_once "config.php"; require_once "auth.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Local Service Finder</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
<header class="site-header">
  <a href="index.php" class="logo btn">Local Service Finder</a>
  <nav class="nav">
    <a href="search.php">Find Services</a>
    <?php if (isLoggedInUser()): ?>
      <a href="user_messages.php" class="btn">My Messages</a>
    <?php endif; ?>
    <?php if (isLoggedInProvider()): ?>
      <a href="provider_dashboard.php" class="btn">Provider Dashboard</a>
    <?php endif; ?>
    <?php if (isLoggedInAdmin()): ?>
      <a href="admin_dashboard.php" class="btn">Admin</a>
    <?php endif; ?>
    <?php if (!isLoggedInUser() && !isLoggedInProvider() && !isLoggedInAdmin()): ?>
      <div class="dropdown">
        <button class="btn">Login</button>
        <div class="dropdown-content">
          <a href="login_user.php" >User</a>
          <a href="login_provider.php" >Provider</a>
          <a href="login_admin.php">Admin</a>
        </div>
      </div>
    <?php else: ?>
      <a href="logout.php" class="btn-outline">Logout</a>
    <?php endif; ?>
  </nav>
</header>
<main class="container">
