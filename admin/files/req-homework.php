<?php
include "../../includes/connection.php";
if (isset($_SESSION['ID'])) {
    if ($_SESSION['ID'] >= 4) {
        header("location: ../../index");
    }
} else {
    header("location: ../../index");
}

// latest class list for home works
$class_list = "SELECT * FROM class ORDER BY Class";
$class_list_result = mysqli_query($connection, $class_list);

// inser timer
if (isset($_POST['insert'])) {
    $start = time();
    $end = mysqli_real_escape_string($connection, $_POST['time']);
    $inClass = mysqli_real_escape_string($connection, $_POST['class']);

    $checkTimer = "SELECT * FROM `timer` WHERE `Class` = {$inClass}";
    $checkTimer_result = mysqli_query($connection, $checkTimer);

    if (mysqli_num_rows($checkTimer_result) == 1) {
        header("location: req-homework.php?insert=already");
    } else {
        $insertTimer = "INSERT INTO `timer` (`Start_time`, `End_time`, `Class`, `Status`) VALUE ({$start}, {$end}, {$inClass}, 1)";
        $insertTimer_result = mysqli_query($connection, $insertTimer);

        if ($insertTimer_result) {
            header("location: req-homework.php?insert=done");
        }
    }
}

// fetch timer
$timer = "SELECT * FROM `timer`";
$timer_result = mysqli_query($connection, $timer);


// delete timer 
if (isset($_GET['delete'])) {
    $deleteID = mysqli_real_escape_string($connection, $_GET['delete']);
    $delet_Item = "DELETE FROM `timer` WHERE ID = {$deleteID}";
    $delet_Item_result = mysqli_query($connection, $delet_Item);

    if ($delet_Item_result) {
        header("location: req-homework.php?insert=done");
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Homework</title>
    <link rel="stylesheet" href="../../assect/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="area">
        <div class="area-aline">
            <header>
                <nav>
                    <a onclick="loadinEffect()" href="../admin.php">
                        <i class="fa-solid fa-angle-left"></i>
                    </a>
                    <h2> Request Homework </h2>
                </nav>
            </header>
            <br><br><br><br>

            <!-- update form  -->
            <form method="post">
                <p> <b>Class : </b> <br>
                    <select name="class">
                        <?php
                        if (mysqli_num_rows($class_list_result) > 0) {
                            while ($class4 = mysqli_fetch_assoc($class_list_result)) {
                                echo "<option value='{$class4['class']}'> {$class4['class']} </option>";
                            }
                        }
                        ?>
                    </select>
                </p>

                <p> <b>End Time : </b> <br>
                    <select name="time">
                        <option value="300"> 5 minutes </option>
                        <option value="600"> 10 minutes </option>
                        <option value="1800"> 30 minutes </option>
                        <option value="3600"> 1 hour </option>
                        <option value="5400"> 1 hour 30 minutes </option>
                        <option value="7200"> 2 hour </option>
                        <option value="9000"> 2 hour 30 minutes </option>
                        <option value="10800"> 3 hour </option>
                        <option value="12600"> 3 hour 30 minutes </option>
                        <option value="14400"> 4 hour </option>
                        <option value="16200"> 4 hour 30 minutes </option>
                        <option value="18000"> 5 hour </option>
                        <option value="43200"> 12 hour </option>
                        <option value="86400"> 1 Day </option>
                        <option value="172800"> 2 Days </option>
                        <option value="259200"> 3 Days </option>
                    </select>
                </p>
                <p> <input onclick='loadinEffect()' type="submit" name="insert" value="Set Time"> </p>
            </form>
            <br><br>

            <!-- list homework docs  -->
            <?php
            if ($timer_result) {
                if (mysqli_num_rows($timer_result) > 0) {
                    echo "<ul>";
                    while ($timerFetch = mysqli_fetch_assoc($timer_result)) {
                        $ID = $timerFetch['ID'];
                        $Set_time = $timerFetch['Set_time'];
                        $End_time = $timerFetch['End_time'];
                        $FetchClass = $timerFetch['Class'];

                        if ($End_time >= 3600) {
                            $endTime = floor($End_time / 3600) . " Hours";
                        } elseif ($End_time < 3600) {
                            $endTime = ((int)($End_time / 60) % 60) . " Minutes";
                        }

                        echo "<a>
                        <li style='position: relative;'>
                            <div id='student-details'>
                                <p><b>Class :</b> {$FetchClass} <br>
                                <b>Start Time :</b> {$Set_time} <br>
                                <b>End Time :</b> {$endTime} </p>
                                <p></p>
                                <p><a href='req-homework.php?delete={$ID}' id='download-link' onclick='loadinEffect()'> End </a> <br></p>
                            </div>
                        </li>
                        </a>";
                    }
                    echo "</ul>";
                } else {
                }
            }
            ?>
        </div>
    </div>
    <?php

    // done message
    if (isset($_GET['insert'])) {
        if ($_GET['insert'] == "done") {
            echo '<div class="done-message">
            <div class="done-message-center">
                <p> <i class="fa-solid fa-circle-check fa-bounce fa-2xl"></i> </p>
                <h1> Done </h1>
                <p> <a href="req-homework.php"> OK </a> </p>
            </div>
        </div>';
        }
    }

    // error message
    if (isset($_GET['insert'])) {
        if ($_GET['insert'] == "already") {
            echo "<div class='done-message'>
            <div class='done-message-center'>
                <p> <i style='color: red;' class='fa-solid fa-circle-exclamation fa-bounce fa-lg'></i> </p>
                <h1 style='color: red;'> This record already exists.... </h1>
                <br>
                <p> <a href='req-homework.php'> OK </a> </p>
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