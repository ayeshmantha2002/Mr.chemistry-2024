<?php
include("includes/connection.php");

if (!isset($_SESSION['ID'])) {
    header("location: index");
} else {
    $user_verification = "SELECT * FROM tbl_register WHERE ID = {$_SESSION['ID']}";
    $user_verification_result = mysqli_query($connection, $user_verification);
    if (mysqli_num_rows($user_verification_result) == 1) {
        $details = mysqli_fetch_assoc($user_verification_result);
        $user_status = $details['Confirm_user'];
        if ($user_status != 1) {
            header("location: index");
        }
    } else {
        header("location: index");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mr.ChemistrY - Video Classes</title>
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
            <div class="eventAlin">
                <h2> Video Classes </h2>
                <p>Mr.ChemistrY - <span style='font-family: "Noto Sans Sinhala"; font-weight: bold;'> වෙනස්ම රහකට </span> ChemistrY </p>
                <div class="eventContent">

                    <div class="classListBack">
                        <a href="videos.php?catagory=video&vd=1">පරමාණුක ව්‍යූහය</a>
                        <a href="videos.php?catagory=video&vd=2">රසායනික ගණනය</a>
                        <a href="videos.php?catagory=video&vd=3">වායු</a>
                        <a href="videos.php?catagory=video&vd=4"> ශක්ති විද්‍යාව</a>
                        <a href="videos.php?catagory=video&vd=5">Inorganic</a>
                        <a href="videos.php?catagory=video&vd=6">Organic</a>
                        <a href="videos.php?catagory=video&vd=7"> සමතුලිතතාවය</a>
                        <a href="videos.php?catagory=video&vd=8"> කර්මාන්ත </a>
                        <a href="videos.php?catagory=video&vd=9"> පරිසරය</a>
                        <a href="videos.php?catagory=video&vd=10"> විද්‍යුත් රසායනය </a>
                        <a id="fb" href="#">පන්ති පිළිබද විස්තර සහ නවතම තොරතුරු දැනුවත් වීම සදහා Facebook සමුහයට එක්වන්න.</a>
                    </div>

                    <br>

                    <div class='event-details'>
                        <div class='eventIMG'>
                            <iframe src='https://www.youtube.com/embed/h1F-nWZQENI?si=seNe7Na5oCVSwueM&amp;controls=0' title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share' allowfullscreen></iframe>
                        </div>
                        <div class='event-discription'>
                            <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo exercitationem recusandae dolores. Magni, repudiandae, architecto recusandae odio molestias quibusdam ab dolorem laboriosam facere qui voluptate maiores aut a eaque ipsam. </p>
                        </div>
                    </div>
                    <br>

                    <div class='event-details'>
                        <div class='eventIMG'>
                            <iframe src='https://www.youtube.com/embed/dbTLuhI_Qwg?si=5C0azXyOHA9lgD96&amp;controls=0' title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share' allowfullscreen></iframe>
                        </div>
                        <div class='event-discription'>
                            <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo exercitationem recusandae dolores. Magni, repudiandae, architecto recusandae odio molestias quibusdam ab dolorem laboriosam facere qui voluptate maiores aut a eaque ipsam.
                            </p>
                        </div>
                    </div>
                    <br>
                </div>
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