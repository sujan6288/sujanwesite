<?php require "config.php"; include "header.php";
$msg = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $bname = trim($_POST["business_name"]);
  $email = trim($_POST["email"]);
  $pass = $_POST["password"];
  if ($bname && filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($pass) >= 6) {
    $hash = password_hash($pass, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO providers (business_name,owner_name,email,password_hash,phone,city,category,description) VALUES (?,?,?,?,?,?,?,?)");
    try {
      $stmt->execute([$bname,$_POST["owner_name"] ?? null,$email,$hash,$_POST["phone"] ?? null,$_POST["city"] ?? null,$_POST["category"] ?? null,$_POST["description"] ?? null]);
      $msg = "Registration successful. Await verification by admin.";
    } catch (Exception $e) { $msg = "Email already exists."; }
  } else { $msg = "Invalid input."; }
}
?>
<h2>Provider Registration</h2>
<p class="msg"><?php echo htmlspecialchars($msg); ?></p>
<form method="post" class="card">
  <label>Business Name<input name="business_name" required></label>
  <label>Owner Name<input name="owner_name"></label>
  <label>Email<input name="email" type="email" required></label>
  <label>Password<input name="password" type="password" required></label>
  <label>Phone<input name="phone"></label>
  <label>City<input name="city"></label>
  <label>Category<input name="category" placeholder="Plumber, Electrician, Tutor"></label>
  <label>Description<textarea name="description"></textarea></label>
  <button class="btn-primary">Register</button>
</form>
<p><a href="login_provider.php">Already registered? Login</a></p>
<?php include "footer.php"; ?>
