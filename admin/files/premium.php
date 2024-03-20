<?php
include "../../includes/connection.php";
if (isset($_SESSION['ID'])) {
    if ($_SESSION['ID'] >= 4) {
        header("location: ../../index");
    }
} else {
    header("location: ../../index");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Premium Features</title>
    <link rel="stylesheet" href="../../assect/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .details {
            width: 90%;
            max-width: 450px;
            margin: auto;
        }

        .details li {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .premium {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border-radius: 7px;
            box-shadow: 0 0 10px var(--shadow);
        }
    </style>
</head>

<body>
    <div class="area">
        <div class="area-aline">
            <header>
                <nav>
                    <a onclick="loadinEffect()" href="../admin.php">
                        <i class="fa-solid fa-angle-left"></i>
                    </a>
                    <h2> Premium Features </h2>
                </nav>
            </header>
            <br><br><br><br>
            <div class="details">

                <div class="premium">
                    <h2> Desktop </h2>
                    <li> Admin App <span> 15700/= </span> </li>
                    <li> Mr.ChemistrY APP <span> 10000/= </span> </li>
                    <li> [ Lifetime update ] </li>
                    <br>
                    <p style="font-family: 'Noto Sans Sinhala'; text-align: justify;"> Admin App එක මගින් PDF files Download කිරීමකින් තොරව View කිරීමට හැකිවන අතර වෙබ් අඩවිය තුල Admin පැනලය සම්බන්ද කිසිදු දෙයක් නොමැති හෙඉන් කිසිවෙකුටවත් අනවසර ඇතුල්වීමක් ලක් කළ නොහැකිවේ. එය වෙබ් අඩවියේ ආරක්ෂාවට දැඩිව දායක වේ. </p>
                </div>
                <br>

                <div class="premium">
                    <h2> Android </h2>
                    <li> App - <span>20000/=</span> </li>
                    <li> Play Store [ Lifetime ] <span>10000/=</span> </li>
                    <li> App + Play Store <span>28500/=</span> </li>
                    <li> [ Lifetime update ] </li>
                </div>
                <br>

                <div class="premium">
                    <h2> Apple </h2>
                    <li> App - <span>40000/=</span> </li>
                    <li> App Store [ Anualy ] <span> $99.00 </span> </li>
                    <li> [ Lifetime update ] </li>
                </div>
                <br>

                <div class="premium fa-bounce" style="background-color: lightyellow; box-shadow: 0 0 10px lightyellow;">
                    <h2> Special </h2>
                    <li> Admin APP + Desktop APP + Android APP + Play Store + [ Lifetime update ] <span> 35000/= </span></li>
                </div>
                <br>

                <div class="premium">
                    <h2> Place Advertisment </h2>
                    <li> Monthly <span> 550/= </span> </li>
                    <li> Anualy <span> 10500/= </span> </li>
                    <li> Lifetime <span> 45500/= </span> </li>
                    <br>
                    <p style="font-family: 'Noto Sans Sinhala'; text-align: justify;"> ඔබට ඔබගේ රුචිකත්වය පරිදි ඕන්නෑම ආයතනයක් හරහා දැන්වීම් පල කිරීමේ හැකියාව සලසා ඇත. දල වශයෙන් ගත් කල පරිශීලකයින් 50 ක් 100 ක් අතර පිරිසක් දිනකට ලොග් වන්නේ නම් අවුරුද්දක දල ආදායම රුපියල් 40000/=ක් පමණ වේ. </p>
                </div>
                <br><br>
            </div>
        </div>
    </div>

    <!-- loader image -->
    <div class="loading" id="loader">
        <img src="../../assect/img/icon/New-file.gif" alt="loading">
    </div>
    <script>
        function loadinEffect() {
            document.getElementById('loader').style.display = "flex";
        }
    </script>
</body>

</html>