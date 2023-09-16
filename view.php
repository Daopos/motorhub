<?php
require('connect.php');
session_start();
?>
<?php
$id = $_GET['id'];
$c_id = $_SESSION['id'];

$get = "SELECT * FROM products WHERE id = $id";
$query = mysqli_query($connect, $get);

$im = null;
$pn = null;
$desc = null;
$quan = null;
$pr = null;
$pi = null;

while ($row = mysqli_fetch_array($query)) {
    $im = $row['image'];
    $pn = $row['name'];
    $desc =  $row['description'];
    $quan =  $row['quantity'];
    $pr =  $row['price'];
    $pi = $row['id'];
}

if (!isset($_SESSION["id"])) {
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
    <link rel="stylesheet" href="./style/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="./style/view.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>
</head>

<body>
    <?php
    include('nav.php');
    ?>

    <div class="view-container">
        <div class="view-box">
            <div class="firstview">
                <img src="./admin/photos/<?php echo $im ?>" alt="">
            </div>
            <div class="secondview">
                <form action="view.php?id=<?php echo $id ?>" method="POST">
                    <h1>Name: <?php echo $pn ?></h1>
                    <h1>Price: P<?php echo $pr ?></h1>
                    <h1>Details: <?php echo $desc ?></h1>
                    <h1>Quantity: <?php echo $quan ?></h1>
                    <input name="quantity" type="number" value="1">
                    <div class="twoin">
                        <input name="addcart" type="submit" value="Add to Cart">
                        <input name="checkout" type="submit" value="Checkout">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    $prod = $_GET['id'];
    $image = $im;
    $name = $pn;
    $price = $pr;

    $checkcart = "SELECT quantity, id FROM cart WHERE customer_id = $c_id AND product_id = $id";
    $cartres = mysqli_query($connect, $checkcart);
    $row = mysqli_fetch_assoc($cartres);
    $cartid = isset($row['id']) ? $row['id'] : 0;
    $cartqty = isset($row['quantity']) ? $row['quantity'] : 0;

    $totalqty =  $quan - $cartqty;

    echo $totalqty;
    if (isset($_POST['addcart'])) {
        $quantity = $_POST['quantity'];


        if ($quantity >  $quan || $quantity <= 0) {

            header("Location: http://localhost/motorhub/view.php?id=" . $prod . "&error=true");
        } else if ($quantity > $totalqty || $quantity <= 0) {

            header("Location: http://localhost/motorhub/view.php?id=" . $prod . "&errors=true");
        } else if ($cartqty > 0 && $cartid > 0) {
            $increadd = "UPDATE cart SET quantity = quantity + $quantity WHERE id = $cartid";
            $querysss = mysqli_query($connect, $increadd);
            header("Location: http://localhost/motorhub/view.php?id=" . $prod . "&succes=true");
        } else {
            $total = $price * $quantity;
            $addcart = "INSERT INTO cart(customer_id, product_id, name, total, price,quantity, image) VALUES($c_id, $pi, '$name', $total, $price, $quantity, '$image')";
            $querys = mysqli_query($connect, $addcart);
            header("Location: http://localhost/motorhub/view.php?id=" . $prod  . "&succes=true");
        }
    }
    if (isset($_POST['checkout'])) {
        $quantity = $_POST['quantity'];

        if ($quantity >  $quan || $quantity <= 0) {
            header("Location: http://localhost/motorhub/view.php?id=" . $prod . "&out=true");
        } else {
            $total = $price * $quantity;

            header("Location: http://localhost/motorhub/checkout.php?id=" . $prod . "&total=" . $total . "&qty=" . $quantity);
        }
    }




    ?>


    <?php

    if (isset($_GET['error'])) {

        echo '<script>
    Swal.fire({
        icon: "error",
        title: "Error!",
        text: "Invalid quantity. Please enter a valid quantity."
    });
   </script>';
    }

    if (isset($_GET['out'])) {

        echo '<script>
    Swal.fire({
        icon: "error",
        title: "Error!",
        text: "Out of Stock."
    });
   </script>';
    }

    ?>
    <?php

    if (isset($_GET['succes'])) {

        echo '<script>
    Swal.fire({
        icon: "success",
        title: "Add!",
        text: "Added to cart"
    });
   </script>';
    }

    ?>
    <?php

    if (isset($_GET['errors'])) {

        echo '<script>
    Swal.fire({
        icon: "error",
        title: "Error!",
        text: "Cart Quantity exceeds"
    });
   </script>';
    }

    ?>

</body>

</html>