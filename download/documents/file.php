<?php
include("../../includes/connection.php");

if (!isset($_SESSION['ID'])) {
    header("location: ../../index");
} else {
    $user_verification = "SELECT * FROM tbl_register WHERE ID = {$_SESSION['ID']}";
    $user_verification_result = mysqli_query($connection, $user_verification);
    if (mysqli_num_rows($user_verification_result) == 1) {
        $details = mysqli_fetch_assoc($user_verification_result);
        $user_status = $details['Confirm_user'];
        if ($user_status != 1) {
            header("location: ../../index");
        }
    } else {
        header("location: ../../index");
    }
}
if (isset($_GET['doc'])) {
    $doc_name = mysqli_real_escape_string($connection, $_GET['doc']);
} else {
    header("location: ../../index");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mr.ChemistrY - Document</title>
    <link rel="icon" href="../../assect/img/icon/logo.png">
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body::-webkit-scrollbar {
            width: 0;
        }

        iframe {
            width: 100%;
            height: 100vh;
        }
    </style>
</head>

<body>
    <iframe src="../../admin/docs/<?php echo $doc_name; ?>" frameborder="0"></iframe>
</body>

</html>