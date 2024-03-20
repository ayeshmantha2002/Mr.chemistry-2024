<?php
include "../../includes/connection.php";
if (isset($_SESSION['ID'])) {
    if ($_SESSION['ID'] >= 3) {
        header("location: ../../index");
    }
} else {
    header("location: ../../index");
}

if (isset($_COOKIE['Class'])) {
    $cate = "class={$_COOKIE['Class']}";
} elseif (isset($_COOKIE['Category'])) {
    $cate = "Category={$_COOKIE['Category']}";
} else {
    $cate = "";
}

// fetch Doc details
if (isset($_GET['doc'])) {
    $docID = mysqli_real_escape_string($connection, $_GET['doc']);
    if ($docID < 0) {
        header("location: manage-documents.php");
    }
    $doc_details = "SELECT * FROM `modle_papers_&_tutes` WHERE `ID` = {$docID}";
    $doc_details_result = mysqli_query($connection, $doc_details);
    if (mysqli_num_rows($doc_details_result) == 1) {
        $details = mysqli_fetch_assoc($doc_details_result);
        $ID = $details['ID'];
        $Title = $details['Title'];
        $File_name = $details['File_name'];
        $Category = $details['Category'];
        $Class = $details['Class'];
        $Status = $details['Status'];

        if ($Category == 1) {
            $CategoryView = "Modle Paper";
        } elseif ($Category == 2) {
            $CategoryView = "Tute";
        }

        if ($Status == 1) {
            $StatusView = "<span style='color: green;'><b>Open</b></span>";
        } elseif ($Status == 0) {
            $StatusView = "<span style='color: red;'><b>Closed</b></span>";
        }

        // links
        if ($Status == 1) {
            $link = "<a onclick='loadinEffect()' href='docs-manage.php?doc={$ID}&status=close'>Close Now </a>";
        } elseif ($Status == 0) {
            $link = "<a onclick='loadinEffect()' href='docs-manage.php?doc={$ID}&status=open' style='background-color: red;'> Open Now </a>";
        }

        // status update
        if (isset($_GET['status'])) {
            if ($_GET['status'] == "open") {
                $update = "UPDATE `modle_papers_&_tutes` SET `Status` = 1 WHERE ID = {$ID}";
            } elseif ($_GET['status'] == "close") {
                $update = "UPDATE `modle_papers_&_tutes` SET `Status` = 0 WHERE ID = {$ID}";
            }

            $update_result = mysqli_query($connection, $update);
            if ($update_result) {
                header("location: manage-documents.php?insert=done&{$cate}");
            }
        }
    }

    // delete document
    if (isset($_GET['delete'])) {
        $deleteID = mysqli_real_escape_string($connection, $_GET['delete']);
        $docName = mysqli_real_escape_string($connection, $_GET['docName']);

        $delete = "DELETE FROM `modle_papers_&_tutes` WHERE ID={$deleteID} LIMIT 1";
        $delete_result = mysqli_query($connection, $delete);

        if ($delete_result) {
            $parth = "../docs/$docName";
            if (unlink($parth)) {
                header("location:manage-documents.php?insert=done");
            } else {
                header("location:manage-documents.php?insert=error");
            }
        }
    }
} else {
    header("location: manage-documents.php");
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
</head>

<body>
    <!-- main area -->
    <div class="area">
        <div class="area-aline">
            <header>
                <nav>
                    <?php
                    if (isset($_COOKIE['Class'])) {
                        echo " <a onclick='loadinEffect()' href='docs-manage.php?class={$_COOKIE['Class']}'>
                        <i class='fa-solid fa-angle-left'></i>
                        </a>";
                    } elseif (isset($_COOKIE['Category'])) {
                        echo " <a onclick='loadinEffect()' href='docs-manage.php?Category={$_COOKIE['Category']}'>
                        <i class='fa-solid fa-angle-left'></i>
                        </a>";
                    } else {
                        echo '
                        <a onclick="loadinEffect()" href="docs-manage.php">
                        <i class="fa-solid fa-angle-left"></i>
                        </a>
                        ';
                    }
                    ?>
                    <h2> Manage Document </h2>
                </nav>
            </header>
            <br><br><br><br>

            <!-- user details  -->
            <div class='user-info'>
                <?php
                echo "<p> <b>Doc ID : </b> {$ID} </p>
                <p> <b>Title : </b> {$Title} </p>
                <p> <b>File Name : </b> {$File_name} </p>
                <p> <b>Category : </b> {$CategoryView} </p>
                <p> <b>Class : </b> {$Class} </p>
                <p> <b>Status : </b> {$StatusView} </p>";
                ?>
                <br><br>
                <iframe src="../docs/<?php echo $File_name; ?>" frameborder="0" width="100%" height="250px"></iframe>
            </div>
            <br><br>

            <!-- links buttons -->
            <div class="full">
                <?php echo $link; ?>
                <a style="background-color: red;" href="docs-manage.php?<?php echo 'docName=' . $File_name . '&delete=' . $ID . '&doc=' . $ID ?>" id="changeD">DELETE DOCUMENT</a>
            </div>
        </div>
    </div>

    <!-- loader image -->
    <div class="loading" id="loader">
        <img src="../../assect/img/icon/New-file.gif" alt="loading">
    </div>

    <script src="../../assect/js/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#changeD").click(function() {
                $("#form").css("display", "block");
                $("#password").css("display", "none");
            });

            $("#changeP").click(function() {
                $("#password").css("display", "block");
                $("#form").css("display", "none");
            })
        })
    </script>

    <script>
        function loadinEffect() {
            document.getElementById('loader').style.display = "flex";
        }
    </script>

</body>

</html>