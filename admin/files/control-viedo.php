<?php

$select_free = "";
$select_video = "";
$select_paper = "";
$Lesson1 = "";
$Lesson2 = "";
$Lesson3 = "";
$Lesson4 = "";
$Lesson5 = "";
$Lesson6 = "";
$Lesson7 = "";
$Lesson8 = "";
$Lesson9 = "";
$Lesson10 = "";
$Lesson11 = "";
$Lesson12 = "";
$Lesson13 = "";
$Lesson14 = "";
$Lesson15 = "";
$Lesson16 = "";
$Lesson17 = "";
$Lesson18 = "";
$Lesson19 = "";
$Lesson20 = "";
$Lesson21 = "";
$Lesson22 = "";
$Lesson23 = "";
$Lesson24 = "";
$Lesson25 = "";
$Lesson26 = "";
$Lesson27 = "";
$Lesson28 = "";
$Lesson29 = "";
$Lesson30 = "";
$Lesson31 = "";
$Lesson32 = "";
$Lesson33 = "";
$Lesson34 = "";
$Lesson35 = "";
$Lesson36 = "";
$Lesson37 = "";
$Lesson38 = "";
$Lesson39 = "";
$Lesson40 = "";

include "../../includes/connection.php";
if (isset($_SESSION['ID'])) {
    if ($_SESSION['ID'] >= 3) {
        header("location: ../../index");
    }
} else {
    header("location: ../../index");
}

if (isset($_COOKIE['vd'])) {
    $cate = "vd={$_COOKIE['vd']}";
} elseif (isset($_COOKIE['vd-catagory'])) {
    $cate = "catagory={$_COOKIE['vd-catagory']}";
} else {
    $cate = "";
}

// video fetch
if (isset($_GET['videoID'])) {
    $videoID = mysqli_real_escape_string($connection, $_GET['videoID']);

    $video_details = "SELECT * FROM `videos` WHERE `ID` = {$videoID}";
    $video_details_result = mysqli_query($connection, $video_details);
    if (mysqli_num_rows($video_details_result) > 0) {
        $videoDT = mysqli_fetch_assoc($video_details_result);
        $title = $videoDT['Title'];
        $Link = $videoDT['Link'];
        $Description = $videoDT['Description'];
        $Catagory = $videoDT['Catagory'];
        $Lesson = $videoDT['Lesson'];

        if ($Catagory == "free") {
            $select_free = "selected";
        } elseif ($Catagory == "video") {
            $select_video = "selected";
        } elseif ($Catagory == "paper") {
            $select_paper = "selected";
        }

        if ($Lesson == 1) {
            $Lesson = "selected";
        }
        if ($Lesson == 1) {
            $Lesson1 = "selected";
        } elseif ($Lesson == 2) {
            $Lesson2 = "selected";
        } elseif ($Lesson == 3) {
            $Lesson3 = "selected";
        } elseif ($Lesson == 4) {
            $Lesson4 = "selected";
        } elseif ($Lesson == 5) {
            $Lesson5 = "selected";
        } elseif ($Lesson == 6) {
            $Lesson6 = "selected";
        } elseif ($Lesson == 7) {
            $Lesson7 = "selected";
        } elseif ($Lesson == 8) {
            $Lesson8 = "selected";
        } elseif ($Lesson == 9) {
            $Lesson9 = "selected";
        } elseif ($Lesson == 10) {
            $Lesson10 = "selected";
        } elseif ($Lesson == 11) {
            $Lesson11 = "selected";
        } elseif ($Lesson == 12) {
            $Lesson12 = "selected";
        } elseif ($Lesson == 13) {
            $Lesson13 = "selected";
        } elseif ($Lesson == 14) {
            $Lesson14 = "selected";
        } elseif ($Lesson == 15) {
            $Lesson15 = "selected";
        } elseif ($Lesson == 16) {
            $Lesson16 = "selected";
        } elseif ($Lesson == 17) {
            $Lesson17 = "selected";
        } elseif ($Lesson == 18) {
            $Lesson18 = "selected";
        } elseif ($Lesson == 19) {
            $Lesson19 = "selected";
        } elseif ($Lesson == 20) {
            $Lesson20 = "selected";
        } elseif ($Lesson == 21) {
            $Lesson21 = "selected";
        } elseif ($Lesson == 22) {
            $Lesson22 = "selected";
        } elseif ($Lesson == 23) {
            $Lesson23 = "selected";
        } elseif ($Lesson == 24) {
            $Lesson24 = "selected";
        } elseif ($Lesson == 25) {
            $Lesson25 = "selected";
        } elseif ($Lesson == 26) {
            $Lesson26 = "selected";
        } elseif ($Lesson == 27) {
            $Lesson27 = "selected";
        } elseif ($Lesson == 28) {
            $Lesson28 = "selected";
        } elseif ($Lesson == 29) {
            $Lesson29 = "selected";
        } elseif ($Lesson == 30) {
            $Lesson30 = "selected";
        } elseif ($Lesson == 31) {
            $Lesson31 = "selected";
        } elseif ($Lesson == 32) {
            $Lesson32 = "selected";
        } elseif ($Lesson == 33) {
            $Lesson33 = "selected";
        } elseif ($Lesson == 34) {
            $Lesson34 = "selected";
        } elseif ($Lesson == 35) {
            $Lesson35 = "selected";
        } elseif ($Lesson == 36) {
            $Lesson36 = "selected";
        } elseif ($Lesson == 37) {
            $Lesson37 = "selected";
        } elseif ($Lesson == 38) {
            $Lesson38 = "selected";
        } elseif ($Lesson == 39) {
            $Lesson39 = "selected";
        } elseif ($Lesson == 40) {
            $Lesson40 = "selected";
        }
    }
}

// update video details
if (isset($_POST['add-video-db'])) {
    $UPtitle = mysqli_real_escape_string($connection, $_POST['title']);
    $UPlink = mysqli_real_escape_string($connection, $_POST['link']);
    $UPdescription = mysqli_real_escape_string($connection, $_POST['description']);
    $UPcatagory = mysqli_real_escape_string($connection, $_POST['catagory']);
    $UPlesson = mysqli_real_escape_string($connection, $_POST['lesson']);

    $update = "UPDATE `videos` SET `Title` = '{$UPtitle}', `Link` = '{$UPlink}', `Description` = '{$UPdescription}', `Catagory` = '{$UPcatagory}', `Lesson` = {$UPlesson}, `Status` = 1 WHERE `ID` = {$videoID}";
    $update_result = mysqli_query($connection, $update);
    if ($update_result) {
        header("location: manage-videos.php?insert=done&{$cate}");
    } else {
        header("location: manage-videos.php?insert=error&{$cate}");
    }
}

// delete video
if (isset($_GET['delete_video'])) {
    $deleteID = mysqli_real_escape_string($connection, $_GET['delete_video']);

    $deleteVideo = "DELETE FROM `videos` WHERE ID={$deleteID} LIMIT 1";
    $deleteVideo_result = mysqli_query($connection, $deleteVideo);
    if ($deleteVideo_result) {
        header("location: manage-videos.php?insert=done&{$cate}");
    } else {
        header("location: manage-videos.php?insert=error&{$cate}");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control Videos</title>
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
                        echo " <a onclick='loadinEffect()' href='manage-videos.php?{$cate}'>
                        <i class='fa-solid fa-angle-left'></i>
                        </a>";
                    } elseif (isset($_COOKIE['catagory'])) {
                        echo " <a onclick='loadinEffect()' href='manage-videos.php?{$cate}'>
                        <i class='fa-solid fa-angle-left'></i>
                        </a>";
                    } else {
                        echo '
                        <a onclick="loadinEffect()" href="manage-videos.php">
                        <i class="fa-solid fa-angle-left"></i>
                        </a>
                        ';
                    }
                    ?>
                    <h2> Control Video </h2>
                </nav>
            </header>
            <br><br><br><br>

            <form method="post">
                <h2> Update videos details </h2>
                <p>
                    Title : <br>
                    <input type="text" placeholder="title" value="<?php echo $title; ?>" name="title" required>
                </p>
                <p>
                    Embed Link : <br>
                    <textarea placeholder="Embed Video Link" name="link" required> <?php echo $Link; ?> </textarea>
                </p>
                <p>
                    Description : <br>
                    <textarea placeholder="description" name="description" required> <?php echo $Description; ?> </textarea>
                </p>
                <p>
                    Catagory : <br>
                    <select name="catagory" required>
                        <option value="">Choose Catagory</option>
                        <option value="free" <?php echo $select_free ?>>Free Class</option>
                        <option value="video" <?php echo $select_video ?>>Video Class</option>
                        <option value="paper" <?php echo $select_paper ?>>Paper Discussions</option>
                    </select>
                </p>
                <p>
                    Lesson : <br>
                    <select name="lesson" required>
                        <option value="">Choose Catagory</option>
                        <option value="1" <?php echo $Lesson1;  ?>>පරමාණුක ව්‍යූහය</option>
                        <option value="2" <?php echo $Lesson2;  ?>>රසායනික ගණනය</option>
                        <option value="3" <?php echo $Lesson3;  ?>>වායු</option>
                        <option value="4" <?php echo $Lesson4;  ?>>ශක්ති විද්‍යාව</option>
                        <option value="5" <?php echo $Lesson5;  ?>>Inorganic</option>
                        <option value="6" <?php echo $Lesson6;  ?>>Organic</option>
                        <option value="7" <?php echo $Lesson7;  ?>>සමතුලිතතාවය</option>
                        <option value="8" <?php echo $Lesson8;  ?>>කර්මාන්ත</option>
                        <option value="9" <?php echo $Lesson9;  ?>>පරිසරය</option>
                        <option value="10" <?php echo $Lesson10;  ?>>විද්‍යුත් රසායනය</option>

                        <option value="11" <?php echo $Lesson11;  ?>> Modle Paper 01 </option>
                        <option value="12" <?php echo $Lesson12;  ?>> Modle Paper 02 </option>
                        <option value="13" <?php echo $Lesson13;  ?>> Modle Paper 03 </option>
                        <option value="14" <?php echo $Lesson14;  ?>> Modle Paper 04 </option>
                        <option value="15" <?php echo $Lesson15;  ?>> Modle Paper 05 </option>
                        <option value="16" <?php echo $Lesson16;  ?>> Modle Paper 06 </option>
                        <option value="17" <?php echo $Lesson17;  ?>> Modle Paper 07 </option>
                        <option value="18" <?php echo $Lesson18;  ?>> Modle Paper 08 </option>
                        <option value="19" <?php echo $Lesson19;  ?>> Modle Paper 09 </option>
                        <option value="20" <?php echo $Lesson20;  ?>> Modle Paper 10 </option>
                        <option value="21" <?php echo $Lesson21;  ?>> Modle Paper 11 </option>
                        <option value="22" <?php echo $Lesson22;  ?>> Modle Paper 12 </option>
                        <option value="23" <?php echo $Lesson23;  ?>> Modle Paper 13 </option>
                        <option value="24" <?php echo $Lesson24;  ?>> Modle Paper 14 </option>
                        <option value="25" <?php echo $Lesson25;  ?>> Modle Paper 15 </option>
                        <option value="26" <?php echo $Lesson26;  ?>> Modle Paper 16 </option>
                        <option value="27" <?php echo $Lesson27;  ?>> Modle Paper 17 </option>
                        <option value="28" <?php echo $Lesson28;  ?>> Modle Paper 18 </option>
                        <option value="29" <?php echo $Lesson29;  ?>> Modle Paper 19 </option>
                        <option value="30" <?php echo $Lesson30;  ?>> Modle Paper 20 </option>
                        <option value="31" <?php echo $Lesson31;  ?>> Modle Paper 21 </option>
                        <option value="32" <?php echo $Lesson32;  ?>> Modle Paper 22 </option>
                        <option value="33" <?php echo $Lesson33;  ?>> Modle Paper 23 </option>
                        <option value="34" <?php echo $Lesson34;  ?>> Modle Paper 24 </option>
                        <option value="35" <?php echo $Lesson35;  ?>> Modle Paper 25 </option>
                        <option value="36" <?php echo $Lesson36;  ?>> Modle Paper 26 </option>
                        <option value="37" <?php echo $Lesson37;  ?>> Modle Paper 27 </option>
                        <option value="38" <?php echo $Lesson38;  ?>> Modle Paper 28 </option>
                        <option value="39" <?php echo $Lesson39;  ?>> Modle Paper 29 </option>
                        <option value="40" <?php echo $Lesson40;  ?>> Modle Paper 30 </option>
                    </select>
                </p>
                <p>
                    <button type="submit" name="add-video-db"> Update Video </button>
                </p>
            </form>
            <div class="full">
                <a href="control-viedo.php?<?php echo $cate; ?>&delete_video=<?php echo $videoID; ?>" style="background-color: red;">Delete video</a>
                <br>
                <hr>
            </div>
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