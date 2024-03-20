<?php
include("../includes/connection.php");

if (isset($_SESSION['Class'])) {
    $Timeclass = $_SESSION['Class'];
} else {
    $Timeclass = 2000;
}

$timer = "SELECT * FROM `timer` WHERE `Class` = {$Timeclass}";
$timer_result = mysqli_query($connection, $timer);

if (mysqli_num_rows($timer_result) > 0) {
    $fetchTime = mysqli_fetch_assoc($timer_result);

    $mytime = $fetchTime['End_time'];
    $start_time = $fetchTime['Start_time'];

    $diff = time() - $start_time;
    $diff = $mytime - $diff;

    $houre = floor($diff / 3600);
    $minute = ((int)($diff / 60) % 60);
    $seconds = $diff % 60;

    if ($seconds <= 9) {
        $seconds2 = "0" . $diff % 60;
    } else {
        $seconds2 = $diff % 60;
    }

    if ($minute <= 9) {
        $minute2 = "0" . ((int)($diff / 60) % 60);
    } else {
        $minute2 = ((int)($diff / 60) % 60);
    }

    $show = $houre . " : " . $minute2 . " : " . $seconds2;

    if ($diff == 0 || $diff < 0) {
        $delet_Item = "DELETE FROM `timer` WHERE Class={$Timeclass} LIMIT 1";
        $delet_Item_result = mysqli_query($connection, $delet_Item);
    } else {
        echo "<div class='list error-messages'>
            <a style='position: relative;'>
                <div class='first'>
                    <h3> Submit Homework </h3>
                    <img src='assect/img/content/model4.jpg' alt='fast paper'>
                </div>
                <p style='padding: 10px;
                    text-align: center;
                    position: absolute;
                    bottom: 0;
                    width: 100%;
                    transform: translateY(20px);
                    box-sizing: border-box;
                    font-weight: bold;
                    color: red;'>
                    {$show}
                </p>
            </a>
            </div>";
    }
}
