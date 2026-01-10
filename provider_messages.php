<?php require "config.php"; require "auth.php"; requireProvider(); include "header.php";
$pid = $_SESSION["provider_id"];
$stmt = $pdo->prepare("SELECT m.*, u.name AS user_name FROM messages m JOIN users u ON m.user_id=u.id WHERE m.provider_id=? ORDER BY m.created_at DESC");
$stmt->execute([$pid]);
$rows = $stmt->fetchAll();
?>
<h2>Messages from users</h2>
<div class="list">
<?php foreach ($rows as $m): ?>
  <article class="card">
    <h3> <?php echo htmlspecialchars($m["user_name"]); ?></h3>
    <p><strong>Subject:</strong> <?php echo htmlspecialchars($m["subject"]); ?> </p>
    <p><strong>Contact:</strong> <?php echo htmlspecialchars($m["contact_phone"]); ?></p>
    <p><strong>Email:</strong>  <?php echo htmlspecialchars($m["contact_email"]); ?></p>
    <p><strong>Details:</strong><div class="description-box"><?php echo htmlspecialchars($m["body"]); ?> </div></p>

    <p><small><?php echo htmlspecialchars($m["created_at"]); ?></small></p>
  </article>
<?php endforeach; ?>
<?php if (empty($rows)): ?><p>No messages yet.</p><?php endif; ?>
</div>
<?php include "footer.php"; ?>
