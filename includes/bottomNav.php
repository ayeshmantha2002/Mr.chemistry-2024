<?php
if (isset($_SESSION['ID'])) {
    $Notification = "SELECT `Notification` FROM `tbl_register` WHERE ID = {$_SESSION['ID']}";
    $NotificationResult = mysqli_query($connection, $Notification);
    if (mysqli_num_rows($NotificationResult) == 1) {
        $value = mysqli_fetch_assoc($NotificationResult);
        $NotiValue = $value['Notification'];
        if ($NotiValue == 1) {
            $display = "display: block;";
        } else {
            $display = "display: none;";
        }
    }
} else {
    $display = "display: none;";
}

if (isset($_GET['status'])) {
    echo "<div class='bottomNav'>
        <div class='bottomAling'>
            <ul>
                <li class='bottomList'>
                    <a href='#' class='profilNav'>
                        <span class='icon'><ion-icon name='person-outline'></ion-icon></span>
                        <span class='text'>Profile</span>
                    </a>
                </li>
                <li class='bottomList'>
                    <a href='#' class='dashNav'>
                        <span class='icon'><ion-icon name='stats-chart-outline'></ion-icon></span>
                        <span class='text'>dashboard</span>
                    </a>
                </li>
                <li class='bottomList'>
                    <a href='index' class='homeNav'>
                        <span class='icon'><ion-icon name='home-outline'></ion-icon></span>
                        <span class='text'>Home</span>
                    </a>
                </li>
                <li class='bottomList'>
                    <a href='#' class='notificationNav'>
                    <div style='
                    position: absolute;
                    $display
                    width: 10px;
                    height: 10px;
                    background-color: red;
                    border-radius: 50%;
                    top: 10px;
                    right: 18px;
                    border: 1px solid #fff;'>
                    </div>
                        <span class='icon'><ion-icon name='notifications-circle-outline'></ion-icon></span>
                        <span class='text'>Notification</span>
                    </a>
                </li>
                <li class='bottomList active'>
                    <a href='#' class='notesNav'>
                        <span class='icon'><i class='fa-regular fa-note-sticky'></i></span>
                        <span class='text'>My Notes</span>
                    </a>
                </li>
                <div class='indicator'></div>
            </ul>
        </div>
    </div>";
} elseif (isset($_GET['update'])) {
    echo "<div class='bottomNav'>
        <div class='bottomAling'>
            <ul>
                <li class='bottomList active'>
                    <a href='#' class='profilNav'>
                        <span class='icon'><ion-icon name='person-outline'></ion-icon></span>
                        <span class='text'>Profile</span>
                    </a>
                </li>
                <li class='bottomList'>
                    <a href='#' class='dashNav'>
                        <span class='icon'><ion-icon name='stats-chart-outline'></ion-icon></span>
                        <span class='text'>dashboard</span>
                    </a>
                </li>
                <li class='bottomList'>
                    <a href='index' class='homeNav'>
                        <span class='icon'><ion-icon name='home-outline'></ion-icon></span>
                        <span class='text'>Home</span>
                    </a>
                </li>
                <li class='bottomList'>
                    <a href='#' class='notificationNav'>
                    <div style='
                    position: absolute;
                    $display
                    width: 10px;
                    height: 10px;
                    background-color: red;
                    border-radius: 50%;
                    top: 10px;
                    right: 18px;
                    border: 1px solid #fff;'>
                    </div>
                        <span class='icon'><ion-icon name='notifications-circle-outline'></ion-icon></span>
                        <span class='text'>Notification</span>
                    </a>
                </li>
                <li class='bottomList'>
                    <a href='#' class='notesNav'>
                        <span class='icon'><i class='fa-regular fa-note-sticky'></i></span>
                        <span class='text'>My Notes</span>
                    </a>
                </li>
                <div class='indicator'></div>
            </ul>
        </div>
    </div>";
} else {
    echo "<div class='bottomNav'>
        <div class='bottomAling'>
            <ul>
                <li class='bottomList'>
                    <a href='#' class='profilNav'>
                        <span class='icon'><ion-icon name='person-outline'></ion-icon></span>
                        <span class='text'>Profile</span>
                    </a>
                </li>
                <li class='bottomList'>
                    <a href='#' class='dashNav'>
                        <span class='icon'><ion-icon name='stats-chart-outline'></ion-icon></span>
                        <span class='text'>dashboard</span>
                    </a>
                </li>
                <li class='bottomList active'>
                    <a href='index' class='homeNav'>
                        <span class='icon'><ion-icon name='home-outline'></ion-icon></span>
                        <span class='text'>Home</span>
                    </a>
                </li>
                <li class='bottomList'>
                    <a href='#' class='notificationNav'>
                    <div class='fa-beat' style='
                    position: absolute;
                    $display
                    width: 10px;
                    height: 10px;
                    background-color: red;
                    border-radius: 50%;
                    top: 10px;
                    right: 18px;
                    border: 1px solid #fff;'>
                    </div>
                        <span class='icon'><ion-icon name='notifications-circle-outline'></ion-icon></span>
                        <span class='text'>Notification</span>
                    </a>
                </li>
                <li class='bottomList'>
                    <a href='#' class='notesNav'>
                        <span class='icon'><i class='fa-regular fa-note-sticky'></i></span>
                        <span class='text'>My Notes</span>
                    </a>
                </li>
                <div class='indicator'></div>
            </ul>
        </div>
    </div>";
}
