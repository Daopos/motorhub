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
    <link rel="stylesheet" href="./style/product.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300&display=swap" rel="stylesheet">
</head>

<body>
    <?php
    include('nav.php');
    ?>

    <div class="product-container">
        <?php

        $get = "SELECT * FROM products";
        $query = mysqli_query($connect, $get);
        $incre = 1;
        while ($row = mysqli_fetch_array($query)) {

            echo '
    <a href="view.php?id=' . $row['id'] . '">
        <div class="box-product">
            <img src="./admin/photos/' . $row['image'] . '" alt="">
            <h1>Name: ' . $row['name'] . '</h1>
            <h2>Price: P' . $row['price'] . '</h2>
            <h2>Qty: ' . $row['quantity'] . '</h2>
        </div>
    </a>

    ';
        }

        ?>



    </div>
</body>

</html>