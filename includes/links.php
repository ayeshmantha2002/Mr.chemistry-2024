<div class="classList">
    <h2> Join Whatsapp Group </h2>
    <div class="classListBack">
        <?php
        $link = "SELECT * FROM `links` LIMIT 4";
        $link_result = mysqli_query($connection, $link);
        if (mysqli_num_rows($link_result) > 0) {
            while ($list_links = mysqli_fetch_assoc($link_result)) {
                $linkClass = $list_links['Class'];
                $linkCatagory = $list_links['Catagory'];
                $linkLink = $list_links['Link'];

                echo "<a onclick='loadingEffect()' href='{$linkLink}'>{$linkClass}<br>{$linkCatagory}</a>";
            };
        };

        $linkFB = "SELECT * FROM `links` WHERE `ID` = 5";
        $linkFB_result = mysqli_query($connection, $linkFB);
        if (mysqli_num_rows($linkFB_result) == 1) {
            $FBLink = mysqli_fetch_assoc($linkFB_result);

            echo "<a id='fb' onclick='loadingEffect()' href='{$FBLink['Link']}'>පන්ති පිළිබද විස්තර සහ නවතම තොරතුරු දැනුවත් වීම සදහා Facebook සමුහයට එක්වන්න.</a>";
        }


        ?>
    </div>
</div>