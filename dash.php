<?php
include("includes/connection.php");

$scoreTable01 = "";
$scoreTable02 = "";
$scoreTable03 = "";

// header title
echo '<div class="lable">
        <div class="lableAling">
            <h2> Mr.ChemistrY </h2>
            <p>Mr.ChemistrY - Chemistry <span style="font-family: Noto Sans Sinhala; font-weight: bold;"> වලට තවත් නමක් </span> </p>
        </div>
    </div>';

// A/L result list
$ALYear = "SELECT * FROM al_result ORDER BY `Year` DESC LIMIT 1";
$resultALYear = mysqli_query($connection, $ALYear);
if ($resultALYear) {
    if (mysqli_num_rows($resultALYear) > 0) {
        $yearFetch = mysqli_fetch_assoc($resultALYear);
        $year = $yearFetch['Year'];

        $ALResult = "SELECT * FROM al_result WHERE `Year` = {$year} ORDER BY `chemisty_Result`";
        $resultALResult = mysqli_query($connection, $ALResult);

        if ($resultALResult) {
            if (mysqli_num_rows($resultALResult) > 0) {
                $ALlistUser = '<div class="alUser">';
                while ($details = mysqli_fetch_assoc($resultALResult)) {
                    $ALlistUser .= '<div class="card">';
                    $ALlistUser .=    '<img src="admin/students/' . $details['img'] . '" alt="profile pic">';
                    $ALlistUser .=    '<div class="resultAlign">';
                    $ALlistUser .=        '<h5>' . $details['Name'] . '</h5>';
                    $ALlistUser .=        '<h5>' . $details['Year'] . ' A/L </h5>';
                    $ALlistUser .=        '<h5> INDEX - ' . $details['Index_number'] . ' </h5>';
                    $ALlistUser .=        '<h4><b> Result<br><div class="pass">' . $details['physics_Result'] . ' <span class="combindeResult">' . $details['chemisty_Result'] . '</span> ' . $details['combinde_Result'] . '</div></b></h4>';
                    $ALlistUser .=    '</div>';
                    $ALlistUser .= '</div>';
                }
                $ALlistUser .= '</div>';

                echo "<div id='AlCard'>" .
                    $ALlistUser
                    . "</div>";
            }
        }
    }
}

echo '<div class="cover">';
echo '<div class="rankList">';

// filter last 03 year in tbl_register table
$checkClass = "SELECT DISTINCT(Class) FROM `tbl_register` ORDER BY Class DESC LIMIT 3;";
$resutCheckClass = mysqli_query($connection, $checkClass);

if ($resutCheckClass) {
    $class01 = mysqli_fetch_assoc($resutCheckClass);
    $class02 = mysqli_fetch_assoc($resutCheckClass);
    $class03 = mysqli_fetch_assoc($resutCheckClass);

    // filter last test one
    $checkTest = "SELECT DISTINCT(Test) FROM `score` WHERE Class = {$class01['Class']} ORDER BY Test DESC LIMIT 1;";
    $resutChecktest = mysqli_query($connection, $checkTest);

    if ($resutChecktest) {
        if (mysqli_num_rows($resutChecktest) == 1) {
            $testNunberfetch = mysqli_fetch_assoc($resutChecktest);
            $testNunber = $testNunberfetch['Test'];

            $place = "SELECT * FROM score WHERE Test = '{$testNunber}' AND Class = {$class01['Class']} ORDER BY Score DESC LIMIT 3";
            $placeResult = mysqli_query($connection, $place);

            $last_then_plase = "SELECT * FROM score WHERE Class = {$class01['Class']} AND Test = '{$testNunber}'";
            $last_then_plase_result = mysqli_query($connection, $last_then_plase);

            if ($placeResult) {
                $rank = 1;
                $listUser = "<ul>";
                $listUser .= "<h2>" . $class01['Class'] . "</h2>";
                while ($fetchUser = mysqli_fetch_assoc($placeResult)) {
                    $listUser .= "<div class='rankUser'>";
                    $listUser .= "<li>" . '<img src="admin/students/'  . $fetchUser['Pro_pic'] . '" alt="profile pic">' . "</li>";
                    $listUser .= "<li class='medle fa-beat'>" . '<img src="admin/img/' . $rank++ . '.png" alt="rank">' . "</li>";
                    $listUser .= "<li>" . $fetchUser['Full_name'] . "</li>";
                    $listUser .= "<li>" . $fetchUser['Class'] . " " . $fetchUser['Category'] . "</li>";
                    $listUser .= "<li>" . $fetchUser['Test'] . "</li>";
                    $listUser .= "<li class='scoreView'>" . round($fetchUser['Score'], 1) . "%" . "</li>";
                    $listUser .= "</div>";
                }
                $listUser .= "</ul>";
            }

            if ($last_then_plase_result) {
                $scoreTable01 = "<h3>" . $class01['Class'] . "</h3>";
                $scoreTable01 .= "<table>";
                $scoreTable01 .= "<thead>";
                $scoreTable01 .= "<tr>";
                $scoreTable01 .= "<th>Place</th>";
                $scoreTable01 .= "<th>Name</th>";
                $scoreTable01 .= "<th>Paper</th>";
                $scoreTable01 .= "<th>Score</th>";
                $scoreTable01 .= "</tr>";
                $scoreTable01 .= "</thead>";
                $scoreTable01 .= "<tbody>";
                $placeNumber = 1;
                while ($userThree = mysqli_fetch_assoc($last_then_plase_result)) {
                    $scoreTable01 .= "<tr>";
                    $scoreTable01 .= "<td>" . $placeNumber++ . "</td>";
                    $scoreTable01 .= "<td>" . $userThree['Full_name'] . "</td>";
                    $scoreTable01 .= "<td>" . $userThree['Test'] . "</td>";
                    $scoreTable01 .= "<td>" . round($userThree['Score'], 1) . "%" . "</td>";
                    $scoreTable01 .= "</tr>";
                }
                $scoreTable01 .= "</tbody>";
                $scoreTable01 .= "</table>";
            }

            echo $listUser;
        };
    }

    // filter last test tow
    if ($class02 > 0) {
        $checkTest = "SELECT DISTINCT(Test) FROM `score` WHERE Class = {$class02['Class']} ORDER BY Test DESC LIMIT 1;";
        $resutChecktest = mysqli_query($connection, $checkTest);

        if ($resutChecktest) {
            if (mysqli_num_rows($resutChecktest) == 1) {
                $testNunberfetch = mysqli_fetch_assoc($resutChecktest);
                $testNunber = $testNunberfetch['Test'];

                $place = "SELECT * FROM score WHERE Test = '{$testNunber}' AND Class = {$class02['Class']} ORDER BY Score DESC LIMIT 3";
                $placeResult = mysqli_query($connection, $place);

                $last_then_plase2 = "SELECT * FROM score WHERE Class = {$class02['Class']} AND Test = '{$testNunber}'";
                $last_then_plase2_result = mysqli_query($connection, $last_then_plase2);

                if ($placeResult) {
                    $rank = 1;
                    $listUser = "<ul>";
                    $listUser .= "<h2>" . $class02['Class'] . "</h2>";
                    while ($fetchUser = mysqli_fetch_assoc($placeResult)) {
                        $listUser .= "<div class='rankUser'>";
                        $listUser .= "<li>" . '<img src="admin/students/'  . $fetchUser['Pro_pic'] . '" alt="profile pic">' . "</li>";
                        $listUser .= "<li class='medle fa-beat'>" . '<img src="admin/img/' . $rank++ . '.png" alt="rank">' . "</li>";
                        $listUser .= "<li>" . $fetchUser['Full_name'] . "</li>";
                        $listUser .= "<li>" . $fetchUser['Class'] . " " . $fetchUser['Category'] . "</li>";
                        $listUser .= "<li>" . $fetchUser['Test'] . "</li>";
                        $listUser .= "<li class='scoreView'>" . round($fetchUser['Score'], 1) . "%" . "</li>";
                        $listUser .= "</div>";
                    }
                    $listUser .= "</ul>";
                }

                if ($last_then_plase2_result) {
                    $scoreTable02 = "<h3>" . $class02['Class'] . "</h3>";
                    $scoreTable02 .= "<table>";
                    $scoreTable02 .= "<thead>";
                    $scoreTable02 .= "<tr>";
                    $scoreTable02 .= "<th>Place</th>";
                    $scoreTable02 .= "<th>Name</th>";
                    $scoreTable02 .= "<th>Paper</th>";
                    $scoreTable02 .= "<th>Score</th>";
                    $scoreTable02 .= "</tr>";
                    $scoreTable02 .= "</thead>";
                    $scoreTable02 .= "<tbody>";
                    $placeNumber = 1;
                    while ($userThree = mysqli_fetch_assoc($last_then_plase2_result)) {
                        $scoreTable02 .= "<tr>";
                        $scoreTable02 .= "<td>" . $placeNumber++ . "</td>";
                        $scoreTable02 .= "<td>" . $userThree['Full_name'] . "</td>";
                        $scoreTable02 .= "<td>" . $userThree['Test'] . "</td>";
                        $scoreTable02 .= "<td>" . round($userThree['Score'], 1) . "%" . "</td>";
                        $scoreTable02 .= "</tr>";
                    }
                    $scoreTable02 .= "</tbody>";
                    $scoreTable02 .= "</table>";
                }

                echo $listUser;
            };
        }
    }

    // filter last test three
    if ($class03 >= 1) {
        $checkTest = "SELECT DISTINCT(Test) FROM `score` WHERE Class = {$class03['Class']} ORDER BY Test DESC LIMIT 1;";
        $resutChecktest = mysqli_query($connection, $checkTest);

        if ($resutChecktest) {
            if (mysqli_num_rows($resutChecktest) == 1) {
                $testNunberfetch = mysqli_fetch_assoc($resutChecktest);
                $testNunber = $testNunberfetch['Test'];

                $place = "SELECT * FROM score WHERE Test = '{$testNunber}' AND Class = {$class03['Class']} ORDER BY Score DESC LIMIT 3";
                $placeResult = mysqli_query($connection, $place);

                $last_then_plase3 = "SELECT * FROM score WHERE Class = {$class02['Class']} AND Test = '{$testNunber}'";
                $last_then_plase3_result = mysqli_query($connection, $last_then_plase3);

                if ($placeResult) {
                    $rank = 1;
                    $listUser = "<ul>";
                    $listUser .= "<h2>" . $class03['Class'] . "</h2>";
                    while ($fetchUser = mysqli_fetch_assoc($placeResult)) {
                        $listUser .= "<div class='rankUser'>";
                        $listUser .= "<li>" . '<img src="admin/students/'  . $fetchUser['Pro_pic'] . '" alt="profile pic">' . "</li>";
                        $listUser .= "<li class='medle fa-beat'>" . '<img src="admin/img/' . $rank++ . '.png" alt="rank">' . "</li>";
                        $listUser .= "<li>" . $fetchUser['Full_name'] . "</li>";
                        $listUser .= "<li>" . $fetchUser['Class'] . " " . $fetchUser['Category'] . "</li>";
                        $listUser .= "<li>" . $fetchUser['Test'] . "</li>";
                        $listUser .= "<li class='scoreView'>" . round($fetchUser['Score'], 1) . "%" . "</li>";
                        $listUser .= "</div>";
                    }
                    $listUser .= "</ul>";
                }

                if ($last_then_plase3_result) {
                    $scoreTable03 = "<h3>" . $class03['Class'] . "</h3>";
                    $scoreTable03 .= "<table>";
                    $scoreTable03 .= "<thead>";
                    $scoreTable03 .= "<tr>";
                    $scoreTable03 .= "<th>Place</th>";
                    $scoreTable03 .= "<th>Name</th>";
                    $scoreTable03 .= "<th>Paper</th>";
                    $scoreTable03 .= "<th>Score</th>";
                    $scoreTable03 .= "</tr>";
                    $scoreTable03 .= "</thead>";
                    $scoreTable03 .= "<tbody>";
                    $placeNumber = 1;
                    while ($userThree = mysqli_fetch_assoc($last_then_plase3_result)) {
                        $scoreTable03 .= "<tr>";
                        $scoreTable03 .= "<td>" . $placeNumber++ . "</td>";
                        $scoreTable03 .= "<td>" . $userThree['Full_name'] . "</td>";
                        $scoreTable03 .= "<td>" . $userThree['Test'] . "</td>";
                        $scoreTable03 .= "<td>" . round($userThree['Score'], 1) . "%" . "</td>";
                        $scoreTable03 .= "</tr>";
                    }
                    $scoreTable03 .= "</tbody>";
                    $scoreTable03 .= "</table>";
                }

                echo $listUser;
            };
        }
    }
}



echo '</div>';
echo "<h2 id='topTen'> Top 10 </h2>";
echo '<div class="classList">
    <div class="classListBack2 userScoreTable">
        ' . $scoreTable01 . $scoreTable02 . $scoreTable03 . '
    </div>
</div>';

include "includes/timetable.php";

$All = "SELECT * FROM tbl_register";
$allResult = mysqli_query($connection, $All);
if ($allResult) {
    $allUser = mysqli_num_rows($allResult);
}

$echo = '<div class="userDash">
    <div class="count">
        <h2> All Students </h2>
        <h3>' . $allUser . '</h3>
    </div>

    <div class="count">
        <a href="#">
            <h3> <i class="fa-brands fa-android fa-bounce fa-lg" style="color: #00ad3a;"></i> </h3>
            <h2 style="text-align: center; color: #545454;"> Android App Download </h2>
        </a>
    </div>

    <div class="count">
        <a href="#">
            <h3> <i class="fa-brands fa-apple fa-lg" style="color: #b0b0b0;"></i> </h3>
            <h2 style="text-align: center; color: #545454;"> IOS App Download </h2>
        </a>
    </div>';
include "includes/footer.php";
echo '<div class="space2"></div>
    </div>';

echo '<div class="space"></div></div>';
