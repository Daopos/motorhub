<?php
require('connect.php');

session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit();
}
$getpending = "SELECT COUNT(*) AS total_order FROM orders WHERE status = 'processing'";
$pending = mysqli_query($connect, $getpending);
$rowq = mysqli_fetch_assoc($pending);
$active = $rowq['total_order'];

$getproducts = "SELECT COUNT(*) AS total_rows FROM products";
$products = mysqli_query($connect, $getproducts);
$roww = mysqli_fetch_assoc($products);
$totalproducts = $roww['total_rows'];

$getship = "SELECT COUNT(*) AS total_rows FROM orders WHERE status = 'ship'";
$ship = mysqli_query($connect, $getship);
$rowe = mysqli_fetch_assoc($ship);
$totalship = $rowe['total_rows'];



$getcompleted = "SELECT COUNT(*) AS total_rows FROM orders WHERE status = 'completed'";
$completed = mysqli_query($connect, $getcompleted);
$rowqq = mysqli_fetch_assoc($completed);
$totalcompleted = $rowqq['total_rows'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>
    <link rel="stylesheet" href="./style/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300&display=swap" rel="stylesheet">
</head>

<body>
    <?php
    include('nav.php');
    ?>
    <div class="dash-container">
        <div class="box-white">
            <div>
                <h1>Pending Orders
                    <h1><?php echo $active ?></h1>
            </div>
            <div>
            <i class="fa-solid fa-circle-pause"></i>
            </div>
            </h1>
        </div>
        <div class="box-white">
            <div>
                <h1>All Products
                    <h1><?php echo $totalproducts ?></h1>
            </div>
            <div>
                <i class="fa-solid fa-file-invoice-dollar"></i>
            </div>
            </h1>
        </div>
        <div class="box-white">
            <div>
                <h1>Shipped products
                    <h1><?php echo $totalship ?></h1>
            </div>
            <div>
            <i class="fa-solid fa-truck-fast"></i>
            </div>
            </h1>
        </div>
        <div class="box-white">
            <div>
                <h1>Completed Products
                    <h1><?php echo $totalcompleted ?></h1>
            </div>
            <div>
            <i class="fa-solid fa-list"></i>
            </div>
            </h1>
        </div>
    </div>
</body>

</html>