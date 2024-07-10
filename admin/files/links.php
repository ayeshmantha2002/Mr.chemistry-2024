<?php
include "../../includes/connection.php";
if (isset($_SESSION['ID'])) {
    if ($_SESSION['ID'] >= 2) {
        header("location: ../../index");
    }
} else {
    header("location: ../../index");
}

if (isset($_GET['manage'])) {
    $manageID = mysqli_real_escape_string($connection, $_GET['manage']);
    $display = "flex";

    $links = "SELECT * FROM `links` WHERE `ID` = {$manageID}";
    $links_result = mysqli_query($connection, $links);
    if (mysqli_num_rows($links_result) == 1) {
        $fetch_link = mysqli_fetch_assoc($links_result);
        $ID = $fetch_link['ID'];
        $Class = $fetch_link['Class'];
        $Catagory = $fetch_link['Catagory'];
        $Link = $fetch_link['Link'];
    } else {
        $ID = "";
        $Class = "";
        $Catagory = "";
        $Link = "";
    }

    if ($manageID == 5) {
        $display_fb = "block";
        $display_nonefb = "none";
    } else {
        $display_fb = "none";
        $display_nonefb = "block";
    }
} else {
    $ID = "";
    $Class = "";
    $Catagory = "";
    $Link = "";
    $display = "none";
}

if (isset($_POST['up_link'])) {
    $up_ID = mysqli_real_escape_string($connection, $_POST['ID']);
    $up_class = mysqli_real_escape_string($connection, $_POST['Class']);
    $up_cat = mysqli_real_escape_string($connection, $_POST['Catagory']);
    $up_link = mysqli_real_escape_string($connection, $_POST['Link']);

    $update_wa = "UPDATE `links` SET `Class` = {$up_class}, `Catagory` = '{$up_cat}', `Link` = '{$up_link}' WHERE `ID` = {$up_ID}";
    $update_wa_result = mysqli_query($connection, $update_wa);
    if ($update_wa_result) {
        header("location: links.php?insert=done");
    }
}

if (isset($_POST['up_fb_link'])) {
    $up_ID = mysqli_real_escape_string($connection, $_POST['ID']);
    $up_link = mysqli_real_escape_string($connection, $_POST['Link']);

    $update_wa = "UPDATE `links` SET `Link` = '{$up_link}' WHERE `ID` = {$up_ID}";
    $update_wa_result = mysqli_query($connection, $update_wa);
    if ($update_wa_result) {
        header("location: links.php?insert=done");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Link management</title>
    <link rel="stylesheet" href="../../assect/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        :root {
            --text-blue: #00a088;
            --main-tow: #00e7c4;
            --text-color: #fff;
            --header: white;
            --banner-outlin: #fff;
            --line-out: darkgray;
            --shadow: #00000030;
            --background-color: #e6e6e6;
            --glass: #ffffff33;
            --glass-out: #ffffff66;
            --dark: black;
        }

        .buttons_aling {
            width: 100%;
            padding: 15px;
            box-sizing: border-box;
        }

        .buttons_aling_btn {
            width: 100%;
            max-width: 500px;
            margin: auto;
        }

        .buttons_aling_btn button {
            position: relative;
            width: 100%;
            padding: 20px;
            box-sizing: border-box;
            background-color: var(--text-blue);
            font-weight: bold;
            border: none;
            outline: none;
            border-radius: 5px;
            transition: 0.3s;
        }

        .buttons_aling_btn button a {
            position: absolute;
            width: 100%;
            top: 0;
            left: 0;
            padding: 10px;
            box-sizing: border-box;
            color: var(--text-color);
            font-weight: bold;
        }

        .buttons_aling_btn button:hover {
            background-color: var(--main-tow);
        }

        .edit_links_form {
            width: 100%;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            backdrop-filter: blur(10px);
            background-color: var(--shadow);
            z-index: 2;
            padding: 15px;
            box-sizing: border-box;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .edit_links_form form {
            width: 100%;
            max-width: 600px;
            padding: 10px;
            box-sizing: border-box;
            background-color: var(--banner-outlin);
            box-shadow: 0 0 10px var(--shadow);
            position: relative;
        }

        .x {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .x i {
            font-size: 25px;
        }
    </style>
</head>

<body>
    <div class="area">
        <div class="area-aline">
            <header>
                <nav>
                    <a href="../admin.php" onclick='loadinEffect()'> <i class="fa-solid fa-angle-left"></i> </a>
                    <h2> Link Management </h2>
                </nav>
            </header>
            <br><br><br><br><br>
            <section class="buttons_aling">
                <div class="buttons_aling_btn">
                    <p>
                        <label> WhatsApp Group One : </label>
                        <button> <a href="links.php?manage=1" onclick='loadinEffect()'>Button One</a> </button>
                    </p>
                    <br>
                    <p>
                        <label> WhatsApp Group Tow : </label>
                        <button> <a href="links.php?manage=2" onclick='loadinEffect()'>Button Tow</a> </button>
                    </p>
                    <br>
                    <p>
                        <label> WhatsApp Group Three : </label>
                        <button> <a href="links.php?manage=3" onclick='loadinEffect()'>Button Three</a> </button>
                    </p>
                    <br>
                    <p>
                        <label> WhatsApp Group Four : </label>
                        <button> <a href="links.php?manage=4" onclick='loadinEffect()'>Button Four</a> </button>
                    </p>
                    <br>
                    <p>
                        <label> Facebook Link : </label>
                        <button> <a href="links.php?manage=5" onclick='loadinEffect()'>Button Five</a> </button>
                    </p>
                </div>
                <br><br>

                <div class="edit_links_form" style="display: <?= $display; ?>;">
                    <form method="post" style="display: <?= $display_nonefb; ?>;">
                        <div class="x">
                            <a href="links.php"><i class="fa-solid fa-circle-xmark" style="color: #ff0000;"></i></a>
                        </div>
                        <p>
                            <input type="number" name="ID" value="<?= $ID; ?>" required hidden>
                        </p>
                        <p>
                            <label for="Class"> Class : </label>
                            <input type="number" id="Class" name="Class" value="<?= $Class; ?>" placeholder="Class Year" required min="2023">
                        </p>
                        <p>
                            <label for="Catagory"> Catagory : </label>
                            <input type="text" id="Catagory" name="Catagory" value="<?= $Catagory; ?>" placeholder="Class Catagory" required>
                        </p>
                        <p>
                            <label for="Link"> Link : </label>
                            <input type="text" id="Link" name="Link" value="<?= $Link; ?>" placeholder="Link" required>
                        </p>
                        <p>
                            <input type="submit" value="Update" name="up_link">
                        </p>
                    </form>

                    <form method="post" style="display: <?= $display_fb; ?>;">
                        <div class="x">
                            <a href="links.php"><i class="fa-solid fa-circle-xmark" style="color: #ff0000;"></i></a>
                        </div>
                        <p>
                            <input type="number" name="ID" value="<?= $ID; ?>" required hidden>
                        </p>
                        <p>
                            <label for="Link"> Link : </label>
                            <input type="text" id="Link" name="Link" value="<?= $Link; ?>" placeholder="Link" required>
                        </p>
                        <p>
                            <input type="submit" value="Update" name="up_fb_link">
                        </p>
                    </form>
                </div>
            </section>
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
                <p> <a href="links.php"> OK </a> </p>
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
                <p> <a href='links.php'> OK </a> </p>
            </div>
        </div>";
        }
    }

    // already exists
    if (isset($_GET['insert'])) {
        if ($_GET['insert'] == "already-exists") {
            echo '<div class="done-message">
            <div class="done-message-center">
                <p> <i class="fa-solid fa-circle-xmark fa-bounce fa-2xl" style="color: #ff0000;"></i> </p>
                <h1> The report already exists </h1>
                <p> <a href="links.php"> OK </a> </p>
            </div>
        </div>';
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