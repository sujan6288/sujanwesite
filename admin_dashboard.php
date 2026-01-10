<?php require "config.php"; require "auth.php"; requireAdmin(); include "header.php";
$stats = [];
$stats["users"] = $pdo->query("SELECT COUNT(*) AS c FROM users")->fetch()["c"];
$stats["providers"] = $pdo->query("SELECT COUNT(*) AS c FROM providers")->fetch()["c"];
$stats["services"] = $pdo->query("SELECT COUNT(*) AS c FROM services")->fetch()["c"];
?>
<h2>Admin Dashboard</h2>
<div class="grid">
  <div class="card"><h3>Users</h3><p><?php echo $stats["users"]; ?></p><a class="btn-outline" href="manage_users.php">Manage</a></div>
  <div class="card"><h3>Providers</h3><p><?php echo $stats["providers"]; ?></p><a class="btn-outline" href="manage_providers.php">Manage</a></div>
  <div class="card"><h3>Services</h3><p><?php echo $stats["services"]; ?></p><a class="btn-outline" href="manage_services_admin.php">Manage</a></div>
</div>
<?php include "footer.php"; ?>
