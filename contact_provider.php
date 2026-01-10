<?php require "config.php"; require "auth.php"; requireUser(); include "header.php";
$provider_id = (int)($_GET["provider_id"] ?? 0);
$msg = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $stmt = $pdo->prepare("INSERT INTO messages (user_id, provider_id, subject, body, contact_phone, contact_email) VALUES (?,?,?,?,?,?)");
  $stmt->execute([$_SESSION["user_id"],$provider_id,$_POST["subject"],$_POST["body"],$_POST["contact_phone"],$_POST["contact_email"]]);
  $msg = "Message sent.";
}
?>
<h2>Contact provider</h2>
<p class="msg"><?php echo htmlspecialchars($msg); ?></p>
<form method="post" class="card">
  <label>Subject<input name="subject" required></label>
  <label>Your message<textarea name="body" required></textarea></label>
  <label>Your phone<input name="contact_phone"></label>
  <label>Your email<input name="contact_email" type="email"></label>
  <button class="btn-primary">Send</button>
</form>
<?php include "footer.php"; ?>
