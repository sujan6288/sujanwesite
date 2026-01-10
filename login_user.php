<?php require "config.php"; include "header.php";
$msg = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $email = trim($_POST["email"]);
  $pass = $_POST["password"];
  $stmt = $pdo->prepare("SELECT id,password_hash FROM users WHERE email=?");
  $stmt->execute([$email]);
  $u = $stmt->fetch();
  if ($u && password_verify($pass, $u["password_hash"])) {
    $_SESSION["user_id"] = $u["id"];
    header("Location: index.php"); exit;
  } else { $msg = "Invalid credentials."; }
}
?>
<h2>User Login</h2>
<p class="msg"><?php echo htmlspecialchars($msg); ?></p>
<form method="post" class="card">
  <label>Email<input name="email" type="email" required></label>
  <label>Password<input name="password" type="password" required></label>
  <button class="btn-primary">Login</button>
</form>
<p><a href="register_user.php">Create an account</a></p>
<?php include "footer.php"; ?>
