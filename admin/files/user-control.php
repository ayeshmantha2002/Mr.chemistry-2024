<?php
include "../../includes/connection.php";
if (isset($_SESSION['ID'])) {
    if ($_SESSION['ID'] >= 3) {
        header("location: ../../index");
    }
} else {
    header("location: ../../index");
}

if (isset($_COOKIE['Class'])) {
    $cate = "class={$_COOKIE['Class']}";
} elseif (isset($_COOKIE['user_category'])) {
    $cate = "user-category={$_COOKIE['user_category']}";
} else {
    $cate = "";
}

// fetch students details
if (isset($_GET['user'])) {
    $userID = mysqli_real_escape_string($connection, $_GET['user']);
    if ($userID < 0) {
        header("location: manage-student.php");
    }
    $user_details = "SELECT * FROM tbl_register WHERE `userName` = '{$userID}'";
    $user_details_result = mysqli_query($connection, $user_details);
    if (mysqli_num_rows($user_details_result) == 1) {
        $details = mysqli_fetch_assoc($user_details_result);
        $ID = $details['userName'];
        $First_name = $details['First_name'];
        $Last_name = $details['Last_name'];
        $E_mail = $details['E_mail'];
        $Class = $details['Class'];
        $Category = $details['Category'];
        $Register_Date = $details['Register_Date'];
        $Pro_pic = $details['Pro_pic'];
        $Is_Active = $details['Is_Active'];
        $Confirm_user = $details['Confirm_user'];

        if ($Category == "Theory") {
            $Theory = "checked";
            $Revision = "";
        } else {
            $Theory = "";
            $Revision = "checked";
        }

        // links
        if ($Is_Active == 1) {
            if ($Confirm_user == 1) {
                $status = "<span style='color: green;'>A valid student</span>";
                $link = "<a onclick='loadinEffect()' href='user-control.php?user={$ID}&status=suspend'>Suspend Now </a>";
            } elseif ($Confirm_user == 2) {
                $link = "<a onclick='loadinEffect()' href='user-control.php?user={$ID}&status=active' style='background-color: red;'> Activete Now </a>";
                $status = "<span style='color: red;'>Suspended student</span>";
            } elseif ($Confirm_user == 3) {
                $link = "<a onclick='loadinEffect()' href='user-control.php?user={$ID}&status=active'> Activete Now </a>" . "<a onclick='loadinEffect()' href='user-control.php?user={$ID}&status=suspend' style='background-color: red;'>Suspend Now </a>";
                $status = "<span style='color: blue;'>A new student</span>";
            }
        } elseif ($Is_Active == 0) {
            $status = "<span style='color: red;'>E-mail not verified</span>";
            $link = "";
        }

        // status update
        if (isset($_GET['status'])) {
            if ($_GET['status'] == "active") {
                $update = "UPDATE tbl_register SET `Confirm_user` = 1 WHERE `userName` = '{$ID}'";
            } elseif ($_GET['status'] == "suspend") {
                $update = "UPDATE tbl_register SET `Confirm_user` = 2 WHERE `userName` = '{$ID}'";
            }

            $update_result = mysqli_query($connection, $update);
            if ($update_result) {
                header("location: manage-student.php?insert=done&{$cate}");
            }
        }

        // update student details
        if (isset($_POST['update'])) {
            $UP_userName = mysqli_real_escape_string($connection, $_POST['userName']);
            $UP_First_name = ucfirst(mysqli_real_escape_string($connection, $_POST['First_name']));
            $UP_Last_name = ucfirst(mysqli_real_escape_string($connection, $_POST['Last_name']));
            $UP_Class = mysqli_real_escape_string($connection, $_POST['Class']);
            $UP_cate = mysqli_real_escape_string($connection, $_POST['cate']);

            $studentUpdate = "UPDATE `tbl_register` SET `First_name` = '{$UP_First_name}', `Last_name` = '{$UP_Last_name}', `userName` = '{$UP_userName}', `Class` = {$UP_Class}, `Category` = '{$UP_cate}' WHERE `userName` = '{$userID}'";
            $studentUpdate_result = mysqli_query($connection, $studentUpdate);

            if ($studentUpdate_result) {
                header("location: manage-student.php?insert=done&{$cate}");
            }
        }

        // update student password
        if (isset($_POST['updatePass'])) {
            $UP_pass = mysqli_real_escape_string($connection, $_POST['new_pass']);
            $hasPass = sha1($UP_pass);

            $studentUpdatePass = "UPDATE `tbl_register` SET `Password` = '{$hasPass}' WHERE `userName` = '{$userID}'";
            $studentUpdatePass_result = mysqli_query($connection, $studentUpdatePass);

            if ($studentUpdatePass_result) {
                header("location: manage-student.php?insert=done&{$cate}");
            }
        }
    }
} else {
    header("location: manage-student.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage user</title>
    <link rel="stylesheet" href="../../assect/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
</head>

<body>
    <!-- main area -->
    <div class="area">
        <div class="area-aline">
            <header>
                <nav>
                    <?php
                    if (isset($_COOKIE['Class'])) {
                        echo " <a onclick='loadinEffect()' href='manage-student.php?class={$_COOKIE['Class']}'>
                        <i class='fa-solid fa-angle-left'></i>
                        </a>";
                    } elseif (isset($_COOKIE['user_category'])) {
                        echo " <a onclick='loadinEffect()' href='manage-student.php?user-category={$_COOKIE['user_category']}'>
                        <i class='fa-solid fa-angle-left'></i>
                        </a>";
                    } else {
                        echo '
                        <a onclick="loadinEffect()" href="manage-student.php">
                        <i class="fa-solid fa-angle-left"></i>
                        </a>
                        ';
                    }
                    ?>
                    <h2> Manage Student </h2>
                </nav>
            </header>
            <br><br><br><br>

            <!-- user details  -->
            <div class='user-info'>
                <p style='text-align: center;'><img style='width: 200px;' src='../students/user.png' alt='profile'></p>
                <br>
                <?php
                echo "<p> <b>User ID : </b> {$ID} </p>
                <p> <b>Name : </b> {$First_name} {$Last_name} </p>
                <p> <b>E-mail : </b> {$E_mail} </p>
                <p> <b>Class : </b> {$Class} </p>
                <p> <b>Category : </b> {$Category} </p>
                <p> <b>Register Date : </b> {$Register_Date} </p>
                <p> <b>Status : </b> {$status} </p>";
                ?>
            </div>
            <br><br>

            <!-- links buttons -->
            <div class="four-buttons">
                <a href="#form" id="changeD">Change details</a>
                <a href="#password" id="changeP">Change Password</a>
            </div>
            <div class="full">
                <?php echo $link; ?>
            </div>

            <!-- update form  -->
            <form method="post" id="form">
                <p> <b>User ID : </b> <input type="text" name="userName" value="<?php echo $ID; ?>"> </p>
                <p> <b>First Name : </b> <input type="text" name="First_name" value="<?php echo $First_name; ?>" required> </p>
                <p> <b>Last Name : </b> <input type="text" name="Last_name" value="<?php echo $Last_name; ?>" required> </p>
                <p> <b>E-mail : </b> <input type="text" value="<?php echo $E_mail; ?>" readonly> </p>
                <p> <b>Class : </b> <input type="number" name="Class" value="<?php echo $Class; ?>" min="2024" required> </p>
                <p>
                    <b>Category : </b> <br>
                <div style="display: flex; justify-content: space-around; align-items: center;">
                    <div>
                        Theory : <input type="radio" name="cate" value="Theory" <?php echo $Theory; ?> required>
                    </div>
                    <div>
                        Revision : <input type="radio" name="cate" value="Revision" <?php echo $Revision; ?>>
                    </div>
                </div>
                </p>
                <p> <input type="submit" onclick='loadinEffect()' name="update" value="Update Details"> </p>
            </form>

            <!-- password update form  -->
            <form method="post" id="password">
                <p> <b>New Password : </b> <input type="text" name="new_pass" placeholder="Enter New Password" required> </p>
                <p> <input type="submit" name="updatePass" value="Update Details"> </p>
            </form>

        </div>
    </div>

    <!-- loader image -->
    <div class="loading" id="loader">
        <img src="../../assect/img/icon/New-file.gif" alt="loading">
    </div>

    <script src="../../assect/js/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#changeD").click(function() {
                $("#form").css("display", "block");
                $("#password").css("display", "none");
            });

            $("#changeP").click(function() {
                $("#password").css("display", "block");
                $("#form").css("display", "none");
            })
        })
    </script>

    <script>
        function loadinEffect() {
            document.getElementById('loader').style.display = "flex";
        }
    </script>

</body>

</html>