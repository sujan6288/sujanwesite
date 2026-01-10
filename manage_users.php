<?php require "config.php"; require "auth.php"; requireAdmin(); include "header.php";
if (isset($_GET["delete"])) {
  $id = (int)$_GET["delete"];
  $pdo->prepare("DELETE FROM users WHERE id=?")->execute([$id]);
}
$rows = $pdo->query("SELECT * FROM users ORDER BY created_at DESC")->fetchAll();
?>
<h2>Manage users</h2>
<div class="list">
<?php foreach ($rows as $u): ?>
  <article class="card">
    <h3><?php echo htmlspecialchars($u["name"]); ?></h3>
    <p><strong>City:</strong> <?php echo htmlspecialchars($u["city"]); ?></p>
    <p><strong>Contact:</strong> <?php echo htmlspecialchars($u["phone"]); ?> <?php echo htmlspecialchars($u["email"]); ?></p>
    <div class="actions">
      <a class="btn-outline danger" href="?delete=<?php echo $u["id"]; ?>" onclick="return confirm('Delete user?')">Delete</a>
    </div>
  </article>
<?php endforeach; ?>
</div>
<?php include "footer.php"; ?>
