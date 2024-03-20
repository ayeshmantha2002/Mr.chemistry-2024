<?php include('includes/todosubmit.php'); ?>
<div class="lable">
    <div class="lableAling">
        <h2> Mr.ChemistrY </h2>
        <p>Mr.ChemistrY - Chemistry <span style='font-family: "Noto Sans Sinhala"; font-weight: bold;'> වලට තවත් නමක් </span> </p>
    </div>
</div>
<?php
if (!isset($_SESSION['ID'])) {
    echo '<div class="notemain">
            <div class="viewProfile2">
                <i class="fa-solid fa-right-from-bracket fa-shake"></i>
                <p>Please login first. Then enjoy the facilities.</p>
                <br>
                <p> <a href="login"> Log in here. </a> </p>
            </div>
        </div>';
} else {
    echo '<div class="todo">
            <form method="post" id="subform">
            <textarea placeholder="Enter New Note" maxlength="255" name="note" required></textarea>
            <input type="submit" value="Add Note" name="submit" id="submit">
        </form>' .
        '<div class="notes">' . $note_list . '</div>'
        . '</div>';
}
include "includes/footer.php";
?>
<div class="space"></div>
<div class="space2"></div>

<script>
    $(document).ready(function() {
        $("#submit").click(function(event) {
            event.preventDefault();
            var formData = $("#subform").serialize();
            $.post(
                "includes/todosubmit.php",
                formData,
                function(data, status) {
                    if (data == "record-added" && status == "success") {
                        $('.content').load('todo.php');
                    }
                }
            );
        });
    });
</script>