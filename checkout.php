<?php
require('connect.php');
ob_start();
?>

<?php
session_start();

$id = $_GET['id'];
$c_id = $_SESSION['id'];

$get = "SELECT * FROM products WHERE id = $id";
$query = mysqli_query($connect, $get);

$im = null;
$pn = null;
$desc = null;
$quan = $_GET['qty'];;
$pr = null;
$pi = null;

$total = $_GET['total'];

while ($row = mysqli_fetch_array($query)) {
    $im = $row['image'];
    $pn = $row['name'];
    $desc =  $row['description'];
    $pr =  $row['price'];
    $pi = $row['id'];
}


$cust = "SELECT * FROM customer WHERE id = $c_id";
$custo = mysqli_query($connect, $cust);

$name = null;
$email = null;
$phone = null;
$address = null;


while ($row = mysqli_fetch_array($custo)) {
    $name = $row['name'];
    $email = $row['email'];
    $phone =  $row['phone'];
    $address =  $row['address'];
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
    <link rel="stylesheet" href="./style/checkout.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300&display=swap" rel="stylesheet">
</head>

<body>
    <?php
    include('nav.php');
    ?>
    <div class="checkout-container">
        <div class="order">
            <h1>Your Order</h1>
            <div class="product">
                <img src="./admin/photos/<?php echo $im ?>" alt="">
                <h1>Name: <?php echo $pn ?></h1>
                <h1>Qty: <?php echo $quan ?></h1>
                <h1>Price: <?php echo $pr ?></h1>
                <h1>Total: <?php echo $total ?></h1>
            </div>
            <h1>Fill Up Information</h1>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $id  . '&total=' . $total . '&qty=' . $quan ?>" method="POST">
                <input name="name" type="text" placeholder="Name" value="<?php echo $name ?>">
                <input name="email" type="text" placeholder="Email" value="<?php echo $email ?>">
                <input name="phone" type="text" placeholder="Phone Number" value="<?php echo $phone ?>">
                <input name="address" type="text" placeholder="Address" value="<?php echo $address ?>">
                <input name="checkout" type="submit">
            </form>
        </div>
    </div>

    <?php
    $four = intval($quan);
    $five = intval($total);


    $idss = $_GET['id'];
    if (isset($_POST['checkout'])) {

        $nam = $_POST['name'];
        $em = $_POST['email'];
        $ph = $_POST['phone'];
        $add = $_POST['address'];

        $insertorder = "INSERT INTO orders(customer_id, product_id, name, quantity, price, total_cost, image, email, phone, address) 
        VALUES($c_id, $idss, '$nam', $four, $pr, $five, '$im', '$em', '$ph', '$add')";
        $checkingorder = mysqli_query($connect, $insertorder);

        $updatecust = "UPDATE customer SET name = '$nam', email = '$em', address= '$add' WHERE id = $c_id";
        $customerups = mysqli_query($connect, $updatecust);

        $deletecart = "DELETE FROM cart WHERE customer_id = $c_id AND product_id =  $id";
        $delcart = mysqli_query($connect, $deletecart);

        $updateprod = "UPDATE products SET quantity = quantity -  $four WHERE id = $id";
        $upprod = mysqli_query($connect, $updateprod);

        header("Location: http://localhost/motorhub/products.php?");
        exit();
        ob_end_clean();
    }


    ?>
</body>

</html>