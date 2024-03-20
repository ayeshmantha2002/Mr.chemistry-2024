<?php
// securuty
include "../../includes/connection.php";
if (isset($_SESSION['ID'])) {
    if ($_SESSION['ID'] >= 3) {
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
    $scoreList = "SELECT * FROM score WHERE User_ID = '{$userID}' ORDER BY ID DESC";
    $scoreList_result = mysqli_query($connection, $scoreList);

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

    // insert data 
    if (isset($_POST['insert'])) {

        if (!isset($_POST['copied']) || strlen(trim($_POST['copied'])) < 1) {
            header("location: edit-or-insert.php?insert=error&user={$userID}");
        } elseif (!isset($_POST['score']) || strlen(trim($_POST['score'])) < 1) {
            header("location: edit-or-insert.php?insert=error&user={$userID}");
        } else {

            $score = mysqli_real_escape_string($connection, $_POST['score']);
            $copied = mysqli_real_escape_string($connection, $_POST['copied']);
            $paperNumber = mysqli_real_escape_string($connection, $_POST['paper']);

            $check = "SELECT * FROM score WHERE User_ID = '{$userID}' AND Test = '{$paperNumber}'";
            $check_result = mysqli_query($connection, $check);
            if (mysqli_num_rows($check_result) !== 1) {
                $insert = "INSERT INTO score (`User_ID`, `Full_name`, `Class`, `Category`, `Test`, `Score`, `Status`, `Average`, `Pro_pic`) VALUE ('{$userID}', '{$name}', {$class}, '{$Category}', '{$paperNumber}', '{$score}', {$copied}, 0, '{$Pro_pic}')";
                $insert_result = mysqli_query($connection, $insert);

                header("location: avarage.php?user={$userID}&score={$score}&class={$class}&test={$paperNumber}");
            } else {
                $allready = "record already exist";
            }
        }
    }

    // delete score recordes
    if (isset($_GET['delete'])) {
        $deleteID = mysqli_real_escape_string($connection, $_GET['delete']);

        $delete = "DELETE FROM score WHERE ID = {$deleteID}";
        $delete_result = mysqli_query($connection, $delete);

        if ($delete_result) {
            header("location: edit-or-insert.php?insert=done&user={$userID}");
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
                        <a onclick="loadinEffect()" href="add-score.php">
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
                <h2> Add a Score </h2>
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
                        <?php
                        for ($mp = 1; $mp <= 9; $mp++) {
                            echo "<option value='MP 0{$mp}'";
                            if ($mp == $paper_count) {
                                echo "selected";
                            }
                            echo "> MP 0{$mp} </option>";
                        }

                        for ($mp = 10; $mp <= 30; $mp++) {
                            echo "<option value='MP {$mp}'";
                            if ($mp == $paper_count) {
                                echo "selected";
                            }
                            echo "> MP {$mp} </option>";
                        }
                        ?>
                    </select>
                </p>
                <p>Verified : <input type="radio" value="1" name="copied"></p>
                <p>Copied : <input type="radio" value="3" name="copied"></p>
                <p>Absent : <input type="radio" value="2" name="copied"></p>

                <p>
                    Score : <br>
                    <input type="number" name="score" placeholder="Enter Score" max="100">
                </p>
                <p><input onclick="loadinEffect()" type="submit" name="insert" value="Save"></p>
            </form>
            <br><br>

            <!-- Score list  -->
            <ul>
                <?php
                if (mysqli_num_rows($scoreList_result) > 0) {
                    echo '<p style="text-align: center;"> Click & delete <i class="fa-solid fa-hand-point-down"></i> </p>';
                    while ($score_list = mysqli_fetch_assoc($scoreList_result)) {
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
                        echo "<a onclick='loadinEffect()' href='edit-or-insert.php?delete={$ID}&user={$userID}'>
                    <li style='justify-content: space-between; display: flex;'><div>{$Test}</div> <div>{$Score} %</div> <div>{$Status_view}</div></li>
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