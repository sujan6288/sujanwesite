<?php require "config.php"; require "auth.php"; requireProvider(); include "header.php";
$pid = $_SESSION["provider_id"];
if (isset($_GET["toggle"])) {
  $id = (int)$_GET["toggle"];
  $pdo->prepare("UPDATE services SET available = 1 - available WHERE id=? AND provider_id=?")->execute([$id,$pid]);
}
if (isset($_GET["delete"])) {
  $id = (int)$_GET["delete"];
  $pdo->prepare("DELETE FROM services WHERE id=? AND provider_id=?")->execute([$id,$pid]);
}
$stmt = $pdo->prepare("SELECT * FROM services WHERE provider_id=? ORDER BY created_at DESC");
$stmt->execute([$pid]);
$rows = $stmt->fetchAll();
?>
<h2>Manage my services</h2>
<div class="list">
<?php foreach ($rows as $r): ?>
  <article class="card">
    <h3><?php echo htmlspecialchars($r["title"]); ?> (<?php echo htmlspecialchars($r["category"]); ?>)</h3>
    <p><strong>Status:</strong> <?php echo $r["available"] ? "Available" : "Unavailable"; ?></p>
    <p><?php echo nl2br(htmlspecialchars($r["details"])); ?></p>
    <div class="actions">
      <a class="btn-outline" href="?toggle=<?php echo $r["id"]; ?>">Toggle availability</a>
      <a class="btn-outline danger" href="?delete=<?php echo $r["id"]; ?>" onclick="return confirm('Delete this service?')">Delete</a>
    </div>
  </article>
<?php endforeach; ?>
<?php if (empty($rows)): ?><p>No services yet.</p><?php endif; ?>
</div>
<?php include "footer.php"; ?>
