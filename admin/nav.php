<nav class="navbar">
  <div class="centernav">
    <div>
      <a href="dashboard.php" class="fixadmin"><span>Admin</span>Page</a>
    </div>
    <div class="nav-a">
      <a href="dashboard.php">Home</a>
      <a href="products.php">Products</a>
      <a href="add.php">Add Product</a>
      <a href="order.php">Order</a>
    </div>
    <div>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST" onsubmit="return confirmLogout();">
        <input name="logout" type="submit" value="Logout">
      </form>
    </div>
  </div>
</nav>

<script>
  function confirmLogout() {
    return confirm("Are you sure you want to logout?");
  }
</script>

<?php
if (isset($_POST['logout'])) {
  session_destroy();
  header("Location: http://localhost/motorhub/admin/login.php");
}
?>