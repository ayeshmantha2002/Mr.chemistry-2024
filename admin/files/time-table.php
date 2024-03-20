<?php
include "../../includes/connection.php";
if (isset($_SESSION['ID'])) {
    if ($_SESSION['ID'] >= 4) {
        header("location: ../../index");
    }
} else {
    header("location: ../../index");
}

// time table list
$time_table = "SELECT * FROM time_table";
$time_table_result = mysqli_query($connection, $time_table);

// insert time table
if (isset($_POST['submit'])) {

    if (!isset($_POST['Year']) || strlen(trim($_POST['Year'])) < 1) {
        header("location: time-table.php?insert=error");
    } elseif (!isset($_POST['Category']) || strlen(trim($_POST['Category'])) < 1) {
        header("location: time-table.php?insert=error");
    } elseif (!isset($_POST['Time']) || strlen(trim($_POST['Time'])) < 1) {
        header("location: time-table.php?insert=error");
    } else {

        $Year = mysqli_real_escape_string($connection, $_POST['Year']);
        $Category = mysqli_real_escape_string($connection, $_POST['Category']);
        $Time = mysqli_real_escape_string($connection, $_POST['Time']);

        $insert_time = "INSERT INTO time_table (`Year`, `Category`, `Time`) VALUES ({$Year}, '{$Category}', '{$Time}')";
        $insert_time_result = mysqli_query($connection, $insert_time);

        if ($insert_time_result) {
            header("location: time-table.php?insert=done");
        }
    }
}

// delete time table recordes
if (isset($_GET['delete'])) {
    $deleteID = mysqli_real_escape_string($connection, $_GET['delete']);

    $delete = "DELETE FROM time_table WHERE ID = {$deleteID}";
    $delete_result = mysqli_query($connection, $delete);

    if ($delete_result) {
        header("location: time-table.php?insert=done");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Time-Table</title>
    <link rel="stylesheet" href="../../assect/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="area">
        <div class="area-aline">
            <header>
                <nav>
                    <a href="../admin.php" onclick='loadinEffect()'> <i class="fa-solid fa-angle-left"></i> </a>
                    <h2> Time Table </h2>
                </nav>
            </header>
            <br><br><br><br><br>

            <!-- add times form  -->
            <form action="time-table.php" method="post">
                <h2> Add a New Option </h2>
                <p> Class Year : <br>
                    <input type="number" name="Year" placeholder="Year" min="2024">
                </p>
                <p> Select Class Category :<br>
                    <select name="Category">
                        <option value=""> Choose </option>
                        <option value="THEORY"> THEORY </option>
                        <option value="REVISION"> REVISION </option>
                        <option value="THEORY REVISION"> THEORY REVISION </option>
                    </select>
                </p>
                <p>
                    time and date : <br>
                    <input type="text" name="Time" placeholder="Time & Date">
                </p>
                <p><input type="submit" name="submit" value="Save" onclick='loadinEffect()'></p>
            </form>
            <br>

            <!-- time table  -->
            <ul>
                <?php
                if (mysqli_num_rows($time_table_result) > 0) {
                    echo '<p style="text-align: center;"> Click & delete <i class="fa-solid fa-hand-point-down"></i> </p>';
                    while ($time_list = mysqli_fetch_assoc($time_table_result)) {
                        $ID = $time_list['ID'];
                        $Year = $time_list['Year'];
                        $Category = $time_list['Category'];
                        $Time = $time_list['Time'];
                        echo "<a href='time-table.php?delete={$ID}' onclick='loadinEffect()'>
                    <li>{$Year} {$Category} - [ {$Time} ]</li>
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
                <p> <a href="time-table.php"> OK </a> </p>
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
                <p> <a href='time-table.php'> OK </a> </p>
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