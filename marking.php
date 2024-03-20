<?php
$search = "";
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
        } else {
            // filter Documents
            if (isset($_POST['search'])) {
                $searchID = mysqli_real_escape_string($connection, $_POST['searchID']);
                $search = $searchID;
                $modle_paper = "SELECT * FROM `modle_papers_&_tutes` WHERE (`Title` LIKE '%{$searchID}%' OR `File_name` LIKE '%{$searchID}%' OR `Date_Time` LIKE '%{$searchID}%') AND `Class` = {$_SESSION['Class']} AND `Category` = 3 AND `Status` = 1";
            } else {
                $modle_paper = "SELECT * FROM `modle_papers_&_tutes` WHERE `Class` IN(1 , {$_SESSION['Class']}) AND `Category` = 3 AND `Status` = 1";
            }
            $modle_paper_result = mysqli_query($connection, $modle_paper);
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
    <title>Mr.ChemistrY - Marking</title>
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
                    <h2> Class Mate Paper Markings </h2>
                    <p>Mr.ChemistrY - Chemistry <span style='font-family: "Noto Sans Sinhala"; font-weight: bold;'> වලට තවත් නමක් </span> </p>
                </div>
            </div>

            <!-- Search documents form  -->
            <div class="classList mod-tute">
                <h2> Search Document </h2>
                <div class="classListBack">
                    <form method="post">
                        <p>
                            <label> Title / file name or date </label>
                            <br>
                            <input type="text" name="searchID" value="<?php echo $search; ?>" placeholder="Title / file name or date">
                        </p>
                        <br>
                        <p>
                            <button type="submit" onclick='loadinEffect()' name="search">Search</button>
                        </p>
                    </form>
                </div>
            </div>


            <div class="notification">
                <?php
                if ($modle_paper_result) {
                    if (mysqli_num_rows($modle_paper_result) > 0) {
                        echo "<ul>";
                        $x = 0;
                        while ($document = mysqli_fetch_assoc($modle_paper_result)) {
                            $x = $x + 1;
                            $file_name = $document['File_name'];
                            $class = $document['Class'];
                            $title = $document['Title'];
                            $File_name = $document['File_name'];
                            $Date_Time = $document['Date_Time'];
                            $parth = "download/documents/file.php?doc=$file_name";
                            echo "<a href='$parth' target='_blank'>";
                            echo "<li>";
                            echo "<div>";
                            echo " <p style='color: #000;'> <span style='font-weight: bold; font-family: Poppins;'>Title : </span>{$title} </p> ";
                            echo " <p style='color: #000;'> <span style='font-weight: bold; font-family: Poppins;'>Class : </span>{$class} </p> ";
                            echo " <p style='color: #000;'> <span style='font-weight: bold; font-family: Poppins;'>File Name : </span>{$File_name} </p> ";
                            echo " <p style='color: #000;'> <span style='font-weight: bold; font-family: Poppins;'>Date : </span>{$Date_Time} </p> ";
                            echo "</div>";
                            echo "</li>";
                            echo "</a>";
                        }
                        echo '</ul>';
                    } else {
                        echo "<ul>";
                        echo "<a href='#'>";
                        echo "<li>";
                        echo "<div>";
                        echo " <h3 style='color: #000;'> Empty </h3> ";
                        echo "</div>";
                        echo "</li>";
                        echo "</a>";
                        echo '</ul>';
                    }
                    echo "<p style='text-align: center;'><a style=' color: var(--text-blue); text-decoration: underline;' href='modle-papers'> All Result </a></p>";
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
        function loadinEffect() {
            document.getElementById('loader').style.display = "block";
        }
    </script>
    <script>
        var loader = document.getElementById("loader");
        window.addEventListener("load", function() {
            loader.style.display = "none";
        });
    </script>
</body>

</html>