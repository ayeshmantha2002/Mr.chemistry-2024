<?php
include('includes/connection.php');

$verify     =   "";
$invalid    =   "";
$E_mail    =   "";
$Password    =   "";

if (isset($_COOKIE['userPasswordMRMATHS'])) {
    $userName = $_COOKIE['userName'];
    $userPasswordMRMATHS = $_COOKIE['userPasswordMRMATHS'];
    $User   =   "SELECT * FROM tbl_register WHERE (E_mail = '{$userName}' OR userName = '{$userName}') AND `Password` = '{$userPasswordMRMATHS}' LIMIT 1";
    $query  =   mysqli_query($connection, $User);
    if ($query) {
        if (mysqli_num_rows($query) == 1) {
            $details = mysqli_fetch_assoc($query);
            $Active     =   $details['Is_Active'];
            if ($Active == 1) {
                $_SESSION['ID']    =   $details['ID'];
                $_SESSION['userID_Name']    =   $details['userName'];
                $_SESSION['First_name']    =   $details['First_name'];
                $_SESSION['Last_name']    =   $details['Last_name'];
                $_SESSION['E_mail']    =   $details['E_mail'];
                $_SESSION['Class']    =   $details['Class'];
                $_SESSION['verify']    =   $details['Confirm_user'];

                header('location:index');
            } else {
                $verify =   "<span>Please verify your email address...</span>";
            }
        } else {
            $invalid    =   "Invalid email address or password";
        }
    }
} else {
    if (isset($_POST['submit'])) {
        $E_mail = mysqli_real_escape_string($connection, $_POST['email']);
        $Password = mysqli_real_escape_string($connection, $_POST['password']);
        $Hashpassword = sha1($Password);

        $User   =   "SELECT * FROM tbl_register WHERE (E_mail = '{$E_mail}' OR userName = '{$E_mail}') AND Password = '{$Hashpassword}' LIMIT 1";
        $query  =   mysqli_query($connection, $User);

        if ($query) {
            if (mysqli_num_rows($query) == 1) {
                $details = mysqli_fetch_assoc($query);
                $Active     =   $details['Is_Active'];
                if ($Active == 1) {
                    $_SESSION['ID']    =   $details['ID'];
                    $_SESSION['userID_Name']    =   $details['userName'];
                    $_SESSION['First_name']    =   $details['First_name'];
                    $_SESSION['Last_name']    =   $details['Last_name'];
                    $_SESSION['E_mail']    =   $details['E_mail'];
                    $_SESSION['Class']    =   $details['Class'];
                    $_SESSION['verify']    =   $details['Confirm_user'];

                    setcookie('userName', $E_mail, time() + 60 * 60 * 24 * 10);
                    setcookie('userPasswordMRMATHS', $Hashpassword, time() + 60 * 60 * 24 * 10);

                    header('location:index.php?login=successfully_completed');
                } else {
                    $verify_code = $details['Mail_verification'];
                    header("location: login.php?verify=resnd_mail&verify_code=$verify_code");
                }
            } else {
                $invalid    =   "Invalid email / username address or password";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="Mr chemistry, mrchemistry.lk, mr chemistry.lk, Mr.ChemistrY.lk, Mr.ChemistrY, Mr, chemistry, mrchemistry, nipun palliyaguru, nipun, palliyaguru, nipunpalliyaguru, nipun palliya guru, nipun palliyaguru chemistry, nipun palliyaguru">
    <meta name="description" content="Our aim is to make your studies easier, to study your studies with a good plan, to compare your level with other students, to make up for your shortcomings and increase your marks, to increase your interest, and to achieve high marks in the exam.">
    <title>Mr.ChemistrY - Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assect/css/style.css">
    <link rel="stylesheet" href="assect/css/register.css">
    <link rel="icon" href="assect/img/icon/logo.png">
</head>

<body>
    <div class="blur"></div>
    <div class="loading" id="loader">
        <img src="assect/img/icon/New-file.gif" alt="loading">
    </div>

    <?php
    if (isset($_GET['code'])) {
        $value  =    mysqli_real_escape_string($connection, $_GET['code']);
        if ($value == "verified") {
            echo '<div class="checkmeeteralin">
                <div class="checkmeeter">
                <div>
                <i class="fa-regular fa-circle-check fa-beat-fade fa-2xl" style="color: lime;"></i></i></i>
                        <br><br>
                        <p> Your email address has been verified. </p>
                        <br>
                        <p><a href="login"> OK </a></p>
                    </div>
                </div>
            </div>';
        }
    }

    if (isset($_GET['verify'])) {
        $value  =    mysqli_real_escape_string($connection, $_GET['verify']);
        $code  =    mysqli_real_escape_string($connection, $_GET['verify_code']);
        if ($value == "resnd_mail") {
            echo '<div class="checkmeeteralin">
                <div class="checkmeeter">
                <div>
                <i class="fa-solid fa-paper-plane fa-bounce fa-2xl"></i>
                        <br><br>
                        <p> Please check your inbox and confirm your email address. </p>
                        <br>
                        <p><a href="resend.php?resend=' . $code . '"> Resend verification E-mail </a></p>
                        <p class="resend"><a href="index"> ok </a></p>
                    </div>
                </div>
            </div>';
        }
    }

    ?>

    <div id="upNav">
        <div class="upNav">
            <div class="logo">
                <h3> <i class="fa-solid fa-bars" id="navClick" style="color: var(--text-blue);
                padding-right: 15px;
                font-size: 25px;
                transform: translateY(4px);
                cursor: pointer;"></i> Mr.ChemistrY<span id="maths">.lk</span> </h3>
                <p> NIPUN PALLIYAGURU </p>
            </div>
            <ul>
                <li><a href="index"> Home </a></li>
                <li><a href="register"> Register </a></li>
            </ul>
        </div>
    </div>
    <div class="hero">
        <?php
        include("includes/sidenav.php");
        ?>
        <div class="content">
            <div class="lable">
                <div class="lableAling">
                    <h2> Log in </h2>
                    <p>Mr.ChemistrY - <span style='font-family: "Noto Sans Sinhala"; font-weight: bold;'> වෙනස්ම රහකට </span> ChemistrY </p>
                </div>
            </div>
            <div class="alinpage">
                <div class="detailsreg">
                    <h1>Mr.ChemistrY <br> <span>Log in Page.</span></h1>
                </div>
                <div class="register">
                    <div class="error">
                        <p><?php echo $invalid; ?></p>
                        <p> <?php echo $verify; ?> </p>
                    </div>
                    <form method="post">
                        <input type="text" name="email" id="email" checked value="<?php if (isset($_COOKIE['userName'])) {
                                                                                        echo $_COOKIE['userName'];
                                                                                    } else {
                                                                                        echo $E_mail;
                                                                                    } ?>" placeholder="E-mail Address" required>
                        <input type="password" placeholder="Password" value="<?php echo $Password; ?>" name="password" required id="password">
                        <input type="checkbox" id="show"><label for="show"> Show password </label>
                        <p><input type="submit" name="submit" value="Log in"></p>
                        <div class="sutdentDetails">
                            <a href="#" style="opacity: 0;">Privacy policis</a>
                            <a href="register"> Register </a>
                        </div>
                    </form>
                </div>
            </div>
            <?php
            include "includes/footer.php";
            ?>
            <div class="space"></div>
        </div>

        <script src="assect/js/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.cycle2/2.1.6/jquery.cycle2.min.js"></script>
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
        <script src="assect/js/viewjs.js"></script>

        <script>
            var loader = document.getElementById("loader");
            window.addEventListener("load", function() {
                loader.style.display = "none";
            });
        </script>

        <script>
            $(document).ready(function() {
                var show = false;
                $("#show").click(function() {
                    if (show == false) {
                        $("#password").attr("type", "text");
                        show = true;
                    } else {
                        $("#password").attr("type", "password");
                        show = false;
                    }
                })
            })
        </script>

</body>

</html>