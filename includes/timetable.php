<?php
$time_table = "SELECT * FROM time_table";
$time_table_result = mysqli_query($connection, $time_table);

$class = "SELECT DISTINCT(Year) FROM time_table ORDER BY Year DESC LIMIT 3";
$class_result = mysqli_query($connection, $class);
?>

<div class="classList">
    <?php
    echo '<h2> <span class="blue">';
    if (mysqli_num_rows($class_result) > 0) {
        while ($class_list = mysqli_fetch_assoc($class_result)) {
            echo $class_list['Year'] . "/";
        }
    }
    echo 'THEORY REVISION </span> <span class="sinhala">පන්ති සදහා කාල සටහන</span> </h2>';
    ?>
    <div class="trophi">
        <img src="/admin/img/trophi.jpg" alt="time table">
        <div class="classListBack2">
            <?php
            if (mysqli_num_rows($time_table_result) > 0) {
                while ($timeTable = mysqli_fetch_assoc($time_table_result)) {
                    $Year = $timeTable['Year'];
                    $Category = $timeTable['Category'];
                    $Time = $timeTable['Time'];
                    echo "<li><span class='blue'><b>{$Year} {$Category}</b></span> - <span class='sinhala'>[ {$Time} ]</span></li>";
                }
            }
            ?>
        </div>
    </div>
</div>