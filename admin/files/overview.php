<?php
// securuty
include "../../includes/connection.php";
if (isset($_SESSION['ID'])) {
    if ($_SESSION['ID'] >= 2) {
        header("location: ../../index");
    }
} else {
    header("location: ../../index");
}

// all students
$all = "SELECT `userName` FROM `tbl_register`";
$allQuery = mysqli_query($connection, $all);

// Active students
$active = "SELECT `userName` FROM `tbl_register` WHERE `Confirm_user` = 1";
$activeQuery = mysqli_query($connection, $active);

// Suspend students
$suspend = "SELECT `userName` FROM `tbl_register` WHERE `Confirm_user` = 2";
$suspendQuery = mysqli_query($connection, $suspend);

// Active classes
$class = "SELECT `class` FROM `class`";
$classQuery = mysqli_query($connection, $class);

// all Video
$allVideo = "SELECT `ID` FROM `videos`";
$allVideoQuery = mysqli_query($connection, $allVideo);

// Free Video
$freeVideo = "SELECT `ID` FROM `videos` WHERE `Catagory` = 'free'";
$freeVideoQuery = mysqli_query($connection, $freeVideo);

// Paid Video
$videoVideo = "SELECT `ID` FROM `videos` WHERE `Catagory` = 'video'";
$videoVideoQuery = mysqli_query($connection, $videoVideo);

// Paid Video
$paperVideo = "SELECT `ID` FROM `videos` WHERE `Catagory` = 'paper'";
$paperVideoQuery = mysqli_query($connection, $paperVideo);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Overview</title>
    <link rel="stylesheet" href="../../assect/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .classStudents {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 10px;
            width: 95%;
            margin: auto;
        }

        .classStudents div {
            box-shadow: 0 0 10px #00000020;
            padding: 20px;
            box-sizing: border-box;
            border-radius: 5px;
            text-align: center;
        }
    </style>

</head>

<body>
    <div class="area">
        <div class="area-aline">
            <header>
                <nav>
                    <a href="../admin.php" onclick='loadinEffect()'> <i class="fa-solid fa-angle-left"></i> </a>
                    <h2> Overview </h2>
                </nav>
            </header>
            <br><br><br><br>
            <h2> Students Details </h2>
            <br>
            <div class="classStudents">
                <div>
                    <h3> All Users </h3>
                    <p>
                        <?php if (mysqli_num_rows($allQuery) > 0) {
                            echo mysqli_num_rows($allQuery);
                        } else {
                            echo "0";
                        } ?>
                    </p>
                </div>
                <div>
                    <h3> Active Users </h3>
                    <p>
                        <?php if (mysqli_num_rows($activeQuery) > 0) {
                            echo mysqli_num_rows($activeQuery);
                        } else {
                            echo "0";
                        } ?>
                    </p>
                </div>
                <div>
                    <h3> Suspend Users </h3>
                    <p>
                        <?php if (mysqli_num_rows($suspendQuery) > 0) {
                            echo mysqli_num_rows($suspendQuery);
                        } else {
                            echo "0";
                        } ?>
                    </p>
                </div>
            </div>
            <br>
            <div class="classStudents">
                <?php
                if (mysqli_num_rows($classQuery) > 0) {
                    while ($classes = mysqli_fetch_assoc($classQuery)) {

                        $count = "SELECT `Class` FROM `tbl_register` WHERE `Class` = {$classes['class']}";
                        $countQuery = mysqli_query($connection, $count);

                        if (mysqli_num_rows($countQuery) > 0) {
                            echo "<div>
                                <h3> {$classes['class']} </h3>
                                <p>" . mysqli_num_rows($countQuery) . "</p>
                            </div>";
                        }
                    }
                }
                ?>
            </div>
            <br>
            <h2> Videos Details </h2>
            <br>
            <div class="classStudents">
                <div>
                    <h3> All Videos </h3>
                    <p>
                        <?php if (mysqli_num_rows($allVideoQuery) > 0) {
                            echo mysqli_num_rows($allVideoQuery);
                        } else {
                            echo "0";
                        } ?>
                    </p>
                </div>
                <div>
                    <h3> Free Videos </h3>
                    <?php if (mysqli_num_rows($freeVideoQuery) > 0) {
                        echo mysqli_num_rows($freeVideoQuery);
                    } else {
                        echo "0";
                    } ?>
                </div>
                <div>
                    <h3> Paid Videos </h3>
                    <?php if (mysqli_num_rows($videoVideoQuery) > 0) {
                        echo mysqli_num_rows($videoVideoQuery);
                    } else {
                        echo "0";
                    } ?>
                </div>
                <div>
                    <h3> Paper Videos </h3>
                    <?php if (mysqli_num_rows($paperVideoQuery) > 0) {
                        echo mysqli_num_rows($paperVideoQuery);
                    } else {
                        echo "0";
                    } ?>
                </div>
            </div>
        </div>
    </div>

</body>

</html>