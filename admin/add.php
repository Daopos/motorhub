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
    <link rel="stylesheet" href="./style/add.css">
    <link rel="stylesheet" href="./style/dashboard.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300&display=swap" rel="stylesheet">
</head>

<body>
    <?php
    include('nav.php');
    ?>
    <div class="add">
        <h1>Make product</h1>
        <form enctype="multipart/form-data" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
            <div class="add-container">
                <input name="image" type="file">
                <input name="name" type="text" placeholder="product name">
                <input name="desc" type="text" placeholder="description">
                <input name="quantity" type="number" placeholder="Quantity">
                <input name="price" type="number" placeholder="Price">
                <input name="submit" type="submit">
            </div>
        </form>
    </div>

    <?php

    if (isset($_POST['submit'])) {
        $productname = isset($_POST['name']) ? filter_input(INPUT_POST, "name",  FILTER_SANITIZE_FULL_SPECIAL_CHARS) : '';
        $description = isset($_POST['desc']) ? filter_input(INPUT_POST, "desc",  FILTER_SANITIZE_FULL_SPECIAL_CHARS) : '';
        $price = isset($_POST['price']) ? filter_input(INPUT_POST, "price",  FILTER_VALIDATE_INT) : '';
        $quantity = isset($_POST['quantity']) ? filter_input(INPUT_POST, "quantity",  FILTER_VALIDATE_INT) : '';
        $image = '';


        if (isset($_FILES["image"])) {

            $img_name = $_FILES['image']['name'];
            $img_size = $_FILES['image']['size'];
            $tmp_name = $_FILES['image']['tmp_name'];
            $tmp_name = $_FILES['image']['tmp_name'];
            $error = $_FILES['image']['error'];

            if ($error === 0) {

                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);

                $allowed_exs = array("jpg", "jpeg", "png", "webp");

                if (in_array($img_ex_lc, $allowed_exs)) {
                    $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                    $img_upload_path = 'photos/' . $new_img_name;
                    move_uploaded_file($tmp_name, $img_upload_path);

                    $image = $new_img_name;
                } else {
                    // unknow error
                }
            }
        }

        $sql = "INSERT INTO products(name, description, quantity, price, image) VALUES('$productname', '$description', $quantity, $price, '$image')";
        $checkQuery = mysqli_query($connect, $sql);
        // header("Location: http://localhost/ecommerce/admin/adminadd.php?add=true");
    }


    ?>
</body>

</html>