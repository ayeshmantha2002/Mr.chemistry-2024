<?php
// securuty
include "../../includes/connection.php";
if (isset($_SESSION['ID'])) {
    if ($_SESSION['ID'] >= 2) {
        header("location: ../../index");
    }
} else {
    header("location: ../../index");
}

if (isset($_GET['class'])) {
    // $user =  mysqli_real_escape_string($connection, $_GET['user']);
    // $score = mysqli_real_escape_string($connection, $_GET['score']);
    $class = mysqli_real_escape_string($connection, $_GET['class']);
    $test = mysqli_real_escape_string($connection, $_GET['test']);

    $Category = "class={$class}";
}

$all_score = 0;

$avScore = "SELECT * FROM score WHERE Class = '{$class}' AND Test = '{$test}'";
$avScore_result = mysqli_query($connection, $avScore);
if (mysqli_num_rows($avScore_result) > 0) {
    $students = mysqli_num_rows($avScore_result);
    $total = 0;
    while ($fetchScore = mysqli_fetch_assoc($avScore_result)) {
        $total += $fetchScore['Score'];
    }
    $avarage_score = $total / $students;

    $update_av = "UPDATE score SET Average = {$avarage_score} WHERE Class = '{$class}' AND Test = '{$test}'";
    $update_av_result = mysqli_query($connection, $update_av);

    if ($update_av_result) {
        if (isset($_GET['quick'])) {
            header("location: quick-score.php?class={$class}&paper={$test}");
        } else {
            header("location: add-score.php?insert=done&{$Category}");
        }
    }
}
