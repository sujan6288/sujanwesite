<?php include "config.php"; include "header.php"; ?>
<section class="hero">
  <h1>Find trusted local services</h1>
  <p>Plumbers, electricians, technicians, tutors all in one place.</p>
  <form action="search.php" method="get" class="search-inline">
    <input name="q" placeholder="Search service e.g., plumber" />
    <input name="city" placeholder="City e.g., Kathmandu" />
    <button class="btn-primary">Search</button>
  </form>
</section>

<section class="grid">
  <div class="card shadow">
    <h3>For Users</h3>
    <p>Search and contact verified service providers near you.</p>
    <a class="btn-outline" href="register_user.php">Create account</a>
  </div>
  <div class="card shadow">
    <h3>For Providers</h3>
    <p>List your services, manage details, and get new leads.</p>
    <a class="btn-outline" href="register_provider.php">Join as provider</a>
  </div>
  <div class="card shadow">
    <h3>Admin Panel</h3>
    <p>Verify providers and manage site data.</p>
    <a class="btn-outline" href="login_admin.php">Login as admin</a>
  </div>
</section>
<?php include "footer.php"; ?>
