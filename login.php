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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>

</head>

<body>

    <?php
    include('nav.php');
    ?>
    <div class="login-container">
        <form action="login.php" method="POST">
            <div>
                <h1>login</h1>
                <input name="email" type="email" placeholder="Email" required>
                <input name="password" type="password" placeholder="Passowrd" required>
                <input name="submit" type="submit">
                <h3>or</h3>
                <a href="signup.php">Signup</a>
            </div>
        </form>
    </div>
    <?php

    $error = false;
    if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $query = "SELECT * FROM customer WHERE email = '$email' LIMIT 1";
        $result = mysqli_query($connect, $query);
        $row = mysqli_fetch_assoc($result);
        $id = $row['id'];
        $validEmail = $row['email'];
        $validPassword =  $row['password'];

        if ($password == $validPassword && $email == $validEmail) {
            header("Location: http://localhost/motorhub/home.php");
            $_SESSION["id"] = $id;
            exit();
        } else {
            header("Location: http://localhost/motorhub/login.php?error=true");
            exit();
        }
    }
    ?>

    <?php

    if (isset($_GET['error'])) {

        echo '<script>
    Swal.fire({
        icon: "error",
        title: "Error!",
        text: "Invalid email or password. Please try again."
    });
   </script>';
    }

    ?>

</body>

</html>