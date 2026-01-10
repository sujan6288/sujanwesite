<?php require "config.php"; include "header.php";
$id = (int)($_GET["id"] ?? 0);
$stmt = $pdo->prepare("SELECT s.*, p.business_name, p.email AS provider_email, p.phone AS provider_phone 
                       FROM services s JOIN providers p ON s.provider_id=p.id WHERE s.id=? AND p.verified=1");
$stmt->execute([$id]);
$s = $stmt->fetch();
if (!$s) { echo "<p>Service not found.</p>"; include "footer.php"; exit; }
?>
<h2><?php echo htmlspecialchars($s["title"]); ?></h2>
<p><strong>Category:</strong><?php echo htmlspecialchars($s["category"]); ?></p>
<p><strong>Provider:</strong> <?php echo htmlspecialchars($s["business_name"]); ?></p>
<p><strong>Contact No:</strong> <?php echo htmlspecialchars($s["provider_phone"]); ?> </p>
<p><strong>Email:<strong><?php echo htmlspecialchars($s["provider_email"]); ?></p>
<p><strong>City:</strong> <?php echo htmlspecialchars($s["service_city"]); ?></p>
<p><strong>Price:</strong> <?php echo htmlspecialchars($s["price_range"]); ?></p>
<p><strong>Details:<strong><div class="description-box"> <?php echo htmlspecialchars($s["details"]); ?></div></p>

<?php if (isLoggedInUser()): ?>
  <a class="btn-primary" href="contact_provider.php?provider_id=<?php echo $s["provider_id"]; ?>&service_id=<?php echo $s["id"]; ?>">Contact provider</a>
<?php else: ?>
  <p class="msg">Login as a user to send a message.</p>
<?php endif; ?>
<?php include "footer.php"; ?>
