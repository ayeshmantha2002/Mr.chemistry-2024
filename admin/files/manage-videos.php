<?php
include "../../includes/connection.php";
if (isset($_SESSION['ID'])) {
    if ($_SESSION['ID'] >= 2) {
        header("location: ../../index");
    }
} else {
    header("location: ../../index");
}

if (isset($_GET['catagory'])) {
    $vd_catagory = mysqli_real_escape_string($connection, $_GET['catagory']);
    setcookie('vd-catagory', $vd_catagory, time() + 60 * 60 * 24);
} elseif (isset($_GET['vd'])) {
    $vd = mysqli_real_escape_string($connection, $_GET['vd']);
    setcookie('vd', $vd, time() + 60 * 60 * 24);
} else {
    setcookie('vd', NULL, -time() + 60 * 60 * 24);
    setcookie('vd-catagory', NULL, time() + 60 * 60 * 24);
}

// fetch video details
if (isset($_POST['videoID'])) {
    $videoID = mysqli_real_escape_string($connection, $_POST['videoID']);

    $SearchCatagory = "SELECT * FROM `videos` WHERE (`Title` LIKE '%{$videoID}%' OR `Catagory` LIKE '%{$videoID}%' OR `Description` LIKE '%{$videoID}%')";
} elseif (isset($_GET['vd'])) {
    $Category = "vd={$_GET['vd']}";
    $studentvd = mysqli_real_escape_string($connection, $_GET['vd']);
    $SearchCatagory = "SELECT * FROM `videos` WHERE `Lesson` = {$studentvd} ORDER BY `ID`";
} elseif (isset($_GET['catagory'])) {
    $Category = "catagory={$_GET['catagory']}";
    $studentvd = mysqli_real_escape_string($connection, $_GET['catagory']);
    $SearchCatagory = "SELECT * FROM `videos` WHERE `Catagory` = '{$studentvd}' ORDER BY `ID`";
} else {
    $Category = "";
    $SearchCatagory = "SELECT * FROM `videos` ORDER BY `ID`";
}
$SearchCatagory_result = mysqli_query($connection, $SearchCatagory);


// insert video
if (isset($_POST['add-video-db'])) {
    $title = mysqli_real_escape_string($connection, $_POST['title']);
    $UniqueID = mysqli_real_escape_string($connection, $_POST['UniqueID']);
    $link = mysqli_real_escape_string($connection, $_POST['link']);
    $description = mysqli_real_escape_string($connection, $_POST['description']);
    $catagory = mysqli_real_escape_string($connection, $_POST['catagory']);
    $lesson = mysqli_real_escape_string($connection, $_POST['lesson']);

    $insert_video = "INSERT INTO `videos` (`Title`, `UniqueID`, `Link`, `Description`, `Catagory`, `Lesson`, `Status`) VALUE ('{$title}', '{$UniqueID}', '{$link}', '{$description}', '{$catagory}', {$lesson}, 1)";
    $insert_video_result = mysqli_query($connection, $insert_video);
    if ($insert_video_result) {
        header("location: manage-videos.php?insert=done");
    } else {
        header("location: manage-videos.php?insert=error");
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Manage Videos </title>
    <link rel="stylesheet" href="../../assect/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <!-- main area  -->
    <div class="area">
        <div class="area-aline" style="max-width: 1000px;">
            <header>
                <nav>
                    <a href="../admin.php" onclick='loadinEffect()'> <i class="fa-solid fa-angle-left"></i> </a>
                    <h2> Manage Videos </h2>
                </nav>
            </header>
            <br><br><br><br>

            <!-- links buttons -->
            <div class="full">
                <a href="manage-videos.php?catagory=free">Free Class</a>
                <a href="manage-videos.php?catagory=video">Video Class</a>
                <a href="manage-videos.php?catagory=paper">Paper Discussions</a>
            </div>
            <br>
            <div class="four-buttons">
                <a onclick='loadinEffect()' href="manage-videos.php?vd=1">පරමාණුක ව්‍යූහය</a>
                <a onclick='loadinEffect()' href="manage-videos.php?vd=2">රසායනික ගණනය</a>
                <a onclick='loadinEffect()' href="manage-videos.php?vd=3">වායු</a>
                <a onclick='loadinEffect()' href="manage-videos.php?vd=4"> ශක්ති විද්‍යාව</a>
                <a onclick='loadinEffect()' href="manage-videos.php?vd=5">Inorganic</a>
                <a onclick='loadinEffect()' href="manage-videos.php?vd=6">Organic</a>
                <a onclick='loadinEffect()' href="manage-videos.php?vd=7"> සමතුලිතතාවය</a>
                <a onclick='loadinEffect()' href="manage-videos.php?vd=8"> කර්මාන්ත </a>
                <a onclick='loadinEffect()' href="manage-videos.php?vd=9"> පරිසරය</a>
                <a onclick='loadinEffect()' href="manage-videos.php?vd=10"> විද්‍යුත් රසායනය </a>
            </div>
            <br>
            <div class="full">
                <a onclick='loadinEffect()' href="manage-videos.php">All Videos</a>
                <a class="add-videos" href="#add-videos">Add Videos </a>
            </div>
            <br>

            <!-- Add video form  -->
            <div id="add-videos">
                <form action="manage-videos.php" method="post">
                    <h2> Add videos </h2>
                    <p>
                        Title : <br>
                        <input type="text" placeholder="title" name="title" required>
                    </p>
                    <p>
                        Embed Link : <br>
                        <textarea placeholder="Embed Video Link" name="link" required></textarea>
                    </p>
                    <p>
                        Description : <br>
                        <textarea placeholder="description" name="description" required></textarea>
                    </p>
                    <p>
                        Catagory : <br>
                        <select name="catagory" required>
                            <option value="">Choose Catagory</option>
                            <option value="free">Free Class</option>
                            <option value="video">Video Class</option>
                            <option value="paper">Paper Discussions</option>
                        </select>
                    </p>
                    <p>
                        Lesson : <br>
                        <select name="lesson" required>
                            <option value="">Choose Catagory</option>
                            <option value="1">පරමාණුක ව්‍යූහය</option>
                            <option value="2">රසායනික ගණනය</option>
                            <option value="3">වායු</option>
                            <option value="4">ශක්ති විද්‍යාව</option>
                            <option value="5">Inorganic</option>
                            <option value="6">Organic</option>
                            <option value="7">සමතුලිතතාවය</option>
                            <option value="8">කර්මාන්ත</option>
                            <option value="9">පරිසරය</option>
                            <option value="10">විද්‍යුත් රසායනය</option>

                            <option value="11"> Modle Paper 01 </option>
                            <option value="12"> Modle Paper 02 </option>
                            <option value="13"> Modle Paper 03 </option>
                            <option value="14"> Modle Paper 04 </option>
                            <option value="15"> Modle Paper 05 </option>
                            <option value="16"> Modle Paper 06 </option>
                            <option value="17"> Modle Paper 07 </option>
                            <option value="18"> Modle Paper 08 </option>
                            <option value="19"> Modle Paper 09 </option>
                            <option value="20"> Modle Paper 10 </option>
                            <option value="21"> Modle Paper 11 </option>
                            <option value="22"> Modle Paper 12 </option>
                            <option value="23"> Modle Paper 13 </option>
                            <option value="24"> Modle Paper 14 </option>
                            <option value="25"> Modle Paper 15 </option>
                            <option value="26"> Modle Paper 16 </option>
                            <option value="27"> Modle Paper 17 </option>
                            <option value="28"> Modle Paper 18 </option>
                            <option value="29"> Modle Paper 19 </option>
                            <option value="30"> Modle Paper 20 </option>
                            <option value="31"> Modle Paper 21 </option>
                            <option value="32"> Modle Paper 22 </option>
                            <option value="33"> Modle Paper 23 </option>
                            <option value="34"> Modle Paper 24 </option>
                            <option value="35"> Modle Paper 25 </option>
                            <option value="36"> Modle Paper 26 </option>
                            <option value="37"> Modle Paper 27 </option>
                            <option value="38"> Modle Paper 28 </option>
                            <option value="39"> Modle Paper 29 </option>
                            <option value="40"> Modle Paper 30 </option>
                        </select>
                    </p>
                    <br>
                    <p style="color: red;">
                        Unique ID <br> ( Paper Discussions video එකක් නම් Paper එකට අදාල Unique ID එක සඳහන් කරන්න. ) :
                        <input type="text" placeholder="Unique ID" name="UniqueID">
                    </p>
                    <br>
                    <p>
                        <button type="submit" name="add-video-db"> Add Video </button>
                    </p>
                </form>
            </div>
            <br>

            <!-- students search form -->
            <form action="manage-videos.php" method="post">
                <h2> Search Video </h2>
                <p>
                    Title or Description: <br>
                    <input name="videoID" placeholder="Title or Description" required>
                </p>
                <p><button type="submit" onclick='loadinEffect()'> Search </button></p>
            </form>

            <!-- students list  -->
            <ul>
                <?php
                if ($SearchCatagory_result) {
                    if (mysqli_num_rows($SearchCatagory_result) > 0) {
                        while ($videos = mysqli_fetch_assoc($SearchCatagory_result)) {
                            $video_id = $videos['ID'];
                            $video_Title = $videos['Title'];
                            $video_Link = $videos['Link'];
                            $videi_Description = $videos['Description'];

                            echo "<a href='control-viedo.php?videoID={$video_id}'>
                            <div class='event-details'>
                            <div class='eventIMG'>
                                    {$video_Link}
                                </div>
                                <div class='event-discription'>
                                <h2> {$video_Title} </h2>
                                    <p> {$videi_Description} </p>
                                    <h3 style='text-align: center;'> Click more details... </h3>
                                </div>
                            </div>
                            </a>
                            <br>";
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
                <p> <a href='manage-videos.php?{$Category}'> OK </a> </p>
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
                <p> <a href='manage-videos.php?{$Category}'> OK </a> </p>
            </div>
        </div>";
        }
    }
    ?>
    <!-- loader image -->
    <div class="loading" id="loader">
        <img src="../../assect/img/icon/New-file.gif" alt="loading">
    </div>
    <script src="../../assect/js/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            var show = true;
            $(".add-videos").click(function() {
                if (show == true) {
                    $("#add-videos").css("display", "block");
                    show = false;
                } else {
                    $("#add-videos").css("display", "none");
                    show = true;
                }
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