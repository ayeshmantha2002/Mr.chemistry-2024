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

// last A/L year
if (isset($_COOKIE['ALyear'])) {
    $ALyear = $_COOKIE['ALyear'];
} else {
    $ALyear = "";
}

// search user for update result
if (isset($_GET['searchUser'])) {
    $user = mysqli_real_escape_string($connection, $_GET['searchUser']);
    $user = "SELECT * FROM tbl_register WHERE (`userName` LIKE '%{$user}%' OR `First_name` LIKE '%{$user}%' OR `Last_name` LIKE '%{$user}%') AND `Confirm_user` = 1";
    $user_result = mysqli_query($connection, $user);
} else {
    $user_result = "";
}

// check recordes counts
$records = "SELECT * FROM al_result";
$records_result = mysqli_query($connection, $records);

if ($records_result) {
    $recodes_count = mysqli_num_rows($records_result);
    if ($recodes_count >= 10) {
        $recode = $recodes_count;
    } elseif ($recodes_count > 0) {
        $recode = "0" . $recodes_count;
    } else {
        $recode = "00";
    }
}

// update result
if (isset($_POST['submit'])) {
    $inert_id = mysqli_real_escape_string($connection, $_POST['id']);
    $inert_img = mysqli_real_escape_string($connection, $_POST['img']);
    $inert_name = mysqli_real_escape_string($connection, $_POST['full_name']);
    $update_year = mysqli_real_escape_string($connection, $_POST['year']);
    setcookie('ALyear', $update_year, time() + 60 * 60 * 24 * 10);
    $update_index = mysqli_real_escape_string($connection, $_POST['index']);
    $update_chemistry = mysqli_real_escape_string($connection, $_POST['chemistry']);
    $update_physics = mysqli_real_escape_string($connection, $_POST['physics']);
    $update_maths = mysqli_real_escape_string($connection, $_POST['maths']);

    $check_user = "SELECT * FROM al_result WHERE User_ID = {$inert_id}";
    $check_user_result = mysqli_query($connection, $check_user);

    if (mysqli_num_rows($check_user_result) == 0) {
        $insert_AL = "INSERT INTO al_result (`User_ID`, `Name`, `Year`, `combinde_Result`, `physics_Result`, `chemisty_Result`, `Index_number`, `img`, `Status`) VALUE ('{$inert_id}', '{$inert_name}', {$update_year}, '{$update_maths}', '{$update_physics}', '{$update_chemistry}', {$update_index}, '{$inert_img}', 1)";
        $insert_AL_result = mysqli_query($connection, $insert_AL);

        if ($insert_AL_result) {
            header("location: al-result.php?insert=done");
        }
    } elseif (mysqli_num_rows($check_user_result) == 1) {
        header("location: al-result.php?insert=already-exists");
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A/L result</title>
    <link rel="stylesheet" href="../../assect/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="area">
        <div class="area-aline">
            <header>
                <nav>
                    <a href="../admin.php" onclick='loadinEffect()'> <i class="fa-solid fa-angle-left"></i> </a>
                    <h2> A/L result </h2>
                </nav>
                <div id="view">
                    <a href="result-set.php" onclick='loadinEffect()'> <?php echo $recode; ?> </a>
                </div>
            </header>
            <br><br><br><br><br>

            <!-- search sudent form  -->
            <form method="get" action="al-result.php">
                <h2> Search User </h2>
                <p> First name / Last name or User ID : <br>
                    <input type="search" name="searchUser" placeholder="Name or User ID" required>
                </p>
                <p>
                    <button type="submit"> Search User </button>
                </p>
            </form>

            <br>

            <!-- result list  -->
            <?php
            if ($user_result) {
                if (mysqli_num_rows($user_result) > 1) {
                    echo "<ul>";
                    while ($users = mysqli_fetch_assoc($user_result)) {
                        $user_id = $users['userName'];
                        $user_name = $users['First_name'] . " " . $users['Last_name'];
                        echo "<a href='al-result.php?searchUser={$user_id}' onclick='loadinEffect()'> <li>{$user_id} - {$user_name} </li></a>";
                    }
                    echo "</ul>";
                } elseif (mysqli_num_rows($user_result) == 1) {
                    $users = mysqli_fetch_assoc($user_result);
                    $id = $users['userName'];
                    $Full_name = $users['First_name'] . " " . $users['Last_name'];
                    $Pro_pic = $users['Pro_pic'];

                    echo "<div class='user-details'>
                        <div class='img'>
                            <img src='../students/{$Pro_pic}'>
                        </div>
                         <div>
                        <p>
                            <b>User ID :</b> {$id} <br>
                            <b>Nmae :</b> {$Full_name}
                        </p>
                        </div>
                    </div> <br>";

                    echo '<form method="post" action="al-result.php">
                    <input type = "number" value="' . $id . '" name="id" required readonly hidden>
                    <input type = "text" value="' . $Pro_pic . '" name="img" required readonly hidden>
                    <input type = "text" value="' . $Full_name . '" name="full_name" required readonly hidden>
                <p>
                Year : <br>
                <input type = "number" placeholder="Exam Year" value="' . $ALyear . '" name="year" required min="2023">
                </p>
                <p>
                Index Number : <br>
                <input type = "number" placeholder="Index number" name="index" required>
                </p>
                <p> Chemistry Result : <br>
                <div class="inline">
                    <span>F : <input type="radio" name="chemistry" value="F" required></span>
                    <span>S : <input type="radio" name="chemistry" value="S"></span>
                    <span>C : <input type="radio" name="chemistry" value="C"></span>
                    <span>B : <input type="radio" name="chemistry" value="B"></span>
                    <span>A : <input type="radio" name="chemistry" value="A"></span>
                </div>
                </p>
                <p> Physics OR Agri Result : <br>
                <div class="inline">
                    <span>F : <input type="radio" name="physics" value="F" required></span>
                    <span>S : <input type="radio" name="physics" value="S"></span>
                    <span>C : <input type="radio" name="physics" value="C"></span>
                    <span>B : <input type="radio" name="physics" value="B"></span>
                    <span>A : <input type="radio" name="physics" value="A"></span>
                </div>
                </p>
                <p> Maths OR Bio Result : <br>
                <div class="inline">
                    <span>F : <input type="radio" name="maths" value="F" required></span>
                    <span>S : <input type="radio" name="maths" value="S"></span>
                    <span>C : <input type="radio" name="maths" value="C"></span>
                    <span>B : <input type="radio" name="maths" value="B"></span>
                    <span>A : <input type="radio" name="maths" value="A"></span>
                </div>
                </p>
                <p><input type="submit" name="submit" value="Save"></p>
            </form>';
                }
            }
            ?>
        </div>
    </div>
    <?php

    // sucess message
    if (isset($_GET['insert'])) {
        if ($_GET['insert'] == "done") {
            echo '<div class="done-message">
            <div class="done-message-center">
                <p> <i class="fa-solid fa-circle-check fa-bounce fa-2xl"></i> </p>
                <h1> Done </h1>
                <p> <a href="al-result.php"> OK </a> </p>
            </div>
        </div>';
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
                <p> <a href='al-result.php'> OK </a> </p>
            </div>
        </div>";
        }
    }

    // already exists
    if (isset($_GET['insert'])) {
        if ($_GET['insert'] == "already-exists") {
            echo '<div class="done-message">
            <div class="done-message-center">
                <p> <i class="fa-solid fa-circle-xmark fa-bounce fa-2xl" style="color: #ff0000;"></i> </p>
                <h1> The report already exists </h1>
                <p> <a href="al-result.php"> OK </a> </p>
            </div>
        </div>';
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