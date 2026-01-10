<?php require "config.php"; include "header.php";
$q = isset($_GET["q"]) ? trim($_GET["q"]) : "";
$city = isset($_GET["city"]) ? trim($_GET["city"]) : "";

$sql = "SELECT s.*, p.business_name, p.phone, p.city AS provider_city 
        FROM services s 
        JOIN providers p ON s.provider_id = p.id 
        WHERE s.available = 1 AND p.verified = 1";
$params = [];

if ($q) { $sql .= " AND (s.category LIKE ? OR s.title LIKE ? OR p.business_name LIKE ?)"; $params[] = "%$q%"; $params[] = "%$q%"; $params[] = "%$q%"; }
if ($city) { $sql .= " AND (s.service_city LIKE ? OR p.city LIKE ?)"; $params[] = "%$city%"; $params[] = "%$city%"; }

$sql .= " ORDER BY s.created_at DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$rows = $stmt->fetchAll();
?>
<h2>Search results</h2>
<form class="search-inline" method="get">
  <input name="q" placeholder="Service" value="<?php echo htmlspecialchars($q); ?>">
  <input name="city" placeholder="City" value="<?php echo htmlspecialchars($city); ?>">
  <button class="btn-primary">Search</button>
</form>

<div class="list">
<?php foreach ($rows as $r): ?>
  <article class="card">
    <h3><?php echo htmlspecialchars($r["title"]); ?> </h3>
    <p><strong>Category:</strong> <?php echo htmlspecialchars($r["category"]); ?></p>
    <p><strong>Provider:</strong> <?php echo htmlspecialchars($r["business_name"]); ?></p>
    <p><strong>City:</strong> <?php echo htmlspecialchars($r["service_city"] ?: $r["provider_city"]); ?></p>
    <p><strong>Price:</strong> <?php echo htmlspecialchars($r["price_range"]); ?></p>
    <p><strong>Details:</strong></p> <div class="description-box"><?php echo nl2br(htmlspecialchars($r["details"])); ?></div>
    <div class="actions">
      <a class="btn-outline" href="service_details.php?id=<?php echo $r["id"]; ?>">View details</a>
    </div>
  </article>
<?php endforeach; ?>
<?php if (empty($rows)): ?>
  <p>No services found. Try different keywords or city.</p>
<?php endif; ?>
</div>
<?php include "footer.php"; ?>
