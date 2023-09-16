<?php
require('connect.php');
session_start();

if (!isset($_SESSION["id"])) {
    header("Location: login.php");
    exit();
  }

ob_start();

$c_id = $_SESSION['id'];

// $getcart = "SELECT * FROM cart WHERE customer_id = $c_id";

// $query = mysqli_query($connect, $getcart);

// $im = null;
// $pn = null;
// $pr = null;
// $qty = null;
// $total = null;
// $cid = null;
// $pid = null;

// while ($row = mysqli_fetch_array($query)) {
//     $im = $row['image'];
//     $pn = $row['name'];
//     $pr = $row['price'];
//     $qty = $row['quantity'];
//     $total = $row['total'];
//     $cid = $row['customer_id'];
//     $pid = $row['product_id'];
// }


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="./style/cart.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300&display=swap" rel="stylesheet">
</head>

<body>
    <?php
    include('nav.php');

    ?>

    <div class="cart-container">
        <?php

        $getcart = "SELECT * FROM orders WHERE customer_id = $c_id";

        $query = mysqli_query($connect, $getcart);

        $im = null;
        $pn = null;
        $pr = null;
        $qty = null;
        $cid = null;
        $pid = null;

        while ($row = mysqli_fetch_array($query)) {
            echo '
    <div class="box-product">
            <form action="cart.php" method="POST">
                <img src="./admin/photos/' . $row['image'] . '" alt="">
                <h1>Name: ' . $row['name'] . '</h1>
                <h2>Price: P' . $row['price'] . '</h2>
                <h2>Qty: ' . $row['quantity'] . '</h2>
                <h2>Total: ' . $row['total_cost'] . '</h2>
                <h2>Order By: ' . $row['name'] . '</h2>
                <h2>Ship to: ' . $row['address'] . '</h2>
                <h2>Phone: ' . $row['phone'] . '</h2>
                <h2>Status: ' . $row['status'] . '</h2>
            </form>
        </div>
    ';
        }

        ?>



        <!-- <div class="box-product">
            <form action="">

                <img src="./photos/car.png" alt="">
                <h1>Gold Bolts Caliper</h1>
                <h2>P128</h2>
                <h2>qty: 4</h2>
                <h2>Total: 400</h2>
                <input type="submit" value="Checkout">
                <input type="submit" value="Cancel">
            </form>
        </div> -->
    </div>
</body>

</html>