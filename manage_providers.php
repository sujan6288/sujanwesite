<?php require "config.php"; require "auth.php"; requireAdmin(); include "header.php";
if (isset($_GET["verify"])) {
  $id = (int)$_GET["verify"];
  $pdo->prepare("UPDATE providers SET verified=1 WHERE id=?")->execute([$id]);
}
if (isset($_GET["unverify"])) {
  $id = (int)$_GET["unverify"];
  $pdo->prepare("UPDATE providers SET verified=0 WHERE id=?")->execute([$id]);
}
if (isset($_GET["delete"])) {
  $id = (int)$_GET["delete"];
  $pdo->prepare("DELETE FROM providers WHERE id=?")->execute([$id]);
}
$rows = $pdo->query("SELECT * FROM providers ORDER BY created_at DESC")->fetchAll();
?>
<h2>Manage providers</h2>
<div class="list">
<?php foreach ($rows as $p): ?>
  <article class="card">
    <h3><?php echo htmlspecialchars($p["business_name"]); ?> (<?php echo htmlspecialchars($p["category"]); ?>)</h3>
    <p><strong>City:</strong> <?php echo htmlspecialchars($p["city"]); ?></p>
    <p><strong>Contact:</strong> <?php echo htmlspecialchars($p["phone"]); ?> 
    <p><strong>Email:</strong> <?php echo htmlspecialchars($p["email"]); ?></p>
    <p><strong>Verified:</strong> <?php echo $p["verified"] ? "Yes" : "No"; ?></p>
    <div class="actions">
      <?php if (!$p["verified"]): ?>
        <a class="btn-outline" href="?verify=<?php echo $p["id"]; ?>">Verify</a>
      <?php else: ?>
        <a class="btn-outline" href="?unverify=<?php echo $p["id"]; ?>">Unverify</a>
      <?php endif; ?>
      <a class="btn-outline danger" href="?delete=<?php echo $p["id"]; ?>" onclick="return confirm('Delete provider?')">Delete</a>
    </div>
  </article>
<?php endforeach; ?>
</div>
<?php include "footer.php"; ?>
