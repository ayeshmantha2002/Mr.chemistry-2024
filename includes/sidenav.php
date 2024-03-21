<?php

if (isset($_SESSION['ID'])) {
    $User   =   "SELECT * FROM tbl_register WHERE ID = {$_SESSION['ID']} LIMIT 1";
    $query  =   mysqli_query($connection, $User);
    if ($query) {
        if (mysqli_num_rows($query) == 1) {
            $user_details   =   mysqli_fetch_assoc($query);
            $firstName =   $user_details['First_name'];
            $lastName =   $user_details['Last_name'];
            $Confirm_user =   $user_details['Confirm_user'];
            $userPic =   $user_details['Pro_pic'];

            if ($Confirm_user == 1) {
                $activeSatus    =   "Verified user";
            } elseif ($Confirm_user == 2) {
                $activeSatus    =   " Suspended user";
            } else {
                $activeSatus    =   "Not verified user";
            }
        }
    }
}

?>

<div class="sideNav">
    <div class="sideNavAling">
        <li id="side_logo" style="padding: 15px 0 0 5px; list-style: none;">
            <div class="logo" style="width: 185px;">
                <h3 title="Mr.ChemistrY"> <i class="fa-solid fa-bars" id="navClick2" style="color: var(--text-blue);
                padding-right: 15px;
                font-size: 25px;
                transform: translateY(4px);
                cursor: pointer;"></i> Mr.ChemistrY<span id="maths">.lk </span> </h3>
                <p> NIPUN PALLIYAGURU </p>
            </div>
        </li>

        <?php
        if (isset($_SESSION['ID'])) {
            echo '<div class="myDetailsMin">
                        <a class="profilNav"><p><img src="admin/students/' . $userPic . '" alt="profile pic"></p></a>
                        <p>User ID :' . " " . $_SESSION['userID_Name'] . '</p>
                        <p>' . $firstName . " " . $lastName . '</p>
                        <p style="font-size: 12px;">' . $activeSatus . '</p>
                        <p><a href="logout.php">Logout <i class="fa-solid fa-right-from-bracket"></i></a></p>
                    </div>';
        }
        ?>
        <ul>
            <li>
                <a href="index" class="homeNav" title="Mr.ChemistrY - Home">
                    <ion-icon name="home-outline"></ion-icon>
                    Home
                </a>
            </li>
            <div id="bottomView">
                <li>
                    <a class="profilNav" title="Mr.ChemistrY - My profil">
                        <ion-icon name="person-outline"></ion-icon>
                        My Profil
                    </a>
                </li>
                <li><a class="dashNav" title="Mr.ChemistrY - Dashboad">
                        <ion-icon name="stats-chart-outline"></ion-icon>
                        Dashboad</a>
                </li>
                <li><a class="notificationNav" title="Mr.ChemistrY - Notification">
                        <ion-icon name="notifications-circle-outline"></ion-icon>
                        Notification</a>
                </li>
                <li><a class="notesNav" title="Mr.ChemistrY - My Notes">
                        <ion-icon name="document-outline"></ion-icon>
                        My Notes
                    </a>
                </li>
            </div>
            <li><a class="eventNav" title="Mr.ChemistrY - Events">
                    <ion-icon name="golf-outline"></ion-icon>
                    Events</a>
            </li>
            <li><a href="map" class="mapNav" title="Mr.ChemistrY - Map">
                    <ion-icon name="map-outline"></ion-icon>
                    Map</a>
            </li>
            <li><a class="infoNav" title="Mr.ChemistrY - Infomation">
                    <ion-icon name="information-circle-outline"></ion-icon>
                    Infomation</a>
            </li>
            <li><a href="contact" class="contactNav" title="Mr.ChemistrY - contact Us">
                    <ion-icon name="call-outline"></ion-icon>
                    contact Us</a>
            </li>


            <?php
            if (isset($_SESSION['ID'])) {
                if ($Confirm_user == 1) {
                    echo '<li><a href="ai" class="aiai" title="Mr.ChemistrY - AI">
                            <i class="fa-solid fa-brain"></i>
                            Ai Calculator</a>
                        </li>';
                }
            }
            ?>



        </ul>
        <br><br>
        <?php
        if (!isset($_SESSION['ID'])) {
            echo '<div class="sideRegister">
                    <li class="hide"><a href="register">Register</a></li>
                    <li class="hide"><a href="login">Log in</a></li>
                </div>';
        } else {
            if ($_SESSION['ID'] == 1 || $_SESSION['ID'] == 2 || $_SESSION['ID'] == 3) {
                // echo '<div class="sideRegister"><ul><li><a href="admin/admin.php">Admin</a></li></ul></div>';
            }
        }
        ?>
        <div class="space"></div>
    </div>
</div>