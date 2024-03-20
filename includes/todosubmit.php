<?php
include('connection.php');

if (isset($_SESSION['ID'])) {
    $full_name  =   $_SESSION['First_name'] . " " . $_SESSION['Last_name'];
    $user_id    =   $_SESSION['ID'];
}

if (isset($_POST['note'])) {
    $note   =   mysqli_real_escape_string($connection, $_POST['note']);
    $inNote = nl2br(strip_tags($note));

    if (trim($note) == '') {
        echo "error";
        exit;
    }

    $query  =   "INSERT INTO notes (User_id , Full_name , Note ) VALUES ({$user_id} , '{$full_name}' , '{$inNote}')";
    $result =    mysqli_query($connection, $query);

    if (mysqli_affected_rows($connection) > 0) {
        echo "record-added";
        exit;
    } else {
        echo "error";
        exit;
    }
}

if (isset($_SESSION['ID'])) {

    $serchnote  =   "SELECT * FROM notes WHERE User_id = '{$_SESSION['ID']}' ORDER BY ID DESC";
    $notequery  =   mysqli_query($connection, $serchnote);
    if ($notequery) {

        $note_list  =   '<ul>';
        while ($user   =   mysqli_fetch_assoc($notequery)) {
            $note_list .= '<div>';
            $status = $user['Status'];
            if ($status == 1) {
                $note_list .= '<li class="true">';
            } elseif ($status == 2) {
                $note_list .= '<li class="fauls">';
            } else {
                $note_list .= '<li class="nomelLI">';
            }
            $note_list .= '<div id="notePara">';
            $note_list .= nl2br(strip_tags($user['Note']));
            $note_list .= '</div>';
            $note_list .= '<div id="notelink">';
            $note_list .= '<a href="includes/status.php?status=1&user=' . $user['ID'] . '"><i class="fa-solid fa-square-check fa-lg" style="color: #11ff00;"></i></a>';
            $note_list .= '<a href="includes/status.php?status=2&user=' . $user['ID'] . '"><i class="fa-solid fa-trash fa-lg" style="color: #ff0000;"></i></a>';
            $note_list .= '</div>';
            $note_list .= '</div>';
            $note_list .= '</li>';
        }
        $note_list  .=   '</ul>';
    };
} else {
    $addnote    =   '<b> Please Log in first. </b>' . '<br>' . '<a href="login.php"> click here.';
    $note_list = '<ol>' . '<li>' . '<div id="studentNoteLog">' . $addnote . '</div>' . '</li>' . '</ol>';
}
