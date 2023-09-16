<?php
require('connect.php');
ob_start();
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="./style/order.css">
    <link rel="stylesheet" href="./style/dashboard.css">
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
        $getcart = "SELECT * FROM orders";
        $query = mysqli_query($connect, $getcart);

        while ($row = mysqli_fetch_array($query)) {
            echo '
        <div class="box-product">
            <form action="order.php" method="POST">
                <img src="./photos/' . $row['image'] . '" alt="">
                <h1>Name: ' . $row['name'] . '</h1>
                <h2>Price: P' . $row['price'] . '</h2>
                <h2>Qty: ' . $row['quantity'] . '</h2>
                <h2>Total: ' . $row['total_cost'] . '</h2>
                <h2>Order By: ' . $row['name'] . '</h2>
                <h2>Ship to: ' . $row['address'] . '</h2>
                <h2>Phone: ' . $row['phone'] . '</h2>
                <h2>Status: ' . $row['status'] . '</h2>
                <select name="status">
                    <option value="processing" ' . ($row['status'] == "processing" ? "selected" : "") . ' >processing</option>
                    <option value="ship" ' . ($row['status'] == "ship" ? "selected" : "") . '>shipped</option>
                    <option value="completed" ' . ($row['status'] == "completed" ? "selected" : "") . '>completed</option>
                </select>
                <input name="getid" type="hidden" value="' . $row['id'] . '">
                <input name="update" type="submit" value="Update">
                <input name="cancel" type="submit" value="Cancel" onclick="return confirmCancel();">
            </form>
        </div>
        ';
        }
        ?>

        <script>
            function confirmCancel() {
                return confirm("Are you sure you want to cancel this order?");
            }
        </script>

        <?php
        if (isset($_POST['update'])) {
            $selectedValue = $_POST["status"];
            $getid = $_POST['getid'];

            $updatestatus = "UPDATE orders SET status = '$selectedValue' WHERE id = $getid";
            $quer =  mysqli_query($connect, $updatestatus);

            header("Location: http://localhost:8080/motorhub/admin/order.php");
            ob_end_clean();
        }

        if (isset($_POST['cancel'])) {
            $getid = $_POST['getid'];

            $updatestatuss = "DELETE FROM orders WHERE id = $getid";
            $quers =  mysqli_query($connect, $updatestatuss);

            header("Location: http://localhost/motorhub/admin/order.php");
            ob_end_clean();
        }
        ?>
    </div>


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