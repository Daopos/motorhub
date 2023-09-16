<?php
require('connect.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="./style/home.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <link rel="stylesheet" href="./style/account.css">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300&display=swap" rel="stylesheet">
</head>

<body>
  <?php
  include('nav.php');
  session_start();
  $c_id = $_SESSION['id'];

  if (!isset($_SESSION["id"])) {
    header("Location: login.php");
    exit();
  }

  $query = "SELECT * FROM customer WHERE id = $c_id";
  $result = mysqli_query($connect, $query);
  $row = mysqli_fetch_assoc($result);

  $email = $row['email'];
  $name = $row['name'];

  $phone = $row['phone'];

  $address = $row['address'];
  ?>

  <div class="account-container">
    <div>
      <h1><i class="fas fa-user"></i></h1>
      <h1>Name: <?php echo $name ?></h1>
      <h1>Email: <?php echo $email ?></h1>
      <h1>Phone Number: <?php echo $phone ?></h1>
      <h1>Address: <?php echo $address ?></h1>
    </div>
    <div>
      <form action="account.php" method="POST" onsubmit="return confirmLogout();">
        <input name="logout" type="submit" value="Logout">
      </form>
    </div>
  </div>

  <script>
    function confirmLogout() {
      return confirm("Are you sure you want to logout?");
    }
  </script>

  <?php
  if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: http://localhost/motorhub/login.php");
  }
  ?>
</body>

</html>

</html>