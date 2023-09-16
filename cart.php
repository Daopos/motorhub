<?php
require('connect.php');
session_start();

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
    if (!isset($_SESSION["id"])) {
        header("Location: login.php");
        exit();
    }
    ?>

    <div class="cart-container">
        <?php

        $getcart = "SELECT * FROM cart WHERE customer_id = $c_id";

        $query = mysqli_query($connect, $getcart);

        $im = null;
        $pn = null;
        $pr = null;
        $qty = null;
        $total = null;
        $cid = null;
        $pid = null;

        while ($row = mysqli_fetch_array($query)) {
            echo '
    <div class="box-product">
            <form action="cart.php" method="POST">
                <img src="./admin/photos/' . $row['image'] . '" alt="">
                <h1>' . $row['name'] . '</h1>
                <h2>Price: P' . $row['price'] . '</h2>
                <h2>Qty: ' . $row['quantity'] . '</h2>
                <h2>Total: ' . $row['total'] . '</h2>
                <input name="getid" type="hidden" value=" ' . $row['id'] . '">
                <input name="getquan" type="hidden" value=" ' . $row['quantity'] . '">
                <input name="getotal" type="hidden" value=" ' . $row['total'] . '">
                <input name="getprod" type="hidden" value=" ' . $row['product_id'] . '">
                
                <input name="checkout" type="submit" value="Checkout">
                <input name="cancel" type="submit" value="Cancel">
            </form>
        </div>
    ';
        }

        ?>

        <?php

        if (isset($_POST['cancel'])) {

            $getid = $_POST['getid'];

            $deletecart = "DELETE FROM cart WHERE id = $getid";
            $delete = mysqli_query($connect, $deletecart);

            header("Location: http://localhost/motorhub/cart.php");
            exit();
            ob_end_clean();
        }

        if (isset($_POST['checkout'])) {
            $prod = $_POST['getprod'];
            $total = $_POST['getotal'];
            $quantity = $_POST['getquan'];
            header("Location: http://localhost/motorhub/checkout.php?id=" . $prod . "&total=" . $total . "&qty=" . $quantity);
            exit();
            ob_end_clean();
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