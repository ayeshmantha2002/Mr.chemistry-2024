<?php
include "../../includes/connection.php";
if (isset($_SESSION['ID'])) {
    if ($_SESSION['ID'] >= 3) {
        header("location: ../../index");
    }
} else {
    header("location: ../../index");
}

// fetch homeworks file 
if (isset($_GET['class'])) {
    if ($_GET['class'] == "new") {
        $Category = "class={$_GET['class']}";
        $homework = "SELECT * FROM `homework` WHERE `Status` = 0 ORDER BY `Status`";
    } else {
        $Category = "class={$_GET['class']}";
        $studentclass = mysqli_real_escape_string($connection, $_GET['class']);
        $homework = "SELECT * FROM `homework` WHERE Class = {$studentclass} ORDER BY `Status`";
    }
} elseif (isset($_POST['search'])) {
    $Category = "";
    $homeworkID = mysqli_real_escape_string($connection, $_POST['homeworkID']);
    $homework = "SELECT * FROM `homework` WHERE (`User_ID` LIKE '%{$homeworkID}%' OR `Title` LIKE '%{$homeworkID}%' OR `Name` LIKE '%{$homeworkID}%' OR `File_Name` LIKE '%{$homeworkID}%') ORDER BY `Status`";
} else {
    $Category = "";
    $homework = "SELECT * FROM `homework` ORDER BY `Status`";
}
$homework_result = mysqli_query($connection, $homework);

// delete file
if (isset($_GET['delete'])) {
    $id = mysqli_real_escape_string($connection, $_GET['delete']);
    $name = mysqli_real_escape_string($connection, $_GET['name']);
    $delet_Item = "DELETE FROM `homework` WHERE ID={$id} AND `File_Name` = '{$name}' LIMIT 1";
    $delet_Item_result = mysqli_query($connection, $delet_Item);

    if ($delet_Item_result) {
        $parth = "../homework/$name";
        if (unlink($parth)) {
            header("location:home-work.php?insert=done&{$Category}");
        } else {
            header("location:home-work.php?insert=error&{$Category}");
        }
    }
}

// unread documents
if (isset($_GET['status_id'])) {
    $status_ID = mysqli_real_escape_string($connection, $_GET['status_id']);
    $updateStatus = "UPDATE `homework` SET `Status` = 1 WHERE ID = {$status_ID}";
    $updateStatus_result = mysqli_query($connection, $updateStatus);
    if ($updateStatus_result) {
        header("location: home-work.php?{$Category}");
    } else {
        header("location: home-work.php?insert=error");
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Homework</title>
    <link rel="stylesheet" href="../../assect/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="area">
        <div class="area-aline">
            <header>
                <nav>
                    <a href="../admin.php" onclick='loadinEffect()'> <i class="fa-solid fa-angle-left"></i> </a>
                    <h2> Mange Homework </h2>
                </nav>
            </header>
            <br><br><br><br>

            <!-- links buttons -->
            <div class="four-buttons">
                <a onclick='loadinEffect()' href="home-work.php">All Users</a>
                <?php
                // latest class list
                $class_list1 = "SELECT * FROM class ORDER BY Class";
                $class_list_result1 = mysqli_query($connection, $class_list1);
                if (mysqli_num_rows($class_list_result1) > 0) {
                    while ($class1 = mysqli_fetch_assoc($class_list_result1)) {
                        echo "<a href='home-work.php?class={$class1['class']}' onclick='loadinEffect()'>{$class1['class']}</a>";
                    }
                }
                ?>
            </div>
            <div class="full">
                <a onclick='loadinEffect()' href="home-work.php?class=new"> Unread documents </a>
            </div>

            <!-- students search form -->
            <form action="home-work.php" method="post">
                <h2> Search document </h2>
                <p>
                    Title / User ID / Name of File Name : <br>
                    <input name="homeworkID" placeholder="Title / User ID / Name of File Name">
                </p>
                <p><button type="submit" onclick='loadinEffect()' name="search"> Search </button></p>
            </form>
            <br>

            <!-- list homework docs  -->
            <?php
            if ($homework_result) {
                if (mysqli_num_rows($homework_result) > 0) {
                    echo "<ul>";
                    while ($home_file = mysqli_fetch_assoc($homework_result)) {
                        $ID = $home_file['ID'];
                        $User_ID = $home_file['User_ID'];
                        $Name = $home_file['Name'];
                        $Class = $home_file['Class'];
                        $Title = $home_file['Title'];
                        $File_Name = $home_file['File_Name'];
                        $Date_Time = $home_file['Date_Time'];
                        $Status = $home_file['Status'];
                        if ($Status != 1) {
                            $status_link = "<a href='home-work.php?status_id={$ID}&{$Category}' onclick='loadinEffect()'><div class='side-ball'></div></a>";
                        } else {
                            $status_link = "";
                        }
                        echo "<a>
                        <li style='position: relative;'>
                            <div id='student-details'>
                                <p><b>Title : {$Title}</b> <br> <b>User ID :</b> {$User_ID} <br> <b>Class :</b> {$Class} <br>{$Name} <br> <b>{$Date_Time}</b></p>
                                <p></p>
                                <p> <a href='../homework/$File_Name' class='download-link' download> Download </a> <br> <br> <a href='home-work.php?delete={$ID}&name={$File_Name}&{$Category}' id='download-link' onclick='loadinEffect()'> Delete </a> <br></p>
                            </div>
                            $status_link
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

    <!-- done message  -->
    <?php
    if (isset($_GET['insert'])) {
        if ($_GET['insert'] == "done") {
            echo '<div class="done-message">
            <div class="done-message-center">
                <p> <i class="fa-solid fa-circle-check fa-bounce fa-2xl"></i> </p>
                <h1> Done </h1>
                <p> <a href="home-work.php"> OK </a> </p>
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
                <p> <a href='home-work.php'> OK </a> </p>
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