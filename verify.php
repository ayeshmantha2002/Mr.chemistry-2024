<?php
include("includes/connection.php");

if (isset($_GET['code'])) {
    $verification_code  =   mysqli_real_escape_string($connection, $_GET['code']);

    $query  =   "SELECT * FROM tbl_register WHERE Mail_verification = '{$verification_code}'";
    $result =   mysqli_query($connection, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $update =   "UPDATE tbl_register SET Mail_verification = NULL , Is_Active = 1 WHERE Mail_verification = '{$verification_code}' LIMIT 1";
            $updateResult   =   mysqli_query($connection, $update);

            if ($updateResult) {
                header("location:login.php?code=verified");
            } else {
                $error = "Not verified user";
            }
        } else {
            $error = '<div class="notVerify">
            <div class="notVerifyDetails">
                <br>
                <p><i class="fa-solid fa-triangle-exclamation fa-beat-fade fa-2xl" style="color: #ff0000;"></i></p>
                <br><br>
                <p> Invalid link or current link. Please check the link. </p>
                <br>
                <p> <a href="index"> Go to home </a> </p>
            </div>
        </div>';
        }
    } else {
        $error = "Error Result";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mr.ChemistrY - Verify User</title>
    <link rel="stylesheet" href="assect/css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="assect/img/icon/logo.png">
</head>

<body>
    <?php echo $error; ?>

    <script src="assect/js/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.cycle2/2.1.6/jquery.cycle2.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="assect/js/javascript.js"></script>
</body>

</html>