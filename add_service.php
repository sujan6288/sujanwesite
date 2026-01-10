<?php require "config.php"; require "auth.php"; requireProvider(); include "header.php";
$msg = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $stmt = $pdo->prepare("INSERT INTO services (provider_id,title,category,service_city,price_range,details,available) VALUES (?,?,?,?,?,?,?)");
  $stmt->execute([$_SESSION["provider_id"],$_POST["title"],$_POST["category"],$_POST["service_city"],$_POST["price_range"],$_POST["details"],1]);
  $msg = "Service added.";
}
?>
<h2>Add service</h2>
<p class="msg"><?php echo htmlspecialchars($msg); ?></p>
<form method="post" class="card">
  <label>Title<input name="title" required></label>
  <label>Category<input name="category" required placeholder="Plumber, Electrician, Tutor"></label>
  <label>City<input name="service_city" required></label>
  <label>Price range<input name="price_range" placeholder="Rs 1000-3000"></label>
  <label>Details<textarea name="details" required></textarea></label>
  <button class="btn-primary">Create</button>
</form>
<?php include "footer.php"; ?>
