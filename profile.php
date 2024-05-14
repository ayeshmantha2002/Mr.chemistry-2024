<?php
include("includes/connection.php");
$verifyUser =   "";
$red    =   "";
$AVScore = "";
$lowest = 0;
$highst = 0;

if (isset($_GET['rederect'])) {
    header("location:index.php?update=remove");
}

?>

<!-- loader image -->
<div class="loading" id="wait">
    <img src="assect/img/icon/New-file.gif" alt="loading">
</div>

<div class="lable">
    <div class="lableAling">
        <!-- <p id="setting"><i class="fa-solid fa-gear"></i></p> -->
        <h2> MY PROFILE </h2>
        <p> Smart Education - Mr.Maths </p>
    </div>
</div>
<?php

// my all details fetch
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
            $Pro_pic    =   $verify['Pro_pic'];
        }
    }

    // my papers details
    $query_score  =   "SELECT * FROM score WHERE User_ID ={$_SESSION['ID']} AND Class = '{$Class}' AND Status = 1";
    $query_score1  =   "SELECT * FROM score WHERE User_ID ={$_SESSION['ID']} AND Class = '{$Class}' AND Status = 2";
    $query_score2  =   "SELECT * FROM score WHERE User_ID ={$_SESSION['ID']} AND Class = '{$Class}' AND Status = 3";
    $result_score =    mysqli_query($connection, $query_score);
    $result_score1 =    mysqli_query($connection, $query_score1);
    $result_score2 =    mysqli_query($connection, $query_score2);

    if ($result_score) {
        $PapersCount    =   mysqli_num_rows($result_score);
    } else {
        $PapersCount = 0;
    }
    if ($result_score1) {
        $Papersabsent    =   mysqli_num_rows($result_score1);
    } else {
        $Papersabsent = 0;
    }
    if ($result_score2) {
        $Papersuspend    =   mysqli_num_rows($result_score2);
    } else {
        $Papersuspend = 0;
    }

    $numberOfPaper  =   $PapersCount + $Papersabsent + $Papersuspend;
    $AvPaper    =   20 - $numberOfPaper;


    // score calculations
    $query_score3  =   "SELECT * FROM score WHERE User_ID ={$_SESSION['ID']} AND Class = '{$Class}' AND Status = 1 ORDER BY ID DESC LIMIT 0, 4";
    $result_score3 =    mysqli_query($connection, $query_score3);

    if ($result_score3) {
        if ($testCore   =   mysqli_num_rows($result_score3)) {
            $totel  = 0;
            while ($score = mysqli_fetch_assoc($result_score3)) {
                $totel  += $score['Score'];
            }
            if ($testCore <= 1) {
            } elseif ($testCore >= 2) {
                $AVScore    =   round(($totel / $testCore + 5), 1);
            }
        }
    }
    if ($AVScore <= 5) {
        $AVpass =   "-";
        $red    =   "no";
    } elseif ($AVScore <= 34) {
        $AVpass =   "F";
        $red    =   "tomato";
    } elseif ($AVScore <= 54) {
        $AVpass =   "S";
    } elseif ($AVScore <= 64) {
        $AVpass =   "C";
    } elseif ($AVScore <= 74) {
        $AVpass =   "B";
    } else {
        $AVpass =   "A";
    }

    // lowerst score
    $query_score4  =   "SELECT * FROM score WHERE User_ID ={$_SESSION['ID']} AND Class = '{$Class}' AND Status = 1 ORDER BY Score LIMIT 1";
    $result_score4 =    mysqli_query($connection, $query_score4);
    if ($result_score4) {
        if (mysqli_num_rows($result_score4) == 1) {
            $lowestFethch =   mysqli_fetch_assoc($result_score4);
            $lowest =   $lowestFethch['Score'];
        }
    }

    // highest score
    $query_score5  =   "SELECT * FROM score WHERE User_ID ={$_SESSION['ID']} AND Class = '{$Class}' AND Status = 1 ORDER BY Score DESC LIMIT 1";
    $result_score5 =    mysqli_query($connection, $query_score5);
    if ($result_score5) {
        if (mysqli_num_rows($result_score5)) {
            $highstFethch =   mysqli_fetch_assoc($result_score5);
            $highst =   $highstFethch['Score'];
        }
    }

    // Nomber of class members
    $queryStudent  =   "SELECT * FROM tbl_register WHERE Class = '{$Class}' AND Category = '{$Category}'";
    $resultStudent =    mysqli_query($connection, $queryStudent);

    if ($resultStudent) {
        $students = mysqli_num_rows($resultStudent);
    }
};

// profile pic remove
if (isset($_POST['remove'])) {
    $parth = "admin/students/{$Pro_pic}";
    if (unlink($parth)) {
        $success1    =   "UPDATE tbl_register SET Pro_pic='user.png' WHERE ID = {$_SESSION['ID']}";
        $successQuery1 = mysqli_query($connection, $success1);

        $success2    =   "UPDATE score SET Pro_pic='user.png' WHERE User_ID = {$_SESSION['ID']}";
        $successQuery2 = mysqli_query($connection, $success2);

        $ALtableCheck = "SELECT * FROM al_result WHERE User_ID = {$_SESSION['ID']}";
        $resultAL = mysqli_query($connection, $ALtableCheck);
        if ($resultAL) {
            if (mysqli_num_rows($resultAL) == 1) {
                $success3    =   "UPDATE al_result SET img='user.png' WHERE User_ID = {$_SESSION['ID']} LIMIT 1";
                $successQuery3 = mysqli_query($connection, $success3);
            }
        }
    }
}

?>

<body>
    <div class="picViewaful">
        <div id="picViewaling">
            <img src="admin/students/<?php echo $Pro_pic; ?>" alt="Profile pic">
        </div>
    </div>
    <div class="viewPic">
        <div class="viewPicaling">
            <form action="profile.php?rederect=yes" method="post">
                <?php if ($Pro_pic != "user.png") {
                    echo '<p><a href="#" id="viewPic">VIEW PHOTO</a></p>';
                    echo '<p><input type="submit" value="REMOVE PHOTO" name="remove" class="wait"></p>';
                } ?>
            </form>
            <p><a href="update" class="wait">UPLOAD NEW PHOTO</a></p>
        </div>
    </div>
    <?php
    if ($verifyUser ==   1) {
        echo '<div class="profilMain">
                <div class="viewProfile">
                    <div class="pic">
                    <a href="#"><div class="picalin">
                            <img src="admin/students/' . $Pro_pic . '" alt="Profile pic">
                            <div id="chang"><i class="fa-solid fa-camera"></i></a></div>
                        </div></a>
                    </div>
                    <div class="myDetails">' .
            '<p><b>USER ID:</b>' . ' ' . $_SESSION['userID_Name'] . '</p>
                    <p><b>Name :</b>' . ' ' . $First_name . " " . $Last_name . '</p>
                    <p><b>Class:</b>' . ' ' . $Class . ' ' . $Category . '</p>
                    <p><b>Email:</b>' . ' ' . $_SESSION['E_mail'] . '</p>
                    <p> <span style="color: limegreen;"><b> Verified user </b></span> </p>
        
                    <br>
                    <p><a href="update" id="update" onclick="loadingEffect()"><i class="fa-solid fa-pen-to-square"></i> Upload image & Edit Details.</a></p>
                </div>
            </div>
        </div>' . '
        <div class="headline">
            <h2>My progress</h2>
        </div>
    <div class="myChart">
        <div class="place">
            <p>Number of class members :' . " " . $students . '</p>
        </div>
        <iframe src="mydetails.php" style="background-color: white; border:none; width:100%; height:400px;"></iframe>
        <div id="myChart">
            <h4><span class="blue">Number of papers : </span> <span class="big blue">' . $numberOfPaper . '/20</span></h4>
            <h4><span>Number of tests completed : </span> <span class="">' . $PapersCount . '</span> </h4>
            <h4><span>Number of tests available : </span> <span class="">' . round($AvPaper, 1) . '</span> </h4>
            <h4><span>Absent papers : </span> <span class="">' . $Papersabsent . '</span> </h4>
            <h4><span>Suspended tests : </span> <span class="">' . $Papersuspend . '</span> </h4>
            <h4><span>lowest score : </span> <span class="red">' . round($lowest, 1) . '%</span> </h4>
            <h4><span>Best score : </span> <span class="big blue">' . round($highst, 1) . '%</span> </h4>
            <h4><span>Expected marks for the next paper : </span> <span class="big">' . $AVScore . '%</span> </h4>
            <h4 class="av ' . " " . $red . '"><span class="big blue">Your average pass : </span> <span class="big blue"> ' . $AVpass . ' </span> </h4>
            <p><a id="more">More details...</a></p>
        </div>
    </div>';
    } elseif ($verifyUser == 3) {
        echo '<div class="profilMain">
            <div class="viewProfile">
            <div class="pic">
                    <a href="#"><div class="picalin">
                            <img src="admin/students/' . $Pro_pic . '" alt="user">
                            <div id="chang"><i class="fa-solid fa-camera"></i></a></div>
                        </div></a>
                    </div>
            <div class="myDetails">' .
            '<p><b>USER ID:</b>' . $_SESSION['ID'] . '</p>
                <p><b>Name :</b>' . $First_name . " " . $Last_name . '</p>
                <p><b>Class:</b>' . $Class . '</p>
                <p><b>Email:</b>' . $_SESSION['E_mail'] . '</p>
                <p> <span style="color: red;"><b>NOT VERIFIED </b></span> <span style="color: darkblue;">( pending... )</span> </p>
                <br>
                <p><a href="update"><i class="fa-solid fa-pen-to-square"></i>  Upload image & Edit Details.</a></p>
            </div>
        </div>
                    <div class="viewProfile2 margin">
                        <i class="fa-regular fa-clock fa-shake"></i>
                        <p>Your account has not been verified. Your teacher is reviewing your account. Please wait 24 hours to activate your account</p><br>
                        <a href="index"> OK </a>
                        <br>
                    </div>
                </div>';
    } elseif ($verifyUser == 2) {
        echo '<div class="profilMain">
            <div class="viewProfile">
            <div class="pic">
                    <a href="#"><div class="picalin">
                            <img src="admin/students/' . $Pro_pic . '" alt="user">
                            <div id="chang"><i class="fa-solid fa-camera"></i></a></div>
                        </div></a>
                    </div>
            <div class="myDetails">' .
            '<p><b>USER ID:</b>' . $_SESSION['ID'] . '</p>
                <p><b>Name :</b>' . $First_name . " " . $Last_name . '</p>
                <p><b>Class:</b>' . $Class . '</p>
                <p><b>Email:</b>' . $_SESSION['E_mail'] . '</p>
                <p> <span style="color: red;"><b> Suspended user ! </b></span> </p>
                <br>
                <p><a href="update"><i class="fa-solid fa-pen-to-square"></i>  Upload image & Edit Details.</a></p>
            </div>
        </div>
                    <div class="viewProfile2 margin">
                    <i class="fa-solid fa-triangle-exclamation fa-fade" style="color: #ff0000;"></i>
                        <p>Your account has been suspended.</p><br>
                        <a href="index"> OK </a>
                        <br>
                    </div>
                </div>';
    } else {
        echo '<div class="profilMain">
                    <div class="viewProfile2">
                        <i class="fa-solid fa-right-from-bracket fa-shake"></i>
                        <p>Please login first. Then enjoy the facilities.</p>
                        <br>
                        <p> <a href="login"> Log in here. </a> </p>
                    </div>
                </div>';
    }
    ?>

    <br><br>

    <!-- homework list  -->
    <?php
    if (isset($_SESSION['userID_Name'])) {
        $homework = "SELECT * FROM homework WHERE User_ID = '{$_SESSION['userID_Name']}' ORDER BY ID DESC LIMIT 2";
        $homework_result = mysqli_query($connection, $homework);
        if (mysqli_num_rows($homework_result) > 0) {
            echo "<div class='homework-list'>";
            echo "<h2 style='text-align: center;'> Submitted homework </h2> <br>";
            echo "<div class='homework-list-align'>";
            while ($homework_list = mysqli_fetch_assoc($homework_result)) {
                $ID1 = $homework_list['ID'];
                $Title = $homework_list['Title'];
                $File_Name = $homework_list['File_Name'];
                $Date_Time = $homework_list['Date_Time'];

                echo "<ul>
                    <li><b>Title :</b> {$Title} </li>
                    <li><b>Date :</b> {$Date_Time} </li>
                    <br>
                    <li> <a href='index.php?deleteDOC={$ID1}&name={$File_Name}'> Delete </a> </li>
                </ul>";
            }
            echo "</div>";
            echo "<br><br>";
            echo "<p id='showAllBTN'><a href='#'> Show All </a></p>";
            echo "</div>";
        }
    }
    ?>

    <div class="Allhomework">
        <?php
        if (isset($_SESSION['userID_Name'])) {
            $homework2 = "SELECT * FROM homework WHERE User_ID = '{$_SESSION['userID_Name']}' ORDER BY ID DESC";
            $homework2_result = mysqli_query($connection, $homework2);

            if (mysqli_num_rows($homework2_result) > 0) {
                echo "<div class='myPaper'>";
                echo "<i class='fa-solid fa-xmark closeBTN'></i>";
                echo "<br> <br>";
                echo "<h2 style='text-align: center;'> Submitted homework </h2> <br>";
                echo "<div class='homework-list-align'>";
                while ($homework2_list = mysqli_fetch_assoc($homework2_result)) {
                    $ID2 = $homework2_list['ID'];
                    $Title2 = $homework2_list['Title'];
                    $File_Name2 = $homework2_list['File_Name'];
                    $Date_Time2 = $homework2_list['Date_Time'];

                    echo "<ul style ='box-shadow: 2px 5px 10px var(--shadow);'>
                    <li><b>Title :</b> {$Title2} </li>
                    <li><b>Date :</b> {$Date_Time2} </li>
                    <br>
                    <li> <a href='index.php?deleteDOC={$ID2}&name={$File_Name2}'> Delete </a> </li>
                </ul>";
                }
                echo "</div>";
                echo "<br><br>";
                echo "</div>";
            }
        }
        ?>
    </div>

    <!-- All paper score list -->
    <div class="myPaperAling">
        <?php
        if (isset($_SESSION['userID_Name'])) {
            $papers = "SELECT * FROM score WHERE User_ID = '{$_SESSION['userID_Name']}' ORDER BY Test";
            $papersQuery    =   mysqli_query($connection, $papers);
            $paperTable = '<table>';
            $paperTable .= '<tbody>';
            while ($paper = mysqli_fetch_assoc($papersQuery)) {
                $paperTable .= '<tr>';
                $paperTable .= '<td> <i class="fa-solid fa-trophy" style="color: #002f99;"></i> </td>';
                $paperTable .= '<td>' . $paper['Test'] . '</td>';
                $paperTable .= '<td>' . round($paper['Score'], 1) . "%" . '</td>';
                $paperTable .= '</tr>';
            }
            $paperTable .= '</tbody>';
            $paperTable .= '</table>';
        }
        ?>

        <div class="myPaper">
            <i class="fa-solid fa-xmark closeBTN"></i>
            <h1> My all score </h1>
            <hr>
            <div class="scoreList">
                <?php echo $paperTable; ?>
            </div>
        </div>
    </div>
    <div class="space"></div>
    <div class="space"></div>

    <script src="assect/js/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        var paperView = true;
        $(".myPaperAling").css("display", "none");
        $("#more").click(function() {
            if (paperView = true) {
                $(".myPaperAling").css("display", "flex");
                $(".myPaper").css("display", "block");
            }
        });

        $(".closeBTN").click(function() {
            if (paperView = true) {
                $(".myPaperAling").css("display", "none");
                $(".Allhomework").css("display", "none");
            }
        });

        $("#showAllBTN").click(function() {
            if (paperView = true) {
                $(".Allhomework").css("display", "flex");
            }
        });

        $(".picalin").click(function() {
            $(".viewPic").css("display", "flex");
        });

        $(".viewPic").click(function() {
            $(".viewPic").css("display", "none");
        });

        $("#viewPic").click(function() {
            $(".picViewaful").css("display", "flex");
        });

        $(".picViewaful").click(function() {
            $(".picViewaful").css("display", "none");
        });

        $(".wait").click(function() {
            $("#wait").css("display", "block");
        });
    </script>
</body>