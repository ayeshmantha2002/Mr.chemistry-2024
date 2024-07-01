<?php
include("includes/connection.php");

$classList = "SELECT `class` FROM `class` ORDER BY `class`";
$classListResult = mysqli_query($connection, $classList);

$UpNoti = "UPDATE `tbl_register` SET `Notification` = 0 WHERE `ID` = {$_SESSION['ID']}";
$UpNotiResult = mysqli_query($connection, $UpNoti);

if (isset($_GET['delete'])) {
    if ($_GET['delete'] == 0) {
        $updateNotification = "DELETE FROM `notification` WHERE ID = {$_GET['id']} LIMIT 1";
        $resultDelete = mysqli_query($connection, $updateNotification);
        if ($resultDelete) {
            header("location:index.php?delete=done");
        }
    }
}

if (isset($_POST['submit'])) {
    if (isset($_POST['message'])) {
        $message = mysqli_real_escape_string($connection, $_POST['message']);
        $insertmsg = nl2br(strip_tags($message));
        $target = $_POST['target'];

        if ($target == "ALL") {
            $updatTBLREGISTER = "UPDATE `tbl_register` SET `Notification` = 1";
        } else {
            $updatTBLREGISTER = "UPDATE `tbl_register` SET `Notification` = 1 WHERE `Class` = {$target}";
        }
        $updatTBLREGISTER_result = mysqli_query($connection, $updatTBLREGISTER);


        $inserMessage = "INSERT INTO `notification` (`message`, `target`, `status`) VALUES ('{$insertmsg}', '{$target}', 1);";
        $queryMessage = mysqli_query($connection, $inserMessage);
        if ($queryMessage) {
            header("location:index.php?mail=successfully_completed");
        } else {
            header("location:index.php?error=new_message");
        }
    }
}

?>
<div class="lable">
    <div class="lableAling">
        <h2> NOTIFICATIONS </h2>
        <p> Smart Education - Mr.Maths </p>
    </div>
</div>
<?php
echo '<div class="notification">';
if (isset($_SESSION['ID'])) {
    if ($_SESSION['ID'] <= 2) {
        if (mysqli_num_rows($classListResult) > 0) {
            echo "<form action='notification.php' method='post'>
                    <p><textarea placeholder='new message' name='message' maxlength='1000'></textarea></p>
                    <p><select name='target'>
                    <option value='ALL'>All</option>";
            while ($classes = mysqli_fetch_assoc($classListResult)) {
                echo "<option value='{$classes['class']}'>{$classes['class']}</option>";
            }
            echo "</select></p>
                    <br>
                    <p><input type='submit' name='submit' value='Send Message'></p>
                </form>";
        }
    }
} else {
    echo '<div class="viewProfile2">
                        <i class="fa-solid fa-right-from-bracket fa-shake"></i>
                        <p>Please login first. Then enjoy the facilities.</p>
                        <br>
                        <p> <a href="login"> Log in here. </a> </p>
                    </div>';
}

if (isset($_SESSION['ID'])) {
    if ($_SESSION['ID'] <= 2) {
        $notificationList = "SELECT * FROM `notification` WHERE `status` = 1 ORDER BY ID DESC";
    } else {
        $notificationList = "SELECT * FROM `notification` WHERE `target` IN('All' , '{$_SESSION['Class']}') AND `status`= 1 ORDER BY ID DESC";
    }
    $querynoti = mysqli_query($connection, $notificationList);
    if (mysqli_num_rows($querynoti) > 0) {
        $notiList = "<ul>";
        if ($_SESSION['ID'] <= 2) {
            while ($notiFetch = mysqli_fetch_assoc($querynoti)) {
                $notiList .= "<li>" . "<p>" . nl2br(strip_tags($notiFetch['message'])) . "</p>" . "<div><a href='notification.php?delete=0&id=" . $notiFetch['ID'] . "'><i class='fa-solid fa-trash-can delBTN' style='color: #ff0000;'></i></a></div>" . "</li>";
            }
        } else {
            if ($_SESSION['ID'] > 2) {
                while ($notiFetch = mysqli_fetch_assoc($querynoti)) {
                    $notiList .= "<li>" . "<div>" . nl2br(strip_tags($notiFetch['message'])) . "</div>" . "<div><i class='fa-solid fa-trash-can none' style='color: #ff0000;'></i></div>" . "</li>";
                }
            }
        }
        $notiList .= "</ul>";
        echo $notiList;
    } else {
        echo "<ul>
            <li style='font-family: Poppins; '> Empty </li>
        </ul>";
    }
}
echo '</div>';
include "includes/footer.php";
?>
<div class="space"></div>
<div class="space2"></div>
<script src="assect/js/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $(".delBTN").click(function() {
            $(this).css("background-color", "tomato");
            $(this).css("color", "tomato");
            $(this).css("position", "absolute");
            $(this).css("width", "100%");
            $(this).css("height", "100%");
            $(this).css("left", "0");
            $(this).css("top", "0");
            $(this).css("margin", "0");
            $(this).css("border-radius", "8px");
        })
    })
</script>