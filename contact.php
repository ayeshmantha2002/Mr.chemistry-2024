<?php

include("includes/connection.php");

if (isset($_POST['submit'])) {
    $fullName     =  mysqli_real_escape_string($connection, $_POST['fullName']);
    $email    =  mysqli_real_escape_string($connection, $_POST['email']);
    $subject      =  mysqli_real_escape_string($connection, $_POST['subject']);
    $Message      =  mysqli_real_escape_string($connection, $_POST['Message']);

    $to =   "mrchemistry.palliyaguru@gmail.com";
    $email_subject  =   "Message from Mr.Chemistry";
    $email_body =   "Message from contact us page of the website.";
    $email_body .=   "<b>From :</b> {$fullName} <br>";
    $email_body .=   "<b>Subject :</b> {$subject} <br>";
    $email_body .=   "<b>From :</b> {$Message} <br>" . nl2br(strip_tags($Message));

    $header =   "From : {$email}\r\nContent-type: text/html;";

    $status = mail($to, $email_subject, $email_body, $header);
    if ($status) {
        header('location:index.php?mail=successfully_completed');
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mr.ChemistrY - Contact</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assect/css/contact.css">
    <link rel="stylesheet" href="assect/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="icon" href="assect/img/icon/logo.png">
</head>

<body>
    <div class="loading" id="loader">
        <img src="assect/img/icon/New-file.gif" alt="loading">
    </div>
    <div id="upNav">
        <div class="upNav">
            <div class="logo">
                <h3> <i class="fa-solid fa-bars" id="navClick" style="color: var(--text-blue);
                padding-right: 15px;
                font-size: 25px;
                transform: translateY(4px);
                cursor: pointer;"></i> Mr.Chemistry<span id="maths">.lk </span> </h3>
                <p> NIPUN PALLIYAGURU </p>
            </div>
            <ul>
                <li><a href="index"> Home </a></li>
                <?php
                if (!isset($_SESSION['ID'])) {
                    echo '<li><a href="login"> Login </a></li>';
                }
                ?>
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
                    <h2> Contact Us </h2>
                    <p>Mr.ChemistrY - Chemistry <span style='font-family: "Noto Sans Sinhala"; font-weight: bold;'> වලට තවත් නමක් </span> </p>
                </div>
            </div>

            <div class="contactAlinbox">
                <div class="contactFrom">
                    <div class="contactAddress">
                        <div class="contactAddressAlin">
                            <ul>
                                <li>
                                    <i class="fa-solid fa-phone"></i>
                                    <p> <span>Phone</span> <br> +94 766159686</p>
                                </li>
                                <br>
                                <li>
                                    <i class="fa-solid fa-at"></i>
                                    <p> <span>E-mail</span> <br> mrchemistry.palliyaguru@gmail.com</p>
                                </li>
                                <br>
                                <li>
                                    <i class="fa-solid fa-location-dot" style="padding: 10px 12px;"></i>
                                    <p> <span>Address</span> <br> 16/A, Pinnalanda Gardens, Badulla.</p>
                                </li>
                                <br>
                                <li>
                                    <i class="fa-brands fa-facebook-f" style="padding: 10px 13px;"></i>
                                    <p> <span>Facebook</span> <br>nipun.palliyaguru.39395</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="form">
                        <div class="massageOption">
                            <div id="whatsapp"><i class="fa-brands fa-whatsapp"> </i>
                                <p>Whatsapp</p>
                            </div>
                            <div id="gmail"><i class="fa-regular fa-envelope"></i><br>
                                <p>G-mail</p>
                            </div>
                        </div>
                        <div class="gmail">
                            <form method="post">
                                <img src="https://5.imimg.com/data5/SELLER/Default/2023/8/332242983/WQ/BA/HR/41398571/buy-pva-gmail-accounts-500x500.jpg" alt="Gmail log">
                                <input type="text" placeholder="Full Name" name="fullName" required>
                                <input type="text" placeholder="E-mail" name="email" required>
                                <input type="text" placeholder="Subject" name="subject" required>
                                <textarea type="text" placeholder="Your Message." name="Message" required style="height: 100px;"></textarea>
                                <p><button type="submit" name="submit"> <i class="fa-regular fa-envelope"></i> Send Message </button></p>
                            </form>
                        </div>
                        <div class="whatsapp">
                            <form method="post">
                                <img src="assect/img/icon/whatsapp-logo.png" alt="whatsapp logo">
                                <input type="text" placeholder="Full Name" id="fullName">
                                <input type="text" placeholder="E-mail" id="email">
                                <input type="text" placeholder="Subject" id="subject">
                                <textarea type="text" placeholder="Your Message." id="Message" style="height: 100px;"></textarea>
                                <p><button type="button" id="submit" onclick="whatsapp()"> <i class="fa-brands fa-whatsapp"> </i> Send Message </button></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            include "includes/footer.php";
            ?>
            <div style="height: 50px;"></div>
        </div>
    </div>
    <div class="blur"></div>


    <script src="assect/js/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.cycle2/2.1.6/jquery.cycle2.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="assect/js/javascript.js"></script>
    <script src="assect/js/viewjs.js"></script>
    <script src="https://unpkg.com/boxicons@2.1.3/dist/boxicons.js"></script>

    <script>
        var loader = document.getElementById("loader");
        window.addEventListener("load", function() {
            loader.style.display = "none";
        });

        function whatsapp() {
            const fullName = document.getElementById("fullName").value;
            const email = document.getElementById("email").value;
            const subject = document.getElementById("subject").value;
            const Message = document.getElementById("Message").value;

            const url = "https://wa.me/94713759686?text=" +
                "*A message from the Mr.Maths app.*" + "%0a" + "%0a" +
                "*Name  :* " + fullName + "%0a" +
                "*E-mail  :* " + email + "%0a" +
                "*Subject  :* " + subject + "%0a" + "%0a" +
                "*Message  :* " + Message + "%0a";

            window.open(url, '_self').focus();
        }
    </script>
    <script>
        $(document).ready(function() {
            $("#gmail").click(function() {
                $(".gmail").css("display", "block");
                $("#gmail").css("color", "red");
                $(".whatsapp").css("display", "none");
                $("#whatsapp").css("color", "black");
            })

            $("#whatsapp").click(function() {
                $(".gmail").css("display", "none");
                $("#gmail").css("color", "black");
                $(".whatsapp").css("display", "block");
                $("#whatsapp").css("color", "#4CD480");
            })
        })
    </script>
</body>

</html>