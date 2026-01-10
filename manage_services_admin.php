<?php require "config.php"; require "auth.php"; requireAdmin(); include "header.php";
if (isset($_GET["delete"])) {
  $id = (int)$_GET["delete"];
  $pdo->prepare("DELETE FROM services WHERE id=?")->execute([$id]);
}
$rows = $pdo->query("SELECT s.*, p.business_name FROM services s JOIN providers p ON s.provider_id=p.id ORDER BY s.created_at DESC")->fetchAll();
?>
<h2>Manage all services</h2>
<div class="list">
<?php foreach ($rows as $s): ?>
  <article class="card">
    <h3><?php echo htmlspecialchars($s["title"]); ?> â€” <?php echo htmlspecialchars($s["category"]); ?></h3>
    <p><strong>Provider:</strong> <?php echo htmlspecialchars($s["business_name"]); ?></p>
    <p><strong>City:</strong> <?php echo htmlspecialchars($s["service_city"]); ?></p>
    <p><strong>Price:</strong> <?php echo htmlspecialchars($s["price_range"]); ?></p>
    <div class="actions">
      <a class="btn-outline danger" href="?delete=<?php echo $s["id"]; ?>" onclick="return confirm('Delete service?')">Delete</a>
    </div>
  </article>
<?php endforeach; ?>
</div>
<?php include "footer.php"; ?>
