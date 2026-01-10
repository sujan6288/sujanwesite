<?php require "config.php"; include "header.php";
$msg = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $email = trim($_POST["email"]);
  $pass = $_POST["password"];
  $stmt = $pdo->prepare("SELECT id,password_hash FROM admins WHERE email=?");
  $stmt->execute([$email]);
  $a = $stmt->fetch();
  if ($a && password_verify($pass, $a["password_hash"])) {
    $_SESSION["admin_id"] = $a["id"];
    header("Location: admin_dashboard.php"); exit;
  } else { $msg = "Invalid credentials."; }
}
?>
<h2>Admin Login</h2>
<p class="msg"><?php echo htmlspecialchars($msg); ?></p>
<form method="post" class="card">
  <label>Email<input name="email" type="email" required></label>
  <label>Password<input name="password" type="password" required></label>
  <button class="btn-primary">Login</button>
</form>
<?php include "footer.php"; ?>
