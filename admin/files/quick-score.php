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

if (!isset($_GET['class']) || !isset($_GET['paper'])) {
    header("location:../admin.php?error");
    exit;
}
$score = "";
$hide = "";
$Class = mysqli_real_escape_string($connection, $_GET['class']);
$Paper = mysqli_real_escape_string($connection, $_GET['paper']);
$Branch = mysqli_real_escape_string($connection, $_GET['branch']);

// filter students for class
if (isset($_POST['search'])) {
    $search = mysqli_real_escape_string($connection, $_POST['search']);
    $students = "SELECT * FROM `tbl_register` WHERE (`userName` LIKE '%{$search}%') AND `Class` = {$Class} AND `Confirm_user` = 1 ORDER BY `userName`";
} else {
    $students = "SELECT * FROM `tbl_register` WHERE (`userName` LIKE '{$Branch}%') AND `Class` = {$Class} AND `Confirm_user` = 1 ORDER BY `userName`";
}
$studentsQuery = mysqli_query($connection, $students);

// filter Score list
if (isset($_POST['search'])) {
    $search = mysqli_real_escape_string($connection, $_POST['search']);
    $scoreList = "SELECT * FROM `score` WHERE (`User_ID` LIKE '%{$search}%') AND `Test` = '{$Paper}' ORDER BY `User_ID`";
    $submit_hide = "hidden";
} else {
    $submit_hide = "";
    $scoreList = "SELECT * FROM `score` WHERE (`User_ID` LIKE '{$Branch}%') AND `Test` = '{$Paper}' ORDER BY `User_ID`";
}
$scoreListQuery = mysqli_query($connection, $scoreList);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Add Score </title>
    <link rel="stylesheet" href="../../assect/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .area-aline {
            overflow-x: auto;
        }

        td {
            padding: 0;
        }

        td input {
            background-color: transparent;
            padding: 10px;
            box-sizing: border-box;
            border: none;
            outline: none;
            width: 100%;
            height: 100%;
        }

        td input[type="submit"] {
            cursor: pointer;
            font-weight: bold;
        }
    </style>
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
            <form method="post">
                <input type="search" placeholder="Student ID" name=search>
            </form>
            <br>
            <a href="quick-score.php?class=<?= $Class; ?>&paper=<?= $Paper; ?>&branch=<?= $Branch; ?>" style="padding: 10px; margin-left: 50px; background-color: var(--text-blue); color: #fff;"> ALL RESULTS </a>
            <br><br>
            <h2> Paper Number : <?php echo $Paper . "<br> " . "[" . $Class . "]" ?> </h2>
            <br>
            <table>
                <thead>
                    <tr>
                        <th> User Id </th>
                        <th> Full Name </th>
                        <th <?= $submit_hide; ?>> Score </th>
                    </tr>
                </thead>
                <tbody>
                    <br>
                    <h2 style="color: red;"> Absent value - AB </h2>
                    <?php
                    $count = 1;
                    if (mysqli_num_rows($studentsQuery) > 0) {
                        $i = mysqli_num_rows($studentsQuery);
                        echo " <form method='post'>";
                        while ($studentList = mysqli_fetch_assoc($studentsQuery)) {
                            $userID = $studentList['userName'];
                            $userFullName = $studentList['First_name'] . " " . $studentList['Last_name'];
                            $userCategory = $studentList['Category'];
                            $userPro_pic = $studentList['Pro_pic'];

                            // filter students for class
                            $test = "SELECT * FROM `score` WHERE `User_ID` = '{$userID}' AND `Test` = '{$Paper}'";
                            $testQuery = mysqli_query($connection, $test);

                            if (mysqli_num_rows($testQuery) == 1) {
                                $hide = "hidden";
                                echo "<tr {$hide}>
                                        <td>  <input type='text' name='userid' value='{$userID}' required readonly> </td>
                                        <td>  <input type='text' name='fullname' value='{$userFullName}' required readonly> </td>
                                        <td {$submit_hide}>  <input type='text' name='score' value='{$score}' required> </td>
                                    </tr>";
                            } else {

                                // insert score
                                if (isset($_POST['submit'])) {
                                    $addScore = strtoupper(mysqli_real_escape_string($connection, $_POST['score' . $count]));

                                    if ($addScore == "AB") {
                                        $insertScore = "INSERT INTO `score` (`User_ID`, `Full_name`, `Class`, `Category`, `Test`, `Score`, `Status`, `Average`, `Pro_pic`) VALUE ('{$userID}', '{$userFullName}', {$Class}, '{$userCategory}', '{$Paper}', 0, 2, 1, '{$userPro_pic}')";
                                    } else {
                                        $insertScore = "INSERT INTO `score` (`User_ID`, `Full_name`, `Class`, `Category`, `Test`, `Score`, `Status`, `Average`, `Pro_pic`) VALUE ('{$userID}', '{$userFullName}', {$Class}, '{$userCategory}', '{$Paper}', {$addScore}, 1, 1, '{$userPro_pic}')";
                                    }
                                    $insertScoreQuery = mysqli_query($connection, $insertScore);
                                    if ($insertScoreQuery) {
                                        header("location: avarage.php?class={$Class}&test={$Paper}&quick=done&branch={$Branch}");
                                    }
                                }

                                $hide = "";
                                echo "<tr>
                                        <td>  <input type='text' name='userid{$count}' value='{$userID}' required readonly> </td>
                                        <td>  <input type='text' name='fullname{$count}' value='{$userFullName}' required readonly> </td>
                                        <td {$submit_hide}>  <input type='text' name='score{$count}' value='{$score}' required> </td>
                                    </tr>";
                            }
                            $count++;
                        }
                        echo "<tr {$hide} {$submit_hide}>
                                <td colspan='3'>  <input type='submit'  name='submit' value='SUBMIT'> </td>
                            </tr>";
                        echo "</form>";
                    }
                    ?>
                </tbody>
            </table>
            <br><br>
            <hr>
            <br>
            <h2> Submited List </h2>
            <table>
                <thead>
                    <tr>
                        <th> User Id </th>
                        <th> Full Name </th>
                        <th> Paper Number </th>
                        <th> Score </th>
                        <th> Edit </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($scoreListQuery) > 0) {
                        while ($scoreListFetch = mysqli_fetch_assoc($scoreListQuery)) {
                            $SSID = $scoreListFetch['ID'];
                            $ListUserID = $scoreListFetch['User_ID'];
                            $ListUserFullName = $scoreListFetch['Full_name'];
                            $ListUserCategory = $scoreListFetch['Test'];
                            $ListUserPro_Score = $scoreListFetch['Score'];
                            $parth = "edit-or-insert.php?user={$ListUserID}&SSID={$SSID}";

                            echo "<tr>
                                    <td> {$ListUserID} </td>
                                    <td> {$ListUserFullName} </td>
                                    <td> {$ListUserCategory} </td>
                                    <td> {$ListUserPro_Score} </td>
                                    <td> <a href='{$parth}'> EDIT </a> </td>
                                </tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

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