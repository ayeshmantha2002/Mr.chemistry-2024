<?php
include("includes/connection.php");

$alrady =   "";
$checkpassword  =   "";
$selectClass    =   "";
$First_name =   "";
$Last_name  =   "";
$E_mail =   "";
$Password   =   "";
$ConPassword    =   "";

// class fetch
$class = "SELECT * FROM class ORDER BY class";
$class_Result = mysqli_query($connection, $class);

if (isset($_POST['submit'])) {

    $First_name =   mysqli_real_escape_string($connection, $_POST['firstName']);
    $Last_name =   mysqli_real_escape_string($connection, $_POST['lastName']);
    $E_mail =   mysqli_real_escape_string($connection, $_POST['email']);
    $Password =   mysqli_real_escape_string($connection, $_POST['password']);
    $ConPassword =   mysqli_real_escape_string($connection, $_POST['confirmPassword']);
    $Class =   mysqli_real_escape_string($connection, $_POST['class']);
    $HashPassword =   sha1($Password);
    $CategoryCheck   =  $_POST['Category'];
    $Full_Name  =   $First_name . " " . $Last_name;

    if ($CategoryCheck == "0") {
        $Category   =   "Theory";
    } elseif ($CategoryCheck == "1") {
        $Category   =   "Revision";
    } elseif ($CategoryCheck == "2") {
        $Category   =   "Theory & Revision";
    }

    $Mail_verification = sha1($E_mail . time());
    $Mail_verification_URL  =   "https://mrchemistry.lk/verify.php?code=" . $Mail_verification;

    $Check  =   "SELECT * FROM tbl_register WHERE E_mail = '{$E_mail}' LIMIT 1";
    $CheckResult =   mysqli_query($connection, $Check);

    if ($CheckResult) {
        if (mysqli_num_rows($CheckResult) == 1) {
            $alrady =   "The email address already exists";
        } else {
            if ($Password == $ConPassword) {

                $Insert =   "INSERT INTO tbl_register (`First_name` , `Last_name` , `E_mail` , `Password` , `Class` , `Category` , `Mail_verification` , `Is_Active` , `Confirm_user` , `Pro_pic` , `Mood`) VALUE ('{$First_name}','{$Last_name}','{$E_mail}','{$HashPassword}','{$Class}','{$Category}','{$Mail_verification}', 0 , 3 , 'user.png' , 'light')";
                $InsertResult   =   mysqli_query($connection, $Insert);

                $to =   $E_mail;
                $sender =   'mrchemistry.palliyaguru@gmail.com';
                $email_subject  =   "Verify E-mail Address.";
                $email_body =   '<p>Dear ' . $First_name . " " . $Last_name . '</p>';
                $email_body .=   "<p>Thank you for signing up at Mr.ChemistrY! We're thrilled to have you as a new member of our community. To ensure the security of your account and to access all the features, we kindly request you to verify your email address.</p><br>";
                $email_body .=   "<p>Please follow the steps below to complete the verification process:</p><br>";
                $email_body .=   "Step 1: Click on the following link or copy-paste it into your web browser: <br>";
                $email_body .=   $Mail_verification_URL;
                $email_body .=   "<br><br>";
                $email_body .=   "Step 2: You will be directed to a verification page. If the link doesn't work, try copying and pasting it into your browser's address bar directly. <br><br>";
                $email_body .=   "Step 3: Once on the verification page, you will be prompted to log in to your Mr.ChemistrY account (if you haven't already). After logging in, your email address will be successfully verified. <br><br>";
                $email_body .=   "If you have any issues with the verification process or if you didn't create an account on Mr.ChemistrY, please ignore this email. Rest assured that your information is safe and secure. <br><br>";
                $email_body .=   "For any questions or assistance, don't hesitate to contact our support team at" . " " . "designer@ayeshmantha.lk" . "<br><br>";
                $email_body .=   "Thank you again for joining us! We look forward to providing you with an exceptional experience on Mr.ChemistrY.<br><br>";
                $email_body .=   "Best regards,<br><br>";
                $email_body .=   "The Mr.ChemistrY Team";

                $header =   "From: {$sender}\r\nContent-type: text/html;";

                $status = mail($to, $email_subject, $email_body, $header);

                if ($InsertResult) {
                    header('location:register.php?verify=check_your_email_address');
                }
            } else {
                $checkpassword = "Please check your password";
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
    <title>MR.ChemistrY - Register</title>
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
    if (isset($_GET['verify'])) {
        $value  =    $_GET['verify'];
        if ($value == "check_your_email_address") {
            echo '<div class="checkmeeteralin">
                <div class="checkmeeter">
                <div>
                <i class="fa-solid fa-envelope-circle-check fa-bounce fa-2xl"></i>
                        <br><br>
                        <p> Please check your inbox and confirm your email address. </p>
                        <br>
                        <p><a href="index"> OK </a></p>
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
                <li><a href="login"> Login </a></li>
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
                    <h2> Register </h2>
                    <p>Mr.ChemistrY - Chemistry <span style='font-family: "Noto Sans Sinhala"; font-weight: bold;'> වලට තවත් නමක් </span> </p>
                </div>
            </div>
            <div class="alinpage">
                <div class="detailsreg">
                    <h1>Mr.ChemistrY <br> <span>Register Page.</span></h1>
                </div>
                <div class="register">
                    <div class="error">
                        <p><?php echo $alrady; ?></p>
                        <p><?php echo $selectClass; ?></p>
                        <p> <?php echo $checkpassword; ?> </p>
                    </div>
                    <form method="post">
                        <div class="sutdentDetails">
                            <input type="text" placeholder="First Name" name="firstName" value="<?php echo $First_name ?>" required>
                            <input type="text" placeholder="Last Name" name="lastName" value="<?php echo $Last_name ?>" required>
                        </div>
                        <input type="email" name="email" id="email" placeholder="E-mail Address" value="<?php echo $E_mail ?>" required>
                        <div class="sutdentDetails">
                            <input type="password" placeholder="Password" name="password" value="<?php echo $Password ?>" required minlength="4">
                            <input type="password" placeholder="Confirm Password" name="confirmPassword" value="<?php echo $ConPassword ?>" required minlength="4">
                        </div>
                        <p>
                            <select name="class" required>
                                <option value="">Select a class</option>
                                <?php
                                if ($class_Result) {
                                    if (mysqli_num_rows($class_Result) > 0) {
                                        while ($class_fetch = mysqli_fetch_assoc($class_Result)) {
                                            $class_value = $class_fetch['class'];
                                            echo "<option value='{$class_value}'>{$class_value}</option>";
                                        }
                                    }
                                }
                                ?>
                            </select>
                        </p>
                        <div id="section">
                            <p><input type="radio" name="Category" value="0" id="Theory" required><label for="Theory">Theory</label></p>
                            <p><input type="radio" name="Category" value="1" id="Revision"><label for="Revision">Revision</label></p>
                            <p><input type="radio" name="Category" value="2" id="TheoryRevision"><label for="TheoryRevision">Theory & Revision</label></p>
                        </div>
                        <div class="terms">
                            <p><input type="checkbox" name="terms" id="terms" required><label for="terms"><a href="policis">terms and conditions</a></label></p>
                        </div>
                        <p><input type="submit" name="submit" value="Register"></p>
                        <div class="sutdentDetails">
                            <a href="#" style="opacity: 0;">Privacy policis</a>
                            <a href="login"> Have an account </a>
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
</body>

</html>