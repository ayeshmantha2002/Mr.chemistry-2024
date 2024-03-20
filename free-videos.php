<?php
$search = "";
include("includes/connection.php");

if (isset($_POST['search'])) {
    $searchID = mysqli_real_escape_string($connection, $_POST['searchID']);
    $video = "SELECT * FROM videos WHERE `Catagory` = 'free' AND (`Title` LIKE '%{$searchID}%')";
} elseif (isset($_GET['vd'])) {
    $vd = mysqli_real_escape_string($connection, $_GET['vd']);
    $catagory = mysqli_real_escape_string($connection, $_GET['catagory']);

    $video = "SELECT * FROM videos WHERE `Catagory` = 'free' AND `Lesson` = {$vd}";
} else {
    header("location: index");
}
$video_result = mysqli_query($connection, $video);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mr.ChemistrY - Free Videos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assect/css/contact.css">
    <link rel="stylesheet" href="assect/css/style.css">
    <link rel="stylesheet" href="boxicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="icon" href="assect/img/icon/logo.png">
</head>

<body>
    <div class="blur"></div>

    <div class="loading" id="loader">
        <img src="assect/img/icon/New-file.gif" alt="loading">
    </div>

    <!-- upper navigation bar -->
    <div id="upNav">
        <div class="upNav">
            <div class="logo">
                <h3> <i class="fa-solid fa-bars" id="navClick" style="color: var(--text-blue);
                padding-right: 15px;
                font-size: 25px;
                transform: translateY(4px);
                cursor: pointer;"></i> Mr.Chemistry<span id="maths">.lk </span> </h3>
                <p> NIPUN PALLIYAGURU </p>
            </div>
            <ul>
                <li><a href="index"> Home </a></li>
                <?php
                if (!isset($_SESSION['ID'])) {
                    echo '<li><a href="login"> Login </a></li>';
                }
                ?>
            </ul>
        </div>
    </div>
    <div class="hero">
        <!-- nav bar -->
        <?php
        include("includes/sidenav.php");
        ?>
        <div class="content">
            <div class="lable">
                <div class="lableAling">
                    <h2> Free Video Classes </h2>
                    <p>Mr.ChemistrY - Chemistry <span style='font-family: "Noto Sans Sinhala"; font-weight: bold;'> වලට තවත් නමක් </span> </p>
                </div>
            </div>

            <div class="eventAlin">
                <div class="classListBack" style="transform: translateY(-50px); border-radius: 5px;">
                    <a href="free-videos.php?catagory=free&vd=1">පරමාණුක ව්‍යූහය</a>
                    <a href="free-videos.php?catagory=free&vd=2">රසායනික ගණනය</a>
                    <a href="free-videos.php?catagory=free&vd=3">වායු</a>
                    <a href="free-videos.php?catagory=free&vd=4"> ශක්ති විද්‍යාව</a>
                    <a href="free-videos.php?catagory=free&vd=5">Inorganic</a>
                    <a href="free-videos.php?catagory=free&vd=6">Organic</a>
                    <a href="free-videos.php?catagory=free&vd=7"> සමතුලිතතාවය</a>
                    <a href="free-videos.php?catagory=free&vd=8"> කර්මාන්ත </a>
                    <a href="free-videos.php?catagory=free&vd=9"> පරිසරය</a>
                    <a href="free-videos.php?catagory=free&vd=10"> විද්‍යුත් රසායනය </a>
                </div>
                <br>

                <!-- Search documents form  -->
                <div class="classList mod-tute">
                    <h2> Search Video </h2>
                    <div class="classListBack">
                        <form method="post">
                            <p>
                                Title
                                <br>
                                <input type="text" name="searchID" value="<?php echo $search; ?>" placeholder="Title">
                            </p>
                            <br>
                            <p>
                                <button type="submit" name="search"> Search </button>
                            </p>
                        </form>
                    </div>
                </div>

                <?php
                // video fetch 
                if (mysqli_num_rows($video_result) > 0) {
                    while ($video_image = mysqli_fetch_assoc($video_result)) {
                        echo "<div class='event-details' style='transform: translateY(-50px);'>
        <div class='eventIMG'>
            {$video_image['Link']}
        </div>
        <div class='event-discription'>
        <h2> {$video_image['Title']} </h2>
            <p> {$video_image['Description']} </p>
        </div>
    </div>
    <br>";
                    }
                } else {
                    echo "<h2> no videos </h2>
        <a href='index' style='text-decoration: underline;'> Go back </a>";
                }
                ?>
            </div>
            <?php
            include "includes/footer.php";
            ?>
            <div class="space2"></div>
            <div class="space2"></div>
            <div class="space2"></div>
        </div>

        <?php
        // bottom navigation bar
        include('includes/bottomNav2.php');
        ?>

        <script src="assect/js/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.cycle2/2.1.6/jquery.cycle2.min.js"></script>
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
        <script src="assect/js/viewjs.js"></script>
        <script src="https://unpkg.com/boxicons@2.1.3/dist/boxicons.js"></script>
        <script>
            var loader = document.getElementById("loader");
            window.addEventListener("load", function() {
                loader.style.display = "none";
            });
        </script>
</body>

</html>