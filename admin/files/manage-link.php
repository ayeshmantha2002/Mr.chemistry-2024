<?php
include "../../includes/connection.php";
if (isset($_SESSION['ID'])) {
    if ($_SESSION['ID'] >= 4) {
        header("location: ../../index");
    }
} else {
    header("location: ../../index");
}

$buttonOneone = "";
$buttonOnetow = "";
$buttonOnethree = "";
$buttonOnefour = "";
$buttonOnefive = "";
$buttonOnesix = "";
$buttonOneseven = "";

$buttonTowone = "";
$buttonTowtow = "";
$buttonTowthree = "";
$buttonTowfour = "";
$buttonTowfive = "";
$buttonTowsix = "";
$buttonTowseven = "";

$buttonThreeone = "";
$buttonThreetow = "";
$buttonThreethree = "";
$buttonThreefour = "";
$buttonThreefive = "";
$buttonThreesix = "";
$buttonThreeseven = "";

$buttonFourone = "";
$buttonFourtow = "";
$buttonFourthree = "";
$buttonFourfour = "";
$buttonFourfive = "";
$buttonFoursix = "";
$buttonFourseven = "";

$buttonOneTheory = "";
$buttonTowTheory = "";
$buttonThreeTheory = "";
$buttonFourTheory = "";

$buttonOneRevision = "";
$buttonTowRevision = "";
$buttonThreeRevision = "";
$buttonFourRevision = "";

// update button one
if (isset($_POST['buttonOne'])) {
    $updatebuttonOne = "UPDATE `links` SET `Class` = {$_POST['class']}, `Catagory` = '{$_POST['category']}', `Link` = '{$_POST['link']}' WHERE `links`.`ID` = 1";
    $updatebuttonOne_result = mysqli_query($connection, $updatebuttonOne);
    if ($updatebuttonOne_result) {
        header("location: manage-link.php?insert=done");
    }
}
// update button Tow
if (isset($_POST['buttonTow'])) {
    $updatebuttonTow = "UPDATE `links` SET `Class` = {$_POST['class']}, `Catagory` = '{$_POST['category']}', `Link` = '{$_POST['link']}' WHERE `links`.`ID` = 2";
    $updatebuttonTow_result = mysqli_query($connection, $updatebuttonTow);
    if ($updatebuttonTow_result) {
        header("location: manage-link.php?insert=done");
    }
}
// update button Three
if (isset($_POST['buttonThree'])) {
    $updatebuttonThree = "UPDATE `links` SET `Class` = {$_POST['class']}, `Catagory` = '{$_POST['category']}', `Link` = '{$_POST['link']}' WHERE `links`.`ID` = 3";
    $updatebuttonThree_result = mysqli_query($connection, $updatebuttonThree);
    if ($updatebuttonThree_result) {
        header("location: manage-link.php?insert=done");
    }
}
// update button Four
if (isset($_POST['buttonFour'])) {
    $updatebuttonFour = "UPDATE `links` SET `Class` = {$_POST['class']}, `Catagory` = '{$_POST['category']}', `Link` = '{$_POST['link']}' WHERE `links`.`ID` = 4";
    $updatebuttonFour_result = mysqli_query($connection, $updatebuttonFour);
    if ($updatebuttonFour_result) {
        header("location: manage-link.php?insert=done");
    }
}
// update button five
if (isset($_POST['buttonFive'])) {
    $updatebuttonFive = "UPDATE `links` SET `Link` = '{$_POST['link']}' WHERE `links`.`ID` = 5";
    $updatebuttonFive_result = mysqli_query($connection, $updatebuttonFive);
    if ($updatebuttonFive_result) {
        header("location: manage-link.php?insert=done");
    }
}

// first link
$buttonOne = "SELECT * FROM `links` WHERE ID = 1";
$buttonOne_Result = mysqli_query($connection, $buttonOne);

if (mysqli_num_rows($buttonOne_Result) == 1) {
    $buttonOne_fetch = mysqli_fetch_assoc($buttonOne_Result);
    $buttonOne_class = $buttonOne_fetch['Class'];
    $buttonOne_Link = $buttonOne_fetch['Link'];
    $buttonOne_Catagory = $buttonOne_fetch['Catagory'];

    if ($buttonOne_class == 2024) {
        $buttonOneone = "selected";
    } elseif ($buttonOne_class == 2025) {
        $buttonOnetow = "selected";
    } elseif ($buttonOne_class == 2026) {
        $buttonOnethree = "selected";
    } elseif ($buttonOne_class == 2027) {
        $buttonOnefour = "selected";
    } elseif ($buttonOne_class == 2028) {
        $buttonOnefive = "selected";
    } elseif ($buttonOne_class == 2029) {
        $buttonOnesix = "selected";
    } elseif ($buttonOne_class == 2030) {
        $buttonOneseven = "selected";
    }

    if ($buttonOne_Catagory == "Theory") {
        $buttonOneTheory = "selected";
    } elseif ($buttonOne_Catagory == "Revision") {
        $buttonOneRevision = "selected";
    }
}

// Second link
$buttonTow = "SELECT * FROM `links` WHERE ID = 2";
$buttonTow_Result = mysqli_query($connection, $buttonTow);

if (mysqli_num_rows($buttonTow_Result) == 1) {
    $buttonTow_fetch = mysqli_fetch_assoc($buttonTow_Result);
    $buttonTow_class = $buttonTow_fetch['Class'];
    $buttonTow_Link = $buttonTow_fetch['Link'];
    $buttonTow_Catagory = $buttonTow_fetch['Catagory'];

    if ($buttonTow_class == 2024) {
        $buttonTowone = "selected";
    } elseif ($buttonTow_class == 2025) {
        $buttonTowtow = "selected";
    } elseif ($buttonTow_class == 2026) {
        $buttonTowthree = "selected";
    } elseif ($buttonTow_class == 2027) {
        $buttonTowfour = "selected";
    } elseif ($buttonTow_class == 2028) {
        $buttonTowfive = "selected";
    } elseif ($buttonTow_class == 2029) {
        $buttonTowsix = "selected";
    } elseif ($buttonTow_class == 2030) {
        $buttonTowseven = "selected";
    }

    if ($buttonTow_Catagory == "Theory") {
        $buttonTowTheory = "selected";
    } elseif ($buttonTow_Catagory == "Revision") {
        $buttonTowRevision = "selected";
    }
}

// Three link
$buttonThree = "SELECT * FROM `links` WHERE ID = 3";
$buttonThree_Result = mysqli_query($connection, $buttonThree);

if (mysqli_num_rows($buttonThree_Result) == 1) {
    $buttonThree_fetch = mysqli_fetch_assoc($buttonThree_Result);
    $buttonThree_class = $buttonThree_fetch['Class'];
    $buttonThree_Link = $buttonThree_fetch['Link'];
    $buttonThree_Catagory = $buttonThree_fetch['Catagory'];

    if ($buttonThree_class == 2024) {
        $buttonThreeone = "selected";
    } elseif ($buttonThree_class == 2025) {
        $buttonThreetow = "selected";
    } elseif ($buttonThree_class == 2026) {
        $buttonThreethree = "selected";
    } elseif ($buttonThree_class == 2027) {
        $buttonThreefour = "selected";
    } elseif ($buttonThree_class == 2028) {
        $buttonThreefive = "selected";
    } elseif ($buttonThree_class == 2029) {
        $buttonThreesix = "selected";
    } elseif ($buttonThree_class == 2030) {
        $buttonThreeseven = "selected";
    }

    if ($buttonThree_Catagory == "Theory") {
        $buttonThreeTheory = "selected";
    } elseif ($buttonThree_Catagory == "Revision") {
        $buttonThreeRevision = "selected";
    }
}

// Fourth link
$buttonFour = "SELECT * FROM `links` WHERE ID = 4";
$buttonFour_Result = mysqli_query($connection, $buttonFour);

if (mysqli_num_rows($buttonFour_Result) == 1) {
    $buttonFour_fetch = mysqli_fetch_assoc($buttonFour_Result);
    $buttonFour_class = $buttonFour_fetch['Class'];
    $buttonFour_Link = $buttonFour_fetch['Link'];
    $buttonFour_Catagory = $buttonFour_fetch['Catagory'];

    if ($buttonFour_class == 2024) {
        $buttonFourone = "selected";
    } elseif ($buttonFour_class == 2025) {
        $buttonFourtow = "selected";
    } elseif ($buttonFour_class == 2026) {
        $buttonFourthree = "selected";
    } elseif ($buttonFour_class == 2027) {
        $buttonFourfour = "selected";
    } elseif ($buttonFour_class == 2028) {
        $buttonFourfive = "selected";
    } elseif ($buttonFour_class == 2029) {
        $buttonFoursix = "selected";
    } elseif ($buttonFour_class == 2030) {
        $buttonFourseven = "selected";
    }

    if ($buttonFour_Catagory == "Theory") {
        $buttonFourTheory = "selected";
    } elseif ($buttonFour_Catagory == "Revision") {
        $buttonFourRevision = "selected";
    }
}

// first link
$buttonFive = "SELECT * FROM `links` WHERE ID = 5";
$buttonFive_Result = mysqli_query($connection, $buttonFive);

if (mysqli_num_rows($buttonFive_Result) == 1) {
    $buttonFive_fetch = mysqli_fetch_assoc($buttonFive_Result);
    $buttonFive_Link = $buttonFive_fetch['Link'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Links</title>
    <link rel="stylesheet" href="../../assect/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="area">
        <div class="area-aline">
            <header>
                <nav>
                    <a onclick="loadinEffect()" href="../admin.php">
                        <i class="fa-solid fa-angle-left"></i>
                    </a>
                    <h2> Manage Links </h2>
                </nav>
            </header>
            <br><br><br><br>

            <!-- whatsapp links  -->
            <form method="post">
                <h2> Button One </h2>
                <p> Choose Class :
                    <select name="class">
                        <option value="2024" <?php echo $buttonOneone; ?>> 2024 </option>
                        <option value="2025" <?php echo $buttonOnetow; ?>> 2025 </option>
                        <option value="2026" <?php echo $buttonOnethree; ?>> 2026 </option>
                        <option value="2027" <?php echo $buttonOnefour; ?>> 2027 </option>
                        <option value="2028" <?php echo $buttonOnefive; ?>> 2028 </option>
                        <option value="2029" <?php echo $buttonOnesix; ?>> 2029 </option>
                        <option value="2030" <?php echo $buttonOneseven; ?>> 2030 </option>
                    </select>
                </p>
                <p> Choose Category :
                    <select name="category">
                        <option value=""> Choose Category </option>
                        <option value="Theory" <?php echo $buttonOneTheory; ?>> Theory </option>
                        <option value="Revision" <?php echo $buttonOneRevision; ?>> Revision </option>
                    </select>
                </p>
                <p><input name="link" required type="text" placeholder="Link" value="<?php echo $buttonOne_Link; ?>"></p>
                <p> <button type="submit" onclick="loadinEffect()" name="buttonOne"> Update </button> </p>
            </form>
            <form method="post">
                <h2> Button Tow </h2>
                <p> Choose Class :
                    <select name="class">
                        <option value="2024" <?php echo $buttonTowone; ?>> 2024 </option>
                        <option value="2025" <?php echo $buttonTowtow; ?>> 2025 </option>
                        <option value="2026" <?php echo $buttonTowthree; ?>> 2026 </option>
                        <option value="2027" <?php echo $buttonTowfour; ?>> 2027 </option>
                        <option value="2028" <?php echo $buttonTowfive; ?>> 2028 </option>
                        <option value="2029" <?php echo $buttonTowsix; ?>> 2029 </option>
                        <option value="2030" <?php echo $buttonTowseven; ?>> 2030 </option>
                    </select>
                </p>
                <p> Choose Category :
                    <select name="category">
                        <option value=""> Choose Category </option>
                        <option value="Theory" <?php echo $buttonTowTheory; ?>> Theory </option>
                        <option value="Revision" <?php echo $buttonTowRevision; ?>> Revision </option>
                    </select>
                </p>
                <p><input name="link" required type="text" placeholder="Link" value="<?php echo $buttonTow_Link; ?>"></p>
                <p> <button type="submit" onclick="loadinEffect()" name="buttonTow"> Update </button> </p>
            </form>
            <form method="post">
                <h2> Button Three </h2>
                <p> Choose Class :
                    <select name="class">
                        <option value="2024" <?php echo $buttonThreeone; ?>> 2024 </option>
                        <option value="2025" <?php echo $buttonThreetow; ?>> 2025 </option>
                        <option value="2026" <?php echo $buttonThreethree; ?>> 2026 </option>
                        <option value="2027" <?php echo $buttonThreefour; ?>> 2027 </option>
                        <option value="2028" <?php echo $buttonThreefive; ?>> 2028 </option>
                        <option value="2029" <?php echo $buttonThreesix; ?>> 2029 </option>
                        <option value="2030" <?php echo $buttonThreeseven; ?>> 2030 </option>
                    </select>
                </p>
                <p> Choose Category :
                    <select name="category">
                        <option value=""> Choose Category </option>
                        <option value="Theory" <?php echo $buttonThreeTheory; ?>> Theory </option>
                        <option value="Revision" <?php echo $buttonThreeRevision; ?>> Revision </option>
                    </select>
                </p>
                <p><input name="link" required type="text" placeholder="Link" value="<?php echo $buttonThree_Link; ?>"></p>
                <p> <button type="submit" onclick="loadinEffect()" name="buttonThree"> Update </button> </p>
            </form>
            <form method="post">
                <h2> Button Four </h2>
                <p> Choose Class :
                    <select name="class">
                        <option value="2024" <?php echo $buttonFourone; ?>> 2024 </option>
                        <option value="2025" <?php echo $buttonFourtow; ?>> 2025 </option>
                        <option value="2026" <?php echo $buttonFourthree; ?>> 2026 </option>
                        <option value="2027" <?php echo $buttonFourfour; ?>> 2027 </option>
                        <option value="2028" <?php echo $buttonFourfive; ?>> 2028 </option>
                        <option value="2029" <?php echo $buttonFoursix; ?>> 2029 </option>
                        <option value="2030" <?php echo $buttonFourseven; ?>> 2030 </option>
                    </select>
                </p>
                <p> Choose Category :
                    <select name="category">
                        <option value=""> Choose Category </option>
                        <option value="Theory" <?php echo $buttonFourTheory; ?>> Theory </option>
                        <option value="Revision" <?php echo $buttonFourRevision; ?>> Revision </option>
                    </select>
                </p>
                <p><input name="link" required type="text" placeholder="Link" value="<?php echo $buttonFour_Link; ?>"></p>
                <p> <button type="submit" onclick="loadinEffect()" name="buttonFour"> Update </button> </p>
            </form>

            <!-- facebook link  -->
            <form method="post">
                <h2> Button Five </h2>
                <p> Facebook Link :
                    <input name="link" required type="text" placeholder="Link" value="<?php echo $buttonFive_Link; ?>">
                </p>
                <p> <button type="submit" onclick="loadinEffect()" name="buttonFive"> Update </button> </p>
            </form>
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
                <p> <a href="manage-link.php"> OK </a> </p>
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
                <p> <a href='manage-link.php'> OK </a> </p>
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