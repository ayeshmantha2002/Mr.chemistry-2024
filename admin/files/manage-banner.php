<?php
include "../../includes/connection.php";
if (isset($_SESSION['ID'])) {
    if ($_SESSION['ID'] >= 2) {
        header("location: ../../index");
    }
} else {
    header("location: ../../index");
}

// fetch banner image 
$bannerImage = "SELECT * FROM image_table WHERE `Status` = 1";
$bannerImage_result = mysqli_query($connection, $bannerImage);

// upload photos
$allready = "";
if (isset($_POST['item-upload'])) {

    if (!isset($_FILES['image']['name']) || strlen(trim($_FILES['image']['name'])) < 1) {
        header("location: manage-banner.php?insert=error");
    } else {

        $fileName = $_FILES['image']['name'];
        $fileTemp = $_FILES['image']['tmp_name'];
        $fileSize = $_FILES['image']['size'];
        $fileType = $_FILES['image']['type'];

        if ($fileType == 'image/jpg' || $fileType == 'image/jpeg' || $fileType == 'image/png') {
            $upload_to = "../../assect/img/brand/";

            $checkImage = "SELECT * FROM image_table WHERE `Image_name` = '{$fileName}'";
            $checkImage_result = mysqli_query($connection, $checkImage);

            if (mysqli_num_rows($checkImage_result) > 0) {
                $allready = "<p style='text-align: center; color: tomato;'>This picture already exists.</p>";
            } else {
                $uploadIMage = move_uploaded_file($fileTemp, $upload_to . $fileName);
                if ($uploadIMage) {
                    $addItem = "INSERT INTO image_table (`Image_name`, `Status`) VALUE ('{$fileName}', 1)";
                    $addItemResult = mysqli_query($connection, $addItem);
                    if ($addItemResult) {
                        header("location:manage-banner.php?insert=done");
                    } else {
                        header("location:manage-banner.php?insert=error");
                    }
                }
            }
        } else {
            header("location:manage-banner.php?File-type=error");
        }
    }
}

// delete photos
if (isset($_GET['delete'])) {
    $id = mysqli_real_escape_string($connection, $_GET['delete']);
    $neme = mysqli_real_escape_string($connection, $_GET['name']);
    $delet_Item = "DELETE FROM image_table WHERE ID={$id} LIMIT 1";
    $delet_Item_result = mysqli_query($connection, $delet_Item);

    if ($delet_Item_result) {
        $parth = "../../assect/img/brand/$neme";
        if (unlink($parth)) {
            header("location:manage-banner.php?insert=done");
        } else {
            header("location:manage-banner.php?insert=error");
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Banner</title>
    <link rel="stylesheet" href="../../assect/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="area">
        <div class="area-aline">
            <header>
                <nav>
                    <a href="../admin.php" onclick='loadinEffect()'> <i class="fa-solid fa-angle-left"></i> </a>
                    <h2> Mange Banner </h2>
                </nav>
            </header>
            <br><br><br><br><br>

            <!-- add banners form  -->
            <p style="padding: 0 10px; text-align: center;"> <b> IMPORTANT : </b> Aspect ratio <b>14:5</b> & max image size <b>1024KB</b> </p>
            <?php
            if (isset($_GET['File-type'])) {
                echo "<p style='color: red; padding: 0 10px; text-align: center;'> You can only upload JPG or PNG </p>";
            }
            ?>
            <?php echo $allready; ?>
            <form action="manage-banner.php" method="post" enctype="multipart/form-data">
                <p><input type="file" name="image"></p>
                <p><input type="submit" onclick='loadinEffect()' name="item-upload"></p>
            </form>

            <!-- list images  -->
            <?php
            if ($bannerImage_result) {
                if (mysqli_num_rows($bannerImage_result) > 0) {
                    echo "<h2> Click & delete </h2>";
                    echo "<div class='image-view'>";
                    while ($image = mysqli_fetch_assoc($bannerImage_result)) {
                        $imageID = $image['ID'];
                        $imageName = $image['Image_name'];
                        echo " <a href='manage-banner.php?delete={$imageID}&name={$imageName}'><img src='../../assect/img/brand/{$imageName}' alt='banner'></a>";
                    }
                    echo "</div>";
                } else {
                    echo "<div class='image-view'>
                                <img src='https://placehold.co/1400x500?text=Mr.ChemistrY.lk' alt='banner'>
                                <img src='https://placehold.co/1400x500?text=Nipun+Palliyaguru' alt='banner'>
                            </div>";
                }
            }
            ?>

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
                <p> <a href="manage-banner.php"> OK </a> </p>
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
                <p> <a href='manage-banner.php'> OK </a> </p>
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