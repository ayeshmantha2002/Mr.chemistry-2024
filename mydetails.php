<?php
include("includes/connection.php");

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
};

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assect/css/index.css">
    <link rel="stylesheet" href="assect/css/register.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            packages: ['corechart', 'bar']
        });
        google.charts.setOnLoadCallback(drawAxisTickColors);

        function drawAxisTickColors() {
            var data = google.visualization.arrayToDataTable([
                ['Test', 'Your Score', 'Average Score'],
                <?php

                $query_score  =   "SELECT * FROM score WHERE User_ID ={$_SESSION['ID']} AND Class = '{$Class}' AND Status = 1 ORDER BY ID DESC LIMIT 0, 6";
                $result_score =    mysqli_query($connection, $query_score);

                if (mysqli_num_rows($result_score)) {
                    while ($score = mysqli_fetch_assoc($result_score)) {
                        echo "['" . $score['Test'] . "'," . $score['Score'] . ", ".$score['Average']."],";
                    };
                } else {
                    echo "['No Records', 0, 0],";
                }
                ?>
            ]);

            var options = {
                title: 'My average score on the last six tests',
                chartArea: {
                    width: '50%'
                },
                hAxis: {
                    title: 'Score',
                    minValue: 0,
                    maxValue: 100,
                    textStyle: {
                        bold: true,
                        fontSize: 12,
                        color: '#4d4d4d'
                    },
                    titleTextStyle: {
                        bold: true,
                        fontSize: 18,
                        color: '#4d4d4d'
                    }
                },
                vAxis: {
                    // title: 'Number of test',
                    textStyle: {
                        fontSize: 14,
                        bold: true,
                        color: '#848484'
                    },
                    titleTextStyle: {
                        fontSize: 14,
                        bold: true,
                        color: '#848484'
                    }
                }
            };
            var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>
</head>

<body>
    <div id="chart_div" style="height: 400px;"></div>
</body>

</html>