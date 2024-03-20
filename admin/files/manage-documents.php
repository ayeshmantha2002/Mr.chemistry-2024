<?php
include "../../includes/connection.php";
if (isset($_SESSION['ID'])) {
    if ($_SESSION['ID'] >= 3) {
        header("location: ../../index");
    }
} else {
    header("location: ../../index");
}

if (isset($_GET['class'])) {
    $class = mysqli_real_escape_string($connection, $_GET['class']);
    setcookie('Class', $class, time() + 60 * 60 * 24);
} elseif (isset($_GET['Category'])) {
    $CategoryCoo = mysqli_real_escape_string($connection, $_GET['Category']);
    setcookie('Category', $CategoryCoo, time() + 60 * 60 * 24);
} else {
    setcookie('Class', NULL, -time() + 60 * 60 * 24);
    setcookie('Category', NULL, time() + 60 * 60 * 24);
}

// documents list
$doduments_list = "SELECT * FROM `modle_papers_&_tutes`";
if (isset($_GET['class'])) {
    $cl = mysqli_real_escape_string($connection, $_GET['class']);
    if (isset($_COOKIE['Category'])) {
        $doduments_list = "SELECT * FROM `modle_papers_&_tutes` WHERE `Class` = {$cl} AND `Category` = {$_COOKIE['Category']}";
    } else {
        $doduments_list = "SELECT * FROM `modle_papers_&_tutes` WHERE `Class` = {$cl}";
    }
} elseif (isset($_GET['Category'])) {
    $cat = mysqli_real_escape_string($connection, $_GET['Category']);
    $doduments_list = "SELECT * FROM `modle_papers_&_tutes` WHERE `Category` = {$cat}";
}

if (isset($_POST['search'])) {
    if (!isset($_POST['studentID']) || strlen(trim($_POST['studentID'])) < 1) {
        echo '<script>
            document.getElementById("loader").style.display = "none";
        </script>';
    } else {
        $studentID = mysqli_real_escape_string($connection, $_POST['studentID']);

        // search document list
        $doduments_list = "SELECT * FROM `modle_papers_&_tutes` WHERE (`ID` LIKE '%{$studentID}%' OR `Title` LIKE '%{$studentID}%' OR `File_name` LIKE '%{$studentID}%')";
    }
}
$documents_result = mysqli_query($connection, $doduments_list);

// Add document process
if (isset($_POST['add'])) {

    $fileName = $_FILES['pdf_file']['name'];
    $fileTemp = $_FILES['pdf_file']['tmp_name'];
    $fileSize = $_FILES['pdf_file']['size'];
    $fileType = $_FILES['pdf_file']['type'];

    if (!isset($_FILES['pdf_file']['name']) || strlen(trim($_FILES['pdf_file']['name'])) < 1) {
        header("location: manage-documents.php?insert=error");
    } elseif (!isset($_POST['name']) || strlen(trim($_POST['name'])) < 1) {
        header("location: manage-documents.php?insert=error");
    } elseif (!isset($_POST['category']) || strlen(trim($_POST['category'])) < 1) {
        header("location: manage-documents.php?insert=error");
    } elseif (!isset($_POST['class']) || strlen(trim($_POST['class'])) < 1) {
        header("location: manage-documents.php?insert=error");
    } else {
        $name = mysqli_real_escape_string($connection, $_POST['name']);
        $name = mysqli_real_escape_string($connection, $_POST['name']);
        $category = mysqli_real_escape_string($connection, $_POST['category']);
        $class = mysqli_real_escape_string($connection, $_POST['class']);
        $upload_to = "../docs/";

        $add_docs = "INSERT INTO `modle_papers_&_tutes` (`Title`, `File_name`, `Category`, `Class`, `Status`) VALUE ('{$name}', '{$fileName}', {$category}, {$class}, 1)";
        $add_docs_result = mysqli_query($connection, $add_docs);
        if ($add_docs_result) {
            $uploadDocuments = move_uploaded_file($fileTemp, $upload_to . $fileName);

            if ($uploadDocuments) {
                header("location: manage-documents.php?insert=done");
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Documents</title>
    <link rel="stylesheet" href="../../assect/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <!-- main area  -->
    <div class="area">
        <div class="area-aline">
            <header>
                <nav>
                    <a href="../admin.php" onclick='loadinEffect()'> <i class="fa-solid fa-angle-left"></i> </a>
                    <h2> Manage Documents </h2>
                </nav>
            </header>
            <br><br><br><br>

            <!-- links buttons -->
            <div class="four-buttons">
                <a onclick='loadinEffect()' href="manage-documents.php">All Docs</a>
                <?php
                // latest class list
                $class_list1 = "SELECT * FROM class ORDER BY Class";
                $class_list_result1 = mysqli_query($connection, $class_list1);
                if (mysqli_num_rows($class_list_result1) > 0) {
                    while ($class1 = mysqli_fetch_assoc($class_list_result1)) {
                        echo "<a href='manage-documents.php?class={$class1['class']}' onclick='loadinEffect()'>{$class1['class']}</a>";
                    }
                }
                ?>
                <a onclick='loadinEffect()' href="manage-documents.php?Category=1">Model Papers</a>
                <a onclick='loadinEffect()' href="manage-documents.php?Category=2">Tutes</a>
            </div>
            <div class="full">
                <a id="add-btn" href="#add-docs"> Add Documents </a>
            </div>

            <!-- students search form -->
            <form action="manage-documents.php" method="post">
                <h2> Search Documents </h2>
                <p>
                    Document id or Dodument name : <br>
                    <input name="studentID" placeholder="Document id or Dodument name">
                </p>
                <p><button type="submit" name="search" onclick='loadinEffect()'> Search </button></p>
            </form>

            <!-- Add documents form  -->
            <form id="add-docs" action="manage-documents.php" enctype="multipart/form-data" method="post">
                <h2> Add Documents </h2>
                <p>
                    Dodument name / Title : <br>
                    <input name="name" placeholder="Title">
                </p>

                <p>
                    Category : <br>
                    <select name="category">
                        <option value="">Choose</option>
                        <option value="1">Modle Paper</option>
                        <option value="2">Tute</option>
                    </select>
                </p>
                <p>
                    Class : <br>
                    <select name="class">
                        <option value="">Select a class</option>
                        <?php
                        // class fetch
                        $class = "SELECT * FROM class ORDER BY class";
                        $class_Result = mysqli_query($connection, $class);
                        if ($class_Result) {
                            if (mysqli_num_rows($class_Result) > 0) {
                                while ($class_fetch = mysqli_fetch_assoc($class_Result)) {
                                    $class_value = $class_fetch['class'];
                                    echo "<option value='{$class_value}'>{$class_value}</option>";
                                }
                            }
                        }
                        ?>
                    </select>
                </p>
                <p>
                    Choose File : <br>
                    <input type="file" name="pdf_file">
                </p>
                <p><button type="submit" name="add" onclick='loadinEffect()'> Add Documents </button></p>
            </form>
            <br>
            <ul>
                <?php
                if ($documents_result) {
                    if (mysqli_num_rows($documents_result) > 0) {
                        while ($docs = mysqli_fetch_assoc($documents_result)) {
                            $doc_id = $docs['ID'];
                            $doc_title = $docs['Title'];
                            $doc_file_name = $docs['File_name'];
                            $doc_class = $docs['Class'];
                            $doc_cat = $docs['Category'];

                            if ($doc_cat == 1) {
                                $DOC_CAT = "Modle Paper";
                            } elseif ($doc_cat == 2) {
                                $DOC_CAT = "Tutes";
                            }

                            echo "<a href='docs-manage.php?doc={$doc_id}' onclick='loadinEffect()'>
                            <li style='position: relative;'>
                                <div>
                                    <p><b>Class : </b>{$doc_class} <br> <b>Title : </b>{$doc_title} <br> <b>Type : </b>{$DOC_CAT}</p>
                                </div>
                            </li>
                        </a>";
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
                <p> <a href='manage-documents.php'> OK </a> </p>
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
                <p> <a href='manage-documents.php'> OK </a> </p>
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
        function loadinEffect() {
            document.getElementById('loader').style.display = "flex";
        }
    </script>
    <script>
        var show = true;
        $(Document).ready(function() {
            $("#add-btn").click(function() {
                if (show == true) {
                    $("#add-docs").css("display", "block");
                    show = false;
                } else {
                    $("#add-docs").css("display", "none");
                    show = true;
                }
            })
        });
    </script>
</body>

</html>