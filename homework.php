<?php
include("includes/connection.php");

if (isset($_SESSION['ID'])) {

    $Timeclass = $_SESSION['Class'];

    $query  =   "SELECT * FROM tbl_register WHERE ID ={$_SESSION['ID']}";
    $result =    mysqli_query($connection, $query);

    $timer = "SELECT * FROM `timer` WHERE `Class` = {$Timeclass}";
    $timer_result = mysqli_query($connection, $timer);

    if ($result) {
        if (mysqli_num_rows($timer_result) == 1) {
            if (mysqli_num_rows($result) == 1) {
                $verify =   mysqli_fetch_assoc($result);
                $verifyUser =   $verify['Confirm_user'];
                $ID =   $verify['ID'];
                $First_name =   $verify['First_name'];
                $Last_name  =   $verify['Last_name'];
                $E_mail     =   $verify['E_mail'];
                $Class      =   $verify['Class'];
                $Category   =   $verify['Category'];
                $Pro_pic    =   $verify['Pro_pic'];
            }

            if (isset($_POST['homeorkSubmit'])) {

                if (!isset($_FILES['pdf']['name']) || strlen(trim($_FILES['pdf']['name'])) < 1) {
                    header("location: index.php?insert=error");
                } elseif (!isset($_POST['title']) || strlen(trim($_POST['title'])) < 1) {
                    header("location: index.php?insert=error");
                } else {

                    $title = mysqli_real_escape_string($connection, $_POST['title']);

                    $fileName = $_FILES['pdf']['name'];
                    $fileTemp = $_FILES['pdf']['tmp_name'];
                    $fileSize = $_FILES['pdf']['size'];
                    $fileType = $_FILES['pdf']['type'];


                    $searchDOC = "SELECT * FROM `homework` WHERE `File_Name` = '{$fileName}'";
                    $searchDOC_result = mysqli_query($connection, $searchDOC);

                    if (mysqli_num_rows($searchDOC_result) == 1) {
                        header("location: index.php?Error=already");
                    } else {

                        if ($fileSize > 20 * 1024 * 1024) {
                            header("location: index.php?Error=File_size_exceeds_20MB_limit");
                        } elseif ($fileType != "application/pdf") {
                            header("location: index.php?Error=File_type");
                        } else {
                            $name = $First_name . " " . $Last_name;

                            $insert_homework = "INSERT INTO `homework` (`User_ID`, `Name`, `Class`, `Title`, `File_Name`) VALUE ({$ID}, '{$name}', {$Class}, '$title', '{$fileName}')";
                            $insert_homework_result = mysqli_query($connection, $insert_homework);
                            $upload_to = "admin/homework/";
                            if ($insert_homework_result) {
                                $upload = move_uploaded_file($fileTemp, $upload_to . $fileName);
                                if ($upload) {
                                    header("location: index.php?insert=done");
                                } else {
                                    header("location: index.php?insert=error");
                                }
                            }
                        }
                    }
                }
            }
        } else {
            header("location: index.php?session=timeout");
        }
    }
}
