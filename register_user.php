<?php require "config.php"; include "header.php";
$msg = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $name = trim($_POST["name"]);
  $email = trim($_POST["email"]);
  $pass = $_POST["password"];
  if ($name && filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($pass) >= 6) {
    $hash = password_hash($pass, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO users (name,email,password_hash,phone,city) VALUES (?,?,?,?,?)");
    try {
      $stmt->execute([$name,$email,$hash,$_POST["phone"] ?? null,$_POST["city"] ?? null]);
      $msg = "Registration successful. Please login.";
    } catch (Exception $e) { $msg = "Email already exists."; }
  } else { $msg = "Invalid input. Password must be 6+ chars."; }
}
?>
<h2>User Registration</h2>
<p class="msg"><?php echo htmlspecialchars($msg); ?></p>
<form method="post" class="card">
  <label>Name<input name="name" required></label>
  <label>Email<input name="email" type="email" required></label>
  <label>Password<input name="password" type="password" required></label>
  <label>Phone<input name="phone"></label>
  <label>City<input name="city"></label>
  <button type="submit" class="btn-primary">Register</button>
</form>
<p><a href="login_user.php">Already have an account? Login</a></p>
<?php include "footer.php"; ?>
