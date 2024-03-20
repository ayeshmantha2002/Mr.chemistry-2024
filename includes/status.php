<?php

include("connection.php");

if (isset($_GET['status'])) {
    if ($_GET['status'] == 1) {
        $update     =   "UPDATE notes SET Status ={$_GET['status']} WHERE ID = {$_GET['user']} LIMIT 1";
        $result = mysqli_query($connection, $update);
    } elseif ($_GET['status'] == 2) {
        $update = "DELETE FROM notes WHERE ID = {$_GET['user']}";
        $result = mysqli_query($connection, $update);
    }

    if ($result) {
        header("location:../index.php?status=done");
    }
}
