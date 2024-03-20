<?php
include "../includes/connection.php";
if (!isset($_SESSION['ID'])) {
    header("location: ../index");
} elseif ($_SESSION['ID'] > 3) {
    header("location: ../index");
} else {

    // latest class list for paper
    $class_list1 = "SELECT * FROM class ORDER BY Class";
    $class_list_result1 = mysqli_query($connection, $class_list1);

    // latest class list for manage student
    $class_list2 = "SELECT * FROM class ORDER BY Class";
    $class_list_result2 = mysqli_query($connection, $class_list2);

    // latest class list for manage documents
    $class_list3 = "SELECT * FROM class ORDER BY Class";
    $class_list_result3 = mysqli_query($connection, $class_list3);

    // latest class list for home works
    $class_list4 = "SELECT * FROM class ORDER BY Class";
    $class_list_result4 = mysqli_query($connection, $class_list4);


    // new users
    $new_users = "SELECT * FROM tbl_register WHERE `Is_Active` = 1 ANd `Confirm_user` = 3 LIMIT 3";
    $new_users_result = mysqli_query($connection, $new_users);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="../assect/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <!-- display area -->
    <div class="area">
        <div class="area-aline">
            <!-- side nav  -->
            <nav class="sideNav">
                <p class="bar"><i class="fa-solid fa-bars-staggered fa-rotate-180"></i></p>
                <div class="nav-align">
                    <ul>
                        <a href="files/manage-link.php" onclick='loadinEffect()'>
                            <li> Link management <i class="fa-solid fa-link"></i> </li>
                        </a>
                        <a href="files/overview.php">
                            <li> Overview Website <i class="fa-solid fa-sitemap"></i> </li>
                        </a>
                        <br>
                        <a href="files/premium.php" onclick='loadinEffect()'>
                            <li class="fa-bounce" style="background-color: gold; box-shadow: 0 0 20px gold; border-radius: 20px; font-weight: bold; color: black; justify-content: space-around;"> Premium Features <i class="fa-solid fa-crown"></i> </li>
                        </a>
                    </ul>
                </div>
            </nav>
            <!-- page blur -->
            <div class="blur"></div>


            <!-- paper score updates -->
            <div class="popup class">
                <i class="fa-solid fa-circle-xmark close" style="color: #ff0000;"></i>
                <div class="popup-center">
                    <div>
                        <h2> Choose class </h2>
                        <?php
                        if (mysqli_num_rows($class_list_result1) > 0) {
                            while ($class1 = mysqli_fetch_assoc($class_list_result1)) {
                                echo "<a href='files/add-score.php?class={$class1['class']}' onclick='loadinEffect()'>{$class1['class']}</a>";
                            }
                        }
                        ?>
                        <a href='files/add-score.php' onclick='loadinEffect()'>All</a>
                    </div>
                </div>
            </div>

            <!-- student management -->
            <div class="popup manage-student">
                <i class="fa-solid fa-circle-xmark close" style="color: #ff0000;"></i>
                <div class="popup-center">
                    <div>
                        <h2> Choose class </h2>
                        <?php
                        if (mysqli_num_rows($class_list_result2) > 0) {
                            while ($class2 = mysqli_fetch_assoc($class_list_result2)) {
                                echo "<a href='files/manage-student.php?class={$class2['class']}' onclick='loadinEffect()'>{$class2['class']}</a>";
                            }
                        }
                        ?>
                        <a href='files/manage-student.php' onclick='loadinEffect()'>All</a>
                    </div>
                </div>
            </div>

            <!-- student documents -->
            <div class="popup manage-documents">
                <i class="fa-solid fa-circle-xmark close" style="color: #ff0000;"></i>
                <div class="popup-center">
                    <div>
                        <h2> Choose class </h2>
                        <?php
                        if (mysqli_num_rows($class_list_result3) > 0) {
                            while ($class3 = mysqli_fetch_assoc($class_list_result3)) {
                                echo "<a href='files/manage-documents.php?class={$class3['class']}' onclick='loadinEffect()'>{$class3['class']}</a>";
                            }
                        }
                        ?>
                        <a href='files/manage-documents.php' onclick='loadinEffect()'>All</a>
                    </div>
                </div>
            </div>

            <!-- student homework -->
            <div class="popup homework">
                <i class="fa-solid fa-circle-xmark close" style="color: #ff0000;"></i>
                <div class="popup-center">
                    <div>
                        <h2> Choose class </h2>
                        <?php
                        if (mysqli_num_rows($class_list_result4) > 0) {
                            while ($class4 = mysqli_fetch_assoc($class_list_result4)) {
                                echo "<a href='files/home-work.php?class={$class4['class']}' onclick='loadinEffect()'>{$class4['class']}</a>";
                            }
                        }
                        ?>
                        <a href='files/home-work.php' onclick='loadinEffect()'>All</a>
                        <br>
                        <a href='files/req-homework.php' onclick='loadinEffect()'>Request Homework</a>
                    </div>
                </div>
            </div>

            <!-- top main menu -->
            <div class="main-menu">
                <div class="nav">
                    <section>
                        <i class="fa-solid fa-bars" id="menu"></i>
                        <div class="profile">
                            <i class="fa-solid fa-user"></i>
                            <div>
                                <p>Hello !</p>
                                <h4> ADMIN </h4>
                            </div>
                        </div>
                    </section>
                    <a href="../index.php?message"><i class="fa-solid fa-envelope"></i></a>
                </div>
                <h1> Mr.ChemistrY </h1>
                <div class="main-buttons">
                    <div class="button">
                        <a href="#" id="paper">
                            <div>
                                <i class="fa-solid fa-newspaper"></i>
                            </div>
                            <p> Paper<br>Score </p>
                        </a>
                    </div>
                    <div class="button">
                        <a href="#" id="manage-student">
                            <div>
                                <i class="fa-solid fa-id-card-clip"></i>
                            </div>
                            <p> Manage<br>users </p>
                        </a>
                    </div>
                    <div class="button">
                        <a href="#" id="manage-documents">
                            <div>
                                <i class="fa-regular fa-folder-open"></i>
                            </div>
                            <p> Manage<br>Doc </p>
                        </a>
                    </div>
                    <div class="button">
                        <a href="#" id="homework">
                            <div>
                                <i class="fa-solid fa-house-laptop"></i>
                            </div>
                            <p> Home<br>Work </p>
                        </a>
                    </div>
                </div>
            </div>

            <!-- new students view -->
            <div class="new-user-list">
                <h2>New Students</h2>
                <ul>
                    <?php
                    if (mysqli_num_rows($new_users_result) > 0) {
                        echo '<li id="ID-Class-Name">
                            <div>User Id</div>
                            <div>Class</div>
                            <div>Name</div>
                        </li>';

                        while ($users = mysqli_fetch_assoc($new_users_result)) {
                            echo "<a href='files/user-control.php?user={$users['ID']}' onclick='loadinEffect()'>
                        <li>
                            <div>{$users['ID']}</div>
                            <div>{$users['Class']}</div>
                            <div>{$users['First_name']} {$users['Last_name']}</div>
                        </li>
                        </a>";
                        }

                        echo '<p><a href="files/manage-student.php?user-category=New" onclick="loadinEffect()"> More Details... </a></p>';
                    } else {
                        echo '<p style="text-align: center;"> NO RESULTS </p>';
                        echo '<p><a href="files/manage-student.php" onclick="loadinEffect()"> More Details... </a></p>';
                    }
                    ?>
                </ul>
            </div>
            <!-- new students view end -->

            <br>
            <hr>
            <br>

            <!-- options button list -->
            <div class="options-buttons">
                <h2> Options </h2>
                <br>
                <div class="main-buttons">
                    <div class="button">
                        <a href="files/manage-videos.php" onclick="loadinEffect()">
                            <div>
                                <i class="fa-brands fa-youtube"></i>
                            </div>
                            <p> Manage<br>Videos </p>
                        </a>
                    </div>
                    <div class="button">
                        <a href="files/past-paper.php" onclick="loadinEffect()">
                            <div>
                                <i class="fa-solid fa-newspaper"></i>
                            </div>
                            <p> Past<br>Paper </p>
                        </a>
                    </div>
                    <div class="button">
                        <a href="files/time-table.php" onclick="loadinEffect()">
                            <div>
                                <i class="fa-regular fa-calendar-days"></i>
                            </div>
                            <p> Time<br>Table </p>
                        </a>
                    </div>
                    <div class="button">
                        <a href="files/manage-banner.php" onclick="loadinEffect()">
                            <div>
                                <i class="fa-regular fa-image"></i>
                            </div>
                            <p> Manage<br>Banner </p>
                        </a>
                    </div>
                </div>
                <br><br>
                <div class="main-buttons">
                    <div class="button">
                        <a href="files/al-result.php" onclick="loadinEffect()">
                            <div>
                                <i class="fa-solid fa-square-poll-vertical"></i>
                            </div>
                            <p> A/L<br>result </p>
                        </a>
                    </div>
                    <div class="button">
                        <a href="files/manage-event.php" onclick="loadinEffect()">
                            <div>
                                <i class="fa-solid fa-medal"></i>
                            </div>
                            <p> Manage<br>Events </p>
                        </a>
                    </div>
                    <div class="button">
                        <a href="files/singup-option.php" onclick="loadinEffect()">
                            <div>
                                <i class="fa-solid fa-id-card-clip"></i>
                            </div>
                            <p> Singup<br>Option </p>
                        </a>
                    </div>
                    <!-- <div class="button">
                         <a href="files/overview.php" onclick="loadinEffect()">
                            <div>
                                <i class="fa-solid fa-gauge-high"></i>
                            </div>
                            <p> Overview<br>site </p>
                        </a>
                    </div> -->
                    <div class="button">
                        <a href="../index" onclick="loadinEffect()">
                            <div>
                                <i class="fa-solid fa-tv"></i>
                            </div>
                            <p> View<br>Website </p>
                        </a>
                    </div>
                </div>
            </div>
            <!-- option button list end  -->
            <br>
            <br><br><br>

        </div>
    </div>
    <!-- display area end  -->

    <!-- loader image -->
    <div class="loading" id="loader">
        <img src="../assect/img/icon/New-file.gif" alt="loading">
    </div>

    <script src="../assect/js/jquery.min.js"></script>
    <script>
        function loadinEffect() {
            document.getElementById('loader').style.display = "flex";
        }
    </script>
    <script>
        $(document).ready(function() {
            $(".close").click(function() {
                $(".popup").css("display", "none");
            });

            $("#paper").click(function() {
                $(".class").css("display", "flex");
            });

            $("#manage-student").click(function() {
                $(".manage-student").css("display", "flex");
            });

            $("#manage-documents").click(function() {
                $(".manage-documents").css("display", "flex");
            });

            $("#homework").click(function() {
                $(".homework").css("display", "flex");
            });

            $("#menu").click(function() {
                $(".sideNav").css("transform", "translateX(0)");
                $(".blur").css("display", "block");
            });
            $(".bar").click(function() {
                $(".sideNav").css("transform", "translateX(-350px)");
                $(".blur").css("display", "none");
            });
            $(".blur").click(function() {
                $(".sideNav").css("transform", "translateX(-350px)");
                $(".blur").css("display", "none");
            });
        });
    </script>
</body>

</html>