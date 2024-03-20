<div class="eventAlin">
    <h2> EVENTS </h2>
    <p> UPCOMING EVENTS AND EXTRACURRICULAR ACTIVITIES </p>
    <div class="eventContent">
        <?php
        // banner fetch 
        include("includes/connection.php");
        $event = "SELECT * FROM image_table WHERE `Status` = 2";
        $event_result = mysqli_query($connection, $event);
        if (mysqli_num_rows($event_result) > 0) {
            while ($event_image = mysqli_fetch_assoc($event_result)) {
                echo "<div class='event-details'>
                <div class='eventIMG'>
                    <img src='events/{$event_image['Image_name']}' alt='event photo'>
                </div>
                <div class='event-discription'>
                    <p> {$event_image['Discription']} </p>
                </div>
            </div>
            <br>";
            }
        } else {
            echo "<div class='event-details'>
                <div class='eventIMG'>
                    <img src='https://placehold.co/1600x900' alt='event photo'>
                </div>
                <div class='event-discription'>
                    <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo exercitationem recusandae dolores. Magni, repudiandae, architecto recusandae odio molestias quibusdam ab dolorem laboriosam facere qui voluptate maiores aut a eaque ipsam. </p>
                </div>
            </div>
            <br>";

            echo "<div class='event-details'>
                <div class='eventIMG'>
                    <img src='https://placehold.co/1600x900' alt='event photo'>
                </div>
                <div class='event-discription'>
                    <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo exercitationem recusandae dolores. Magni, repudiandae, architecto recusandae odio molestias quibusdam ab dolorem laboriosam facere qui voluptate maiores aut a eaque ipsam. </p>
                </div>
            </div>
            <br>";
        }
        ?>
    </div>
</div>
<?php
include "includes/footer.php";
?>
<div class="space"></div>
<div class="space2"></div>

<script src="assect/js/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.cycle2/2.1.6/jquery.cycle2.min.js" integrity="sha512-lvcHFfj/075LnEasZKOkj1MF6aLlWtmpFEyd/Kc+waRnlulG5er/2fEBA5DBff4BZrcwfvnft0PiAv4cIpkjpw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>