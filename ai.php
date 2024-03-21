<?php
include("includes/connection.php");
if (!isset($_SESSION['ID'])) {
    header('location:index.php');
} else {
    $User   =   "SELECT * FROM tbl_register WHERE ID = {$_SESSION['ID']} LIMIT 1";
    $query  =   mysqli_query($connection, $User);
    if ($query) {
        if (mysqli_num_rows($query) == 1) {
            $user_details   =   mysqli_fetch_assoc($query);
            $Confirm_user =   $user_details['Confirm_user'];
        }
    }

    if ($Confirm_user != 1) {
        header('location:index.php');
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mr.ChemistrY - Ai Calculater</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assect/css/style.css">
    <link rel="icon" href="assect/img/icon/logo.png">
    <style>
        .loading {
            max-width: 1000px;
            height: 100%;
            justify-content: center;
            align-items: center;
        }
    </style>

</head>

<body>
    <div id="upNav">
        <div class="upNav">
            <div class="logo">
                <h3> <i class="fa-solid fa-bars" id="navClick" style="color: var(--text-blue);
                padding-right: 15px;
                font-size: 25px;
                transform: translateY(4px);
                cursor: pointer;"></i> Mr.ChemistrY<span id="maths">.lk </span> </h3>
                <p> NIPUN PALLIYAGURU </p>
            </div>
            <ul <?php if (isset($_SESSION['ID'])) {
                    echo "hidden";
                }; ?>>
                <li><a href="register"> Register </a></li>
                <li><a href="login"> Login </a></li>
            </ul>

            <?php
            if (isset($_SESSION['ID'])) {
                if ($_SESSION['ID'] <= 3) {
                    echo '<ul><li><a href="admin/admin.php"> Admin </a></li></ul>';
                }
            };
            ?>

        </div>
    </div>
    <div class="hero">
        <!-- side navigation bar -->
        <?php

        if (isset($_SESSION['ID'])) {
            $User   =   "SELECT * FROM tbl_register WHERE ID = {$_SESSION['ID']} LIMIT 1";
            $query  =   mysqli_query($connection, $User);
            if ($query) {
                if (mysqli_num_rows($query) == 1) {
                    $user_details   =   mysqli_fetch_assoc($query);
                    $firstName =   $user_details['First_name'];
                    $lastName =   $user_details['Last_name'];
                    $Confirm_user =   $user_details['Confirm_user'];
                    $userPic =   $user_details['Pro_pic'];

                    if ($Confirm_user == 1) {
                        $activeSatus    =   "Verified user";
                    } elseif ($Confirm_user == 2) {
                        $activeSatus    =   " Suspended user";
                    } else {
                        $activeSatus    =   "Not verified user";
                    }
                }
            }
        }

        ?>

        <div class="sideNav">
            <div class="sideNavAling">

                <li id="side_logo" style="padding: 15px 0 0 5px; list-style: none;">
                    <div class="logo" style="width: 185px;">
                        <h3> <i class="fa-solid fa-bars" id="navClick2" style="color: var(--text-blue);
                padding-right: 15px;
                font-size: 25px;
                transform: translateY(4px);
                cursor: pointer;"></i> Mr.ChemistrY<span id="maths">.lk </span> </h3>
                        <p> NIPUN PALLIYAGURU </p>
                    </div>
                </li>

                <?php
                if (isset($_SESSION['ID'])) {
                    echo '<div class="myDetailsMin">
                        <a class="2"><p><img src="admin/students/' . $userPic . '" alt="profile pic"></p></a>
                        <p>User ID :' . " " . $_SESSION['ID'] . '</p>
                        <p>' . $firstName . " " . $lastName . '</p>
                        <p style="font-size: 12px;">' . $activeSatus . '</p>
                        <p><a href="logout.php">Logout <i class="fa-solid fa-right-from-bracket"></i></a></p>
                    </div>';
                }
                ?>
                <ul>
                    <li>
                        <a href="index" class="homeNav">
                            <ion-icon name="home-outline"></ion-icon>
                            Home
                        </a>
                    </li>
                    <?php
                    if (isset($_SESSION['ID'])) {
                        echo '<li><a href="ai" class="aiai">
            <i class="fa-solid fa-brain"></i>
            AI Calculater</a>
    </li>';
                    }
                    ?>
                </ul>
                <br><br>
                <?php
                if (!isset($_SESSION['ID'])) {
                    echo '<div class="sideRegister">
                    <li class="hide"><a href="register">Register</a></li>
                    <li class="hide"><a href="login">Log in</a></li>
                </div>';
                } else {
                    if ($_SESSION['ID'] == 1 || $_SESSION['ID'] == 2 || $_SESSION['ID'] == 3) {
                        echo '<div class="sideRegister"><ul><li><a href="admin/admin.php">Admin</a></li></ul></div>';
                    }
                }
                ?>
                <div class="space"></div>
            </div>
        </div>
        <div class="content">
            <div class="loading">
                <img src="assect/img/icon/New-file.gif" alt="">
            </div>
        </div>
    </div>
    <div class="ai" style="transform: translateY(-50px);">
        <div class="ai_aling">
            <iframe src="https://www.mathway.com/chemistry" style="width: 100%;height: 100%; border: 1px solid var(--text-blue);"></iframe>
        </div>
    </div>
</body>

<script src="assect/js/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.cycle2/2.1.6/jquery.cycle2.min.js"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script src="assect/js/javascript.js"></script>

<script>
    AOS.init();
</script>

<script>
    var loader = document.getElementById("loader");
    window.addEventListener("load", function() {
        loader.style.display = "none";
    });
</script>

</html>