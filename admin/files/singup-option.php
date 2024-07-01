<?php
include "../../includes/connection.php";
if (isset($_SESSION['ID'])) {
    if ($_SESSION['ID'] >= 2) {
        header("location: ../../index");
    }
} else {
    header("location: ../../index");
}

// fetch class
$class = "SELECT * FROM class ORDER BY class";
$class_result = mysqli_query($connection, $class);

// insert new class
if (isset($_POST['submit'])) {

    if (!isset($_POST['Year']) || strlen(trim($_POST['Year'])) < 1) {
        echo "
        <script>
            document.getElementById('loader').style.display = 'none';
        </script>
        ";
    } else {

        $Year = mysqli_real_escape_string($connection, $_POST['Year']);

        $check_class = "SELECT * FROM class WHERE `class` = {$Year}";
        $check_class_result = mysqli_query($connection, $check_class);

        if ($check_class_result) {
            if (mysqli_num_rows($check_class_result) > 0) {
                header("location: singup-option.php?insert=already-exists");
            } else {
                $insert_class = "INSERT INTO class (`class`) VALUES ({$Year})";
                $insert_class_result = mysqli_query($connection, $insert_class);

                if ($insert_class_result) {
                    header("location: singup-option.php?insert=done");
                }
            }
        }
    }
}

// delete class
if (isset($_GET['delete'])) {
    $deleteID = mysqli_real_escape_string($connection, $_GET['delete']);

    $delete = "DELETE FROM class WHERE ID = {$deleteID}";
    $delete_result = mysqli_query($connection, $delete);

    if ($delete_result) {
        header("location: singup-option.php?insert=done");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sing Up - Option</title>
    <link rel="stylesheet" href="../../assect/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="area">
        <div class="area-aline">
            <header>
                <nav>
                    <a href="../admin.php" onclick='loadinEffect()'> <i class="fa-solid fa-angle-left"></i> </a>
                    <h2> SingUp Option </h2>
                </nav>
            </header>
            <br><br><br><br><br>

            <!-- add new class form  -->
            <form action="singup-option.php" method="post">
                <h2> Add a New Option </h2>
                <p> Class Year : <br>
                    <input type="number" name="Year" placeholder="Year" min="2024">
                </p>
                <p><input type="submit" name="submit" value="Save" onclick='loadinEffect()'></p>
            </form>
            <br>

            <!-- class list  -->
            <ul>
                <?php
                if (mysqli_num_rows($class_result) > 0) {
                    echo '<p style="text-align: center;"> Click & delete <i class="fa-solid fa-hand-point-down"></i> </p>';
                    while ($class_list = mysqli_fetch_assoc($class_result)) {
                        $ID = $class_list['ID'];
                        $Year = $class_list['class'];
                        echo "<a href='singup-option.php?delete={$ID}' onclick='loadinEffect()'>
                    <li>{$Year}</li>
                </a>";
                    }
                }
                ?>
            </ul>
            <br><br>
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
                <p> <a href="singup-option.php"> OK </a> </p>
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
                <p> <a href='singup-option.php'> OK </a> </p>
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
                <p> <a href="singup-option.php"> OK </a> </p>
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