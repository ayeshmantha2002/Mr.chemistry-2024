<?php
// securuty
include "../../includes/connection.php";
if (isset($_SESSION['ID'])) {
    if ($_SESSION['ID'] >= 4) {
        header("location: ../../index");
    }
} else {
    header("location: ../../index");
}

if (isset($_GET['class'])) {
    $class = mysqli_real_escape_string($connection, $_GET['class']);
    setcookie('Class', $class, time() + 60 * 60 * 24);
} else {
    setcookie('Class', NULL, -time() + 60 * 60 * 24);
}

// fetch students details
if (isset($_POST['studentID'])) {
    $studentID = mysqli_real_escape_string($connection, $_POST['studentID']);
    $SearchCatagory = "SELECT * FROM tbl_register WHERE (`userName` LIKE '%{$studentID}%' OR `First_name` LIKE '%{$studentID}%' OR `Last_name` LIKE '%{$studentID}%') AND Confirm_user = 1";
} elseif (isset($_GET['class'])) {
    $Category = "class={$_GET['class']}";
    $studentclass = mysqli_real_escape_string($connection, $_GET['class']);
    $SearchCatagory = "SELECT * FROM tbl_register WHERE `Class` = {$studentclass} AND Confirm_user = 1 ORDER BY `ID` DESC";
} else {
    $SearchCatagory = "SELECT * FROM tbl_register WHERE Confirm_user = 1 ORDER BY `ID` DESC";
}
$SearchCatagory_result = mysqli_query($connection, $SearchCatagory);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Score</title>
    <link rel="stylesheet" href="../../assect/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <!-- main area  -->
    <div class="area">
        <div class="area-aline">
            <header>
                <nav>
                    <a href="../admin.php" onclick='loadinEffect()'> <i class="fa-solid fa-angle-left"></i> </a>
                    <h2> ADD SCORE </h2>
                </nav>
            </header>
            <br><br><br><br>

            <!-- links buttons -->
            <div class="four-buttons">
                <a onclick='loadinEffect()' href="add-score.php">All Users</a>
                <?php
                // latest class list
                $class_list1 = "SELECT * FROM class ORDER BY Class";
                $class_list_result1 = mysqli_query($connection, $class_list1);
                if (mysqli_num_rows($class_list_result1) > 0) {
                    while ($class1 = mysqli_fetch_assoc($class_list_result1)) {
                        echo "<a href='add-score.php?class={$class1['class']}' onclick='loadinEffect()'>{$class1['class']}</a>";
                    }
                }
                ?>
            </div>

            <!-- students search form -->
            <form action="add-score.php" method="post">
                <h2> Search User </h2>
                <p>
                    User id / First name or Last name : <br>
                    <input name="studentID" placeholder="User id / First name or Last name" required>
                </p>
                <p><button type="submit" onclick='loadinEffect()'> Search </button></p>
            </form>

            <!-- students list  -->
            <ul>
                <?php
                if ($SearchCatagory_result) {
                    if (mysqli_num_rows($SearchCatagory_result) > 0) {
                        while ($users = mysqli_fetch_assoc($SearchCatagory_result)) {
                            $user_id = $users['userName'];
                            $user_first = $users['First_name'];
                            $user_last = $users['Last_name'];
                            $user_Class = $users['Class'];

                            if ($users['Confirm_user'] == 1) {
                                $confirm = "green_box";
                            } elseif ($users['Confirm_user'] == 2) {
                                $confirm = "red_box";
                            } elseif ($users['Confirm_user'] == 3) {
                                $confirm = "blue_box";
                            }

                            if ($users['Is_Active'] == 0) {
                                $confirm = "tomato_box";
                            }

                            echo "<a href='edit-or-insert.php?user={$user_id}' onclick='loadinEffect()'>
                            <li style='position: relative;'>
                                <div id='student-details'>
                                    <p>{$user_id}</p>
                                    <p>{$user_Class}</p>
                                    <p>{$user_first} {$user_last}</p>
                                </div>
                                <div class='{$confirm}'></div>
                            </li>
                        </a>";
                        }
                    }
                }
                ?>
            </ul>

        </div>
    </div>

    <!-- done message  -->
    <?php
    if (isset($_GET['insert'])) {
        if ($_GET['insert'] == "done") {
            echo "<div class='done-message'>
            <div class='done-message-center'>
                <p> <i class='fa-solid fa-circle-check fa-bounce fa-2xl'></i> </p>
                <h1> Done </h1>
                <p> <a href='add-score.php?{$Category}'> OK </a> </p>
            </div>
        </div>";
        }
    }
    ?>

    <!-- loader image -->
    <div class="loading" id="loader">
        <img src="../../assect/img/icon/New-file.gif" alt="loading">
    </div>
    <script>
        function loadinEffect() {
            document.getElementById('loader').style.display = "flex";
        }
    </script>
</body>

</html>