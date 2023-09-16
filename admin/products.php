<?php
require('connect.php');
session_start();
if (!isset($_SESSION["admin"])) {
  header("Location: login.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="./style/products.css">
  <link rel="stylesheet" href="./style/dashboard.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300&display=swap" rel="stylesheet">
</head>

<body>
  <?php
  include('nav.php');
  ?>


  <div class="table-container">
    <table>
      <tr>
        <th>No.</th>
        <th>Name</th>
        <th>price</th>
        <th>qty</th>
        <th>Action</th>
      </tr>
      <?php
      $get = "SELECT * FROM products";
      $query = mysqli_query($connect, $get);
      $incre = 1;
      while ($row = mysqli_fetch_array($query)) {
        echo '
      <tr>
          <td> ' . $incre++  . '</td>
          <td>' . $row['name'] . '</td>
          <td>' . $row['price'] . '</td>
          <td>' . $row['quantity'] . '</td>
          <td class="inputs">
            <a href="view.php?id=' . $row['id'] . '">View</a>
            <a href="edit.php?id=' . $row['id'] . '">Edit</a>
            <form class="delete-form" action="products.php" method="POST">
              <input name="getid" type="hidden" value="' . $row['id'] . '">
              <input name="delete" type="submit" value="Delete" onclick="return confirmDelete();">
            </form>
          </td>
        </tr>
      ';
      }
      ?>

      <script>
        function confirmDelete() {
          return confirm("Are you sure you want to delete this product?");
        }
      </script>

      <?php
      if (isset($_POST['delete'])) {
        $id = $_POST['getid'];
        $del = "DELETE FROM products WHERE id = $id";
        $que = mysqli_query($connect, $del);
        header("Location: http://localhost/motorhub/admin/products.php");
      }
      ?>
    </table>
  </div>

</body>

</html>