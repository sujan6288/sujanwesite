<?php require "config.php"; require "auth.php"; requireProvider(); include "header.php";
$pid = $_SESSION["provider_id"];
$countServices = $pdo->prepare("SELECT COUNT(*) AS c FROM services WHERE provider_id=?");
$countServices->execute([$pid]);
$cs = $countServices->fetch()["c"];

$countMessages = $pdo->prepare("SELECT COUNT(*) AS c FROM messages WHERE provider_id=?");
$countMessages->execute([$pid]);
$cm = $countMessages->fetch()["c"];
?>
<h2>Provider Dashboard</h2>
<div class="grid">
  <div class="card"><h3>My Services</h3><p><?php echo $cs; ?> listed</p><a class="btn-outline" href="manage_services.php">Manage services</a></div>
  <div class="card"><h3>Messages</h3><p><?php echo $cm; ?> inquiries</p><a class="btn-outline" href="provider_messages.php">View messages</a></div>
  <div class="card"><h3>Add Service</h3><p>Create a new service listing</p><a class="btn-outline" href="add_service.php">Add service</a></div>
</div>
<?php include "footer.php"; ?>
