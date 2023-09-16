<?php
require('connect.php');
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit();
}
?>
<?php
$id = $_GET['id'];

$get = "SELECT * FROM products WHERE id = $id";
$query = mysqli_query($connect, $get);

$im = null;
$pn = null;
$desc = null;
$quan = null;
$pr = null;

while ($row = mysqli_fetch_array($query)) {
    $im = $row['image'];
    $pn = $row['name'];
    $desc =  $row['description'];
    $quan =  $row['quantity'];
    $pr =  $row['price'];
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
    <link rel="stylesheet" href="./style/dashboard.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300&display=swap" rel="stylesheet">
</head>

<body>
    <?php
    include('nav.php');
    ?>

    <div class="view-container">
        <div class="view-box">
            <div class="firstview">
                <img src="./photos/<?php echo $im ?>" alt="">
            </div>
            <div class="secondview">
                <form action="">
                    <h1>Name: <?php echo $pn ?></h1>
                    <h1>details: <?php echo $desc ?></h1>
                    <h1>Quantity: <?php echo $quan ?></h1>
                    <h1>P <?php echo $pr ?></h1>

                </form>
            </div>
        </div>
    </div>
</body>

</html>