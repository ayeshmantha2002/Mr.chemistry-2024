<?php
include "../../includes/connection.php";
if (isset($_SESSION['ID'])) {
    if ($_SESSION['ID'] >= 4) {
        header("location: ../../index");
    }
} else {
    header("location: ../../index");
}

// fetch papers 
$papers = "SELECT * FROM past_papers ORDER BY `Year`";
$papers_result = mysqli_query($connection, $papers);

// insert past paper 
if (isset($_POST['submit'])) {
    $Year = mysqli_real_escape_string($connection, $_POST['Year']);
    $Category = mysqli_real_escape_string($connection, $_POST['Category']);
    $Link = mysqli_real_escape_string($connection, $_POST['Link']);

    $insert_paper = "INSERT INTO past_papers (`Year`, `Type`, `Link`) VALUES ({$Year}, '{$Category}', '{$Link}')";
    $insert_paper_result = mysqli_query($connection, $insert_paper);

    if ($insert_paper_result) {
        header("location: past-paper.php?insert=done");
    }
}

// delete paper 
if (isset($_GET['delete'])) {
    $deleteID = mysqli_real_escape_string($connection, $_GET['delete']);

    $delete = "DELETE FROM past_papers WHERE ID = {$deleteID}";
    $delete_result = mysqli_query($connection, $delete);

    if ($delete_result) {
        header("location: past-paper.php?insert=done");
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Past Paper</title>
    <link rel="stylesheet" href="../../assect/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="area">
        <div class="area-aline">
            <header>
                <nav>
                    <a href="../admin.php" onclick='loadinEffect()'> <i class="fa-solid fa-angle-left"></i> </a>
                    <h2> Past Papers </h2>
                </nav>
            </header>
            <br><br><br><br><br>

            <!-- add new paper form  -->
            <form action="past-paper.php" method="post">
                <h2> Add a New Paper </h2>
                <p> Exam Year : <br>
                    <input type="number" name="Year" placeholder="Year" required min="2000">
                </p>
                <p> Select Category :<br>
                    <select name="Category" required>
                        <option value=""> Choose </option>
                        <option value="MCQ"> MCQ </option>
                        <option value="Essay"> Essay </option>
                        <option value="MCQ_M"> MCQ Marking </option>
                        <option value="Essay_M"> Essay Marking </option>
                    </select>
                </p>
                <p>
                    Link : <br>
                    <input type="text" name="Link" placeholder="Doc link" required>
                </p>
                <p><input type="submit" name="submit" value="Save"></p>
            </form>

            <!-- paper list  -->
            <ul>
                <?php
                if (mysqli_num_rows($papers_result) > 0) {
                    echo '<p style="text-align: center;"> Click & delete <i class="fa-solid fa-hand-point-down"></i> </p>';
                    while ($Marking_MCQ = mysqli_fetch_assoc($papers_result)) {
                        if ($Marking_MCQ['Type'] == "Essay_M") {
                            $type = "Essay Marking";
                        } elseif ($Marking_MCQ['Type'] == "MCQ_M") {
                            $type = "MCQ Marking";
                        } else {
                            $type = $Marking_MCQ['Type'];
                        }

                        echo "<a href='past-paper.php?delete={$Marking_MCQ['ID']}' onclick='loadinEffect()'><li><b>{$Marking_MCQ['Year']}</b> - {$type}</li></a>";
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
            echo '<div class="done-message">
            <div class="done-message-center">
                <p> <i class="fa-solid fa-circle-check fa-bounce fa-2xl"></i> </p>
                <h1> Done </h1>
                <p> <a href="past-paper.php"> OK </a> </p>
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
                <p> <a href='past-paper.php'> OK </a> </p>
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