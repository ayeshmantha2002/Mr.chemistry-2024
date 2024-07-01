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

$allready = "";

// fetch user details & paper count & delet
if (isset($_GET['user'])) {
    $userID = mysqli_real_escape_string($connection, $_GET['user']);

    // filter score 
    $scoreList2 = "SELECT * FROM score WHERE User_ID = '{$userID}' AND `ID` = {$_GET['SSID']} ORDER BY ID DESC";
    $scoreList2_result = mysqli_query($connection, $scoreList2);

    $scoreList = "SELECT * FROM score WHERE User_ID = '{$userID}' AND `ID` = {$_GET['SSID']} ORDER BY ID DESC";
    $scoreList_result = mysqli_query($connection, $scoreList);

    $MP_number = mysqli_fetch_assoc($scoreList_result);
    $mp_nmberFetch = $MP_number['Test'];
    $mp_score = $MP_number['Score'];
    $mp_class = $MP_number['Class'];
    $mp_Status = $MP_number['Status'];

    if ($mp_Status == 1) {
        $one = "checked";
        $tow = "";
        $three = "";
    } elseif ($mp_Status == 2) {
        $one = "";
        $tow = "checked";
        $three = "";
    } elseif ($mp_Status == 3) {
        $one = "";
        $tow = "";
        $three = "checked";
    }

    $user = "SELECT * FROM tbl_register WHERE userName = '{$userID}'";
    $user_result = mysqli_query($connection, $user);

    if (mysqli_num_rows($user_result) > 0) {
        $user_details = mysqli_fetch_assoc($user_result);
        $name = $user_details['First_name'] . " " . $user_details['Last_name'];
        $class = $user_details['Class'];
        $Category = $user_details['Category'];
        $Pro_pic = $user_details['Pro_pic'];
    }
    $paper = "SELECT DISTINCT Test FROM `score` WHERE Class = {$class}";
    $paper_result = mysqli_query($connection, $paper);

    $paper_count = mysqli_num_rows($paper_result);

    // update data 
    if (isset($_POST['insert'])) {

        if (!isset($_POST['copied']) || strlen(trim($_POST['copied'])) < 1) {
            header("location: edit-or-insert.php?insert=error&user={$userID}");
        } elseif (!isset($_POST['score']) || strlen(trim($_POST['score'])) < 1) {
            header("location: edit-or-insert.php?insert=error&user={$userID}");
        } else {

            $score = mysqli_real_escape_string($connection, $_POST['score']);
            $copied = mysqli_real_escape_string($connection, $_POST['copied']);
            $paperNumber = mysqli_real_escape_string($connection, $_POST['paper']);

            $insert = "UPDATE score SET `Test` = '{$paperNumber}', `Score` = '{$score}', `Status` = {$copied} WHERE `ID` = {$_GET['SSID']}";
            $insert_result = mysqli_query($connection, $insert);

            header("location: avarage.php?user={$userID}&score={$score}&class={$class}&test={$paperNumber}&quick");
        }
    }

    // delete score recordes
    if (isset($_GET['delete'])) {
        $deleteID = mysqli_real_escape_string($connection, $_GET['delete']);

        $delete = "DELETE FROM score WHERE ID = {$deleteID}";
        $delete_result = mysqli_query($connection, $delete);

        if ($delete_result) {
            header("location: quick-score.php?class={$mp_class}&paper={$mp_nmberFetch}");
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Score Page</title>
    <link rel="stylesheet" href="../../assect/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <!-- main area  -->
    <div class="area">
        <div class="area-aline">
            <header>
                <nav>
                    <?php
                    if (isset($_COOKIE['Class'])) {
                        echo " <a onclick='loadinEffect()' href='add-score.php?class={$_COOKIE['Class']}'>
                        <i class='fa-solid fa-angle-left'></i>
                        </a>";
                    } else {
                        echo '
                        <a onclick="loadinEffect()" href="../admin.php">
                        <i class="fa-solid fa-angle-left"></i>
                        </a>
                        ';
                    }
                    ?>
                    <h2> SCORE </h2>
                </nav>
            </header>
            <br><br><br><br>

            <!-- add times form  -->
            <form method="post">
                <h2> Edit a Score </h2>
                <p style="color: tomato; text-align: center;"> <?php echo $allready; ?> </p>
                <p> User ID : <br>
                    <input type="number" placeholder="<?php echo $userID; ?>" readonly>
                </p>
                <p> Name : <br>
                    <input type="text" placeholder="<?php echo $name; ?>" readonly>
                </p>
                <p> Class : <br>
                    <input type="text" placeholder="<?php echo $class; ?>" readonly>
                </p>
                <p> Select Paper :<br>
                    <select name="paper" required>
                        <option value=""> Choose </option>
                        <option value="">Choose Paper Number</option>
                        <option value="MP 01 AND 02" <?php if ($mp_nmberFetch == 'MP 01 AND 02') {
                                                            echo "selected";
                                                        } ?>>MP 01 AND 02</option>
                        <option value="MP 03 AND 04" <?php if ($mp_nmberFetch == 'MP 03 AND 04') {
                                                            echo "selected";
                                                        } ?>>MP 03 AND 04</option>
                        <option value="MP 05 AND 06" <?php if ($mp_nmberFetch == 'MP 05 AND 06') {
                                                            echo "selected";
                                                        } ?>>MP 05 AND 06</option>
                        <option value="MP 07 AND 08" <?php if ($mp_nmberFetch == 'MP 07 AND 08') {
                                                            echo "selected";
                                                        } ?>>MP 07 AND 08</option>
                        <option value="MP 09 AND 10" <?php if ($mp_nmberFetch == 'MP 09 AND 10') {
                                                            echo "selected";
                                                        } ?>>MP 09 AND 10</option>
                        <option value="MP 11 AND 12" <?php if ($mp_nmberFetch == 'MP 11 AND 12') {
                                                            echo "selected";
                                                        } ?>>MP 11 AND 12</option>
                        <option value="MP 13 AND 14" <?php if ($mp_nmberFetch == 'MP 13 AND 14') {
                                                            echo "selected";
                                                        } ?>>MP 13 AND 14</option>
                        <option value="MP 15 AND 16" <?php if ($mp_nmberFetch == 'MP 15 AND 16') {
                                                            echo "selected";
                                                        } ?>>MP 15 AND 16</option>
                        <option value="MP 17 AND 18" <?php if ($mp_nmberFetch == 'MP 17 AND 18') {
                                                            echo "selected";
                                                        } ?>>MP 17 AND 18</option>
                        <option value="MP 19 AND 20" <?php if ($mp_nmberFetch == 'MP 19 AND 20') {
                                                            echo "selected";
                                                        } ?>>MP 19 AND 20</option>
                        <option value="MP 21 AND 22" <?php if ($mp_nmberFetch == 'MP 21 AND 22') {
                                                            echo "selected";
                                                        } ?>>MP 21 AND 22</option>
                        <option value="MP 23 AND 24" <?php if ($mp_nmberFetch == 'MP 23 AND 24') {
                                                            echo "selected";
                                                        } ?>>MP 23 AND 24</option>
                        <option value="MP 25 AND 26" <?php if ($mp_nmberFetch == 'MP 25 AND 26') {
                                                            echo "selected";
                                                        } ?>>MP 25 AND 26</option>
                        <option value="MP 27 AND 28" <?php if ($mp_nmberFetch == 'MP 27 AND 28') {
                                                            echo "selected";
                                                        } ?>>MP 27 AND 28</option>
                        <option value="MP 29 AND 30" <?php if ($mp_nmberFetch == 'MP 29 AND 30') {
                                                            echo "selected";
                                                        } ?>>MP 29 AND 30</option>
                        <option value="MP 31 AND 32" <?php if ($mp_nmberFetch == 'MP 31 AND 32') {
                                                            echo "selected";
                                                        } ?>>MP 31 AND 32</option>
                        <option value="MP 33 AND 34" <?php if ($mp_nmberFetch == 'MP 33 AND 34') {
                                                            echo "selected";
                                                        } ?>>MP 33 AND 34</option>
                        <option value="MP 35 AND 36" <?php if ($mp_nmberFetch == 'MP 35 AND 36') {
                                                            echo "selected";
                                                        } ?>>MP 35 AND 36</option>
                        <option value="MP 37 AND 38" <?php if ($mp_nmberFetch == 'MP 37 AND 38') {
                                                            echo "selected";
                                                        } ?>>MP 37 AND 38</option>
                        <option value="MP 39 AND 40" <?php if ($mp_nmberFetch == 'MP 39 AND 40') {
                                                            echo "selected";
                                                        } ?>>MP 39 AND 40</option>
                    </select>
                </p>
                <p>Verified : <input type="radio" value="1" name="copied" <?= $one; ?>></p>
                <p>Absent : <input type="radio" value="2" name="copied" <?= $tow; ?>></p>
                <p>Copied : <input type="radio" value="3" name="copied" <?= $three; ?>></p>

                <p>
                    Score : <br>
                    <input type="number" name="score" placeholder="Enter Score" max="100" value="<?= $mp_score; ?>">
                </p>
                <p><input onclick="loadinEffect()" type="submit" name="insert" value="Save"></p>
            </form>
            <br>

            <!-- Score list  -->
            <ul>
                <?php
                if (mysqli_num_rows($scoreList2_result) > 0) {
                    while ($score_list = mysqli_fetch_assoc($scoreList2_result)) {
                        $ID = $score_list['ID'];
                        $Test = $score_list['Test'];
                        $Score = $score_list['Score'];
                        $Status = $score_list['Status'];
                        if ($Status == 1) {
                            $Status_view = "Verified";
                        } elseif ($Status == 2) {
                            $Status_view = "Absent";
                        } else {
                            $Status_view = "<span style='color: red;'> Copied </span>";
                        }
                        echo "<a onclick='loadinEffect()' href='edit-or-insert.php?delete={$ID}&user={$userID}&SSID={$ID}'>
                    <li style='justify-content: center; display: flex; background-color: red; color: #fff; font-weight: bold;'> DELETE </li>
                </a>";
                    }
                }
                ?>
            </ul>
            <br><br>
        </div>
    </div>

    <?php
    // done message
    if (isset($_GET['insert'])) {
        if ($_GET['insert'] == "done") {
            echo "<div class='done-message'>
            <div class='done-message-center'>
                <p> <i class='fa-solid fa-circle-check fa-bounce fa-2xl'></i> </p>
                <h1> Done </h1>
                <p> <a href='edit-or-insert.php?user={$userID}'> OK </a> </p>
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
                <p> <a href='edit-or-insert.php?user={$userID}'> OK </a> </p>
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