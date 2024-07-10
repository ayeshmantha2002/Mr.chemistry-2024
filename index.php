<?php
include("includes/connection.php");

// log out disply message
if (isset($_GET['Logout'])) {

    $val    = "successful";
    $success = sha1($val);

    if ($_GET['Logout'] == $success) {
        $updatePhoto    =   '<div class="updatePhoto">
        <div id="myUpdatePic">
            <p><i class="fa-regular fa-circle-check fa-shake fa-2xl"></i></p><br><br>
            <p>You have successfully logged out.</p><br>
            <p><a href="index">OK</a></p>
        </div>
    </div>';
    } else {
        $updatePhoto    =   '';
    }
} else {
    $updatePhoto    =   '';
};

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="Mr chemistry, mrchemistry.lk, mr chemistry.lk, Mr.ChemistrY.lk, Mr.ChemistrY, Mr, chemistry, mrchemistry, nipun palliyaguru, nipun, palliyaguru, nipunpalliyaguru, nipun palliya guru, nipun palliyaguru chemistry, nipun palliyaguru">
    <meta name="description" content="Our aim is to make your studies easier, to study your studies with a good plan, to compare your level with other students, to make up for your shortcomings and increase your marks, to increase your interest, and to achieve high marks in the exam. Mr.ChemistrY.lk">
    <title>Mr.ChemistrY</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assect/css/style.css">
    <link rel="icon" href="assect/img/icon/logo.png">
    <style>
        .rankPic {
            grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr;
        }
    </style>
</head>

<body>
    <!-- loader image -->
    <div class="loading" id="loader">
        <img src="assect/img/icon/New-file.gif" alt="loading">
    </div>
    <?php
    // log in error or success status
    if (isset($_GET['login'])) {
        $value  =    $_GET['login'];
        if ($value == "successfully_completed") {
            echo '<div class="checkmeeteralin">
                <div class="checkmeeter">
                <div>
                <i class="fa-regular fa-circle-check fa-beat-fade fa-2xl" style="color: lime;"></i></i></i>
                        <br><br>
                        <p> You have successfully logged in. Continue your studies. </p>
                        <br>
                        <p><a href="index"> OK </a></p>
                    </div>
                </div>
            </div>';
        }
    };

    // tute or modle paper request display status
    if (isset($_GET['done'])) {
        $value  =    $_GET['done'];
        if ($value == "done") {
            echo '<div class="checkmeeteralin">
                <div class="checkmeeter">
                <div>
                <i class="fa-regular fa-circle-check fa-beat-fade fa-2xl" style="color: lime;"></i></i></i>
                        <br><br>
                        <p> You have successfully sent the request.
                        You will receive your order within 24 hours. </p>
                        <br>
                        <p><a href="index"> OK </a></p>
                    </div>
                </div>
            </div>';
        }
    };

    // tute or modle paper request pending status
    if (isset($_GET['request'])) {
        $value  =    $_GET['request'];
        if ($value == "pending") {
            echo '<div class="checkmeeteralin">
                <div class="checkmeeter">
                <div>
                <i class="fa-regular fa-clock fa-beat-fade fa-2xl"></i>
                        <br><br>
                        <p> Your request is pending.</p>
                        <br>
                        <p><a href="index"> OK </a></p>
                    </div>
                </div>
            </div>';
        }
    };

    // contact us mail send display status
    if (isset($_GET['mail'])) {
        $value  =    $_GET['mail'];
        if ($value == "successfully_completed") {
            echo '<div class="checkmeeteralin">
                <div class="checkmeeter">
                <div>
                <i class="fa-solid fa-envelope-circle-check fa-bounce fa-2xl"></i>
                        <br><br>
                        <p> Message sent successfully. </p>
                        <br>
                        <p><a href="index"> OK </a></p>
                    </div>
                </div>
            </div>';
        }
    };

    // admin message delete
    if (isset($_GET['delete'])) {
        $value  =    $_GET['delete'];
        if ($value == "done") {
            echo '<div class="checkmeeteralin">
                <div class="checkmeeter">
                <div>
                <i class="fa-solid fa-trash-can fa-bounce fa-2xl" style="color: #ff0000;"></i>
                        <br><br>
                        <p> Message delete successfully. </p>
                        <br>
                        <p><a href="index"> OK </a></p>
                    </div>
                </div>
            </div>';
        }
    };
    // log out display statatus echo
    echo $updatePhoto;

    // done message
    if (isset($_GET['insert'])) {
        if ($_GET['insert'] == "done") {
            echo "<div class='done-message'>
            <div class='done-message-center'>
                <p> <i class='fa-solid fa-circle-check fa-bounce fa-2xl'></i> </p>
                <h1> Done </h1>
                <p> <a href='index'> OK </a> </p>
            </div>
        </div>";
        }
    }

    // error message
    if (isset($_GET['insert'])) {
        if ($_GET['insert'] == "error") {
            echo "<div class='done-message'>
            <div class='done-message-center'>
                <p> <i style='color: red;' class='fa-solid fa-circle-exclamation fa-bounce fa-lg'></i> </p>
                <h1 style='color: red;'> please fill out all inputs </h1>
                <br>
                <p> <a href='index'> OK </a> </p>
            </div>
        </div>";
        }
    }
    if (isset($_GET['Error'])) {
        if ($_GET['Error'] == "File_type") {
            echo "<div class='done-message'>
            <div class='done-message-center'>
                <p> <i style='color: red;' class='fa-solid fa-circle-exclamation fa-bounce fa-lg'></i> </p>
                <h1 style='color: red;'> You can only upload PDF files </h1>
                <br>
                <p> <a href='index'> OK </a> </p>
            </div>
        </div>";
        }
    }
    if (isset($_GET['Error'])) {
        if ($_GET['Error'] == "already") {
            echo "<div class='done-message'>
            <div class='done-message-center'>
                <p> <i style='color: red;' class='fa-solid fa-circle-exclamation fa-bounce fa-lg'></i> </p>
                <h1 style='color: red;'> This file is already exists. </h1>
                <br>
                <p> <a href='index'> OK </a> </p>
            </div>
        </div>";
        }
    }
    if (isset($_GET['session'])) {
        if ($_GET['session'] == "timeout") {
            echo "<div class='done-message'>
            <div class='done-message-center'>
                <p> <i style='color: red;' class='fa-solid fa-circle-exclamation fa-bounce fa-lg'></i> </p>
                <h1 style='color: red;'> Session timeout. </h1>
                <br>
                <p> <a href='index'> OK </a> </p>
            </div>
        </div>";
        }
    }

    // delete homework
    if (isset($_GET['deleteDOC'])) {
        $deleteID = mysqli_real_escape_string($connection, $_GET['deleteDOC']);
        $deleteName = mysqli_real_escape_string($connection, $_GET['name']);
        $delet_Item = "DELETE FROM `homework` WHERE ID={$deleteID} AND `File_Name` = '{$deleteName}' LIMIT 1";
        $delet_Item_result = mysqli_query($connection, $delet_Item);

        if ($delet_Item_result) {
            $parth = "admin/homework/$deleteName";
            if (unlink($parth)) {
                header("location:index.php?insert=done");
            } else {
                header("location:index.php?insert=error");
            }
        }
    }
    ?>

    <!-- up navigation bar -->
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
                    // echo '<ul><li><a href="admin/admin.php"> Admin </a></li></ul>';
                }
            };
            ?>

        </div>
    </div>
    <div class="hero">
        <!-- side navigation bar -->
        <?php
        include("includes/sidenav.php");
        ?>
        <div class="content">
            <div class="loading">
                <img src="assect/img/icon/New-file.gif" alt="loading">
            </div>
        </div>
    </div>
    <!-- mini displya nav blru -->
    <div class="blur"></div>

    <?php
    // bottom navigation bar
    include('includes/bottomNav.php');
    ?>

    <script src="assect/js/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.cycle2/2.1.6/jquery.cycle2.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="assect/js/javascript.js"></script>

    <script>
        <?php
        if (isset($_GET['status'])) {
            echo "$('.content').load('todo.php');";
        } elseif (isset($_GET['update'])) {
            echo "$('.content').load('profile.php');";
        } elseif (isset($_GET['message'])) {
            echo "$('.content').load('notification.php');";
        } else {
            echo "$('.content').load('home.php');";
        }
        ?>

        var loader = document.getElementById("loader");
        window.addEventListener("load", function() {
            loader.style.display = "none";
        });
    </script>
</body>

</html>