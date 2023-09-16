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
    <div class="login-container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
            <div>
                <h1>login</h1>
                <input name="email" type="text" placeholder="Email" required>
                <input name="password" type="password" placeholder="Passowrd" required>
                <input name="submit" type="submit">
            </div>
        </form>
    </div><?php

            if (isset($_POST['submit'])) {
                $email = $_POST['email'];
                $password = $_POST['password'];

                $query = "SELECT * FROM admin WHERE email = '$email' LIMIT 1";
                $result = mysqli_query($connect, $query);
                $row = mysqli_fetch_assoc($result);
                $id = $row['id'];
                $validEmail = $row['email'];
                $validPassword =  $row['password'];

                if ($password == $validPassword && $email == $validEmail) {

                    header("Location: http://localhost/motorhub/admin/dashboard.php");
                    $_SESSION["admin"] = "test";
                    exit();
                } else {
                    header("Location: http://localhost/motorhub/admin/login.php");
                }
            }

            ?>
</body>

</html>