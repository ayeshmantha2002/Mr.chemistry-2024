<?php

include('includes/connection.php');

if (!isset($_SESSION['ID'])) {
    header("location:index.php?error=login_first");
}

$errors  =   array();

// image upload process
if (isset($_POST['uploadimage'])) {

    $file_name = $_POST['file_name'];
    $base64_img = $_POST['cropped_img'];
    $image = explode(',', $base64_img);
    $upload_img = base64_decode($image[1]);

    if (empty($errors)) {
        $deletSearch = "SELECT * FROM tbl_register WHERE ID = {$_SESSION['ID']}";
        $deletSearchResult = mysqli_query($connection, $deletSearch);
        if ($deletSearchResult) {
            $oldImg = mysqli_fetch_assoc($deletSearchResult);
            $oldImgName  = $oldImg['Pro_pic'];

            if ($oldImgName != "user.png") {
                $parth = "admin/students/{$oldImgName}";
                if (unlink($parth)) {

                    // Set the path to save the image
                    $savePath = 'admin/students/' . $file_name;
                    $success = file_put_contents($savePath, $upload_img);
                    echo "Image saved and compressed successfully!";
                }
            } else {
                // Set the path to save the image
                $savePath = 'admin/students/' . $file_name;
                $success = file_put_contents($savePath, $upload_img);
                echo "Image saved and compressed successfully!";

                echo "Image saved and compressed successfully!";
            }
        }

        if ($success) {
            $updatPic  =   "UPDATE `tbl_register` SET `Pro_pic` = '{$file_name}' WHERE `ID` = {$_SESSION['ID']} LIMIT 1";
            $result_updatePic  =   mysqli_query($connection, $updatPic);

            $searchUser = "SELECT * FROM score WHERE User_ID = '{$_SESSION['userID_Name']}'";
            $searchUserResult = mysqli_query($connection, $searchUser);

            $searchUser2 = "SELECT * FROM al_result WHERE User_ID = '{$_SESSION['userID_Name']}'";
            $searchUserResult2 = mysqli_query($connection, $searchUser2);

            if (mysqli_num_rows($searchUserResult) > 0) {
                $updatPic  =   "UPDATE score SET Pro_pic = '{$file_name}' WHERE User_ID = '{$_SESSION['userID_Name']}'";
                $result_updatePic  =   mysqli_query($connection, $updatPic);
            }

            if (mysqli_num_rows($searchUserResult2) == 1) {
                $updatPic2  =   "UPDATE `al_result` SET `img` = '{$file_name}' WHERE User_ID = '{$_SESSION['userID_Name']}'";
                $result_updatePic2  =   mysqli_query($connection, $updatPic2);
            }

            header("location:update.php?profile=update_your_profile_photo");
        };
    };
};

// change password process
if (isset($_POST['change'])) {
    $oldPassword = mysqli_real_escape_string($connection, $_POST['old']);
    $newPassword = mysqli_real_escape_string($connection, $_POST['new']);
    $reNewPassword = mysqli_real_escape_string($connection, $_POST['reNew']);
    $oldHashPassword = sha1($oldPassword);
    $newHashPassword = sha1($newPassword);

    if ($newPassword == $reNewPassword) {
        if ($oldPassword != $newPassword) {
            $whreUser = "SELECT * FROM tbl_register WHERE `ID` = {$_SESSION['ID']} AND `Password` = '{$oldHashPassword}'";
            $whereResult = mysqli_query($connection, $whreUser);
            if ($whereResult) {
                if (mysqli_num_rows($whereResult) == 1) {
                    $updatePassword = "UPDATE tbl_register SET `Password` = '{$newHashPassword}' WHERE ID = {$_SESSION['ID']} LIMIT 1";
                    $updatePasswordResult = mysqli_query($connection, $updatePassword);

                    if ($updatePasswordResult) {
                        header("location:update.php?password=updated");
                    } else {
                        header("location:update.php?password=not_updated");
                    }
                } else {
                    header("location:update.php?password=old_password_incorrect");
                }
            } else {
                header("location:update.php?password=old_password_incorrect");
            }
        } else {
            header("location:update.php?password=not_change");
        }
    } else {
        header("location:update.php?password=noMatch");
    }
}

if (isset($_GET['profile'])) {
    // profile photo upload success msg
    if ($_GET['profile'] == "update_your_profile_photo") {
        $updatePhoto    =   '<div class="updatePhoto">
            <div id="myUpdatePic">
                <p><i class="fa-regular fa-circle-check fa-shake fa-2xl"></i></p><br><br>
                <p>Your photo has been updated.</p><br>
                <p><a href="index.php?update=photo">OK</a></p>
            </div>
        </div>';

        // update name msg
    } elseif ($_GET['profile'] == "update_your_Name") {
        $updatePhoto    =   '<div class="updatePhoto">
        <div id="myUpdatePic">
            <p><i class="fa-regular fa-circle-check fa-shake fa-2xl"></i></p><br><br>
            <p>Your Name has been updated.</p><br>
            <p><a href="index">OK</a></p>
        </div>
    </div>';

        // update class
    } elseif ($_GET['profile'] == "update_your_class") {
        $updatePhoto    =   '<div class="updatePhoto">
        <div id="myUpdatePic">
            <p><i class="fa-regular fa-circle-check fa-shake fa-2xl"></i></p><br><br>
            <p>Your Class has been updated.</p><br>
            <p><a href="index">OK</a></p>
        </div>
    </div>';
    } else {
        $updatePhoto    =   '';
    }
} else {
    $updatePhoto    =   '';
}


// change password messages
if (isset($_GET['password'])) {
    // update password message
    if ($_GET['password'] == "updated") {
        $updatePhoto    =   '<div class="updatePhoto">
            <div id="myUpdatePic">
                <p><i class="fa-regular fa-circle-check fa-shake fa-2xl"></i></p><br><br>
                <p>Your Password has been updated.</p><br>
                <p><a href="index.php?update=password">OK</a></p>
            </div>
        </div>';

        // old password incorrect message
    } elseif ($_GET['password'] == "old_password_incorrect") {
        $updatePhoto    =   '<div class="updatePhoto">
        <div id="myUpdatePic">
            <p><i class="fa-regular fa-circle-xmark fa-bounce fa-2xl" style="color: #ff0000;"></i></p><br><br>
            <p>Your existing password is incorrect.</p><br>
            <p><a href="update">OK</a></p>
        </div>
    </div>';

        // not_updated
    } elseif ($_GET['password'] == "not_updated") {
        $updatePhoto    =   '<div class="updatePhoto">
        <div id="myUpdatePic">
        <p><i class="fa-regular fa-circle-xmark fa-bounce fa-2xl" style="color: #ff0000;"></i></p><br><br>
            <p>Error, Try again.</p><br>
            <p><a href="update">OK</a></p>
        </div>
    </div>';

        // password not change
    } elseif ($_GET['password'] == "not_change") {
        $updatePhoto    =   '<div class="updatePhoto">
        <div id="myUpdatePic">
        <p><i class="fa-regular fa-circle-xmark fa-bounce fa-2xl" style="color: #ff0000;"></i></p><br><br>
            <p> Please enter a new password.</p><br>
            <p><a href="update">OK</a></p>
        </div>
    </div>';

        // password not match
    } elseif ($_GET['password'] == "noMatch") {
        $updatePhoto    =   '<div class="updatePhoto">
            <div id="myUpdatePic">
            <p><i class="fa-solid fa-eye fa-beat"></i></p><br><br>
                <p>Recheck your new password and try again.</p><br>
                <p><a href="update">OK</a></p>
            </div>
        </div>';
    } else {
        $updatePhoto    =   '';
    }
}


if (isset($_POST['submitupload'])) {

    $Update_class =   mysqli_real_escape_string($connection, $_POST['class']);
    $Update_Category =   mysqli_real_escape_string($connection, $_POST['UpCategory']);

    $updat  =   "UPDATE tbl_register SET Class = '{$Update_class}' ,Category = '{$Update_Category}' , Confirm_user = 3 WHERE ID = {$_SESSION['ID']} LIMIT 1";
    $result_update  =   mysqli_query($connection, $updat);

    if ($result_update) {
        header("location:update.php?profile=update_your_class");
    }
}

if (isset($_POST['submit'])) {
    $Update_First_name =   mysqli_real_escape_string($connection, $_POST['First_name']);
    $Update_Last_name =   mysqli_real_escape_string($connection, $_POST['Last_name']);

    $updat  =   "UPDATE tbl_register SET First_name = '{$Update_First_name}' , Last_name = '{$Update_Last_name}' WHERE ID = {$_SESSION['ID']} LIMIT 1";
    $result_update  =   mysqli_query($connection, $updat);

    if ($result_update) {
        header("location:update.php?profile=update_your_Name");
    }
}

if (isset($_SESSION['ID'])) {
    $query  =   "SELECT * FROM tbl_register WHERE ID ={$_SESSION['ID']} LIMIT 1";
    $result =    mysqli_query($connection, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $verify =   mysqli_fetch_assoc($result);
            $verifyUser =   $verify['Confirm_user'];
            $First_name =   $verify['First_name'];
            $Last_name  =   $verify['Last_name'];
            $E_mail     =   $verify['E_mail'];
            $Class      =   $verify['Class'];
            $Category   =   $verify['Category'];
            $Confirm_user   =   $verify['Confirm_user'];
            $userPic    =   $verify['Pro_pic'];

            if ($Confirm_user == 1) {
                $activeSatus    =   "Verified user";
            } else {
                $activeSatus    =   "Not verified user";
            }
        }
    }
};

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mr.ChemistrY - Update My Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropper/4.1.0/cropper.min.css">
    <link rel="stylesheet" href="assect/css/style.css">
    <link rel="icon" href="assect/img/icon/logo.png">

    <style>
        #progress-container {
            width: 100%;
            height: 30px;
            border: 1px solid #ccc;
            position: relative;
            display: none;
        }

        #progress-bar {
            width: 0;
            height: 100%;
            background-color: #4CAF50;
            transition: width 1s;
        }

        #progress-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-family: Arial, sans-serif;
            font-size: 16px;
            color: #333;
        }
    </style>
</head>

<body>
    <div id="progress-container">
        <div id="progress-bar"></div>
        <div id="progress-text">0%</div>
    </div>
    <div class="blur"></div>
    <div class="loading" id="loader">
        <img src="assect/img/icon/New-file.gif" alt="">
    </div>
    <div id="upNav">
        <div class="upNav">
            <div class="logo">
                <h3> <i class="fa-solid fa-bars" id="navClick" style="color: var(--text-blue);
                padding-right: 15px;
                font-size: 25px;
                transform: translateY(4px);
                cursor: pointer;"></i> Mr. <span id="maths"> ChemistrY </span> </h3>
                <p> NIPUN PALLIYAGURU </p>
            </div>
            <ul <?php if (isset($_SESSION['ID'])) {
                    echo "hidden";
                }; ?>>
                <li><a href="register"> Register </a></li>
                <li><a href="login"> Login </a></li>
            </ul>
        </div>
    </div>
    <div class="hero">
        <?php
        include("includes/sidenav.php");
        ?>
        <?php echo $updatePhoto; ?>
        <div class="content">
            <div class="lable">
                <div class="lableAling">
                    <h2> Mr.Maths </h2>
                    <p>Mr.ChemistrY - <span style='font-family: "Noto Sans Sinhala"; font-weight: bold;'> වෙනස්ම රහකට </span> ChemistrY </p>
                </div>
            </div>
            <div class="updateForm">
                <div>
                    <div style="color: red; font-size: 13px;">
                        <?php
                        if (!empty($errors)) {
                            foreach ($errors as $error) {
                                echo '- ' . $error . '<br>';
                            }
                        }
                        ?>
                    </div>
                    <br>


                    <!-- image inputs -->
                    <div class="imageUpload">
                        <p><input type="file" name="image" id="image"> Upload Profile Picture </p>
                        <div>
                            <canvas id="canvas">
                                your device dose not support canvas
                            </canvas>
                            <button id="crop">Crop</button>
                        </div>
                        <div id="cropImg"></div>
                    </div>

                    <form method="post" enctype="multipart/form-data">
                        <input type="hidden" name="file_name" id="file_name">
                        <input type="hidden" name="cropped_img" id="cropped_img">
                        <input type="submit" value="Set Profile PIC" name="uploadimage" id="uploadimage" disabled>
                        <br>
                        <label id="uploadProgress"> Uploading... <i class="fa-solid fa-rotate fa-spin"></i></label>

                        <br>
                        <p>User ID:<input type="text" placeholder="<?php echo $_SESSION['userID_Name']; ?>" readonly></p>
                        <p>First Name:<input name="First_name" type="text" value="<?php echo $First_name; ?>"></p>
                        <p>Last Name:<input name="Last_name" type="text" value="<?php echo $Last_name; ?>"></p>
                        <p>E-mail:<input type="text" placeholder="<?php echo $_SESSION['E_mail']; ?>" readonly></p>
                        <p><input type="submit" value="Update" name="submit"></p><br><br>

                        <div class="notice">
                            <h3 class="fa-fade">NOTICE :-</h3>
                            <p> මෙම අංශයේ කරන්නාවූ වෙනස් කිරීමකදී ඔබගේ ගිනුම අප ආයතනයේ පාරිබෝගික සේවා නිලදාරියෙක් මගින් පරීෂා කොට දත්ත නිවැරදි නම් පමණක් ගිනුම තහවුරු කරණු ඇත. </p>
                        </div>
                        <br>
                        <p>Class Year:<select name="class" id="class">
                                <option value="2023" <?php if ($Class == "2023") {
                                                            echo "selected";
                                                        } ?>>2023</option>
                                <option value="2024" <?php if ($Class == "2024") {
                                                            echo "selected";
                                                        } ?>>2024</option>
                                <option value="2025" <?php if ($Class == "2025") {
                                                            echo "selected";
                                                        } ?>>2025</option>
                                <option value="2026" <?php if ($Class == "2026") {
                                                            echo "selected";
                                                        } ?>>2026</option>
                            </select></p>
                        <div class="updatRadio">
                            <input type="radio" name="UpCategory" value="Theory" id="Theory" <?php if ($Category == "Theory") {
                                                                                                    echo "checked";
                                                                                                } ?>><label for="Theory">Theory</label><br>
                            <input type="radio" name="UpCategory" value="Revision" id="Revision" <?php if ($Category == "Revision") {
                                                                                                        echo "checked";
                                                                                                    } ?>><label for="Revision">Revision</label><br>
                            <input type="radio" name="UpCategory" value="Theory & Revision" id="TheoryRevision" <?php if ($Category == "Theory & Revision") {
                                                                                                                    echo "checked";
                                                                                                                } ?>><label for="TheoryRevision">Theory & Revision</label>
                        </div>
                        <p><input type="submit" value="Upgrade" name="submitupload"></p>
                    </form><br>

                    <!-- change password form -->
                    <h3 style="text-align: center;"> Change Password </h3>
                    <form method="post">
                        <input type="password" placeholder="Old Password" name="old" id="old" required minlength="8">
                        <div class="sutdentDetails">
                            <input type="password" required placeholder="New Password" name="new" id="new" minlength="8">
                            <input type="password" required placeholder="Re-New Password" name="reNew" minlength="8">
                        </div>
                        <p><input type="submit" value="Change Password" name="change"></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="blur"></div>

    <script src="assect/js/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.cycle2/2.1.6/jquery.cycle2.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropper/4.1.0/cropper.min.js"></script>
    <script src="assect/js/viewjs.js"></script>

    <script>
        var loader = document.getElementById("loader");
        window.addEventListener("load", function() {
            loader.style.display = "none";
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#uploadimage").click(function() {
                $("#uploadProgress").css("display", "block");
                $("#progress-container").css("display", "block");
            });

            // preparing canvas variables
            var $canvas = $('#canvas'),
                context = $canvas.get(0).getContext('2d');

            // waiting for a file to be selected
            $('#image').on('change', function() {

                if (this.files && this.files[0]) {
                    // checking if a file is selected

                    if (this.files[0].type.match(/^image\//)) {
                        // valid image file is selected

                        $('#file_name').attr('value', this.files[0].name);

                        // process the image
                        var reader = new FileReader();

                        reader.onload = function(e) {
                            var img = new Image();
                            img.onload = function() {
                                context.canvas.width = img.width;
                                context.canvas.height = img.height;
                                context.drawImage(img, 0, 0);

                                // instantiate cropper
                                var cropper = $canvas.cropper({
                                    aspectRatio: 1
                                });
                            };
                            img.src = e.target.result;
                        };

                        $('#crop').click(function() {
                            var croppedImage = $canvas.cropper('getCroppedCanvas').toDataURL('image/jpg');
                            $('#cropImg').append($('<img>').attr('src', croppedImage));
                            $('#cropped_img').attr('value', croppedImage);
                            $('#uploadimage').removeAttr('disabled');
                            $('#cropImg').css('display', 'block');
                        });

                        // reading the selected file
                        reader.readAsDataURL(this.files[0]);


                    } else {
                        alert('Invalid file type');
                    }
                } else {
                    alert('Please select a file.');
                }
            });

        })
    </script>
    <script>
        const progressBar = document.getElementById("progress-bar");
        const progressText = document.getElementById("progress-text");
        const startButton = document.getElementById("uploadimage");

        let progress = 0;
        const targetProgress = 100;
        const interval = 1200; // in milliseconds

        const updateProgress = () => {
            if (progress < targetProgress) {
                progress += 1;
                progressBar.style.width = `${progress}%`;
                progressText.textContent = `${progress}%`;
                setTimeout(updateProgress, interval);
            }
        };

        startButton.addEventListener("click", () => {
            progress = 0;
            updateProgress();
        });
    </script>
</body>

</html>