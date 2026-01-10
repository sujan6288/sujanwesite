<?php require "config.php"; include "header.php";
$msg = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $email = trim($_POST["email"]);
  $pass = $_POST["password"];
  $stmt = $pdo->prepare("SELECT id,password_hash,verified FROM providers WHERE email=?");
  $stmt->execute([$email]);
  $p = $stmt->fetch();
  if ($p && password_verify($pass, $p["password_hash"])) {
    if ((int)$p["verified"] === 1) {
      $_SESSION["provider_id"] = $p["id"];
      header("Location: provider_dashboard.php"); exit;
    } else { $msg = "Account not verified by admin yet."; }
  } else { $msg = "Invalid credentials."; }
}
?>
<h2>Provider Login</h2>
<p class="msg"><?php echo htmlspecialchars($msg); ?></p>
<form method="post" class="card">
  <label>Email<input name="email" type="email" required></label>
  <label>Password<input name="password" type="password" required></label>
  <button class="btn-primary">Login</button>
</form>
<?php include "footer.php"; ?>
