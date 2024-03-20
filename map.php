<?php
include("includes/connection.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mr.ChemistrY - MAP</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assect/css/register.css">
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
                cursor: pointer;"></i> Mr.ChemistrY<span id="maths">.lk</span> </h3>
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
                    <h2> Mr.ChemistrY </h2>
                    <p>Mr.ChemistrY - <span style='font-family: "Noto Sans Sinhala"; font-weight: bold;'> වෙනස්ම රහකට </span> ChemistrY </p>
                </div>
            </div>
            <div class="map" id="bandarawela">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.5085507636186!2d80.98790577456923!3d6.829460019533107!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae46ffc48c00083%3A0x70184e1503fb8f65!2sSudarshi%20Institute%20Bandarawela!5e0!3m2!1sen!2slk!4v1690284208371!5m2!1sen!2slk" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                <div id="map">
                    <div>
                        <p>සුදර්ෂී අධ්‍යාපන ආයතනය,</p>
                        <p>බණ්ඩාරවෙල.</p>
                        <br>
                        <p>
                            සතියේ සෑම දිනකම, උදෑසන 8.00 සිට සවස 5.00 දක්වා විවෘත්ත අතර සෑම පොහොය දිනකදීම ආයතනය වසනු ලැබේ.
                            පන්තිය සමග සම්බන්ද වීම සදහා ආයතනයට පැමින හෝ දුරකථන ඇමතුමක් මගින් ද සම්බන්ද විය හැක.
                        </p>
                    </div>
                </div>
            </div>
            <br>
            <div class="map" id="badulla">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7920.222204805444!2d81.04896093923826!3d6.996194921011703!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae4631de0f1a795%3A0xb227618868e90c19!2sVision%20institute!5e0!3m2!1sen!2slk!4v1710386154957!5m2!1sen!2slk" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                <div id="map">
                    <div>
                        <p>විෂන් අධ්‍යාපන ආයතනය,</p>
                        <p>බදුල්ල.</p>
                        <br>
                        <p>
                            සතියේ සෑම දිනකම, උදෑසන 8.00 සිට සවස 5.00 දක්වා විවෘත්ත අතර සෑම පොහොය දිනකදීම ආයතනය වසනු ලැබේ.
                            පන්තිය සමග සම්බන්ද වීම සදහා ආයතනයට පැමින හෝ දුරකථන ඇමතුමක් මගින් ද සම්බන්ද විය හැක.
                        </p>
                    </div>
                </div>
            </div>
            <br>
            <?php
            include "includes/footer.php";
            ?>
            <div class="space"></div>
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
        </script>
</body>

</html>