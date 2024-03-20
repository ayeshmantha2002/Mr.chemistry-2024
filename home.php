<?php
include("includes/connection.php");

$homework = "none";

if (isset($_SESSION['ID'])) {
    $query  =   "SELECT * FROM tbl_register WHERE ID ={$_SESSION['ID']}";
    $result =    mysqli_query($connection, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $verify =   mysqli_fetch_assoc($result);
            $verifyUser =   $verify['Confirm_user'];
            $ID =   $verify['ID'];
            $First_name =   $verify['First_name'];
            $Last_name  =   $verify['Last_name'];
            $E_mail     =   $verify['E_mail'];
            $Class      =   $verify['Class'];
            $Category   =   $verify['Category'];
            $Pro_pic    =   $verify['Pro_pic'];
        }
    }
}

// banner fetch 
$banner = "SELECT * FROM image_table WHERE `Status` = 1";
$banner_result = mysqli_query($connection, $banner);

?>
<div class="contentback">
    <div class="lable">
        <div class="lableAling">
            <h2> Mr.ChemistrY </h2>
            <p> Chemistry <span style='font-family: "Noto Sans Sinhala"; font-weight: bold;'> වලට තවත් නමක් </span> </p>
        </div>
    </div>

    <div class="banner cycle-slideshow" data-cycle-timeout=5000>
        <!-- empty element for pager links -->
        <div class="cycle-pager"></div>
        <?php
        if (mysqli_num_rows($banner_result) > 0) {
            while ($banner_image = mysqli_fetch_assoc($banner_result)) {
                echo "<img src='assect/img/brand/{$banner_image['Image_name']}' alt='banner'>";
            }
        } else {
            echo '<img src="https://placehold.co/1400x500?text=Mr.ChemistrY.lk" alt="banner">';
            echo '<img src="https://placehold.co/1400x500" alt="banner">';
        }
        ?>
    </div>

    <div class="rank">
        <div class="rankPic">

            <?php
            if (isset($_SESSION['Class'])) {
                $Timeclass = $_SESSION['Class'];
            } else {
                $Timeclass = 2000;
            }
            $timerStudent = "SELECT * FROM `timer` WHERE `Class` = {$Timeclass}";
            $timerStudent_result = mysqli_query($connection, $timerStudent);
            if (mysqli_num_rows($timerStudent_result) == 1) {
                echo '<div class="error-messages" id="homework-form"></div>';
            }
            ?>
            <div class="list">
                <a class="more">
                    <div class="first">
                        <h3>Past Paper</h3>
                        <img src="assect/img/content/modle.jpg" alt="past paper">
                    </div>
                </a>
            </div>
            <?php
            if (isset($_SESSION['ID'])) {
                if ($verifyUser == 1) {
                    echo '<div class="list">
                <a href="modle-papers" onclick="loadingEffect()">
                    <div class="first">
                        <h3>Model Paper </h3>
                        <img src="assect/img/content/model.jpg" alt="modle paper">
                    </div>
                </a>
            </div>
            <div class="list">
                <a href="video-classes" onclick="loadingEffect()">
                    <div class="first">
                        <h3>Video Class</h3>
                        <img src="assect/img/content/video.jpg" alt="video class">
                    </div>
                </a>
            </div>
            <div class="list">
                <a href="paper-discussions" onclick="loadingEffect()">
                    <div class="first">
                        <h3>Paper Discussions</h3>
                        <img src="assect/img/content/discution.jpg" alt="paper discution">
                    </div>
                </a>
            </div>
            <div class="list">
                <a href="tutes" onclick="loadingEffect()">
                    <div class="first">
                        <h3>Tutes</h3>
                        <img src="assect/img/content/images.png" alt="tutes">
                    </div>
                </a>
            </div>';
                } else {
                    echo '<div class="list">
                <a class="error-messages">
                    <div class="first">
                        <h3>Model Paper </h3>
                        <img src="assect/img/content/model.jpg" alt="modle paper">
                    </div>
                </a>
            </div>
            <div class="list">
                <a class="error-messages">
                    <div class="first">
                        <h3>Video Class</h3>
                        <img src="assect/img/content/video.jpg" alt="video class">
                    </div>
                </a>
            </div>
            <div class="list">
                <a class="error-messages">
                    <div class="first">
                        <h3>Paper Discussions</h3>
                        <img src="assect/img/content/discution.jpg" alt="paper discution">
                    </div>
                </a>
            </div>
            <div class="list">
                <a class="error-messages">
                    <div class="first">
                        <h3>Tutes</h3>
                        <img src="assect/img/content/images.png" alt="tutes">
                    </div>
                </a>
            </div>';
                }
            } else {
                echo '<div class="list">
                <a class="error-messages">
                    <div class="first">
                        <h3>Model Paper </h3>
                        <img src="assect/img/content/model.jpg" alt="modle paper">
                    </div>
                </a>
            </div>
            <div class="list">
                <a class="error-messages">
                    <div class="first">
                        <h3>Video Class</h3>
                        <img src="assect/img/content/video.jpg" alt="video class">
                    </div>
                </a>
            </div>
            <div class="list">
                <a class="error-messages">
                    <div class="first">
                        <h3>Paper Discussions</h3>
                        <img src="assect/img/content/discution.jpg" alt="paper discution">
                    </div>
                </a>
            </div>
            <div class="list">
                <a class="error-messages">
                    <div class="first">
                        <h3>Tutes</h3>
                        <img src="assect/img/content/images.png" alt="tutes">
                    </div>
                </a>
            </div>';
            }
            ?>
        </div>
    </div>

    <div class="classList">
        <h2> Watch free classes </h2>
        <div class="classListBack">
            <a onclick="loadingEffect()" href="free-videos.php?catagory=free&vd=1">පරමාණුක ව්‍යූහය</a>
            <a onclick="loadingEffect()" href="free-videos.php?catagory=free&vd=5">P ගොනුව</a>
            <a onclick="loadingEffect()" href="free-videos.php?catagory=free&vd=6"> නාමකරණය</a>
            <a onclick="loadingEffect()" href="free-videos.php?catagory=free&vd=2">රසායනික ගණනය</a>
            <a id="fb" onclick="loadingEffect()" href="https://www.facebook.com/profile.php?id=100089573856861&mibextid=LQQJ4d">පන්ති පිළිබද විස්තර සහ නවතම තොරතුරු දැනුවත් වීම සදහා Facebook සමුහයට එක්වන්න.</a>
        </div>
    </div>

    <div class="classList">
        <div class="classListBack4" style="margin-bottom: 20px;">
            <img src="assect/img/content/content.jpg" alt="content">
            <p>Mr.Chemistry වෙබ් අවියෙහි අරමුන වන්නේ ඔබගේ අධ්‍යාපනික කටයුතු පහසු කිරීම හා මනා සැලැස්මකින් යුතුව ඔබගේ අධ්‍යාපනික කටයුතු අධ්‍යනයකොට, ඔබගේ මට්ටම අනෙකුත් ශිෂ්‍යන් සමග සන්සන්දනය කොට තමාගේ අඩුපාඩු සාදාගනිමින් තම ලකුනු වැඩි කර ගැනීමට මෙන්ම උනන්දුව ස්මතු කරමින් ඔබගේත් ඔබගේ සහෝදර ශිෂ්‍යන්ගේත් කඩයිම වන උසස්පෙල විභහගය ඉහලින් සමත් කරවීමයි.</p>
        </div>
        <div class="classListBack4 view">
            <p> අප පන්තියේ වැඩ පිලිවෙල නිවැරදිව ක්‍රියාකරමින්, ඔබගේ දියුණුව මෙම අඩවිය මගින් විෂ්ලේශනය කරමින් ඔබ බුද්ධිමත්ව ක්‍රියා කරන්නේ නම් ඔබට නිසැකවම ජයග්‍රාහී ලකුණක් කරා ලගා විය හැකිය. </p>
            <img src="assect/img/content/content2.jpg" alt="content">
        </div>
        <div class="classListBack4 hide">
            <img src="assect/img/content/content2.jpg" alt="content">
            <p> අප පන්තියේ වැඩ පිලිවෙල නිවැරදිව ක්‍රියාකරමින්, ඔබගේ දියුණුව මෙම අඩවිය මගින් විෂ්ලේශනය කරමින් ඔබ බුද්ධිමත්ව ක්‍රියා කරන්නේ නම් ඔබට නිසැකවම ජයග්‍රාහී ලකුණක් කරා ලගා විය හැකිය. </p>
        </div>
    </div>

    <div class="classList backblue">
        <h2> Facilities </h2>
        <div class="classListBack3">
            <div class="cycle-slideshow bnft">
                <img src="assect/img/brand/IMG_9003.jpg" alt="Facilities">
                <img src="assect/img/brand/IMG_9004.jpg" alt="Facilities">
                <img src="assect/img/brand/IMG_0129.jpg" alt="Facilities">
                <img src="assect/img/brand/IMG_4441.jpg" alt="Facilities">
            </div>
            <div class="bnft">
                <h2> පහසුකම්.</h2>
                <p> ඔබත්, ඔබගේ පන්තියේ අනෙකුත් සිසුන් පේපර් වලට ගත් ලකුනු පැහැදිලිව සන්සන්දනය කළ හැකිවීම.( එමගින් ඔබට ඔබගේ තත්වය විෂ්ලේශනය කර තව තවත් උනන්දු වී පාඩම් කරවීම බලාපොරොත්තු වේ. ) <br> දිනෙන් දින ඔබගේ වර්ධනය පහසුන් මැන ගත හැකි වීම. <br> පාස්ට් පේපර් සහ ඒවායෙහි පිලිතුරු පත්‍ර පහසුවෙන් සහ වේගවත්ව ලබා ගත හැකිවීම <br> කෙටි සටහන් සටහන් කොට තබා ගැනීනට ගැකි වීම. <br><br>
                    AI මගින් ඔබගේ ගනනය කිරීම් වඩා පහසු කරන අතර ඔබගේ පිලිතුරු නිවැරදිදැයි පරීක්ෂා කර ගත හැකි වේ. ගණනය කිරීම් පමනක් නොව සියලූම වර්ගයේ ප්‍රස්තාර පවා AI මගින් නිර්මාණය කර ගත හැක.
                </p>
            </div>
        </div>
    </div>

    <?php
    // includes time table
    include "includes/timetable.php";

    // includes whatsapp links
    include "includes/links.php";
    ?>

    <!-- past paper div -->
    <div class="papersAlin pOne">
        <div class="papers">
            <i class="fa-solid fa-xmark closeBTN" id="close"></i>
            <div class="switch">
                <h3 id="pp">PAPER<span class="pp"></span></h3>
                <h3 id="pm">MARKING<span class="pm"></span></h3>
            </div>
            <!-- past paper view -->
            <div class="pure paper">
                <h1> MCQ Paper </h1>
                <?php
                $MCQ = "SELECT * FROM past_papers WHERE `Type`= 'MCQ' ORDER BY `Year`";
                $MCQ_result = mysqli_query($connection, $MCQ);
                if (mysqli_num_rows($MCQ_result) > 0) {
                    while ($papers_mcq = mysqli_fetch_assoc($MCQ_result)) {
                        echo "<a href='{$papers_mcq['Link']}'>{$papers_mcq['Year']}</a>";
                    }
                }
                ?>
            </div>
            <div class="applide paper">
                <h1> Essay Paper </h1>
                <?php
                $Essay = "SELECT * FROM past_papers WHERE `Type`= 'Essay' ORDER BY `Year`";
                $Essay_result = mysqli_query($connection, $Essay);
                if (mysqli_num_rows($Essay_result) > 0) {
                    while ($papers = mysqli_fetch_assoc($Essay_result)) {
                        echo "<a href='{$papers['Link']}'>{$papers['Year']}</a>";
                    }
                }
                ?>
            </div>

            <!-- marking view -->
            <div class="pure marking">
                <h1> MCQ marking</h1>
                <?php
                $MCQ_M = "SELECT * FROM past_papers WHERE `Type`= 'MCQ_M' ORDER BY `Year`";
                $MCQ_M_result = mysqli_query($connection, $MCQ_M);
                if (mysqli_num_rows($MCQ_M_result) > 0) {
                    while ($Marking_MCQ = mysqli_fetch_assoc($MCQ_M_result)) {
                        echo "<a href='{$Marking_MCQ['Link']}'>{$Marking_MCQ['Year']}</a>";
                    }
                }
                ?>
            </div>
            <div class="applide marking">
                <h1> Essay marking </h1>
                <?php
                $Essay_M = "SELECT * FROM past_papers WHERE `Type`= 'Essay_M' ORDER BY `Year`";
                $Essay_M_result = mysqli_query($connection, $Essay_M);
                if (mysqli_num_rows($Essay_M_result) > 0) {
                    while ($Marking_Essay = mysqli_fetch_assoc($Essay_M_result)) {
                        echo "<a href='{$Marking_Essay['Link']}'>{$Marking_Essay['Year']}</a>";
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <!-- model paper, video class, paper discutions error message div -->
    <div class="papersAlin pTow">
        <div class="papers">
            <i class="fa-solid fa-xmark closeBTN" id="close"></i>
            <?php if (isset($_SESSION['ID'])) {
                if ($verifyUser == 3) {
                    echo '<div class="center"><div style="text-align: center; padding: 10px;"> <h1><i class="fa-solid fa-clock fa-fade fa-2xl" style="color: #005eff;"></i></h1><br><br>' .
                        '<h2> Your account is being<br>' . '<span style="color: #005eff; font-size: 20px;" class="fa-fade">Reviewing...</span> </h2><br>
                            <p>Your account has not been verified. Your teacher is reviewing your account. Please wait 24 hours to activate your account</p>
                            </div>
                    </div>';
                } elseif ($verifyUser == 2) {
                    echo '<div class="center"><div style="text-align: center; padding: 10px;">
                        <h1><i class="fa-solid fa-triangle-exclamation fa-beat fa-2xl" style="color: #ff0000;"></i><br><br></h1>
                        <h2>Your account has been banned</h2>
                        </div></div>';
                } elseif ($verifyUser == 1) {
                    $homework = "block";
                }
            } else {
                echo '<div class="center"><div style="text-align: center;">' .
                    '<h2 style="margin-bottom: 20px;"> Please log in first </h2>
                        <a href="login">login</a>
                    </div></div>';
            }
            ?>

            <!-- homework  -->
            <div class="homework" style="display: <?php echo $homework; ?>;">
                <h2> Submit Homework </h2>
                <br>
                <form action="homework.php" method="post" enctype="multipart/form-data">
                    <p>
                        <b>User ID :</b>
                        <input type="number" placeholder="<?php echo $ID; ?>" readonly>
                    </p>
                    <p>
                        <b>Name :</b>
                        <input type="text" placeholder="<?php echo $First_name . " " . $Last_name; ?>" readonly>
                    </p>
                    <p>
                        <b>Class :</b>
                        <input type="number" placeholder="<?php echo $Class; ?>" readonly>
                    </p>
                    <p>
                        <b>Title :</b>
                        <input type="text" placeholder="Title" name="title">
                    </p>
                    <p>
                        <b>PDF file :</b>
                        <input type="file" name="pdf">
                    </p>
                    <p>
                        <input type="submit" name="homeorkSubmit" onclick='loadinEffect()'>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include "includes/footer.php";
?>

<div class="space"></div>
<div class="space2"></div>
<script src="assect/js/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.cycle2/2.1.6/jquery.cycle2.min.js" integrity="sha512-lvcHFfj/075LnEasZKOkj1MF6aLlWtmpFEyd/Kc+waRnlulG5er/2fEBA5DBff4BZrcwfvnft0PiAv4cIpkjpw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
        var paper = true;
        $(".papersAlin").css("display", "none");
        $(".more").click(function() {
            if (paper = true) {
                $(".pOne").css("display", "flex");
            }
        });
        $(".closeBTN").click(function() {
            if (paper = true) {
                $(".pOne").css("display", "none");
            }
        });


        $(".error-messages").click(function() {
            if (paper = true) {
                $(".pTow").css("display", "flex");
            }
        });
        $(".closeBTN").click(function() {
            if (paper = true) {
                $(".pTow").css("display", "none");
            }
        });

        swithsPaper = true;
        $("#pm").css("background-color", "#fff");
        $("#pm").css("color", "#5e5e5e");
        $("#pp").click(function() {
            if (swithsPaper = true) {
                $("#pm").css("background-color", "#fff");
                $("#pm").css("color", "#5e5e5e");
                $(".paper").css("display", "grid");
                $(".marking").css("display", "none");
                $("#pp").css("background-color", "var(--text-blue)");
                $("#pp").css("color", "#fff");
            }
        });
        $("#pm").click(function() {
            if (swithsPaper = true) {
                $("#pp").css("background-color", "#fff");
                $("#pp").css("color", "#5e5e5e");
                $(".paper").css("display", "none");
                $(".marking").css("display", "grid");
                $("#pm").css("color", "#fff");
                $("#pm").css("background-color", "var(--text-blue)");
            }
        });

        setInterval(function() {
            $("#homework-form").load("admin/timer.php");
        }, 1000);
    });
</script>

<script>
    function loadinEffect() {
        document.getElementById('loader').style.display = "flex";
    }
</script>