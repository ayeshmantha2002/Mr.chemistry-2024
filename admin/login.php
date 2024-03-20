<?php

include("../includes/connection.php");

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, $_POST['Password']);
    $hashPassword = sha1($password);

    $chech = "SELECT * FROM `tbl_register` WHERE `E_mail` = '{$email}' AND `Password` = '{$hashPassword}' LIMIT 1";
    $chech_result = mysqli_query($connection, $chech);
    if (mysqli_num_rows($chech_result) == 1) {
        $userFetch = mysqli_fetch_assoc($chech_result);

        $_SESSION['ID']    =   $userFetch['ID'];
        $_SESSION['First_name']    =   $userFetch['First_name'];
        $_SESSION['Last_name']    =   $userFetch['Last_name'];
        $_SESSION['E_mail']    =   $userFetch['E_mail'];
        $_SESSION['Class']    =   $userFetch['Class'];
        $_SESSION['verify']    =   $userFetch['Confirm_user'];

        header("location: admin.php");
    } else {;
        header("location: login.php?incorrect=email_or_password");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin login</title>
    <link rel="stylesheet" href="../assect/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .content {
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        form {
            width: 90%;
            max-width: 500px;
            box-shadow: 0 0 10px var(--shadow);
        }
    </style>
</head>

<body>
    <div class="content">
        <form method="post">
            <p> <input type="text" name="email" placeholder="E-mail"> </p>
            <p> <input type="password" name="Password" placeholder="Password"> </p>
            <p> <input type="submit" name="submit" value="LOGIN"> </p>
        </form>
    </div>
</body>

</html>