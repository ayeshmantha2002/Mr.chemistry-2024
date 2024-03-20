<?php
// securuty
include "../../includes/connection.php";
if (isset($_SESSION['ID'])) {
    if ($_SESSION['ID'] >= 4) {
        header("location: ../../index");
    }
} else {
    header("location: ../../index");
}

// result list
if (isset($_POST['search'])) {
    $IDorNAME = $_POST['search'];
    $result_list = "SELECT * FROM al_result WHERE (`User_ID` LIKE '%{$IDorNAME}%' OR `Name` LIKE '%{$IDorNAME}%')";
} else {
    $result_list = "SELECT * FROM al_result ORDER BY chemisty_Result";
}
$result_list_result = mysqli_query($connection, $result_list);

//delete result
if (isset($_GET['delete_ID'])) {
    $deleteID = mysqli_real_escape_string($connection, $_GET['delete_ID']);

    $delete = "DELETE FROM al_result WHERE ID = {$deleteID}";
    $delete_result = mysqli_query($connection, $delete);

    if ($delete_result) {
        header("location: result-set.php?insert=done");
    }
}

//delete all result
if (isset($_GET['all_delete'])) {
    $deleteID = mysqli_real_escape_string($connection, $_GET['all_delete']);

    $delete = "DELETE FROM al_result WHERE `Status` = {$deleteID}";
    $delete_result = mysqli_query($connection, $delete);

    if ($delete_result) {
        header("location: result-set.php?insert=done");
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result set</title>
    <link rel="stylesheet" href="../../assect/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="area">
        <div class="area-aline">
            <header>
                <nav>
                    <a href="al-result.php" onclick='loadinEffect()'> <i class="fa-solid fa-angle-left"></i> </a>
                    <h2> Result List </h2>
                </nav>
            </header>
            <br><br><br><br><br>

            <!-- search student form -->
            <form method="post" action="result-set.php">
                <h2> Search User </h2>
                <p> Name or User ID : <br>
                    <input type="search" name="search" placeholder="Name or User ID" required>
                </p>
                <p>
                    <button type="submit"> Search User </button>
                </p>
            </form>

            <br>
            <hr>
            <br>

            <!-- result list  -->
            <table>
                <thead>
                    <tr>
                        <th colspan="6">ALL CLEAR :- <a href="result-set.php?all_delete=1" onclick='loadinEffect()'>Click here</a></th>
                    </tr>
                    <tr>
                        <th> ID </th>
                        <th> Name </th>
                        <th colspan="3"> Result </th>
                        <th> Delete </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result_list_result) {
                        if (mysqli_num_rows($result_list_result) > 0) {
                            while ($data = mysqli_fetch_assoc($result_list_result)) {
                                echo "<tr>
                                <td> {$data['User_ID']} </td>
                                <td> {$data['Name']} </td>
                                <td> <b>{$data['chemisty_Result']}</b> </td>
                                <td> {$data['combinde_Result']} </td>
                                <td> {$data['physics_Result']} </td>
                                <td> <a href='result-set.php?delete_ID={$data['ID']}'>Delete</a> </td>
                            </tr>";
                            }
                        }
                    }
                    ?>
                </tbody>
            </table>
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
                <p> <a href="result-set.php"> OK </a> </p>
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
                <p> <a href='result-set.php'> OK </a> </p>
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