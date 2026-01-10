<?php require "config.php"; require "auth.php"; requireUser(); include "header.php";
$uid = $_SESSION["user_id"];
$stmt = $pdo->prepare("SELECT m.*, p.business_name FROM messages m JOIN providers p ON m.provider_id=p.id WHERE m.user_id=? ORDER BY m.created_at DESC");
$stmt->execute([$uid]);
$rows = $stmt->fetchAll();
?>
<h2>My messages</h2>
<div class="list">
<?php foreach ($rows as $m): ?>
  <article class="card">
    <h3><?php echo htmlspecialchars($m["subject"]); ?> to <?php echo htmlspecialchars($m["business_name"]); ?></h3>
    <p><?php echo nl2br(htmlspecialchars($m["body"])); ?></p>
    <p><small><?php echo htmlspecialchars($m["created_at"]); ?></small></p>
  </article>
<?php endforeach; ?>
<?php if (empty($rows)): ?><p>No messages yet.</p><?php endif; ?>
</div>
<?php include "footer.php"; ?>
