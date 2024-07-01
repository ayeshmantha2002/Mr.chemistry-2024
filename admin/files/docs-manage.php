<?php
include "../../includes/connection.php";
if (isset($_SESSION['ID'])) {
    if ($_SESSION['ID'] >= 2) {
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
        $UniqueID = $details['UniqueID'];
        $Title = $details['Title'];
        $File_name = $details['File_name'];
        $Category = $details['Category'];
        $Class = $details['Class'];
        $Status = $details['Status'];


        if ($Category == 1) {
            $CategoryView = "Modle Paper";
        } elseif ($Category == 2) {
            $CategoryView = "Tutes";
        } elseif ($Category == 3) {
            $CategoryView = "Modle Paper Marking";
        } elseif ($Category == 4) {
            $CategoryView = "Class Mate Paper";
        } elseif ($Category == 5) {
            $CategoryView = "Class Mate Paper Marking";
        } elseif ($Category == 6) {
            $CategoryView = "Notes";
        }

        if ($Status == 1) {
            $StatusView = "<span style='color: green;'><b>Open</b></span>";
        } elseif ($Status == 0) {
            $StatusView = "<span style='color: red;'><b>Closed</b></span>";
        }

        // update documents
        if (isset($_POST['updateDoc'])) {
            $Uid = mysqli_real_escape_string($connection, $_POST['UniqueID']);
            $Utitle = mysqli_real_escape_string($connection, $_POST['title']);
            $Uclass = mysqli_real_escape_string($connection, $_POST['class']);
            $Ucat = mysqli_real_escape_string($connection, $_POST['catagory']);

            $updateDOC = "UPDATE `modle_papers_&_tutes` SET `UniqueID` = '{$Uid}', `Title` = '{$Utitle}', `Category` = {$Ucat}, `Class` = {$Uclass} WHERE `ID` = {$ID}";
            $updateDOC_query = mysqli_query($connection, $updateDOC);
            if ($updateDOC_query) {
                header("location: manage-documents.php?insert=done");
            }
        }

        // links
        if ($Status == 1) {
            $link = "<a onclick='loadinEffect()' href='docs-manage.php?doc={$ID}&status=close'>Hide File </a>";
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

    <style>
        #editform {
            width: 90%;
            max-width: 500px;
            margin: 50px auto;
            box-shadow: 0 0 10px var(--shadow);
            border-radius: 10px;
            display: none;
        }
    </style>

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
                echo "
                <p> <b>UniqueID	 : </b> {$UniqueID} </p>
                <p> <b>Title : </b> {$Title} </p>
                <p> <b>File Name : </b> {$File_name} </p>
                <p> <b>Category : </b> {$CategoryView} </p>
                <p> <b>Class : </b> {$Class} </p>
                <p> <b>Status : </b> {$StatusView} </p>";
                ?>
                <br><br>
                <?php
                echo "<iframe src='../docs/{$File_name}' frameborder='0' width='100%' height='650px'></iframe>";
                ?>
            </div>
            <br><br>

            <!-- links buttons -->
            <div class="full">
                <a href="#editform" id="edit"> Edit Details </a>
            </div>
            <br>

            <div id="editform">
                <form method="post">
                    <p> Unique ID :
                        <input type="text" placeholder="Unique ID" value="<?php echo $UniqueID; ?>" name="UniqueID" required>
                    </p>
                    <p> Title :
                        <input type="text" placeholder="Title" value="<?php echo $Title; ?>" name="title" required>
                    </p>
                    <p> Class :
                        <input type="number" placeholder="Class" value="<?php echo $Class; ?>" name="class" min="2024" required>
                    </p>
                    <p>
                        Category :
                        <select name="catagory" required>
                            <option value="1" <?php
                                                if ($Category == 1) {
                                                    echo "selected";
                                                }
                                                ?>>
                                Modle Paper
                            </option>
                            <option value="2" <?php
                                                if ($Category == 2) {
                                                    echo "selected";
                                                }
                                                ?>>
                                Tutes
                            </option>
                            <option value="3" <?php
                                                if ($Category == 3) {
                                                    echo "selected";
                                                }
                                                ?>>
                                Modle Paper Marking
                            </option>
                            <option value="4" <?php
                                                if ($Category == 4) {
                                                    echo "selected";
                                                }
                                                ?>>
                                Class Mate Paper
                            </option>
                            <option value="5" <?php
                                                if ($Category == 5) {
                                                    echo "selected";
                                                }
                                                ?>>
                                Class Mate Paper Marking
                            </option>
                            <option value="6" <?php
                                                if ($Category == 6) {
                                                    echo "selected";
                                                }
                                                ?>>
                                Notes
                            </option>
                        </select>
                    </p>
                    <p>
                        <input type="submit" name="updateDoc" value="Update">
                    </p>
                </form>
                <br>
            </div>

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

            var show = true;
            $("#edit").click(function() {
                if (show == true) {
                    $("#editform").css("display", "block");
                    show = false;
                } else {
                    $("#editform").css("display", "none");
                    show = true;
                }
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