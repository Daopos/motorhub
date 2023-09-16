<?php
require('connect.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="./style/login.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300&display=swap" rel="stylesheet">
</head>

<body>
    <?php
    include('nav.php');
    ?>

    <div class="login-container">
        <form action="signup.php" method="POST">
            <div>
                <h1>Signup</h1>
                <input name="name" type="text" placeholder="Name" required>
                <input name="phone" type="text" placeholder="Phone Number" required>
                <input name="email" type="email" placeholder="Email" required>
                <input name="password" type="password" placeholder="Password" required>
                <input name="confirm" type="password" placeholder="Confirm Password" required>
                <input name="submit" type="submit">
                <h3>or</h3>
                <a href="login.php">Login</a>
            </div>
        </form>
    </div>

    <?php

    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm = $_POST['confirm'];

        if ($password == $confirm) {

            $sql = "INSERT INTO customer(name, phone, email, password) VALUES('$name','$phone','$email','$password')";
            $query = mysqli_query($connect, $sql);

            $getid = "SELECT id FROM customer WHERE email = '$email'";
            $getIdResult = mysqli_query($connect, $getid);
            $row = mysqli_fetch_assoc($getIdResult);

            $id = $row['id'];
            $_SESSION["id"] = $id;

            header("Location: http://localhost/motorhub/products.php");
            exit();
        }
    }



    ?>
</body>

</html>