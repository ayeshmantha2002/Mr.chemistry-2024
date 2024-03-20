<?php
if (isset($_GET['status'])) {
    echo '<div class="bottomNav">
        <div class="bottomAling">
            <ul>
                <li class="bottomList">
                    <a href="#" class="profilNav">
                        <span class="icon"><ion-icon name="person-outline"></ion-icon></span>
                        <span class="text">Profile</span>
                    </a>
                </li>
                <li class="bottomList">
                    <a href="#" class="dashNav">
                        <span class="icon"><ion-icon name="stats-chart-outline"></ion-icon></span>
                        <span class="text">dashboard</span>
                    </a>
                </li>
                <li class="bottomList">
                    <a href="index" class="homeNav">
                        <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                        <span class="text">Home</span>
                    </a>
                </li>
                <li class="bottomList">
                    <a href="#" class="notificationNav">
                        <span class="icon"><ion-icon name="notifications-circle-outline"></ion-icon></span>
                        <span class="text">Notification</span>
                    </a>
                </li>
                <li class="bottomList active">
                    <a href="#" class="notesNav">
                        <span class="icon"><i class="fa-regular fa-note-sticky"></i></span>
                        <span class="text">My Notes</span>
                    </a>
                </li>
                <div class="indicator"></div>
            </ul>
        </div>
    </div>';
} elseif (isset($_GET['update'])) {
    echo '<div class="bottomNav">
        <div class="bottomAling">
            <ul>
                <li class="bottomList active">
                    <a href="#" class="profilNav">
                        <span class="icon"><ion-icon name="person-outline"></ion-icon></span>
                        <span class="text">Profile</span>
                    </a>
                </li>
                <li class="bottomList">
                    <a href="#" class="dashNav">
                        <span class="icon"><ion-icon name="stats-chart-outline"></ion-icon></span>
                        <span class="text">dashboard</span>
                    </a>
                </li>
                <li class="bottomList">
                    <a href="index" class="homeNav">
                        <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                        <span class="text">Home</span>
                    </a>
                </li>
                <li class="bottomList">
                    <a href="#" class="notificationNav">
                        <span class="icon"><ion-icon name="notifications-circle-outline"></ion-icon></span>
                        <span class="text">Notification</span>
                    </a>
                </li>
                <li class="bottomList">
                    <a href="#" class="notesNav">
                        <span class="icon"><i class="fa-regular fa-note-sticky"></i></span>
                        <span class="text">My Notes</span>
                    </a>
                </li>
                <div class="indicator"></div>
            </ul>
        </div>
    </div>';
} else {
    echo '<div class="bottomNav">
        <div class="bottomAling">
            <ul>
                <li class="bottomList">
                    
                </li>
                <li class="bottomList">
                    
                </li>
                <li class="bottomList active" onclick="loadingEffect()">
                    <a href="index" class="homeNav">
                        <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                        <span class="text">Home</span>
                    </a>
                </li>
                <li class="bottomList">
                    
                </li>
                <li class="bottomList">
                    
                </li>
                <div class="indicator"></div>
            </ul>
        </div>
    </div>';
}
